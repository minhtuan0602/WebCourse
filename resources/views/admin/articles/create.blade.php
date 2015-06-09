@extends('layout/admin')
 
@section('content')
<div class='container'>
  <h2>Tạo Article - Category "{{ $category->name }}"</h2>
  @if ($category->id == 3)
    {!! Form::model(new App\Article, ['id' => 'myForm', 'route' => ['admin.categories.articles.store', $category->slug], 'class'=>'', 'files' => true]) !!}
        @include('admin/articles/partials/_form_research', ['submit_text' => 'Tạo Article'])
    {!! Form::close() !!}
  @else
    {!! Form::model(new App\Article, ['id' => 'myForm', 'route' => ['admin.categories.articles.store', $category->slug], 'class'=>'', 'files' => true]) !!}
        @include('admin/articles/partials/_form', ['submit_text' => 'Tạo Article'])
    {!! Form::close() !!}
  @endif
</div>
@endsection