@extends('layout/admin')

@section('title')
    Chỉnh sửa trang nghiên cứu
@stop

@section('content')
<div class="container">
  <h2>Chỉnh sửa trang nghiên cứu</h2>
    @if ( !$articles->count() )
      Hiện tại không có article nào
    @else
      <ul>
        @foreach( $articles as $article )
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
      <a href="/admin/categories/nghien-cuu/articles/create"> Tạo article nghiên cứu </a>
    </p>
</div>
@endsection