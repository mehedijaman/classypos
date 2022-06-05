@extends('layouts.admin')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <i class="fa fa-dashboard"></i>  Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">            
              <h3 class="box-title">Quick Access</h3>
            </div>
            
            <div class="box-body">
              <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                <a href="/Product" class="btn bg-aqua btn-block">
                  <i class="fa fa-product-hunt"></i> <br>
                   Product
                </a>
              </div>

              <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                <a href="/Vendor" class="btn bg-green btn-block">
                  <i class="fa fa-user"></i> <br>
                  Vendor
                </a>
              </div>

              <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                <a href="/Customer" class="btn btn-flat bg-purple btn-block">
                  <i class="fa fa-user"></i> <br>
                  Customer
                </a>
              </div>

              <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                <a href="/Income/New" class="btn btn-flat bg-olive btn-block">
                  <i class="fa fa-bookmark-o"></i> <br>
                  Income
                </a>
              </div>

              <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                <a href="/Expense/New" class="btn btn-flat bg-yellow btn-block">
                  <i class="fa fa-bookmark-o"></i> <br>
                  Expense
                </a>
              </div>

              <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                <a href="/Bank" class="btn btn-flat bg-red btn-block">
                  <i class="fa fa-university"></i> <br>
                  Bank
                </a>
              </div>

              <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                <a href="/Shop" class="btn btn-flat bg-navy btn-block">
                  <i class="fa fa-home"></i> <br>
                  Shop
                </a>
              </div>

              <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                <a href="/User" class="btn btn-flat bg-navy btn-block">
                  <i class="fa fa-hand-lizard-o"></i> <br>
                  HRM
                </a>
              </div>

              <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                <a href="/Waste" class="btn btn-flat bg-purple btn-block">
                  <i class="fa fa-recycle"></i> <br>
                  Waste
                </a>
              </div>

              <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                <a href="/Report" class="btn btn-flat bg-olive btn-block">
                  <i class="fa fa-print"></i> <br>
                  Report
                </a>
              </div>

              <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                <a href="/Settings" class="btn btn-flat bg-navy btn-block">
                  <i class="fa fa-cogs"></i> <br>
                  Settings
                </a>
              </div> 

              <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                <a href="/" class="btn btn-flat bg-navy btn-block">
                  <i class="fa fa-download"></i> <br>
                  Backup & Restore
                </a>
              </div>              
            </div>
          </div>
        </div>
      </div>

      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Today Summary</h3>
            </div>
            <div class="box-body">
              
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-bag"></i></span>
              <!-- 
              <div class="info-box-content">
                <span class="info-box-text">Today's Total Sale</span>
                <span class="info-box-number"> {{ round($TodaysSaleTotal[0]->SubTotal,2) }} {{ CurrencySymbol() }}</span>
              </div> -->
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-text-height"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today's Total VAT</span>
                <span class="info-box-number">{{ round($TodaysSaleTotal[0]->TaxTotal,2) }} {{ CurrencySymbol() }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix visible-sm-block"></div>

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-hand-o-left"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today's Total Refund</span>
                <span class="info-box-number">{{ round($TodaysTotalRefund[0]->TotalPrice,2) }} {{ CurrencySymbol() }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-calculator"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Total Expense  </span>
                <span class="info-box-number">{{ round($TodaysTotalExpense[0]->Total,2) }} {{ CurrencySymbol() }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
      
      <!-- /.row -->
      <div class="row">
        <div class="col-md-4">
          <!-- Shop of the Month -->
          <div class="info-box bg-purple">
            <span class="info-box-icon"><i class="fa fa-home"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Shop of the Month</span>
              <span class="info-box-number">Shop of the Month</span>

              <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
              </div>
                  <span class="progress-description">
                    20% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div> 
        </div>

        <div class="col-md-4">
          <!-- Shop of the Month -->
          <div class="info-box bg-olive">
            <span class="info-box-icon"><i class="fa fa-home"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Product of the Month</span>
              <span class="info-box-number">Product of the Month</span>

              <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
              </div>
                  <span class="progress-description">
                    20% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div> 
        </div>
        <div class="col-md-4">
          <!-- Shop of the Month -->
          <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="fa fa-home"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Salesman of the Month</span>
              <span class="info-box-number">Salesman of the Month</span>

              <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
              </div>
                  <span class="progress-description">
                    20% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div> 
        </div>
      </div>

      <div class="row">
        <div class="col-md-8">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Sales Chart</h3>
              <div class="box-tools pull-right">

              <button type="button" class="btn btn-box-tool" ><i class="fa fa-refresh"></i>
                </button>
                

                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>

                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <p class="text-center">
                    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 180px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">TOTAL REVENUE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">TOTAL COST</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Top Products of the Month</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" ><i class="fa fa-refresh"></i>
                </button>

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>

                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="chart-responsive">
                    <canvas id="pieChart" height="200"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-12">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                    <li><i class="fa fa-circle-o text-green"></i> IE</li>
                    <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                    <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                    <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
                   
        </div>
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">

        <!-- Left col -->
        <div class="col-md-8">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Invoices</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="InvoiceList" class="table no-margin">
                  <thead>
                  <tr>
                    <th>Invoice ID</th>
                    <th>Shop</th>
                    <th>Tax</th>
                    <th>Total</th>
                    <th>UserID</th>
                    <th>InvoiceDate</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($LatestInvoices as $Invoice)
                      <tr>
                        <td>
                          <a href="/Invoice/Sales/Print/{{ $Invoice->InvoiceID }}" id="InvoiceID" target="_top" class="btn btn-default btn-flat" 
                          onclick="window.open(this.href,'targetWindow',
                          'width=300, height=800'); return false;">

                            {{ $Invoice->InvoiceID }}
                          </a>
                        </td>
                        <td>{{ $Invoice->ShopName }}</td>
                        <td>{{ $Invoice->TaxTotal }}</td>
                        <td>{{ $Invoice->Total }}</td>
                        <td>{{ $Invoice->FirstName }}</td>
                        <td>{{ date('d-m-Y h:i A', strtotime($Invoice->created_at)) }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="/Invoice/List" class="btn btn-sm bg-purple btn-flat pull-right">View All Invoice</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">          

          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Products</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                @foreach ($LatestProducts as $Product)
                  <li class="item">
                    <div class="product-img">
                      <img src="dist/img/default-50x50.gif" alt="Product Image">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">{{ $Product->ProductID }}
                        <span class="label label-warning pull-right">{{ $Product->SalePrice }}</span></a>
                          <span class="product-description">
                            {{ $Product->ProductName }}
                          </span>
                    </div>
                  </li>
                @endforeach
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="/Product/List" class="btn btn-sm bg-purple btn-flat pull-right">View All Products</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  </div>
@endsection


