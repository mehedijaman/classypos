@extends('layouts.admin')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-user"></i> Edit User
      <small>| Add or remove user</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="/User"><i class="fa fa-user"></i> User</a></li>
      <li><a href="/User/List"> List</a></li>
      <li><a href="/User/Details/{{ $User->UserID }}"> Details</a></li>
      <li class="active"> Edit</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      
    <div class="box box-primary">
      <div class="box-header with-border"></div>
      <div class="box-body">
        <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="/User/Edit/{{ $User->UserID }}">              
          <input type="hidden" name="_token" value="{{csrf_token()}}">        

          <div class="form-group">
            <label for="ShopID" class="col-sm-2 control-label">Shop :</label>
            <div class="col-sm-4">

              <select name="ShopID" class="form-control" required>
              @foreach($ShopList as $Shop)   
                <option value="{{$Shop->ShopID}}">{{$Shop->ShopName}}</option>
                @endforeach             
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="FirstName" class="col-sm-2 control-label">First Name :</label>
            <div class="col-sm-4">
              <input name="FirstName" type="text" class="form-control" id="FirstName" placeholder="FirstName" value="{{$User->FirstName}}">
            </div>

            <label for="LastName" class="col-sm-2 control-label">Last Name :</label>
            <div class="col-sm-4">
              <input name="LastName" type="text" class="form-control" id="LastName" placeholder="LastName" value="{{$User->LastName}}">
            </div>
          </div>

          <div class="form-group">
            <label for="Phone" class="col-sm-2 control-label">Phone :</label>
            <div class="col-sm-4">
              <input name="Phone" type="text" class="form-control" id="Phone" placeholder="Phone" value="{{$User->Phone}}">
            </div>

            <label for="Address" class="col-sm-2 control-label">Address :</label>
            <div class="col-sm-4">
              <input name="Address" type="text" class="form-control" id="Address" placeholder="Address" value="{{$User->Address}}">
            </div>
          </div>

          <div class="form-group">
            <label for="City" class="col-sm-2 control-label">City :</label>
            <div class="col-sm-4">
              <input name="City" type="text" class="form-control" id="City" placeholder="City" value="{{$User->City}}">
            </div>

            <label for="Province" class="col-sm-2 control-label">Province :</label>
            <div class="col-sm-4">
              <input name="Province" type="text" class="form-control" id="Province" placeholder="Province" value="{{$User->Province}}">
            </div>
          </div>

          <div class="form-group">
            <label for="ZipCode" class="col-sm-2 control-label">Zip Code :</label>
            <div class="col-sm-4">
              <input name="ZipCode" type="text" class="form-control" id="ZipCode" placeholder="ZipCode" value="{{$User->ZipCode}}">
            </div>

            <label for="Country" class="col-sm-2 control-label">Country :</label>
            <div class="col-sm-4">
              <input name="Country" type="text" class="form-control" id="Country" placeholder="Country" value="{{$User->Country}}">
            </div>
          </div>

          <div class="form-group">
            <label for="DateOfBirth" class="col-sm-2 control-label">DateOfBirth :</label>
            <div class="col-sm-4">
              <input name="DateOfBirth" type="date" class="form-control" id="DateOfBirth" placeholder="DateOfBirth" value="{{$User->DateOfBirth}}">
            </div>

            <label for="UserImg" class="col-sm-2 control-label">Image :</label>
            <div class="col-sm-4">
              <input name="UserImg" type="file" class="form-control" id="UserImg" placeholder="UserImg">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">

              <a href="/User/List" title="Back to List" class="btn btn-flat btn-primary"><i class="fa fa-arrow-left"></i> Back</a>

              <a href="/User/Details/{{ $User->UserID }}" title="Details" class="btn btn-flat btn-info">Details</a>

              <input name="submit" type="submit" class="btn btn-flat bg-olive" value="Update">

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




