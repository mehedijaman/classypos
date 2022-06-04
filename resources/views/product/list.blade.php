@extends('layouts.admin')
@section('content')
<style>
.pagination {
    display: inline-block;
}
.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
}


</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <i class="fa fa-cubes"></i> Product List
        <small>| Main stock product list</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Product"><i class="fa fa-product-hunt"></i> Product</a></li>
        <li class="active">List</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-info">
        <div class="box-header"> 
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">  
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-barcode fa-lg"></i></span>
                  <input type="text" name="titlesearchByID" id="titlesearchByID" class="form-control" placeholder="Enter Product ID" value="{{ old('titlesearch') }}" autofocus>
                </div>                
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><strong>Name</strong></span>
                  <input type="text" name="titlesearch" id="titlesearch" class="form-control" placeholder="Enter Product Name" value="{{ old('titlesearch') }}"  autocomplete="off">
                </div>                
              </div>
            </div> 

            <div class="col-md-4">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><strong>Category</strong></span>
                  <select name="CategoryID" id="CategoryID" class="form-control">
                    <option value="0">All Category</option>
                    @foreach($CategoryList as $Category)
                      <option value="{{ $Category->CategoryID }}">{{ $Category->CategoryName }}</option>
                    @endforeach
                  </select>
                </div>                
              </div>
            </div> 

            <div class="col-md-1">
              <div class="form-group">
                <div class="button-group">
                  <button class="btn btn-primary"><i class="fa fa-refresh"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="box-body">
          <div id="ajaxContent">
          </div> 
          <table id="ProductList" class="display table table-hover table responsive">
            <thead> 
              <tr>                
                <th> ID </th>                
                <th> Category </th>
                <th> Vendor </th>
                <th> Product Name </th>
                <th> Cost (BDT)</th>
                <th> Sales (BDT)</th>
                <th> Profit</th>
                <th> Qty </th>
                <th> Status </th>
                <th> Action </th>
              </tr>           
            </thead>            

            <tbody id="ProductBody">

            @foreach($ProductList as $data)

            <tr>
              <td>{{$data->ProductID}}</td>
              <td>{{$data->CategoryName}}</td>
              <td>{{$data->VendorName}}</td>
              <td>{{$data->ProductName}}</td>
              <td>{{$data->CostPrice}}</td>
              <td>{{$data->SalePrice}}</td>
              <td>{{$data->SalePrice - $data->CostPrice}}</td>
              <td>{{$data->Qty}}</td>
              @if($data->InactiveProduct==0)
              <td><strong class="label label-primary">Active</strong></td>
              @endif
              @if($data->InactiveProduct==1)
              <td><strong class="label label-danger">InActive</strong></td>
              @endif
              <td><input type="hidden" name="ProductIDforList[]" class="ProductIDforList" value="{{$data->ProductID}}"><button class="btn btn-info btn-flat ProductDetails" title="Details" name="ProductDetails[]"><i class="fa fa-info fa-lg"></i></button><button name="ProductEdit[]" class="btn bg-orange btn-flat ProductEdit" title="Edit"> <i class="fa fa-pencil-square-o fa-lg"></i> </button><a href="/Product/Delete/{{$data->ProductID}}" id="DeleteBtn" class="btn btn-danger btn-flat" title="Delete"> <i class="fa fa-trash fa-lg"> </i> </a><button class="ProductDistribution btn bg-maroon btn-flat" name="ProductDistribution[]" title="Distribute to Shop"> <i class="fa fa-share fa-lg" > </i> </button></td>
            </tr>



            @endforeach               
              
            </tbody>     
          </table>

          <div class="Pager">

          {!!$ProductList->links()!!}

          

          </div>

           <div class="pagi"></div>
        </div>
      </div>

      <form id="DistributeForm" method="post" action="{{URL::to('/Product/Admin/Distribute/Edit/')}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div id="DistributeFormBody">
        </div>
      </form>



      <form id="EditForm" method="post" action="{{URL::to('/Product/Edit')}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="ProductName" id="ProductNameOriginal">
        <input type="hidden" name="ProductID" id="ProductIDOriginal">
        <input type="hidden" name="ProductDescription" id="ProductDescriptionOriginal">
        <input type="hidden" name="CategoryID" id="CategoryIDOriginal">
        <input type="hidden" name="VendorID" id="VendorIDOriginal">
        <input type="hidden" name="Qty" id="QtyOriginal">
        <input type="hidden" name="MinQtyLevel" id="MinQtyLevelOriginal">
        <input type="hidden" name="Unit" id="UnitOriginal">
        <input type="hidden" name="CostPrice" id="CostPriceOriginal">
        <input type="hidden" name="SalePrice" id="SalePriceOriginal">
        <input type="hidden" name="PreferredPrice" id="PreferredPriceOriginal">
        <input type="hidden" name="TaxCode" id="TaxCodeOriginal">
        <!-- <input name="ProductImgReal" type="file" class="form-control" id="ProductImgReal" placeholder="Enter"> -->
        
        <div id="EditFormBody">
        </div>
      </form>


   </section>
  </div>

  <script>
    $(document).ready(function() {
      
      $('#titlesearch').on('keyup',function(e)
      {
        AddProductToList();
      });

      $('#CategoryID').on('change',function(e)
      {
        AddProductToList();
      });

      $('.ProductEdit').on('click',function(e)
      {
        e.preventDefault();
        var index=$('[name="ProductEdit[]"]').index(this);
        var ProductID=$('input[name="ProductIDforList[]"]').eq(index).val();
        ProductEdit(ProductID);
      });


      $('.ProductDetails').on('click',function(e)
      {
        e.preventDefault();
        $('#Product_Title').empty();
        $('#modalproductdetail').empty();
        var index=$('[name="ProductDetails[]"]').index(this);
        var ProductID=$('input[name="ProductIDforList[]"]').eq(index).val();

        $.get('/Product/Details/ShopID/' +ProductID, function(data) {

            var Product = JSON.parse(data.Product);
            var CategoryName=JSON.parse(data.CategoryName);
            var VendorName=JSON.parse(data.VendorName);
            $('#Product_Title').append(Product.ProductName);
           document.getElementById('modalproductdetail').innerHTML = '<tr><td>ProductID</td><td>' + Product.ProductID + '</td></tr><tr><td>Category</td><td>' + CategoryName + '</td></tr><tr><td>Vendor</td><td>' + VendorName + '</td></tr><tr><td>Quantity</td><td>' + Product.Qty + '</td></tr><tr><td>SalePrice</td><td>' + Product.SalePrice + '</td></tr><tr><td>CostPrice</td><td>' + Product.CostPrice + '</td></tr><tr id="PreferredPriceRow"><td>Preferred Price</td><td>' + Product.PreferredPrice + '</td></tr><tr id="ImageRow"><td>Image</td><td><img src="/uploads/image/product/' + Product.ProductImg + '" width=50 height=50></td></tr>';

            if(Product.ProductImg==null || Product.ProductImg=="" || Product.ProductImg=="Nothing"|| Product.ProductImg=="No Image")
                $('#ImageRow').hide();

            if(Product.PreferredPrice==null||Product.PreferredPrice=="")
                $('#PreferredPriceRow').hide();
            
            $('#ProductDetailsModal').modal('show');
        });
      });


      $('.ProductDistribution').on('click',function(e)
      {
        $('#DistributeFormBody').empty();
        e.preventDefault();
        var Index=$('[name="ProductDistribution[]"]').index(this);
        var ProductID=$('input[name="ProductIDforList[]"]').eq(Index).val();
        $.get('/Product/Distribute/Edit/'+ProductID,function(data)
        {
          var Product=JSON.parse(data.pr);
          var quantity=JSON.parse(data.quantity);
          var quantityintheinventory=JSON.parse(data.quantityintheinventory);
          var identity=JSON.parse(data.identity);
          var ShopName=JSON.parse(data.shopname);
          var QuantityBeforeDistribution=JSON.parse(data.tp);
          $('#ProductDistributionBody').empty();
          $('#ProductDistributionHeader').empty();
          $('#ProductDistributionHeader').append('<h1>'+Product.ProductName+'</h1><h4>Inventory Quantity: <div id="InventoryQuantity">'+quantityintheinventory+'</div> </h4>');          
          
          for(i=0;i<ShopName.length;i++)
          {
            $('#ProductDistributionBody').append('<tr><td><input type="hidden" name="Identity[]" class="Identity" value="'+identity[i]+'">'+ShopName[i]+'</td><td><input type="hidden" value="'+quantity[i]+'" name="QuantityOriginal[]" class="QuantityOriginal"><input type="number" value="'+quantity[i]+'" name="Quantity[]" class="Quantity form-control"> <input type="hidden" value="'+quantityintheinventory+'" id="InvenQuantity"></td></tr>');
          }         


          $('.Quantity').on('click keyup',function(e)
          {
              e.preventDefault();
              var TotalOriginal=0;
              var TotalCurrent=0;
              for(i=0;i<ShopName.length;i++)
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
          });

          $('#FormforDistribution').on('submit',function(e)
          {
            e.preventDefault();
            $("#ProductDistributionBody").find(":input").clone().appendTo("#DistributeFormBody");
            $('#DistributeFormBody').append('<input type="hidden" name="ProductPreviousQuantity" value="'+QuantityBeforeDistribution+'">'); 
            $('#DistributeFormBody').append('<input type="hidden" name="ProductIDDistribute" value="'+Product.ProductID+'">');
            $('#DistributeForm').submit();
          });



        });

        $('#ProductDistributionModal').modal('show');
      });


      $('#FormforEdit').on('submit',function(e)
      {
        e.preventDefault();

        $('#ProductNameOriginal').val($('#ProductNameEdit').val());
        $('#ProductIDOriginal').val($('#ProductIDEdit').val());
        $('#ProductDescriptionOriginal').val($('#ProductDescriptionEdit').val());
        $('#CategoryIDOriginal').val($('#CategoryIDEdit').val());
        $('#VendorIDOriginal').val($('#VendorIDEdit').val());
        $('#QtyOriginal').val($('#QtyEdit').val());
        $('#MinQtyLevelOriginal').val($('#MinQtyLevelEdit').val());
        $('#UnitOriginal').val($('#UnitEdit').val());
        $('#CostPriceOriginal').val($('#CostPriceEdit').val());
        $('#SalePriceOriginal').val($('#SalePriceEdit').val());
        $('#PreferredPriceOriginal').val($('#PreferredPriceEdit').val());
        $('#TaxCodeOriginal').val($('#TaxCodeEdit').val());
        $("#PrImg").find(":input").clone().appendTo("#EditForm");
        
        $('#EditForm').submit();

      });



      function AddProductToList()      
      {
        var search=$('#titlesearch').val();
        if(search=="")
          search="NoName";
        var CategoryID=$('#CategoryID').val();

        if(search=="NoName" && CategoryID==0)
        {
          $.get('/Product/Search/ByName/'+search+'/'+CategoryID,function(data)
          {
            var Total=JSON.parse(data.product);
            var Links=JSON.parse(data.page);
            $('#ProductBody').empty();
            var Length=Total.per_page;
            for(i=0;i<Length;i++)
            {

              if(Total.data[i].InactiveProduct==0)
              {
                var check='<strong class="label label-primary">Active</strong>';       
              }

              if(Total.data[i].InactiveProduct==1)
              {
                var check='<strong class="label label-danger">InActive</strong>';       
              }
              var Profit=Total.data[i].SalePrice-Total.data[i].CostPrice;

              $('#ProductList').append('<tr><td>'+Total.data[i].ProductID+'</td><td>'+Total.data[i].CategoryName+'</td><td>'+Total.data[i].VendorName+'</td><td>'+Total.data[i].ProductName+'</td><td>'+Total.data[i].CostPrice+'</td><td>'+Total.data[i].SalePrice+'</td><td>'+Profit+'</td><td>'+Total.data[i].Qty+'</td><td>'+check+'</td><td><td> <button  class="btn btn-info btn-flat ProductDetails" title="Details" name="ProductDetails[]""> <i class="fa fa-info fa-lg"></i> </button><button name="ProductEdit[]"   class="btn bg-orange btn-flat ProductEdit" title="Edit"> <i class="fa fa-pencil-square-o fa-lg"></i> </button><a href="/Product/Delete/'+Total.data[i].ProductID+'" id="DeleteBtn" class="btn btn-danger btn-flat" title="Delete"> <i class="fa fa-trash fa-lg"> </i> </a><button class="btn bg-maroon btn-flat ProductDistribution" name="ProductDistribution[]" title="Distribute to Shop"> <i class="fa fa-share fa-lg" > </i> </button> </td></td></tr>');
            }

              $('.Pager').hide();
              $('.pagi').html(Links);
              $("li").removeClass('disabled');
          });
        }



        else
        {    

          $.get('/Product/Search/ByName/'+search+'/'+CategoryID,function(data)
          { 
            if(search=="NoName" && CategoryID>0)
            {

              var Total=JSON.parse(data.product);

              

              var Links=JSON.parse(data.page);

              $('#ProductBody').empty();
              var Length=Total.per_page;
              for(i=0;i<Length;i++)
              {

                  if(Total.data[i].InactiveProduct==0)
                  {
                    var check='<strong class="label label-primary">Active</strong>';       
                  }

                  if(Total.data[i].InactiveProduct==1)
                  {
                    var check='<strong class="label label-danger">InActive</strong>';       
                  }
                var Profit=Total.data[i].SalePrice-Total.data[i].CostPrice;

                $('#ProductList').append('<tr><td>'+Total.data[i].ProductID+'</td><td>'+Total.data[i].CategoryName+'</td><td>'+Total.data[i].VendorName+'</td><td>'+Total.data[i].ProductName+'</td><td>'+Total.data[i].CostPrice+'</td><td>'+Total.data[i].SalePrice+'</td><td>'+Profit+'</td><td>'+Total.data[i].Qty+'</td><td>'+check+'</td><td><td> <button  class="btn btn-info btn-flat ProductDetails" name="ProductDetails[]" title="Details"> <i class="fa fa-info fa-lg"></i> </button><button name="ProductEdit[]" class="btn bg-orange btn-flat ProductEdit" title="Edit"> <i class="fa fa-pencil-square-o fa-lg"></i> </button><a href="/Product/Delete/'+Total.data[i].ProductID+'" id="DeleteBtn" class="btn btn-danger btn-flat" title="Delete"> <i class="fa fa-trash fa-lg"> </i> </a><button class="btn bg-maroon btn-flat ProductDistribution" name="ProductDistribution[]" title="Distribute to Shop"> <i class="fa fa-share fa-lg" > </i> </button><input type="hidden" name="ProductIDforList[]" value="'+Total.data[i].ProductID+'"> </td></tr>');
              }

              $('.ProductDetails').on('click',function(e)
              {

                e.preventDefault();
                $('#Product_Title').empty();
                $('#modalproductdetail').empty();
                var index=$('[name="ProductDetails[]"]').index(this);
                var ProductID=$('input[name="ProductIDforList[]"]').eq(index).val();
                ProductDetails(ProductID);
              });

              $('.ProductEdit').on('click',function(e)
              {
                e.preventDefault();
                var index=$('[name="ProductEdit[]"]').index(this);
                var ProductID=$('input[name="ProductIDforList[]"]').eq(index).val();
                ProductEdit(ProductID);

              });


              $('.ProductDistribution').on('click',function()
              {

                var index=$('[name="ProductDistribution[]"]').index(this);
                var ProductID=$('input[name="ProductIDforList[]"]').eq(index).val();

                ProductDistribution(ProductID);



              });              



              $('.Pager').hide();
              $('.pagi').html(Links);              

            }


            if(search!="NoName" && CategoryID==0)
            {


              var Total=JSON.parse(data.product);
              var Links=JSON.parse(data.page);

              $('#ProductBody').empty();
              var Length=Total.per_page;
              for(i=0;i<Length;i++)
              {

                  if(Total.data[i].InactiveProduct==0)
                  {
                    var check='<strong class="label label-primary">Active</strong>';       
                  }

                  if(Total.data[i].InactiveProduct==1)
                  {
                    var check='<strong class="label label-danger">InActive</strong>';       
                  }
                var Profit=Total.data[i].SalePrice-Total.data[i].CostPrice;

                $('#ProductList').append('<tr><td>'+Total.data[i].ProductID+'</td><td>'+Total.data[i].CategoryName+'</td><td>'+Total.data[i].VendorName+'</td><td>'+Total.data[i].ProductName+'</td><td>'+Total.data[i].CostPrice+'</td><td>'+Total.data[i].SalePrice+'</td><td>'+Profit+'</td><td>'+Total.data[i].Qty+'</td><td>'+check+'</td><td><td> <button class="btn btn-info btn-flat ProductDetails" name="ProductDetails[]" title="Details"> <i class="fa fa-info fa-lg"></i> </button><button name="ProductEdit[]" class="btn bg-orange btn-flat ProductEdit " title="Edit"> <i class="fa fa-pencil-square-o fa-lg"></i></button><a href="/Product/Delete/'+Total.data[i].ProductID+'" id="DeleteBtn" class="btn btn-danger btn-flat" title="Delete"> <i class="fa fa-trash fa-lg"> </i> </a><button class="btn bg-maroon btn-flat ProductDistribution" name="ProductDistribution[]" title="Distribute to Shop"> <i class="fa fa-share fa-lg" > </i> </button> </td><input type="hidden" name="ProductIDforList[]" value="'+Total.data[i].ProductID+'"></td></tr>');
              }


              $('.Pager').hide();
              $('.pagi').html(Links);

              $('.ProductDetails').on('click',function(e)

              {

                e.preventDefault();
                $('#Product_Title').empty();
                $('#modalproductdetail').empty();
                var index=$('[name="ProductDetails[]"]').index(this);
                var ProductID=$('input[name="ProductIDforList[]"]').eq(index).val();
                ProductDetails(ProductID);


              });

              $('.ProductEdit').on('click',function(e)
              {
                e.preventDefault();
                var index=$('[name="ProductEdit[]"]').index(this);
                var ProductID=$('input[name="ProductIDforList[]"]').eq(index).val();
                ProductEdit(ProductID);

              });


              $('.ProductDistribution').on('click',function()
              {

                var index=$('[name="ProductDistribution[]"]').index(this);
                var ProductID=$('input[name="ProductIDforList[]"]').eq(index).val();

                ProductDistribution(ProductID);
              });

            }


            if(search!="NoName" && CategoryID>0)
            {


              var Total=JSON.parse(data.product);
              var Links=JSON.parse(data.page);

              $('#ProductBody').empty();
              var Length=Total.per_page;
              for(i=0;i<Length;i++)
              {

                  if(Total.data[i].InactiveProduct==0)
                  {
                    var check='<strong class="label label-primary">Active</strong>';       
                  }

                  if(Total.data[i].InactiveProduct==1)
                  {
                    var check='<strong class="label label-danger">InActive</strong>';       
                  }
                var Profit=Total.data[i].SalePrice-Total.data[i].CostPrice;

                $('#ProductList').append('<tr><td>'+Total.data[i].ProductID+'</td><td>'+Total.data[i].CategoryName+'</td><td>'+Total.data[i].VendorName+'</td><td>'+Total.data[i].ProductName+'</td><td>'+Total.data[i].CostPrice+'</td><td>'+Total.data[i].SalePrice+'</td><td>'+Profit+'</td><td>'+Total.data[i].Qty+'</td><td>'+check+'</td><td><td> <button name="ProductDetails[]" class="btn btn-info btn-flat ProductDetails" title="Details"> <i class="fa fa-info fa-lg"></i> </button><button name="ProductEdit[]" class="btn bg-orange btn-flat ProductEdit" title="Edit"> <i class="fa fa-pencil-square-o fa-lg"></i> </button><a href="/Product/Delete/'+Total.data[i].ProductID+'" id="DeleteBtn" class="btn btn-danger btn-flat" title="Delete"> <i class="fa fa-trash fa-lg"> </i> </a><button class="btn bg-maroon btn-flat ProductDistribution" name="ProductDistribution[]" title="Distribute to Shop"> <i class="fa fa-share fa-lg" > </i> </button> </td><input type="hidden" name="ProductIDforList[]" value="'+Total.data[i].ProductID+'"></td></tr>');
              }
              
              $('.Pager').hide();
              $('.pagi').html(Links);


              $('.ProductDetails').on('click',function(e)
              {
                e.preventDefault();
                $('#Product_Title').empty();
                $('#modalproductdetail').empty();
                var index=$('[name="ProductDetails[]"]').index(this);
                var ProductID=$('input[name="ProductIDforList[]"]').eq(index).val();

                ProductDetails(ProductID);


              });

              $('.ProductEdit').on('click',function(e)
              {
                e.preventDefault();
                var index=$('[name="ProductEdit[]"]').index(this);
                var ProductID=$('input[name="ProductIDforList[]"]').eq(index).val();
                ProductEdit(ProductID);

              });

              $('.ProductDistribution').on('click',function()
              {

                var index=$('[name="ProductDistribution[]"]').index(this);
                var ProductID=$('input[name="ProductIDforList[]"]').eq(index).val();

                ProductDistribution(ProductID);

              });         


            }

            
          });
        }


      }      


      $('#titlesearchByID').on('keyup',function(e)
      {

        var search=$('#titlesearchByID').val();
        if(search=="")
        {
          location.reload();
        }
        else
        {

          var BarcodeText =search;
          var ProductID   =search;
          var S = BarcodeText.includes("S");
          var s = BarcodeText.includes("s");

          if(S==true || s==true)
          {
              if (BarcodeText.indexOf('s') > -1)
              {
                  BarcodeText = BarcodeText.split("s");                  
              }

              if (BarcodeText.indexOf('S') > -1)
              {
                  var BarcodeText = BarcodeText.split("S");
              }

              var ProductID = BarcodeText[0];
          }

          $.get('/Product/Search/ByID/'+ProductID,function(data)
          {
            $('#ProductBody').empty();
            var Total=JSON.parse(data);

            $('.pagi').hide();
            for(i=0;i<Total.length;i++)
            {

              if(Total[i].InactiveProduct==0)
              {
                var check='<strong class="label label-primary">Active</strong>';       
              }

              if(Total[i].InactiveProduct==1)
              {
                var check='<strong class="label label-danger">InActive</strong>';       
              }


              var Profit=Total[i].SalePrice-Total[i].CostPrice;
              $('#ProductList').append('<tr><td>'+Total[i].ProductID+'</td><td>'+Total[i].CategoryName+'</td><td>'+Total[i].VendorName+'</td><td>'+Total[i].ProductName+'</td><td>'+Total[i].CostPrice+'</td><td>'+Total[i].SalePrice+'</td><td>'+Profit+'</td><td>'+Total[i].Qty+'</td><td>'+check+'</td><td> <button class="btn btn-info btn-flat ProductDetails" name="ProductDetails[]" title="Details"> <i class="fa fa-info fa-lg"></i> </button><button name="ProductEdit[]" class="btn bg-orange btn-flat ProductEdit" title="Edit"> <i class="fa fa-pencil-square-o fa-lg"></i> </button><a href="/Product/Delete/'+Total[i].ProductID+'" id="DeleteBtn" class="btn btn-danger btn-flat" title="Delete"> <i class="fa fa-trash fa-lg"> </i> </a><button class="btn bg-maroon btn-flat ProductDistribution" name="ProductDistribution[]" title="Distribute to Shop"> <i class="fa fa-share fa-lg" > </i> </button><input type="hidden" name="ProductIDforList[]" value="'+Total[i].ProductID+'"> </td></tr>');
              
            }


      $('.ProductDetails').on('click',function(e)
      {
        e.preventDefault();
        $('#Product_Title').empty();
        $('#modalproductdetail').empty();
        var index=$('[name="ProductDetails[]"]').index(this);
        var ProductID=$('input[name="ProductIDforList[]"]').eq(index).val();

        $.get('/Product/Details/ShopID/' +ProductID, function(data) {

            var Product = JSON.parse(data.Product);
            var CategoryName=JSON.parse(data.CategoryName);
            var VendorName=JSON.parse(data.VendorName);

            $('#Product_Title').append(Product.ProductName );

           document.getElementById('modalproductdetail').innerHTML = '<tr><td>ProductID</td><td>' + Product.ProductID + '</td></tr><tr><td>Category</td><td>' + CategoryName + '</td></tr><tr><td>Vendor</td><td>' + VendorName + '</td></tr><tr><td>Quantity</td><td>' + Product.Qty + '</td></tr><tr><td>SalePrice</td><td>' + Product.SalePrice + '</td></tr><tr><td>CostPrice</td><td>' + Product.CostPrice + '</td></tr><tr id="PreferredPriceRow"><td>Preferred Price</td><td>' + Product.PreferredPrice + '</td></tr><tr id="ImageRow"><td>Image</td><td><img src="/uploads/image/product/' + Product.ProductImg + '" width=50 height=50></td></tr>';

            if(Product.ProductImg==null || Product.ProductImg=="" || Product.ProductImg=="Nothing"|| l[0].ProductImg=="No Image")
                $('#ImageRow').hide();

            if(Product.PreferredPrice==null||Product.PreferredPrice=="")
                $('#PreferredPriceRow').hide();
            
            $('#ProductDetailsModal').modal('show');
        });
     


      });


      $('.ProductDistribution').on('click',function()

      {

        var index=$('[name="ProductDistribution[]"]').index(this);
        var ProductID=$('input[name="ProductIDforList[]"]').eq(index).val();

        ProductDistribution(ProductID);



      });


      $('.ProductEdit').on('click',function(e)
      {
        e.preventDefault();
        var index=$('[name="ProductEdit[]"]').index(this);
        var ProductID=$('input[name="ProductIDforList[]"]').eq(index).val();
        ProductEdit(ProductID);

      });


    });

  }
});


function ProductEdit(ProductID)
{

  $.get('/Product/Edit/'+ProductID,function(data)
  {

    //$('#EditBody').empty();

    var Category=JSON.parse(data.CategoryList);
    var Vendor  =JSON.parse(data.VendorList);
    var Product =JSON.parse(data.Product);
    if(Product.ProductDescription==null)
      Product.ProductDescription="";
    var Tax     =JSON.parse(data.TaxList);
    //alert(Category[0].CategoryName);
    //alert(Product.ProductName);    
    $('.EditHeader').empty();
    $('.EditHeader').append('<h3 class="box-title text-center">'+Product.ProductName+'</h3>');
    $('#ProductNameEdit').val(Product.ProductName);
    $('#ProductDescriptionEdit').val(Product.ProductDescription);
    $('#CategoryIDEdit').val(Product.CategoryID);
    $('#VendorIDEdit').val(Product.VendorID);
    $('#QtyEdit').val(Product.Qty);
    $('#MinQtyLevelEdit').val(Product.MinQtyLevel);
    $('#UnitEdit').val(Product.Unit);
    $('#CostPriceEdit').val(Product.CostPrice);
    $('#SalePriceEdit').val(Product.SalePrice);
    $('#PreferredPriceEdit').val(Product.PreferredPrice);
    $('#ProductIDEdit').val(ProductID);
    
    //$('.EditHeader').append('<h3>'+Product.ProductName+'</h3>');



  });

  $('#ProductEditModal').modal('show');
}


function ProductDetails(ProductID)
{


    $.get('/Product/Details/ShopID/' +ProductID, function(data) {

      var Product = JSON.parse(data.Product);
      var CategoryName=JSON.parse(data.CategoryName);
      var VendorName=JSON.parse(data.VendorName);

      $('#Product_Title').append(Product.ProductName );

      document.getElementById('modalproductdetail').innerHTML = '<tr><td>ProductID</td><td>' + Product.ProductID + '</td></tr><tr><td>Category</td><td>' + CategoryName + '</td></tr><tr><td>Vendor</td><td>' + VendorName + '</td></tr><tr><td>Quantity</td><td>' + Product.Qty + '</td></tr><tr><td>SalePrice</td><td>' + Product.SalePrice + '</td></tr><tr><td>CostPrice</td><td>' + Product.CostPrice + '</td></tr><tr id="PreferredPriceRow"><td>Preferred Price</td><td>' + Product.PreferredPrice + '</td></tr><tr id="ImageRow"><td>Image</td><td><img src="/uploads/image/product/' + Product.ProductImg + '" width=50 height=50></td></tr>';

      if(Product.ProductImg==null || Product.ProductImg=="" || Product.ProductImg=="Nothing"|| l[0].ProductImg=="No Image")
      $('#ImageRow').hide();

      if(Product.PreferredPrice==null||Product.PreferredPrice=="")
      $('#PreferredPriceRow').hide();

      $('#ProductDetailsModal').modal('show');
    });





}


function ProductDistribution(ProductID)
{

   $.get('/Product/Distribute/Edit/'+ProductID,function(data)
        {
          var Product=JSON.parse(data.pr);
          var quantity=JSON.parse(data.quantity);
          var quantityintheinventory=JSON.parse(data.quantityintheinventory);
          var identity=JSON.parse(data.identity);
          var ShopName=JSON.parse(data.shopname);
          var QuantityBeforeDistribution=JSON.parse(data.tp);

          
          //var Sho=JSON.parse(data.shopname);

          $('#ProductDistributionBody').empty();
          $('#ProductDistributionHeader').empty();
           

          $('#ProductDistributionHeader').append('<h1>'+Product.ProductName+'</h1><h4>Inventory Quantity: <div id="InventoryQuantity">'+quantityintheinventory+'</div> </h4>');          
          
          for(i=0;i<ShopName.length;i++)
          {


            $('#ProductDistributionBody').append('<tr><td><input type="hidden" name="Identity[]" class="Identity" value="'+identity[i]+'">'+ShopName[i]+'</td><td><input type="hidden" value="'+quantity[i]+'" name="QuantityOriginal[]" class="QuantityOriginal"><input type="number" value="'+quantity[i]+'" name="Quantity[]" class="Quantity form-control"> <input type="hidden" value="'+quantityintheinventory+'" id="InvenQuantity"></td></tr>');

          }

          


          $('.Quantity').on('click keyup',function(e)

          {

              e.preventDefault();

              var TotalOriginal=0;
              var TotalCurrent=0;
              for(i=0;i<ShopName.length;i++)
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


          });

          $('#FormforDistribution').on('submit',function(e)
          {
             e.preventDefault();
             //$('#FormforDistribution').

             $("#ProductDistributionBody").find(":input").clone().appendTo("#DistributeFormBody");

            $('#DistributeFormBody').append('<input type="hidden" name="ProductPreviousQuantity" value="'+QuantityBeforeDistribution+'">'); 
            $('#DistributeFormBody').append('<input type="hidden" name="ProductIDDistribute" value="'+Product.ProductID+'">'); 

             $('#DistributeForm').submit();   


          });


          
          
          //$('#ProductDistributionHeader').empty();
          //$('#ProductDistributionHeader').appned('<label class="label label-success label-lg" > '+Product.ProductName+' </label> Inventory Quantity :<div id="InventoryQuantity">'+quantityintheinventory+'   ');

          //alert(Product.ProductName);


        });

        //alert(ProductID);

        $('#ProductDistributionModal').modal('show');

}

    $('.ButtonBack').on('click',function(e)
    {

      e.preventDefault();
      $('#ProductEditModal').modal('hide');

    });

    $('#ProductDetailsBar').on('click',function(e)
    {

      e.preventDefault();
      var ID=$('#ProductIDEdit').val();
      $('#Product_Title').empty();
      $('#modalproductdetail').empty();
      
      ProductDetails(ID);

      



    });

    $('.pagi').delegate('.pagination a','click',function(event){


      $('li').removeClass('active');
      $(this).parent('li').addClass('active');

      event.preventDefault();
      var pagiurl = $(this).attr('href');
      //alert(pagiurl);

       //location.hash = 2;

             //window.history.pushState("", "",pagiurl);
      //alert(pagiurl);
      $.ajax({
        url: pagiurl,
        data:"",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:"GET",
        dataType: "json",
        success: function(data) {



        $('.Pager').empty();
        $('#ProductBody').empty();
        //alert("I am Jakir");
        var Total=JSON.parse(data.product);

        var Length=Total.per_page;
        //alert(Length);
              for(i=0;i<Length;i++)
              {

                  if(Total.data[i].InactiveProduct==0)
                  {
                    var check='<strong class="label label-primary">Active</strong>';       
                  }

                  if(Total.data[i].InactiveProduct==1)
                  {
                    var check='<strong class="label label-danger">InActive</strong>';       
                  }
                var Profit=Total.data[i].SalePrice-Total.data[i].CostPrice;
                $('#ProductList').append('<tr><td>'+Total.data[i].ProductID+'</td><td>'+Total.data[i].CategoryName+'</td><td>'+Total.data[i].VendorName+'</td><td>'+Total.data[i].ProductName+'</td><td>'+Total.data[i].CostPrice+'</td><td>'+Total.data[i].SalePrice+'</td><td>'+Profit+'</td><td>'+Total.data[i].Qty+'</td><td>'+check+'</td><td><td> <a href="/Product/Details/'+Total.data[i].ProductID+'" class="btn btn-info btn-flat" title="Details"> <i class="fa fa-info fa-lg"></i> </a><a href="/Product/Edit/'+Total.data[i].ProductID+'" class="btn bg-orange btn-flat" title="Edit"> <i class="fa fa-pencil-square-o fa-lg"></i> </a><a href="/Product/Delete/'+Total.data[i].ProductID+'" id="DeleteBtn" class="btn btn-danger btn-flat" title="Delete"> <i class="fa fa-trash fa-lg"> </i> </a><a href="/Product/Distribute/Edit/'+Total.data[i].ProductID+'" class="btn bg-maroon btn-flat" title="Distribute to Shop"> <i class="fa fa-share fa-lg" > </i> </a> </td></td></tr>');
              }
        
        }
      });
    });

    });

    $(".btn-danger").on('click', function(e){
      e.preventDefault();
      var href = this.href;

      alertify.confirm("Are You Sure?",function (e) {
        if (e) {
          window.location.href = href;
        }
      });
    });
  </script>


  



         <!-- =================== Product Edit Modal ===================-->
      <div class="modal" id="ProductEditModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title text-center">
                <p class="label label-success">Product Edit</p>
              </h1>
              <div class="row EditHeader">               
              </div>
              
            </div>

            <div class="modal-body">
              <form id="FormforEdit" class="form-horizontal">
                <input type="hidden" name="ProductIDEdit" id="ProductIDEdit" value="0">
                <div class="form-group">
                  <label for="ProductName" class="col-sm-2 control-label">ProductName :</label>
                  <div class="col-sm-4">
                    <input name="ProductName" type="text" class="form-control" id="ProductNameEdit" placeholder="ProductName" value="">
                  </div>

                  <label for="ProductDescription" class="col-sm-2 control-label">Description :</label>
                  <div class="col-sm-4">
                    <input name="ProductDescription" type="text" class="form-control" id="ProductDescriptionEdit" placeholder="ProductDescription" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="CategoryID" class="col-sm-2 control-label">Category :</label>
                  <div class="col-sm-4">
                    <select name="CategoryID" class="form-control" id="CategoryIDEdit">
                    @foreach($CategoryList as $data)             
                    <option value="{{$data->CategoryID}}">{{$data->CategoryName}}</option>
                    @endforeach 
                    </select>
                  </div>
                  <label for="VendorID" class="col-sm-2 control-label">Vendor :</label>
                  <div class="col-sm-4">
                    <select name="VendorID" class="form-control" id="VendorIDEdit">
                    @foreach($VendorList as $data)              
                    <option value="{{$data->VendorID}}">{{$data->VendorName}}</option>
                    @endforeach
                    </select>
                  </div>              
                </div>

                <div class="form-group">
                  <label for="Qty" class="col-sm-2 control-label">Qty :</label>
                  <div class="col-sm-2">
                    <input name="Qty" type="number" class="form-control" step=".0001" id="QtyEdit" placeholder="Qty" value="">
                  </div>

                  <label for="MinQtyLevel" class="col-sm-2 control-label">MinQtyLevel :</label>
                  <div class="col-sm-2">
                    <input name="MinQtyLevel" type="number" step=".0001" class="form-control" id="MinQtyLevelEdit" placeholder="MinQtyLevel" value="">
                  </div>
                  <label for="Unit" class="col-sm-2 control-label">Unit :</label>
                  <div class="col-sm-2">
                    <input name="Unit" type="text" class="form-control" id="UnitEdit" placeholder="Unit" value="">
                  </div>           
                </div>

                <div class="form-group">
                  <label for="CostPrice" class="col-sm-2 control-label">CostPrice :</label>
                  <div class="col-sm-2">
                    <input name="CostPrice" type="number" step=".0001" class="form-control" id="CostPriceEdit" placeholder="CostPrice" value="">
                  </div>

                  <label for="SalePrice" class="col-sm-2 control-label">SalePrice :</label>
                  <div class="col-sm-2">
                    <div class="input-group">
                      <input name="SalePrice" type="number" step=".0001" class="form-control" id="SalePriceEdit" placeholder="SalePrice" value="">
                      <span class="input-group-addon bg-navy" id="ProfitParcent" ><strong>0 %</strong></span>
                    </div>
                  </div>

                  <label for="PreferredPrice" class="col-sm-2 control-label">Pref.Price :</label>
                  <div class="col-sm-2">
                    <input name="PreferredPrice" type="number" step=".0001" class="form-control" id="PreferredPriceEdit" placeholder="PreferredPrice" value="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="TaxCode" class="col-sm-2 control-label">TaxCode :</label>
                  <div class="col-sm-2">                
                    <select name="TaxCode" class="form-control" id="TaxCodeEdit"> 
                      @foreach ($TaxList as $Tax)         
                        <option value="{{ $Tax->TaxCodeID }}">{{ $Tax->TaxCode }}</option> 
                      @endforeach              
                    </select>
                  </div>
                  <label for="ProductImg" class="col-sm-2 control-label">Image :</label>
                  <div class="col-sm-6">
                    <div id="PrImg">
                      <input name="ProductImg" type="file" class="form-control" id="ProductImg" placeholder="ProductImg">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button  class="btn btn-primary btn-flat ButtonBack" title="Back to List"><i class="fa fa-arrow-left"></i> Back</button>

                    <button  title="View Details" id="ProductDetailsBar" class="btn btn-info btn-flat ProductDetails"> Details</button>
                    <input name="submit" type="submit" class="btn btn-success btn-flat" value="Update">
                    <button type="button" title="Reset to default" class="btn btn-flat bg-maroon">Reset</button>           
                  </div>
                </div>
              </form>
            </div>

            <div class="modal-footer"> 
              <button  class="btn btn-danger btn-flat " type="button " data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>

       <!-- =================== Product Details Modal ===================-->
      <div class="modal" id="ProductDetailsModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title text-center">
                <p class="label label-success">Product Details</p>
              </h1>
            </div>

            <div class="modal-body">     
              <div class="content">
                <div class="row">

                <h3 class="box-title text-center" id="Product_Title"></h3>
                  
                </div>

                <div class="row">

                  <table  class="table table-striped table-bordered" width="100%" id="modalproductdetail">
              

                  </table>
                  
                </div>
              </div>
            </div>

            <div class="modal-footer" "> 
              <button  class="btn btn-danger btn-flat " type="button " data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>

      <!-- =================== Product Distribution Modal ===================-->
      <div class="modal" id="ProductDistributionModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title text-center">
                <p class="label label-success">Product Distribution</p>
              </h1>
            </div>

            <div class="modal-body">            
              <section class="content">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title" id="ProductDistributionHeader">
                    </h3>         
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <form id="FormforDistribution">
                      <table id="ShopList" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>ShopName</th>
                            <th>Quantity</th>
                          </tr>
                        </thead>

                        <tbody id="ProductDistributionBody">
                        </tbody>
                      </table>
                      <button type="submit" name="submit" class="btn btn-flat bg-maroon"><i class="fa fa-share"></i> Update Distribution</button>
                    </form>
                  </div>
                </div>
              </section>             
            </div>
            <div class="modal-footer" "> 
              <button  class="btn btn-danger btn-flat " type="button " data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
      <script>

      
        
      </script>     

  @endsection


       