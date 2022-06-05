@extends('layouts.admin')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-user"></i> Edit bank
      <small>| Add or remove Bank</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="/Bank"><i class="fa fa-user"></i> User</a></li>
      <li><a href="/Bank/List"> List</a></li>
      <li><a href="/Bank/Details/{{ $Bank->BankID }}"> Details</a></li>
      <li class="active"> Edit</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      
    <div class="box box-primary">
      <div class="box-header with-border"></div>
      <div class="box-body">
        <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="/Bank/Edit/{{ $Bank->BankID }}">              
          <input type="hidden" name="_token" value="{{csrf_token()}}">        

          

          <div class="form-group">
            <label for="FirstName" class="col-sm-2 control-label">Bank Name :</label>
            <div class="col-sm-4">
              <input name="BankName" type="text" class="form-control" id="BankName" placeholder="Bank Name" value="{{$Bank->BankName}}">
            </div>

            <label for="Balance" class="col-sm-2 control-label">Bank Balance :</label>
            <div class="col-sm-4">
              <input name="BankBalance" type="text" class="form-control" id="BankBalance" placeholder="Bank Balance" value="{{$BankBalance}}">              
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-4 col-md-offset-2">
              <input type="submit" value="Update" class="btn btn-flat btn-lg btn-success btn-block">              
            </div>
          </div>

          

         
         
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">

              <a href="/Bank/List" title="Back to List" class="btn btn-flat btn-primary"><i class="fa fa-arrow-left"></i> Back</a>

              <a href="/Bank/Details/{{ $Bank->BankID }}" title="Details" class="btn btn-flat btn-info">Details</a>

              
              <button type="button" class="btn btn-flat bg-maroon" title="Reset to default">Reset</button>
            </div>
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
@endsection




