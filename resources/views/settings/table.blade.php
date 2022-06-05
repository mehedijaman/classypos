@extends('layouts.admin')

@section('content')


  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        Table Management
        <small>Add, view and edit Table </small>
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
          <button class="btn btn-flat bg-olive" data-toggle="modal" data-target="#NewBankModal">New Table</button>
        </div>
        <div class="box-body">

        
          
          <table id="BankList" class="table table-bordered table-striped dataTable table-condensed">
            <thead>
              <tr>
                <th> Shop Name</th>
                <th> Table Name</th>
                <th> Location</th>
                <th> Capacity</th>
                <th> Action</th>
              </tr>         
            </thead>
            <tbody>
              @foreach($Counter as $Category)
                <tr>
                  <td>{{$Category->ShopName}}</td>
                  <td>{{$Category->Name}}</td>
                  <td>{{$Category->Location}}</td>
                  <td>{{$Category->Capacity}}</td>


                  <td>
                      <button  type="button" class="btn btn-flat bg-orange EditCategory" name="EditCategory[]"><i class="fa fa-pencil-square-o"></i></button>
                      <button  type="button" class="btn btn-flat bg-maroon TableDelete" name="TableDelete[]"><i class="fa fa-trash"></i></button>
                      <input type="hidden" class="CategoryID" name="CategoryID[]" value="{{$Category->ID}}">
                      <input type="hidden" class="ProductCategoryName" name="ProductCategoryName[]" value="{{$Category->Name}}">


                  </td>
                </tr>
                
              @endforeach
              <input type="text" id="CategoryIDHidden" value="0">
              <input type="text" id="TableIDforDelete" value="0">
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
                  <p class="label label-primary">Add New Table</p>
                </h1>
              </div>

              <div class="modal-body">

                <form method="POST" action="{{URL::to('/Table/New/')}}" class="form-horizontal">

                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <!-- {{ Form::open(array('url' => '/Table/New', 'class' => 'form-horizontal','enctype'=>'multipart/form-data','role'=>'form')) }} -->

                    <div class="form-group">


                      <label for="" class="col-md-2">Shop</label>
                      <div class="col-md-4">
                        <select name="Shop" id="Shop" class="form-control">
                          @foreach($Shop as $data)
                            <option value="{{$data->ShopID}}">{{$data->ShopName}}</option>
                          @endforeach
                        </select>              
                      </div>

                      <label for="" class="col-md-2">Name</label>

                      <div class="col-md-4">

                        <input type="text" id="TableName" class="form-control" placeholder="Table Name" name="TableName">                   

                      </div>

                    </div>

                    <div class="form-group">

                      <label for="" class="col-md-2">Location</label>

                      <div class="col-md-4">

                        <input type="text" id="TableLocation" class="form-control" placeholder="Table Location" name="TableLocation">                   

                      </div>

                      <label for="" class="col-md-2">Capacity</label>

                      <div class="col-md-4">

                        <input type="number" step=".0001" id="TableCapacity" class="form-control" id="TableCapacity" placeholder="Table Capacity" name="TableCapacity">                   

                      </div>


                      

                      <!-- <span class="input-group-btn"> -->

                      
                      <!-- </span>                -->
                    </div>

                <!-- {{ Form::close() }} -->
              </div>

              <div class="modal-footer">

                <div class="col-md-6 col-md-offset-2">

                <input type="submit" class="btn btn-flat btn-success" value="Add New Table">

              <!-- {{ Form::submit('Add New Table', array('class'=>'btn btn-success btn-flat form-control','name'=>'submit')) }} -->
            

                </div>

                <button type="button" type="button" class="btn bg-maroon btn-flat" data-dismiss="modal">Cancel</button>

              </div>
            </div>
          </form>
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
                  <p class="label label-primary">Edit Table</p>
                </h1>
              </div>

              <div class="modal-body">



              <form method="POST" action="{{URL::to('/Table/Update/')}}" class="form-horizontal">

                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="TableID" id="TableID">
                  <!-- {{ Form::open(array('url' => '/Table/New', 'class' => 'form-horizontal','enctype'=>'multipart/form-data','role'=>'form')) }} -->

                    <div class="form-group">


                      <label for="" class="col-md-2">Shop</label>
                      <div class="col-md-4">
                        <select name="Shop" id="ShopEdit" class="form-control">
                          @foreach($Shop as $data)
                            <option value="{{$data->ShopID}}">{{$data->ShopName}}</option>
                          @endforeach
                        </select>              
                      </div>

                      <label for="" class="col-md-2">Name</label>

                      <div class="col-md-4">

                        <input type="text" id="TableNameEdit" class="form-control" placeholder="Table Name" name="TableName">                   

                      </div>

                    </div>

                    <div class="form-group">

                      <label for="" class="col-md-2">Location</label>

                      <div class="col-md-4">

                        <input type="text" id="TableLocationEdit" class="form-control" placeholder="Table Location" name="TableLocation">                   

                      </div>

                      <label for="" class="col-md-2">Capacity</label>

                      <div class="col-md-4">

                        <input type="number" step=".0001" id="TableCapacityEdit" class="form-control" id="TableCapacity" placeholder="Table Capacity" name="TableCapacity">                   

                      </div>

                    </div>
      

                
              </div>

              <div class="modal-footer">

                <div class="col-md-6">
                  <input type="submit" class="btn btn-flat bg-orange" value="Update Table">
                </div>
                <button type="button" class="btn bg-maroon btn-flat" data-dismiss="modal">Cancel</button>
              </div>
            </div>
            </form>
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
      $('#TableIDforDelete').hide();

      $('.EditCategory').click(function()

      {    


        var index=$('[name="EditCategory[]"]').index(this);  

        var ID=$('input[name="CategoryID[]"]').eq(index).val();
        var Name=$('input[name="ProductCategoryName[]"]').eq(index).val();
        $('#TableID').val(ID);

        $.get('/Table/Details/'+ID,function(data)
        {

          var Counter=JSON.parse(data);
          var TableName=Counter[0].Name;
          var ShopID=Counter[0].ShopID;
          var Location=Counter[0].Location;
          var Capacity=Counter[0].Capacity;

          $('#TableNameEdit').val(TableName);
          $('#ShopEdit').val(ShopID);
          $('#TableLocationEdit').val(Location);
          $('#TableCapacityEdit').val(Capacity);
          //$('#ShopEdit').val(ShopID);




        });


        
        //alert(Name);

        //$('#EditCategoryName').val(Name);
        $('#CategoryIDHidden').val(ID);
        $('#TableID').val(ID);

        //var val=$('#CategoryIDHidden').val();
        //alert(val);

        $('#CategoryEditModal').modal('show');


      });




      $('.TableDelete').click(function()

        {
          var index=$('[name="TableDelete[]"]').index(this);
          var ID=$('input[name="CategoryID[]"]').eq(index).val();
          $('#TableIDforDelete').val(ID);
          alertify.confirm('Delete Table', 'Are you sure you want to Delete This Table?',

              function(){

          var ID=$('#TableIDforDelete').val();
          $.get('/Table/Delete/'+ID,function(data)
          {

            //alertify.success('Table Successfully Removed');

            location.reload(true);

          });


         },function(){ alertify.error('Cancel')});
          



        });



    
      $('#EditProductCategory').on('submit',function(event)
      {
        event.preventDefault();
        var CategoryName=$('#EditCategoryName').val();
        var Cat=$('#CategoryIDHidden').val();
        //alert(Cat);

        $.get('/Product/Category/Update/'+Cat+"/"+CategoryName,function(data)
        {

          location.reload(true);

        });



      

      });
  } );
  </script>
@endsection