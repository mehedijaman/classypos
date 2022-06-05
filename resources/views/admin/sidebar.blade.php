  <aside class="main-sidebar">
    <section class="sidebar">
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree"> 
        <li ><a href="/Dashboard"><i class="fa fa-dashboard "></i> <span>Dashboard</span></a></li>
        <li class="header">PRODUCTS</li>
        <li class="treeview">
          <a href="#"><i class="fa fa-cubes "></i> <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right "></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="/Product/New"> <i class="fa fa-cube"></i> New  </a></li>
            <li><a href="/Product/List"><i class="fa fa-cubes"></i> List </a></li>
            <li><a href="/Product/List/ShopWise"><i class="fa fa-angle-double-right"></i> Shop Mapping </a></li>
            <li><a href="/Product/Category"><i class="fa fa-sitemap"></i> Category</a></li>
            <li><a href="/Product/Shop/Category/Mapping"><i class="fa fa-angle-double-right"></i> Category Mapping</a></li>
            <li><a href="/Kitchen/Category/Mapping/"><i class="fa fa-angle-double-right"></i> Kitchen Mapping</a></li>
            <li><a href="/Product/Distribute"><i class="fa fa-share"></i> Distribute</a></li>
            <li><a href="/Product/Barcode"><i class="fa fa-barcode"></i> Barcode </a></li>
            <li><a href="/Product/QRCode"><i class="fa fa-qrcode"></i> QR Code </a></li>            
            <li><a href="/Product/Purchase"><i class="fa fa-truck"></i> Purchase </a></li>
            <li><a href="/Product/Inventory"><i class="fa fa-search"></i> Inventory Check </a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-recycle"></i> <span>Waste</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right "></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/Waste/New"><i class="fa fa-angle-double-right"></i> New </a></li>
            <li><a href="/Waste/List"><i class="fa fa-angle-double-right"></i>  List</a></li>
          </ul>
        </li>

        <li class="header">HRM</li>
        <li class="treeview">
          <a href="#"><i class="fa fa-address-card-o"></i> <span>Vendor</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right  "></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="/Vendor/New"><i class="fa fa-angle-double-right"></i> New  </a></li>
            <li><a href="/Vendor/List"><i class="fa fa-angle-double-right"></i> List </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-address-card-o "></i> <span>Customer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right "></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="/Customer/New"><i class="fa fa-angle-double-right"></i>  New  </a></li>
            <li><a href="/Customer/List"><i class="fa fa-angle-double-right"></i>  List </a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-user"></i> <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right "></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/User/New"><i class="fa fa-angle-double-right"></i> New </a></li>
            <li><a href="/User/List"><i class="fa fa-angle-double-right"></i> List</a></li>
          </ul>
        </li>
        <li class="header">ACCOUNTS</li>
        <li class="treeview">
          <a href="#"><i class="fa fa-money"></i> <span>Incomes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right "></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/Income/New"><i class="fa fa-angle-double-right"></i> Add Income </a></li>
            <li><a href="/Income/List"><i class="fa fa-angle-double-right"></i> Income List</a></li>
            <li><a href="/Income/Category"><i class="fa fa-angle-double-right"></i> Income Category  </a></li>
          </ul>
        </li>        
        <li class="treeview">
          <a href="#"><i class="fa fa-book"></i> <span>Expenses</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right "></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/Expense/New"><i class="fa fa-angle-double-right"></i> Add Expense </a></li>
            <li><a href="/Expense/List"><i class="fa fa-angle-double-right"></i> Expense List </a></li>
            <li><a href="/Expense/Category"><i class="fa fa-angle-double-right"></i> Expense Category </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-university"></i> <span>Banking</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right "></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/Bank/Withdraw"><i class="fa fa-angle-double-right"></i> Withdraw</a></li>
            <li><a href="/Bank/Deposit"><i class="fa fa-angle-double-right"></i> Deposit</a></li>
            <li><a href="/Bank/List"><i class="fa fa-angle-double-right"></i> Bank List </a></li>
          </ul>
        </li>
        <li class="header">REPORT</li>
        <li class="treeview">
          <a href="#"><i class="fa fa-bar-chart"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right "></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/Report/Product"><i class="fa fa-angle-double-right"></i> Product Report</a></li>
            <li><a href="/Report/Sales"><i class="fa fa-angle-double-right"></i> Sales Report</a></li>
            <li><a href="/Report/Drawer"><i class="fa fa-angle-double-right"></i> Cash Drawer Report</a></li>
            <li><a href="/Report/User"><i class="fa fa-angle-double-right"></i> User Report</a></li>
            <li><a href="/Report/Customer"><i class="fa fa-angle-double-right"></i> Customer Report</a></li>
            <li><a href="/Report/Vendor"><i class="fa fa-angle-double-right"></i> Vendor Report</a></li>
            <li><a href="/Report/Accounts"><i class="fa fa-angle-double-right"></i> Accounts Report</a></li>
            <li><a href="/Report/Bank"><i class="fa fa-angle-double-right"></i> Bank Report</a></li>
            <li><a href="/Report/Tax"><i class="fa fa-angle-double-right"></i> Tax Report</a></li>
            <li><a href="/Report/Waste"><i class="fa fa-angle-double-right"></i> Waste Report</a></li>
            <li><a href="/Report/Activity"><i class="fa fa-angle-double-right"></i> Activity Report</a></li>
          </ul>
        </li>
        <li class="header">SETTINGS</li>
        <li class="treeview">
          <a href="#"><i class="fa fa-home"></i> <span>Shop</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right "></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/Shop/List"><i class="fa fa-angle-double-right"></i> List </a></li>
          </ul>
        </li>                
        
        <li class="treeview">
          <a href="#"><i class="fa fa-cogs "></i> <span> Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right "></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/Settings/General"><i class="fa fa-angle-double-right"></i> General Settings</a></li>
            <li><a href="/OnScreenButton"><i class="fa fa-angle-double-right"></i> On Screen Button</a></li>
            <li><a href="/PaymentMethod"><i class="fa fa-angle-double-right"></i> Payment Method</a></li>
            <li><a href="/Tax"><i class="fa fa-angle-double-right"></i> Tax settings</a></li>            
            <li><a href="/User/Role"><i class="fa fa-angle-double-right"></i> Role Settings</a></li>
            <li><a href="/Invoice/Settings"><i class="fa fa-angle-double-right"></i> Invoice Settings</a></li>
            <li><a href="/Table/Settings"><i class="fa fa-angle-double-right"></i> Table Settings</a></li>
            <li><a href="/Kitchen/Settings"><i class="fa fa-angle-double-right"></i> Kitchen Settings</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-cloud-download "></i> <span> Backup &amp; Restore</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right "></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/"><i class="fa fa-download"></i>Backup</a></li>
            <li><a href="/"><i class="fa fa-cloud-upload"></i> Restore</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar --> 
  </aside>