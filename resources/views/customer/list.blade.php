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
          <table id="CustomerList" class="table table-hover table-responsive table-condensed">
            <thead>
              <tr>
                <th> ID</th>
                <th> Name</th>
                <th> Phone</th>
                <th> Email</th>
                <th> Shop</th>
                <th> Balance</th>
                <th> Status </th>
                <th> Action</th
              </tr>         
            </thead>                
          </table>

          @stack('scripts')
            <script>
              $(function(){
                $('#CustomerList').DataTable({
                  oLanguage: {
                      sProcessing: '<i class="fa fa-spinner fa-spin fa-3x"></i>'
                  },
                  responsive: true,
                  processing: true,
                  paging:true,
                  autoWidth:true,
                  serverSide: true,
                  ajax: '/Customer/List/Data',
                  columns:[
                    { data:'CustomerID', name:'CustomerID' },
                    { data:'FirstName', name:'FirstName'},
                    { data:'Phone', name:'Phone'},
                    { data:'Email', name:'Email'},
                    { data:'ShopName', name:'ShopName' },
                    { data:'Balance', name:'Balance'},
                    { data:'Inactive', name:'Inactive'},
                    { 'defaultContent': '<a href="#" class="btn btn-info btn-sm btn-flat"><i class="fa fa-info"></i></a> <a href="#" class="btn btn-success btn-sm btn-flat"><i class="fa fa-pencil"></i></a> <button class="btn btn-danger btn-sm btn-flat delete" name="delete[]"><i class="fa fa-trash"></i></button>'}
                  ],
                  initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                    });
                  }
                });
              });   


            </script>
        </div>
      </div>
    </section>
  </div>
  <script>

  $('#CustomerList').on('click','.delete',function(event) 
  {
    event.preventDefault();
    var index=$('[name="delete[]"]').index(this);
    var ID=$('[name="delete[]"]').eq(index).val();
    alert(ID);

  });
    /*$("#CustomerList'").on('click','.delete',function(e){
      alert('Hello');
      e.preventDefault();
      var href = this.href;
      alertify.confirm("Are you sure?", function (e) {
        if (e) {
            window.location.href = href;
        }
      });
    });*/
  </script>

  @endsection