@extends ('layouts.admin')

@section('content')

  <!--==================== Content Wrapper. Contains page content ====================-->
  <div class="content-wrapper">

    <!--==================== Content Header (Page header) ====================-->
    <section class="content-header">
      <h1>
        Shop Details
        <small>View a Shop details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Shop">Shop</a></li>
        <li><a href="/Shop/List">List</a></li>
        <li class="active"> Details</li>
      </ol>
    </section>
    <!--==================== /Content Header (Page header) ====================-->


    <!--==================== Main Content ====================-->
    <section class="content"> 
      <div class="box box-info">
        <div class="box-header"></div>
        <div class="box-body">
          <!--==================== Shop Details Table ====================-->
          <table  class="table table-striped table-bordered table-responsive" width="100%">
            
            <tr>
              <td><strong>Shop Name</strong></td>
              <td>{{ $Shop->ShopName }}</td>
            </tr>

            <tr>
              <td><strong>Shop ID</strong></td>
              <td>{{ $Shop->ShopID }}</td>
            </tr> 

            <tr>
              <td><strong>Address</strong></td>
              <td> {{$Shop->ShopAddress}} </td>
            </tr>

            <tr>
              <td><strong>Phone</strong></td>
              <td> {{$Shop->Phone}} </td>
            </tr>

            <tr>
              <td><strong>Email</strong></td>
              <td> {{$Shop->Email}} </td>
            </tr>

            <tr>
              <td><strong>Website</strong></td>
              <td> {{$Shop->Website}} </td>

            <tr>
              <td><strong>Logo</strong></td>
              <td>
                <img src="/uploads/image/shop/{{ $Shop->ShopLogo }}" width="100" height="100" alt="{{ $Shop->ShopName }} Logo" /> 
              </td>
            </tr> 

            <tr>
              <td>            
                <a href="/Shop/List" class="btn btn-primary btn-flat" title="Back to list"> <i class="fa fa-arrow-left" aria-hidden="true" ></i> Back</a>
                
              </td>
              <td>
                <a href="/Shop/Edit/{{ $Shop->ShopID }}" class="btn bg-orange btn-flat" title="Edit"><i class="fa fa-pencil-square-o" ></i> Edit</a>
              </td>
            </tr>
          </table>
          <!--==================== /Shop Details Table ====================-->
        </div>
      </div>
      

    </section>
    <!--==================== /Main Content ====================-->
  </div>
  @endsection
  <!--==================== /content-wrapper ====================-->