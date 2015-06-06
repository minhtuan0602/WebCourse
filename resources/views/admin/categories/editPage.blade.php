@extends('layout/admin')

@section('title')
    Chỉnh sửa trang
@stop

@section('content')
<div class="container">
  <h2>Chỉnh sửa trang</h2>
    <div>
      <a href="/admin/edit-training"><h4>Đào tạo</h4></a>
      <a href="/admin/categories/dao-tao/edit"> Sửa </a>

      <a href="/admin/edit-news"><h4>Tin tức</h4></a>
      <a href="/admin/categories/tin-tuc/edit"> Sửa </a>

      <a href="/admin/edit-research"><h4>Nghiên cứu</h4></a>
      <a href="/admin/categories/nghien-cuu/edit"> Sửa </a>

      <a href="/admin/edit-history"><h4>Lịch sử</h4></a>
      <a href="/admin/categories/lich-su/edit"> Sửa </a>
    </div>  
</div>
@endsection