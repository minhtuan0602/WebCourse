@extends('layout/layout')

@section('title')
    Chapter
@stop

@section('content')
<div class="container">
  <h2>{{ $category->name }}</h2>
  <p>Position: {{ $category->position }}</p>

  @if ( !$category->articles->count() )
    Hiện tại không có article nào
  @else
    <ul>
      @foreach( $category->articles as $article )
        <li>
          {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('admin.categories.articles.destroy', $category->slug, $article->slug))) !!}
            <a href="{{ route('admin.categories.articles.show', [$category->slug, $article->slug]) }}">{{ $article->title }}</a>
            (
              {!! link_to_route('admin.categories.articles.edit', 'Sửa', array($category->slug, $article->slug), array('class' => 'btn btn-info')) !!},

              {!! Form::submit('Xóa', array('class' => 'btn btn-danger')) !!}
            )
          {!! Form::close() !!}
        </li>
      @endforeach
    </ul>
  @endif

  <p>
    @if (!$category->isBuiltIn)
      <a href="/admin/editNews/" >Chỉnh sửa trang tin tức</a> |
    @endif
    <a href="/admin/categories/{{ $category->slug }}/articles/create" >Tạo Article</a>
</div>
@endsection