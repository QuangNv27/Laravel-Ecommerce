<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserVoucher;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientOrderController extends Controller
{
    //
    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart()->with('cartItem.variant.product')->first();
        if (!$cart || $cart->cartItem->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng trống');
        }
        $request->validate([
            'shipping_address' => 'required|string|max:255',
        ]);
        DB::beginTransaction();
        try {
            $subtotal = 0;
            foreach ($cart->cartItem as $item) {
                $subtotal += $item->variant->price * $item->quantity;
            }
            $voucher = session('voucher');
            $discount = 0;
            $voucher_id = null;
            // Validate Voucher
            if ($voucher) {
                $voucher = Voucher::where('code', $voucher['code'])->first();
                if ($voucher && $voucher->is_active && $voucher->expires_at > now()) {
                    if ($voucher->min_order_amount && $subtotal < $voucher->min_order_amount) {
                        $discount = 0;
                    } else {
                        // Kiểm tra per_user_limit
                        $userVoucher = UserVoucher::where('user_id',$user->id)
                        ->where('voucher_id',$voucher->id)
                        ->first();
                        $usedTimes = $userVoucher->used_times ?? 0;
                        if($voucher->per_user_limit !== null && $usedTimes >= $userVoucher->per_user_limit) {
                            DB::rollBack();
                            return back()->with('error','Đạt giới hạn số lượng dùng voucher này cho mỗi user');
                        }
                        $voucher_id = $voucher->id;
                        if ($voucher->type == 'fixed') {
                            $discount = $voucher->value;
                        } else {
                            $discount = $subtotal * ($voucher->value / 100);
                        }
                        // Cập nhật userUsage
                        $voucher->increment('used_count');
                        UserVoucher::updateOrCreate(
                            ['user_id' => $user->id, 'voucher_id' => $voucher->id],
                            ['used_times' => DB::raw('used_times+1')]
                        );
                    }
                }
            }
            // dd($request->all());
            $finalTotal = $subtotal - $discount;
            $order = Order::create([
                'user_id' => $user->id,
                'shipping_address' => $request->shipping_address,
                'voucher_id' => $voucher_id,
                'discount_amount' => $discount,
                'total_price' => $subtotal,
                'shipping_fee' => 0,
                'final_total' => $finalTotal,
            ]);
            foreach ($cart->cartItem as $item) {
                // Lock the variant record for update (prevent race conditions)
                $variant = $item->variant()->lockForUpdate()->first();
                // Kiểm tra tồn kho
                if ($variant->stock < $item->quantity) {
                    DB::rollBack();
                    return back()->with('error', "Sản phẩm {$variant->product->name} không đủ stock.");
                }
                OrderItem::create([
                    'order_id' => $order->id,
                    'variant_id' => $item->variant->id,
                    'quantity' => $item->quantity,
                    'price' => $item->variant->price,
                ]);
                // Giảm stock sản phẩm
                $variant->stock -= $item->quantity;
                $variant->save();
            }
            // Xóa cart
            $cart->cartItem()->delete();
            $cart->delete();
            // Xóa voucher trong session
            // dd(session()->all());
            session()->forget('voucher');
            session()->forget('discount');
            DB::commit();
            return redirect()->route('order.index')->with('success', 'Đặt hàng thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return back()->with('error', 'Lỗi đặt hàng:' . $e->getMessage());
        }
    }
    public function index()
    {
        $orders = Auth::user()->order()->with(['orderItems.variant.product'],'voucher')->latest()->get();
        return view('client.orders.index', compact('orders'));
    }
    public function cancelOrder($orderId)
    {
        $order = Order::with('orderItems.variant')->where('user_id', Auth::id())->findOrFail($orderId);

        if ($order->status !== 'pending') {
            return back()->with('error', 'Chỉ có thể hủy đơn hàng đang chờ xử lý.');
        }

        DB::beginTransaction();
        try {
            // Hoàn trả stock
            foreach ($order->orderItems as $item) {
                $variant = $item->variant;
                $variant->stock += $item->quantity;
                $variant->save();
            }

            // Cập nhật trạng thái đơn
            $order->status = 'canceled';
            $order->save();

            DB::commit();
            return back()->with('success', 'Đơn hàng đã được hủy và hoàn trả hàng tồn.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi khi hủy đơn hàng: ' . $e->getMessage());
        }
    }
}
