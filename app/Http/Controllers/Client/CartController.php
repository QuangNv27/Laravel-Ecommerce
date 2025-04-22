<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // ddp(Auth::user());
        $cart = Cart::with('items.productVariant.product')->where('user_id', Auth::user()->id)->first();
        // ddp($cart);
        foreach ($cart->items as $item) {
            dump([
                'variant_id' => $item->product_variant_id ?? null,
                'variant' => $item->productVariant ?? null,
                'product' => $item->productVariant?->product ?? null,
            ]);
        }
        return view('client.carts.index', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(Cart $cart)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
    public function add(Request $request)
    {
        $data = $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'nullable|integer|min:1',
        ]);
        // Kiểm tra tồn kho
        $variant = ProductVariant::findOrFail($data['variant_id']);
        $quantity = $data['quantity'];
        if ($variant->stock < $quantity) {
            return back()->with('error', 'Sản phẩm không đủ hàng trong kho');
        }
        $user = Auth::user();
        // Tìm / tạo giỏ active
        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
            'status' => 'active',
        ], [
            'total_amount' => 0,
            'status' => 'active',
        ]);
        // Kiểm tra variant đã tồn tại thì cộng thêm
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('variant_id', $variant->id)
            ->first();
        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'variant_id' => $variant->id,
                'quantity' => $quantity,
            ]);
        }
        // Cập nhật tổng tiền
        $cart->total_amount = $cart->cartItem()->with('variant')->get()->sum(function ($item) {
            return $item->quantity * $item->variant->price;
        });
        $cart->save();
        // return redirect()->route('cart.show')->with('success', 'Đã thêm vào giỏ hàng thành công!');
        return back()->with('success', 'Đã thêm vào giỏ hàng thành công!');
    }
    public function show()
    {
        $user = Auth::user();
        // Lấy giỏ hàng đang active ( nếu có )
        $cart =  Cart::with(['cartItem.variant.product'])
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->first();
        // dd($cart);
        return view('client.carts.show', compact('cart'));
    }
    public function remove($id)
    {
        $user = Auth::user();

        $cartItem = CartItem::findOrFail($id);

        // Kiểm tra quyền sở hữu
        if ($cartItem->cart->user_id !== $user->id) {
            abort(403);
        }

        $cart = $cartItem->cart;
        $cartItem->delete();

        // Cập nhật tổng tiền
        $cart->total_amount = $cart->cartItem()->with('variant')->get()->sum(function ($item) {
            return $item->quantity * $item->variant->price;
        });
        $cart->save();

        return redirect()->route('cart.show')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }
    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $cartItem = CartItem::findOrFail($id);

        // Kiểm tra quyền sở hữu
        if ($cartItem->cart->user_id !== $user->id) {
            abort(403);
        }

        // Kiểm tra tồn kho
        if ($request->quantity > $cartItem->variant->stock) {
            return back()->with('error', 'Số lượng vượt quá tồn kho');
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        // Cập nhật tổng tiền
        $cart = $cartItem->cart;
        $cart->total_amount = $cart->cartItem()->with('variant')->get()->sum(function ($item) {
            return $item->quantity * $item->variant->price;
        });
        $cart->save();

        return redirect()->route('cart.show')->with('success', 'Đã cập nhật số lượng.');
    }
    public function clearCart()
    {
        $user = Auth::user();
        $cart = $user->cart()->with('cartItem')->first();

        if (!$cart || $cart->cartItem->isEmpty()) {
            return back()->with('error', 'Giỏ hàng đã trống.');
        }

        // Xóa toàn bộ cart item
        $cart->cartItem()->delete();
        $cart->delete();

        return back()->with('success', 'Đã hủy toàn bộ giỏ hàng.');
    }
}
