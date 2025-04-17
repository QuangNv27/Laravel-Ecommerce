<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


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
