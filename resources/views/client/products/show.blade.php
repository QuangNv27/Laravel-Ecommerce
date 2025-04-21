@extends('client.layouts.master')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <!-- Hiển thị hình ảnh sản phẩm trong một card -->
                <div class="card">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <!-- Thông tin chi tiết sản phẩm -->
                <div class="card p-4">
                    <h2>{{ $product->name }}</h2>
                    <p><strong>Giá:</strong> {{ number_format($product->base_price, 0, ',', '.') }} VND</p>

                    <!-- Chọn biến thể -->
                    <h5 class="mt-4">Chọn Biến Thể</h5>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="variant">Chọn màu + kích thước</label>
                            <select name="variant_id" id="variant" class="form-control" required>
                                <option value="">-- Chọn biến thể --</option>
                                @foreach ($product->variants as $variant)
                                    <option value="{{ $variant->id }}">
                                        {{ $variant->color }} - {{ $variant->size ?? $variant->ram . '/' . $variant->rom }}
                                        @if ($variant->price)
                                            - {{ number_format($variant->price, 0, ',', '.') }} đ
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="quantity">Số lượng</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="1"
                                min="1" required>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">🛒 Thêm vào giỏ hàng</button>
                        </div>
                    </form>
                    @if (auth()->check())
                        <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit">Thêm vào danh sách yêu thích</button>
                        </form>
                    @else
                        <p class="mt-4"><a href="{{ route('login') }}">Đăng nhập</a> để thêm vào wishlist.</p>
                    @endif



                    <!-- Bảng các biến thể sản phẩm -->
                    <h5 class="mt-4">Biến thể của sản phẩm</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Màu</th>
                                <th>Kích thước</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->variants as $variant)
                                <tr>
                                    <td>{{ $variant->color }}</td>
                                    <td>{{ $variant->size }}</td>
                                    <td>{{ number_format($variant->price, 0, ',', '.') }} VND</td>
                                    <td>{{ $variant->stock }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Mô tả sản phẩm -->
        <div class="card mt-4 p-4">
            <p><strong>Mô tả:</strong> {{ $product->description ?? 'Chưa có mô tả' }}</p>
        </div>
    </div>
@endsection
