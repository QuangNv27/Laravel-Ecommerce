@extends('admin.layouts.master')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded-3">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Chi tiết sản phẩm</h4>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">ID:</div>
                <div class="col-md-9">{{ $product->id }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Danh mục:</div>
                <div class="col-md-9">{{ optional($product->category)->name ?? 'Chưa có danh mục' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Tên sản phẩm:</div>
                <div class="col-md-9">{{ $product->name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Mô tả:</div>
                <div class="col-md-9">{{ $product->description }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Giá:</div>
                <div class="col-md-9 text-danger">{{ number_format($product->base_price, 0, ',', '.') }} đ</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Ảnh:</div>
                <div class="col-md-9">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow-sm" style="max-width: 200px;" alt="{{ $product->name }}">
                    @else
                        <span class="text-muted">Không có ảnh</span>
                    @endif
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">← Quay lại</a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Sửa</a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <hr>
    <h2 class="mt-4">Biến thể sản phẩm</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Color</th>
                <th>Size</th>
                <th>Price</th>
                <th>Stock</th>
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
            </tr>
            @empty
            <tr>
                <td colspan="5">Chưa có biến thể nào</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
