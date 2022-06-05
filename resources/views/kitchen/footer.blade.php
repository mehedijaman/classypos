    <!-- ======================== Control Sidebar ================================= -->
    <?php
    if(session()->has('KitchenID'))
    {
        $KitchenID    = session()->get('KitchenID');
        $KitchenName  = session()->get('KitchenName');

    }
    ?>

    <aside class="control-sidebar control-sidebar-light " style="position: fixed; max-height: 100%; overflow: auto; padding-bottom: 50px;">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-theme-demo-options-tab" data-toggle="tab"><i class="fa fa-search"></i></a></li>
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <!-- <div class="tab-pane" id="control-sidebar-home-tab">

          </div>

          <div id="control-sidebar-theme-demo-options-tab" class="tab-pane active">
      
          </div> -->
          <!-- /.tab-pane -->

          <!-- Settings tab content -->
          <!-- <div class="tab-pane" id="control-sidebar-settings-tab">    

          </div> -->
          <!-- /.tab-pane -->
        </div>
    </aside>
    
    <div class="control-sidebar-bg" style="position: fixed; height: auto;"></div>
  </div>
  <!--============================= /wrapper ============================-->


    <input type="hidden" id="BroadCastKitchen" value="{{$KitchenID}}">

    <!-- Socket.IO client for broadcasting -->
    {{ Html::script('/js/socket.io.js') }}
    {{ Html::script('/js/sweetalert.min.js') }}

    <script>

        // const socket = io('192.168.0.115:8890');
        const socket = io('http://'+window.location.hostname+':8890');

        // socket.on('order-id',function(message)
        // {
        //   alert("I am Zahid Khan");

        // });

        socket.on('order-received', function(message){
            var ClientKitchenID = $('#BroadCastKitchen').val();
            var BroadcastKitchenID = parseInt(message);
            if (ClientKitchenID == BroadcastKitchenID) {
                var audio = new Audio("/sounds/kitchen_alert.wav");
                audio.play();
                swal({
                    title: "New Order!",
                    text: "New order received.",
                    icon: "success",
                    timer: 1000
                });
            }
        });
        socket.on('suborder-id', function(message){

            //alert(message);
            var Str=message.split("-");
            var Kitchen=Str[0];
            Kitchen=parseInt(Kitchen);
            //Kitchen=3;
            //alert("SubOrder ID"+Str[1]);
            var ClientKitchenID = $('#BroadCastKitchen').val();
            if(Kitchen==ClientKitchenID)
            {
              //alert(Kitchen);
               $.get('/Kitchen/SubOrder/New/'+Str[1],function(data)
               {
                  var Products      = JSON.parse(data.Products);
                  var SubOrders     = JSON.parse(data.SubOrders);
                  var TotalProducts = Products.length;
                  var TotalSubOrders= SubOrders.length;
                  var Total=JSON.parse(data.Total);
                  var All=JSON.parse(data.All);
                  var Times=JSON.parse(data.Times);
                  var CounterName=JSON.parse(data.CounterName);
                  var Size= $('[name="ProductList[]"]').length;
                  var DDD=new Date(Times[0].created_at);
                  var Check=0;
                  ProductID=[];
                  Quantity =[];
                  Comments =[];
                  SubOrderProductMappingID=[];
                  for(j=0;j<TotalProducts;j++)
                  {
                    Check=Check+1;
                    ProductID[Check]=Products[j].ProductName;
                    Quantity[Check]=Products[j].Qty;
                    Quantity[Check]=Math.floor(Quantity[Check]);
                    Comments[Check]=Products[j].Notes;
                    SubOrderProductMappingID[Check]=Products[j].SubOrderProductID;
                    var Hour=DDD.getHours();
                    var Minute=DDD.getMinutes();
                    var meridian="AM";
                    Hour=DDD.getHours();
                    if(Hour>12)
                    {
                      Hour=Hour-12;
                      meridian="PM";
                    }
                    if(Minute<10)
                    {
                      Minute="0"+Minute;
                    }

                  }

                  $('#section-kot').append('<input type="hidden" name="DeleteOrder[]" class="DeleteOrder" value="'+SubOrders[0].OrderID+'"><div class="col-xs-3 col-sm-3 col-md-3 col-md-3 SingleSubOrder" name="SingleSubOrder[]" id="'+SubOrders[0].SubOrderID+'" '+
                  '><div class="box box-success box-solid">'+
                  '<div class="box-header text-center" style="padding:3px">'+
                  'Order-<strong>'+SubOrders[0].OrderID+'</strong>, Table-<strong>'+CounterName[0]+'</strong>,<strong> '+Hour+':'+
                  ' '+Minute+' '+meridian+
                  '</strong></div><div class="box-body ProductList" name="ProductList[]" style="padding:1px 0px 0px 1px; margin-top:-35px;">'+
                  ' <br>'+

                  '</div><div class="box-footer" style="padding:0px;"><div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"'+
                  'style="padding: 0px; margin: 0px;"><button type="button" class="btn btn-flat bg-aqua btn-xs btn-block Confirm" name="Confirm[]">'+
                  '<i class="fa fa-check-circle-o"></i> Confirm'+
                  '</button></div><div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin:0px;padding:0px;"><button'+
                  'type="button" class="btn bg-green btn-block Done btn-xs btn-flat" name="Done[]">'+
                  '<i class="fa fa-check"></i> Done'+
                  '</button></div></div></div></div>');

                  for(k=1;k<=Check;k++)
                  {
                    if(Comments[k]!=null)
                      $('[name="ProductList[]"]').eq(Size).append('<div class="SingleItem" name="SingleItem[]" value="11"><input type="hidden" name="ProductIDIndex[]" value="'+SubOrderProductMappingID[k]+'"><br>'+Quantity[k]+' x '+ProductID[k]+'<br><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+ Comments[k]+'</i></div>');
                    else
                      $('[name="ProductList[]"]').eq(Size).append('<div class="SingleItem" name="SingleItem[]" value="11"><input type="hidden" name="ProductIDIndex[]" value="'+SubOrderProductMappingID[k]+'"><br>'+Quantity[k]+' x '+ProductID[k]+'</div>');

                  }
               });


            }

        });

        // Socket event on deleted an entire order.
        socket.on('order-deleted', function(message){
          //alert("Deleted Order Number"+message);
          OrderID=parseInt(message);

          // $.get('/Kitchen/Order/Delete/'+OrderID,function(data)
          // {
            //alert("We are From Ajax Method"+data);
            var Size= $('[name="ProductList[]"]').length;
            for(i=0;i<Size;i++)
            {
              AllOrderID=$('[name="DeleteOrder[]"]').eq(i).val();
              if(OrderID==AllOrderID)
              {
                $('[name="SingleSubOrder[]"]').eq(i).hide();
                var audio = new Audio("/sounds/kitchen_alert.wav");
                audio.play();
                swal({
                    title: "Order Deleted!",
                    text: "Order Canceled.",
                    icon: "success",
                    timer: 1000
                });
                //Row.hide();
              }
              //alert(AllOrderID);

            }

          // });


            //console.log("Order deleted", message)
        });

        // Socket event on deleted an item from a order.
        socket.on('order-item-delete', function(message){
            //alert("Delete a Single Item from Order"+message);
            var Length=SubOrderProductMappingID.length;
            //alert("Total Number Of Products"+Length);
            DeleteID=parseInt(message);
            //alert(MappingID);
            //SubOrderProductMappingID=parseInt(message);
            for(i=0;i<Length;i++)
            {
              AllProductMappingID=$('input[name="ProductIDIndex[]"]').eq(i).val();
              //alert(DeleteID);
              if(DeleteID==AllProductMappingID)
              {
                //alert("Item "+DeleteID+" Will be Deleted ");
                $('[name="SingleItem[]"]').eq(i).hide();
                // SubOrderID=$('[name="SubOrderIDNullCheck[]"]').eq(i).val();
                // alert("SubOrderID is"+SubOrderID);


              }


            }

            //LoadSubOrders();
        });
    </script>