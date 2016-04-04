<!DOCTYPE html>
<html lang={{ $lang }}>
  <head>
    <meta charset="UTF-8">
    <title>{{ Config::get('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <base href="{{ Request::root() }}/">
    <!-- Bootstrap 3.3.2 -->
    <link href="lib/adminlte/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome Icons -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Ionicons -->
    {{--<link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css">--}}
    <!-- Theme style -->
    <link href="lib/adminlte/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder and configure it on private/app/Providers/ComposerServiceProvider.php -->
    <link href="lib/adminlte/dist/css/skins/{{ $skin }}.min.css" rel="stylesheet" type="text/css">

    <link href="lib/toastr/toastr.css" rel="stylesheet">

    @yield ('head')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  @yield ('body')

</html>
