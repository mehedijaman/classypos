@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        Bank
        <small>Bank Operations</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Bank</li>
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->


    <!-- ======================= Main Content ========================= -->
    <section class="content">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border">
          
        </div>
        <div class="box-body">
          <button class="btn btn-flat bg-navy btn-app" data-toggle="modal" data-target="#NewBankModal">
            <i class="fa fa-plus"></i>
            New Bank
          </button>

          <a href="/Bank/List" class="btn btn-app btn-flat bg-purple">
            <i class="fa fa-list"></i>
            Bank List
          </a>

          <a href="/Bank/Withdraw" class="btn btn-app btn-flat bg-orange">
            <i class="fa fa-mail-forward"></i>
            Withdraw
          </a>

           <a href="/Bank/Deposit" class="btn btn-app btn-flat bg-olive">
            <i class="fa fa-reply"></i>
            Deposit
          </a>
  
        </div>
      </div>

      <!-- =================== New Bank  Modal ===================-->
      <div class="modal" id="NewBankModal" role="dialog">
        <div class="modal-dialog">
          <!-- =================== Modal content =================== -->
            <div class="modal-content">

              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Add New Bank</p>
                </h1>
              </div>

              <div class="modal-body">
                {{ Form::open(array('url' => '/Bank/New', 'class' => 'form-inline')) }}

                  <div class="form-group">
                    <div class="col-md-5 col-sm-5 col-lg-5 ">
                      <input name="BankName" type="text" class="form-control" placeholder="Bank Name">
                    </div>

                    <div class="col-md-5 col-sm-5 col-lg-5 ">
                      <input name="Balance" type="number" class="form-control" placeholder="Balance" value="0" step=".0001">
                    </div>

                    <div class="col-md-2 col-sm-2 col-lg-2 ">
                      <input class="btn bg-navy btn-flat" type="submit" name="Submit" value="Add Bank">
                    </div>                   
                  </div>

                {{ Form::close() }}
              </div>

              <div class="modal-footer">
                <button type="button" class="btn bg-maroon btn-flat" data-dismiss="modal">Cancel</button>
              </div>
            </div>
        </div>
      </div>
      <!-- =================== New Bank Modal ===================-->
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
@endsection