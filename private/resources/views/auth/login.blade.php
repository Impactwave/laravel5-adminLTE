@extends('app')

@section('content')

  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="login-box">
    <div class="login-logo">
      <a href="."><b>Selene</b> 3</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form method="POST" action="auth/login">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" autofocus/>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password"/>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <label style="padding-top:7px">
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div><!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div><!-- /.col -->
        </div>
      </form>

      <br>
      <a style="float:left" href="password/email">I forgot my password</a>
      <a style="float:right" href="auth/register" class="text-center">Register a new membership</a>
      <br style="clear:both">

    </div><!-- /.login-box-body -->

@endsection
