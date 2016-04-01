@extends('layout.clean')

@section('content')
  @@validationErrors

  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

  <div class="register-box">
    <div class="register-box-body">
      <p class="login-box-msg">{{ Lang::get('auth.RESET PASSWORD') }}</p>
      <form action="password/email" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group has-feedback">
          <input type="text"
                 class="form-control"
                 placeholder="{{ Lang::get('auth.EMAIL') }}"
                 name="email"
                 value="{{ old('email') }}"
                 autofocus/>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-4"></div>
          <div class="col-xs-8">
            <button type="submit"
                    class="btn btn-primary btn-block btn-flat">{{ Lang::get('auth.RESET PASSWORD') }}</button>
          </div><!-- /.col -->

        </div>
      </form>
    </div><!-- /.form-box -->
  </div><!-- /.register-box -->

@endsection





