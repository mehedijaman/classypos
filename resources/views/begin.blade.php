
<?php
if(session()->has('ShopID'))
{
  $ShopID=session()->get('ShopID');
  $ShopName=session()->get('ShopName');

}
else
{
  $ShopID=0;
  $ShopName="Select Shop";

}

?>


@include('/layouts/header')
<style>
  .content-wrapper{
    background-image: url('/img/app/iStock-500663898.jpg');
    background-size: cover;
    background-repeat: no-repeat;
  }
</style>
<body class="skin-blue sidebar-mini sidebar-collapse">
  <input type="hidden" id="ShopCheck" value="{{$ShopID}}">
  @if(Cookie::get('IsRestaurant')==1)
    <input type="hidden" id="RestaurantCheck" value="1">
  @endif
  @if(Cookie::get('IsRestaurant')==0)
    <input type="hidden" id="RestaurantCheck" value="0">
  @endif

  <div class="wrapper">
    <header class="main-header">
      <a href="/" class="logo">
        <span class="logo-mini"><i class="fa fa-refresh"></i></span>
        <span class="logo-lg">{{ AppName() }}</span>
      </a>
      <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown notifications-menu">
              <a href="#"  class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span id="ShopSelectHeader">{{$ShopName}}</span><i class="fa fa-caret-down"></i>
              </a>
              <ul class="dropdown-menu">

                @foreach($Shop as $data)
                  <li>
                    <a href="#" onclick="ShopSelect({{$data->ShopID}})">{{$data->ShopName}}</a>                 
                  </li>
                @endforeach
              </ul>
            </li>
            <li>
              <a href="/logout">Logout <i class="fa fa-sign-out"></i></a>
            </li>
          </ul>
        </div>

      </nav>
    </header>

    <div class="content-wrapper" style="margin-left: 0px!important;">
      <div class="content-header"></div>
      <div class="content">
      @if(session()->has('ShopID'))
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
          <a href="/Sales" class="small-box Operation Sales">
            <div class="small-box bg-purple">            
              <div class="inner">
                <h3>Sales</h3>
                <p>Operation</p>
              </div>
              <div class="icon">
                <i class="fa fa-shopping-bag"></i>
              </div>            
              <a href="/Sales" class="small-box-footer Operation Sales">Enter <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </a>
        </div>
      @endif


        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
          <a href="/Admin" class="small-box">
            <div class="small-box bg-maroon">              
              <div class="inner">
                <h3>Admin</h3>
                <p>Management</p>
              </div>
              <div class="icon">
                <i class="fa fa-cogs"></i>
              </div>              
              <a href="/Admin" class="small-box-footer">Enter <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </a>
        </div>

        @if(Cookie::get('IsRestaurant')==1)      

          <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
            <a href="/Waiter" class="small-box Operation Restaurant">
              <div class="small-box bg-aqua">            
                <div class="inner">
                  <h3>Waiter</h3>
                  <p>Panel</p>
                </div>
                <div class="icon">
                  <i class="fa fa-male"></i>
                </div>            
                <a href="/Waiter" class="small-box-footer Operation Restaurant">Enter <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </a>
          </div>

          <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
            <a href="/Kitchen/KOT/New" class="small-box Operation Restaurant">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>Kitchen</h3>
                  <p>Display</p>
                </div>
                <div class="icon">
                  <i class="fa fa-cutlery"></i>
                </div>
                <a href="/Kitchen/KOT/New" class="small-box-footer Operation Restaurant">Enter <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </a>
          </div>
        @endif

        
      </div>
    </div>  

    <footer class="main-footer" style="margin-left: 0px!important;">
      <div class="pull-right hidden-xs">
        <span class="TechLab">{{ AppName() }}</span> {{ AppVersion() }} 
      </div>
      <strong>&copy; <?php echo date("Y") ?> <a class="TechLab" href="http://techlab.com.bd" target="_blank">{{ 
      AuthorName() }}</a> .</strong> All rights reserved.
    </footer>   
  </div>
  <script>

  //
  $(document).ready(function(e)
  {
      //$('.Operation').hide();
      var Restaurant=$('#RestaurantCheck').val();
      if(Restaurant>0)
      {
        $('.Restaurant').show();
      }
      else
      {
        $('.Restaurant').hide();

      }

      var Shop=$('#ShopCheck').val();
      if(Shop>0)
      {
        $('.Sales').show();
      }

  });

  function ShopSelect(ShopID)
  {
    $.get('/Sale/Shop/Select/'+ShopID,function(data)
    {
      /*$('#ShopSelectHeader').empty();
      $('#ShopSelectHeader').append(data.ShopName);
      $('#ShopCheck').val(ShopID);
      $('.Sales').show();
      var Restaurant=data.Restaurant;
      if(Restaurant>0)
      {
        $('.Restaurant').show();
      }
      else
      {
        $('.Restaurant').hide();

      }*/
      location.reload(true);
      
    });
  }

  

    

  </script>  
@include('/layouts/footer')
