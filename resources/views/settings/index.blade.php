@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-cogs"></i> Settings
        <small>| Settings Operations</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-cogs"></i> Settings</li>
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
          <a href="/OnScreenButton" class="btn btn-app btn-flat bg-navy">
            <i class="fa fa-product-hunt"></i>
            On Screen Button
          </a>

          <a href="/PaymentMethod" class="btn btn-app btn-flat bg-navy">
            <i class="fa fa-shopping-bag"></i>
            Payment Method
          </a>

          <a href="/Invoice/Settings" class="btn btn-app btn-flat bg-navy">
            <i class="fa fa-recycle"></i>
            Invoice Settings
          </a>
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
@endsection