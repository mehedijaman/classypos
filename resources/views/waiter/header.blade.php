<body class="hold-transition skin-blue sidebar-mini sidebar-collapse fixed">
<div class="">
  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url()->current() }}" class="logo hidden-xs">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><i class="fa fa-refresh fa-spin"></i></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{ AppName() }}</span>
    </a>      

    <!-- ===================== Footer Bar =====================-->
    <nav class="navbar navbar-fixed-bottom bg-navy" id="footer-content"> 
      <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 text-center">
        <span class="brand"><?php echo session()->get('ShopName'); ?></span>
      </div>

      <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 text-center brand  hidden-xs">
        <strong><span>{{ date('D M d Y') }} / <span id="Clock"></span></span></strong>        
      </div>
    </nav>

    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>     


      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav ">
          <li>
            <a href="#" title="Notification"><i class="fa fa-bell"></i></a>
          </li>

          <!-- Advanced Menu -->
          <li class="dropdown notifications-menu Balance">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Advanced Menu">
              <i class="fa fa-th"></i>
            </a>

            <ul class="dropdown-menu">
              <li class="header"><strong>Advanced Menu</strong></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                 
                  <div class="col-xs-12">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <a class="btn bg-blue btn-flat btn-block" href="#"  data-toggle="modal" data-target="#OpeningBalance" id="OpenBalance">
                        <strong>Open Balance</strong>
                      </a>
                    </div>

                    <div class="col-xs-6 col-md-6 col-lg-6 col-sm-2">
                      <a class="bg-olive btn btn-flat btn-block" href="#"  data-toggle="modal" data-target="#EditingBalance" id="EditFahadBalance">
                        <!-- <i class="fa fa-pencil-square-o"></i> --> <strong>Edit Balance</strong>
                      </a>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <a href="#" class="bg-maroon btn btn-flat btn-block" id="CloseFahadBalance">
                        <!-- <i class="fa fa-times-circle"></i> --> <strong>Close Balance</strong>
                      </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <a class="bg-purple btn btn-flat btn-block" href="#" data-toggle="modal" data-target="#OpenItemModal" id="OpenItem" >
                        <!-- <i class="fa fa-opencart "></i> --> <strong>Open Item</strong>
                      </a>
                    </div>
                   
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <a class="bg-purple btn btn-flat btn-block" href="#" data-toggle="modal" data-target="#NewExpense" id="ShopExpense" >
                        <!-- <i class="fa fa-pencil "></i> --> <strong>Add Expense</strong>
                      </a>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <a href="#" class="bg-blue btn btn-flat btn-block"  id="Previousinvoice" >
                        <!-- <i class="fa fa-th-list"></i> --> <strong>Invoice List</strong>
                      </a>
                    </div>

                    @if(Cookie::get('IsAdvance')==1)
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <a href="#" class="bg-blue btn btn-flat btn-block" id="PreviousAdvance" >
                          <!-- <i class="fa fa-hand-lizard-o"></i> --> <strong>Advance List</strong>
                        </a>
                      </div>
                    @endif

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <a href="#" class="bg-navy btn-flat btn btn-block" id="TodaysSummary" >
                        <!-- <i class="fa fa-print"></i> --> <strong>Day Summary</strong>
                      </a>
                    </div>

                    <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;">
                    </div>

                    <div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">                  
                    </div>
                  </div>
                </div>
              </li>
              <li class="footer"><a href="#"></a></li>
            </ul>
          </li>

          <!-- Shop Wise Sales Summary -->
          <li class="dropdown notifications-menu sales-summary">
            <a href="#" class="dropdown-toggle bg-maroon" data-toggle="dropdown" title="Sales Summary">
              <i class="fa fa-line-chart"></i>
              <!-- <span class="label label-danger">{{$TotalIncome}}</span> -->
            </a>

            <ul class="dropdown-menu">
              <li class="header bg-maroon"><strong>Sales Summary Today</strong></li>

              <li>
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                  <ul class="menu">

                    <table class="table table-responsive table-bordered">
                      <thead>
                        <th>Shop Name</th>
                        <th>Sales({{ CurrencyName() }})</th>
                      </thead>

                      <tbody>
                        @for($i = 0; $i < $TotalShops; $i++)
                          <tr>
                            <td>{{ $ShopNameAll[$i] }}</td>
                            <td>{{ $Income[$i] }}</td>                            
                          </tr>
                        @endfor  
                      </tbody>
                    </table>

                                      

                    <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;">                  
                    </div>

                    <div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">         
                    </div>

                  </ul>
                </div>
              </li>
<!-- 
              <li class="footer " style=" color:white; ">
                <table class="footer table table-stripped bg-navy" >
                  <thead>
                    <th>Total Sales</th>
                    <th>{{ $TotalIncome }}</th>
                  </thead>
                </table>
              </li> -->
            </ul>
          </li>



          

          <!-- Notice  -->
          <!-- <li class="dropdown notifications-menu notice">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" title="Notification">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header bg-aqua "><strong>You have 0 Notice Today</strong></li>
              <li>
                
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-sticky-note text-aqua"></i> Demo Notice
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li> -->



          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="User">     

              <!-- <img src="/uploads/image/user/{{ $user->UserImg }}" class="img img-responsive user-image" alt="User Image"> -->

              <!-- <span class="hidden-xs"> -->
                <i class="fa fa-user"></i>  
              <!-- </span> -->
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/uploads/image/user/{{ $user->UserImg }}" class="img-rounded" alt="User Image">

                <p>
                  <?php  
                    echo session()->get('UserFirstName'). " ".session()->get('UserLastName') ; 
                  ?>
                  <!-- <small>Staff since Nov. 2012</small> -->
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
                  <a href="/logout" class="btn btn-success btn-flat" ><span>Logout</span> <i class="fa fa-sign-out"></i></a>
                </div>
              </li>
            </ul>
          </li>

          <li>
            <a href="#" data-toggle="control-sidebar" title="Settings"><i class="fa fa-bars"></i></a>
          </li>          
          <li id="GoToAdmin">
            <a href="/Dashboard" title="Go to Admin"><i class="fa fa-share "></i> <strong> </strong></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>