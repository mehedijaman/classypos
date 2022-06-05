@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!--==================== Content Header (Page header) ====================-->
    <section class="content-header">
      <h1> Edit Shop </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Shop"> Shop</a></li>
        <li><a href="/Shop/List"> List</a></li>
        <li><a href="/Shop/Details/{{ $Shop->ShopID }}"> Details</a></li>
        <li class="active">Edit Shop</li>
      </ol>
    </section>
    <!--==================== /Content Header (Page header) ====================-->

    <!--==================== Main content ====================-->
    <section class="content">
      <div class="box box-primary">    
        <div class="box-header"></div>

        <div class="box-body">

          <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('/Shop/Edit/'.$Shop->ShopID)}}"> 
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="form-group">
              <label for="ShopName" class="col-sm-2 control-label">ShopName :</label>
              <div class="col-sm-4">
                <input name="ShopName" type="text" class="form-control" id="ShopName" placeholder="ShopName" value="{{ $Shop->ShopName }}">
              </div>

              <label for="ShopDescription" class="col-sm-2 control-label">Address :</label>
              <div class="col-sm-4">
                <input name="ShopAddress" type="text" class="form-control" id="ShopAddress" placeholder="Shop Address" value="{{ $Shop->ShopAddress }}">
              </div>
            </div> 

            <div class="form-group">
              <label for="Phone" class="col-sm-2 control-label">Phone :</label>
              <div class="col-sm-4">
                <input name="Phone" type="text" class="form-control" id="Phone" placeholder="Phone" value="{{ $Shop->Phone }}">
              </div>

              <label for="Email" class="col-sm-2 control-label">Email :</label>
              <div class="col-sm-4">
                <input name="Email" type="text" class="form-control" id="Email" placeholder="Email" value="{{ $Shop->Email }}">
              </div>
            </div> 

            <div class="form-group">
              <label for="Website" class="col-sm-2 control-label">Website :</label>
              <div class="col-sm-4">
                <input name="Website" type="text" class="form-control" id="Website" placeholder="Website" value="{{ $Shop->Website }}">
              </div>

              <label for="ShopLogo" class="col-sm-2 control-label">Logo :</label>
              <div class="col-sm-4">
              
                <input name="ShopLogo" type="file" class="form-control" id="ShopLogo" placeholder="Shop Logo" >

                <input name="ShopImageName" type="hidden" class="form-control" id="ShopImageName" placeholder="Shop Logo" value="{{ $Shop->ShopLogo }}">
              </div>
            </div>

            <div class="col-md-2 col-md-offset-4">
              <img src="/uploads/image/shop/{{$Shop->ShopLogo}}" width=100 height=100 id="ShopImgPlace"> 
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">

                <a href="/Shop/List" class="btn btn-primary btn-flat" title="Back to List"><i class="fa fa-arrow-left"></i> Back</a>

                <a href="/Shop/Details/{{ $Shop->ShopID }}" title="View Details" class="btn btn-info btn-flat"> Details</a>

                <input name="submit" type="submit" class="btn btn-success btn-flat" value="Update"> 

                <button type="button" title="Reset to default" class="btn btn-flat bg-maroon">Reset</button>           
              </div>
            </div>
          {{ Form::close() }}
        </div>
      </div>
    </section>
  </div>

  <script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#ShopImgPlace').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#ShopLogo").change(function(){
      readURL(this);
    });
  </script>
@endsection