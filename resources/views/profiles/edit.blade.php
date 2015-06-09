@extends('layout/teacher')

@section('title')
    Chỉnh sửa người dùng
@stop

@section('content')
<div class="container">
    <h2 class="name-product center">Chỉnh sửa người dùng</h2>
  
    <form class="form-horizontal" role="form" method="POST" action="update" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      
      <div class="form-group">
        <label class="col-md-4 control-label">Họ: </label>
        <div class="col-md-6">
          <input type="text" class="form-control" name="lname" value="{{ $profile->lname }}">
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label">Tên: </label>
        <div class="col-md-6">
          <input type="text" class="form-control" name="fname" value="{{ $profile->fname }}">
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label">Chức vụ: </label>
        <div class="col-md-6">
          <input type="text" class="form-control" name="position" value="{{ $profile->position }}">
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label">Chi tiết: </label>
        <div class="col-md-6">
          <input type="text" class="form-control" name="detail" value="{{ $profile->detail }}">
        </div>
      </div>


      <div class="form-group row">
        {!! Form::label('avatar', 'Chọn hình đại diện: ', array('class' => 'col-md-4 control-label')) !!}
        <div class="col-xs-6">
          {!! Form::file('avatar') !!}
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label">Ngày sinh: </label>
        <div class="col-md-6">
          {!! Form::input('date', 'birthday') !!}
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-6 col-md-offset-4 right">
          <button type="submit" class="btn btn-default">Xác nhận</button>
        </div>
      </div>
    </form>
</div>
@endsection