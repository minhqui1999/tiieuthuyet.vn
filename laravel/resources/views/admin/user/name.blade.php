@extends('layouts.admin')
@section('title', 'Quản trị')
@section('smallTitle', 'Đổi tên')
@section('content')
        @include('admin.block.error')
        <div class="box box-primary"><div class="box-body">
        <form action="{{ route('dashboard.changename') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label>Tên mới</label>
                <input type="text" class="form-control" name="txtName" placeholder="Tên mới" />
            </div>
            <div class="form-group">
                <label>Xác nhận mật khẩu</label>
                <input type="password" class="form-control" name="txtPassword" placeholder="Nhập mật khẩu" />
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <button type="reset" class="btn btn-default">Làm lại</button>
            <form>
    </div></div>
@endsection()
