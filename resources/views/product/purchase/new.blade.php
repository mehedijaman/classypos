@extends('layouts.admin')
@section('content')

<?php 
  if (isset($_REQUEST['Success'])) {
    $Success = $_REQUEST['Success'];

    if ($Success == 1) {
      echo "<script>alertify.success(' Task done Successfully !');  </script>";
    }

    if ($Success == 0) {
      echo "<script>alertify.error('Error occured !');  </script>";
    }
  }  
?>


<div class="content-wrapper">
  <!--==================== Content Header (Page header) ====================-->
  <section class="content-header">
    <h1>
      <i class="fa fa-truck"></i>
      Product Purchase
      <small>| Purchase products according to purchase invoice</small>
    </h1>

     <ol class="breadcrumb">
      <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="/Product"><i class="fa fa-product-hunt"></i> Product</a></li>
      <li><a href="/Product/Purchase"><i class="fa fa-truck "></i> Purchase</a></li>
      <li class="active">New</li>
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

            {{ Form::open(array('id' => 'PurchaseForm', 'role' => 'form', 'class' => 'form-horizontal')) }}

              <div class="form-group">              
                <!-- <label for="InvoiceID" class="col-sm-2 control-label">Invoice Number :</label> -->
                <div class="col-sm-4" >
                  <div class="input-group">
                    <span class="input-group-addon bg-navy"><strong>Invoice Number :</strong></span>
                    <input name="InvoiceID" type="text" class="form-control" id="InvoiceID" placeholder="Enter InvoiceID"  required>
                  </div>
                </div>

                <!-- <label for="SupplierID" class="col-sm-2 control-label">Supplier :</label> -->
                <div class="col-sm-4">
                  <div class="input-group">
                    <span class="input-group-addon bg-navy"><strong>Supplier :</strong></span>
                    <select name="SupplierID" class="select2" id="SupplierID" required data-live-search="true">
                      <option value="0" selected disabled>Select Supplier</option>
                      @foreach($VendorList as $data)             
                      <option value="{{$data->VendorID}}">{{$data->VendorName}}</option>
                      @endforeach                
                    </select>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-flat bg-blue" data-toggle="modal" data-target="#NewSupplierModal" title="Add New Supplier"><i class="fa fa-plus"></i></button>
                    </span>
                  </div>
                </div>
              </div>

              <hr>

              <div class="form-group">
                <div class="col-sm-4 col-sm-offset-4">
                  <label for="ProductID" class="control-label">Product </label>

                  <button title="Add New Product" data-toggle="modal" data-target="#NewProductModal" type="button" class="btn btn-flat bg-blue"><i class="fa fa-plus"></i></button>                  
                </div>
              </div>
                              
              <table class="table table-striped table-responsive">
                <thead id="FirstProductRow">
                  <tr>
                    <td >
                      <select name="ProductCategory[]" class="form-control ProductCategory" id="MaPrCat CategoryID" >
                        <option disabled="disabled" selected="selected">Category</option>
                        @foreach($CategoryList as $data)
                          <option value="{{$data->CategoryID}}">{{$data->CategoryName}}</option> 
                        @endforeach 
                      </select>
                    </td>

                    <td >
                     <select name="ProductID[]" class="form-control ProductID" >
                        <option disabled="disabled" selected="selected">Product</option>
                      </select> 
                    </td>

                    <td class="has-warning">
                      <div class="input-group">
                        <span class="input-group-addon bg-navy">Qty</span>
                        <input type="number" name="Qty[]" class="form-control Qty" placeholder="Quantity" value="1">
                      </div>
                    </td>

                    <td class=" has-warning">
                      <div class="input-group">
                        <span class="input-group-addon bg-navy">Price</span>
                        <input type="number" name="UnitPrice[]" class="form-control UnitPrice" placeholder="UnitPrice" value="" autocomplete="off">
                      </div>
                    </td>

                    <td class=" has-success">              
                      <div >
                        <div class="input-group">
                          <span class="input-group-addon bg-navy">Total</span>
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
                    <span class="input-group-addon bg-navy">Total</span>
                    <input name="TotalPrice" type="text" class="form-control " id="TotalPrice" placeholder="Total Price" autocomplete="off" readonly="true" title="Total">
                  </div>
                </div>

                <div class="col-sm-2 has-warning">
                  <div class="input-group">
                    <span class="input-group-addon bg-navy">Cash</span>
                    <input name="Paid" type="number" class="form-control" id="Paid" placeholder="Paid" value="0" autocomplete="off" title="Paid">
                  </div>
                </div>

                <div class="col-sm-2 has-success">
                  <div class="input-group">
                    <span class="input-group-addon bg-navy">Due</span>
                    <input name="Due" type="text" class="form-control" id="Due" placeholder="Due" value="0" autocomplete="off" readonly="true" title="Due">
                  </div>
                </div>

                <div class="col-sm-2">
                  <select name="PaymentMethod[]" class="form-control" id="PaymentMethod">
                    <option value="Cash">Cash</option>
                    <option value="Bank">Bank</option>
                  </select>
                </div>
              </div>

              <div class="form-group" id="Banking">
                <!-- <label for="Bank" class="col-sm-2 control-label">Bank :</label> -->
                <div class="col-sm-3">
                  <div class="input-group">
                    <div class="input-group">
                      <span class="input-group-addon bg-navy">Bank</span>

                      <select name="BankID" class="select2" data-live-search="true" id="BankAdd">
                        <option value="0" selected disabled>Select Bank</option>
                        @foreach($BankList as $Bank)               
                          <option value="{{ $Bank->BankID }}">{{ $Bank->BankName }}</option>
                        @endforeach                   
                      </select>

                      <span class="input-group-btn">
                        <button type="button" title="Add New Bank" class="btn btn-flat bg-blue" data-toggle="modal" data-target="#NewBankModal"><i class="fa fa-plus"></i></button>
                      </span>
                    </div>

                    
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="input-group">
                    <span class="input-group-addon bg-navy">Cheque Number</span>
                    <input type="text" name="ChequeNumber" id="ChequeNumber" class="form-control" placeholder="Cheque Number" value="0" >
                  </div>
                </div>

                <div class="col-sm-2 has-warning">
                  <div class="input-group">
                    <span class="input-group-addon bg-navy">Amount</span>
                    <input type="number" name="Withdraw" class="form-control" placeholder="Amount" id="Withdraw" value="0">
                  </div>
                </div>
              </div>

              <hr>              
              
              <div class="form-group">
                <div class="col-sm-12">
                  <input type="button" name="submit" value="Purchase" class="btn bg-navy btn-flat " id="PurchaseButton">

                  <button id="ResetBtn" class="btn btn-flat  bg-maroon" type="button">Reset</button>

                  <a type="button" href="/Product" class="btn btn-flat btn-danger">Cancel</a>
                </div>
              </div>
            {{ Form::close() }}
          </div>
        </div>

      <!--==================== New Product Modal ====================-->
      <div id="NewProductModal" class="modal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title text-center"><p class="label label-primary">Add New Product</p></h1>
            </div>
            <div class="modal-body">      

              {{ Form::open(array('url' => 'ProductNew', 'class' => 'form-horizontal')) }}   

                <div class="form-group">
                  <label for="CategoryID" class="col-sm-2 control-label">Category :</label>
                  <div class="col-sm-4">
                    <div class="input-group">
                      <select name="CategoryID" class="select2 form-control" data-live-search="true" id="PrCat">
                        @foreach($CategoryList as $Category) 
                          <option value="{{ $Category->CategoryID }}">{{ $Category->CategoryName }}</option>
                        @endforeach 
                     </select>

                      <span class="input-group-btn">
                        <button type="button" data-toggle="modal" data-target="#NewCategoryModal" class="btn bg-blue  btn-flat" title="Add New Category"><i class="fa fa-plus"></i></button>
                      </span>
                    </div>                    
                  </div> 

                  <label for="VendorID" class="col-sm-2 control-label">Vendor :</label>

                  <div class="col-sm-4">
                    <div class="input-group">
                      <select name="VendorID" class="select2" data-live-search="true" id="VendorID">   
                        @foreach($VendorList as $Vendor)             
                          <option value="{{ $Vendor->VendorID }}">{{ $Vendor->VendorName }}</option>
                        @endforeach    
                      </select>  

                      <span class="input-group-btn">
                        <button data-toggle="modal" data-target="#NewSupplierModal" type="button" class="btn btn-flat bg-blue" title="Add New Supplier"><i class="fa fa-plus"></i></button>
                      </span>                    
                    </div>
                  </div>                 
                </div>

                <div class="form-group">
                  <label for="ProductName" class="col-sm-2 control-label">Name :</label>

                  <div class="col-sm-4">
                    <input name="ProductName" type="text" class="form-control" id="ProductName" placeholder="Enter Product Name">
                  </div>

                  <label for="ProductDescription" class="col-sm-2 control-label">Description:</label>

                  <div class="col-sm-4">
                    <input name="ProductDescription" type="text" class="form-control" id="ProductDescription" placeholder="Product Description">
                  </div>
                </div>
            
                <div class="form-group">
                  <label for="Qty" class="col-sm-2 control-label">Qty :</label>
                  <div class="col-sm-4">

                    <input name="Qty" type="number" min="1" max="1000" step="1" class="form-control" id="Qty" placeholder="Qty" value="0">
                  </div>

                  <label for="MinQtyLevel" class="col-sm-2 control-label">MinQtLev :</label>
                  <div class="col-sm-4">
                    <input name="MinQtyLevel" type="text" class="form-control" id="MinQtyLevel" placeholder="MinQtyLevel">
                  </div>
                </div>

                <div class="form-group">
                  <label for="CostPrice" class="col-sm-2 control-label">CostPrice :</label>
                  <div class="col-sm-4">
                    <input name="CostPrice" type="number" class="form-control" id="CostPrice" placeholder="CostPrice">
                  </div>

                  <label for="SalePrice" class="col-sm-2 control-label">SalePrice :</label>
                  <div class="col-sm-4">
                    <input name="SalePrice" type="number" class="form-control" id="SalePrice" placeholder="SalePrice" value="0">
                  </div>
                </div>

                <div class="form-group">
                  <label for="Unit" class="col-sm-2 control-label">Unit :</label>
                  <div class="col-sm-4">
                    <input name="Unit" type="number" class="form-control" id="Unit" placeholder="Unit">
                  </div>

                  <label for="TaxCode" class="col-sm-2 control-label">TaxCode :</label>
                  <div class="col-sm-4">
                    <select name="TaxCode" class="form-control" id="TaxCode">    
                      @foreach ($TaxCodeList as $TaxCode)
                        <option value="{{ $TaxCode->TaxCodeID }}">{{ $TaxCode->TaxCode }}</option>
                      @endforeach             
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <input type="button" name="submit" value="Add New Product" class="btn btn-flat bg-navy" id="newproaj">

                    <input type="button" id="ResetBtn" class="btn btn-flat bg-maroon"  value="Reset">
                  </div>
                </div>                
              {{ Form::close() }}      
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-flat btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>      

      <!--==================== New Category Modal ====================-->
      <div id="NewCategoryModal" class="modal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title text-center"><p class="label label-primary">Add New Category</p></h1>
            </div>
            <div class="modal-body">

              {{ Form::open(array('class' => 'form-horizontal', 'id' => 'CategoryNewForm')) }}
            
                <div class="input-group">
                  <input type="text" placeholder="Enter Category Name" class="form-control" id="modcat"> 

                  <span class="input-group-btn">
                    <input type="submit" name="submit" value="Add" class="btn btn-flat btn-primary" id="shadab">
                    <input type="button" id="CategoryResetBtn" class="btn btn-flat bg-maroon"  value="Reset"> 
                  </span>                     
                </div>
              {{ Form::close() }}      
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-flat btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
      <!--==================== /New Category Modal ====================-->


      <!--==================== New Bank Modal ====================-->
      <div id="NewBankModal" class="modal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title text-center"><p class="label label-primary">Add New Bank</p></h1>
            </div>
            <div class="modal-body">

              {{ Form::open(array('class' => 'form-horizontal', 'id' => 'NewBankForm')) }}
                <div class="form-group">
                  <div class="col-sm-4">
                    <input type="text" placeholder="Enter Bank Name" class="form-control" id="modbank"> 
                  </div>                  

                  <div class="col-sm-4">
                  <input type="text" placeholder="Enter Balance Amount" class="form-control" id="modbankbalance"> 
                  </div>

                  <div class="col-sm-4">
                    <div class="btn-group">
                      <input type="submit" name="submit" value="Add New Bank" class="btn btn-primary btn-flat" id="BankModal">

                      <input type="button" id="ResetBtn" class="btn btn-flat bg-maroon"  value="Reset">
                    </div>
                  </div>
                  
                </div>
              {{ Form::close() }}      
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-flat btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
      <!--====================/ New Bank Modal ====================-->

      <!--==================== New Supplier Modal ====================-->
      <div id="NewSupplierModal" class="modal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title text-center"><p class="label label-primary">Add New Supplier</p></h1>
            </div>
            <div class="modal-body">

            <!-- <form method="POST" action="{{URL::to('')}}"> -->
          

              {{ Form::open(array('class' => 'form-horizontal')) }}

                <div class="form-group">
                  <label for="VendorName" class="col-sm-2 control-label">Vendor :</label>
                  <div class="col-sm-4">
                    <input name="VendorName" type="text" class="form-control" id="VendorName" placeholder="VendorName">
                  </div>

                  <label for="ContactName" class="col-sm-2 control-label">Contact:</label>
                  <div class="col-sm-4">
                    <input name="ContactName" type="text" class="form-control" id="ContactName" placeholder="ContactName">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Address" class="col-sm-2 control-label">Address :</label>
                  <div class="col-sm-10">
                    <input name="Address" type="text" class="form-control" id="Address" placeholder="Address">
                  </div>
                </div>

                <div class="form-group">
                  <label for="City" class="col-sm-2 control-label">City :</label>
                  <div class="col-sm-4">
                    <input name="City" type="text" class="form-control" id="City" placeholder="City">
                  </div>

                  <label for="Province" class="col-sm-2 control-label">Province :</label>
                  <div class="col-sm-4">
                    <input name="Province" type="text" class="form-control" id="Province" placeholder="Province">
                  </div>
                </div>

                <div class="form-group">
                  <label for="ZipCode" class="col-sm-2 control-label">ZipCode :</label>
                  <div class="col-sm-4">
                    <input name="ZipCode" type="text" class="form-control" id="ZipCode" placeholder="ZipCode">
                  </div>

                  <label for="Country" class="col-sm-2 control-label">Country :</label>
                  <div class="col-sm-4">
                    <input name="Country" type="text" class="form-control" id="Country" placeholder="Country">
                  </div>
                </div>


                <div class="form-group">
                  <label for="Phone1" class="col-sm-2 control-label">Phone1 :</label>
                  <div class="col-sm-4">
                    <input name="Phone1" type="text" class="form-control" id="Phone1" placeholder="Phone1">
                  </div>

                   <label for="Phone2" class="col-sm-2 control-label">Phone2 :</label>
                  <div class="col-sm-4">
                    <input name="Phone2" type="text" class="form-control" id="Phone2" placeholder="Phone2">
                  </div>
                </div>

                <div class="form-group">
                  <label for="Email" class="col-sm-2 control-label">Email :</label>
                  <div class="col-sm-4">
                    <input name="Email" type="text" class="form-control" id="Email" placeholder="Email">
                  </div>

                  <label for="Website" class="col-sm-2 control-label">Website :</label>
                  <div class="col-sm-4">
                    <input name="Website" type="text" class="form-control" id="Website" placeholder="Website">
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">

                    <input type="submit" name="submit" class="btn btn-flat bg-navy" value="Add Vendor">

                    <button type="button" class="btn btn-flat bg-maroon">Reset</button>
                  </div>
                </div>
              {{ Form::close() }}                 
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-flat btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
      <!--==================== /New Supplier Modal ====================-->
    </section>
    <!--==================== /Main content ====================-->
  </div>
  <!--==================== /Content wrapper ====================-->


  <script>
    $(document).ready(function(){

      $(".select2").select2({
        theme: "bootstrap"
      });

      $('#SupplierID').on('change',function(){

        var bankid=-10;

        var p=$('#PaymentMethod').val();

        if(p=="Bank"){

          bankid=$('#BankAdd').val();
        }

        var vid=$('#SupplierID').val();

        if(vid==null){

          $('#PurchaseButton').attr('disabled',true);
        }

        else{
          if(bankid!=null)
            $('#PurchaseButton').attr('disabled',false);
        }

      });

      var cc = 0;

      var vid=$('#SupplierID').val();

      if(vid==null){

        $('#PurchaseButton').attr('disabled',true);
      } 

      var due=$('#TotalPrice').val()-$('#Paid').val();     

      $('#Withdraw').keyup(function() {

        var due=$('#TotalPrice').val()-$('#Paid').val()-$('#Withdraw').val();
        $('#Due').val(due);
      });

      $('#Withdraw').click(function() {

        var due=$('#TotalPrice').val()-$('#Paid').val()-$('#Withdraw').val();

        $('#Due').val(due);
      });

      $('#Paid').on('keyup click',function(){
        var due=$('#TotalPrice').val()-$('#Paid').val()-$('#Withdraw').val();

        $('#Due').val(due);
      });

      $('#PurchaseButton').click(function() {


        var pid=[];

        var qty=[];

        var unitPrice=[];

        var subTotal=[];

        var vid=$('#SupplierID').val();

        

        var totalprice=$('#TotalPrice').val();

        var paid=$('#Paid').val();

        var due=$('#Due').val();

        var bank=$('#Withdraw').val();

        var bankid=$('#BankAdd').val();

        var memo=0;

        var memo=$('#InvoiceID').val();

        var cheque=$('#ChequeNumber').val();  


        for(i=0;i<=cc;i++){

          var zz=$('[name="ProductID[]"]').eq(i).val();

          if(zz==null) {

            pid[i]=0;

            qty[i]=0;
            unitPrice[i]=0;
            subTotal[i]=0;
          }
          else {

            pid[i]=$('[name="ProductID[]"]').eq(i).val();

            qty[i]=$('[name="Qty[]"]').eq(i).val();
            unitPrice[i]=$('[name="UnitPrice[]"]').eq(i).val();

            subTotal[i]=$('[name="SubTotal[]"]').eq(i).val();
          } 
        }

        var myWindow = window.open("/purchasevoice/"+pid+"/"+qty+"/"+unitPrice+"/"+subTotal+"/"+vid+"/"+totalprice+"/"+paid+"/"+due+"/"+bank+"/"+memo+"/"+bankid+"/"+cheque, "", "width=297,height=700,left=500");
        location.reload();
      });

      $('#BankAdd').empty();

      $('#Banking').hide();

      $('#PaymentMethod').on('change',function() {

        $('#PurchaseButton').attr('disabled',true);

        $('#BankAdd').empty();

        var p=$('#PaymentMethod').val();

        if(p=="Cash") {

          var vid=$('#SupplierID').val();

          $('#Banking').hide();

          if(vid!=null){

            $('#PurchaseButton').attr('disabled',false);
          }
        }
            

        if(p=="Bank") {                  

          $('#Banking').show();

          $.get('/purchase-bank',function(data) { 

            var bank=JSON.parse(data);                    
              $('#BankAdd').append('<option value="0" selected disabled>Bank</option>');

            for(i=0;i<bank.length;i++) {

              $('#BankAdd').append('<option value="'+bank[i].BankID+'">'+bank[i].BankName+'</option>');
            }
          });

          var bid=$('#BankAdd').val();

          var vid=$('#SupplierID').val();
        }



        $('#BankAdd').on('change',function() {
          if(vid!=null)
              $('#PurchaseButton').attr('disabled',false);
        });
      });

       
      $('#newproaj').click(function() {

        $CategoryID=$('#PrCat').val();
        $VendorID=$('#VendorID').val();
        $ProductName=$('#ProductName').val();
        $ProductDescription=$('#ProductDescription').val();

        $Qty=$('#Qty').val();
        $CostPrice=$('#CostPrice').val();
        $SalePrice=$('#SalePrice').val();
        $PreferredPrice=$('#PreferredPrice').val();
        $Unit=$('#Unit').val();
        $TaxCode=$('#TaxCode').val();
        $MinQtyLevel=$('#MinQtyLevel').val();              

        $.ajax( { 

          type: "get",
          url:'{{URL::to("/Product/New/Min")}}',         

          data: {'CategoryID':$CategoryID,'VendorID':$VendorID,'ProductName':$ProductName,
          'ProductDescription':$ProductDescription, 'Qty':$Qty,  'CostPrice':$CostPrice,  'SalePrice':$SalePrice, 'PreferredPrice':$PreferredPrice,'Unit':$Unit,'TaxCode':$TaxCode,'MinQtyLevel':$MinQtyLevel},

          success:function(data) {
          }
        });

        $('#NewProductModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
      });  


      // Submit New Product Category
      $('#CategoryNewForm').submit(function(event) {

        event.preventDefault();

        var xy=$('#modcat').val();

        //$.get('/purchase-new-cat/{id}','ProductController@')

        $.get('/purchase-new-cat/'+xy,function(data) {

          $('#PrCat').append('<option value="'+data+'">'+xy+'</option>');

          $('#MaPrCat').append('<option value="'+data+'">'+xy+'</option>');
        });


        $('#NewCategoryModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
      });


      //Bank Modal processing
      $('#NewBankForm').submit(function(event) {

        event.preventDefault();

        var xy=$('#modbank').val();

        var bal=$('#modbankbalance').val();

        $.get('/purchase-new-bank/'+xy+'/'+bal,function(data) {

          $('#BankAdd').append('<option value="'+data+'">'+xy+'</option>');
        });


        $('#NewBankModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
      });

      $('#TotalPrice').val(0);

      // when Qty is changed
      $('.Qty').on('keyup click',function() { 

        var qq=$('[name="Qty[]"]').index(this);

        var quantity=$('[name="Qty[]"]').eq(qq).val();

        var price=$('[name="UnitPrice[]"]').eq(qq).val();

        var total=quantity*price;

        $('[name="SubTotal[]"]').eq(qq).val(total);

        var alltotal_quantity=0;
        var current_due;

        for(i=0;i<=cc;i++) {

          alltotal_quantity=alltotal_quantity+ parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
        }

        $('#TotalPrice').val(alltotal_quantity);

        current_due=alltotal_quantity-$('#Paid').val();

        $('#Due').val(current_due);             

      });

      // when unit price is changed
      $('.UnitPrice').on('keyup click',function() { 

        var qq=$('[name="UnitPrice[]"]').index(this);

        var quantity=$('[name="Qty[]"]').eq(qq).val();

        var price=$('[name="UnitPrice[]"]').eq(qq).val();

        var total=quantity*price;

        $('[name="SubTotal[]"]').eq(qq).val(total);

        var alltotal_unit=0;

        for(i=0;i<=cc;i++) {

          alltotal_unit=alltotal_unit+ parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
        }

        var current_due;

        $('#TotalPrice').val(alltotal_unit);

        current_due=alltotal_unit-$('#Paid').val();

        $('#Due').val(current_due); 
      });

      // When category is changed
      $('.ProductCategory').on('change',function() {
        ListProduct();
      });

      // When product is changed
      $('.ProductID').on('change',function() {
        detailsProduct();
      });            

      // Works when a new row is inserted via plus button
      $('#increase').click(function() {

        cc ++;
            
        $('#NewProductRow').append($('#FirstProductRow').html());

        $('[name="minus[]"]').eq(cc).removeClass().addClass('fa fa-minus ');

        $('[name="addbutton[]"]').eq(cc).removeClass().addClass('btn bg-maroon btn-flat addbutton');
        $('.Qty').on('keyup click',function(){ 

          var qq=$('[name="Qty[]"]').index(this);

          var quantity=$('[name="Qty[]"]').eq(qq).val();

          var price=$('[name="UnitPrice[]"]').eq(qq).val();

          var total=quantity*price;

          $('[name="SubTotal[]"]').eq(qq).val(total);
          var alltotald=0;

          for(i=0;i<=cc;i++) {
            alltotald=alltotald+ parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
          }



          $('#TotalPrice').val(alltotald);

          current_due=alltotald-$('#Paid').val();


        $('#Due').val(current_due);  
        });

        $('.UnitPrice').on('keyup',function() {

          var qq=$('[name="UnitPrice[]"]').index(this);
          var quantity=$('[name="Qty[]"]').eq(qq).val();
          var price=$('[name="UnitPrice[]"]').eq(qq).val();
          var total=quantity*price;

          $('[name="SubTotal[]"]').eq(qq).val(total);

          var alltotalc=0;

          for(i=0;i<=cc;i++) {
            alltotalc=alltotalc+ parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
          }

          $('#TotalPrice').val(alltotalc);
          $('#Due').val(4563);          
        });

        $('.ProductCategory').on('change',function() {
          ListProduct();
        });


        $('.addbutton').click(function() {

          var qq=$('[name="addbutton[]"]').index(this);
          if(qq>0) {
            $('[name="Qty[]"]').eq(qq).val(0);
            $('[name="ProductID[]"]').eq(qq).val(0);
            $('[name="ProductCategory[]"]').eq(qq).val(0);
            $('[name="UnitPrice[]"]').eq(qq).val(0);
            $('[name="SubTotal[]"]').eq(qq).val(0);

            var alltotala=0;
            for(i=0;i<=cc;i++) {

              alltotala=alltotala+parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
            }
            $('#TotalPrice').val(alltotala);

            var good=$(this).closest('tr');

            good.hide();

            $('[name="Qty[]"]').eq(qq).val(0);
            $('[name="ProductID[]"]').eq(qq).val(0);
            $('[name="ProductCategory[]"]').eq(qq).val(0);
            $('[name="UnitPrice[]"]').eq(qq).val(0);
            $('[name="SubTotal[]"]').eq(qq).val(0);
          }
        });

        // Retrive product list by filtering
        $('.ProductCategory').on('change',function() {
          ListProduct();
        });

        // Retrieve product details and calculate price
        $('.ProductID').on('change',function() {
          detailsProduct();
        });
      });

      // Retrieve product details and calculate price
      function detailsProduct(){
        var tot=$('#TotalPrice').val();            
        var due=$('#TotalPrice').val()-$('#Paid').val();
        var qq=$('[name="ProductID[]"]').index(this);
        var ProductID = $('[name="ProductID[]"]').eq(qq).val();                 

        $('[name="Qty[]"]').eq(qq).val(1);

        $.get('/Product/Details/JSON/' + ProductID,function(data) {

          var price=JSON.parse(data);
          var costprice=price[0].CostPrice;

          $('[name="UnitPrice[]"]').eq(qq).val(costprice);

          var quantity=$('[name="Qty[]"]').eq(qq).val();
          var total=quantity*costprice;

          $('[name="SubTotal[]"]').eq(qq).val(total);

          var alltotal=0;

          for(i=0;i<=cc;i++) {
            alltotal=alltotal+ parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
          }

          $('#TotalPrice').val(alltotal);

          var tot=$('#TotalPrice').val();
          var due=$('#TotalPrice').val()-$('#Paid').val();
          
          $('#Due').val(due);
        });
      }

      // Retrive product list by filtering
      function ListProduct(){
        var p=$('[name="ProductCategory[]"]').index(this);
        
        $('[name="ProductID[]"]').eq(p).empty();

        var CategoryID  = $('[name="ProductCategory[]"]').eq(p).val();
        var ShopID      = 0;
        var VendorID    = 0;
        var DateFrom    = 0;
        var DateTo      = 0;

        $.get('/Product/List/' + ShopID + '/' + CategoryID + '/' + VendorID + '/' + DateFrom + '/' + DateTo, function(data) 
        {        

          var kaka=JSON.parse(data);

          $('[name="ProductID[]"]').eq(p).empty();

          $('[name="ProductID[]"]').eq(p).append('<option disabled selected>Choose a Product </option>');

          var total=kaka.length;

          for(i=0;i<total;i++) {

            $('[name="ProductID[]"]').eq(p).append('<option value="'+kaka[i].ProductID+'">'+kaka[i].ProductName+'</option>');
          }
        });
      }  
    }); 
  </script>
@endsection