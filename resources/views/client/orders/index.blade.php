@extends('client.layouts.master')

@section('content')
<div class="container">
    <h2 class="my-4">Danh sách Đơn hàng của bạn</h2>

    @foreach($orders as $order)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><strong>Mã đơn hàng:</strong> #{{ $order->id }}</span>
                <span><strong>Tổng:</strong> {{ number_format($order->final_total, 0, ',', '.') }} đ</span>
                <span><strong>Trạng thái:</strong> 
                    <span class="text">{{ $order->status }}</span>
                </span>
            </div>
            <div class="card-body">
                <h5 class="card-title">Chi tiết sản phẩm</h5>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Màu</th>
                            <th>Size</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->variant->product->name }}</td>
                                <td>{{ $item->variant->color }}</td>
                                <td>{{ $item->variant->size }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($order->status === 'pending')
                <div class="mt-4">
                    <form action="{{ route('order.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này?');">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">❌ Hủy đơn</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection

