<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ProductVariantController extends Controller
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
        return view('admin.variants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        //
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'color'      => 'required|string|max:50',
            'size'       => 'required|string|max:10',
            'price'      => 'required|numeric|min:0',
            'stock'      => 'required|integer|min:0',
            'name'       => 'required|string|max:255', // Nếu có nhập từ form
        ]);
    
        ProductVariant::create($data);
        return back()->with('success', 'Thêm biến thể thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductVariant $variant)
    {
        return view('admin.variants.edit',compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductVariant $variant)
    {
        //
        $request->validate([
            'price'=>'required|min:0',
            'stock'=>'required|integer|min:0',
        ]);
        $variant->update([
            'price'=>$request->price,
            'stock'=>$request->stock
        ]);
        return redirect()->route('products.edit',['product'=>$variant->product_id])
        ->with('success','Cập nhật tồn kho thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariant $variant)
    {
        //
        $product = $variant->product_id;
        // dd($productId, route('products.edit', ['product' => $productId]));
        $variant->delete();
        return redirect()->route('products.edit', $product)
        ->with('success','Xóa biến thể thành công');
        // dd(true);
    }
}
