@extends('admin.layouts.master')

@section('title', 'Danh sách sản phẩm')

@section('content')
<div class="container">
    <h2 class="my-3">Danh sách sản phẩm</h2>
    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Thêm mới sản phẩm</a>

    @foreach (['success', 'error'] as $msg)
        @if (session($msg))
            <div class="alert alert-{{ $msg == 'error' ? 'danger' : 'success' }}">
                {{ session($msg) }}
            </div>
        @endif
    @endforeach

    <table class="table table-bordered text-center ">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Danh mục</th>
                <th>Tên</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ optional($product->category)->name }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ number_format($product->base_price, 0, ',', '.') }}đ</td>
                <td>
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" width="50" alt="{{ $product->name }}">
                    @endif
                </td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">Xem</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Xóa sản phẩm này?')" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('admin.pagination.bootstrap-5') }}
    </div>
</div>
@endsection
