@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Customer Ledger List
        <small>Ledger List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Shop">Customer</a></li>
        <li><a href="/Customer/New">New</a></li>
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


          <table id="CustomerLedgerList" class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                               
                <th> LedgerID</th>                
                <th> InvoiceID</th>
                <th> Debit</th>
                <th> Credit</th>
                <th> Balance</th>
                <th> Date   </th>
                <th> Action</th>

                
              </tr>
            </thead>

            <tbody> 
              @foreach($CustomerLedger as $data)
              <tr>  
                <td>{{ $data->LedgerID }}</td>          


                <td>{{$data->InvoiceID}}</td>
                
                <td>{{ $data->Debit }}</td>  
                <td>{{ $data->Credit }}</td>                  
                <td>{{ $data->Balance }}</td>
                <td>{{ date('d/m/Y h:i A', strtotime($data->created_at)) }}</td>  
                
                <td>
                <div class="btn-group">
                    <a href="/Customer/Ledger/Edit/{{ $data->LedgerID }}" title="Edit" class="btn btn-warning btn-flat"><i class="fa fa-pencil-square-o"></i> </a>

                    <a href="/Customer/Ledger/Delete/{{ $data->LedgerID }}" title="Delete" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> </a>                  
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
      $('#CustomerLedgerList').DataTable();
    });
  </script>

@endsection





