@extends('layout/layout')

@section('content')
<div class='container'>
  <h2>Edit Article "{{ $article->title }}"</h2>

  @if ($category->isBuiltIn)
    @if ($category->id == 2)
      {!! Form::model($article, ['method' => 'PATCH', 'route' => ['admin.categories.articles.update', $category->slug, $article->slug] , 'files' => true]) !!}
        @include('admin/articles/partials/_form', ['submit_text' => 'Chỉnh sửa Article'])
      {!! Form::close() !!}
    @else
      {!! Form::model($article, ['method' => 'PATCH', 'route' => ['admin.categories.articles.update', $category->slug, $article->slug] , 'files' => true]) !!}
        @include('admin/articles/partials/_limit_form', ['submit_text' => 'Chỉnh sửa Article'])
      {!! Form::close() !!}
    @endif
  @else
    {!! Form::model($article, ['method' => 'PATCH', 'route' => ['admin.categories.articles.update', $category->slug, $article->slug] , 'files' => true]) !!}
      @include('admin/articles/partials/_form', ['submit_text' => 'Chỉnh sửa Article'])
    {!! Form::close() !!}
  @endif
</div>
@endsection