@extends('layout/layout')
 
@section('content')
<div class='container'>
  <h2>Tạo Article - Category "{{ $category->name }}"</h2>
    {!! Form::model(new App\Article, ['route' => ['admin.categories.articles.store', $category->slug], 'class'=>'', 'files' => true]) !!}
        @include('admin/articles/partials/_form', ['submit_text' => 'Tạo Article'])
    {!! Form::close() !!}
</div>
@endsection