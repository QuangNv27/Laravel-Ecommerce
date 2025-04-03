@extends('admin.layouts.master')

@section('content')
    <h1>Chi tiết người dùng</h1>

    <table class="table table-bordered">
        <tr>
            <th>ID:</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Tên:</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Vai trò:</th>
            <td>{{ $user->role }}</td>
        </tr>
        <tr>
            <th>Trạng thái:</th>
            <td>{{ $user->status == 1 ? 'Active' : 'Unactive' }}</td>
        </tr>
    </table>

    <a href="{{ route('users.index') }}" class="btn btn-primary">Quay lại</a>
@endsection
