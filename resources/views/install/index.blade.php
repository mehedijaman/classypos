<!DOCTYPE html>
<html>
  <head>
  	<title>{{ AppName() }} | Install</title>
    
    <!-- Bootstrap -->
  	{{Html::style('bootstrap/css/bootstrap.min.css')}}

    <!-- Font Awesome -->
    {{ Html::style('font-awesome/css/font-awesome.min.css') }}
    
    <!-- Theme CSS -->
    {{Html::style('dist/css/AdminLTE.min.css')}}

    <!-- Custom CSS -->
    {{ Html::style('css/custom.css') }}

    <style> 

      .small-box{
        color: white;
        margin-bottom: 0px;
      }

      .main-footer{
        margin-top: 20px;
      }

      h1{
        text-align:center;
      }
    </style>

  </head>

  <body>
      <div class="content">

        <div class="row">
           <h1 class="LabPOS LabPOS-logo">
            <a href="/">
              <span class="AppFirstName">{{ AppFirstName() }}</span><span class="AppLastName">{{ AppLastName() }}</span>
            </a>
           </h1>
        </div>

        <hr>

        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
          @if(Session::has('message'))
      <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true"><i class="fa fa-trash-o"></i></span>
    </button>
      <b class="text-danger">Alert:</b> {{ Session::get('message') }}
   
     </div>
       @endif
            {{ Form::open(['action'=>'InstallController@install','method'=>'post']) }}          
   
              <button name='Install' type="submit" class="btn btn-flat bg-purple btn-lg">Install {{ AppName() }} / Migrate Database</button>
            {{ Form::close() }}
          </div>
        </div>

       <div class="col-lg-10 col-xs-10 col-sm-10 ">
          <footer class="main-footer">
            <div class="pull-right hidden-xs">
              <span class="LabPOS">{{ AppName() }}</span> {{ AppVersion() }} 
            </div>
            
            <strong>&copy; <?php echo date("Y") ?> <a class="TechLab" href="http://techlab.com.bd" target="_blank">{{ 
            AuthorName() }}</a>.</strong> All rights reserved.
          </footer>  
       </div>
      </div>

  </body>
</html>

