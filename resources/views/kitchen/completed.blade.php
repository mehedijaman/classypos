@extends('layouts.kitchen')
@section('content')
  <script>
    var ShopID = 1;
    var KitchenID = 1;
    var DateFrom = 0;
    var DateTo = 0;
    var Option = 3;

    $(document).ready(function(e)
    {
       $.get('/Kitchen/KOT/New/'+ShopID +'/'+ KitchenID +'/'+ DateFrom +'/'+ DateTo+'/'+Option,     function(data)
      {
        //e.preventDefault();
        var Products      = JSON.parse(data.Products);
        //alert(Products[0].ProductName);
        var SubOrders     = JSON.parse(data.SubOrders);
        var TotalProducts = Products.length;
        var TotalSubOrders= SubOrders.length;
        var Total=JSON.parse(data.Total);
        var All=JSON.parse(data.All);
        var Times=JSON.parse(data.Times);
        var CounterName=JSON.parse(data.CounterName);
        var OrderIDList=JSON.parse(data.ListofOrderID);
        $('#section-kot').empty();
        for(i=0;i<TotalSubOrders;i++)
        {
          var Check=0;
          ProductID=[];
          Quantity =[];
          Comments =[];

          for(j=0;j<TotalProducts;j++)
          {
            if(SubOrders[i].SubOrderID==Products[j].SubOrderID)
            {
              Check=Check+1;
              ProductID[Check]=Products[j].ProductName;
              Quantity[Check]=Products[j].Qty;
              Quantity[Check]=Math.floor(Quantity[Check]);
              Comments[Check]=Products[j].Notes;
              var DDD=new Date(Times[i].created_at);
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

              

              //ProductID=Products[j].ProductID;
              //Qty      =Products[j].Qty;
              
            }
          }

          $('#section-kot').append('<div class="col-xs-4 col-sm-3 col-md-3 col-md-3 SingleSubOrder"'+
              '><div class="box box-default box-solid" style="padding:0px;">'+
              '<div class="box-header text-center"><strong>'+
              'Order-'+OrderIDList[i]+', Table-'+CounterName[i]+', '+Hour+': '+
              ' '+Minute+' '+meridian+'  <div class="box-tools pull-right">'+
              '<button type="button" class="btn btn-box-tool"><i class="fa fa-times"></i></'+    'button>'+
              '</strong></div>'+
              '</div><div class="box-body ProductList" name="ProductList[]" style="padding:1px 0px 0px 1px; margin-top:-35px;">'+
              ' <br>'+

              '</div><div class="box-footer"><div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"'+
              'style="padding: 0px; margin: 0px;"><button type="button" class="btn bg-aqua btn-block Undo" name="Undo[]">'+
              '<i class="fa fa-check-circle-o"></i>Undo'+
              '</button></div></div></div></div></div>');

          for(k=1;k<=Check;k++)
          {
            if(Comments[k]!=null)
              $('[name="ProductList[]"]').eq(i).append('<br>'+Quantity[k]+' x ',ProductID[k]+'<br><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+  Comments[k]+'</i>');
            else
              $('[name="ProductList[]"]').eq(i).append('<br>'+Quantity[k]+' x ',ProductID[k]);
            //$('[name="ProductList[]"]').eq(i).append('<br>'+Quantity[k]+'X',ProductID[k]);

          }

          if(SubOrders[i].IsConfirmed==1)
          {
            $('[name="Confirm[]"]').eq(i).hide();
          }

          
          //alert(index);
          


        }



        $('.Undo').on('click',function(e)
        {
          var index=$('[name="Undo[]"]').index(this);
          var SubOrderID=SubOrders[index].SubOrderID;
          $.get('/Kitchen/KOT/Undo/'+SubOrderID,function(data)
          {
            //alert(data);

          });
          var Row=$(this).closest('.SingleSubOrder');
          Row.hide();
        });

        
        
      });


    });

    
  </script>

  <section class="content" style="padding:0px;" id="section-kot"></section>


@endsection