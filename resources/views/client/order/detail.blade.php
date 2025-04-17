@extends('client.layouts.master')
@section('content')
<div class="container my-5">
    <h3>Chi tiết đơn hàng</h3>
    <h6>Mã đơn hàng: #{{$id}}</h6>
    <table>
        <thead>
            <tr>
                <th>Tên</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order_items as $item)
            <tr>
                <td>{{$item->variant->name}} </td>
                <td> {{$item->quantity}} </td>
                <td> {{$item->price}} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
