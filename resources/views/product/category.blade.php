@extends('layouts.admin')

@section('content')

<?php 
  if (isset($_REQUEST['Success'])) {
    $Success = $_REQUEST['Success'];

    if ($Success == 1) {
      echo "<script>alertify.success(' Task done Successfully !');  </script>";
    }

    if ($Success == 0) {
      echo "<script>alertify.error('Error occured !');  </script>";
    }
  }  
?>


<form id="EditForm" method="post" action="{{URL::to('/Product/Category/Update')}}" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        Product Category
        <small>Add, view and edit Product category </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Product">Product</a></li>
        <li><a href="/Product/List">List</a></li>
        <li class="active">Category</li>
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->


    <!-- ======================= Main Content ========================= -->
    <section class="content">
      <div class="box box-info">
        <!-- /.box-header -->
        <div class="box-header">
          <button class="btn btn-flat bg-navy" data-toggle="modal" data-target="#NewBankModal">New Category</button>
        </div>
        <div class="box-body">
          <table id="BankList" class="table table-bordered table-striped dataTable table-condensed">
            <thead>
              <tr>
                <th> Category Name</th>
                <th> Image</th>
                <th> Action</th>
              </tr>         
            </thead>
            <tbody>
              @foreach($CategoryList as $Category)
                <tr>
                  <td>{{$Category->CategoryName}}</td>
                  <td><img src="/uploads/image/productCategory/{{$Category->Image}}" width="30" height="30"></td>
                  <td>
                      <button  type="button" class="btn btn-flat bg-orange EditCategory" name="EditCategory[]"><i class="fa fa-pencil-square-o"></i></button>
                      <input type="hidden" class="CategoryID" name="CategoryID[]" value="{{$Category->CategoryID}}">
                      <input type="hidden" class="ProductCategoryName" name="ProductCategoryName[]" value="{{$Category->CategoryName}}">
                  </td>
                </tr>
                
              @endforeach
              <input type="text" id="CategoryIDHidden" value="0">
            </tbody>

                          
          </table>
        </div>
      </div>

      <!-- =================== New Category  Modal ===================-->
      <div class="modal" id="NewBankModal" role="dialog">
        <div class="modal-dialog">
          <!-- =================== Modal content =================== -->
            <div class="modal-content">

              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Add Product category</p>
                </h1>
              </div>

              <div class="modal-body">
                {{ Form::open(array('url' => '/Product/Category', 'class' => 'form-horizontal','enctype'=>'multipart/form-data','role'=>'form')) }}

                  <div class="input-group">
                    <input type="text" id="CategoryName" class="form-control" id="inputSuccess"placeholder="Category Name" name="CategoryName">

                    <span class="input-group-btn">
                      {{ Form::submit('Add New Category', array('class'=>'btn bg-navy btn-flat','name'=>'submit')) }}
                    </span>               
                  </div>

                {{ Form::close() }}
              </div>

              <div class="modal-footer">
                <button type="button" class="btn bg-maroon btn-flat" data-dismiss="modal">Cancel</button>
              </div>
            </div>
        </div>
      </div>
      <!-- =================== New Category Modal ===================-->



       <!-- =================== Category Edit  Modal ===================-->
      <div class="modal" id="CategoryEditModal" role="dialog">
        <div class="modal-dialog">
          <!-- =================== Modal content =================== -->
            <div class="modal-content">

              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Edit Product category</p>
                </h1>
              </div>

              <div class="modal-body">

              <form id="EditProductCategory">

              

                 <div class="form-group">

                 <!-- <div class="input-group"> -->
                  
                    <input type="text" id="EditCategoryName" class="form-control" placeholder="New Category Name">
                    
                    <!-- <span class="input-group-btn"> -->
                      <!-- <input type="submit" class="btn bg-olive" id="UpdateCategory">Edit Category</button> -->
                    <!-- </span>                -->
                  <!-- </div> -->
                   

                 </div>                

                  
                  <div class="form-group">

                  <!-- <label class="col-md-2">Image</label> -->

                   
                    <input type="file" name="CategoryImage" class="form-control">
                  
                    

                  </div>

                  <input type="submit" class="btn bg-olive" id="UpdateCategory" value="EditCategory">
                 
                  
              </form>

                
              </div>

              <div class="modal-footer">
                <button type="button" class="btn bg-maroon btn-flat" data-dismiss="modal">Cancel</button>
              </div>
            </div>
        </div>
      </div>
      <!-- =================== Category Edit Modal ===================-->
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
  <script>
    $(document).ready(function() {
      $('#BankList').DataTable();

      $('#CategoryIDHidden').hide();

       $('#BankList').on('click','.EditCategory',function(event) 

      //$('.EditCategory').click(function()
      {    


        var index=$('[name="EditCategory[]"]').index(this);
        //alert(index);  

        var ID=$('input[name="CategoryID[]"]').eq(index).val();
        var Name=$('input[name="ProductCategoryName[]"]').eq(index).val();
        //alert(Name);

        $('#EditCategoryName').val(Name);
        $('#CategoryIDHidden').val(ID);
        var val=$('#CategoryIDHidden').val();

        $('#CategoryEditModal').modal('show');


      }); 
    
      $('#EditProductCategory').on('submit',function(event)
      {
        event.preventDefault();
        var CategoryName=$('#EditCategoryName').val();
        var Cat=$('#CategoryIDHidden').val();

        $('#EditForm').append('<input type="hidden" name="CategoryName" value="'+CategoryName+'">');
        $('#EditForm').append('<input type="hidden" name="CategoryID" value="'+Cat+'">');

        $("#EditProductCategory").find(":input").clone().appendTo("#EditForm");
        $('#EditForm').hide();
        $('#EditForm').submit();


      });
  } );
  </script>
@endsection