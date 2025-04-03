@extends('admin.layouts.MasterLayout')

@section('title-page', 'Danh Sách Nhân Viên')

@section('card-body')
<div class="container mt-5">
    <h2 class="text-center text-uppercase text-primary">Danh Sách Nhân Viên</h2>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered shadow">
            <thead class="bg-primary text-white text-center">
                <tr>
                    <th>ID</th>
                    <th>Họ Tên</th>
                    <th>Email</th>
                    <th>Ngày Sinh</th>
                    <th>Giới Tính</th>
                    <th>Lương</th>
                    <th>Phòng Ban</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nhanViens as $nv)
                <tr>
                    <td class="text-center fw-bold">{{ $nv->id }}</td>
                    <td class="fw-semibold">{{ $nv->ho_ten }}</td>
                    <td>{{ $nv->email }}</td>
                    <td class="text-center text-muted">{{ date('d-m-Y', strtotime($nv->ngay_sinh)) }}</td>
                    <td class="text-center">{{ $nv->gioi_tinh ? 'Nam' : 'Nữ' }}</td>
                    <td class="text-end text-success fw-bold">{{ number_format($nv->luong, 2) }} VNĐ</td>
                    <td class="text-center">{{ $nv->phong_ban }}</td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                            <button type="button" class="btn btn-outline-primary">Xem</button>
                            <button type="button" class="btn btn-outline-primary">Sửa</button>
                            <button type="button" class="btn btn-outline-primary">Xóa</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $nhanViens->links() }}
    </div>
</div>
@endsection

@section('card-header')
<h3 class="card-title">Card-header</h3>
<div class="card-tools">
    {{-- <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"
        title="Collapse">
        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
    </button>
    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"
        title="Remove">
        <i class="bi bi-x-lg"></i>
    </button> --}}
    <a href="" class="btn btn-success">Thêm nhân viên</a>
</div>
@endsection

@section('card-footer')
    Đây là card footer
@endsection
