@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!--==================== Content Header (Page header) ====================-->
    <section class="content-header">
      <h1>
        Stock Reports
        <small>See all kind of stock reports</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Stock Report</li>
      </ol>
    </section>
    <!--==================== /Content Header  ====================-->

    <!--==================== Main content ====================-->
    <section class="content">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="box box-primary">
            <div class="box-header"></div>
            <div class="box-body">
            
              <button class="btn btn-primary" data-toggle="modal" data-target="#TotalStockReportModal">Total Stock Report</button>
              <a class="btn btn-primary" id="ShopwiseReport"  data-toggle="modal" data-target="#ShopwiseReportModal">Shopwise Report</a>
              <button class="btn btn-primary" data-toggle="modal" data-target="#MainStockReportModal">Main Stock Report</button>
              <a href="{{URL::to('/Report/Inventory')}}" class="btn btn-primary" id="Reset">Reset</a>
            </div>
          </div>
        </div>
      </div>
      <div class="box box-primary">
        <!--==================== Box header ====================-->
        <div class="box-header">
        </div>
        <!--==================== /.box-header ====================-->

        <!--==================== Box body ====================-->
        <div class="box-body"> 
          <table id="StockReportTable" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="UserListTable_info">
            <thead>
              <tr>
                <th >ID</th>
                <th >Name</th>
                <th >Category</th>
                <th >Vendor</th>
                <th >Qty</th>
                <th >Unit</th>
                <th >Cost</th>
                <th >SubTotalCost</th>
                <th >Sale</th>
                <th >SubTotalSale</th>
                <th >Profit</th>
                <th >MinQty</th>
              </tr>           
            </thead>
            <tfoot>
              @if($inventory ==1)
                <th colspan="4"></th>                
                <th>{{$InventoryReport[0]->TotalQty}}</th>
                <th colspan="2"></th>              
                <th>{{$InventoryReport[0]->TotalCostPrice}}</th>
                <th></th>
                <th>{{$InventoryReport[0]->TotalSalePrice}}</th>
                <th>{{$InventoryReport[0]->TotalProfit}}</th>
                <th></th>
              @endif              

            </tfoot>



            
            <tbody id="StockReportMain">

              @if($inventory==1)

                @foreach($InventoryReport as $data)
                  <tr>
                    <td>{{$data->ProductID}}</td>
                    <td>{{$data->ProductName}}</td>
                    <td>{{$data->CategoryName}}</td>
                    <td>{{$data->VendorName}}</td>
                    <td>{{$data->Qty}}</td>
                    <td>{{$data->Unit}}</td>
                    <td>{{$data->CostPrice}}</td>
                    <td>{{$data->SubTotalCostPrice}}</td>
                    <td>{{$data->SalePrice}}</td>
                    <td>{{$data->SubTotalSalePrice}}</td>
                    <td>{{$data->Profit}}</td>
                    <td>{{$data->MinQtyLevel}}</td>
                  </tr>
                @endforeach

              @endif                                       
            </tbody>                
          </table>    
        </div>    
      </div>     
    </section>
    <!--==================== /Main content ====================-->


    <!-- ===============  Main Stock Report Modal ====================== -->
    <div class="col-md-2 col-md-offset-1">
      <div class="modal" id="MainStockReportModal" role="dialog">
        <div class="modal-dialog">
          <!--=============== Modal content===============-->
          <div class="modal-content">
            <div class="modal-header" id="heading">
              Main Stock Report              
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-title" id="sajid"></div>
            </div>
            <div class="modal-body">            
              <a class="btn btn-primary" id="MainStockTotal" href="Inventory/ReportMainStockTotal"> Total </a>

              <button class="btn btn-primary" id="MainStockDatewise" date-toggle="modal" data-target="#MainStockDatewiseReportModal"> Datewise </button>

              <button class="btn btn-primary" id="MainStockCategorywise" data-toggle="modal" data-target="#MainStockCategorywiseReportModal"> Categorywise </button>
              
              <button class="btn btn-primary" id="MainStockVendorwise" data-toggle="modal" data-target="#MainStockVendorWiseReportModal"> Vendorwise </button>
            </div>

            <div class="modal-footer" style=" margin-top: 0px;" align="center"> 
            <input type="button" class="btn btn-danger btn-lg" value="cancel" data-dismiss="modal">
            </div>
          </div>
          <!--=============== /Modal content===============-->
        </div>          
      </div>
    </div>
    <!-- =============== /Main Stock Report Modal ====================== -->

    <!-- ===============  Main Stock VendorWise Report Modal ====================== -->
    <div class="col-md-2 col-md-offset-1">
      <div class="modal" id="MainStockVendorWiseReportModal" role="dialog">
        <div class="modal-dialog">
          <!--=============== Modal content===============-->
          <div class="modal-content">
            <div class="modal-header text-center" id="heading">
              <h4>VendorWise Stock Report</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-title" id="sajid"></div>
            </div>

            <div class="modal-body">




              <form role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('ReportMainStockVendorwise')}}"> 
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                  <label>Select a Vendor</label>



                  <select id="MainStockReportByVendor" class="form-control" name="MainStockReportByVendor" onchange="window.location=this.value">
                    <option selected disabled>Select a Vendor</option>
                      @foreach($vendor as $data)
                        <option value="ReportMainStockVendorwise/{{$data->VendorID}}">{{$data->VendorName}}</option>
                      @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <input name="submit" type="submit" class="btn btn-primary" value="Search Product" id="MainStockVendorwiseReportButton"> 
                </div>                
              </form>
            </div>

            <div class="modal-footer" style=" margin-top: 0px;" align="center"> 
              <input type="button" class="btn btn-danger btn-lg" value="cancel" data-dismiss="modal">
            </div>

          </div>
          <!--=============== / Modal content===============-->
        </div>          
      </div>
    </div>
    <!-- =============== / Main Stock VendorWise Report Modal ====================== -->



    <!-- ===============  Main Stock CategoryWise Report Modal ====================== -->
    <div class="col-md-2 col-md-offset-1">
      <div class="modal" id="MainStockCategorywiseReportModal" role="dialog">
        <div class="modal-dialog">
          <!--=============== Modal content===============-->
          <div class="modal-content">
            <div class="modal-header text-center" id="heading">
              <h4>CategoryWise Report</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-title" id="sajid"></div>
            </div>

            <div class="modal-body">
              <form role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('ReportMainStockCategorywise')}}"> 
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                  <label>Select a Category</label>

                  <select id="MainStockReportByCategory" class="form-control" name="MainStockReportByCategory" onchange="window.location=this.value">
                    <option selected disabled>Select a Category</option>
                      @foreach($category as $data)

                        <option value="ReportMainStockCategorywise/{{$data->CategoryID}}">{{$data->CategoryName}}</option>

                      @endforeach
                  </select>
                </div>
                 <div class="form-group">
                  <input name="submit" type="submit" class="btn btn-primary" value="Search Product" id="MainStockCategorywiseReportButton"> 
                </div>  
              </form>


            </div>

            <div class="modal-footer" style=" margin-top: 0px;" align="center"> 
              <input type="button" class="btn btn-danger btn-lg" value="cancel" data-dismiss="modal">
            </div>
          </div>
          <!--=============== /Modal content===============-->
        </div>          
      </div>
    </div>
    <!-- =============== / Main StockCategoryWise Report Modal ====================== -->

    <!-- ===============  Main Stock Datewise Report Modal ====================== -->
    <div class="col-md-2 col-md-offset-1">
      <div class="modal" id="MainStockDatewiseReportModal" role="dialog">
        <div class="modal-dialog">
          <!--=============== Modal content===============-->
          <div class="modal-content">
            <div class="modal-header text-center" id="heading">
              <h4>Main Stock Datewise Report</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-title" id="asdsd"></div>
            </div>

            <div class="modal-body">

              <form role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('ReportMainStockDatewise')}}">

                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group">
                  <label for="CategoryID" class=" control-label">From Date :</label>
                  <input type="text" id="datepicker" name="From" class="form-control">
                </div>            

                <div class="form-group">
                  <label for="CategoryID" class=" control-label">To Date :</label>            
                  <input type="text" id="datepicker2" name="To" class="form-control">          
                </div>

                <div class="form-group">            
                  <input name="submit" type="submit" class="btn btn-primary" value="Search Product" id="MainStockDatewiseReportButton">
                </div>

                <div class="modal-footer" style=" margin-top: 0px;" align="center"> 
                  <input type="button" class="btn btn-danger btn-lg" value="cancel" data-dismiss="modal">
                </div>
              </form>
            </div>
          </div>
          <!--=============== /Modal content===============-->
        </div>          
      </div>
    </div>
    <!-- =============== / Main Stock Datewise Report Modal ====================== -->




    <!-- ===============  ShopWise Report Modal ====================== -->
    <div class="col-md-2 col-md-offset-1">
      <div class="modal" id="ShopwiseReportModal" role="dialog">
        <div class="modal-dialog">
          <!--=============== Modal content===============-->
          <div class="modal-content">
            <div class="modal-header text-center" id="heading">

            <h4>ShopWise Stock Report</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-title" id="sajid"></div>
            </div>

            <div class="modal-body">
              <button class="btn btn-primary" data-toggle="modal" data-target="#ShopwiseTotalModal"> Total </button>
              <button class="btn btn-primary" data-toggle="modal" data-target="#ShopwiseDateModal"> Datewise </button>
              <button class="btn btn-primary" data-toggle="modal" data-target="#ShopwiseCategoryModal"> Categorywise </button>
              <button class="btn btn-primary" id="MainStockVendorwise" data-toggle="modal" data-target="#ShopwiseVendorModal"> Vendorwise </button>
            </div>

            <div class="modal-footer" style=" margin-top: 0px;" align="center"> </div>
          </div>
          <!--=============== /Modal content===============-->
        </div>          
      </div>
    </div>
    <!-- =============== /ShopWise Report Modal ====================== -->

    <!-- ===============  ShopWise Total Report Modal ====================== -->
    <div class="col-md-2 col-md-offset-1">
      <div class="modal" id="ShopwiseTotalModal" role="dialog">
        <div class="modal-dialog">
          <!--=============== Modal content===============-->
          <div class="modal-content">
            <div class="modal-header text-center" id="heading">

            <h4>ShopWise Total Stock Report</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-title" id="sajid"></div>
            </div>

            <div class="modal-body">


              <div class="form-group">
                <label>Select a Shop</label> 
                <select id="ShopwiseShopList" class="form-control"  onchange="window.location=this.value">
                  <option selected disabled>Select a Shop</option>
                  @foreach($shop as $data)


                  <option value="Inventory/ReportShopwiseTotal/{{$data->ShopID}}">{{$data->ShopName}}</option>
                  @endforeach                
                </select>
              </div>
              
              <a class="btn btn-success btn-lg" href="ReportShopwiseTotal/{{session()->get('ButtonShopID')}}" id="sad">Submit</a>
            </div>

            <div class="modal-footer" style=" margin-top: 0px;" align="center"> </div>
          </div>
          <!--=============== /Modal content===============-->
        </div>          
      </div>
    </div>
    <!-- =============== /ShopWise Total Report Modal ====================== -->

    <!-- ===============  ShopWise Date Report Modal ====================== -->
    <div class="col-md-2 col-md-offset-1">
      <div class="modal" id="ShopwiseDateModal" role="dialog">
        <div class="modal-dialog">
          <!--=============== Modal content===============-->
          <div class="modal-content">
            <div class="modal-header text-center" id="heading">

            <h4>ShopWise Stock Report</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-title" id="sajid"></div>
            </div>

            <div class="modal-body">
              <div class="form-group">
                <div class="col-md-3">
                  <select id="ShopwiseDateList" class="form-control">
                    <option selected disabled>Select Shop</option>
                    @foreach($shop as $data)
                    <option value="{{$data->ShopID}}">{{$data->ShopName}}</option>
                    @endforeach                
                  </select>
                </div>

                <!-- <label class="control-label col-sm-2" for="email">DateFrom:</label> -->
                <div class="col-md-2">                  
                  <input type="date" class="input-control">
                </div> 
                <!-- <label class="control-label col-sm-2" for="email">DateFrom:</label> -->
                <div class="col-md-2">                  
                  <input type="date" class="input-control">
                </div>              

                           
              </div>
            </div>

            <div class="modal-footer" style=" margin-top: 0px;" align="center"> </div>
          </div>
          <!--=============== /Modal content===============-->
        </div>          
      </div>
    </div>
    <!-- =============== /ShopWise Date Report Modal ====================== -->


    <!-- ===============  ShopWise Category Report Modal ====================== -->
    <div class="col-md-2 col-md-offset-1">
      <div class="modal" id="ShopwiseCategoryModal" role="dialog">
        <div class="modal-dialog">
          <!--=============== Modal content===============-->
          <div class="modal-content">
            <div class="modal-header text-center" id="heading">

            <h4>Shop and Category Wise Stock Report</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-title" id=""></div>
            </div>

            <div class="modal-body">

              <form role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('ReportShopCategorywise')}}">

              <input type="hidden" name="_token" value="{{csrf_token()}}"
              <div class="form-group">
                <div class="col-md-6">
                  <select id="ShopwiseCategoryListShop" class="form-control" name="ShopwiseCategoryListShop">
                  <option selected disabled>Select Shop</option>
                  @foreach($shop as $data)
                  <option value="{{$data->ShopID}}">{{$data->ShopName}}</option>
                  @endforeach                
                  </select>
                </div>

                <div class="col-md-6">
                  <select id="ShopwiseCategoryListCategory" class="form-control" name="ShopwiseCategoryListCategory" onchange="ShopwiseCategoryList();">
                    @foreach($category as $data)
                      <option value="{{$data->CategoryID}}">{{$data->CategoryName}}</option>
                    @endforeach                
                  </select>
                </div>
              
            </div>
                

            <div class="modal-footer" style=" margin-top: 0px;" align="center"><input type="submit" class="btn btn-success btn-lg" value="Submit"><button class="btn btn-danger btn-lg"  data-dismiss="modal">Cancel</button>
            </div>
            </form>

          </div>
          <!--=============== /Modal content===============-->
        </div>          
      </div>
    </div>
    <!-- =============== /ShopWise Category Report Modal ====================== -->

    <!-- ===============  ShopWise Vendor Report Modal ====================== -->
    <div class="col-md-2 col-md-offset-1">
      <div class="modal" id="ShopwiseVendorModal" role="dialog">
        <div class="modal-dialog">
          <!--=============== Modal content===============-->
          <div class="modal-content">
            <div class="modal-header text-center" id="heading">

            <h4>Shop and Vendor Wise Stock Report</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-title" id=""></div>
            </div>

            <div class="modal-body">

             <form role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('ReportShopVendorwise')}}">

                <input type="hidden" name="_token" value="{{csrf_token()}}"
                <div class="form-group">
                  <div class="col-md-6">
                    <select id="ShopwiseVendorListShop" class="form-control" name="ShopwiseVendorListShop" >
                      <option selected disabled>Select Shop</option>
                        @foreach($shop as $data)
                          <option value="{{$data->ShopID}}">{{$data->ShopName}}</option>
                        @endforeach                
                    </select>
                  </div>

                  <div class="col-md-6">
                    <select id="ShopwiseVendorListVendor" class="form-control" name="ShopWiseVendorListVendor" onchange="ShopwiseVendorList();">


                    <option selected disabled>Select a Vendor</option>
                      @foreach($vendor as $data)
                        <option value="{{$data->VendorID}}">{{$data->VendorName}}</option>
                      @endforeach                
                    </select>
                  </div>            

                

              
              
            </div>

            <div class="modal-footer" style=" margin-top: 20px;" align="center"><input type="submit" class="btn btn-success btn-lg"><button class="btn btn-danger btn-lg"  data-dismiss="modal">Cancel</button> </div>

            </form>
          </div>
          <!--=============== /Modal content===============-->
        </div>          
      </div>
    </div>
    <!-- =============== /ShopWise Vendors Report Modal ====================== -->

    


    <!-- ===============  Total Stock Report Modal ====================== -->
    <div class="col-md-2 col-md-offset-1">
      <div class="modal" id="TotalStockReportModal" role="dialog">
        <div class="modal-dialog">
          <!--=============== Modal content===============-->
          <div class="modal-content">
            <div class="modal-header" id="heading">
              Total Stock Report
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-title" id="sajid"></div>
            </div>

            <div class="modal-body">
              <a class="btn btn-primary" href="{{URL::to('/Report/Inventory/TotalStock/ReportTotalStockTotal')}}">Total</a>
              <button class="btn btn-primary">Datewise</button>
              <button class="btn btn-primary" data-toggle="modal" data-target="#TotalCategoryModal">Categorywise</button>
              <button class="btn btn-primary" data-toggle="modal" data-target="#TotalVendorModal">Vendorwise</button>
            </div>

            <div class="modal-footer" style=" margin-top: 0px;" align="center"> 
            </div>
          </div>
          <!--=============== /Modal content===============-->
        </div>          
      </div>
    </div>
    <!-- =============== /Total Stock Report Modal ====================== -->





    <!-- ===============  Total Category Report Modal ====================== -->
    <div class="col-md-2 col-md-offset-1">
      <div class="modal" id="TotalCategoryModal" role="dialog">
        <div class="modal-dialog">
          <!--=============== Modal content===============-->
          <div class="modal-content">
            <div class="modal-header text-center" id="heading">

            <h4>Category Wise Stock Report</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-title" id=""></div>
            </div>

            <div class="modal-body">

             <form role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('ReportShopVendorwise')}}">

                <input type="hidden" name="_token" value="{{csrf_token()}}"
                <div class="form-group">
                 

                  <div class="col-md-6">
                    <select class="form-control" onchange="window.location=this.value">


                    <option selected disabled>Select a Category</option>
                      @foreach($category as $data)

                      
                        <option value="Report/Inventory/TotalStock/Catergorywise/{{$data->CategoryID}}">{{$data->CategoryName}}</option>
                        
                      @endforeach                
                    </select>
                  </div>            

                

              
              
            </div>

            <div class="modal-footer" style=" margin-top: 20px;" align="center"><input type="submit" class="btn btn-success btn-lg"><button class="btn btn-danger btn-lg"  data-dismiss="modal">Cancel</button> </div>

            </form>
          </div>
          <!--=============== /Modal content===============-->
        </div>          
      </div>
    </div>
    <!-- =============== /Total Category Report Modal ====================== -->




    <!-- ===============  Total Vendor Report Modal ====================== -->
    <div class="col-md-2 col-md-offset-1">
      <div class="modal" id="TotalVendorModal" role="dialog">
        <div class="modal-dialog">
          <!--=============== Modal content===============-->
          <div class="modal-content">
            <div class="modal-header text-center" id="heading">

            <h4>Vendor Wise Stock Report</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-title" id=""></div>
            </div>

            <div class="modal-body">

             <form role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('ReportShopVendorwise')}}">

                <input type="hidden" name="_token" value="{{csrf_token()}}"
                <div class="form-group">
                 

                  <div class="col-md-6">
                    <select class="form-control" onchange="window.location=this.value">


                    <option selected disabled>Select a Vendor</option>
                      @foreach($vendor as $data)


                        <option value="Inventory/ReportTotalStockVendorwise/{{$data->VendorID}}">{{$data->VendorName}}</option>
                        
                      @endforeach                
                    </select>
                  </div>            

                

              
              
            </div>

            <div class="modal-footer" style=" margin-top: 20px;" align="center"><input type="submit" class="btn btn-success btn-lg"><button class="btn btn-danger btn-lg"  data-dismiss="modal">Cancel</button> </div>

            </form>
          </div>
          <!--=============== /Modal content===============-->
        </div>          
      </div>
    </div>
    <!-- =============== /Total Vendors Report Modal ====================== -->
  </div>
