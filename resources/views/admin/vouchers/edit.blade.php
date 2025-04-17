@extends('admin.layouts.master')

@section('content')
    <div class="container mt-4">
        <h2>Thay đổi trạng thái Voucher</h2>

        <form action="{{ route('vouchers.update', $voucher->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Mã voucher</label>
                <input type="text" class="form-control" value="{{ $voucher->code }}" disabled>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="is_active" class="form-check-input" value="1" id="is_active" {{ $voucher->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Kích hoạt</label>
            </div>

            <button type="submit" class="btn btn-success">Cập nhật trạng thái</button>
            <a href="{{ route('vouchers.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
