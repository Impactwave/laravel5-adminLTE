@extends('emails.master')

@section('content')

  <h3 style="font-weight:500;font-size:18px;margin:10px 0">Olá {{ $name }}</h3>
  <p style="margin:20px 0">Para confirmar o seu endereço de e-mail e ativar o seu acesso a
    <a style="color:#5CB85C" href="{{ URL::to('') }}">{{ Config::get('app.name') }}</a>, clique no botão abaixo.
  </p>
  <p style="text-align:center">
    <a class="btn btn-md btn-success"
       role="button"
       href="{{ URL::to ('auth/confirm-email', $token) }}"
       style="color: #fff;background-color: #5CB85C;text-decoration: none;display: inline-block;padding: 10px 20px;font-size: 14px;border-radius: 4px">
      Confirmar e-mail
    </a>
  </p>

@endsection

@section('footer')

  <small style="color:#999">

    Se não pediu o envio deste e-mail, alguém introduziu o seu endereço (por engano, provavelmente) na página de
    recuperação de senha de {{ Config::get('app.name') }}. Nesse caso, deverá ignorar este e-mail.

  </small>

@endsection





