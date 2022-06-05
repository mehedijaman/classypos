@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!--========================= Content Header ======================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> Edit Ledger
        <small>Edit a Ledger</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dasbhboard"><i class="fa fa-dashboard"></i> Dasbhboard</a></li>
        <li><a href="/Ledger"><i class="fa fa-user"></i>Ledger</a></li>
        <li><a href="/Bank/Ledger"><i class="fa fa-users"></i>List</a></li>
        
        <li class="active">Edit</li>
      </ol>
    </section>
    <!--========================= / Content Header ======================= -->

    <!--========================= MainContent  ======================= -->
    <section class="content">

      <div class="box box-primary">
        <div class="box-header"> <h3 class="box-title">{{$BankName}}</h3> </div>
        <div class="box-body">

        
          {{ Form::open(array('url' => '/Bank/Ledger/Edit/'.$BankLedger->LedgerID,'class' => 'form-horizontal')) }}

           <input type="hidden" name="Mode" value="{{$mode}}" id="Mode">

            
            <div class="form-group">
              <label for="Invoice" class="col-sm-2 control-label">ChequeNumber:</label>
              <div class="col-sm-4">
                <input name="InvoiceID" type="text" class="form-control" id="ChequeID" placeholder="ChequeNumber" value="{{$BankLedger->ChequeNumber}}">
              </div>
              <label for="Deposit" class="col-sm-2 control-label LabelDeposit">Deposit:</label>
              <div class="col-sm-4">
                <input name="Deposit" type="number" class="form-control" id="Deposit" placeholder="Deposit" value="{{$BankLedger->Deposit}}">
              </div>
            </div>
            <div class="form-group">
              <label for="Withdraw" class="col-sm-2 control-label LabelWithdraw">Withdraw :</label>
              <div class="col-sm-4">
                <input name="Withdraw" type="number" class="form-control" id="Withdraw" placeholder="Credit" value="{{$BankLedger->Withdraw}}" >
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

    var mode=$('#Mode').val();

    if(mode=="Deposit")
    {
      $('#Withdraw').hide();
      $('.LabelWithdraw').hide();
    }

    if(mode=="Withdraw")
    {
      $('#Deposit').hide();
      $('.LabelDeposit').hide();

    }



    


  });
    



  </script>
@endsection