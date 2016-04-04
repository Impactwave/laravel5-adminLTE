@extends ('layout.master')

@section ('head')
  <link href="lib/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="lib/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="lib/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="lib/adminlte/plugins/iCheck/square/blue.css" rel="stylesheet">
  <link href="css/app.css" rel="stylesheet" type="text/css">
@stop

@section ('scripts')
  <!-- jQuery 2.1.3 -->
  <script src="lib/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="lib/adminlte/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- SlimScroll -->
  <script src="lib/adminlte/plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
  <!-- FastClick -->
  <script src='lib/adminlte/plugins/fastclick/fastclick.min.js'></script>
  <!-- AdminLTE App -->
  <script src="lib/adminlte/dist/js/app.min.js" type="text/javascript"></script>
  <!-- Toastr -->
  <script src="lib/toastr/toastr.min.js"></script>

  <!-- DataTables -->
  <script src='lib/datatables.net/js/jquery.dataTables.min.js'></script>
  <script src='lib/datatables.net-bs/js/dataTables.bootstrap.min.js'></script>
  <script src='lib/datatables.net-responsive/js/dataTables.responsive.min.js'></script>
  <script src='lib/datatables.net-buttons/js/dataTables.buttons.min.js'></script>
  <script src='lib/datatables.net-buttons-bs/js/buttons.bootstrap.min.js'></script>

  <!-- iCheck -->
  <script src="lib/adminlte/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>

  <script src='js/app.js'></script>
@stop

@section ('body')
  <body class="{{ $skin }}">

    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <a href="../../index2.html" class="logo"><b>Admin</b>LTE</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            <span class="icon-bar"></span></a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              @include ('partial.lang')
              @include ('partial.user-panel')
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          @include ('partial.user-sidebar')
          @include ('partial.search')
          @include ('partial.menu')
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">

          @yield ('content')

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 3.0
        </div>
        <strong>Copyright &copy; 2015
          <a href="http://impactwave.com">Impactwave, Lda.</a></strong> All rights reserved.
      </footer>
    </div>
    <!-- ./wrapper -->

    @yield ('scripts')

    @@toastrMessage
  </body>

@stop
