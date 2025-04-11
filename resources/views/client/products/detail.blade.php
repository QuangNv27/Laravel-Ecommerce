@extends('client.layouts.master')
@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Cột ảnh sản phẩm -->
        <div class="col-md-6">
            <div class="border rounded p-3">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid w-100" alt="{{ $product->name }}">
            </div>
        </div>

        <!-- Cột thông tin sản phẩm -->
        <div class="col-md-6">
            <h2 class="mb-3">{{ $product->name }}</h2>

            <p>
                <strong>Danh mục:</strong>
                <span class="badge bg-secondary">{{ $product->category->name }}</span>
            </p>

            <h4 class="text-danger">{{ number_format($product->base_price, 2) }} đ</h4>

            <hr>

            <div>
                <h5>Mô tả sản phẩm:</h5>
                @if($product->description)
                    <p>{{ $product->description }}</p>
                @else
                    <p class="text-muted fst-italic">Chưa có mô tả sản phẩm.</p>
                @endif
            </div>
            @if($product->variants && $product->variants->count())
            @foreach($product->variants as $variant)
            <form action="/add-cart/{{$product->id}}/{{$variant->id}}/{{Auth::user()->id}}/{{$variant->price}}" method="POST">
                @csrf
                <div>
                    <label for="">{{ $variant->name}} : {{ number_format($variant->price, 2) }} đ</label>
                    <button>+</button>
                </div>
            </form>
            @endforeach
            @endif
            {{-- <button class="btn btn-primary mt-3">
                <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
            </button> --}}
        </div>
    </div>

    {{-- Nếu có biến thể sản phẩm --}}
    {{-- @if($product->variants && $product->variants->count()) --}}
        {{-- <div class="row mt-5">
            <div class="col-12">
                <h4>Biến thể sản phẩm</h4>
                <ul class="list-group">
                    @foreach($product->variants as $variant)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <button>{{ $variant->name ?? 'Tên biến thể' }}</button>
                            <span class="badge bg-info text-dark">{{ number_format($variant->price, 2) }} đ</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div> --}}
    {{-- @endif --}}
</div>
@endsection

