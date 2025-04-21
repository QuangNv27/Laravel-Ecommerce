@extends('client.layouts.master')

@section('content')
<div class="container">
    <h2>Giỏ hàng của bạn</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-info">{{ session('error') }}</div>
    @endif
    @if(!$cart || $cart->cartItem->isEmpty())
        <p>Giỏ hàng đang trống.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Màu</th>
                    <th>Size</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->cartItem as $item)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $item->variant->product->image) }}" alt="" width="50">
                            {{ $item->variant->product->name }}
                        </td>
                        <td>{{ $item->variant->color }}</td>
                        <td>{{ $item->variant->size }}</td>
                        <td>{{ number_format($item->variant->price, 0, ',', '.') }} đ</td>
                        <td>
                            <form action="{{ route('cart.updateQuantity', $item->id) }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->variant->stock }}" class="form-control w-50 me-2">
                                <button type="submit" class="btn btn-sm btn-success">Cập nhật</button>
                            </form>
                        </td>
                        <td>{{ number_format($item->variant->price * $item->quantity, 0, ',', '.') }} đ</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Xác nhận xóa sản phẩm khỏi giỏ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">🗑</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('checkout.show') }}" class="btn btn-primary">Tiến hành thanh toán</a>
        <div class="mt-4">
            <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn hủy toàn bộ giỏ hàng?');">
                @csrf
                <button type="submit" class="btn btn-danger mb-3">🗑 Hủy toàn bộ giỏ hàng</button>
            </form>
        </div>
        <div class="text-end">
            <h4>Tổng cộng: {{ number_format($cart->total_amount, 0, ',', '.') }} đ</h4>
        </div>
    @endif
</div>
@endsection