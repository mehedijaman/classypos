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
          
        </div>
        <div class="box-body">
          <table id="BankList" class="table table-bordered table-striped dataTable table-condensed">
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
                      <select name="KitchenID[]"  class="form-control KitchenID">
                      @foreach($Kitchen as $data)
                        <option value="{{$data->ID}}">{{$data->Name}}</option>
                      @endforeach
                        
                      </select>
                      <input type="hidden" class="CategoryID" name="CategoryID[]" value="{{$Category->CategoryID}}">
                      <input type="hidden" class="ProductCategoryName" name="ProductCategoryName[]" value="{{$Category->CategoryName}}">


                  </td>
                </tr>                
              @endforeach

              @foreach($KitchenCategory as $data)

              <input type="hidden" name="CategoryIDReal[]" value="{{$data->CategoryID}}">
              <input type="hidden" name="KitchenIDReal[]" value="{{$data->KitchenID}}">


              @endforeach
              <input type="hidden" id="CategoryIDHidden" value="0">
            </tbody>

                          
          </table>
        </div>
      </div>

     
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
  <script>
    $(document).ready(function() {

      //alert("I am Fahad");

      var Total=$('[name="CategoryID[]"]').length;
      var TotalUsed=$('[name="CategoryIDReal[]"]').length;
      //alert(TotalUsed);
      for(i=0;i<Total;i++)
      {
        Cate1=$('[name="CategoryID[]"]').eq(i).val();

        for(j=0;j<TotalUsed;j++)
        {
          Cate2=$('[name="CategoryIDReal[]"]').eq(j).val();
          if(Cate1==Cate2)
          {
            var Value=$('[name="KitchenIDReal[]"]').eq(j).val();
            $('[name="KitchenID[]"]').eq(i).val(Value);

            //alert("Something is there");
          }
        }

      }
      
      $('.KitchenID').on('change',function()
      {
        //e.PreventDefault();
        var Index=$('[name="KitchenID[]"]').index(this);
        var Kitchen=$('[name="KitchenID[]"]').eq(Index).val();
        var Category=$('[name="CategoryID[]"]').eq(Index).val();
        $.get('/Kitchen/Category/Confirm/'+Category+'/'+Kitchen,function(data)
        {
          alertify.success("Category Successfully Updated");

        });


      });

      



      

      });
  
  </script>
@endsection