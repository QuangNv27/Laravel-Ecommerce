@extends('admin.layouts.master')

@section('content')
    <div class="container mt-4">
        <h2>Tạo Voucher Mới</h2>

        <form action="{{ route('vouchers.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="code" class="form-label">Mã voucher</label>
                <input type="text" class="form-control" id="code" name="code" required>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Loại</label>
                <select name="type" class="form-control" required>
                    <option value="fixed">Giảm tiền (VNĐ)</option>
                    <option value="percentage">Phần trăm (%)</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="value" class="form-label">Giá trị giảm</label>
                <input type="number" step="0.01" name="value" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="min_order_amount" class="form-label">Giá trị đơn hàng tối thiểu</label>
                <input type="number" step="0.01" name="min_order_amount" class="form-control">
            </div>

            <div class="mb-3">
                <label for="expires_at" class="form-label">Hạn sử dụng</label>
                <input type="datetime-local" name="expires_at" class="form-control">
            </div>

            <div class="mb-3">
                <label for="usage_limit" class="form-label">Số lượt sử dụng tối đa</label>
                <input type="number" name="usage_limit" class="form-control">
            </div>

            <div class="mb-3">
                <label for="per_user_limit" class="form-label">Giới hạn mỗi người dùng</label>
                <input type="number" name="per_user_limit" class="form-control">
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" checked>
                <label class="form-check-label">Kích hoạt voucher</label>
            </div>

            <button type="submit" class="btn btn-success">Tạo voucher</button>
            <a href="{{ route('vouchers.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