@endsection



<script>  
  $(document).ready(function(){
      $('#StockReportTable').DataTable();


        });
</script>


<script>
  $( function()
   {
    $( "#datepicker" ).datepicker();
    $( "#datepicker2" ).datepicker();
  } );
</script>

<script>
  function ShopwiseCategoryList()
  {


    $('#Reset').click();

    var ShopID=$('#ShopwiseCategoryListShop').val();


    var CategoryID=$('#ShopwiseCategoryListCategory').val();



    window.location="Inventory/ReportShopCategorywise/"+ShopID+'/'+CategoryID;

  }


  function ShopwiseVendorList()
  {

    var ShopID=$('#ShopwiseVendorListShop').val();

    var VendorID=$('#ShopwiseVendorListVendor').val();

    window.location="Inventory/ReportShopVendorwise/"+ShopID+'/'+VendorID;
  }
</script>


<script>
  
  $(document).ready(function()
  { 
    /* Main Stock Total Report */




    
    /* Main Stock Categorywise Report */
    

    



    $('#MainStockDatewise').click(function()
    {
      $('#MainStockDatewiseReportModal').modal('show');
    });



    $('#MainStockDatewiseReportButton').on('click',function()     
    {

      var x=$("#datepicker").val();
      var y=$("#datepicker2").val();

      $.get('ReportMainStockDatewise/'+new Date(x).toString()+'/'+new Date(y).toString(),function(data)
      {


        var products = JSON.parse(data);

        alert(products[0].ProductName);
        var i;       
        var total=products.length;

        
        for(i=0;i<total;i++)
        {
          $('#StockReportMain').append('<tr><td>'+products[i].ProductID+'</td><td>'+products[i].ProductName+'</td><td>'+products[i].CategoryName+'</td><td>'+products[i].VendorName+'</td><td>'+products[i].Qty+'</td><td>'+products[i].Unit+'</td><td>'+products[i].CostPrice+'</td><td>'+products[i].SubTotalCostPrice+'</td><td>'+products[i].SalePrice+'</td><td>'+products[i].SubTotalSalePrice+'</td><td>'+products[i].Profit+'</td><td>'+products[i].MinQtyLevel+'</td></tr>');
        }


          $('#StockReportMainSummary').append('<tr><th colspan="4"></th><th>'+products[0].TotalQty+'</th><th colspan="2"></th><th>'+products[0].TotalCostPrice+'</th><th></th><th>'+products[0].TotalSalePrice+'</th><th>'+products[0].TotalProfit+'</th><th></th></th>');    
         
          
               
        
        $('#MainStockDatewiseReportModal').modal('hide');
        $('#MainStockReportModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove(); 
      });   
    });
  });
</script>