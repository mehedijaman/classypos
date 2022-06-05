@extends('layouts.admin')

@section('content')


  <div class="content-wrapper">
    <!--==================== Content Header (Page header) ====================-->
    <section class="content-header">
      <h1> Edit Product </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Product"> Product</a></li>
        <li><a href="/Product/List"> List</a></li>
        <li><a href="/Product/Details/{{ $Product->ProductID }}"> Details</a></li>
        <li class="active">Edit Product</li>
      </ol>
    </section>
    <!--==================== /Content Header (Page header) ====================-->

    <!--==================== Main content ====================-->
    <section class="content">
      <div class="box box-primary">    
        <div class="box-header"></div>

        <div class="box-body">

          {{ Form::open(array('url' => '/Product/Edit/'.$Product->ProductID, 'class' => 'form-horizontal','enctype'=>'multipart/form-data')) }}

            <div class="form-group">
              <label for="ProductName" class="col-sm-2 control-label">ProductName :</label>
              <div class="col-sm-4">
                <input name="ProductName" type="text" class="form-control" id="ProductName" placeholder="ProductName" value="{{$Product->ProductName}}">
              </div>

              <label for="ProductDescription" class="col-sm-2 control-label">Description :</label>
              <div class="col-sm-4">
                <input name="ProductDescription" type="text" class="form-control" id="ProductDescription" placeholder="ProductDescription" value="{{$Product->ProductDescription}}">
              </div>
            </div> 

            <div class="form-group">
              <label for="CategoryID" class="col-sm-2 control-label">Category :</label>
              <div class="col-sm-4">
                <select name="CategoryID" class="form-control" id="CategoryID">
                  @foreach($CategoryList as $data)
                      @if($data->CategoryID == $Product->CategoryID)               
                        <option value="{{$data->CategoryID}}" selected>{{$data->CategoryName}}</option>
                      @else
                          <option value="{{$data->CategoryID}}">{{$data->CategoryName}}</option>
                      @endif



                  @endforeach 
                </select>
              </div>

              <label for="VendorID" class="col-sm-2 control-label">Vendor :</label>
              <div class="col-sm-4">
                <select name="VendorID" class="form-control">
                  @foreach($VendorList as $data)
                    @if($data->VendorID==$Product->VendorID)               
                      <option value="{{$data->VendorID}}" selected>{{$data->VendorName}}</option>
                    @else
                    <option value="{{$data->VendorID}}">{{$data->VendorName}}</option>
                    @endif

                  @endforeach
                </select>
              </div>
            </div>                   

            <div class="form-group">
              <label for="Qty" class="col-sm-2 control-label">Qty :</label>
              <div class="col-sm-2">
                <input name="Qty" type="number" class="form-control" step=".0001" id="Qty" placeholder="Qty" value="{{$Product->Qty}}">
              </div>

              <label for="MinQtyLevel" class="col-sm-2 control-label">MinQtyLevel :</label>
              <div class="col-sm-2">
                <input name="MinQtyLevel" type="number" step=".0001" class="form-control" id="MinQtyLevel" placeholder="MinQtyLevel" value="{{$Product->MinQtyLevel}}">
              </div>

              <label for="Unit" class="col-sm-2 control-label">Unit :</label>
              <div class="col-sm-2">
                <input name="Unit" type="text" class="form-control" id="Unit" placeholder="Unit" value="{{$Product->PreferredPrice}}">
              </div>           
            </div>

            <div class="form-group">
              <label for="CostPrice" class="col-sm-2 control-label">CostPrice :</label>
              <div class="col-sm-2">
                <input name="CostPrice" type="number" step=".0001" class="form-control" id="CostPrice" placeholder="CostPrice" value="{{$Product->CostPrice}}">
              </div>

              <label for="SalePrice" class="col-sm-2 control-label">SalePrice :</label>
              <div class="col-sm-2">
                <div class="input-group">
                  <input name="SalePrice" type="number" step=".0001" class="form-control" id="SalePrice" placeholder="SalePrice" value="{{$Product->SalePrice}}">
                  <span class="input-group-addon bg-navy" id="ProfitParcent" ><strong>0 %</strong></span>
                </div>
              </div>

              <label for="PreferredPrice" class="col-sm-2 control-label">Pref.Price :</label>
              <div class="col-sm-2">
                <input name="PreferredPrice" type="number" step=".0001" class="form-control" id="PreferredPrice" placeholder="PreferredPrice" value="{{$Product->PreferredPrice}}">
              </div>
            </div>

            <div class="form-group">
              <label for="TaxCode" class="col-sm-2 control-label">TaxCode :</label>
              <div class="col-sm-2">                
                <select name="TaxCode" class="form-control" id="TaxCodeEdit"> 
                  @foreach ($TaxList as $Tax)         
                    <option value="{{ $Tax->TaxCodeID }}">{{ $Tax->TaxCode }}</option> 
                  @endforeach              
                </select>
              </div>

              <label for="ProductImg" class="col-sm-2 control-label">Image :</label>
              <div class="col-sm-2">
                <input name="ProductImg" type="file" class="form-control" id="ProductImg" placeholder="ProductImg">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">

                <a href="/Product/List" class="btn btn-primary btn-flat" title="Back to List"><i class="fa fa-arrow-left"></i> Back</a>

                <a href="/Product/Details/{{ $Product->ProductID }}" title="View Details" class="btn btn-info btn-flat"> Details</a>

                <input name="submit" type="submit" class="btn btn-success btn-flat" value="Update"> 

                <button type="button" title="Reset to default" class="btn btn-flat bg-maroon">Reset</button>           
              </div>
            </div>
          {{ Form::close() }}
        </div>
      </div>
    </section>
  </div>
  <script>
    $('#CostPrice').on('input',function(){     
      CalculateParcent();  
    });

    $('#SalePrice').on('input',function(){
      CalculateParcent();
    });   

    CalculateParcent();

    function CalculateParcent()
    {
      var CostPrice = $('#CostPrice').val();
      var SalePrice = $('#SalePrice').val();
      var ProfitParcent = (( SalePrice - CostPrice ) / CostPrice) * 100;

      var ProfitParcent = Math.round(ProfitParcent);

      $('#ProfitParcent').html('');
      $('#ProfitParcent').append(ProfitParcent + ' %');
    }
  </script>
 
@endsection