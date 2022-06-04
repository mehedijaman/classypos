@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Sales History
        <small>Invoice List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/User">User</a></li>
        <li><a href="/User/List">List</a></li>
        <li><a href="/User/Details/{{ $User->UserID }}">Details</a></li>
        <li class="active">Sales history</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">{{ $User->name }}</h3>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <table id="UserSalesHistory" class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th> InvoiceID</th>
                <th> Shop Name</th>
                <th> SubTotal</th>
                <th> TaxTotal </th>               
                <th> Total </th>               
                <th> Paid </th>               
                <th> Changes </th>               
                <th> Date </th>               
                <th> Action </th>               
              </tr>
            </thead>

            <tbody> 
              @foreach($InvoiceList as $Invoice)
                <tr>      
                  <td>{{ $Invoice->InvoiceID }}</td>   
                  <td>{{ $Invoice->ShopName }}</td>   
                  <td>{{ $Invoice->SubTotal }}</td>   
                  <td>{{ $Invoice->TaxTotal }}</td>   
                  <td>{{ $Invoice->Total }}</td>   
                  <td>{{ $Invoice->PaidMoney }}</td>   
                  <td>{{ $Invoice->ReturnedMoney }}</td>   
                  <td>{{ date('d/m/Y h:i A', strtotime($Invoice->created_at)) }}</td>  
                  <td>
                  	<a href="/Invoice/Sales/Print/{{ $Invoice->InvoiceID }}" id="InvoiceID" target="_top" class="btn btn-default btn-flat" onclick="window.open(this.href,'targetWindow','width=300, height=800'); return false;">
                    <i class="fa fa-print"></i></a>
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
      $('#UserSalesHistory').DataTable();
    });
  </script>

@endsection





