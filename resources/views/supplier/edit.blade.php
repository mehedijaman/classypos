@extends('layouts.admin')

@section('content')

<?php 
  if (isset($_REQUEST['Success'])) {
    $Success = $_REQUEST['Success'];

    if ($Success == 1) {
      echo "<script>swal('Update Success !','Vendor Updated Successfully !','success');  </script>";
    }

    if ($Success == 0) {
      echo "<script>swal('Error !','Something was wrong !','error');</script>";
    }
  }  
?>
  <!--===================== Wrapper ========================= -->
  <div class="content-wrapper">
    <!--===================== Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-pencil-square-o"></i> Edit Vendor
        <small>Edit a vendor details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Edit Vendor</li>
      </ol>
    </section>  
    <!--===================== / Content Header ========================= -->


    <!--===================== Main Content ========================= -->
    <section class="content">    
      <div class="box box-primary">

        <div class="box-header"></div>

        <div class="box-body">
          <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('Vendor/Edit/'.$Vendor->VendorID)}}"> 

            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="form-group">
              <label for="VendorName" class="col-sm-2 control-label">VendorName :</label>
              <div class="col-sm-4">
                <input name="VendorName" type="text" class="form-control" id="VendorName" placeholder="VendorName"  value="{{$Vendor->VendorName}}">
              </div>

              <label for="ContactName" class="col-sm-2 control-label">ContactName :</label>
              <div class="col-sm-4">
                <input name="ContactName" type="text" class="form-control" id="ContactName" placeholder="ContactName" value="{{$Vendor->ContactName}}">
              </div>
            </div>

            <div class="form-group">
              <label for="Address" class="col-sm-2 control-label">Address :</label>
              <div class="col-sm-4">
                <input name="Address" type="text" class="form-control" id="Address" placeholder="Address" value="{{$Vendor->Address}}">
              </div>

              <label for="City" class="col-sm-2 control-label">City :</label>
              <div class="col-sm-4">
                <input name="City" type="text" class="form-control" id="City" placeholder="City" value="{{$Vendor->City}}">
              </div>
            </div>

            <div class="form-group">
              <label for="Province" class="col-sm-2 control-label">Province :</label>
              <div class="col-sm-4">
                <input name="Province" type="text" class="form-control" id="Province" placeholder="Province" value="{{$Vendor->Province}}">
              </div>

              <label for="ZipCode" class="col-sm-2 control-label">ZipCode :</label>
              <div class="col-sm-4">
                <input name="ZipCode" type="text" class="form-control" id="ZipCode" placeholder="ZipCode" value="{{$Vendor->ZipCode}}">
              </div>
            </div>

            <div class="form-group">
              <label for="Country" class="col-sm-2 control-label">Country :</label>
              <div class="col-sm-4">
                <input name="Country" type="text" class="form-control" id="Country" placeholder="Country" value="{{$Vendor->Country}}">
              </div>

              <label for="Website" class="col-sm-2 control-label">Website:</label>
              <div class="col-sm-4">
                <input name="Website" type="text" class="form-control" id="Website" placeholder="Website" value="{{$Vendor->Website}}">
              </div>

            </div>

            <div class="form-group">
              <label for="Phone1" class="col-sm-2 control-label">Phone1 :</label>
              <div class="col-sm-4">
                <input name="Phone1" type="text" class="form-control" id="Phone1" placeholder="Phone1" value="{{$Vendor->Phone1}}">
              </div>

              <label for="Phone2" class="col-sm-2 control-label">Phone2 :</label>
              <div class="col-sm-4">
                <input name="Phone2" type="text" class="form-control" id="Phone2" placeholder="Phone2" value="{{$Vendor->Phone2}}">
              </div>
            </div>

            <div class="form-group">
              <label for="Email" class="col-sm-2 control-label">Email :</label>
              <div class="col-sm-4">
                <input name="Email" type="text" class="form-control" id="Email" placeholder="Email" value="{{$Vendor->Email}}">
              </div>
              
              <label for="VendorImg" class="col-sm-2 control-label">Photo :</label>
              <div class="col-sm-4">
                <input name="VendorImg" type="file" class="form-control" id="VendorImg" placeholder="VendorImg">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-4">
                <a href="/Vendor/List" class="btn btn-flat btn-primary" title="Back to List"><i class="fa fa-chevron-left"></i> Back</a>

                <a href="/Vendor" class="btn btn-flat btn-danger">Cancel</a>

                <input type="submit" name="submit" class="btn btn-flat bg-navy" value="Update">

                <button class="btn btn-flat bg-maroon" type="button">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
    <!--===================== / Main Content ========================= -->
  </div>
  <!--===================== / Wrapper ========================= -->
@endsection

