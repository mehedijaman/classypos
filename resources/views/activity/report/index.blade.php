@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-shopping-bag"></i> Activity Report
        <small>| Generate &amp; print activity report </small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i>Dasbhoard</a></li>
        <li><a href="/Report"><i class="fa fa-product-hunt"></i>Report</a></li>
        <li class="active">Activity</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="col-sm-12">

        <div class="box box-success box-solid">  
          <div class="box-header with-border">
            <h3 class="box-title"> Activity Report</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>

          <div class="box-body">

            {{ Form::open(array('class' => 'form-horizontal')) }}

              <div class="form-group">

                <label for="ShopID" class="control-label col-sm-1">Shop :</label>
                <div class="col-sm-2">
                  <select name="ShopID" class="form-control selectpicker" id="ShopID">
                    <option value="0">Select Shop</option>
                    @foreach($ShopList as $data)
                      <option value="{{$data->ShopID}}">{{$data->ShopName}} </option>
                    @endforeach 
                  </select>
                </div>

                <label for="UserID" class="control-label col-sm-1">User :</label>
                <div class="col-sm-2">
                  <select name="UserID" id="UserID" class="form-control selectpicker">
                    <option value="0">Select User</option>
                    @foreach ($UserList as $User)
                      <option value="{{ $User->id }}">{{ $User->name }}</option>
                    @endforeach
                  </select>
                </div>

                <label for="FromDate" class="col-sm-1 control-label" id="FromLabel">DateFrom:</label>
                <div class="col-sm-2">
                  <input type="date" id="DateFrom" name="DateFrom" class="form-control">
                </div>

                <label for="ToDate" class="col-sm-1 control-label" id="ToLabel">Date To :</label>
                <div class="col-sm-2">
                  <input type="date" id="DateTo" name="DateTo" class="form-control">
                </div>

              </div>

              <div class="col-md-4 col-md-offset-4">
                <input type="button" name="submit" value="Generate Activity Report" class="btn btn-flat btn-lg bg-olive" id="ActivityReport">
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
    $('#ActivityReport').on('click',function()
    {

      var UserID    = $('#UserID').val();
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

    window.open("/Report/Activity/" + ShopID + '/' + UserID + '/' + DateFrom + '/' + DateTo, '', params);
    });
  });
</script>

@endsection