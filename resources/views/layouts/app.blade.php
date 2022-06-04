<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{ Html::script('/plugins/pace/pace.min.js') }}
  {{ Html::style('/plugins/pace/themes/orange/pace-theme-loading-bar.css') }}  
  

  <!-- Bootstrap 3.3.6 -->
  {{ Html::style('/bootstrap/css/bootstrap.min.css') }}
  {{ Html::script('/bootstrap/js/bootstrap.min.js') }}

  <!-- Font Awesome -->
  {{ Html::style('/font-awesome/css/font-awesome.min.css') }}

  <!-- AlertfityJS -->  
  {{ Html::style('/plugins/alertify/css/alertify.min.css') }}

  <!-- Theme style -->
  {{ Html::style('/dist/css/AdminLTE.min.css') }}

  <!-- AdminLTE Skins -->
  {{ Html::style('/dist/css/skins/_all-skins.min.css') }}  
  <!-- Custom CSS -->
  {{ Html::style('/css/custom.css') }}
</head>
<body>
    <div id="app">      
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
