@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> Product
        <small>Product Operations</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Product</li>
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
          <a href="/Product/New" class="btn btn-flat bg-navy">
            <i class="fa fa-user-plus fa-2x"></i> <br>
            <strong>New Product</strong>
          </a>


          <a href="/Product/List" class="btn btn-flat bg-purple">
            <i class="fa fa-list fa-2x"></i> <br>
            <strong>Product List</strong>
          </a>

          <a href="/Product/Barcode" class="btn btn-flat bg-navy">
            <i class="fa fa-barcode fa-2x"></i> <br>
            <strong>Barcode</strong>
          </a>

          <a href="/Product/Category" class="btn btn-flat bg-olive">
            <i class="fa fa-bookmark-o fa-2x"></i> <br>
            <strong>Category</strong>
          </a>

          <a href="/Product/Distribute" class="btn btn-flat bg-purple">
            <i class="fa fa-share fa-2x"></i> <br>
            <strong>Distribute</strong>
          </a>

          <a href="/Product/Purchase" class="btn btn-flat bg-maroon">
            <i class="fa fa-truck fa-2x"></i> <br>
            <strong>Purchase</strong>
          </a>

          <a href="/Product/Inventory" class="btn btn-flat bg-navy">
            <i class="fa fa-search fa-2x"></i> <br>
            <strong>Inventory Check</strong>
          </a>
  
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
@endsection