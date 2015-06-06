@extends('layout/admin')

@section('title')
    Chỉnh sửa người dùng
@stop

@section('content')
<div class="container">
    <h2>Chỉnh sửa người dùng</h2>
    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['admin.users.update', $user->id]]) !!}
      @include('admin/users/partials/_form', ['submit_text' => 'Chỉnh sửa người dùng'])
    {!! Form::close() !!}
</div>
@endsection