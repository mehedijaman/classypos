@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-lg fa-user"></i> Customer
        <small>Customer Operations</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-2x fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Customer</li>
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
          <a href="/Customer/New" class="btn btn-flat bg-navy">
            <i class="fa fa-2x fa-user-plus"></i> <br>
            <strong>New Customer</strong>
          </a>


          <a href="/Customer/List" class="btn btn-flat bg-purple">
            <i class="fa fa-2x fa-list"></i> <br>
            <strong>Customer List</strong>
          </a>

          <a href="/Customer/Barcode" class="btn btn-flat bg-navy">
            <i class="fa fa-2x fa-barcode"></i> <br>
            <strong>Barcode</strong>
          </a>

          <a href="/Customer/Balance" class="btn btn-flat bg-olive">
            <i class="fa fa-2x fa-bookmark-o"></i> <br>
            <strong>Balance</strong>
          </a>

          <a href="/Customer/Ledger" class="btn btn-flat bg-purple">
            <i class="fa fa-2x fa-book"></i> <br>
            <strong>Ledger</strong>
          </a>

          <a href="/Customer/Payment" class="btn btn-flat bg-orange">
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