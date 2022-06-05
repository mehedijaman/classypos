
@extends ('layouts.admin')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bank Details
        <small>View a Bank details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Bank">Bank</a></li>
        <li><a href="/Bank/List">List</a></li>
        <li class="active">Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-info">
        <div class="box-header with-border"></div>
        <div class="box-body">

        <div class="col-md-6 col-md-offset-3">
          <table  class="table table-striped table-bordered">

            <tr>
              <td><label>Bank Name</label></td>
              <td> {{$BankName }} </td>
            </tr>

            <tr>
              <td><label>Bank Balance</label></td>
              <td> {{$BankBalance}} </td>
            </tr>

            
            <tr>
            <td>{{$BankName}}</td>
              <td>
                <a href="/Bank/List" class="btn  btn-flat btn-primary" title="Back to List"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

                <a href="/Bank/Edit/{{ $BankID }}" class="btn btn-flat bg-orange"><i class="fa fa-pencil-square-o"></i></a>

                <a href="/Bank/Delete/{{ $BankID }}" class="btn bg-maroon btn-flat" title="Delete"> <i class="fa fa-trash"></i></a>
              </td>
              
            </tr>  
          </table>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection