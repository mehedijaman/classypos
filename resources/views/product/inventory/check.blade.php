@extends('layouts.admin')
@section('content')

  <!-- ============================ Wrapper ====================== -->
  <div class="content-wrapper">
    <!-- ============================ Content Header ====================== -->
    <section class="content-header">
      <h1>
        <i class="fa fa-search"></i> Inventory Check
        <small>Check All Product Inventory</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Product"> Product</a></li>
        <li class="active">Inventory</li>
      </ol>
    </section>
    <!-- ============================ / Content header ====================== -->

    <!--============================= Main content ===========================-->
    <section class="content">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Scan the barcodes</h3>
            </div>
            <div class="box-body">
              {{ Form::open(array('class' => 'form-inline', 'id' => 'InventoryCheckForm')) }}

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <select name="ShopID" id="ShopID" class="form-control">
                      <option selected="true" disabled="true">Select a Shop</option>
                      @foreach ($ShopList as $Shop)
                        <option value="{{ $Shop->ShopID }}">{{ $Shop->ShopName }}</option>      
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                    <input type="text" class="form-control" autofocus="true" id="ProductID" placeholder="Scan Barcode here">
                  </div>
                </div>

                <button type="submit" name="Submit" value="Check" class="btn btn-primary btn-flat"><i class="fa fa-search"></i> Check</button>

                <button class="btn btn-success btn-flat" type="button" id="PrintInventory"><i class="fa fa-print"></i> Print Report</button>

                <button class="btn bg-maroon btn-flat" type="button" id="ResetInventory"><i class="fa fa-refresh"></i> Reset</button>
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  {{ Html::script('js/inventory.js') }}
@endsection


       