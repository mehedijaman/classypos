@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vendor Purchase History
        <small>Purchase List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Vendor">Vendor</a></li>
        <li><a href="/Vendor/List">List</a></li>
        <li class="active">Purchase history</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">{{ $Vendor->VendorName }}</h3>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <table id="VendorPurchaseHistory" class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th> InvoiceID</th>
                <th> MemoID</th>
                <th> TotalPrice</th>
                <th> Time</th>               
              </tr>
            </thead>

            <tbody> 
              @foreach($VendorHistory as $data)
                <tr>      
                  <td>{{ $data->PurchaseInvoiceID }}</td>       
                  <td>{{ $data->MemoID}}</td>
                  <td>{{ $data->TotalPrice }}</td> 
                  <td>{{ date('d/m/Y h:i A', strtotime($data->created_at)) }}</td>  
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>        
      </div>
    </section>
  </div>
  <!-- /.content -->
  <script>
    $(document).ready(function(){
      $('#VendorPurchaseHistory').DataTable();
    });
  </script>

@endsection





