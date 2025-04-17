<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //
    public function show(Request $request)
    {
        $cart = Auth::user()->cart()->with('cartItem.variant.product')
        ->first();
        // dd($cart);
        $voucher = session('voucher');
        $discount = session('discount',0);
        $subtotal = $cart->cartItem->sum(function ($item) {
            return $item->variant->price * $item->quantity;
        });
        // dd($subtotal);
        $total = $subtotal - $discount;
        // dd($subtotal);
        return view('client.checkout',compact('cart','voucher','discount','subtotal','total'));
    }
    public function applyVoucher(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);
        $voucher = Voucher::where('code',$request->code)->first();
        if(!$voucher || !$voucher->is_active || ($voucher->expires_at && $voucher->expires_at < now())) {
            return back()->withErrors(['code' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn.']);
        }
        // Kiểm tra user đã dùng vượt giới hạn chưa
        $user = Auth::user();
        $userUsage = $voucher->users()->where('user_id',$user->id)->first();
        if($voucher->per_user_limit && $userUsage && $userUsage->pivot->used_times >= $voucher->per_user_limit) {
            return back()->withErrors(['code' => 'Bạn đã dùng mã này quá số lần cho phép.']);
        }
        // Tính giảm giá
        $cart = $user->cart()->with('cartItem.variant')->first();
        $subtotal = $cart->cartItem->sum(fn($item)=>$item->variant->price*$item->quantity);
        if($voucher->min_order_amount && $subtotal < $voucher->min_order_amount)
        {
            return back()->withErrors(['code' => 'Đơn hàng chưa đủ điều kiện áp mã giảm.']);
        }
        $discount = $voucher->type === 'fixed'
        ? $voucher->value 
        : round($subtotal * ($voucher->value / 100 ));
        // Lưu session
        session([
            'voucher'=>$voucher,
            'discount'=>$discount,
        ]);
        return redirect()->route('checkout.show')->with('success', 'Áp mã giảm giá thành công!');
    }
    public function removeVoucher()
    {
        session()->forget(['voucher','discount']);
        return redirect()->route('checkout.show')->with('success','Đã hủy mã giảm giá.');
    }
}
