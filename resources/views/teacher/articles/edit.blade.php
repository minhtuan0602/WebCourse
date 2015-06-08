@extends('layout/teacher')

@section('content')
<div class='container'>
  <h2>Edit Article "{{ $article->title }}"</h2>

  {!! Form::model($article, ['id' => 'myForm', 'method' => 'PATCH', 'route' => ['teacher.articles.update', $article->slug] , 'files' => true]) !!}
	 @include('teacher/articles/partials/_form', ['submit_text' => 'Chỉnh sửa Article'])
  {!! Form::close() !!}
</div>
@endsection