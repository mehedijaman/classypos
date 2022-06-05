@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!--==================== Content Header (Page header) ====================-->
    <section class="content-header">
      <h1>Shop Category List </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Shop"> Shop</a></li>
        <li><a href="/Shop/List"> List</a></li>
        <li><a href="/Shop/Details/{{ $Shop->ShopID }}"> Details</a></li>
        <li class="active">Edit Shop</li>
      </ol>
    </section>
    <!--==================== /Content Header (Page header) ====================-->

    <!--==================== Main content ====================-->
    <section class="content">
      <div class="box box-primary">    
        <div class="box-header"></div>

        <div class="box-body">

        <table class="table table-bordered" id="TableforCategoryList">

        <thead>
        <tr>
          <th>Category ID</th>
          <th>Category Name</th>
          <th>Action</th>
        </tr>
        </thead>

        <tbody>

        @foreach($Category as $data)

        <tr>

        <td>{{$data->CategoryID}}</td>
        <td>{{$data->CategoryName}}</td>
        <td>

        <input type="hidden" name="MappingID[]" value="{{$data->ID}}">
          <button class="removebutton btn btn-flat btn-danger" type="button"    name="removebutton[]"><i class="fa fa-times"></i></button>
        </td>



        </tr>



        @endforeach
          


        </tbody>  


        </table>

        
        </div>
      </div>
    </section>
  </div>


  <script>

  $(document).ready(function()
  {

    $('#TableforCategoryList').DataTable();


  });
  $('.removebutton').on('click',function()
  {

    var index = $('[name="removebutton[]"]').index(this);
    //var index=$('name="removebutton[]"').index(this);
    var ID=$('input[name="MappingID[]"]').eq(index).val();
    //alert(ID);
    var q = $(this).closest('tr');
    q.hide();

    $.get('/Shop/Category/Mapping/Delete/'+ID,function(data)
    {

      


    });



  });
    


  </script>

 
@endsection