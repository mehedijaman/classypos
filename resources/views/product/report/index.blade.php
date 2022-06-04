@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-product-hunt"></i> Product Report
        <small>| Generate &amp; print product report </small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i>Dasbhoard</a></li>
        <li><a href="/Product"><i class="fa fa-product-hunt"></i>Product</a></li>
        <li><a href="/Product/Barcode"><i class="fa fa-barcode"></i>Barcode</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <style>
      
      ./*col-sm-1
      {
        margin-right:-14px;
        margin-left:-24px;
      }
      #From
      {
        margin-left: -10px;
      }
      #FromLabel,#ToLabel
      {
        margin-left:-45px;
      }*/
    </style>

    <!-- Main content -->
    <section class="content">

      <div class="col-sm-12">

        <div class="box box-success box-solid">  
          <div class="box-header with-border">
            <h3 class="box-title"> Product Report</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>

          <div class="box-body">

            {{ Form::open(array('class' => 'form-horizontal')) }}


              <div class="form-group">
                <label for="ShopID" class="control-label col-sm-1 col-sm-offset-4">Shop : </label>
                <div class="col-sm-2 ">
                  <select name="ShopID" class="form-control selectpicker" id="ShopID" data-live-search="true">
                    <option selected value="0" >Select Shop</option>
                    @foreach($ShopList as $data)
                      <option value="{{$data->ShopID}}">{{$data->ShopName}} </option>
                    @endforeach 
                  </select>
                </div>
              </div>
              <div class="form-group ">               


                <label for="CategoryID" class="col-sm-1 control-label">Category:</label>
                <div class="col-sm-2">
                  <select name="CategoryID" class="form-control selectpicker" id="CategoryID" data-live-search="true">
                    <option selected value="0" >Select Category</option>
                    @foreach($CategoryList as $data)
                      <option value="{{$data->CategoryID}}">{{$data->CategoryName}} </option>
                    @endforeach 
                  </select>
                </div>

                <label for="VendorID" class="col-sm-1 control-label">Vendor :</label>
                <div class="col-sm-2">
                  <select name="VendorID" class="form-control selectpicker" id="VendorID" data-live-search="true">
                    <option selected value="0" >Select Vendor</option>

                    @foreach($VendorList as $data)
                      <option value="{{$data->VendorID}}">{{$data->VendorName}} </option>
                    @endforeach
                  </select>
                </div>
                <label for="FromDate" class="col-sm-1 control-label" id="FromLabel">From :</label>
                <div class="col-sm-2">
                  <input type="date" id="From" name="From" class="form-control">
                </div>

                <label for="ToDate" class="col-sm-1 control-label" id="ToLabel">To :</label>
                <div class="col-sm-2">
                  <input type="date" id="To" name="To" class="form-control">
                </div>
              </div>


              <div class="form-group">

              <label class="col-sm-1">Quantity:</label>

              <div class="col-md-2">

                <input type="number" name="maximum quantity" placeholder="Maximum Quantity" id="maximumquantity" min="0" class="form-control">

              </div>

              </div>


              <div class="col-md-4 col-md-offset-4">

                <input type="button" name="submit" value="Generate Product Report" class="btn btn-flat btn-lg bg-olive" id="ProductReport">

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

    $('#ProductReport').on('click',function()

    {

      var VendorID= $('#VendorID').val();
      var ShopID=$('#ShopID').val();
      var CategoryID=$('#CategoryID').val();
      var DateFrom=$('#From').val();
      var DateTo=$('#To').val();
      var Quantity=$('#maximumquantity').val();
      if(Quantity=="" || Quantity==null)
      {
        
        Quantity=1000000;
      }

      if(DateFrom=='')
      {
        DateFrom=0;
      }
      
      if(DateTo=='')
      {
        DateTo=0;
      } 


      var params = [
      'height='+screen.height,
      'width='+screen.width,
      'location=no',
      'fullscreen=yes' // only works in IE, but here for completeness
    ].join(',');

    window.open("/Report/Product/"+ShopID+'/'+CategoryID+'/'+VendorID+'/'+DateFrom+'/'+DateTo+'/'+Quantity, '', params);
    });


  });
</script>

@endsection