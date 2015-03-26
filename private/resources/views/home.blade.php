@extends ('layout.main')

@section ('content')

@section ('box-body')
  <h1 align="center">{{ trans('auth.VERIFY PASSWORD') }}</h1>
  <p align="center">With AdminLTE integration.</p>
@overwrite

@section ('box-footer')
  <div align="right">
    <button class="btn btn-primary">Button</button>
  </div>
@overwrite

@include ('partial.box', ['title'=>'Title'])

@stop