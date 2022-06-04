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
        <li><a href="/Shop">Shop</a></li>
        <li><a href="/Shop/New">New</a></li>
        <li class="active">List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
        <div class="box-header">
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <table id="VendorPurchaseHistory" class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th> VendorID</th>                
                <th> VendorName</th>                
                <th> InvoiceID</th>
                <th> Time</th>
                <th> TotalPrice</th>
                

                
              </tr>
            </thead>

            <tbody> 
              @foreach($VendorHistory as $data)
                <tr>  
                  <td>{{ $data->VendorID }}</td>            
                  <td>{{ $data->VendorName }}</td>            
                  <td>{{$data->MemoID}}</td>
                  <td>{{ date('d/m/Y h:i A', strtotime($data->created_at)) }}</td>                
                  <td>{{ $data->TotalPrice }}</td>  
                  
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






