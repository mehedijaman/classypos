@extends ('layouts.admin')

@section('content')

  <!--==================== Content Wrapper. Contains page content ====================-->
  <div class="content-wrapper">

    <!--==================== Content Header (Page header) ====================-->
    <section class="content-header">
      <h1>
        <i class="fa fa-product-hunt"></i> Product Details
        <small>| View a Product details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Product">Product</a></li>
        <li><a href="/Product/List">List</a></li>
        <li class="active"> Details</li>
      </ol>
    </section>
    <!--==================== /Content Header (Page header) ====================-->


    <!--==================== Main Content ====================-->
    <section class="content"> 
      <div class="box box-info">
        <div class="box-header"></div>
        <div class="box-body">
          <!--==================== Product Details Table ====================-->
          <table  class="table table-striped table-bordered" width="100%">
            
            <tr>
              <td><strong>Product Name</strong></td>
              <td>{{ $Product->ProductName }}</td>
            </tr>

            <tr>
              <td><strong>Product ID</strong></td>
              <td>{{ $Product->ProductID }}</td>
            </tr>       

            <tr>
              <td><strong>Category Name</strong></td>
              <td> {{$CategoryName}} </td>
            </tr>

            <tr>
              <td><strong>Vendor Name</strong></td>
              <td> {{$VendorName}} </td>
            </tr>

            <tr>
              <td><strong>Product Description</strong></td>
              <td> {{$Product->ProductDescription}} </td>
            </tr>

            <tr>
              <td><strong> Main Stock Quantity</strong></td>
              <td> {{$Product->Qty}} </td>
            </tr>

            <tr>
              <td><strong>Cost Price</strong></td>
              <td> {{$Product->CostPrice}} </td>
            </tr>

            <tr>
              <td><strong>Sale Price</strong></td>
              <td> {{$Product->SalePrice}} </td>
            </tr>

            <tr>
              <td><strong>Profit (%)</strong></td>
              <td> {{ (($Product->SalePrice - $Product->CostPrice) / $Product->CostPrice) * 100 }} %</td>
            </tr>       
            
            <tr>
              <td><strong>Unit</strong></td>
              <td> {{$Product->Unit}} </td>
            </tr>

            <tr>
              <td><strong>Minimum Quantity Level</strong></td>
              <td> {{$Product->MinQtyLevel}} </td>
            </tr>

            <tr>
              <td><strong>Stock In</strong></td>
              <td> {{ date('d/m/Y h:i A', strtotime($Product->created_at)) }} </td>
            </tr>

            <tr>
              <td><strong>Last Update</strong></td>
              <td> {{ date('d/m/Y h:i A', strtotime($Product->updated_at)) }} </td>
            </tr>


            
            @if($Product->ProductImg)
            <tr>
              <td><strong>Image</strong></td>
              <td>
                <img src="/uploads/image/product/{{ $Product->ProductImg }}" width="50" height="50"/> 
              </td>
            </tr> 
            @endif

            <tr>
              <td>            
                <a href="/Product/List" class="btn btn-primary btn-flat"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

                <a href="/Product/Edit/{{ $Product->ProductID }}" class="btn bg-orange btn-flat"><i class="fa fa-pencil-square-o"></i> Edit</a>

                <a href="/Product/Delete/{{ $Product->ProductID }}" class="btn bg-maroon btn-flat" id="Delete"> <i class="fa fa-trash-o"></i> Delete</a>
              </td>
              <td>
                <a href="/Product/Distribute/Edit/{{ $Product->ProductID }}" title="Distribute to Shop" class="btn bg-olive btn-flat"> <i class="fa fa-share"></i>  Distribute</a>

                <a href="/Product/Barcode" title="Print Barcode" class="btn btn-flat bg-navy"> <i class="fa fa-barcode"></i>  Barcode</a>
              </td>
            </tr>
          </table>
          <!--==================== /Product Details Table ====================-->
        </div>
      </div>
      

    </section>
    <!--==================== /Main Content ====================-->
  </div>
  @endsection
  <!--==================== /content-wrapper ====================-->