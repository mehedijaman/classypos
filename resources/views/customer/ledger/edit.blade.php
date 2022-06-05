@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!--========================= Content Header ======================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> Customer Ledger Edit
        <small>Edit a Ledger</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dasbhboard"><i class="fa fa-dashboard"></i> Dasbhboard</a></li>
        <li><a href="/Ledger"><i class="fa fa-user"></i>Ledger</a></li>
        <li><a href="/Vendor/Ledger"><i class="fa fa-users"></i>List</a></li>
        
        <li class="active">Edit</li>
      </ol>
    </section>
    <!--========================= / Content Header ======================= -->

    <!--========================= MainContent  ======================= -->
    <section class="content">

      <div class="box box-primary">
        <div class="box-header"><h3 class="box-title">{{$CustomerName}}</h3> </div>
        <div class="box-body">
          {{ Form::open(array('url' => '/Customer/Ledger/Edit/'.$CustomerLedger->LedgerID,'class' => 'form-horizontal')) }}

            
            <div class="form-group">
              <label for="Invoice" class="col-sm-2 control-label">InvoiceID :</label>
              <div class="col-sm-4">
                <input name="InvoiceID" type="text" class="form-control" id="InvoiceID" placeholder="InvoiceID" value="{{$CustomerLedger->InvoiceID}}">
              </div>
              <label for="Debit" class="col-sm-2 control-label">Debit:</label>
              <div class="col-sm-4">
                <input name="Debit" type="number" class="form-control" id="Debit" placeholder="Debit" value="{{$CustomerLedger->Debit}}">
              </div>
            </div>
            <div class="form-group">
              <label for="Credit" class="col-sm-2 control-label">Credit :</label>
              <div class="col-sm-4">
                <input name="Credit" type="number" class="form-control" id="Credit" placeholder="Credit" value="{{$CustomerLedger->Credit}}" readonly>
              </div>

              <label for="Balance" class="col-sm-2 control-label">Balance :</label>
              <div class="col-sm-4">
                <input name="Balance" type="number" class="form-control" id="Balance" placeholder="Balance" value="{{$CustomerLedger->Balance}}" readonly>
              </div>
            </div>

            <input type="submit" value="Update Ledger" class="btn btn-danger btn-lg col-md-offset-4">          
            {{ Form::close() }}

        </div>
      </div>
    </section>
    <!--========================= / Main Content  ======================= -->
  </div>

  <script>


  $(document).ready(function()
  {
    $('#Debit').on('click keyup',function()
    {
      var Credit =  $('#Credit').val();        
      var Debit =   $('#Debit').val();
      var Balance=  parseInt(Credit,10)-parseInt(Debit,10);
      $('#Balance').val(Balance);
    });
  });
  </script>
  
@endsection