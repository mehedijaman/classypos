@extends('layouts.admin')

@section('content')


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-qrcode"></i> Product QR Code
        <small>Generate &amp; print QR Code </small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i>Dasbhoard</a></li>
        <li><a href="/Product"><i class="fa fa-product-hunt"></i>Product</a></li>
        <li class="active">QR Code</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="col-sm-12">

        <div class="box box-primary">  
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-print"></i> QR Code Generation</h3>
            <!-- <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div> -->
          </div>

          <div class="box-body">
          

            {{ Form::open(array('url' => '/Product/QRCode/Print', 'onsubmit' => "window.open('','ProductBarcode','width=+screen.width,height=+screen.height,scrollbars=yes,fullscreen=yes')", 'target'=>"ProductBarcode", 'class' => 'form-horizontal', 'method' => 'post')) }}
            

              <input type="hidden" name="UserDefinedShopName" id="UserDefinedShopName">
              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group ">
                
                  <div class="col-sm-2">
                    <select name="ShopID" class="form-control select2" id="ShopID" data-live-search="true">
                      <option  selected disabled>Select Shop</option>
                      <option value="0" >Main Stock</option>
                      @foreach($shop as $data)
                        <option value="{{$data->ShopID}}">{{$data->ShopName}} </option>
                      @endforeach 
                    </select>
                    
                  </div>

                 
                  <div class="col-sm-2">
                    <select name="CategoryID" class="form-control select2" id="CategoryID" data-live-search="true">
                      <option selected value="0" >Select Category</option>
                      @foreach($Category as $data)
                        <option value="{{$data->CategoryID}}">{{$data->CategoryName}} </option>
                      @endforeach 
                    </select>
                  </div>

                  <div class="col-sm-2">
                    <select name="VendorID" class="form-control select2" id="VendorID" data-live-search="true">
                      <option selected value="0" >Select Vendor</option>

                      @foreach($ven as $data)
                        <option value="{{$data->VendorID}}">{{$data->VendorName}} </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <div class="input-group">
                      <span class="input-group-addon bg-blue">From :</span>                    
                      <input type="date" id="From" name="From" class="form-control" placeholder="mm/dd/yyyy">
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="input-group">
                      <span class="input-group-addon bg-blue">To :</span>                    
                      <input type="date" id="To" name="To" class="form-control" placeholder="mm/dd/yyyy">
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <button type="button" class="btn btn-primary" id="ShowAllBtn">Show All</button>
                  </div>
                </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div id="SelectAllArea">
                    <div class="col-sm-2">
                      <div id="HideTheCheckbox">
                      <input type="checkbox" class="btn  " id="SelectAll" name="SelectAll">
                      </div>
                      <label class="btn btn-flat bg-blue" for="SelectAll">Select All</label>
                    </div>

                    
                    <div class="col-sm-2 col-sm-offset-8">
                      <div class="input-group">
                        <span class="input-group-addon bg-navy">Qty :</span>
                        <input type="number" name="tt"  id="common" class="form-control">
                      </div> 
                    </div>
                  </div> 
                </div>
              </div>

              

              <div class="row">
                <div class="col-md-12">
                  <!-- =====Product List Table===== -->
                  <!-- <table class="table table-bordered table-striped" id="examplebarcode"> -->

                    <!-- <thead> -->
                      <!-- <tr> -->
                        <!-- <th> Select    </th> -->
                        <!-- <th> Product ID    </th> -->
                        <!-- <th> Product Name </th> -->
                        <!-- <th> Date </th> -->
                        <!-- <th> Barcode Qty   </th> -->
                      <!-- </tr>  -->
                    <!-- </thead> -->

                    <input type="hidden" id="RowNumber" value="0">
                    
                    <tbody id="ProductList"> </tbody>
                  </table>

                <table id="example" class="display" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                  <th>Select</th>
                  <th>Product ID</th>
                  <th>Product Name</th>
                  <th>Date</th>
                  <th>BarCode Quantity </th>
                  </tr>
                  </thead>                
                </table>       

                                                 

                  <div id="fad" class="col-md-4 col-md-offset-2"> </div>
                </div>
              </div>

              {{ Form::close() }} 
            
          </div>
        </div>
      </div>


       <!-- =================== ShopName Modal ===================-->
      <div class="modal" id="ShopNameselect" role="dialog">
        <div class="modal-dialog modalquantity">
          <!-- =================== Modal content =================== -->
          <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <div class="modal-content">

              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">ShopName</p>
                </h1>
              </div>

              <div class="modal-body">

                <div class="input-group">
                  <input type="hidden" name="quanindex" id="quanindex">

                  <input type="text" class="form-control" id="modalshopname" autocomplete="off" placeholder="Please Enter a Shop Name for BarCode Printing">
                  

                  <span class="input-group-btn">              
                    <input  class="btn bg-purple usersel btn-flat" id="shopname" type="button" value="Apply"><br>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- =================== ShopName Modal ===================-->

    </section>   
  </div>
  <script>
    $(document).ready(function() {
      //$(".select2").select2({
        //theme: "bootstrap"
      //});

      //$('#From').datepicker();
      //$('#To').datepicker();
    });
  </script>

  {{ Html::script('/js/qrcode.js') }}

@endsection