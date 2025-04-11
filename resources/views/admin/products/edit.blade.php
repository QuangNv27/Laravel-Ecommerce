@extends('admin.layouts.master')

@section('title', 'Chỉnh sửa sản phẩm')

@section('content')
<div class="container">
    <h2 class="my-3">Chỉnh sửa sản phẩm</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Lỗi!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select name="category_id" class="form-control">
                <option value="">-- Chọn danh mục --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}">
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="base_price" class="form-label">Giá cơ bản</label>
            <input type="number" step="0.01" name="base_price" class="form-control" value="{{ $product->base_price }}">
            @error('base_price') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Ảnh hiện tại</label><br>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="100" alt="{{ $product->name }}"><br><br>
            @endif
            <input type="file" name="image" class="form-control">
            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
<div class="container">
    <hr>
    <h2 class="mt-4">Biến thể sản phẩm</h2>
    @foreach (['success', 'error'] as $msg)
        @if (session($msg))
            <div class="alert alert-{{ $msg == 'error' ? 'danger' : 'success' }}">
                {{ session($msg) }}
            </div>
        @endif
    @endforeach
    {{-- <a href="{{ route('variants.create',['product'=>$product->id]) }}" class="btn btn-sm btn-success mb-2">Thêm biến thể</a> --}}
    @include('admin.variants.create')
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Color</th>
                <th>Size</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($variants as $variant)
            <tr>
                <td>{{ $variant->id }}</td>
                <td>{{ $variant->name }}</td>
                <td>{{ $variant->color }}</td>
                <td>{{ $variant->size }}</td>
                <td>{{ number_format($variant->price, 0, ',', '.') }}đ</td>
                <td>{{ $variant->stock }}</td>
                <td>
                    <a href="{{ route('variants.edit', $variant->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('variants.destroy', $variant->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Chưa có biến thể nào</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
</>
@endsection
