@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!--==================== Content Header (Page header) ====================-->
    <section class="content-header">
      <h1>
        User List
        <small>View all Users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/User"> User</a></li>
        <li class="active">User List</li>
      </ol>
    </section>
    <!--==================== /Content Header  ====================-->

    <!--==================== Main content ====================-->
    <section class="content">
      <div class="box box-primary">
        <!--==================== Box header ====================-->
        <div class="box-header with-border">
        </div>
        <!--==================== /.box-header ====================-->

        <!--==================== Box body ====================-->
        <div class="box-body">
          <table id="UserList" class="table table-responsive table-bordered">
            <thead>
              <tr>
                <th> Name </th>
                <th> Email </th>
                <th> City </th>
                <th> Address </th>
                <th> Phone </th>
                <th> Shop </th> 
                <th> Role </th> 
                <th> Image </th> 
                <th> Action </th>
              </tr>           
            </thead>  

            <tbody>        
              @foreach ($UserList as $User)
              <tr>
                <td> {{ $User->FirstName." ".$User->LastName }} </td>
                <td> {{ $User->email }} </td>
                <td> {{ $User->City }} </td>
                <td> {{ $User->Address }} </td>
                <td> {{ $User->Phone }} </td>                         
                <td> {{ $User->ShopName }} </td>
                <td> 
                  <?php
                    switch($User->admin){
                      case 1:
                        echo 'Salesman';
                        break;

                      case 2:
                        echo 'Waiter';
                        break;

                      case 3:
                        echo 'Chef';
                        break;

                      case 1:
                        echo 'Salesman';
                        break;

                      default:
                        echo 'Admin';
                        break;
                    } 
                  ?>
                </td>
                <td>
                  @if($User->UserImg == null)
                  <i class="fa fa-user fa-lg"></i>
                  @endif
                </td>
                <td>
                  <div class="btn-group">
                    <a href="/User/Details/{{ $User->UserID }}" class="btn btn-flat btn-info" title="Details"> <i class="fa fa-info"></i></a>

                    <a href="/User/Edit/{{ $User->UserID }}" class="btn btn-flat bg-orange" title="Edit"><i class="fa fa-pencil"></i></a>


                    <a href="/User/Permission/{{ $User->UserID }}" class="btn btn-flat bg-olive" title="Permission"> <i class="fa fa-key"></i></a>

                    <a href="/User/Delete/{{ $User->UserID }}" class="btn btn-flat bg-maroon delete"> <i class="fa fa-trash" title="Delete" ></i></a>
                  </div>
                </td>
              </tr>
              @endforeach                           
            </tbody>                
          </table>    
        </div>    
      </div>     
    </section>
  </div>

  <!-- trigger dataTable -->
  <script>
    $(document).ready(function() {
       $('#UserList').dataTable();
    });
  </script>

   <script>
    $(".delete").on('click', function(e){
      e.preventDefault();
      var href = this.href;
      alertify.confirm("LabPOS",'Saeed',"Are you sure?", function (e) {
        if (e) {
            window.location.href = href;
        }
      });
    }).set({transition:'zoom'}).show();
    </script> 
@endsection

