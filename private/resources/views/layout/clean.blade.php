@extends ('layout.master')

@section ('head')
  <link href="lib/adminlte/plugins/iCheck/square/blue.css" rel="stylesheet">
  <link href="css/app.css" rel="stylesheet" type="text/css">
@stop

@section ('scripts')
  <!-- jQuery 2.1.3 -->
  <script src="lib/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="lib/adminlte/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- Toastr -->
  <script src="lib/toastr/toastr.min.js"></script>
  <!-- iCheck -->
  <script src="lib/adminlte/plugins/iCheck/square/icheck.min.js" type="text/javascript"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>

@stop

@section ('body')

  <body class="login-page">

    @yield ('content')
    @yield ('scripts')

    @@toastrMessage
  </body>

@stop
