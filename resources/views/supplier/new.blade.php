@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!-- ==================== Content Header ======================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> New Vendor
        <small>Add a new vendor</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">New Vendor</li>
      </ol>
    </section>
    <!-- ====================  /Content Header ======================= -->


    <!-- ==================== Main Content  ======================= -->
    <section class="content">
    
      <div class="box box-primary">
        <div class="box-header"></div>
        <div class="box-body">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="pull-left header">
                <i class="fa fa-th"></i>
              </li>
              <li class="active"><a href="#tab_1" data-toggle="tab" >Vendor Entry</a></li>
              <li><a href="#tab_2" data-toggle="tab" >Bulk Insert</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('/Vendor/New')}}"> 
                  <input type="hidden" name="_token" value="{{csrf_token()}}">

                  <div class="form-group">
                    <label for="VendorName" class="col-sm-2 control-label">Vendor Name :</label>
                    <div class="col-sm-4">
                      <input name="VendorName" type="text" class="form-control" id="VendorName" placeholder="VendorName">
                    </div>

                    <label for="ContactName" class="col-sm-2 control-label">Contact Name :</label>
                    <div class="col-sm-4">
                      <input name="ContactName" type="text" class="form-control" id="ContactName" placeholder="ContactName">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="Address" class="col-sm-2 control-label">Address :</label>
                    <div class="col-sm-4">
                      <input name="Address" type="text" class="form-control" id="Address" placeholder="Address">
                    </div>

                    <label for="City" class="col-sm-2 control-label">City :</label>
                    <div class="col-sm-4">
                      <input name="City" type="text" class="form-control" id="City" placeholder="City">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="Province" class="col-sm-2 control-label">Province :</label>
                    <div class="col-sm-4">
                      <input name="Province" type="text" class="form-control" id="Province" placeholder="Province">
                    </div>

                    <label for="ZipCode" class="col-sm-2 control-label">ZipCode :</label>
                    <div class="col-sm-4">
                      <input name="ZipCode" type="text" class="form-control" id="ZipCode" placeholder="ZipCode">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="Country" class="col-sm-2 control-label">Country :</label>
                    <div class="col-sm-4">
                      <input name="Country" type="text" class="form-control" id="Country" placeholder="Country">
                    </div>

                     <label for="Fax" class="col-sm-2 control-label">Fax :</label>
                    <div class="col-sm-4">
                      <input name="Fax" type="text" class="form-control" id="Fax" placeholder="Fax">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="Phone1" class="col-sm-2 control-label">Phone1 :</label>
                    <div class="col-sm-4">
                      <input name="Phone1" type="text" class="form-control" id="Phone1" placeholder="Phone1">
                    </div>

                    <label for="Phone2" class="col-sm-2 control-label">Phone2 :</label>
                    <div class="col-sm-4">
                      <input name="Phone2" type="text" class="form-control" id="Phone2" placeholder="Phone2">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="Email" class="col-sm-2 control-label">Email :</label>
                    <div class="col-sm-4">
                      <input name="Email" type="text" class="form-control" id="Email" placeholder="Email">
                    </div>

                    <label for="Website" class="col-sm-2 control-label">Website :</label>
                    <div class="col-sm-4">
                      <input name="Website" type="text" class="form-control" id="Website" placeholder="Website">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="VendorImg" class="col-sm-2 control-label">Photo :</label>
                    <div class="col-sm-4 col-md-offset-2">
                      <input name="VendorImg" type="file" class="form-control" id="VendorImg" placeholder="VendorImg">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-4">
                      <button type="button" class="btn btn-danger">Cancel</button>
                      <input type="submit" name="submit" class="btn btn-primary" value="Add Vendor">
                    </div>
                  </div>
                </form> 
              </div>

              <div class="tab-pane" id="tab_2">
                <div class="col-md-6">
                  <form class="form-inline" role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('/Vendor/New/Bulk')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">                  
                    <div class="form-group">
                      <input  name="VendorSheet" type="file" class="form-control" id="VendorSheet" placeholder="VendorSheet" >
                    </div>

                    <div class="form-group">
                      <button type="submit" name="submit" id="BulkInsert" class="btn btn-flat bg-purple">Upload</button>
                    </div>
                  </form>
                </div>
                <div class="row">
                  <div class="col-md-6">
                  <!-- <a class="btn btn-flat bg-olive" type="button" id="Download_Template" href="/Template/ProductTemplate.csv">Download Template</a> -->
                    <a class="btn btn-flat bg-olive" type="button" id="Download_Template" href="/Template/VendorTemplate.csv">Download Template</a>
                  </div>
                </div>
              </div>
            </div>
          </div>          
           
        </div>
      </div>    
    </section>
    <!-- ====================/ Main Content  ======================= -->
  </div>
@endsection

