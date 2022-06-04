@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Expense
        <small>Add new expense</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Expense">Expense</a></li>
        <li class="active">New Expense</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
  
      <div class="col-md-8 col-sm-8 col-lg-8 col-xs-12 col-md-offset-2 col-sm-offset-2 col-lg-offset-2">
        <div class="box box-primary">
          <div class="box-header"></div>
          <div class="box-body">
            {{ Form::open(array('url' => '/Expense/New', 'class' => 'form-horizontal')) }} 

              <div class="form-group">
                <label for="CategoryID" class="col-sm-2 control-label">Category :</label>
                <div class="col-sm-4">
                  <select name="CategoryID" class="form-control">
                    @foreach($CategoryList as $Category)          
                      <option value="{{$Category->CategoryID}}">{{$Category->CategoryName}} </option>
                    @endforeach
                  </select>
                </div>

                 <label for="ShopID" class="col-sm-2 control-label">Shop :</label>
                <div class="col-sm-4">
                  <select name="ShopID" class="form-control">
                    @foreach($ShopList as $data)           
                      <option value="{{$data->ShopID}}">{{$data->ShopName}}</option>
                    @endforeach 
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="Amount" class="col-sm-2 control-label">Amount :</label>
                <div class="col-sm-4">
                  <input name="Amount" type="number" class="form-control" id="Amount" placeholder="Amount" step=".0001">
                </div>

                <label for="ExpenseBy" class="col-sm-2 control-label">ExpenseBy :</label>
                <div class="col-sm-4">
                  <input name="ExpenseBy" type="text" class="form-control" id="ExpenseBy" placeholder="ExpenseBy">
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
                  <input type="submit" name="submit" class="btn btn-primary" value="Add Expense">
                  <button type="button" class="btn btn-danger">Cancel</button>
                </div>
              </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>

    </section>
    
  </div>

@endsection




