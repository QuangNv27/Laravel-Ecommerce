@extends('admin.layouts.master')

@section('title', 'Danh sách danh mục')

@section('content')
<div class="container">
    <h2 class="my-3">Danh sách danh mục</h2>

    <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Thêm mới</a>

    {{-- Hiển thị thông báo flash --}}
    @foreach (['success', 'error'] as $msg)
        @if (session($msg))
            <div class="alert alert-{{ $msg == 'error' ? 'danger' : 'success' }}">
                {{ session($msg) }}
            </div>
        @endif
    @endforeach

    <table class="table table-bordered table-striped
    text-center
    ">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Thời gian tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                <td class="text-center">
                    {{-- <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a> --}}
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Không có danh mục nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $categories->links('admin.pagination.bootstrap-5') }}
    </div>
</div>
@endsection
