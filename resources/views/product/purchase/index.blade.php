@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-truck"></i> Purchase
        <small>Product Purchase</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Product"><i class="fa fa-product-hunt"></i> Product</a></li>
        <li><i class="fa fa-truck"></i> Purchase</li>
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
          <a href="/Product/Purchase/New" class="btn btn-flat bg-navy">
            <i class="fa fa-truck fa-3x"></i><br>
            New Purchase
          </a>

          <a href="/Product/Purchase/Return" class="btn btn-flat bg-navy">
            <i class="fa fa-truck fa-flip-horizontal fa-3x"></i> <br>
            Purchase Return
          </a>

          <a href="/Product/Purchase/List" class="btn btn-flat bg-navy">
            <i class="fa fa-list fa-3x"></i> <br>
            Purchase List
          </a>

          <a href="/Product/Purchase/Return/List" class="btn btn-flat bg-navy">
            <i class="fa fa-list fa-3x"></i> <br>
            Purchase Return List
          </a>
  
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
@endsection