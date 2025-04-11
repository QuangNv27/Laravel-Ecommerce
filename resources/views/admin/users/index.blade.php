@extends('admin.layouts.master')

@section('title', 'Danh sách người dùng')

@section('content')
<div class="container">
    <h2 class="my-3">Danh sách người dùng</h2>
    {{-- <a href="{{route('users.index')}}" class="btn btn-success">Thêm mới</a> --}}
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
                <th>Tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->role == 'admin')
                        <span class="badge bg-danger">Admin</span>
                    @else
                        <span class="badge bg-primary">Client</span>
                    @endif
                </td>
                <td>
                    {{-- {{ $user->status }} --}}
                    @if($user->status == 1)
                        <span class="badge bg-danger">Active</span>
                    @else
                        <span class="badge bg-primary">Unactive</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">Xem</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links('admin.pagination.bootstrap-5') }}
</div>
@endsection
