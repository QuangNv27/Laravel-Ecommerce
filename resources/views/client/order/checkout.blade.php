@extends('client.layouts.master')
@section('content')
<div class="container my-5">
    <h3>Đơn hàng</h3>
    @if ($cart != NULL)
    <table>
        <thead>
            <tr>
                <th>Tên</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart_items as $item)
                <tr>
                    <td>{{$item->variant->name}}</td>
                    <td> {{$item->quantity}} </td>
                    <td> {{ $item->variant->price}} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form action="" method="POST">
        @csrf
        <div>
            <label for="">Tổng giá</label>
            <input type="text" disabled value='{{$cart->total_amount}}'>
        </div>
        <div>
            <label for="">Phí ship</label>
            <input type="text" disabled value="15000">
        </div>
        <div>
            <label for="">Tổng đơn hàng</label>
            <input type="text" disabled value="{{$cart->total_amount + 15000}}">
        </div>
        <div>
            <button class="btn">Thanh toán</button>
        </div>
    </form>
    @endif
    @if ($orders != NULL)
    <table>
        <thead>
            <tr>
                <th>Tổng giá</th>
                <th>Phí ship</th>
                <th>Tổng đơn hàng</th>
                <th>Ngày mua</th>
                <th>Trạng thái</th>
                <th>Xem chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td> {{$order->total_price}} </td>
                <td> {{$order->shipping_fee}} </td>
                <td> {{$order->final_total}} </td>
                <td> {{$order->created_at}} </td>
                @php
    $statusLabels = [
        'pending' => 'Chờ xác nhận',
        'processing' => 'Đang xử lý',
        'shipped' => 'Đã giao cho vận chuyển',
        'delivered' => 'Đã giao thành công',
        'canceled' => 'Đã huỷ',
    ];
@endphp
                <td> 
                    {{ $statusLabels[$order->status] ?? 'Không xác định' }}   
                </td>
                <td> <a href="/checkout/{{$order->id}}">Xem</a> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h5>Không tìm thấy đơn hàng</h5>
    @endif
</div>
@endsection
