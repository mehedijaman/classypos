@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Activity Log
        <small>Activity List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/User">User</a></li>
        <li><a href="/User/List">List</a></li>
        <li><a href="/User/Details/{{ $User->UserID }}">Details</a></li>
        <li class="active">Activity Log</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">{{ $User->FirstName }}</h3>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <table id="UserSalesHistory" class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th> Activity Name</th>
                <th> Shop Name</th>                              
                <th> Date </th>               
                <th> Action </th>               
              </tr>
            </thead>

            <tbody> 
              @foreach($Activity as $Data)
                <tr>      
                  <td>{{ $Data->ActivityName }}</td>   
                  <td>{{ $Data->ShopName }}</td>   
                    
                  <td>{{ date('d/m/Y h:i A', strtotime($Data->created_at)) }}</td>  
                  <td>
                  	
                  </td>  
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>        
      </div>
    </section>
  </div>
  <!-- /.content -->
  <script>
    $(document).ready(function(){
      $('#UserSalesHistory').DataTable();
    });
  </script>

@endsection





