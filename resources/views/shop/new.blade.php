@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!--============================ Header ==============================-->
    <section class="content-header">
      <h1>
        New Shop
        <small> Add a new shop</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Shop"> Shop</a></li>
        <li><a href="/Shop/List"> List</a></li>
        <li class="active">New</li>
      </ol>
    </section>
    <!--============================ / Header ==============================-->

    <!--============================ Main Content ==============================-->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border"></div>
        <div class="box-body">

          {{ Form::open(array('url' => 'Shop/New', 'class' => 'form-horizontal','enctype'=>'multipart/form-data')) }}
            
            <div class="form-group">
              <label for="ShopName" class="col-sm-2 control-label">ShopName :</label>
              <div class="col-sm-4">
                <input name="ShopName" type="text" class="form-control" id="ShopName" placeholder="ShopName">
              </div>

              <label for="ShopAddress" class="col-sm-2 control-label">ShopAddress :</label>
              <div class="col-sm-4">
                <input name="ShopAddress" type="text" class="form-control" id="ShopAddress" placeholder="ShopAddress">
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
              <label for="Website" class="col-sm-2 control-label">Website :</label>
              <div class="col-sm-4">
                <input name="Website" type="text" class="form-control" id="Website" placeholder="Website">
              </div>

               <label for="ShopLogo" class="col-sm-2 control-label">ShopLogo :</label>
              <div class="col-sm-4">
                <input name="ShopLogo" type="file" class="form-control" id="ShopLogo" placeholder="ShopLogo">
                

              </div>
            </div>

            <div class="col-md-2 col-md-offset-5">
                    <img id="ShopImgPlace" src="/uploads/image/shop/msn.jpg" alt="your image" width="100" height="100" />
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" name="submit" value="Add Shop" class="btn btn-flat bg-navy">
                <button type="button" class="btn btn-flat bg-maroon">Reset</button>
                <button type="button" class="btn btn-flat btn-danger">Cancel</button>
              </div>
            </div>
          {{ Form::close() }}
        </div>
     </div>       
    </section>
    <!--============================ / Main Content ==============================-->
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