@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-edit"></i> Edit distribution
        <small>Edit distribution of products to shop</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Product"><i class="fa fa-product-hunt"></i> Product</a></li>
        <li><a href="/Product/List"><i class="fa fa-list"></i> List</a></li>
        <li><a href="/Product/Distribute"><i class="fa fa-share"></i> Distribution</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title ">

          <label class="label label-success label-lg ">{{$pr->ProductName}}</label><br><br>

            Inventory Quantity :<div id="InventoryQuantity">  {{ $quantityintheinventory }}</div>
          </h3>         
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">

          {{ Form::open(array('url' =>'/Product/Distribute/Edit/'.$id, 'class' => 'form-horizontal')) }}

          <input type="hidden" name="saeed" value="{{$tp}}">            

            <table id="ShopList" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ShopName</th>
                  <th>Quantity</th>
                </tr>
              </thead>

              <tbody> 
                @for( $i=0; $i < $total; $i++ )
                  <tr> 
                    <td>
                      <input type="hidden" name="Identity[]" value="{{$identity[$i]}}" readonly>
                      {{ $shopname[$i] }}
                    </td>
                    <td>

                    <input type="hidden" value="{{$quantity[$i]}}" name="QuantityOriginal[]" class="QuantityOriginal form-control" readonly>

                      <input type="number" value="{{$quantity[$i]}}" name="Quantity[]" class="Quantity form-control">
                      <input type="hidden" value="{{$quantityintheinventory}}" id="InvenQuantity">
                    </td>
                  </tr>
                @endfor


                <tr>
                  <td>Shops</td>
                  <td>
                    <button type="submit" name="submit" class="btn btn-flat bg-maroon"><i class="fa fa-share"></i> Update Distribution</button>
                  </td>
                </tr>
              </tbody>
            </table>
          {{ Form::close() }}
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  <script type="text/javascript">
    $(document).ready(function(){

      // trigger dataTable
      $('#ShopList').dataTable();

      $('.Quantity').on('keyup click',function()    
      {
        var TotalOriginal=0;
        var TotalCurrent=0;
         for(i=0;i<{{$total}};i++)
         {

          var valueoriginal= parseInt($('[name="QuantityOriginal[]"]').eq(i).val(),10);
          var value= parseInt($('[name="Quantity[]"]').eq(i).val(),10);
          TotalOriginal=TotalOriginal+valueoriginal;
          TotalCurrent=TotalCurrent+value;
         }
         TotalCurrent=parseInt(TotalCurrent,10);
         var Diff=parseInt(TotalCurrent-TotalOriginal,10);
         var InventoryValue=parseInt($('#InvenQuantity').val(),10);
         if(Diff>=0)
         {
          var CurInventoryQuantity=parseInt(InventoryValue-Diff,10);
         }

         if(Diff<0)
         {
          var CurInventoryQuantity=InventoryValue-Diff;
         }

        $('#InventoryQuantity').empty();
        $('#InventoryQuantity').append(CurInventoryQuantity);
         //alert(TotalCurrent);          

      });
    });
  </script>
@endsection