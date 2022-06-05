@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-shopping-bag"></i> Sales Report
        <small>| Generate &amp; print sales report </small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i>Dasbhoard</a></li>
        <li><a href="/Report"><i class="fa fa-product-hunt"></i>Report</a></li>
        <li class="active">Sales</li>
      </ol>
    </section>

    <!-- Main content -->
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

            {{ Form::open(array('class' => 'form-horizontal', 'id' => 'ReportForm')) }}

              <div class="form-group">
                <label for="VendorID" class="col-sm-1 col-md-offset-3 control-label">Report :</label>
                <div class="col-sm-3">
                  <select name="ReportName" class="form-control selectpicker" id="ReportName" data-live-search="true">
                    <option value="ProdutWise">Product Wise </option> 
                    <option value="CategoryWise">Category Wise</option>                    
                    <!-- <option value="LeastSold">Least Sold</option> -->
                    <option value="ShopwiseGPSummary">Shopwise GPSummary</option>       
                    <option value="MonthwiseGpSummary">Monthwise GPSummary</option>        
                    <option value="Refund">Refund</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="ShopID" class="control-label col-sm-1">Shop :</label>
                <div class="col-sm-3">
                  <select name="ShopID" class="form-control selectpicker" id="ShopID" data-live-search="true">
                    <option value="0" selected>Select Shop</option>
                    @foreach($ShopList as $data)
                      <option value="{{$data->ShopID}}">{{$data->ShopName}} </option>
                    @endforeach 
                  </select>
                </div>

                <label for="CategoryID" class="col-sm-1 control-label">Cat :</label>
                <div class="col-sm-3">
                  <select name="CategoryID" class="form-control selectpicker" id="CategoryID" data-live-search="true">
                    <option selected value="0" >Select Category</option>
                    @foreach($CategoryList as $data)
                      <option value="{{$data->CategoryID}}">{{$data->CategoryName}} </option>
                    @endforeach 
                  </select>
                </div>

                <label for="VendorID" class="col-sm-1 control-label">Vendor :</label>
                <div class="col-sm-3">
                  <select name="VendorID" class="form-control selectpicker" id="VendorID" data-live-search="true">
                    <option selected value="0" >Select Vendor</option>

                    @foreach($VendorList as $data)
                      <option value="{{$data->VendorID}}">{{$data->VendorName}} </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group ">
                <label for="UserID" class="control-label col-sm-1">User :</label>
                <div class="col-sm-3">
                  <select name="UserID" id="UserID" class="form-control selectpicker" data-live-search="true">
                    <option value="0">Select User</option>
                    @foreach ($UserList as $User)
                      <option value="{{ $User->id }}">{{ $User->name }}</option>
                    @endforeach
                  </select>
                </div>

                <label for="FromDate" class="col-sm-1 control-label" id="FromLabel">From:</label>
                <div class="col-sm-3">
                  <input type="date" id="From" name="From" class="form-control">
                </div>

                <label for="ToDate" class="col-sm-1 control-label" id="ToLabel">To :</label>
                <div class="col-sm-3">
                  <input type="date" id="To" name="To" class="form-control">
                </div>
              </div>

              <div class="col-md-4 col-md-offset-4">
                <input type="button" name="submit" value="Generate Sales Report" class="btn btn-flat btn-lg bg-olive" id="SalesReport">
               </div>
            {{ Form::close() }} 
          </div>
        </div>
      </div>
    </section>   
  </div>

<script>

  $(document).ready(function()
  {
    $('#ReportName').on('change', function(e){

      var ReportName = $('#ReportName').val();

      switch(ReportName){
        case 'ProdutWise':
          $('#ReportForm').append('Hello World');
        break;

        case 'CategoryWise':
        break;

        case 'ShopwiseGPSummary':
        break;

        case 'MonthwiseGpSummary':
        break;

        default:
        break;
      }
    });

    $('#SalesReport').on('click',function()
    {
      var ReportName = $('#ReportName').val();

      var UserID = $('#UserID').val();

      var VendorID= $('#VendorID').val();

      var ShopID=$('#ShopID').val();

      var CategoryID=$('#CategoryID').val();

      var DateFrom=$('#From').val();

      var DateTo=$('#To').val();

      if(DateFrom == '')
      {
        DateFrom = 0;
      }
      
      if(DateTo == '')
      {
        DateTo = 0;
      }

      // var DateTo = (DateTo.getFullYear() + "-" + DateTo.getMonth()) + "-" + DateTo.getDate() ;

      var params = [
      'height='+screen.height,
      'width='+screen.width,
      'location=no',
      'fullscreen=yes' // only works in IE, but here for completeness
    ].join(',');    

    window.open("/Report/Sales/" + ReportName + '/' + ShopID + '/' + CategoryID + '/' + VendorID + '/' + UserID + '/' + DateFrom + '/' + DateTo, '', params);
    });
  });
</script>

@endsection