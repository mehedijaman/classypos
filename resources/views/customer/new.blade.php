@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!--================== Content Header =================-->
    <section class="content-header">
      <h1>
        <i class="fa fa-user-plus"> </i> New Customer
        <small>Add New Customer</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Customer"><i class="fa fa-user"></i> Customer</a></li>
        <li class="active"><i class="fa fa-user-plus"></i> New </li>
      </ol>
    </section>
    <!--================== / Content Header =================-->

    <!--================== Main Content ====================-->
    <section class="content">
      <div class="box box-primary">

        <div class="box-header"></div>

        <div class="box-body">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="pull-left header">
                <i class="fa fa-th"></i>
              </li>
              <li class="active"><a href="#tab_1" data-toggle="tab" >Customer Entry</a></li>
              <li><a href="#tab_2" data-toggle="tab" >Bulk Insert</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                {{ Form::open(array('url' => '/Customer/New', 'class' => 'form-horizontal','enctype'=>'multipart/form-data')) }}

                  <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                      <select name="ShopID" class="form-control select2">
                        <option selected disabled >Select a Shop</option>
                        @foreach($all as $data)   
                          <option value="{{$data->ShopID}}">{{$data->ShopName}}</option>
                        @endforeach 
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="FirstName" class="col-sm-2 control-label">First Name :</label>
                    <div class="col-sm-4">
                      <input name="FirstName" type="text" class="form-control" id="FirstName" placeholder="FirstName">
                    </div>

                    <label for="LastName" class="col-sm-2 control-label">Last Name :</label>
                    <div class="col-sm-4">
                      <input name="LastName" type="text" class="form-control" id="LastName" placeholder="LastName">
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
                      <input  name="Country" type="text" class="form-control" id="Country" placeholder="Country">
                    </div>

                    <label for="DateOfBirth" class="col-sm-2 control-label">Date Of Birth :</label>
                    <div class="col-sm-4">
                      <input name="DateOfBirth" type="date" class="form-control" id="DateOfBirth" placeholder="DateOfBirth" value="">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="Phone" class="col-sm-2 control-label">Phone :</label>
                    <div class="col-sm-4">
                      <input name="Phone" type="text" class="form-control" id="Phone" placeholder="Phone">
                    </div>

                    <label for="Email" class="col-sm-2 control-label">Email :</label>
                    <div class="col-sm-4">
                      <input name="Email" type="text" class="form-control" id="Email" placeholder="Email">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="Notes" class="col-sm-2 control-label">Notes :</label>
                    <div class="col-sm-4">
                      <input name="Notes" type="text" class="form-control" id="Notes" placeholder="Notes">
                    </div>

                    <label for="CustomerImg" class="col-sm-2 control-label">Photo :</label>
                    <div class="col-sm-4">
                      <input name="CustomerImg" type="file" class="form-control" id="CustomerImg" placeholder="CustomerImg">
                    </div>
                  </div>

                  <div class="col-md-2 col-md-offset-5">
                    <img id="CustomerImgPlace" src="#" alt="your image" width="100" height="100" />
                  </div>


                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">

                      <input type="submit" name="submit" value="Add Customer" class="btn btn-flat bg-navy">

                      <button type="button" class="btn btn-flat bg-maroon">Reset</button>

                      <a href="/Customer" type="button" class="btn btn-flat btn-danger">Cancel</a>
                      
                    </div>
                  </div>
                {{ Form::close() }}
              </div>

              <div class="tab-pane" id="tab_2">
                <div class="col-md-6">
                  <form class="form-inline" role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('/Customer/New/Bulk/')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">                  
                    <div class="form-group">
                      <input  name="CustomerSheet" type="file" class="form-control" id="CustomerSheet" placeholder="CustomerSheet" >
                    </div>

                    <div class="form-group">
                      <button type="submit" name="submit" id="BulkInsert" class="btn btn-flat bg-purple">Upload</button>
                    </div>
                  </form>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <a class="btn btn-flat bg-olive" type="button" id="Download_Template" href="/Template/CustomerTemplate.csv">Download Template</a>
                  </div>
                </div>
              </div>
            </div>
          </div>           
        </div>
      </div>
    </section>
    <!--============================ / Content  =============================-->
  </div>
  
  <script>
     $(document).ready(function() {
      $(".select2").select2({
        theme: "bootstrap"
      });
    });
     
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#CustomerImgPlace').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#CustomerImg").change(function(){
      readURL(this);
    });
  </script>
@endsection