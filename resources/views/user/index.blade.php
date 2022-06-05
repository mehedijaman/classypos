@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> User
        <small>User Operations</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">User</li>
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->


    <!-- ======================= Main Content ========================= -->
    <section class="content">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border">
          
        </div>
        <div class="box-body">
          <a href="/User/New" class="btn btn-app btn-flat bg-navy">
            <i class="fa fa-user-plus"></i>
            New User
          </a>


          <a href="/User/List" class="btn btn-app btn-flat bg-purple">
            <i class="fa fa-list"></i>
            User List
          </a>
  
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
@endsection