@extends('layout/admin')

@section('title')
    Chỉnh sửa Category
@stop

@section('content')
<div class="container">
    <h2>Chỉnh sửa Category</h2>
    {!! Form::model($category, ['method' => 'PATCH', 'route' => ['admin.categories.update', $category->slug]]) !!}
      @include('admin/categories/partials/_form', ['submit_text' => 'Edit Category'])
    {!! Form::close() !!}
</div>
@endsection