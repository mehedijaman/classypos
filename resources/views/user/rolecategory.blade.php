@extends('layouts.admin')


@section('content')

<div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        Role Assignment
        <small>Assign Roles to Users </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/User">User</a></li>
        <li><a href="/User/List">List</a></li>
        <li class="active">Category</li>
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->


    <!-- ======================= Main Content ========================= -->
    <section class="content">
      <div class="box box-info">
        <!-- /.box-header -->
        <div class="box-header">
          <button class="btn btn-flat bg-navy" data-toggle="modal" data-target="#NewRoleCategoryModal">New Role Category</button>
        </div>
        <div class="box-body">
          <table id="BankList" class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th> Category Name</th>
                <th> Assign Role</th>
              </tr>         
            </thead>
            <tbody>
              @foreach($UserRoleCategory as $Category)
                <tr>
                  <td>{{$Category->RoleCategoryName}}</td>
                  <td>                      
                    <a href="#" class="btn btn-flat bg-orange" title="Edit"><i class="fa fa-pencil-square-o"></i></a>

                    <a href="#" class="btn btn-flat btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>

                          
          </table>
        </div>
      </div>

      <!-- =================== New Bank  Modal ===================-->
      <div class="modal" id="NewRoleCategoryModal" role="dialog">
        <div class="modal-dialog">
          <!-- =================== Modal content =================== -->
            <div class="modal-content">

              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Add New Role Category</p>
                </h1>
              </div>

              <div class="modal-body">
                {{ Form::open(array('url' => '/User/Role', 'class' => 'form-horizontal','enctype'=>'multipart/form-data','role'=>'form')) }}

                  <div class="input-group">
                    <input type="text" id="CategoryName" class="form-control" id="inputSuccess" placeholder="Category Name" name="CategoryName">

                    <span class="input-group-btn">
                      {{ Form::submit('Add New Role Category', array('class'=>'btn bg-navy btn-flat','name'=>'submit')) }}
                    </span>               
                  </div>

                {{ Form::close() }}
              </div>

              <div class="modal-footer">
                <button type="button" class="btn bg-maroon btn-flat" data-dismiss="modal">Cancel</button>
              </div>
            </div>
        </div>
      </div>
      <!-- =================== New Bank Modal ===================-->
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
  <script>
    $(document).ready(function() {
      $('#BankList').DataTable();
  } );
  </script>



@endsection