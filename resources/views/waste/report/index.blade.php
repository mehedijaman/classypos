@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-recycle"></i> Waste Report
        <small>| Generate &amp; print waste report </small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i>Dasbhoard</a></li>
        <li><a href="/Report"><i class="fa fa-print"></i>Report</a></li>
        <li class="active">Waste</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">

      <div class="col-sm-12">

        <div class="box box-success box-solid">  
          <div class="box-header with-border">
            <h3 class="box-title"> Waste Report</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>

          <div class="box-body">

            {{ Form::open(array('class' => 'form-horizontal')) }}


              <div class="form-group ">
                
                <div class="col-sm-2">
                  <select name="ShopID" class="form-control selectpicker" id="ShopID">
                    <option selected value="-1" >Select Shop</option>
                    <option value="0" >Main Stock</option>
                    @foreach($ShopList as $data)
                      <option value="{{$data->ShopID}}">{{$data->ShopName}} </option>
                    @endforeach 
                  </select>
                </div>

                <label for="DateFrom" class="col-sm-1 control-label" >From :</label>
                <div class="col-sm-2">
                  <input type="date" id="DateFrom" name="DateFrom" class="form-control">
                </div>

                <label for="DateTo" class="col-sm-1 control-label" >To :</label>
                <div class="col-sm-2">
                  <input type="date" id="DateTo" name="DateTo" class="form-control">
                </div>
              </div>

              <div class="col-md-4 col-md-offset-4">

                <input type="button" name="submit" value="Generate Waste Report" class="btn btn-flat btn-lg bg-olive" id="WasteReport">

               </div>
            {{ Form::close() }} 
          </div>
        </div>
      </div>
    </section>   
  </div>

  <script>

    $(document).ready(function()
    {
      $('#WasteReport').on('click',function()
      {
        var ShopID    = $('#ShopID').val();
        var DateFrom  = $('#DateFrom').val();
        var DateTo    = $('#DateTo').val();

        if(DateFrom == '')
        {
          DateFrom = 0;
        }
        
        if(DateTo == '')
        {
          DateTo = 0;
        }


        var params = [
        'height='+screen.height,
        'width='+screen.width,
        'location=no',
        'fullscreen=yes' // only works in IE, but here for completeness
      ].join(',');    

      window.open("/Report/Waste/" + ShopID + '/' + DateFrom + '/' + DateTo, '', params);
      });
    });
  </script>

@endsection