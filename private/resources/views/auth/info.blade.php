@extends('layout.clean')

@section('content')

  <div class="register-box">
    <div class="register-box-body">
      <h3 align="center">{{ $title }}</h3><br>
      {!! $text !!}<p><br></p>
      <div class="text-right"><a style="color:#5CB85C" href="{{ URL::to('') }}">{{ Config::get('app.name') }}</div>
    </div>
  </div>

@endsection
