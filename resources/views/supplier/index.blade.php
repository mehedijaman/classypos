@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-lg fa-user"></i> Vendor
        <small>Vendor Operations</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-2x fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Vendor</li>
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
          <a href="/Vendor/New" class="btn btn-flat bg-navy">
            <i class="fa fa-2x fa-user-plus"></i> <br>
            <strong>New Vendor</strong>
          </a>


          <a href="/Vendor/List" class="btn btn-flat bg-purple">
            <i class="fa fa-2x fa-list"></i> <br>
            <strong>Vendor List</strong>
          </a>

          <a href="/Vendor/Barcode" class="btn btn-flat bg-navy">
            <i class="fa fa-2x fa-barcode"></i> <br>
            <strong>Barcode</strong>
          </a>

          <a href="/Vendor/Balance" class="btn btn-flat bg-olive">
            <i class="fa fa-2x fa-bookmark-o"></i> <br>
            <strong>Balance</strong>
          </a>

          <a href="/Vendor/Ledger" class="btn btn-flat bg-purple">
            <i class="fa fa-2x fa-book"></i> <br>
            <strong>Ledger</strong>
          </a>

          <a href="/Vendor/Payment" class="btn btn-flat bg-maroon">
            <i class="fa fa-2x fa-hand-lizard-o"></i> <br>
            <strong>Payment</strong>
          </a>
  
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
@endsection