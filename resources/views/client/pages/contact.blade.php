@extends('client.layouts.master')

@section('content')
<div class="container py-5">
    <h2 class="text-uppercase text-center mb-4">Liên hệ với chúng tôi</h2>
    <div class="row g-4">
        <div class="col-md-6">
            <h5>Thông tin liên hệ</h5>
            <ul class="list-unstyled">
                <li><strong>Địa chỉ:</strong> 123 Đường ABC, Quận 1, TP.HCM</li>
                <li><strong>Email:</strong> contact@example.com</li>
                <li><strong>Hotline:</strong> 0909 123 456</li>
            </ul>
            <div class="mt-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18..." width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        <div class="col-md-6">
            <h5>Gửi tin nhắn</h5>
            <form action="{{ route('contact') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Họ tên</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Địa chỉ Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Nội dung</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Gửi</button>
            </form>
        </div>
    </div>
</div>
@endsection
