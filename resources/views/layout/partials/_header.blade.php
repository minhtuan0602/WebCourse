<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Khoa Khoa Học và Kỹ Thuật Máy Tính</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{ url('/') }}">Trang chủ</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        @if (Auth::guest())
          <li><a href="/auth/login">Đăng nhập</a></li>
          <li><a href="/auth/register">Đăng ký</a></li>
        @else
          <li class="dropdown">
            <a href="#" title="{{ Auth::user()->username }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ str_limit( Auth::user()->username, $limit = 10, $end = '...') }} <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="/profile/{{ Auth::user()->id }}">Thông tin</a></li>
              <li><a href="/auth/logout">Đăng xuất</a></li>
            </ul>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>