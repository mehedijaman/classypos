@extends('layouts.admin')
@section('content')


  <div class="content-wrapper">  
    <!--==================== Content Header (Page header) ====================-->
    <section class="content-header">
      <h1>
        <i class="fa fa-truck fa-flip-horizontal "></i>
        Purchase Return
        <small>| Return purchased products to supplier</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Product"><i class="fa fa-product-hunt"></i> Product</a></li>
        <li><a href="/Product/Purchase"><i class="fa fa-truck"></i> Purchase</a></li>
        <li class="active"> <i class="fa fa-truck fa-flip-horizontal"></i> Return</li>
      </ol>
    </section>
    <!--==================== /Content Header ====================-->

    <!--==================== Main content ====================-->
    <section class="content">    
      <div class="box box-primary">

        <div class="box-header with-border">
          <!-- <h3 class="box-title">Product Purchase</h3> -->
        </div>
    
        <div class="box-body">

          {{ Form::open(array( 'id' => 'PurchaseForm', 'role' => 'form', 'class' => 'form-horizontal')) }}

            <div class="form-group">              
              <!-- <label for="InvoiceID" class="col-sm-2 control-label">Invoice Number :</label> -->
              <div class="col-sm-4" >
                <div class="input-group">
                  <span class="input-group-addon bg-navy"><strong>Invoice Number :</strong></span>
                  <input name="InvoiceID" type="text" class="form-control" id="InvoiceID" placeholder="Enter InvoiceID"  required>
                </div>
              </div>

              <!-- <label for="SupplierID" class="col-sm-2 control-label">Supplier :</label> -->
              <div class="col-sm-3">
                <div class="input-group">
                  <span class="input-group-addon bg-navy"><strong>Supplier :</strong></span>
                  <select name="SupplierID" class=" form-control selectpicker" id="SupplierID" required>
                    <option value="0" selected disabled>Select Supplier</option>
                    @foreach($VendorList as $data)             
                      <option value="{{$data->VendorID}}">{{$data->VendorName}}</option>
                    @endforeach                
                  </select>
                </div>
              </div>
            </div>

            <hr>

            <table class="table table-striped table-responsive">
              <thead id="FirstProductRow">
                <tr>
                  <td class="col-md-1">
                    <select class="form-control ShopID selectpicker" id="ShopID" name="ShopID[]" >
                      <option selected="selected" value="0">Shop</option>
                      @foreach($Shop as $data)
                        <option value="{{$data->ShopID}}">{{$data->ShopName}}</option> 
                      @endforeach 
                    </select>
                  </td>

                  <td class="col-md-1">
                    <select name="ProductCategory[]" class="form-control ProductCategory selectpicker"  id="MaPrCat" >
                      <option disabled="disabled" selected="selected">Category</option>
                      @foreach($CategoryList as $data)
                        <option value="{{$data->CategoryID}}">{{$data->CategoryName}}</option> 
                      @endforeach 
                    </select>
                  </td>

                  <td class="col-md-2">
                   <select name="ProductID[]" class="form-control ProductID " >
                      <option disabled="disabled" selected="selected">Product</option>
                    </select> 
                  </td>

                  <td class="col-md-2 has-warning">
                    <div class="input-group">
                      <span class="input-group-addon bg-navy">Qty:</span>
                      <input type="number" name="Qty[]" class="form-control Qty" placeholder="Qty" value="1">
                      <span class="input-group-addon bg-olive" id="StockQuantity">Stock:</span>

                    </div>
                  </td>

                  <td class="col-md-2 has-warning">
                    <div class="input-group">
                      <span class="input-group-addon bg-navy">Price:</span>
                      <input type="number" name="UnitPrice[]" class="form-control UnitPrice" placeholder="Price" value="" autocomplete="off">
                    </div>
                  </td>

                  <td class="col-md-1 has-warning">
                    <input type="text" name="Reason[]" class="form-control Reason" placeholder="Reason" autocomplete="off">
                  </td>

                  <td class="col-md-2 has-success">              
                    <div >
                      <div class="input-group">
                        <span class="input-group-addon bg-navy">Total:</span>
                        <input name="SubTotal[]" type="number" class="form-control" id="SubTotal" placeholder="SubTotal" value="0" readonly="true" >

                        <span class="input-group-btn">
                          <button title="Add Row" id="increase" type="button" name="addbutton[]" class="btn btn-flat bg-blue addbutton"><i name="minus[]" class="fa fa-plus minus"></i></button>
                        </span>
                      </div>
                    </div>
                  </td> 
                </tr>
              </thead>

              <!-- Row will inserted in this area -->
              <tbody id="NewProductRow"> </tbody> 
            </table>

            <hr>

            <div class="form-group ">
              <!-- <label for="Total" class="col-sm-2 control-label ">Total :</label> -->

              <div class="col-sm-2 has-success">
                <div class="input-group">
                  <span class="input-group-addon bg-navy"><strong>Total :</strong></span>
                  <input name="TotalPrice" type="text" class="form-control " id="TotalPrice" placeholder="Total Price" autocomplete="off" readonly="true" title="Total">
                </div>
              </div>

              <div class="col-sm-3 has-warning">
                <div class="input-group">
                  <span class="input-group-addon bg-navy"><strong>Received :</strong></span>
                  <input name="Paid" type="number" class="form-control" id="Paid" placeholder="Paid" value="0" autocomplete="off" title="Paid">
                </div>
              </div>

              <div class="col-sm-2 has-success">
                <div class="input-group">
                  <span class="input-group-addon bg-navy"><strong>Due :</strong></span>
                  <input name="Due" type="text" class="form-control" id="Due" placeholder="Due" value="0" autocomplete="off" readonly="true" title="Due">
                </div>
              </div>
            </div>

            <hr>              
            
            <div class="form-group">
              <div class="col-sm-12">
                <input type="button" name="submit" value="Return" class="btn bg-navy btn-flat " id="PurchaseButton">

                <button id="ResetBtn" class="btn btn-flat  bg-maroon" type="button">Reset</button>

                <a type="button" href="/Product/Purchase" class="btn btn-flat btn-danger">Cancel</a>
              </div>
            </div>
          {{ Form::close() }}
        </div>
      </div>
    </section>
      <!--==================== /Main content ====================-->
  </div>
  <!--==================== /Content wrapper ====================-->

  {{ Html::script('/js/purchase_return.js') }}

  <script>
  

  </script>
@endsection