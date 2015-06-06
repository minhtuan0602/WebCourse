@extends('layout/admin')
 
@section('content')
<div class='container'>
  <h2>Tạo Article - Category "{{ $category->name }}"</h2>
  {!! Form::model(new App\Article, ['id' => 'myForm', 'route' => ['admin.categories.articles.store', $category->slug], 'class'=>'', 'files' => true]) !!}
      @include('admin/articles/partials/_form', ['submit_text' => 'Tạo Article'])
  {!! Form::close() !!}
</div>
@endsection