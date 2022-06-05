@extends ('layouts.admin')

@section('content')
  <!-- ==================== Content Wrapper ====================== -->
  <div class="content-wrapper">
    <!-- ===================== Content Header ===================== -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> Customer Details
        <small>View a Customer details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Customer"><i class="fa fa-user"></i>Customer</a></li>
        <li><a href="/Customer/List"><i class="fa fa-users"></i>List</a></li>
        <li class="active">Details</li>
      </ol>
    </section>
    <!-- ===================== / Content Header ===================== -->

    <!-- ===================== Main Content ===================== -->
    <section class="content">
      <div class="box box-info">
        <div class="box-header"></div>
        <div class="box-body">
          <table  class="table table-striped table-bordered" > 
            <tr>
              <td><strong>First Name</strong></td>
              <td> {{$Details->FirstName}} </td>
            </tr>

            <tr>
              <td><strong>LastName</strong></td>
              <td> {{$Details->LastName}} </td>
            </tr>

            <tr>
              <td><strong>Address</strong></td>
              <td> {{$Details->Address}} </td>
            </tr>

            <tr>
              <td><strong>City</strong></td>
              <td> {{$Details->City}} </td>
            </tr>

            <tr>
              <td><strong>Province</strong></td>
              <td> {{$Details->Province}} </td>
            </tr>

            <tr>
              <td><strong>Zipcode</strong></td>
              <td> {{$Details->Zipcode}} </td>
            </tr>

            <tr>
              <td><strong>Country</strong></td>
              <td> {{$Details->Country}} </td>
            </tr>

            <tr>
              <td><strong>Phone</strong></td>
              <td> {{$Details->Phone}} </td>
            </tr>

            <tr>
              <td><strong>Email</strong></td>
              <td> {{$Details->Email}} </td>
            </tr>

            <tr>
              <td><strong>DateOfBirth</strong></td>
              <td> {{$Details->DateOfBirth}} </td>
            </tr>

            <tr>
              <td><strong>Image</strong></td>
              <td>
                <img src="/uploads/image/customer/{{$Details->CustomerImg}}" width="200" height="200"/> 
              </td>
            </tr>

            <tr>
              <td>
                <a href="/Customer/List" class="btn  btn-primary btn-flat"> <i class="fa fa-arrow-left" ></i> Back</a>

                <a href="/Customer/Edit/{{ $Details->CustomerID }}" class="btn bg-orange btn-flat"><i class="fa fa-pencil-square-o"></i> Edit</a>

                <a href="/Customer/Delete/{{ $Details->CustomerID }}" class="btn btn-flat bg-maroon "> <i class="fa fa-trash-o"></i> Delete</a>
              </td>
              
              <td> 
                <a href="/Customer/ShoppingHistory/{{ $Details->CustomerID }}" class="btn btn-flat btn-info "><i class="fa fa-shopping-bag"></i> Shopping History</a>

                <a href="/Customer/Balance/{{ $Details->CustomerID }}" class="btn btn-flat bg-olive ">Balance</a>

                <a href="/Customer/Ledger/{{ $Details->CustomerID }}" class="btn btn-flat bg-purple ">Ledger</a>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </section>
    <!-- ===================== Main Content ===================== -->
  </div>
  <!-- ===================== / Content Wrapper===================== -->
@endsection

