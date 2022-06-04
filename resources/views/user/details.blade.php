
@extends ('layouts.admin')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Details
        <small>View a User details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/User">User</a></li>
        <li><a href="/User/List">List</a></li>
        <li class="active">Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-info">
        <div class="box-header with-border"></div>
        <div class="box-body">
          <table  class="table table-striped table-bordered" width="100%">

            <tr>
              <td><label>Full Name</label></td>
              <td> {{$User->FirstName." ".$User->LastName }} </td>
            </tr>

            <tr>
              <td><label>Phone</label></td>
              <td> {{$User->Phone}} </td>
            </tr>

            <tr>
              <td><label>Address</label></td>
              <td> {{$User->Address}} </td>
            </tr>

            <tr>
              <td><label>City</label></td>
              <td> {{$User->City}} </td>
            </tr>

            <tr>
              <td><label>Province</label></td>
              <td> {{$User->Province}} </td>
            </tr>

            <tr>
              <td><label>Zipcode</label></td>
              <td> {{$User->ZipCode}} </td>
            </tr>

            <tr>
              <td><label>Country</label></td>
              <td> {{$User->Country}} </td>
            </tr>

            <tr>
              <td><label>DateOfBirth</label></td>
              <td> {{$User->DateOfBirth}} </td>
            </tr>

            <tr>
              <td><label>Image</label></td>
              <td>
                <img src="/uploads/image/user/{{$User->UserImg}}" width="100" height="100"/> 
              </td>
            </tr>  
            <tr>
              <td>
                <a href="/User/List" class="btn  btn-flat btn-primary" title="Back to List"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

                <a href="/User/Edit/{{ $User->UserID }}" class="btn btn-flat bg-orange"><i class="fa fa-pencil-square-o"></i></a>

                <a href="/User/Delete/{{ $User->UserID }}" class="btn bg-maroon btn-flat" title="Delete"> <i class="fa fa-trash"></i></a>
              </td>
              <td>
                <a href="/User/Activity/{{ $User->UserID }}" class="btn btn-flat bg-olive" title="Activity Log">Activity Log</a>

                <a href="/User/History/{{ $User->UserID }}" class="btn btn-flat bg-purple" title="Sales History">Sales History</a>

                <a href="/User/Permission/{{ $User->UserID }}" class="btn btn-flat bg-olive" title="User Permission">Permission</a>
              </td>
            </tr>  
          </table>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection