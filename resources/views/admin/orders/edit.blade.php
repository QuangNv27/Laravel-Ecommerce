@extends('admin.layouts.master')

@section('content')
<h1>Chi tiết & Cập nhật đơn hàng #{{ $order->id }}</h1>

{{-- Thông tin người đặt --}}
<div class="mb-3">
    <strong>Khách hàng:</strong> {{ $order->user->name ?? '---' }} <br>
    <strong>Email:</strong> {{ $order->user->email ?? '---' }} <br>
    <strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}
</div>

{{-- Bảng sản phẩm --}}
<h4>Sản phẩm trong đơn</h4>
<table class="table table-bordered">
    <thead>
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
            <td>{{ $item->variant->color ?? '' }} - {{ $item->variant->size ?? '' }}</td>
            <td>{{ number_format($item->price) }}₫</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->price * $item->quantity) }}₫</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Tổng tiền --}}
<p class="mt-3"><strong>Tổng tiền đơn hàng:</strong> {{ number_format($order->total_price) }}₫</p>

<hr>
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

    <div class="form-group">
        <label for="status">Trạng thái đơn hàng</label>
        <select name="status" id="status" class="form-control w-25">
            @foreach(['pending' => 'Chờ xác nhận', 'processing' => 'Đang xử lý', 'shipped' => 'Đã giao cho vận chuyển', 'delivered' => 'Đã giao thành công', 'canceled' => 'Đã huỷ'] as $value => $label)
                <option value="{{ $value }}" {{ $order->status == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Cập nhật trạng thái</button>
</form>
@endsection
