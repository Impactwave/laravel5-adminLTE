@extends('layout.clean')

@section('content')
  @@validationErrors

  <div class="register-box">
    <div class="register-box-body">
      <p class="login-box-msg">{{ Lang::get('auth.REGISTRATION') }}</p>

      <form role="form" method="POST" action="auth/register">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group has-feedback">
          <input type="text"
                 class="form-control"
                 placeholder="{{ Lang::get('auth.NAME') }}"
                 name="name"
                 value="{{ old('name') }}">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="email"
                 class="form-control"
                 placeholder="{{ Lang::get('auth.EMAIL') }}"
                 name="email"
                 value="{{ old('email') }}">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="{{ Lang::get('auth.PASSWORD') }}" name="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password"
                 class="form-control"
                 placeholder="{{ Lang::get('auth.VERIFY PASSWORD') }}"
                 name="password_confirmation">
          <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>
        <div>
          <div class="col-xs-7"></div><!-- /.col -->
          <div class="col-xs-5">
            <button type="submit" class="btn btn-primary btn-block btn-flat">{{ Lang::get('auth.REGISTER') }}</button>
          </div><!-- /.col -->
        </div>
      </form>

      <div class="row">
        <div class="col-xs-8">
          <a style="float:left" href="auth/login" class="text-center">{{ Lang::get('auth.REGISTER 1') }}</a>
        </div><!-- /.col -->
        <div class="col-xs-4"></div><!-- /.col -->
      </div>
    </div><!-- /.form-box -->
  </div><!-- /.register-box -->

@endsection




