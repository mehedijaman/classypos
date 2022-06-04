@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        Expense Category
        <small>Add, view and edit Expense category </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Expense"><i class="fa fa-dashboard"></i> Expense</a></li>
        <li class="active">Expense Category</li>
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->


    <!-- ======================= Main Content ========================= -->
    <section class="content">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header">
          <button class="btn btn-flat bg-navy" data-toggle="modal" data-target="#NewBankModal">New Category</button>
        </div>
        <div class="box-body">
          <table id="BankList" class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th> Category Name</th>
                <th> Action</th>
              </tr>         
            </thead>
            <tbody>
              @foreach($CategoryList as $Category)
                <tr>
                  <td>{{$Category->CategoryName}}</td>
                  <td>
                      <button  class="btn btn-flat bg-orange EditCategory" name="EditCategory[]"><i class="fa fa-pencil"></i></button>
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

      <!-- =================== New Bank  Modal ===================-->
      <div class="modal" id="NewBankModal" role="dialog">
        <div class="modal-dialog">
          <!-- =================== Modal content =================== -->
            <div class="modal-content">

              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Add new Expense category</p>
                </h1>
              </div>

              <div class="modal-body">
                {{ Form::open(array('url' => '/Expense/Category/New', 'class' => 'form-inline')) }}

                <div class="form-group">
                  <!-- <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6"> -->
                  <input type="text" id="CategoryName" class="form-control" placeholder="Category Name" name="CategoryName">
                    
                  <!-- </div> -->

                  <!-- <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6"> -->
                    {{ Form::submit('Add New Category!', array('class'=>'btn btn-primary btn-flat','name'=>'submit')) }}
                  <!-- </div>                    -->
                </div>

                {{ Form::close() }}
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Cancel</button>
              </div>
            </div>
        </div>
      </div>
      <!-- =================== New Bank Modal ===================-->

       <!-- =================== Category Edit  Modal ===================-->
      <div class="modal" id="CategoryEditModal" role="dialog">
        <div class="modal-dialog">
          <!-- =================== Modal content =================== -->
            <div class="modal-content">

              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Edit Expense category</p>
                </h1>
              </div>

              <div class="modal-body">


              <form id="EditExpenseCategory">               

                  <div class="input-group">
                    <input type="text" id="EditCategoryName" class="form-control" placeholder="New Category Name">

                    <span class="input-group-btn">
                      <input type="submit" class="btn bg-olive" id="UpdateCategory" value="Update Category">
                    </span>               
                  </div>
              </form>               
              </div>

              <div class="modal-footer">
                <button class="btn bg-maroon btn-flat" data-dismiss="modal">Cancel</button>
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
  } );
  </script>
  <script>
    $(document).ready(function() {
      $('#BankList').DataTable();

      $('#CategoryIDHidden').hide();

      $('.EditCategory').click(function()
      {
        var index=$('[name="EditCategory[]"]').index(this);
        var ID=$('input[name="CategoryID[]"]').eq(index).val();
        var Name=$('input[name="ProductCategoryName[]"]').eq(index).val();
        //alert(Name);

        $('#EditCategoryName').val(Name);
        $('#CategoryIDHidden').val(ID);
        var val=$('#CategoryIDHidden').val();
        $('#CategoryEditModal').modal('show');


      }); 
    
      $('#EditExpenseCategory').on('submit',function(event)
      {

        event.preventDefault();

        var CategoryName=$('#EditCategoryName').val();
        var Cat=$('#CategoryIDHidden').val();
        //alert(CategoryName);

        $.get('/Expense/Category/Update/'+Cat+"/"+CategoryName,function(data)
        {
          if(data=="Success")
            alertify.success("Income Category Successfully Updated");

          location.reload(true);

        });



      

      });
  } );
  </script>
@endsection