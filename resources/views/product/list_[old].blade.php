@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Customer List
        <small>View all Customers</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Customer"><i class="fa fa-user"></i> Customer</a></li>
        <li class="active"><i class="fa fa-users"></i> List</li>
      </ol>
    </section>

    <section class="content">
      <div class="box">
        <div class="box-header with-border"></div>
        <div class="box-body">   
          <table id="ProductList" class="table table-hover table-responsive table-condensed">
            <thead>
              <tr>
                <th> ID</th>
                <th> Name</th>
                <th> Category</th>
                <th> Vendor</th>                
                <th> Cost</th>
                <th> Sale</th>
                <th> Qty</th>
                <th> Status</th>
                <th> Action</th
              </tr>         
            </thead>                
          </table>

          @stack('scripts')
            <script>
              $(function(){
                $('#ProductList').DataTable({
                  oLanguage: {
                      sProcessing: '<i class="fa fa-spinner fa-spin fa-3x"></i>'
                  },
                  responsive: true,
                  processing: true,
                  paging:true,
                  autoWidth:true,
                  serverSide: true,
                  scrollX:true,
                  ajax: '/Product/List/Data',
                  columns:[
                    { data:'ProductID', name:'ProductID' },
                    { data:'ProductName', name:'ProductName'},
                    { data:'CategoryName', name:'CategoryID'},
                    { data:'VendorName', name:'VendorID'},
                    { data:'CostPrice', name:'CostPrice' },
                    { data:'SalePrice', name:'SalePrice'},
                    { data:'Qty', name:'Qty'},
                    { data:'InactiveProduct', name:'InactiveProduct'},
                    { 'defaultContent': '<a href="#" class="btn btn-info btn-sm btn-flat"><i class="fa fa-info"></i></a> <a href="#" class="btn btn-success btn-sm btn-flat"><i class="fa fa-pencil"></i></a> <a href="#" class="btn btn-danger btn-sm btn-flat delete"><i class="fa fa-trash"></i></a> <a href="#" class="btn btn-primary btn-sm btn-flat delete"><i class="fa fa-share"></i></a>'}
                  ]
                });
              });   


            </script>
        </div>
      </div>
    </section>
  </div>
  <script>
    $(".delete").on('click', function(e){
      alert('Hello');
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