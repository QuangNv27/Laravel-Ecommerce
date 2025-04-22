<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    // ---------ADMIN----------
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('category')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);
        $imagePath = 'products/product_default.jpg';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }
        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'base_price' => $request->base_price,
            'image' => $imagePath,
        ]);
        return redirect()->route('products.index')->with('success', 'Thêm mới sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        // $product::with('variants')
        $variants = $product->variants;
        return view('admin.products.show', compact('product', 'variants'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        $categories = Category::all();
        $variants = $product->variants;
        return view('admin.products.edit', compact('product', 'categories', 'variants'));
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
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->update(['image' => $imagePath]);
        }
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'base_price' => $request->base_price,
        ]);
        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product_default = 'products/product_default.jpg';
        if ($product->image && $product->image !== $product_default) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công');
    }
    // ---------CLIENT----------
    // public function top4new()
    // {
    //     $products = Product::latest()->paginate(12);
    //     return view('client.products.index',compact('products'));
    // }

    // public function getProductList(Request $request)
    // {
    //     $categories = Category::all();
    //     $query = Product::query()->with('category');

    //     // Lọc theo danh mục nếu có slug
    //     if ($request->filled('category')) {
    //         $category = Category::where('slug', $request->category)->firstOrFail();
    //         if($category) {
    //         $query->where('category_id', $category->id);
    //         } else {
    //             return back()->with('error','Danh mục không tồn tại');
    //         }
    //     }

    //     // Tìm kiếm tên sản phẩm
    //     if ($request->filled('s')) {
    //         $query->where('name', 'LIKE', '%' . $request->s . '%');
    //     }

    //     // Các filter khác có thể thêm ở đây...

    //     $products = $query->latest()->paginate(12)->withQueryString();

    //     return view('client.products.index', [
    //         'products' => $products,
    //         'category' => $category ?? null,
    //         'categories'=>$categories,
    //     ]);
    // }

    public function getProductList(Request $request)
    {
        // Lấy tất cả danh mục để hiển thị trong header hoặc sidebar
        $categories = Category::all();

        // Khởi tạo query cho sản phẩm
        $query = Product::query()->with('category');

        // Lọc theo danh mục nếu có
        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();

            // Nếu có danh mục hợp lệ, thêm điều kiện vào query
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Tìm kiếm theo tên sản phẩm nếu có
        if ($request->filled('s')) {
            $query->where('name', 'LIKE', '%' . $request->s . '%');
        }

        // Các filter khác có thể thêm ở đây (ví dụ: filter giá, sắp xếp,...)

        // Lọc theo giá nếu có
        if ($request->filled('min_price')) {
            $query->where('base_price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('base_price', '<=', $request->max_price);
        }

        // Lấy sản phẩm theo trang và giữ lại các query string để phân trang chính xác
        $products = $query->latest()->paginate(12)->withQueryString();

        // Trả về view với sản phẩm, danh mục và các tham số cần thiết
        return view('client.products.index', [
            'products' => $products,
            'categories' => $categories,
            'category' => $category ?? null,
        ]);
    }

    public function clientShow($id)
    {
        // dd($categories);
        // Tìm sản phẩm theo ID, đồng thời lấy các biến thể liên quan
        $product = Product::with('variants')->findOrFail($id);

        return view('client.products.show', compact('product'));
    }
}
