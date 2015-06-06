@extends('layout/layout')

@section('title')
    Tạo người dùng
@stop

@section('content')
<div class="container">
    <h2>Tạo người dùng</h2>

    {!! Form::model(new App\User, ['route' => ['admin.users.store']]) !!}
        @include('admin/users/partials/_form', ['submit_text' => 'Tạo người dùng'])
    {!! Form::close() !!}
</div>
@endsection