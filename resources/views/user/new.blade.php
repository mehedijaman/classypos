@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-user-plus"></i> New User
      <small>| Add or remove user</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="index.php"><i class="fa fa-users"></i> User</a></li>
      <li class="active">New</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="box box-success">

        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-user"></i> Add New User</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">
          {{ Form::open(array('url' => '/User/New', 'class' => 'form-horizontal')) }}



           <div class="form-group">
              <label for="UserID" class="col-sm-2 control-label">User:</label>
              <div class="col-sm-4">
                <select name="UserID" class="form-control" >
                  <option selected disabled>Select User</option>
                  @foreach($us as $data)           
                    <option value="{{$data->id}}">{{$data->name}}</option>
                  @endforeach
                </select>
              </div>

              <label for="ShopID" class="col-sm-2 control-label">Shop :</label>
              <div class="col-sm-4">
                <select name="ShopID" class="form-control" required>
                  <option selected disabled>Select Shop</option>
                  @foreach($all as $data)         
                    <option value="{{$data->ShopID}}">{{$data->ShopName}}</option>
                  @endforeach 
                </select>
              </div>
            </div>


           <div class="form-group">
              <label for="Duty" class="col-sm-2 control-label">Duty:</label>
              <div class="col-md-4">
                <select name="Duty" id="Duty" class="form-control">
                  <option value="1">Sales</option>
                  <option value="2">Waiter</option>
                  <option value="3">Chef</option>
                </select>
              </div>

              <label for="Kitchen" class="col-sm-2 control-label Kitchen">Kitchen:</label>
              <div class="col-md-4">
                <select name="Kitchen" class="form-control Kitchen" id="KitchenID">
                  <option value="0" selected>Select a Kitchen for Chef</option>
                  @foreach($Kitchen as $data)
                    <option value="{{$data->ID}}">{{$data->Name}}</option>
                  @endforeach                  
                </select>
              </div>

            </div>
               
           

           

            <div class="form-group">
              <label for="Phone" class="col-sm-2 control-label">Phone :</label>
              <div class="col-sm-4">
                <input name="Phone" type="text" class="form-control" id="Phone" placeholder="Phone" value="">
              </div>

              <label for="Email" class="col-sm-2 control-label">Email :</label>
              <div class="col-sm-4">
                <input name="Email" type="text" class="form-control" id="Email" placeholder="Email" value="">
              </div>
            </div>             

            <div class="form-group">
              <label for="FirstName" class="col-sm-2 control-label">FirstName :</label>
              <div class="col-sm-4">
                <input name="FirstName" type="text" class="form-control" id="FirstName" placeholder="FirstName">
              </div>

              <label for="LastName" class="col-sm-2 control-label">LastName :</label>
              <div class="col-sm-4">
                <input name="LastName" type="text" class="form-control" id="LastName" placeholder="LastName">
              </div>
            </div>

            <div class="form-group">
              <label for="Password" class="col-sm-2 control-label">Password :</label>
              <div class="col-sm-4">
                <input name="Password" type="text" class="form-control" id="Password" placeholder="Password">
              </div>

              <label for="Address" class="col-sm-2 control-label">Address :</label>
              <div class="col-sm-4">
                <input name="Address" type="text" class="form-control" id="Address" placeholder="Address">
              </div>
            </div>

            <div class="form-group">
              <label for="City" class="col-sm-2 control-label">City :</label>
              <div class="col-sm-4">
                <input name="City" type="text" class="form-control" id="City" placeholder="City">
              </div>  

              <label for="Province" class="col-sm-2 control-label">Province :</label>
              <div class="col-sm-4">
                <input name="Province" type="text" class="form-control" id="Province" placeholder="Province">
              </div>              
            </div>

            <div class="form-group">
              <label for="ZipCode" class="col-sm-2 control-label">ZipCode :</label>
              <div class="col-sm-4">
                <input name="ZipCode" type="text" class="form-control" id="ZipCode" placeholder="ZipCode">
              </div>

              <label for="Country" class="col-sm-2 control-label">Country :</label>
              <div class="col-sm-4">
                <input name="Country" type="text" class="form-control" id="Country" placeholder="Country">
              </div>
            </div>

            <div class="form-group">
              <label for="DateOfBirth" class="col-sm-2 control-label">DateOfBirth :</label>
              <div class="col-sm-4">
                <input name="DateOfBirth" type="date" class="form-control" id="DateOfBirth" placeholder="Year-Month-Date">
              </div>

              <label for="UserImg" class="col-sm-2 control-label">UserImg :</label>
              <div class="col-sm-4">
                <input name="UserImg" type="file" class="form-control" id="UserImg" placeholder="UserImg">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <input name="submit" type="submit" class="btn btn-primary" value="Add User">
                <button type="button" class="btn btn-danger">Cancel</button>
              </div>
            </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<script>

$(document).ready(function()
{

  $('.Kitchen').hide();

  $('#Duty').on('change',function(e)
  {
    e.preventDefault();
    var Val=$('#Duty').val();
    if(Val==3)
    {
      $('.Kitchen').show();
    }
    else
      $('.Kitchen').hide();



  });

});
  

</script>

@endsection




