@extends('layout.clean')

@section('content')

  <div class="login-box">
    <div class="login-logo">
      <a href="."><b>Laravel</b> 5</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">{{ Lang::get('auth.LOGIN') }}</p>
      <form method="POST" action="auth/login">
        @@token
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="{{ Lang::get('auth.EMAIL') }}" name="email" value="{{ old('email') }}" autofocus/>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="{{ Lang::get('auth.PASSWORD') }}" name="password"/>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-7">
            <label style="padding-top:7px">
              <input type="checkbox" name="remember">{{ Lang::get('auth.REMEMBER ME') }}
            </label>
          </div><!-- /.col -->
          <div class="col-xs-5">
            <button type="submit" class="btn btn-primary btn-block btn-flat">{{ Lang::get('auth.LOGIN') }}</button>
          </div><!-- /.col -->
        </div>
      </form>

      <br>
      <a style="float:left" href="password/email">{{ Lang::get('auth.FORGOT') }}</a>
      <a style="float:right" href="auth/register" class="text-center">{{ Lang::get('auth.REGISTER 2') }}</a>
      <br style="clear:both">

    </div><!-- /.login-box-body -->
  </div>

@endsection
