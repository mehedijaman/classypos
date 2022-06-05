@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vendor Balance List
        <small>Balance List</small>
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
          <table id="VendorBalanceList" class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th> ID</th>
                <th> Name</th>
                <th> Image</th>
                <th> Balance</th>
                <th> Action</th>

                
              </tr>
            </thead>

            <tbody> 
              @foreach($VendorBalance as $data)
              <tr>  
                <td>{{ $data->VendorID }}</td>
                <td>{{ $data->VendorName }}</td>
                <td><img src="uploads/image/vendor/{{ $data->VendorImg}}" width=100 height=50></td>
                <td>{{ $data->Balance }}</td>  
                <td>
                  <div class="btn-group">
                  <a href="/Vendor/Ledger/{{ $data->VendorID }}" title="Ledger" class="btn btn-warning btn-flat"><i class="fa fa-edit "></i> </a>
                  <a href="/Vendor/Details/{{ $data->VendorID }}" title="Details" class="btn btn-info btn-flat"><i class="fa fa-info"></i> </a>

                  <a href="/Vendor/Payment/{{ $data->VendorID }}" title="Payment" class="btn btn-success btn-flat"><i class="fa fa-credit-card "></i> </a>                  
                  </div>
                </td>         
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
      $('#VendorBalanceList').DataTable();
    });
  </script>

@endsection





