@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-recycle"></i> Waste List
        <small> | List all wastes</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Waste"><i class="fa fa-dashboard"></i> Waste</a></li>
        <li class="active">List</li>
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
          <table id="WasteList" class="table table-responsive table-stripped">
            <thead>
              <th>Shop</th>
              <th>Product</th>
              <th>Qty</th>
              <th>Unit</th>
              <th>Total</th>
              <th>Wasted By</th>
              <th>Notes</th>
              <th>Date</th>
              <th>Action</th>
            </thead>
            @foreach ($WasteList as $Waste)
              <tbody>
                <td>
                  @if($Waste->ShopName)
                    {{ $Waste->ShopName }}
                  @else
                    Main Stock
                  @endif
                </td>
                <td>{{ $Waste->ProductName }}</td>
                <td>{{ $Waste->Qty }}</td>
                <td>{{ $Waste->UnitCost }}</td>
                <td>{{ $Waste->TotalPrice }}</td>
                <td>{{ $Waste->WastedBy }}</td>
                <td>{{ $Waste->Note }}</td>
                <td>{{ date('d/m/Y h:i A', strtotime($Waste->created_at)) }}</td>
                <td>
                  <a href="/Waste/Edit/{{ $Waste->WasteID }}" class="btn btn-flat bg-orange"><i class="fa fa-pencil-square-o"></i></a>

                  <a href="/Waste/Delete/{{ $Waste->WasteID }}" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></a>
                </td>              
            @endforeach



              </tbody>
          </table>
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->

    <script>
      $(document).ready(function(){
        $('#WasteList').dataTable();
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

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
@endsection