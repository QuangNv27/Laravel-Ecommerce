@extends('client.layouts.master')

@section('content')
    <div class="container py-5">
        <h3 class="mb-4">Danh sách yêu thích</h3>

        @forelse ($wishlistItems as $wishlistItem)
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <a href="{{ route('clientShowProduct', $wishlistItem->product->id) }}">
                            <img src="{{ asset('storage/' . $wishlistItem->product->image) }}" class="img-fluid rounded-start" alt="{{ $wishlistItem->product->name }}" style="object-fit: cover; height: 150px;">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('clientShowProduct', $wishlistItem->product->id) }}" class="text-dark text-decoration-none">
                                    {{ $wishlistItem->product->name }}
                                </a>
                            </h5>
                            <p class="card-text">{{ Str::limit($wishlistItem->product->description, 100) }}</p>
                            <p class="card-text">
                                <strong>{{ number_format($wishlistItem->product->base_price, 0, ',', '.') }}đ</strong>
                            </p>
                            <form action="{{ route('wishlist.remove', $wishlistItem->product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Xóa khỏi wishlist</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>Danh sách yêu thích của bạn trống.</p>
        @endforelse
    </div>
@endsection
