@extends('layouts.admin')
@section('title', 'Báo cáo')
@section('smallTitle', 'danh sách')
@section('content')
<!-- /.col-lg-12 -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=764582287768925&autoLogAppEvents=1" nonce="QKJ7SiB8"></script>
<div id="result"></div>

<div class="box box-primary">
  <div class="box-header with-border">
      <h3 class="box-title">Quản lý báo cáo</h3>
  </div>
  <div class="box-body">

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Tên chương</th>
            <th>Nội dung</th>
            <th>Công cụ</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr class="odd gradeX" align="center">
            <td>{{ $item->id }}</td>
            <td>{{ $item->chapter->name }}</td>
            <td>{{ $item->message }}</td>
            <td class="center">
                <form action="{{ route('dashboard.report.destroy', $item->id) }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return areYouSureDeleteIt('Bạn có chắc là muốn hủy nó không ?');"><i class="fa fa-trash-o  fa-fw"></i> Đã giải quyết</button>

                    <a class="btn btn-primary btn-xs" href="{{ URL::route('dashboard.chapter.edit', $item->chapter->id) }}">
                        <i class="fa fa-pencil fa-fw"></i> Sửa chương
                    </a>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $data->links() !!}
</div>
<br><hr>
<div id="fb" class="fb-comments" data-href="https://tieuthuyet.vn/" data-width="100%" data-numposts="5" data-colorscheme="light" fb-xfbml-state="rendered"></div>
</div>
@endsection
