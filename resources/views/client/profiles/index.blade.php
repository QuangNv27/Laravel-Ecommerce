@extends('client.layouts.master')

@section('content')
    <div class="container py-5">
        <h2 class="text-uppercase text-center mb-4">Thông tin tài khoản</h2>

        {{-- Hiển thị thông báo khi cập nhật thành công --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Hiển thị lỗi nếu có --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form cập nhật thông tin --}}
        <form action="{{ route('profile.update') }}" method="POST" class="mb-5">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">Họ tên</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', auth()->user()->name) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control"
                        value="{{ old('phone', auth()->user()->phone) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" name="address" class="form-control"
                        value="{{ old('address', auth()->user()->address) }}">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                </div>
            </div>
        </form>

        {{-- Form đổi mật khẩu --}}
        <h4 class="text-uppercase mb-3">Đổi mật khẩu</h4>
        <form action="{{ route('profile.change-password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-md-4">
                    <label class="form-label">Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" class="form-control">
                    @error('current_password')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Mật khẩu mới</label>
                    <input type="password" name="new_password" class="form-control">
                    <x-error field="new_password" />
                </div>

                <div class="col-md-4">
                    <label class="form-label">Xác nhận mật khẩu mới</label>
                    <input type="password" name="new_password_confirmation" class="form-control">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-warning">Đổi mật khẩu</button>
                </div>
            </div>
        </form>
    </div>
@endsection
