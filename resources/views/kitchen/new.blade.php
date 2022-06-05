@extends('layouts.kitchen')
@section('content')
  <script>
    var ShopID    = 1;
    var KitchenID = 1;
    var DateFrom  = 0;
    var DateTo    = 0;
    var Option    = 1;

    $(document).ready(function(e)
    {
      LoadSubOrders();
    });

    function LoadSubOrders()
    {

      $.get('/Kitchen/KOT/New/'+ShopID +'/'+ KitchenID +'/'+ DateFrom +'/'+ DateTo+'/'+Option,     function(data)
      {

        //e.preventDefault();
        // alert(data);
        var Products      = JSON.parse(data.Products);
        //alert(Products[0].ProductName);
        var SubOrders     = JSON.parse(data.SubOrders);
        var TotalProducts = Products.length;
        var TotalSubOrders= SubOrders.length;
        var Total=JSON.parse(data.Total);
        var All=JSON.parse(data.All);
        var Times=JSON.parse(data.Times);
        var CounterName=JSON.parse(data.CounterName);
        //alert(CounterName[1]);
        // alert(Total);
        $('#section-kot').empty();
        for(i=0;i<TotalSubOrders;i++)
        {

          var DDD=new Date(Times[i].created_at);
          var Check=0;
          ProductID=[];
          Quantity =[];
          Comments =[];
          SubOrderProductMappingID=[];
          SubOrderIDforEachProduct=[];
          for(j=0;j<TotalProducts;j++)
          {
            if(SubOrders[i].SubOrderID==Products[j].SubOrderID)
            {
              Check=Check+1;
              ProductID[Check]=Products[j].ProductName;
              Quantity[Check]=Products[j].Qty;
              Quantity[Check]=Math.floor(Quantity[Check]);
              Comments[Check]=Products[j].Notes;
              SubOrderProductMappingID[Check]=Products[j].SubOrderProductID;
              SubOrderIDforEachProduct[Check]=Products[j].SubOrderID;

              
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
          }



          if(SubOrders[i].IsConfirmed != 0)
          {
            $('#section-kot').append('<input type="hidden" name="DeleteOrder[]" class="DeleteOrder" value="'+SubOrders[0].OrderID+'"><div class="col-xs-3 col-sm-3 col-md-3 col-md-3 SingleSubOrder" name="SingleSubOrder[]" id="'+SubOrders[i].SubOrderID+'" '+
              '><div class="box box-default box-solid">'+
              '<div class="box-header text-center" style="padding:3px">'+
              'Order-<strong>'+SubOrders[i].OrderID+'</strong>, Table-<strong>'+CounterName[i]+'</strong>,<strong> '+Hour+':'+
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
              $('[name="ProductList[]"]').eq(i).append('<br>'+Quantity[k]+' x ',ProductID[k]+'<br><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+  Comments[k]+'</i>');
            else
              $('[name="ProductList[]"]').eq(i).append('<br>'+Quantity[k]+' x ',ProductID[k]);

            }
          }

          if(SubOrders[i].IsConfirmed == 0)
          {

            $('#section-kot').append('<input type="hidden" name="DeleteOrder[]" class="DeleteOrder" value="'+SubOrders[0].OrderID+'"><div class="col-xs-3 col-sm-3 col-md-3 col-md-3 SingleSubOrder" name="SingleSubOrder[]" id="'+SubOrders[i].SubOrderID+'" '+
              '><div class="box box-success box-solid">'+
              '<div class="box-header text-center" style="padding:3px">'+
              'Order-<strong>'+SubOrders[i].OrderID+'</strong>, Table-<strong>'+CounterName[i]+'</strong>,<strong> '+Hour+':'+
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
              $('[name="ProductList[]"]').eq(i).append('<div class="SingleItem" name="SingleItem[]" value="11"><input type="hidden" name="ProductIDIndex[]" value="'+SubOrderProductMappingID[k]+'"><br>'+Quantity[k]+' x '+ProductID[k]+'<br><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+ Comments[k]+'</i><br></div>');
            else
              $('[name="ProductList[]"]').eq(i).append('<div class="SingleItem" name="SingleItem[]" value="11"><input type="hidden" name="ProductIDIndex[]" value="'+SubOrderProductMappingID[k]+'"><br>'+Quantity[k]+' x '+ProductID[k]+'<br></div>');

            }
          }


          

          if(SubOrders[i].IsConfirmed==1)
          {
            $('[name="Confirm[]"]').eq(i).hide();
          }
        }



        $('.Done').on('click',function(e)
        {
          var index=$('[name="Done[]"]').index(this);
          var SubOrderID=SubOrders[index].SubOrderID;
          $.get('/Kitchen/KOT/Completed/'+SubOrderID,function(data)
          {
            //alert(data);

          });
          var Row=$(this).closest('.SingleSubOrder');
          Row.hide();
        });

        $('.Confirm').on('click',function(e)
        {
          var index=$('[name="Confirm[]"]').index(this);
          $('#IndexCheckforConfirm').val(index);          
          var SubOrderID=SubOrders[index].SubOrderID;
          $.get('/Kitchen/KOT/Confirmed/'+SubOrderID,function(data)
          {
            var Index=$('#IndexCheckforConfirm').val();
            $('[name="Confirm[]"]').eq(Index).hide();
            var Row=$('[name="Confirm[]"]').eq(Index).closest('.box');
            Row.removeClass('box-success');
            Row.addClass('box-default');
          }); 
        });        
      });
    };   
  </script>

  <input type="hidden" id="IndexCheckforConfirm" value="0">
  <section class="content" style="padding:0px;" id="section-kot"></section>


@endsection