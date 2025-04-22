@extends('client.layouts.master')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @include('components.alerts')
        <h2>Xác nhận đơn hàng</h2>
        @if ($cart && $cart->cartItem->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Màu</th>
                        <th>Size</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart->cartItem as $item)
                        <tr>
                            <td>{{ $item->variant->product->name }}</td>
                            <td>{{ $item->variant->color }}</td>
                            <td>{{ $item->variant->size }}</td>
                            <td>{{ number_format($item->variant->price, 0, ',', '.') }} đ</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->variant->price * $item->quantity, 0, ',', '.') }} đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="my-3">
                <form action="{{ route('checkout.applyVoucher') }}" method="POST" class="d-inline-block">
                    @csrf
                    <label>Mã giảm giá:</label>
                    <input type="text" name="code" class="form-control d-inline-block w-auto" required>
                    <button class="btn btn-primary btn-sm">Áp dụng</button>
                </form>

                @if ($voucher)
                    <form action="{{ route('checkout.removeVoucher') }}" method="POST" class="d-inline-block">
                        @csrf
                        <button class="btn btn-warning btn-sm">Hủy mã "{{ $voucher->code }}"</button>
                    </form>
                @endif
            </div>

            <hr>
            <p>Tạm tính: <strong>{{ number_format($subtotal, 0, ',', '.') }} đ</strong></p>
            @if ($discount)
                <p>Giảm giá: <strong>-{{ number_format($discount, 0, ',', '.') }} đ</strong></p>
            @endif
            <h4>Tổng cộng: <strong>{{ number_format($total, 0, ',', '.') }} đ</strong></h4>
            <form action="{{ route('order.place') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="address">Địa chỉ nhận hàng</label>
                    <input type="text" name="shipping_address" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Đặt hàng</button>
            </form>
        @else
            <p>Giỏ hàng đang trống.</p>
        @endif
    </div>
@endsection
