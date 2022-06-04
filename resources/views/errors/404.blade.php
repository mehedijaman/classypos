
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Error 404</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 

  <!-- Bootstrap 3.3.6 -->
  {{ Html::style('/bootstrap/css/bootstrap.min.css') }}


  <!-- Font Awesome -->
  {{ Html::style('/font-awesome/css/font-awesome.min.css') }}


 


  <!-- Theme style -->
  {{ Html::style('/dist/css/AdminLTE.min.css') }}


  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  {{ Html::style('dist/css/skins/_all-skins.min.css') }}


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->  

  <style>
    body{
      background-color: #ecf0f5;
    }
  </style>


</head>

<body>
    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow">404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Don't cry in the wilderness.</h3>

          <p>
            We could not find the page you were looking for. We are really sorry ! :( 
          </p>

          <a onclick="window.history.go(-1);" class="btn btn-primary btn-flat"><i class="fa fa-chevron-left"></i> Go back</a>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->

</body>