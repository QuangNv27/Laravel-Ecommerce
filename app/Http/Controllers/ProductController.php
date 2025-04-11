<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('category')->paginate(10);
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'category_id'=>'required|exists:categories,id',
            'name'=>'required|string|max:255',
            'description'=>'nullable|string',
            'base_price'=>'required|numeric',
            'image'=>'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $imagePath = 'products/product_default.jpg';
        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products','public');
        }
        Product::create([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'description'=>$request->description,
            'base_price'=>$request->base_price,
            'image'=>$imagePath,
        ]);
        return redirect()->route('products.index')->with('success','Thêm mới sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        // $product::with('variants')
        $variants = $product->variants;
        return view('admin.products.show', compact('product','variants'));
    }
    public function detail(string $id){
        $product = Product::with(['category', 'variants'])->where('id', $id)->first();
        // var_dump($product);
        // var_dump($product->variants);
        return view("client.products.detail", compact('product'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        $categories = Category::all();
        $variants = $product->variants;
        return view('admin.products.edit',compact('product','categories','variants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', 
        ]);
        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products','public');
            $product->update(['image'=>$imagePath]);
        }
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'base_price' => $request->base_price,
        ]);
        return redirect()->route('products.index')->with('success','Cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product_default = 'products/product_default.jpg';
        if($product->image && $product->image !== $product_default) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success','Xóa sản phẩm thành công');
    }

    public function top4new()
    {
        $products = Product::latest()->paginate(12);
        return view('client.products.index',compact('products'));
    }

    public function getProductList()
    {
        $products = Product::orderBy("id","DESC")->paginate(12);
        return view('client.products.index',compact('products'));
    }
}
