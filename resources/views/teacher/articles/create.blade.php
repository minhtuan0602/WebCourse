@extends('layout/teacher')
 
@section('content')
<div class='container'>
  <h2>Tạo Article</h2>
  {!! Form::model(new App\Article, ['id' => 'myForm', 'route' => ['teacher.articles.store'], 'class'=>'', 'files' => true]) !!}
      @include('teacher/articles/partials/_form', ['submit_text' => 'Tạo Article'])
  {!! Form::close() !!}
</div>
@endsection