<body class="hold-transition skin-blue sidebar-mini sidebar-toggles sideba">
<div class="wrapper">  
  <header class="main-header">
    <a href="/Dashboard" class="logo">      
        <span class="logo-mini"> <i class="fa fa-refresh fa-spin"></i></span>
      <span class="logo-lg TechLab">{{ AppName() }}</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li>
            <a type="button" href="#" onclick="window.history.go(-1);" title="Back"><i class="fa fa-arrow-left "></i></a>
          </li>

          <li>
            <a type="button" href="#" id="Calculator" title="Calculator"><i class="fa fa-calculator " ></i></a>
          </li>
 
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="User Account">
              <i class="fa fa-user "></i>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <i class="fa fa-user fa-5x"></i>
                <p><?php echo session()->get('UserFirstName'). " ".session()->get('UserLastName'); ?></p>
              </li>              
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="/logout" class="btn btn-default" style="float:right">Logout <i class="fa fa-sign-out "></i></a>
                </div>
              </li>
            </ul>
          </li>
          <li>
            <a href="#" data-toggle="control-sidebar" title="Interface Settings"><i class="fa fa-cog "></i></a>
          </li>
          <li>
            <a href="/Home" title="Home Page"><i class="fa fa-home "></i> <strong> </strong></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- ===================  Calculator Modal ===================-->
  <div class="modal" id="CalculatorModal" role="dialog">
    <div class="modal-dialog" id="fahad">
      <div class="col-md-7 col-md-offset-2">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title text-center">
              <p class="label label-primary"><i class="fa fa-calculator"></i> Calculator</p>
            </h1>
          </div>
          <div class="modal-body">
            <div id="background">            
              <div id="result"></div>
              <div id="main">
                <div id="first-rows">
                  <button class="btn btn-primary btn-flat del-bg" id="delete">CLEAR</button>
                  <button value="%" class="btn btn-primary btn-flat btn-style operator opera-bg fall-back">%</button>
                  <button value="+" class=" btn btn-primary btn-flat btn-style opera-bg value align operator">+</button>
                </div>
                <div class="rows">
                  <button value="7" class="btn btn-primary btn-flat btn-style num-bg num first-child">7</button>
                  <button value="8" class="btn btn-primary btn-flat btn-style num-bg num">8</button>
                  <button value="9" class="btn btn-primary btn-flat btn-style num-bg num">9</button>
                  <button value="-" class="btn btn-primary btn-flat btn-style opera-bg operator">-</button>
                </div>
                <div class="rows">
                  <button value="4" class="btn btn-primary btn-flat btn-style num-bg num first-child">4</button>
                  <button value="5" class="btn btn-primary btn-flat btn-style num-bg num">5</button>
                  <button value="6" class="btn btn-primary btn-flat btn-style num-bg num">6</button>
                  <button value="*" class="btn btn-primary btn-flat btn-style opera-bg operator">x</button>
                </div>
                <div class="rows">
                  <button value="1" class="btn btn-primary btn-flat btn-style num-bg num first-child">1</button>
                  <button value="2" class="btn btn-primary btn-flat btn-style num-bg num">2</button>
                  <button value="3" class="btn btn-primary btn-flat btn-style num-bg num">3</button>
                  <button value="/" class="btn btn-primary btn-flat btn-style opera-bg operator">/</button>
                </div>
                <div class="rows">
                  <button value="0" class="btn btn-primary btn-flat num-bg zero" id="delete">0</button>
                  <button value="." class="btn btn-primary btn-flat btn-style num-bg period fall-back">.</button>
                  <button value="=" id="eqn-bg" class="btn btn-primary btn-flat eqn align">=</button>
                </div>
              </div>
            </div> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-flat btn-lg" data-dismiss="modal" >Cancel</button> 
          </div>
        </div>
      </div>
    </div>
  </div>