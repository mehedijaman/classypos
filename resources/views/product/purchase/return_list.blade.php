@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list"></i> Purchase Rturn List
        <small>Product Purchase List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Product"><i class="fa fa-product-hunt"></i> Product</a></li>
        <li><a href="/Product/Purchase"><i class="fa fa-truck"></i> Purchase</a></li>
        <li>List</li>
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->


    <!-- ======================= Main Content ========================= -->
    <section class="content">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border">
          
        </div>
        <div class="box-body">
          <table id="PurchaseList" class="table table-reponsive table-stripped">
            <thead> 
              <th>InvoiceID</th>
              <th>Shop Name</th>
              <th>ProductID</th>
              <th>Product Name</th>
              <th>Vendor</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Total Price</th>
              <th>Reason</th>
              <th>Return Date</th>
            </thead>
            @foreach ($List as $Data)
            <tr>
              <td>{{ $Data->InvoiceID }}</td>
              <td>{{ $Data->ShopName }}</td>
              <td>{{ $Data->ProductID }}</td>
              <td>{{ $Data->ProductName }}</td>
              <td>{{ $Data->VendorName }}</td>
              <td>{{ round($Data->Qty,2) }}</td>
              <td>{{ round($Data->Price,2) }}</td>
              <td>{{ round($Data->TotalPrice,2) }}</td>
              <td>{{ $Data->ReturnReason }}</td>
              <td>{{ date('d/m/Y h:i A', strtotime($Data->created_at)) }}</td>

            </tr>
            @endforeach
          </table>

          <script>
            $(document).ready(function(){
              $('#PurchaseList').dataTable();
            });
          </script>
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
@endsection