@extends ('layout.master')

@section ('body')

  <body class="login-page">

      @if (count($errors) > 0)
          <div class="alert alert-danger">
              <strong>{{ Lang::get('auth.PROBLEMS 1') }}</strong>{{ Lang::get('auth.PROBLEMS') }}<br><br>
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

    @yield ('content')

        <!-- jQuery 2.1.3 -->
        <script src="lib/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="lib/adminlte/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


      <!-- iCheck -->
      <script src="../../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
      <script>
          $(function () {
              $('input').iCheck({
                  checkboxClass: 'icheckbox_square-blue',
                  radioClass: 'iradio_square-blue',
                  increaseArea: '20%' // optional
              });
          });
      </script>

  </body>

@stop

