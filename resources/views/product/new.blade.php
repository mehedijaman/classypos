@extends('layouts.admin')

@section('content')


@if($errors->any())
<h4>{{$errors->first()}}</h4>
<h4>{{$errors->first()}}</h4>
<h4>{{$errors->first()}}</h4>
<h4>{{$errors->first()}}</h4>
<h4>{{$errors->first()}}</h4>
<h4>{{$errors->first()}}</h4>

@endif

<?php 
  if (isset($_REQUEST['Success'])) {
    $Success = $_REQUEST['Success'];

    if ($Success == 1) {
      echo "<script>swal('Success !','Product Added Successfully !','success');  </script>";
    }

    if ($Success == 0) {
      echo "<script>swal('Error !','Something was wrong !','error');</script>";
    }
  }  
?>

  <div class="content-wrapper">
    <!-- ==================Content Header ======================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-cubes"></i> New Product
        <small>| Add new product to main stock</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Product">Product</a></li>
        <li class="active">New Product</li>
      </ol>
    </section>
    <!-- ================== / Content Header ====================== -->


    <!-- ================== Main Content ====================== -->
    <section class="content"> 
      <div class="box box-success">
        <div class="box-header">          
          <div class="box-tools pull-right">
          </div>
        </div>

        <div class="box-body">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="pull-left header">
                <i class="fa fa-th"></i>
              </li>
              <li class="active"><a href="#tab_1" data-toggle="tab" ><i class="fa fa-cube"></i> Single Product Entry</a></li>
              <li><a href="#tab_2" data-toggle="tab" ><i class="fa fa-cubes"></i> Bulk Insert</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">

                {{ Form::open(array('url' => '/Product/New', 'class' => 'form-horizontal','enctype'=>'multipart/form-data')) }}
                  <div class="form-group">
                    <label for="CategoryID" class="col-md-2 control-label">Category :</label>
                    <div class="col-md-4">
                      <div class="input-group">
                        <!-- <span class="input-group-addon bg-olive">Category :</span> -->
                        <select name="CategoryID" class="form-control select2" data-live-search="true">
                          @foreach($CategoryList as $Category)             
                            <option value="{{ $Category->CategoryID }}">{{ $Category->CategoryName }}</option>
                          @endforeach 
                        </select>
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="button"><i class="fa fa-plus"></i></button>        
                        </span>
                      </div>
                    </div>

                    <label for="VendorID" class="col-md-2 control-label">Vendor :</label>
                    <div class="col-md-4">
                      <div class="input-group">
                        <!-- <span class="input-group-addon bg-olive">Vendor :</span> -->
                        <select name="VendorID" class="form-control select2" data-live-search="true">
                          @foreach($VendorList as $Vendor)             
                            <option value="{{$Vendor->VendorID}}">{{$Vendor->VendorName}}</option>
                          @endforeach  
                        </select>
                        <span class="input-group-addon btn bg-blue"><i class="fa fa-plus"></i></span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="ProductName" class="col-md-2 control-label">Product Name :</label>
                    <div class="col-md-4">
                      <!-- <div class="input-group"> -->
                        <!-- <span class="input-group-addon bg-olive">Product Name :</span> -->
                        <input name="ProductName" type="text" class="form-control" id="ProductName" placeholder="Product Name" required>
                      <!-- </div> -->
                    </div>

                    <label for="ProductDescription" class="col-md-2 control-label">Description :</label>
                    <div class="col-md-4">
                      <!-- <div class="input-group"> -->
                        <!-- <span class="input-group-addon bg-olive">Description :</span> -->
                        <input name="ProductDescription" type="text" class="form-control" id="ProductDescription" placeholder="Product Description">
                      <!-- </div> -->
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="Qty" class="col-md-2 control-label ">Qty</label>
                    <div class="col-md-4">
                      <div class="input-group">
                        <!-- <span class="input-group-addon bg-olive">Qty :</span> -->
                        <input name="Qty" type="number" class="form-control" id="Qty" step=".0001" placeholder="Qty" required>
                        <span class="input-group-addon bg-navy" id="UnitName"></span>
                      </div>
                    </div>

                    <label for="MinQtyLevel" class="col-md-2 control-label">MinQtyLevel :</label>
                    <div class="col-md-4">
                      <div class="input-group">
                        <!-- <span class="input-group-addon bg-olive">MinQtyLevel :</span> -->
                        <input name="MinQtyLevel" type="number" class="form-control" step=".0001" id="MinQtyLevel" placeholder="MinQtyLevel" required>
                        <span class="input-group-addon bg-navy" id="UnitName2"></span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="CostPrice" class="col-md-2 control-label">CostPrice :</label>
                    <div class="col-md-4">
                      <div class="input-group">
                        <!-- <span class="input-group-addon bg-olive">Cost Price :</span> -->
                        <input name="CostPrice" type="number" step=".0001" class="form-control" id="CostPrice" placeholder="Cost Price" required>
                        <span class="input-group-addon bg-purple">BDT</span>
                      </div>
                    </div>

                    <label for="SalePrice" class="col-md-2 control-label">SalePrice :</label>

                    <div class="col-md-4">                      
                      <div class="input-group">
                        <!-- <span class="input-group-addon bg-olive">Sale Price :</span> -->
                        <input onchange="CalculateProfit()" step=".0001" name="SalePrice" type="number" class="form-control" id="SalePrice" placeholder="SalePrice" required>
                        <span class="input-group-addon bg-purple">BDT</span>
                      </div>
                    </div>
                  </div>  

                  <div class="form-group">
                    <label for="ProfitParcent" class="control-label col-md-2">Profit (%) :</label>
                    <div class="col-md-4">
                      <div class="input-group">      
                        <!-- <span class="input-group-addon bg-olive">Profit:</span>                   -->
                        <input type="number" class="form-control" step=".0001" id="ProfitPercent" placeholder="Profit Percent">
                        <span class="input-group-addon bg-navy">%</span>
                      </div>
                    </div>

                    <label for="ProfitAmount" class="control-label col-md-2"> Profit Amount :</label>
                    <div class="col-md-4">
                      <div class="input-group">
                        <!-- <span class="input-group-addon bg-olive" >Profit Amount :</span> -->
                        <input type="number" class="form-control" step=".0001" id="ProfitAmount" placeholder="Profit Amount">
                        <span class="input-group-addon bg-purple">BDT</span>
                      </div>
                    </div>
                  </div>                

                  <div class="form-group">
                    <label for="PreferredPrice" class="col-md-2 control-label">Pref.Price :</label>
                    <div class="col-md-4">
                      <div class="input-group">
                        <!-- <span class="input-group-addon bg-olive">Pref.Price :</span> -->
                        <input name="PreferredPrice" step=".0001" type="number" class="form-control" id="PreferredPrice" placeholder="Preferred Price">
                        <span class="input-group-addon bg-purple">BDT</span>
                      </div>
                    </div>

                    <label for="Unit" class="col-md-2 control-label">Unit :</label>
                    <div class="col-md-4">
                      <!-- <div class="input-group"> -->
                        <!-- <span class="input-group-addon bg-olive">Unit :</span> -->
                        <input name="Unit" type="text" class="form-control" id="Unit" placeholder="e.g. piece, kg, litter etc">
                      <!-- </div> -->
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="TaxCode" class="col-md-2 control-label">VAT :</label>

                    <div class="col-md-4">
                      <div class="input-group">
                        <!-- <span class="input-group-addon bg-olive">VAT :</span> -->
                        <select name="TaxCode" class="form-control select2">
                          @foreach($TaxList as $Tax)  
                            @if($Tax->Inactive == 0)           
                              <option value="{{ $Tax->TaxCodeID }}"> {{ $Tax->TaxCodeID }} ({{ round($Tax->TaxPercent,2) }} %)</option>
                            @endif
                          @endforeach  
                        </select>
                        <span class="input-group-addon btn bg-blue"><i class="fa fa-plus"></i></span>
                      </div>
                    </div>

                    <label for="ProductImg" class="col-md-2 control-label">Image :</label>
                    <div class="col-md-4">
                      <!-- <div class="input-group"> -->
                        <!-- <span class="input-group-addon bg-olive">Image :</span> -->
                        <input name="ProductImg" type="file" class="form-control" id="ProductImg" placeholder="ProductImg">
                      <!-- </div> -->
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-offset-2 col-md-4">
                      <input title="Add Product" name="submit" type="submit" class="btn bg-navy btn-flat" value="Add Product">

                      <a title="Reset" href="/Product/New" class="btn bg-maroon btn-flat">Reset</a>

                      <a href="/Product" title="Cancel" type="button" class="btn btn-danger btn-flat">Cancel</a>
                    </div>
                  </div>
                {{ Form::close() }}
              </div>

              <div class="tab-pane" id="tab_2">
                <div class="col-md-6">
                  <form class="form-inline" role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('/Product/New/Bulk/')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">                   
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon bg-olive">Excel / CSV :</span>
                        <input name="ProductSheet" type="file" class="form-control" id="ProductSheet" placeholder="ProductSheet" enctype="multipart/form-data">
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" name="submit" id="BulkInsert" class="btn btn-flat bg-purple" disabled>Upload</button>
                    </div>
                  {{ Form::close() }}
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <a class="btn btn-flat bg-olive" type="button" id="Download_Template" href="/Template/ProductTemplate.csv">Download Template</a>
                  </div>
                </div>
              </div>
            </div>
          </div>          
        </div>
      </div>  
    </section>   
  </div>

  <script type="text/javascript">  

    $(document).ready(function() {


      $('input:file').change(function()
      {
                if ($(this).val())
                 {
                    $('#BulkInsert').attr('disabled',false);
                    // or, as has been pointed out elsewhere:
                    // $('input:submit').removeAttr('disabled'); 
                 } 
      });
      $(".select2").select2({
        theme: "bootstrap"
      });

      // $('#ProductName').keyboard();
    });

    // Profit Calculation
    $('#CostPrice').on('input',function(){     
      CalculateProfit();  
    });


    $('#SalePrice').on('input',function(){
      CalculateProfit();
    });

    $('#ProfitAmount').on('input', function(){
      var CostPrice = $('#CostPrice').val();
      var ProfitAmount = $('#ProfitAmount').val();
      var SalePrice = +CostPrice + +ProfitAmount;
      var ProfitParcents = Math.round((( SalePrice - CostPrice ) / CostPrice) * 100);

      $('#ProfitPercent').val(ProfitParcents);
      $('#SalePrice').val(SalePrice)
    });

    $('#ProfitPercent').on('input', function(){
      var CostPrice = $('#CostPrice').val();
      var ProfitPercent = $('#ProfitPercent').val();
      var SalePrice = +((ProfitPercent * CostPrice) / 100 ) + +CostPrice;

      $('#SalePrice').val(SalePrice);
      $('#ProfitAmount').val(+SalePrice - +CostPrice);
    });

    function CalculateProfit()
    {
      var CostPrice = $('#CostPrice').val();
      var SalePrice = $('#SalePrice').val();

      var ProfitParcents = Math.round((( SalePrice - CostPrice ) / CostPrice) * 100);
      var ProfitAmounts = SalePrice - CostPrice;

      $('#ProfitPercent').val(ProfitParcents);
      $('#ProfitAmount').val(ProfitAmounts);
    }

    // Unit Concetanation   
    $('#Unit').on('input', function(){
      var Unit = $('#Unit').val();
      $('#UnitName').html(Unit);
      $('#UnitName2').html(Unit);
    })

  </script>
@endsection