@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-desktop"></i> On Screen Button
      <small>| Add or remove On Screen Buttons</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="/Settings"> Settings</a></li>
      <li class="active">On Screen Button</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">     
    <div class="box box-info">

      <div class="box-header with-border">
      <table  class="table table-striped col-md-8">
          <thead>
            <tr>
              <td class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon bg-blue"><strong>Shop :</strong></span>
                  <select name="ShopID" class="form-control" id="ShopID">
                    @foreach($ShopList as $data)
                      <option value="{{ $data->ShopID }}">{{$data->ShopName}} </option>
                    @endforeach 
                  </select>
                </div>
              </td>

              <td class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon bg-blue"><strong>Category :</strong></span>
                  <select name="ProductCategory" class="form-control ProductCategory" id="ProductCategory" >
                    <option selected value="0">Select Category</option>
                    @foreach($CategoryList as $Category)
                      <option value="{{ $Category->CategoryID }}">{{ $Category->CategoryName }}</option>
                    @endforeach 
                  </select>
                </div>
              </td>

              <td class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon bg-blue"><strong>Product :</strong></span>
                  <select name="ProductID" class="form-control ProductID" id="ProductID" >
                    <option disabled="disabled" selected="selected">Product</option>
                  </select>
                </div>
              </td>

              <td class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon bg-blue"><strong>Text :</strong></span>
                  <input type="text" class="form-control" id="ShortText" placeholder="Short Name" required>

                  <span class="input-group-btn">
                    <button id="increase" type="button" name="addbutton" class="btn btn-flat bg-navy "><i class="fa fa-plus"></i></button>
                  </span>
                </div>
              </td>
            </tr>
          </thead>
        </table>
        <!-- /.box-header -->
      </div>

      <div class="box-body">



        <table id="OnScreenButtonList" class="table table-striped col-md-8 table-bordered">
          <thead>
            <tr>
              <th> Shop</th>
              <th> ProductID</th>
              <th> Product Name </th>
              <th> Short Name</th>
              <th> Added At</th>
              <th> Action</th>
            </tr>
          </thead>

          <tbody>
            @foreach($OnScreenButtonList as $OnScreenButton)
              <tr>
                <td>{{ $OnScreenButton->ShopName }}</td>                
                <td>{{ $OnScreenButton->ProductID }}</td>
                <td>{{ $OnScreenButton->ProductName }}</td>
                <td>{{ $OnScreenButton->DisplayText }}</td>
                <td>{{ date('d/m/Y h:i A', strtotime($OnScreenButton->created_at)) }}</td>
                <td>
                  <a href="/OnScreenButton/Delete/{{ $OnScreenButton->ButtonID }}" class="btn btn-flat bg-maroon"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<!-- /.content-wrapper -->
  <script>
    $(document).ready(function() {

      // trigger data table
      $('#OnScreenButtonList').dataTable();

      // When shop is changed
      $('#ShopID').on('change',function()
      {
        ListProduct();        
      });      

      // load products on category change
      $('#ProductCategory').on('change', function() {
        ListProduct();
      });

      // Retrieve product list and  append to this list
      function ListProduct(){
        var ProductID = $('#ProductID').index(this);

        $('#ProductID').eq(ProductID).empty();
        var ShopID      = $('#ShopID').val();
        var CategoryID  = $('#ProductCategory').val();        
        var VendorID    = 0;
        var DateFrom    = 0;
        var DateTo      = 0;

        $.get('/Product/List/' + ShopID + '/' + CategoryID + '/' + VendorID + '/' + DateFrom + '/' + DateTo, function(data) {

          var Data = JSON.parse(data);          

          $('#ProductID').eq(ProductID).empty();

          $('#ProductID').eq(ProductID).append('<option disabled selected>Select Product </option>');

          var Total = Data.length;

          for (i = 0; i <= Total; i++) {

            $('#ProductID').eq(ProductID).append('<option value="' + Data[i].ProductID + '">' + Data[i].ProductName + '</option>');
          }
        });
      }


      $('#increase').click(function() {
        var sh = $('#ShopID').val();
        var pr = $('#ProductID').val();
        var tex = $('#ShortText').val();

        // store button via get method
        $.get('/ProductSelection/' + sh + '/' + pr + '/' + tex, function(data) {
          if (data > 0) {
            if (data < 9) alert("This prodcut has already been added to this shop");
            else alert("This shop already has 10 top Items");
          }
        });

        location.reload();
        
      });
    });
  </script>

@endsection