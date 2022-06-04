<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="theme-color" content="#2196F3"/>
  <title>{{ AppName() }} | {{ AuthorName() }}</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <script data-require="angular.js@*" data-semver="1.2.10" src="/js/angular.min.js"></script>

  <!-- Pace JS -->
  {{ Html::script('/plugins/pace/pace.min.js') }}
  {{ Html::style('/plugins/pace/themes/pink/pace-theme-center-radar.css') }}  
  <!-- {{ Html::style('/plugins/pace/themes/pink/pace-theme-center-simple.css') }}   -->
  <!-- {{ Html::style('/plugins/pace/themes/pink/pace-theme-bounce.css') }}   -->
  <!-- {{ Html::style('/plugins/pace/themes/pink/pace-theme-minimal.css') }}   -->
  

  <!-- Bootstrap 3.3.7 -->
  {{ Html::style('/plugins/bootstrap/dist/css/bootstrap.min.css') }}
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

  <!-- Bootstrap vertical tabs -->
  {{ Html::style('/css/bootstrap-vertical-tabs.min.css') }}


  <!-- Font Awesome -->
  {{ Html::style('/plugins/font-awesome/css/font-awesome.min.css') }}
  <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->

  <!-- Theme style -->
  {{ Html::style('/dist/css/AdminLTE.min.css') }}

  <!-- AdminLTE Skins -->
  {{ Html::style('/dist/css/skins/_all-skins.min.css') }}  

  <!-- DataTables -->
  {{ Html::style('/plugins/datatables/dataTables.bootstrap.min.css') }}
  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.2.1/jq-3.2.1/jszip-2.5.0/dt-1.10.16/b-1.4.2/b-colvis-1.4.2/b-flash-1.4.2/b-html5-1.4.2/b-print-1.4.2/cr-1.4.1/fh-3.1.3/r-2.2.0/sc-1.4.3/datatables.min.css"/>  -->

  <!-- Select2-->
  {{ Html::style('/plugins/select2/select2.min.css') }}
  {{ Html::style('/plugins/select2/select2-bootstrap.min.css') }}
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css" /> -->

  <!-- Alertify JS -->
  {{ Html::style('/plugins/alertifyJS/css/alertify.min.css') }}
  {{ Html::style('/plugins/alertifyJS/css/themes/bootstrap.min.css') }}
  <!-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css"/> -->

  <!-- iCheck -->
  {{ Html::style('/plugins/iCheck/square/blue.css') }}

  <!-- Datepicker -->
  {{ Html::style('/plugins/datepicker/css/bootstrap-datepicker3.min.css') }}
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" /> --> 

  <!-- Virtual Keyboard -->
  <!-- {{ Html::style('/plugins/keyboard/css/keyboard.css') }} -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/virtual-keyboard/1.26.26/css/keyboard.min.css" /> -->

  <!-- jQuery Numpad -->
  <!-- {{ Html::style('/plugins/jQuery.NumPad/jquery.numpad.css') }} -->

  <!-- Calculator JS -->
  {{ Html::style('/css/calculator.css') }}
     
  <!-- Custom CSS -->
  {{ Html::style('/css/custom.css') }}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  {{ Html::script('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }}
  {{ Html::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}
  <![endif]-->  

  <!-- jQuery -->
  {{ Html::script('/plugins/jQuery/jquery-3.2.1.min.js') }} 
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>  --> 


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> 
</head>