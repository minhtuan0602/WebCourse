@extends('layout/teacher')

@section('title')
  Danh sách bài viết
@stop

@section('content')
<div class="container">
  <h2>Danh sách bài viết</h2>

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
              <td></td>
              <td></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
  <p>
    <a href="/admin/users/create"> Tạo người dùng mới </a>
  </p>
</div>
@endsection
