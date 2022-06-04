{{ Html::style('/css/sale.css') }}
{{ Html::script('/js/sale.js') }}
{{ Html::script('/js/script.js') }}

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">
  <header class="main-header">
    <a href="{{ url()->current() }}" class="logo hidden-xs">
      <span class="logo-mini"></span>
      <span class="logo-lg">{{ AppName() }}</span>
    </a> 
    <script>
        if (navigator.onLine) { 
          $('.logo-mini').append('<i class="fa fa-cloud-upload"></i>');
        }
        else
          $('.logo-mini').append('<i class="fa fa-cloud"></i>');        
    </script>   

    <!-- ===================== Footer Bar =====================-->
    <nav class="navbar navbar-fixed-bottom bg-navy" id="footer-content"> 
      <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 text-center hidden-xs">
        <span class="brand"><?php echo session()->get('ShopName'); ?></span>
      </div>

     <!--  <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 text-center brand">
        <span>{{ date('D M d Y') }} / <span id="Clock"></span></span>       
      </div> -->

      <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 text-center">
        <span class="TechLab">{{ AppName() }}</span> by <span class="TechLab">{{ AuthorName() }}</span>      
      </div>
    </nav>

    

    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>  

      <!-- {{ Form::open(array('id' => 'SidebarForm', 'class' => 'navbar-form navbar-left hidden-xs')) }}              
        @if(Cookie::get('IsBarcode') == 1)
          <div class="input-group">
            <input type="text" id="saqlain" name="barcodeInput" class="form-control" autofocus autocomplete="off" placeholder="Search/Scan here">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-default btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        @endif 
      {{ Form::close() }} -->
      <ul class="nav navbar-nav hidden-xs">
        <li class="active">
          <a href="#">{{ date('D M d Y') }} | <span id="Clock"></span></a>
        </li>
      </ul>
      


      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav ">
          <li class="dropdown notifications-menu Balance">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Advanced Menu">
              <i class="fa fa-th"></i>
            </a>

            <ul class="dropdown-menu">
              <li class="header"><strong>Advanced Menu</strong></li>
              <li>
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                 
                  <div class="col-xs-12">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="OpenBalance">
                      <a class="btn bg-blue btn-flat btn-block" href="#"  data-toggle="modal" data-target="#OpeningBalance" id="OpenBalance">
                        Open Balance
                      </a>
                    </div>

                    <div class="col-xs-6 col-md-6 col-lg-6 col-sm-2" id="EditFahadBalance">
                      <a class="bg-olive btn btn-flat btn-block" href="#"  data-toggle="modal" data-target="#EditingBalance" id="EditFahadBalance">
                        Edit Balance
                      </a>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="CloseFahadBalance">
                      <a href="#" class="bg-maroon btn btn-flat btn-block" id="CloseFahadBalance">
                        Close Balance
                      </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="OpenItem">
                      <a class="bg-purple btn btn-flat btn-block" href="#" data-toggle="modal" data-target="#OpenItemModal" id="OpenItem" >
                        Open Item
                      </a>
                    </div>
                   
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 inner-content hidden" id="ShopExpense">
                      <a class="bg-purple btn btn-flat btn-block" href="#" data-toggle="modal" data-target="#NewExpense" id="ShopExpense" >
                        Add Expense
                      </a>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="Previousinvoice">
                      <a href="#" class="bg-blue btn btn-flat btn-block"  id="Previousinvoice" >
                        Invoice List
                      </a>
                    </div>

                    @if(Cookie::get('IsAdvance')==1)
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <a href="#" class="bg-blue btn btn-flat btn-block" id="PreviousAdvance" >
                          Advance List
                        </a>
                      </div>
                    @endif

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="TodaysSummary">
                      <a href="#" class="bg-navy btn-flat btn btn-block" id="TodaysSummary" >
                        Day Summary
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

              <!-- <li class="footer " style=" color:white; ">
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
          </li>
 -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="User">
              <i class="fa fa-user"></i>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <i class="fa fa-user fa-5x"></i>
                <p><?php echo session()->get('UserFirstName'). " ".session()->get('UserLastName') ; ?></p>

                <span id="ConnectionStatus"></span>
                <script>
                  if (navigator.onLine) { 
                    $('#ConnectionStatus').html('<i class="fa fa-circle text-success"></i> Online');
                  }
                  else
                    $('#ConnectionStatus').html('<i class="fa fa-circle text-default"></i> No Internet');        
                </script>
              </li>
              <li class="user-footer">
                <div class="pull-right">
                  <a href="/logout" class="btn btn-default" ><span>Logout</span> <i class="fa fa-sign-out"></i></a>
                </div>
              </li>
            </ul>
          </li>

          <li>
            <a href="#" data-toggle="control-sidebar" title="Settings"><i class="fa fa-cogs"></i></a>
          </li>          
          <li id="GoToAdmin">
            <a href="/Home" title="Home Page"><i class="fa fa-home "></i> <strong> </strong></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>