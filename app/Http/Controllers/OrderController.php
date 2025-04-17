<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\String_;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Order::with('user')->latest()->paginate();
        return view('admin.orders.index',compact('orders'));
    }
    public function checkout(){
        $userInfo = Auth::user();
        $cart = Cart::where("user_id",$userInfo->id)->first();
        if ($cart != NULL){
            $cart_items = CartItem::with('variant')->where("cart_id",$cart->id)->get();
        } else {
            $cart_items = [];
        }
        $orders = Order::where("user_id",$userInfo->id)->get();
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            Order::create([
                "user_id"=>$userInfo->id,
                "total_price"=>$cart->total_amount,
                "voucher_id"=>0,
                "discount_amount"=>0,
                "shipping_fee"=>15000,
                "final_total"=> ($cart->total_amount + 15000.0)
            ]);
            $order = Order::where("user_id",$userInfo->id)->orderBy("id","DESC")->first();
            $order_id = $order->id;
            $data = [];
            foreach($cart_items as $item){
                $data[] = [
                    "order_id"=>$order_id,
                    "variant_id"=>$item->variant->id,
                    "quantity"=>$item->quantity,
                    "price"=>$item->variant->price,
                ];
            }
            OrderItem::insert($data);
            CartItem::where("cart_id",$cart->id)->delete();
            Cart::where("id",$cart->id)->delete();
            return redirect('/checkout')->with("success","Thanh toán thành công");
        } else {
            return view("client.order.checkout",compact('cart','cart_items','orders'));
        }
        // var_dump($cart_items);
        
    }
    public function detail(string $id){
        $order_items = OrderItem::with("variant")->where('order_id',$id)->get();
        // var_dump($order_items->variant);
        // var_dump($order_items);
        return view('client.order.detail',compact('order_items','id'));
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
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
        return view('admin.orders.edit',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
        $validStatus = ['pending','processing','shipped','delivered','canceled'];
        $request->validate([
            'status'=>'required|string|in:'. implode(',',$validStatus),
        ]);
        // đảo ngược key và value
        $statusIndex = array_flip($validStatus);
        if($statusIndex[$request->status]<=$statusIndex[$order->status]) {
            return back()->with('error','Không thể quay lại trạng thái trước đó');
        }
        $order->update([
            'status'=>$request->status,
        ]);
        return back()->with('success','Thay đổi thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
