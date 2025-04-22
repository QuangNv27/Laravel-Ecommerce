@extends('client.layouts.master')

@section('content')
    <div class="container">
        @include('components.alerts')
        <h2 class="my-4">Danh sách Đơn hàng của bạn</h2>
        @foreach ($orders as $order)
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><strong>Mã đơn hàng:</strong> #{{ $order->id }}</span>
                    @if ($order->voucher)
                        <span><strong>Voucher:</strong> {{ $order->voucher->code }}</span>
                        <span><strong>Giảm giá:</strong> {{ number_format($order->discount_amount, 0, ',', '.') }} đ</span>
                    @endif
                    <span><strong>Thanh toán:</strong> {{ number_format($order->final_total, 0, ',', '.') }} đ</span>
                    <span><strong>Trạng thái:</strong>
                        @switch($order->status)
                            @case('pending')
                                <span class="badge bg-warning text-dark">Chờ xử lý</span>
                            @break

                            @case('processing')
                                <span class="badge bg-info text-dark">Đang xử lý</span>
                            @break

                            @case('shipped')
                                <span class="badge bg-primary">Đang ship</span>
                            @break

                            @case('delivered')
                                <span class="badge bg-success">Đã thanh toán</span>
                            @break

                            @case('cancelled')
                                <span class="badge bg-danger">Đã hủy</span>
                            @break

                            @default
                                <span class="badge bg-secondary">Không xác định</span>
                        @endswitch
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
                            @foreach ($order->orderItems as $item)
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
                            <form action="{{ route('order.cancel', $order->id) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này?');">
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
