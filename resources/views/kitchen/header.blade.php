<?php
  if(session()->has('KitchenID'))
  {
    $KitchenID    = session()->get('KitchenID');
    $KitchenName  = session()->get('KitchenName');
  }
?>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse ">
<div class="">
  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url()->current() }}" class="logo hidden-xs">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><i class="fa fa-refresh fa-spin"></i></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{ AppName() }}</span>
    </a>

    <nav class="navbar navbar-static-top">
      <div class="nav navbar-nav">
        <li>
            <a href="#" title="Kitchen Name">{{$KitchenName}}</a>
        </li>
      </div>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav ">
          @if($Admin==5)
            <li class="dropdown notifications-menu">
                <a href="#"  class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span id="ShopSelectHeader">{{$KitchenName}}</span> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu">

                  @foreach($Kitchen as $data)
                    <li>
                      <a href="#" onclick="KitchenSelect({{$data->ID}})">{{$data->Name}}</a>                 
                    </li>
                  @endforeach
                </ul>
              </li>
          @endif
          <li>
            <a href="#" title="Notification"><i class="fa fa-bell"></i></a>
          </li>

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="User">
              <i class="fa fa-user"></i>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">

                <p>
                  <?php  
                    echo session()->get('UserFirstName'). " ".session()->get('UserLastName') ; 
                  ?>                  
                </p>

                <!-- Online / Offline Status     -->
                <span id="ConnectionStatus"></span>
                <script>
                  if (navigator.onLine) { 
                    $('#ConnectionStatus').html('<i class="fa fa-circle text-success"></i> Online');
                  }
                  else
                    $('#ConnectionStatus').html('<i class="fa fa-circle text-default"></i> No Internet');        
                </script>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="/logout" class="btn btn-default" ><span>Logout</span> <i class="fa fa-sign-out"></i></a>
                </div>
              </li>
            </ul>
          </li>

          <li>
            <a href="/Kitchen" title="Home"><i class="fa fa-home"></i></a>
          </li> 
        </ul>
      </div>
    </nav>
  </header>

  <script>
    function KitchenSelect(KitchenID)
    {    
      $.get('/Sale/Kitchen/Select/'+KitchenID,function(data)
      { 
        location.reload(true);      
      });
    } 
  </script>  