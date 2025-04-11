<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(string $product_id, string $variant_id, string $user_id, float $price)
    {
        $check = Cart::where("user_id", $user_id)
            ->where("status", "active")
            ->first();

        if ($check === null) {
            // Chưa có giỏ hàng, tạo mới
            $check = Cart::create([
                "user_id"      => $user_id,
                "status"       => "active",
                "total_amount" => $price,
            ]);
        } else {
            // Đã có giỏ hàng, cộng thêm tiền vào total_amount
            $check->increment('total_amount', $price);

            // Hoặc nếu muốn dùng DB::raw (ít dùng hơn trong Eloquent):
            // $check->update([
            //     'total_amount' => DB::raw('total_amount + ' . $price)
            // ]);
        }
        $cart = Cart::where("user_id",$user_id)->where("status",'active')->first();
        $cart_id = $cart->id;

        $cartItem = CartItem::where("cart_id", $cart_id)
            ->where("variant_id", $variant_id)
            ->first();

        if ($cartItem === null) {
            CartItem::create([
                "cart_id"    => $cart_id,
                "variant_id" => $variant_id,
                "quantity"   => 1,
            ]);
        } else {
            $cartItem->increment('quantity');
            // Hoặc nếu thích dùng DB::raw:
            // CartItem::where("cart_id", $cart_id)
            //     ->where("variant_id", $variant_id)
            //     ->update(['quantity' => DB::raw('quantity + 1')]);
        }

        return redirect("/product-detail/".$product_id);

    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

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
}
