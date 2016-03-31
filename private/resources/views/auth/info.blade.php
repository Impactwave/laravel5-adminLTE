@extends('layout.clean')

@section('content')

  <div class="register-box">
    <div class="register-box-body">
      <h3 align="center">{{ $title }}</h3><br>
      <p>{{ $text }}</p><br>
      <a style="color:#5CB85C" href="{{ URL::to('') }}">{{ Config::get('app.name') }}
    </div><!-- /.form-box -->
  </div><!-- /.register-box -->

@endsection
