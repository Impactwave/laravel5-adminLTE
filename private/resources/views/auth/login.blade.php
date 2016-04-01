@extends('layout.clean')

@section('content')

  <div class="login-box">
    <div class="login-logo">
      <a href=".">{{ Config::get('app.name') }}</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <h4 class="login-box-msg">{{ Lang::get('auth.LOGIN') }}</h4>

      <form method="POST" action="auth/login">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <div class="btn-group btn-block">
            <button type="button"
                    class="btn btn-default dropdown-toggle btn-block"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    style="background: #FFF;border-color: #CCC;color: #666;">
              {{ App\Http\Middleware\Language::getName() }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" style="width:100%;margin-top:0">
              @foreach (App\Http\Middleware\Language::getAll() as $locale=>$name)
                <li>
                  <a href="locale/{{ $locale }}">
                    @if ($locale==$lang)
                      <i class="glyphicon glyphicon-ok"></i>
                    @else
                      <i class="icon-placeholder"></i>
                    @endif
                    {{ $name }}
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="form-group has-feedback">
          <input type="text"
                 class="form-control"
                 placeholder="{{ Lang::get('auth.EMAIL') }}"
                 name="email"
                 value="{{ old('email') }}"
                 autofocus/>
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
