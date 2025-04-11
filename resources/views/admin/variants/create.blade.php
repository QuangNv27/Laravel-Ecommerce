{{-- toggleVariantForm --}}
<!-- Nút toggle -->
<button type="button" onclick="toggleVariantForm()"  class="btn btn-sm btn-success mb-2">+ Thêm biến thể</button>

<!-- Form ẩn/hiện -->
<div id="variantForm" class="card mt-3" style="display: none;">
    <div class="card-body">
        {{-- <h5 class="card-title">Thêm biến thể sản phẩm</h5> --}}

        <form action="{{ route('variants.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        
            <div class="mb-2">
                <label>Name:</label>
                <input type="text" class="form-control" name="name" placeholder="VD: Áo Da Bò">
            </div>

            <div class="mb-2">
                <label>Color:</label>
                <input type="text" class="form-control" name="color" placeholder="VD: Đen">
            </div>
        
            <div class="mb-2">
                <label>Size:</label>
                <input type="text" class="form-control" name="size" placeholder="VD: M">
            </div>
        
            <div class="mb-2">
                <label>Price:</label>
                <input type="text" class="form-control" name="price" placeholder="VD: 199000">
            </div>
        
            <div class="mb-2">
                <label>Stock:</label>
                <input type="number" class="form-control" name="stock" value="0">
            </div>
        
            <button type="submit" class="btn btn-primary">Lưu biến thể</button>
        </form>
        
    </div>
</div>
