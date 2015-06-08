<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Trang Teacher | Khoa Học Và Kỹ Thuật Máy Tính</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="/admin_template/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="/admin_template/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="/admin_template/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/admin_template/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="/admin_template/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="/admin_template/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="/admin_template/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="/admin_template/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="/admin_template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">Trang Teacher</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>   

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">

                <a href="#" title="{{ Auth::user()->username }}" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">{{ str_limit( Auth::user()->username, $limit = 10, $end = '...') }}</span>
                </a>

                <ul class="dropdown-menu">
                  <li class="user-footer">
                    <div class="pull-left">
                      @if (Auth::user()->type == 'A')
                        <a href="/admin">Trang Admin</a>
                      @elseif (Auth::user()->type == 'G')
                        <a href="/teacher">Trang Teacher</a>
                      @endif
                    </div>
                    <div class="pull-right">
                      <a href="/auth/logout">Đăng xuất</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>


          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li>
                <a href="/" role="button">
                  Trang chủ
                </a>
              </li>
            </ul>
          </div>    

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->

      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="/profile/{{ Auth::user()->id }}"><i class="fa fa-files-o"></i> <span>Thông tin người dùng</span></a></li>
            <li><a href="/profile/{{ Auth::user()->id }}/edit"><i class="fa fa-edit"></i> <span>Chỉnh sửa thông tin</span></a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Quản lý bài viết</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/admin/edit-training"><i class="fa fa-circle-o"></i> Chỉnh sửa trang đào tạo </a></li>
                <li><a href="/admin/edit-news"><i class="fa fa-circle-o"></i> Chỉnh sửa trang tin tức </a></li>
                <li><a href="/admin/edit-research"><i class="fa fa-circle-o"></i> Chỉnh sửa trang nghiên cứu </a></li>
                <li><a href="/admin/edit-history"><i class="fa fa-circle-o"></i> Chỉnh sửa trang lịch sử </a></li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        @include('layout/partials/_errors')      

        @yield('content')
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2014-2015</strong> All rights reserved.
      </footer>

      <div class='control-sidebar-bg'></div>

    <!-- jQuery 2.1.4 -->
    <script src="/admin_template/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/admin_template/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="/admin_template/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="/admin_template/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="/admin_template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="/admin_template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="/admin_template/plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="/admin_template/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="/admin_template/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="/admin_template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="/admin_template/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='/admin_template/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="/admin_template/dist/js/app.min.js" type="text/javascript"></script>    
    
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="/admin_template/dist/js/pages/dashboard.js" type="text/javascript"></script>    
    
    <!-- AdminLTE for demo purposes -->
    <script src="/admin_template/dist/js/demo.js" type="text/javascript"></script>

    
    <!-- WYSIWYW -->
    <script src="/js/nicEdit.js" type="text/javascript"></script>
    <script type="text/javascript">
      bkLib.onDomLoaded(function() {
      nicEditors.editors.push(
      new nicEditor({fullPanel : true}).panelInstance(
      document.getElementById('myNicEditor')
      ));
    </script>
  </body>
</html>