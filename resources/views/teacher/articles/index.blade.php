@extends('layout/teacher')

@section('title')
  Danh sách bài viết
@stop

@section('content')
<div class="container">
  <h2>Danh sách bài viết - {{ Auth::user()->username }}</h2>

  @if ( !$articles->count() )
    Bạn chưa viết bài nào
  @else
    <div class="table-responsive">
      <table class="table table-condensed table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Danh mục</th>
            <th>Ngày viết</th>
            <th>Xem chi tiết</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          @foreach($articles as $article)
            <tr>
              <td>{{ $article->id }}</td>
              <td>{{ $article->title }}</td>
              <td>{{ $article->category->name }}</td>
              <td>{{ $article->dateWrite }}</td>
              <td>
                <a href="/teacher/articles/{!! $article->slug !!}"> Chi tiết </a>
              </td>
              <td>
                <a href="/teacher/articles/{!! $article->slug !!}/edit"> Sửa </a>
              </td>
              <td>
                {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('teacher.articles.destroy', $article->slug))) !!}
                  <button type="submit"> Xóa </button>
                {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
  <p>
    <a href="/teacher/articles/create"> Tạo article mới </a>
  </p>
</div>
@endsection
