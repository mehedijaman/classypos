@extends('layouts.admin')

@section('content')
  <!--==================== Wrapper  ======================-->
  <div class="content-wrapper">
    <!--=====================  Content Header ===================-->
    <section class="content-header">
      <h1>
        <i class="fa fa-list-ul"></i> Vendor List
        <small>View All Vendors list</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Vendor List</li>
      </ol>
    </section>
    <!--===================== / Content Header ===================-->


    <!--=====================  Main Content  ======================-->
    <section class="content">

      <div class="box">
        <div class="box-header"> </div>

        <div class="box-body">
          <table id="VendorList" class="table table-bordered table-striped dataTable table-condensed">
            <thead>
              <tr>
                <th> Vendor Name</th>
                <th> Contact Person</th>
                <th> Phone</th>
                <th> Balance</th>
                <th> Status </th>
                <th> Action</th>
              </tr>           
            </thead>

            <tbody>            
              @foreach ($every as $data)
                <tr>
                  <td>{{$data->VendorName}}</td>
                  <td>{{$data->ContactName}}</td>
                  
                  <td>{{$data->Phone1}}</td>
                  <td>
                    @if($data->Balance != 0)
                      {{ round($data->Balance,2) }}
                    @endif
                  </td> 

                  @if($data->Inactive == 0)
                    <td class="text-center bg-blue"><strong>Active</strong></td>
                  @else
                    <td class="text-center"><strong>Inactive</strong></td>
                  @endif

                  <td>
                    <!-- <div class="btn-group"> -->
                      <a title="Details" href="/Vendor/Details/{{ $data->VendorID }}" class="btn btn-info"> <i class="fa fa-info"></i></a>

                      <a title="Payment" href="/Vendor/Payment/{{ $data->VendorID }}" class="btn btn-flat bg-olive"> <i class="fa fa-hand-lizard-o"></i></a>

                      <a title="Ledger" href="/Vendor/Ledger/{{ $data->VendorID }}" class="btn btn-success"><i class="fa fa-book"></i></a>

                      <a title="Edit" href="/Vendor/Edit/{{ $data->VendorID }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>                      

                      @if(Auth::user()->admin==3)
                      <a title="Delete" href="/Vendor/Delete/{{ $data->VendorID }}" class="btn btn-danger"> <i class="fa fa-trash"></i></a>
                      @endif
                    <!-- </div> -->
                  </td>
                </tr>        
              @endforeach 
            </tbody>                
          </table>
        </div>
      </div>
    </section>
    <!--=====================  / Main Content  ======================-->
  </div>
  <!--=====================  /Wrapper  ======================-->


  <script>
    $(document).ready(function() {
      $('#VendorList').DataTable();
    });
  </script>
   <script>
    $(".btn-danger").on('click', function(e){
      e.preventDefault();
      var href = this.href;
      alertify.confirm("Are you sure?", function (e) {
        if (e) {
            window.location.href = href;
        }
      });
    });
    </script>

@endsection