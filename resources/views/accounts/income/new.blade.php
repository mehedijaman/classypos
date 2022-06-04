@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Income 
        <small>Add income</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Income"> Income</a></li>
        <li class="active">Add Income</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-md-8 col-lg-8 col-xs-8 col-sm-12 col-xs-12 col-md-offset-2 col-lg-offset-2 col-xs-offset-2">
        <div class="box box-primary">
          <div class="box-header"></div>
          <div class="box-body">
            {{ Form::open(array('url' => '/Income/New', 'class' => 'form-horizontal')) }}

              <div class="form-group">
                <label for="CategoryID" class="col-sm-2 control-label">Category :</label>
                <div class="col-sm-4">
                  <select name="CategoryID" class="form-control">
                    @foreach($CategoryList as $Category)
                      <option value="{{ $Category->CategoryID }}">{{ $Category->CategoryName }} </option>
                    @endforeach 
                  </select>          
                </div>

                <label for="ShopID" class="col-sm-2 control-label">Shop :</label>
                <div class="col-sm-4">
                  <select name="ShopID" class="form-control">
                    @foreach($ShopList as $Shop)             
                      <option value="{{ $Shop->ShopID }}">{{ $Shop->ShopName }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="Amount" class="col-sm-2 control-label">Amount :</label>
                <div class="col-sm-4">
                  <input name="Amount" type="number" class="form-control" id="Amount" placeholder="Amount" >
                </div>

                <label for="AccountName" class="col-sm-2 control-label">Account by :</label>
                <div class="col-sm-4">
                  <input name="AccountName" type="text" class="form-control" id="AccountName" placeholder="AccountName">
                </div>
              </div>

              <div class="form-group">                

                <label for="Notes" class="col-sm-2 control-label">Notes :</label>
                <div class="col-sm-10">
                  <input name="Notes" type="text" class="form-control" id="Notes" placeholder="Notes">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" name="submit" class="btn btn-primary btn-flat" value="Add Income">
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