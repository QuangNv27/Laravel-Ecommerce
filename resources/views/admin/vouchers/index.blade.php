@extends('admin.layouts.master')

@section('content')
    <div class="container mt-4">
        <h2>Danh sách Voucher</h2>

        <a href="{{ route('vouchers.create') }}" class="btn btn-primary mb-3">+ Tạo voucher mới</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered text-center table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Mã</th>
                    <th>Loại</th>
                    <th>Giá trị</th>
                    <th>HSD</th>
                    <th>Kích hoạt?</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vouchers as $voucher)
                    <tr>
                        <td>{{ $voucher->code }}</td>
                        <td>{{ $voucher->type }}</td>
                        <td>
                            {{ $voucher->type === 'percentage' ? $voucher->value . '%' : number_format($voucher->value, 0, ',', '.') . ' đ' }}
                        </td>
                        <td>{{ $voucher->expires_at ? \Carbon\Carbon::parse($voucher->expires_at)->format('d/m/Y H:i') : 'Không giới hạn' }}</td>
                        <td>{{ $voucher->is_active ? '✔️' : '❌' }}</td>
                        <td>
                            <a href="{{ route('vouchers.show', $voucher->id) }}" class="btn btn-info btn-sm">Xem</a>
                            <a href="{{ route('vouchers.edit', $voucher->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
