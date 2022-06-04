@extends('layouts.admin')

@section('content')

  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user fa-lg"></i> Invoice List
        <small>Invoice List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Settings</li>
        
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->


    <!-- ======================= Main Content ========================= -->
    <section class="content">
      <div class="col-sm-12">

        <div class="box box-success box-solid">  
          <div class="box-header with-border">
            <h3 class="box-title"> Sales Report</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>

          <div class="box-body">

              <!-- <div class="form-group"> -->
                <div class="col-sm-3">
                  <div class="input-group">
                    <span class="input-group-addon">Shop</span>
                    <select name="ShopID" class="form-control selectpicker" id="ShopID" data-live-search="true">
                      <option value="0" selected>Select Shop</option>
                      @foreach($ShopList as $data)
                        <option value="{{$data->ShopID}}">{{$data->ShopName}} </option>
                      @endforeach 
                    </select>
                  </div>
                </div>
              <!-- </div> -->

              <!-- <div class="form-group"> -->
                <div class="col-sm-3">
                  <div class="input-group">
                    <span class="input-group-addon">From</span>
                    <input type="date" class="form-control" name="DateFrom">
                  </div>
                </div>
              <!-- </div> -->

              <!-- <div class="form-group"> -->
                <div class="col-sm-3">
                  <div class="input-group">
                    <span class="input-group-addon">To</span>
                    <input type="date" class="form-control" name="DateTo">
                  </div>
                </div>
              <!-- </div> -->
              
              <!-- <div class="form-group"> -->
                <div class="col-md-3">
                  <input type="button" name="submit" value="Generate Sales Report" class="btn btn-flat  bg-olive" id="SalesReport">
                </div>
              <!-- </div> -->

              
          </div>
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
@endsection