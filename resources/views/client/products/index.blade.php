@extends('client.layouts.master')
@section('content')
    @if ($errors)
        <ul>
            @foreach ($errors as $key => $value)
                <li>{{ $value }}</li>
            @endforeach
        </ul>
    @endif
    {{-- Danh sách sản phẩm --}}
    <div class="container py-5">
        @if (request('s'))
            <p class="text-muted">Kết quả tìm kiếm cho: <strong>{{ request('s') }}</strong></p>
        @endif
        <div class="row">
            @if ($products->isEmpty())
                {{-- Kiểm tra nếu không có sản phẩm --}}
                <p class="text-muted">Không có sản phẩm phù hợp với từ khóa tìm kiếm.</p>
            @else
                @foreach ($products as $product)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="product-item image-zoom-effect link-effect border rounded shadow-sm h-100">
                            <div class="image-holder position-relative">
                                <a href="{{ route('clientShowProduct', $product->id) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="product-image img-fluid w-100" style="object-fit: cover; height: 200px;">
                                </a>
                            </div>
                            <div class="product-content p-2">
                                <h5 class="text-uppercase fs-6 mb-1">
                                    <a href="{{ route('clientShowProduct', $product->id) }}"
                                        class="text-dark text-decoration-none">{{ $product->name }}</a>
                                </h5>
                                <div class="text-danger fw-bold">
                                    {{ number_format($product->base_price, 0, ',', '.') }}đ
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        {{-- Hiển thị phân trang --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('admin.pagination.bootstrap-5') }}
        </div>
    </div>
    {{-- End Danh sách sản phẩm --}}
@endsection
