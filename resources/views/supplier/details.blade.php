@extends ('layouts.admin')

@section('content')

  <!--==========================  Content Wrapper =====================-->
  <div class="content-wrapper">
    <!--==========================  Content Wrapper =====================-->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> {{$VendorDetails->VendorName}}
        <img src="/uploads/image/vendor/{{$VendorDetails->VendorImg}}" width="100" height="100" class="img-rounded">
        <small>View a Vendor details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Vendor Details</li>
      </ol>
    </section>
    <!--==========================  Content Wrapper =====================-->

    <!--==========================  Content Wrapper =====================-->
    <section class="content">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">{{ $VendorDetails->VendorName }}</h3>
        </div>
        <div class="box-body">
          <table  class="table table-striped table-bordered" width="100%">

            <tr>
              <td><strong>ContactPerson</strong></td>
              <td> {{$VendorDetails->ContactName}} </td>
            </tr>
            <tr>
              <td><strong>Balance</strong></td>
              <td> {{$VendorDetails->Balance}} </td>
            </tr>


            <tr>
              <td><strong>City</strong></td>
              <td> {{$VendorDetails->City}} </td>
            </tr>

            <tr>
              <td><strong>Province</strong></td>
              <td> {{$VendorDetails->Province}} </td>
            </tr>

            <tr>
              <td><strong>Zipcode</strong></td>
              <td> {{$VendorDetails->Zipcode}} </td>
            </tr>

            <tr>
              <td><strong>Country</strong></td>
              <td> {{$VendorDetails->Country}} </td>
            </tr>

            <tr>
              <td><strong>Phone1</strong></td>
              <td> {{$VendorDetails->Phone1}} </td>
            </tr>

            <tr>
              <td><strong>Phone2</strong></td>
              <td> {{$VendorDetails->Phone2}} </td>
            </tr>

            <tr>
              <td><strong>Fax</strong></td>
              <td> {{$VendorDetails->Fax}} </td>
            </tr>

            <tr>
              <td><strong>Email</strong></td>
              <td> {{$VendorDetails->Email}} </td>
            </tr>

            <tr>
              <td><strong>Website</strong></td>
              <td> {{$VendorDetails->Website}} </td>
            </tr>

            <tr>
              <td><strong>Image</strong></td>
              <td>
                <img src="/uploads/image/vendor/{{$VendorDetails->VendorImg}}" width="100" height="100"/> 
              </td>
            </tr>

            <tr>
              <td>
                <a href="/Vendor/List" class="btn btn-primary"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

                <a title="Edit" href="/Vendor/Edit/{{ $VendorDetails->VendorID }}" class="btn btn-warning "><i class="fa fa-pencil-square-o"></i> Edit</a>
                    
                <a href="/Vendor/Delete/{{ $VendorDetails->VendorID }}" class="btn btn-danger"> <i class="fa fa-trash-o"></i> Delete</a>
              </td>

              <td>
                <a href="/Vendor/Invoices/{{ $VendorDetails->VendorID }}/" title="Purchase History" class="btn btn-info"><i class="fa fa-truck"></i> Purchase History</a>
                
                <a href="/Vendor/Ledger/{{ $VendorDetails->VendorID }}/" title="Ledger" class="btn btn-success">Ledger</a>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </section>
    <!--==========================  Content Wrapper =====================-->  
  </div>


@endsection
  <!-- /.content-wrapper -->