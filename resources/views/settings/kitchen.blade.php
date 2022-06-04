@extends('layouts.admin')

@section('content')


  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        Kitchen Management
        <small>Add, view and edit Kitchen </small>
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
          <button class="btn btn-flat bg-olive" data-toggle="modal" data-target="#NewKitchenModal">New Kitchen</button>
        </div>
        <div class="box-body">

        
          
          <table id="KitchenList" class="table table-bordered table-striped dataTable table-condensed">
            <thead>
              <tr>
                <th> Shop Name</th>
                <th> Kitchen Name</th>
                <th> Action</th>
                
              </tr>         
            </thead>
            <tbody>

              @foreach($Kitchen as $data)
              <tr>
                <td>{{$data->ShopName}}</td>
                <td>{{$data->Name}}</td>
                <td><button  type="button" class="btn btn-flat bg-orange EditKitchen" name="EditKitchen[]"><i class="fa fa-pencil-square-o"></i></button>
                <button  type="button" class="btn btn-flat bg-maroon DeleteKitchen" name="DeleteKitchen[]"><i class="fa fa-trash"></i></button>
                <input type="hidden" class="KitchenID" name="KitchenID[]" value="{{$data->ID}}">
                <input type="hidden" class="KitchenName" name="KitchenName[]" value="{{$data->Name}}">
                <input type="hidden" class="ShopIDMain" name="ShopIDMain[]" value="{{$data->ShopID}}">
                </td>
              </tr>
              @endforeach
              
              <!-- <input type="text" id="CategoryIDHidden" value="0"> -->
              <!-- <input type="text" id="TableIDforDelete" value="0"> -->
            </tbody>

                          
          </table>
        </div>
      </div>

      <!-- =================== New Kitchen  Modal ===================-->
      <div class="modal" id="NewKitchenModal" role="dialog">
        <div class="modal-dialog">
          <!-- =================== Modal content =================== -->
            <div class="modal-content">

              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Add New Kitchen</p>
                </h1>
              </div>

              <div class="modal-body">

                <form method="POST" action="{{URL::to('/Kitchen/New/')}}" class="form-horizontal">

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

                        <input type="text" id="KitchenName" class="form-control" placeholder="Kitchen Name" name="KitchenName">                   

                      </div>

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



       <!-- =================== Kitchen Edit  Modal ===================-->
      <div class="modal" id="KitchenEditModal" role="dialog">
        <div class="modal-dialog">
          <!-- =================== Modal content =================== -->
            <div class="modal-content">

              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Edit Kitchen</p>
                </h1>
              </div>

              <div class="modal-body">



              <form method="POST" action="{{URL::to('/Kitchen/Update/')}}" class="form-horizontal">

                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="KitchenID" id="KitchenID">
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

                        <input type="text" id="KitchenNameEdit" class="form-control" placeholder="Kitchen Name" name="KitchenName">                   

                      </div>
                    </div>                
              </div>

              <div class="modal-footer">

                <div class="col-md-6">
                  <input type="submit" class="btn btn-flat bg-orange" value="Update Kitchen">
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

  //$('#KitchenList').DataTable();

      $('#CategoryIDHidden').hide();
      $('#TableIDforDelete').hide();

      $('.DeleteKitchen').on('click',function(e)
      {
        e.preventDefault();
        var index=$('[name="DeleteKitchen[]"]').index(this);
        $('#IndexforKitchenDelete').val(index);
        var ID=$('input[name="KitchenID[]"]').eq(index).val();
        var Name=$('input[name="KitchenName[]"]').eq(index).val();
        $('#KitchenIDforDelete').val(ID);
          alertify.confirm('Delete Kitchen', 'Are you sure you want to Delete This Kitchen?',
              function(){
          //var ID=$('#TableIDforDelete').val();

          $.get('/Kitchen/Delete/'+ID,function(data)
          {
            var Delete=$('input[name="KitchenID[]"]').eq(index).closest('tr');
            Delete.remove();           

          });
         },function(){ alertify.error('Cancel')});


      });

     

      $('.EditKitchen').click(function(e)
      {
        e.preventDefault();
        var index=$('[name="EditKitchen[]"]').index(this);
        var ID=$('input[name="KitchenID[]"]').eq(index).val();
        var Name=$('input[name="KitchenName[]"]').eq(index).val();
        var Shop=$('input[name="ShopIDMain[]"]').eq(index).val();

        //var Name=$('[name="KitchenName[]"]').eq(index).val();

        $('#KitchenID').val(ID);
        $('#KitchenNameEdit').val(Name);
        $('#ShopEdit').val(Shop);
        $('#KitchenEditModal').modal('show');
      });

      

  </script>
@endsection