@extends('admin.layouts.master')

@section('title', 'Chỉnh sửa người dùng')

@section('content')
<div class="container">
    <h2 class="my-3">Chỉnh sửa người dùng</h2>

    @if(session('errors'))
        <div class="alert alert-danger">{{ session('errors') }}</div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên người dùng</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" disabled>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" disabled>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Vai trò</label>
            <select name="role" class="form-control" required>
                <option value="client" {{ $user->role == 'client' ? 'selected' : '' }}>Client</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-control" required>
                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Unactive</option>
            </select>
            @error('status') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
