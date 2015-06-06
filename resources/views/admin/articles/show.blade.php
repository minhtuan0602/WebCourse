@extends('layout/admin')
 
@section('content')
<div class="container">
  <h2>
    {!! link_to_route('admin.categories.show', $category->name, [$category->slug]) !!} -
    {{ $article->name }}
  </h2>

  {{ $article->description }}
  <b>Tác giả: </b>{{ $article->username }}<br />
  <b>Ngày đăng: </b>{{ $article->dateWrite }}<br />
  <b>Nội dung: </b><br />
  <p>{{ $article->content }}</p>
</div>
@endsection