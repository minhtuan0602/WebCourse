@extends('layout/teacher')
 
@section('content')
<div class="container">
  <h2>
    {{ $article->name }}
  </h2>

  {{ $article->description }}
  <b>Tác giả: </b>{{ $article->username }}<br />
  <b>Ngày đăng: </b>{{ $article->dateWrite }}<br />
  <b>Nội dung: </b><br />
  <p>{!! html_entity_decode($article->content) !!}</p>

  <div class="left">
      <a href="/teacher/articles" class="btn btn-default"> Trở về danh sách bài viết </span></a>
    </div>
</div>
@endsection