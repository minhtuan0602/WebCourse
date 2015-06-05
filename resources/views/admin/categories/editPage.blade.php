@extends('layout/layout')

@section('title')
    Chỉnh sửa trang
@stop

@section('content')
<div class="container">
  <h2>Chỉnh sửa trang</h2>
    @if ( !$categories->count() )
      <h4>Hiện nay không có category nào có thể. Chúng tôi sẽ nhanh chóng cập nhật sản phẩm mới nhất.</h4>
    @else
      <div> 
        @foreach( $categories as $category )
          <a href="{!! route('admin.categories.show', $category->slug) !!}">
            <h4>{!! $category->name !!}</h4>
          </a>
          <a href="/admin/categories/{!! $category->slug !!}/edit"> Sửa </a>
        @endforeach
      </div>  
    @endif
</div>
@endsection