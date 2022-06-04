@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Income 
        <small>Edit income</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Income"> Income</a></li>
        <li class="active">Edit Income</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-md-8 col-lg-8 col-xs-8 col-sm-12 col-xs-12 col-md-offset-2 col-lg-offset-2 col-xs-offset-2">
        <div class="box box-primary">
          <div class="box-header"></div>
          <div class="box-body">
            {{ Form::open(array('url' => '/Income/Edit/'.$IncomeEdit->IncomeID, 'class' => 'form-horizontal')) }}

              <div class="form-group">
                <label for="Amount" class="col-sm-2 control-label">Category :</label>
                <div class="col-md-4">
                  <select id="CategoryID" name="CategoryID" class="form-control">
                    @foreach($IncomeCategory as $data)
                      @if($data->CategoryID==$IncomeEdit->CategoryID)
                        <option value="{{$data->CategoryID}}" selected>{{$data->CategoryName}}</option>
                      @endif
                      <option value="{{$data->CategoryID}}">{{$data->CategoryName}}</option>
                    @endforeach
                  </select>
                </div>

                <label for="Shop" class="col-sm-2 control-label">Shop :</label>
                <div class="col-md-4">
                  <select id="ShopID" name="ShopID" class="form-control">
                    @foreach($Shop as $data)
                      @if($data->ShopID==$IncomeEdit->ShopID)
                        <option value="{{$data->ShopID}}" selected>{{$data->ShopName}}</option>
                      @endif
                      <option value="{{$data->ShopID}}">{{$data->ShopName}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="Amount" class="col-sm-2 control-label">Amount :</label>
                <div class="col-sm-4">
                  <input name="Amount" type="number" class="form-control" id="Amount" placeholder="Amount" value="{{$IncomeEdit->Amount}}" >
                </div>

                <label for="AccountName" class="col-sm-2 control-label">Account by :</label>
                <div class="col-sm-4">
                  <input name="AccountName" type="text" class="form-control" id="AccountName" placeholder="AccountName" value="{{$IncomeEdit->AccountName}}">
                </div>
              </div>

              <div class="form-group">                

                <label for="Notes" class="col-sm-2 control-label">Notes :</label>
                <div class="col-sm-4">
                  <input name="Notes" type="text" class="form-control" id="Notes" placeholder="Notes" value="{{$IncomeEdit->Notes}}">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" name="submit" class="btn btn-primary btn-flat" value="Edit Income">
                  <button type="button" class="btn btn-danger btn-flat">Cancel</button>
                </div>
              </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>

       
    </section>
    <!-- /.content -->
  </div>
@endsection