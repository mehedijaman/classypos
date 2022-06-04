@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> Report
        <small>Report Operations</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Report</li>
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->


    <!-- ======================= Main Content ========================= -->
    <section class="content">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border">
          
        </div>
        <div class="box-body">
          <a href="/Report/Product" class="btn btn-app btn-flat bg-navy">
            <i class="fa fa-product-hunt"></i>
            Product Report
          </a>

          <a href="/Report/Sales" class="btn btn-app btn-flat bg-navy">
            <i class="fa fa-shopping-bag"></i>
            Sales Report
          </a>

          <a href="/Report/Waste" class="btn btn-app btn-flat bg-navy">
            <i class="fa fa-recycle"></i>
            Waste Report
          </a>

          <a href="/Report/Activity" class="btn btn-app btn-flat bg-navy">
            <i class="fa fa-shopping-bag"></i>
            Activity Report
          </a>
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
@endsection