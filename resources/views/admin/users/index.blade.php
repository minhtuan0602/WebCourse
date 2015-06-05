@extends('layout/layout')

@section('title')
  Danh sách người dùng
@stop

@section('content')
<div class="container">
  <h2>Danh sách người dùng</h2>

  @if ( !$users->count() )
    Không có người dùng
  @else
    <div class="table-responsive">
      <table class="table table-condensed table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>username</th>
            <th>email</th>
            <th>Profile</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->username }}</td>
              <td>{{ $user->email }}</td>
              <td>
                <a href="/admin/profiles/{!! $user->id !!}"> Profile</a>
              </td>
              @if ($user->id != 1)
                <td>
                  <a href="/admin/users/{!! $user->id !!}/edit"> Sửa </a>
                </td>
                <td>
                  {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('admin.users.destroy', $user->id))) !!}
                    <button type="submit"> Xóa </button>
                  {!! Form::close() !!}
                </td>
              @else
                <td></td>
                <td></td>
              @endif
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
