@extends('admin.layouts.master')

@section('content')
    <div class="container mt-4">
        <h2>Chi tiết Voucher</h2>

        <div class="card mt-3">
            <div class="card-body">
                <p><strong>Mã:</strong> {{ $voucher->code }}</p>
                <p><strong>Loại:</strong> {{ $voucher->type }}</p>
                <p><strong>Giá trị:</strong>
                    {{ $voucher->type === 'percentage' ? $voucher->value . '%' : number_format($voucher->value, 0, ',', '.') . ' đ' }}
                </p>
                <p><strong>Đơn hàng tối thiểu:</strong> {{ number_format($voucher->min_order_amount, 0, ',', '.') }} đ</p>
                <p><strong>Hạn sử dụng:</strong>
                    {{ $voucher->expires_at ? \Carbon\Carbon::parse($voucher->expires_at)->format('d/m/Y H:i') : 'Không giới hạn' }}
                </p>
                <p><strong>Giới hạn người dùng:</strong> {{ $voucher->per_user_limit ?? 'Không giới hạn' }}</p>
                <p><strong>Số lượt sử dụng tối đa:</strong> {{ $voucher->usage_limit ?? 'Không giới hạn' }}</p>
                <p><strong>Đã sử dụng:</strong> {{ $voucher->used_count }}</p>
                <p><strong>Kích hoạt:</strong> {{ $voucher->is_active ? '✔️' : '❌' }}</p>
            </div>
        </div>

        <a href="{{ route('vouchers.index') }}" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
    </div>
@endsection
