@extends('admin.layouts.master')

@section('title', 'Cập nhật tồn kho biến thể')

@section('content')
<div class="container">
    <h2 class="my-3">Cập nhật tồn kho</h2>

    <form action="{{ route('variants.update', $variant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Màu sắc</label>
            <input type="text" class="form-control" value="{{$variant->color}}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Size</label>
            <input type="text" class="form-control" value="{{ $variant->size }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="text" name="price" class="form-control" value="{{ $variant->price}}">
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Số lượng tồn kho</label>
            <input type="number" name="stock" class="form-control" value="{{ $variant->stock }}" required min="0">
            @error('stock') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn chắc chắn muốn cập nhật tồn kho?')">Xác nhận</button>
        <a href="{{ route('products.edit', $variant->product_id) }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
