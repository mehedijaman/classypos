@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!--========================= Content Header ======================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> Edit Customer
        <small>Edit an existing customer</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dasbhboard"><i class="fa fa-dashboard"></i> Dasbhboard</a></li>
        <li><a href="/Customer"><i class="fa fa-user"></i>Customer</a></li>
        <li><a href="/Customer/List"><i class="fa fa-users"></i>List</a></li>
        <li><a href="/Customer/Details/{{ $Customer->CustomerID }}"><i class="fa fa-user"></i>Details</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>
    <!--========================= / Content Header ======================= -->

    <!--========================= MainContent  ======================= -->
    <section class="content">

      <div class="box box-primary">
        <div class="box-header"></div>
        <div class="box-body">
          {{ Form::open(array('url' => '/Customer/Edit/'.$Customer->CustomerID,'class' => 'form-horizontal')) }}

            <div class="form-group">
              <div class="col-sm-4 col-md-offset-4">
                <select name="ShopID" class="selectpicker">
                  @foreach($ShopList as $Shop) 
                    @if($Shop->ShopID == $Customer->ShopID)
                      <option value="{{$Shop->ShopID}}" selected>{{$Shop->ShopName}}</option>
                    @else
                      <option value="{{$Shop->ShopID}}">{{$Shop->ShopName}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="FirstName" class="col-sm-2 control-label">FirstName :</label>
              <div class="col-sm-4">
                <input name="FirstName" type="text" class="form-control" id="FirstName" placeholder="FirstName" value="{{$Customer->FirstName}}">
              </div>

              <label for="LastName" class="col-sm-2 control-label">LastName :</label>
              <div class="col-sm-4">
                <input name="LastName" type="text" class="form-control" id="LastName" placeholder="LastName" value="{{$Customer->LastName}}">
              </div>
            </div>

            <div class="form-group">
              <label for="Address" class="col-sm-2 control-label">Address :</label>
              <div class="col-sm-4">
                <input name="Address" type="text" class="form-control" id="Address" placeholder="Address" value="{{$Customer->Address}}">
              </div>

              <label for="City" class="col-sm-2 control-label">City :</label>
              <div class="col-sm-4">
                <input name="City" type="text" class="form-control" id="City" placeholder="City" value="{{$Customer->City}}">
              </div>
            </div>

            <div class="form-group">
              <label for="Province" class="col-sm-2 control-label">Province :</label>
              <div class="col-sm-4">
                <input name="Province" type="text" class="form-control" id="Province" placeholder="Province" value="{{$Customer->Province}}">
              </div>

              <label for="ZipCode" class="col-sm-2 control-label">ZipCode :</label>
              <div class="col-sm-4">
                <input name="ZipCode" type="text" class="form-control" id="ZipCode" placeholder="ZipCode" value="{{$Customer->ZipCode}}">
              </div>
            </div>

            <div class="form-group">
              <label for="Country" class="col-sm-2 control-label">Country :</label>
              <div class="col-sm-4">
                <input  name="Country" type="text" class="form-control" id="Country" placeholder="Country" value="{{$Customer->Country}}">
              </div>

              <label for="DateOfBirth" class="col-sm-2 control-label">DateOfBirth :</label>
              <div class="col-sm-4">
                <input name="DateOfBirth" type="date" class="form-control" id="DateOfBirth" placeholder="DateOfBirth" value="{{$Customer->DateOfBirth}}">
              </div>
            </div>

            <div class="form-group">
              <label for="Phone" class="col-sm-2 control-label">Phone :</label>
              <div class="col-sm-4">
                <input name="Phone" type="text" class="form-control" id="Phone" placeholder="Phone" value="{{$Customer->Phone}}">
              </div>

              <label for="Email" class="col-sm-2 control-label">Email :</label>
              <div class="col-sm-4">
                <input name="Email" type="text" class="form-control" id="Email" placeholder="Email" value="{{$Customer->Email}}">
              </div>
            </div>
            <div class="form-group">
              <label for="Notes" class="col-sm-2 control-label">Notes :</label>
              <div class="col-sm-4">
                <input name="Notes" type="text" class="form-control" id="Notes" placeholder="Notes" value="{{$Customer->Notes}}">
              </div>

              <label for="CustomerImg" class="col-sm-2 control-label">Photo :</label>
              <div class="col-sm-4">
                <input name="CustomerImg" type="file" class="form-control" id="CustomerImg" placeholder="CustomerImg" value="{{$Customer->CustomerImg}}">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4">
                <select name="Inactive" id="Inactive" class="selectpicker">
                  @if($Customer->Inactive == 0)
                    <option value="0" selected>Active</option>
                    <option value="1"> Inactive</option>
                  @else
                    <option value="1" selected>Inactive</option>
                    <option value="0"> Active</option>
                  @endif
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <a href="/Customer/List" title="Back to List" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i> List</a>

                <a href="/Customer/Details/{{$Customer->CustomerID}}" class="btn btn-flat bg-olive" title="Back to Details">Details</a>

                <a href="/Customer" class="btn btn-danger btn-flat">Cancel</a>

                <button class="btn btn-flat bg-maroon" type="button">Reset</button>

                <input type="submit" name="submit" value="Update" class="btn btn-flat bg-navy">  
              </div>
            </div>
          {{ Form::close() }}
        </div>
      </div>
    </section>
    <!--========================= / Main Content  ======================= -->
  </div>
@endsection