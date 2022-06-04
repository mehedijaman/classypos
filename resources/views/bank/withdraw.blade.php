@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        Withdraw
        <small>Withdraw from a bank</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Bank">Bank</a></li>
        <li class="active">Withdraw</li>
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->


    <!-- ======================= Main Content ========================= -->
    <section class="content">
      <div class="col-md-8 col-sm-8 col-lg-8 col-xs-12 col-md-offset-2 col-sm-offset-2 col-lg-offset-2">
        <div class="box box-primary">
          <!-- /.box-header -->
          <div class="box-header">
          
          </div>
          <div class="box-body">
            {{ Form::open(array('url' => '/Bank/Withdraw/New', 'class' => 'form-horizontal'))}}
        
             <div class="form-group">

                <label for="BankID" class="control-label col-md-2 col-sm-2 col-lg-2 ">Bank :</label>

                <div class="col-md-4 col-sm-4 col-lg-4">
                  <select name="BankID" class="form-control">
                    @foreach ($BankList as $Bank)
                    <option value="{{ $Bank->BankID }}">{{ $Bank->BankName }}</option>
                    @endforeach
                  </select>
                </div>

                <label for="Amount" class="control-label col-md-2 col-sm-2 col-lg-2">Amount :</label>

                <div class="col-md-4 col-sm-4 col-lg-4 ">
                  <input name="Amount" type="number" class="form-control" placeholder="Balance" value="0" step=".0001">
                </div>                                  
              </div>

              <div class="form-group">
             
                <label for="ChequeNumber" class="control-label col-md-2 col-sm-2 col-lg-2">Cheque:</label>

                <div class="col-md-4 col-sm-4 col-lg-4">
                   <input name="ChequeNumber" type="text" class="form-control" placeholder="Cheque Number" >
                </div>

                <label for="BankID" class="control-label col-md-2 col-sm-2 col-lg-2 ">TxN By :</label>

                <div class="col-md-4 col-sm-4 col-lg-4 ">
                  <input name="TxBy" type="text" class="form-control" placeholder="Withdraw by">
                </div>                                  
              </div>

              <div class="form-group">
                <label for="Notes" class="control-label control-label col-md-2 col-sm-2 col-lg-2">Notes :</label>
                <div class="col-md-4 col-sm-4 col-lg-4 ">
                  <input name="Notes" type="text" class="form-control" placeholder="Notes">
                </div> 
              </div>

              <div class="form-group">
                <div class="col-md-8 col-sm-8 col-lg-8 ">
                  <input class="btn btn-primary btn-flat" type="submit" name="Submit" value="Add Withdraw">
                  <button class="btn btn-flat bg-maroon" title="Reset">Reset</button>
                  <a href="/Bank" class="btn btn-flat btn-danger">Cancel</a>
                </div> 
              </div>

            {{ Form::close() }}
          </div>
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