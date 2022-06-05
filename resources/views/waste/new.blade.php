@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-recycle"></i> New Waste
        <small> | Add new waste</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Waste"><i class="fa fa-recycle"></i> Waste</a></li>
        <li class="active">New</li>
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
          {{ Form::open(array('url' => '/Waste/New', 'class' => 'form-horizontal')) }}  
            <div class="form-group">
              <label for="ShopID" class="control-label col-md-1">Shop :</label>
              <div class="col-md-2">
                <select name="ShopID" id="ShopID" class="form-control selectpicker" data-live-search="true">
                  <option  selected value="0">Main Stock</option>
                  @foreach ($ShopList as $Shop)
                    <option value="{{ $Shop->ShopID }}"> {{ $Shop->ShopName }} </option>
                  @endforeach
                </select>
              </div>

              <label for="CategoryID" class="control-label col-md-1">Category :</label>
              <div class="col-md-2">
                <select name="CategoryID" id="CategoryID" class="selectpicker form-control" data-live-search="true">                  
                  <option  selected value="0">Select Category</option>
                  @foreach ($CategoryList as $Category)
                    <option value="{{ $Category->CategoryID }}"> {{ $Category->CategoryName }} </option>
                  @endforeach
                </select>
              </div>

              <label for="VendorID" class="control-label col-md-1">Vendor :</label>
              <div class="col-md-2">
                <select name="VendorID" id="VendorID" class="form-control selectpicker" data-live-search="true">
                  <option  selected value="0"> Select Vendor</option>
                  @foreach ($VendorList as $Vendor)
                    <option value="{{ $Vendor->VendorID }} "> {{ $Vendor->VendorName }}</option>
                  @endforeach
                </select>
              </div>   

                               
            </div>

            <div class="form-group">
              <label for="ProductID" class="control-label col-md-1">Product :</label>
              <div class="col-md-2">
                <select name="ProductID" id="ProductID" class="form-control" data-live-search="true">
                  <option selected disabled>Select Product</option>
                  @foreach ($ProductList as $Product)
                    <option value="{{ $Product->ProductID }}" class="ProductOption">{{ $Product->ProductID.'-'.$Product->ProductName }}</option>
                  @endforeach
                </select>
              </div>

              <label for="Qty" class="control-label col-md-1">Qty :</label>
              <div class="col-md-2">
                <input type="number" class="form-control" name="Qty" id="Qty" placeholder="Qty">
              </div>

              <label for="UnitCost" class="control-label col-md-1">UnitCost :</label>
              <div class="col-md-2">
                <input type="number" class="form-control" name="UnitCost" id="UnitCost" placeholder="Unit Cost" readonly>
              </div>

              <label for="TotalCost" class="control-label col-md-1">TotalCost :</label>
              <div class="col-md-2">
                <input type="number" class="form-control" name="TotalCost" id="TotalCost" placeholder="Total Cost" readonly>
              </div>
            </div>

            <div class="form-group">

              <label for="WastedBy" class="control-label col-md-1">WastedBy :</label>

              <div class="col-md-2">
                <input type="text" class="form-control" name="WastedBy" id="WastedBy" placeholder="WastedBy">
              </div>

              <label for="Notes" class="control-label col-md-1">Notes :</label>

              <div class="col-md-2">
                <input type="text" class="form-control" name="Note" id="Note" placeholder="Notes">
              </div>   

            </div>

            <div class="form-group">
              <div class="col-md-4 col-md-offset-4">
                <input type="button" name="submit" class="btn btn-flat btn-block bg-olive" value="Add to Waste" id="WasteSubmit">
              </div>
            </div>
          {{ Form::close() }}
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->
    {{ Html::script('js/waste.js') }}
  </div>
  <!-- ======================= / Content Wrapper ========================= -->
@endsection