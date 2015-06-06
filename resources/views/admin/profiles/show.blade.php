@extends('layout/admin')

@section('title')
    Thông tin người dùng
@stop

@section('content')
<div class="container">
  <div class="page-header">
    <h1><small>Thông tin người dùng</small> {{ Auth::user()->name }}</h1>
  </div>
  <div class="center">
    @if (is_null($profile->avatar))
      <img src="/image/profiles/user.jpg" alt="User" class="img-circle">
    @else
      <img src="{{ $profile->avatar }}" alt="User" class="img-circle">
    @endif
  </div>
  <div class="container-fluid">
    <div class="list-group">
      <span class="list-group-item"><b>Họ tên: </b>{{ $profile->lname }} {{ $profile->fname }}</span>
      <span class="list-group-item"><b>Chức vụ: </b>{{ $profile->position }}</span>
      <span class="list-group-item"><b>Số điện thoại: </b>{{ $profile->numberphone }}</span>
      <span class="list-group-item"><b>Email: </b>{{ $profile->email }}</span>
      <span class="list-group-item"><b>Chi tiết: </b>{{ $profile->detail }}</span>
      <span class="list-group-item"><b>Ngày sinh: </b>{{ $profile->birthday }}</span>
    </div>
    <div class="right">
      <a href="{{ $profile->user_id }}/edit" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> Edit </span></a>
    </div>
  </div>
</div>
@endsection