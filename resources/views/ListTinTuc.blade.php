@extends('admin.layouts.MasterLayout')

@section('title', 'Danh Sách Tin Tức')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-uppercase text-primary">Danh Sách Tin Tức</h2>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered shadow">
            <thead class="bg-primary text-white text-center">
                <tr>
                    <th>ID</th>
                    <th>Tiêu Đề</th>
                    <th>Tác Giả</th>
                    <th>Ngày Đăng</th>
                    <th>Trích Đoạn</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tinTucs as $key => $tinTuc)
                <tr>
                    <td class="text-center fw-bold">{{ $tinTuc->id }}</td>
                    <td class="fw-semibold">{{ $tinTuc->tieu_de }}</td>
                    <td>{{ $tinTuc->tac_gia }}</td>
                    <td class="text-center text-muted">
                        {{ date('d-m-Y H:i', strtotime($tinTuc->ngay_dang)) }}
                    </td>
                    <td>{{ Str::limit($tinTuc->noi_dung, 100) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

