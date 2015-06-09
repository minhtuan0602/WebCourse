@extends('layout/admin')

@section('content')
<div class='container'>
  <h2>Edit Article "{{ $article->title }}"</h2>

  @if ($category->isBuiltIn)
    @if ($category->id == 2)
      {!! Form::model($article, ['id' => 'myForm', 'method' => 'PATCH', 'route' => ['admin.categories.articles.update', $category->slug, $article->slug] , 'files' => true]) !!}
        @include('admin/articles/partials/_form', ['submit_text' => 'Chỉnh sửa Article'])
      {!! Form::close() !!}
    @elseif ($category->id == 3)
      {!! Form::model($article, ['id' => 'myForm', 'method' => 'PATCH', 'route' => ['admin.categories.articles.update', $category->slug, $article->slug] , 'files' => true]) !!}
        @include('admin/articles/partials/_form_research', ['submit_text' => 'Chỉnh sửa Article'])
      {!! Form::close() !!}
    @else
      {!! Form::model($article, ['id' => 'myForm', 'method' => 'PATCH', 'route' => ['admin.categories.articles.update', $category->slug, $article->slug] , 'files' => true]) !!}
        @include('admin/articles/partials/_limit_form', ['submit_text' => 'Chỉnh sửa Article'])
      {!! Form::close() !!}
    @endif
  @else
    {!! Form::model($article, ['id' => 'myForm', 'method' => 'PATCH', 'route' => ['admin.categories.articles.update', $category->slug, $article->slug] , 'files' => true]) !!}
      @include('admin/articles/partials/_form', ['submit_text' => 'Chỉnh sửa Article'])
    {!! Form::close() !!}
  @endif
</div>
@endsection