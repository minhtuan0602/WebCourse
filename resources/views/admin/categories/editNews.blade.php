@extends('layout/layout')

@section('title')
    Chỉnh sửa trang tin tức
@stop

@section('content')
<div class="container">
  <h2>Chỉnh sửa trang tin tức</h2>
    @if ( !$categories->count() )
      <h4>Hiện nay không có category nào có thể. Chúng tôi sẽ nhanh chóng cập nhật sản phẩm mới nhất.</h4>
    @else
      <div> 
        @foreach( $categories as $category )
          {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('admin.categories.destroy', $category->id))) !!}
          <a href="{!! route('admin.categories.show', $category->slug) !!}">
            <h4>{!! $category->name !!}</h4>
            <a href="/admin/categories/{!! $category->slug !!}/edit"> Sửa </a> |
            <button type="submit"> Xóa </button>
          </a>
          {!! Form::close() !!}
        @endforeach
      </div>   
    @endif
    <p>
      <a href="/admin/categories/create"> Tạo category </a>
    </p>
</div>
@endsection