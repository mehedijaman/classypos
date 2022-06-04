@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        Expense List
        <small>View, Edit and Delete Expense </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Accounts"><i class="fa fa-calculator"></i> Accounts</a></li>
        <li><a href="/Expense"><i class="fa fa-dashboard"></i> Expense</a></li>
        <li class="active">List</li>
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->


    <!-- ======================= Main Content ========================= -->
    <section class="content">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header">
          
        </div>
        <div class="box-body">
          <table id="BankList" class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th> ID</th>
                <th> Category </th>
                <th> Shop </th>
                <th> Name </th>
                <th> Amount </th>
                <th> Notes </th>
                <th> Date </th>
                <th> Action</th>
              </tr>         
            </thead>
            <tbody>
              @foreach($ExpenseList as $Expense)
                <tr>
                  <td>{{ $Expense->ExpenseID }}</td>
                  <td>{{ $Expense->CategoryName }}</td>
                  <td>{{ $Expense->ShopName }}</td>
                  <td>{{ $Expense->ExpenseBy }}</td>
                  <td>{{ $Expense->Amount }}</td>
                  <td>{{ $Expense->Notes }}</td>
                  <td>{{ date('d/m/Y | h:i A', strtotime($Expense->created_at)) }}</td>
                  <td>
                      <a href="/Expense/Edit/{{ $Expense->ExpenseID }}" class="btn btn-flat btn-warning" title="Edit"><i class="fa fa-pencil"></i></a>

                      <a href="/Expense/Delete/{{ $Expense->ExpenseID }}" class="btn btn-flat btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>

                          
          </table>
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
  <script>
    $(document).ready(function() {
      $('#BankList').DataTable();
  } );
  </script>
@endsection