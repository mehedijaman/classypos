@extends('layouts.admin')

@section('content')

{{ Html::style('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}


  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> Invoice Settings
        <small>Invoice Settings</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Settings</li>
        
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->


    <!-- ======================= Main Content ========================= -->
    <section class="content">



    <form method="post" action="{{URL::to('/Invoice/Settings')}}">

    <input type="hidden" name="_token" value="{{csrf_token()}}">

      <div class="box box-success ">
        <!-- /.box-header -->
        <div class="box-header with-border">
          <div class="col-md-4">
            <select name="ShopID" id="ShopID">
              <option selected disabled>Select Shop</option>
              @foreach ($ShopList as $Shop)
                <option value="{{ $Shop->ShopID }}">{{ $Shop->ShopName }}</option>
              @endforeach
            </select> 
          </div>    
        </div>

        <div class="box-body">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Header
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body invoiceheader">              
              <textarea class="textarea form-control" placeholder="Header text here" name="InvoiceHeader" id="InvoiceHeader"></textarea>              
            </div>
          </div>

           <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Footer
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body invoicefooter">              
              <textarea class="textarea form-control" placeholder="Footer text here" name="InvoiceFooter" id="InvoiceFooter"></textarea>              
            </div>
          </div>
          
          <button class="btn btn-primary" type="submit">Save</button>
          </form>
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->

  {{ Html::script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}

  <script>

  $(document).ready(function()
  {
    //alert("I am a GOod man");
    //$('#InvoiceFooter').append("I am Fahad");
    $('#ShopID').on('change',function()
    {
      var ShopID=$('#ShopID').val();
      $.get('/Invoice/Setting/'+ShopID,function(data)
      {
        var InvoiceInformation=JSON.parse(data);
        $('.invoicefooter').empty();
        $('.invoiceheader').empty();

        $('.invoicefooter').append('<textarea class="textarea form-control" placeholder="Footer text here" name="InvoiceFooter" value="" id="InvoiceFooter"></textarea>');
        $('.invoiceheader').append('<textarea class="textarea form-control" placeholder="Header text here" name="InvoiceHeader" value="" id="InvoiceHeader"></textarea>');

        $('#InvoiceFooter').val(InvoiceInformation.Footer);
        $('#InvoiceHeader').val(InvoiceInformation.Header);

        $('.textarea').wysihtml5();



      });

    });



  });



  function Good()
  {
    alert("I am Zahid");
  }


    $(function () {
      //bootstrap WYSIHTML5 - text editor
      $('.textarea').wysihtml5()
    });

    
  </script>

@endsection