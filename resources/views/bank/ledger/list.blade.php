@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        Bank Ledger List
        <small>View all Banks</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Bank List</li>
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->


    <!-- ======================= Main Content ========================= -->
    <section class="content">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border">
          <h3 class="box-title">
            {{ $Bank->BankName }}|Current Balance:{{$Bank->Balance}}
          </h3>
        </div>
        <div class="box-body">
          <table id="BankList" class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th> ID </th>
                <th> Cheque No.</th>
                <th> Ref.Cheq.</th>
                <th> Ref Bank</th>
                <th> Deposit</th>
                <th> Withdraw </th>
                <th> Balance</th>
                <th> TxBy</th>
                <th> Notes</th>
                <th> Notes</th>
                <th> Date</th>
              </tr>         
            </thead>

            <tbody>        
              @foreach ($LedgerList as $Ledger)
                <tr>
                  <td>{{ $Ledger->LedgerID }}</td>        
                  <td>{{ $Ledger->ChequeNumber }}</td>        
                  <td>{{ $Ledger->RefChequeNumber }}</td>        
                  <td>{{ $Ledger->RefBank }}</td>        
                  <td>{{ $Ledger->Deposit }}</td>        
                  <td>{{ $Ledger->Withdraw }}</td>        
                  <td>{{ $Ledger->Balance }}</td>        
                  <td>{{ $Ledger->TxBy }}</td>        
                  <td>{{ $Ledger->Notes }}</td>        
                  <td>{{ date('d/m/Y', strtotime($Ledger->created_at)) }}</td> 
                         
                  <td>
                    <div class="btn-group">
                      

                      

                      <a title="Edit Ledger" href="/Bank/Ledger/Edit/{{ $Ledger->LedgerID }}" class="btn btn-flat bg-orange"><i class="fa fa-pencil-square-o"></i></a>

                      
                      <a title="Delete Ledger" href="/Bank/Ledger/Delete/{{ $Ledger->LedgerID }}" class="btn btn-flat bg-maroon"> <i class="fa fa-trash-o"></i></a>
                      
                    </div>
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