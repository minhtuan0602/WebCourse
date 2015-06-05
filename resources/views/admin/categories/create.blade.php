@extends('layout/layout')

@section('title')
    Tạo Category
@stop

@section('content')
<div class="container">
    <h2>Tạo Category</h2>

    {!! Form::model(new App\Category, ['route' => ['admin.categories.store']]) !!}
        @include('admin/categories/partials/_form', ['submit_text' => 'Tạo Category'])
    {!! Form::close() !!}
</div>
@endsection