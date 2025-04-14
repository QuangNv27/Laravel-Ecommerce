@extends('admin.layouts.master')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Chi tiết & Cập nhật đơn hàng #{{ $order->id }}</h1>

    {{-- Thông tin khách hàng --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Thông tin khách hàng</h5>
            <p><strong>Họ tên:</strong> {{ $order->user->name ?? '---' }}</p>
            <p><strong>Email:</strong> {{ $order->user->email ?? '---' }}</p>
            <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    {{-- Sản phẩm trong đơn --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Danh sách sản phẩm</h5>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Biến thể</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->variant->product->name ?? '---' }}</td>
                        <td>{{ $item->variant->color ?? 'Không có' }} - {{ $item->variant->size ?? 'Không có' }}</td>
                        <td>{{ number_format($item->price) }}₫</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price * $item->quantity) }}₫</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Thông tin voucher (nếu có) --}}
    @if ($order->voucher)
    <div class="alert alert-info">
        <strong>Mã giảm giá:</strong> {{ $order->voucher->code }} <br>
        <strong>Hình thức:</strong> 
        {{ $order->voucher->type == 'percentage' ? 'Giảm ' . $order->voucher->value . '%' : 'Giảm ' . number_format($order->voucher->value) . '₫' }}
    </div>
    @endif

    {{-- Tổng tiền --}}
    <div class="mb-4">
        <p><strong>Tổng tiền trước giảm:</strong> {{ number_format($order->total_price) }}₫</p>
        @if ($order->discount_amount > 0)
            <p><strong>Giảm giá:</strong> -{{ number_format($order->discount_amount) }}₫</p>
            <p><strong>Tổng tiền sau giảm:</strong> {{ number_format($order->total_price - $order->discount_amount) }}₫</p>
        @endif
    </div>

    {{-- Thông báo --}}
    @foreach (['success', 'error'] as $msg)
        @if (session($msg))
            <div class="alert alert-{{ $msg == 'error' ? 'danger' : 'success' }}">
                {{ session($msg) }}
            </div>
        @endif
    @endforeach

    {{-- Form cập nhật trạng thái --}}
    <form method="POST" action="{{ route('orders.update', $order) }}">
        @csrf
        @method('PUT')

        <div class="form-group w-25">
            <label for="status">Trạng thái đơn hàng</label>
            <select name="status" id="status" class="form-control">
                @foreach([
                    'pending' => 'Chờ xác nhận', 
                    'processing' => 'Đang xử lý', 
                    'shipped' => 'Đã giao cho vận chuyển', 
                    'delivered' => 'Đã giao thành công', 
                    'canceled' => 'Đã huỷ'] as $value => $label)
                    <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Cập nhật trạng thái</button>
    </form>
    <a href="{{route('orders.index')}}" class="btn btn-outline-dark mb-3 mt-3">
        ← Quay lại danh sách
    </a>
</div>
@endsection
