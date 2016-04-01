@extends('layout.clean')

@section('content')
  @@validationErrors

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">{{ Lang::get('auth.RESET PASSWORD') }}</div>
          <div class="panel-body">

            <form class="form-horizontal" role="form" method="POST" action="password/reset">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="token" value="{{ $token }}">

              <div class="form-group">
                <label class="col-md-4 control-label">{{ Lang::get('auth.EMAIL') }}</label>
                <div class="col-md-6">
                  <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label">{{ Lang::get('auth.PASSWORD') }}</label>
                <div class="col-md-6">
                  <input type="password" class="form-control" name="password">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label">{{ Lang::get('auth.VERIFY PASSWORD') }}</label>
                <div class="col-md-6">
                  <input type="password" class="form-control" name="password_confirmation">
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                    {{ Lang::get('auth.RESET PASSWORD') }}
                  </button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
