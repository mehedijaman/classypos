@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-truck fa-flip-horizontal"></i> Vendor Payment
        <small>Vendor Payment</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Product"><i class="fa fa-product-hunt"></i> Product</a></li>
        <li><a href="/Product/Purchase"><i class="fa fa-truck"></i> Purchase</a></li>
        <li>Return</li>
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
          <form class="form-horizontal">
            <div class="form-group">
              <label for="InvoiceID" class="control-label col-md-2">InvoiceID:</label>
              <div class="col-md-2">
                <input type="text" name="InvoiceID" class="form-control" placeholder="Memo Number" id="MemoID">
              </div>

              <label for="Payment Method" class="control-label col-md-2">Payment Method: </label>
              <div class="col-md-2">
                <select name="PatymentMethod" id="PaymentMethod" class="form-control">
                  <option value="Cash">Cash</option>
                  <option value="Bank">Bank</option>
                  <option value="CashBank">Cash + Bank</option>
                </select>
              </div>              
            </div>


            <div class="form-group" id="Cashing">
              <label for="Amount" class="control-label col-md-2">Cash:</label>
              <div class="col-md-2">
                <input type="number" step=".0001" class="form-control" name="Amount" id="Amount" placeholder="Cash Amount" value="0">
              </div>
            </div>

            <div class="form-group" id="Banking" style="">
              <label for="Bank" class="col-sm-2 control-label">Bank :</label>
              <div class="col-sm-2">
                <select name="BankID" class="form-control" id="BankAdd">
                  <option value="0" selected="" disabled="">Select Bank</option>

                  @foreach($Bank as $data)
                    <option value="{{$data->BankID}}">{{$data->BankName}}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-sm-2">
                <input type="text" name="ChequeNumber" id="ChequeNumber" class="form-control" placeholder="Cheque Number">
              </div>

              <div class="col-sm-2 has-warning">
                <input type="number" step=".0001" name="Withdraw" class="form-control" placeholder="Amount" id="Withdraw"  min="1" max="100000000">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-3 col-md-offset-3">
                <input type="button" id="PaymentButton" name="submit" value="Payment" class="btn btn-primary btn-flat btn-block btn-lg">
              </div>
            </div>           

          </form>
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->



  <script>

  $(document).ready(function()
  {
    $('#Cashing').show();
    $('#Banking').hide();

    $('#PaymentButton').on('click',function()
    {
      var Vendor={{$VendorID}};
      var Amount=$('#Amount').val();
      var Memo=$('#MemoID').val();
      var Withdraw=$('#Withdraw').val();
      var BankID=$('#BankAdd').val();
      var ChequeNumber=$('#ChequeNumber').val();
      if(Withdraw=="")
        Withdraw=0;
      if(ChequeNumber=="")
        ChequeNumber=0;

      $.get('/VendorPayment/'+Vendor+'/'+Amount+'/'+Memo+'/'+Withdraw+'/'+BankID+'/'+ChequeNumber,function(data) {       
       alertify.success(data);
      });

    });

  });

  $('#PaymentMethod').on('change',function()
  {

    var PaymentMethod=$('#PaymentMethod').val();

    if(PaymentMethod=="Cash")
    {
      $('#Cashing').show();
      $('#Banking').hide();
    }

    if(PaymentMethod=="Bank")
    {
      $('#Banking').show();
      $('#Cashing').hide();
    }


    if(PaymentMethod=="CashBank")
    {
      $('#Banking').show();
      $('#Cashing').show();
    }

  });
  
  </script>
@endsection