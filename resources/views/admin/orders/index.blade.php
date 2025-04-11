@extends('admin.layouts.master')

@section('content')
<h1>Danh sách đơn hàng</h1>

<table class="table table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Ngày đặt</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name ?? '---' }}</td>
            <td>{{ number_format($order->total_price) }}₫</td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
            <td 
            {{-- class="text-center" --}}
            >
                <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-warning">Chi tiết</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $orders->links() }}
@endsection
