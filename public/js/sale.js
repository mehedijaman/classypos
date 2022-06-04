$(document).ready(function(e) 
{

    //var request=indexedDB.open("FahadRezwan",1);

    
    //var saleman=new Array();
    /*const customerData = [
        { ssn: "444-44-4444", name: "Bill", age: 35, email: "bill@company.com" },
        { ssn: "555-55-5555", name: "Donna", age: 32, email: "donna@home.org" }
    ];
    
    const dbName = "the_name";

var request = indexedDB.open(dbName, 2);

request.onerror = function(event) {
  // Handle errors.
};
request.onupgradeneeded = function(event) {
  var db = event.target.result;

 
  var objectStore = db.createObjectStore("customers", { keyPath: "ssn" });

  
  objectStore.createIndex("name", "name", { unique: false });
  objectStore.createIndex("email", "email", { unique: true });
  objectStore.transaction.oncomplete = function(event) {
    var customerObjectStore = db.transaction("customers", "readwrite").objectStore("customers");
    customerData.forEach(function(customer) {
      customerObjectStore.add(customer);
    });
  };
};

    

    function PrintRefund()
    {


    }*/

    
    $('#PrintKOT').on('click',function(e)
    {
        e.preventDefault();
        var contents = document.getElementById("PrintAnOrder").innerHTML;
        var frame1 = document.createElement('iframe');
        frame1.name = "frame1";
        //frame1.style.position = "absolute";
        //frame1.style.top = "-1000000px";
        document.body.appendChild(frame1);
        var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
        frameDoc.document.open();
        //frameDoc.document.write('<html><head><title>DIV Contents</title>');
        //frameDoc.document.write('</head><body>');
        frameDoc.document.write(contents);
        //frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        document.body.removeChild(frame1);
        }, 500);

        var Booking=$('#BookingTest').val();
        var ID=$('#KOTPrintOrderID').val();
        var ParcelTest=$('#KOTPrintParcelTest').val();
        return false;   

    });

    $('#PrintKOTRecipt').on('click',function(e)
    {
        e.preventDefault();
        var contents = document.getElementById("SalesPanelKOTRecipt").innerHTML;
        var frame1 = document.createElement('iframe');
        frame1.name = "frame1";
        //frame1.style.position = "absolute";
        //frame1.style.top = "-1000000px";
        document.body.appendChild(frame1);
        var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
        frameDoc.document.open();
        //frameDoc.document.write('<html><head><title>DIV Contents</title>');
        //frameDoc.document.write('</head><body>');
        frameDoc.document.write(contents);
        //frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        document.body.removeChild(frame1);
        }, 500);

        var Booking=$('#BookingTest').val();
        var ID=$('#KOTPrintOrderID').val();
        var ParcelTest=$('#KOTPrintParcelTest').val();
        return false;   



    });
    $('#PrintRecipt').on('click',function(e)
    {
        //PrintRecipt();
        e.preventDefault();
        var contents = document.getElementById("SalesPanelRecipt").innerHTML;
        var frame1 = document.createElement('iframe');
        frame1.name = "frame1";
        //frame1.style.position = "absolute";
        //frame1.style.top = "-1000000px";
        document.body.appendChild(frame1);
        var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
        frameDoc.document.open();
        //frameDoc.document.write('<html><head><title>DIV Contents</title>');
        //frameDoc.document.write('</head><body>');
        frameDoc.document.write(contents);
        //frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        document.body.removeChild(frame1);
        }, 500);

        var Booking=$('#BookingTest').val();
        var ID=$('#KOTPrintOrderID').val();
        var ParcelTest=$('#KOTPrintParcelTest').val();
        return false;   

    });

    $('#PrintInvoiceRecipt').on('click',function(e)
    {
        //PrintRecipt();
        e.preventDefault();
        var contents = document.getElementById("SalesPanelInvoiceRecipt").innerHTML;
        var frame1 = document.createElement('iframe');
        frame1.name = "frame1";
        //frame1.style.position = "absolute";
        //frame1.style.top = "-1000000px";
        document.body.appendChild(frame1);
        var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
        frameDoc.document.open();
        //frameDoc.document.write('<html><head><title>DIV Contents</title>');
        //frameDoc.document.write('</head><body>');
        frameDoc.document.write(contents);
        //frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        document.body.removeChild(frame1);
        }, 500);

        var Booking=$('#BookingTest').val();
        var ID=$('#KOTPrintOrderID').val();
        var ParcelTest=$('#KOTPrintParcelTest').val();
        return false;   

    });


    $('#AdvanceInvoicePrint').on('click',function(e)
    {
        //PrintRecipt();
        e.preventDefault();
        var contents = document.getElementById("AdvanceInvoice").innerHTML;
        var frame1 = document.createElement('iframe');
        frame1.name = "frame1";
        //frame1.style.position = "absolute";
        //frame1.style.top = "-1000000px";
        document.body.appendChild(frame1);
        var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
        frameDoc.document.open();
        //frameDoc.document.write('<html><head><title>DIV Contents</title>');
        //frameDoc.document.write('</head><body>');
        frameDoc.document.write(contents);
        //frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        document.body.removeChild(frame1);
        }, 500);

        //var Booking=$('#BookingTest').val();
        //var ID=$('#KOTPrintOrderID').val();
        //var ParcelTest=$('#KOTPrintParcelTest').val();
        return false;   

    });


    $('#RefundPrint').on('click',function(e)
    {
        //PrintRecipt();
        e.preventDefault();
        var contents = document.getElementById("RefundInvoicePrint").innerHTML;
        var frame1 = document.createElement('iframe');
        frame1.name = "frame1";
        //frame1.style.position = "absolute";
        //frame1.style.top = "-1000000px";
        document.body.appendChild(frame1);
        var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
        frameDoc.document.open();
        //frameDoc.document.write('<html><head><title>DIV Contents</title>');
        //frameDoc.document.write('</head><body>');
        frameDoc.document.write(contents);
        //frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        document.body.removeChild(frame1);
        }, 500);
        $('#RefundInvoice').attr('disabled',true);
        return false;   
        

    });

    //Send Order to Kitchen
    $('#OrderPlaceForm').on('submit',function(e){
        //e.preventDefault();
        //alert(cc);
    if(cc==0)
        return false;
    var Order=$('#OrderIDforInvoice').val();
    var OrderID=$('#OrderIDforOrderUpdate').val();
    var Counter=$('#TableIDforOrder').val();
    var Staff=$('#StaffID').val();
    var Guest=$('#GuestCount').val();
    var Notes=$('#NotesforNewOrder').val();
    var Test=$('#ParcelTest').val();
    //alert(Test);
    $('#OrderSpecial').append('<input type="hidden" name="Counter" value="'+Counter+'">');
    $('#OrderSpecial').append('<input type="hidden" name="Staff" value="'+Staff+'">');
    $('#OrderSpecial').append('<input type="hidden" name="Guest" value="'+Guest+'">');
    $('#OrderSpecial').append('<input type="hidden" name="Notes" value="'+Notes+'">');
    $('#OrderSpecial').append('<input type="hidden" name="OrderUpdateID" value="'+OrderID+'">');
    $('#OrderSpecial').append('<input type="hidden" name="ParcelTest" value="'+Test+'">');


    for(i=0;i<cc;i++)
        {
            var Firstquan=parseInt($('input[name="total[]"]').eq(i).val(),10);
            var ID=$('input[name="productid[]"]').eq(i).val();
            var Name=$('input[name="productname[]"]').eq(i).val();
            var Price=$('input[name="Price[]"]').eq(i).val();
            var discount=$('input[name="discount[]"]').eq(i).val();
            var Final=$('input[name="final[]"]').eq(i).val();
            var Shop=$('input[name="Shop[]"]').eq(i).val();
            var Tax=$('input[name="tax[]"]').eq(i).val();
            var TaxValue=$('input[name="taxvalue1[]"]').eq(i).val();              

            if(ID!=0)
            {
                $('#OrderSpecial').append('<input type="hidden" name="total1[]" class="total3" value="'+Firstquan+'">');
                $('#OrderSpecial').append('<input type="hidden" name="productid1[]" class="productid3" value="'+ID+'">');
                $('#OrderSpecial').append('<input type="hidden" name="productname1[]" class="productname" value="'+Name+'">');
                $('#OrderSpecial').append('<input type="hidden" name="Price1[]" class="Price3" value="'+Price+'">');
                $('#OrderSpecial').append('<input type="hidden" name="discount1[]" class="discount3" value="'+discount+'">');
                $('#OrderSpecial').append('<input type="hidden" name="final1[]" class="final3" value="'+Final+'">');
                $('#OrderSpecial').append('<input type="hidden" name="Shop1[]" class="Shop3" value="'+Shop+'">');
                $('#OrderSpecial').append('<input type="hidden" name="tax1[]" class="tax3" value="'+Tax+'">');
                $('#OrderSpecial').append('<input type="hidden" name="taxvalue1[]" class="taxvalue3" value="'+TaxValue+'">');
            }
        }

    $('#add').find(":input").clone().appendTo("#OrderSpecial");

    $("#myform").find(":input").clone().appendTo("#OrderSpecial");
    $('#OrderSpecial').hide();

    $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
    })
    e.preventDefault(e);

        $.ajax({

        type:"POST",
        url:'/registerFahad',
        data:$(this).serialize(),
        success: function(data)
        {
            var ParcelTest=$('#ParcelTest').val();
            $('#KOTPrintParcelTest').val(ParcelTest);
            var CounterTest=$('#CounterTest').val();
            var ID=JSON.parse(data.Checking);

            $('#KOTPrintOrderID').val(ID);
            var Booking=JSON.parse(data.Booking);
            $('#BookingTest').val(Booking);
            $('#PrintKOT').attr('disabled',false);    
            
            $.get('/Sale/Order/Ticket/KOT/'+ID+'/'+ParcelTest+'/'+Booking,function(data)
            {
            
                $('.OrderPrint').empty();
                var TempOrderID=JSON.parse(data.TempOrderID);
                
                var Order=JSON.parse(data.Order);
                var Shop=JSON.parse(data.Shop);
                var ItemQty=JSON.parse(data.ItemQty);
                var ProductID=JSON.parse(data.ProductID);
                
                var ProductName=JSON.parse(data.ProductName);
                var Qty=JSON.parse(data.Qty);
                var Price=JSON.parse(data.Price);
                var ShopID=JSON.parse(data.ShopID);
                var FinalPrice=JSON.parse(data.FinalPrice);
                var Mapping=JSON.parse(data.Mapping);
                var KitchenID=JSON.parse(data.KitchenID);
                var RealKitchenID=JSON.parse(data.RealKitchenID);
                //alert("Total Number of Kitchens: "+RealKitchenID.length);
                var RealKitchenName=JSON.parse(data.RealKitchenName);
                var Comments=JSON.parse(data.Comments);
                //var UpdateTime=JSON.parse(data.UpdatedTime);

                var DDD=new Date();
                var Year=DDD.getFullYear();
                var  Months=DDD.getMonth()+1;
                var  Days=DDD.getDate();
                var Hour=DDD.getHours();
                var Minute=DDD.getMinutes();
                var meridian="AM";
                Hour=DDD.getHours();
                if(Hour>12)
                {
                    Hour=Hour-12;
                    meridian="PM";
                }

                //month=dateadvance.getMonth()+1;
                if(Months<10)
                {
                    Months="0"+Months;
                }
                if(Minute<10)
                {
                    Minute="0"+Minute;
                }
            //alert(RealKitchenName[0]);
            //alert(ProductID.length);
            var KitchenName=JSON.parse(data.KitchenName);
        
            for(j=0;j<RealKitchenID.length&&ProductID.length>0;j++)
            {
                $('.OrderPrint').append('<div class="KOTBody">'+
                '<h4 >'+RealKitchenName[j]+'<br>'+Shop.ShopName+
                '</h4></div>');
                //'<div class="row">'+

                $('.OrderPrint').append('<table><tr><td>Order</td><td>:'+TempOrderID+'</td><td>Table  </td><td> : '+Order.Name+'</td></tr></table>');
                $('.OrderPrint').append('<table><tr><td> Guest </td><td> : '+Order.Guests+'</td><td> Waiter </td><td>:'+Order.FirstName+'</td></tr></table>');

                $('.OrderPrint').append('<table><tr><td>Date</td><td>:<strong>'+Days+'/'+Months+'/'+Year+'</strong></td><td>Time  </td><td><strong> :'+Hour+':'+Minute+':'+meridian+'</strong></td></tr></table>');

                //'<div class="row">'+
            
                /*'<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-md-offset-1">Date'+     
                '</div>'+
                '<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">'+   
                ':<strong>'+Days+'/'+Months+'/'+Year+'</strong>'+    
                '</div>'+
                '<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Time'+   
                     
                '</div>'+
                '<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">'+   
                
                ': <strong>'+Hour+':'+Minute+':'+meridian+'</strong>'+
        
                '</div>'+          
                '</div>'*/

                $('.OrderPrint').append('<hr><h4><small>Items</small></h4><hr>');
                for(i=0;i<ItemQty;i++)
                {
                    if(KitchenID[i]==RealKitchenID[j]&&Qty[i]>0)
                    {
                        Qty[i]=Math.floor(Qty[i]);
                        //Qty[i]=Math.floor(Qty[i]);
                        $('.OrderPrint').append('<table><tr><td>'+Qty[i]+'</td><td>'+ProductName[i]+'<br><i>'+Comments[i]+'</i></td></tr></table>');
                        //$('.OrderPrint').append('<div class="row"><div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-md-offset-1">'+Qty[i]+'</div><div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">'+ProductName[i]+'</div></div>');

                    }
                }



                $('.OrderPrint').append('<hr style="border:1px dotted black;">');
            }
            if(Order.Notes!="")
            {
                $('.OrderPrint').append(Order.Notes);

            }
            $('.OrderPrint').append('</div>');
            //PrintRecipt();
            e.preventDefault();
            var contents = document.getElementById("PrintAnOrder").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            //frame1.style.position = "absolute";
            //frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
            frameDoc.document.open();
            //frameDoc.document.write('<html><head><title>DIV Contents</title>');
            //frameDoc.document.write('</head><body>');
            frameDoc.document.write(contents);
            //frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            document.body.removeChild(frame1);
            }, 500);

            //var Booking=$('#BookingTest').val();
            //var ID=$('#KOTPrintOrderID').val();
            //var ParcelTest=$('#KOTPrintParcelTest').val();
            //return false;
            //e.preventDefault();
            // var contents = document.getElementById('PrintAnOrder').innerHTML;
            // var frame1 = document.createElement('iframe');
            // frame1.name = "frame1";
            // //frame1.style.position = "absolute";
            // //frame1.style.top = "-1000000px";
            // document.body.appendChild(frame1);
            // var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
            // frameDoc.document.open();
            // frameDoc.document.write('<html><head><title>DIV Contents</title>');
            // frameDoc.document.write('</head><body>');
            // frameDoc.document.write(contents);
            // frameDoc.document.write('</body></html>');
            // frameDoc.document.close();
            // //frameDoc.document.print();
            // setTimeout(function () {
            // window.frames["frame1"].focus();
            // window.frames["frame1"].print();
            // document.body.removeChild(frame1);
            // }, 500);

            // var prtContent = document.getElementById("PrintAnOrder");
            // var WinPrint = window.open('', '', 'left=0,top=0,width=297,height=700,toolbar=0,left=100,scrollbars=0,status=0');
            // WinPrint.document.write('<h1>I am A Good Man</h1>');
            // WinPrint.document.write(prtContent.innerHTML);
            // WinPrint.document.close();
            // WinPrint.focus();
            // WinPrint.print();
            //WinPrint.close();

            //w=window.open();
            //w.document.write($('.OrderPrint').html());
            //w.print();
            //w.close();

            //$("#OrderSpecial").find(":input").clone().appendTo("#OrderForm");
            //window.open('',"OrderWindow","width=2,height=7,left=500");
            //$('#OrderFormSubmit').submit();  


            //$('#OrderIDforOrderUpdate').val(0);
            //$('#OrderPlaceForm').empty();
            $('#OrderSpecial').empty();
            $('#myformProductList').empty();
            $('#OrderForm').empty();

            
            
            $('#add').empty();
            SubmitTest();
            SimpleCartClear();
            //PrintRecipt();
            $('#OrderIDforOrderUpdate').val(0);
            $('#OrderIDforInvoice').val(0);
            $('#TableID').empty();
            $('#TableID').removeClass('bg-maroon');
            $('#TableID').addClass('bg-blue');
            $('#CounterIDforList').val(0);
            $('#TableID').append("Table");
            $('#RowforOrderDetails').hide();
            $('#OrderCancel').hide();
            $('#InvoiceIDforTender').val(0);
            $('#BottomInvoiceID').empty();
            $('#BottomInvoiceID').append(0);
            $('#BottomOrderID').empty();
            $('#BottomOrderID').append(0);
            $('#OrderIDforOrderUpdate').val(0);
            $('#TableIDforOrder').val(0);
            $('#SendToKitchen').attr('disabled',true);
             
         
            //$('.OrderPrint').append(Print.length);
            //$('#OrderStart').modal('show');
        });
        },
        error: function(data){
            alert("Data Not Found");

        }
    })
    });
    
    var KOTChecking=$('#KOTChecking').val();
    if(KOTChecking>0)
    {
        //$('#OrderPlace').click();
        //alert(KOTChecking);
        
        
    }   
    $('#RowforOrderDetails').hide();

    $('#ListToCart').unbind('click').click(function(e)
    {

        e.preventDefault();
        //SimpleCartClear();
        var Test=$('#ParcelTest').val();
        //alert(Test);
        if(Test==1)
        {
            var OrderID=$('#OrderIDforOrderUpdate').val();
            $('#OrderPlace').removeClass('hidden');
            $.get('/Sale/Order/Parcel/'+OrderID,function(data)
            {
                //SimpleCartClear();
                //DeleteCartWithoutConfirm();
                $('#OrderIDforOrderUpdate').val(OrderID);
                $('#OrderIDforInvoice').val(OrderID);
                $('#BottomOrderID').empty();
                $('#BottomOrderID').append(OrderID);

                OrderKing=JSON.parse(data.Order);
                ParcelDetails=JSON.parse(data.SubOrders);

                for(i=0;i<cc;i++)
                {
                    //var q = $('input[name="productid[]"]').eq(i).closest('.removeablerow');
                    //q.hide();
                    //$('input[name="productid[]"]').eq(i).val(0);
                    //$('input[name="productid1[]"]').eq(i).val(0);
                    //$('input[name="productid2[]"]').eq(i).val(0);
                    $('[name="RowClear[]"]').eq(i).attr('id',0);
                    
                }

                cc=0;
                $('#add').empty();
                //alert(ParcelDetails[0].ProductName);
                for(i=0;i<ParcelDetails.length;i++)
                {
                    ParcelDetails[i].Qty=Math.floor(ParcelDetails[i].Qty);
                    AddProductToCart(ParcelDetails[i].ProductID,ParcelDetails[i].ShopID,ParcelDetails[i].Qty);
                }
                            
            });       

        }

        if(Test==0)
        {
            var CounterID=$('#CounterIDforList').val();
            $.get('/Sale/Order/Counter/'+CounterID,function(data)
            {
            
                //for(i=0;i<cc;i++)
                //{
                    //var q = $('input[name="productid[]"]').eq(i).closest('.removeablerow');
                    //q.hide();
                    //$('input[name="productid[]"]').eq(i).val(0);
                    //$('input[name="productid1[]"]').eq(i).val(0);
                    //$('input[name="productid2[]"]').eq(i).val(0);
                    //$('[name="RowClear[]"]').eq(i).attr('id',0);
                    
                //}

                cc=0;
                $('#add').empty();
                var ProductID=JSON.parse(data.ProductID);
                //alert(ProductID.length);
                var ShopID=JSON.parse(data.ShopID);
                var OrderID=JSON.parse(data.OrderID);
                //alert(OrderID);
                $('#OrderIDforOrderUpdate').val(OrderID);
                $('#OrderIDforInvoice').val(OrderID);
                $('#BottomOrderID').empty();
                $('#BottomOrderID').append(OrderID);
                //alert(OrderID);
                var ProductName=JSON.parse(data.ProductName);
                var Quantity=JSON.parse(data.Qty);
                var Price=JSON.parse(data.Price);
                var SubOrderID=JSON.parse(data.SubOrderID);
                var SubOrderProductMappingID=JSON.parse(data.SubOrderProductID);
                var Timing=JSON.parse(data.SubOrder);
                if(ProductID.length!=0)
                {
                    $('#RowforOrderDetails').show();
                    $('#OrderCancel').show();

                }
                //$('#add').empty();
                for(i=0;i<ProductID.length;i++)
                {
                    
                    Quantity[i]=Math.round(Quantity[i]);
                    //Price[i]=Math.round(Price[i]);

                    Quantity[i]=Math.round(Quantity[i]);
                    //$('#LoadFromKOT').val(1);
                    //AddProductToCart(ProductID[i],ShopID[i],Quantity[i]);
                    AddProductToCartSecond(ProductID[i],ShopID[i],Quantity[i],ProductName[i],Price[i]);
                    //Price[i]=Math.round(Price[i]);

                //$('#OrderDetailsListBody').append('<tr><td>'+Quantity[i]+' x '+ProductName[i]+' ['+ProductID[i]+']</td><td><button class="orderlistremovebutton duck" type="button" name="orderlistremovebutton[]"><i class="fa fa-times"></button></td></tr>');
                }

                $('#GrossFooterRow').show();
                $('#FinalQuantity').show();
                $('#FinalItem').show();                
                $('#TaxOverall').removeClass('disabled');
                $('#DiscountOverAll').removeClass('disabled');
                $('#OrderPlace').removeClass('hidden');               
                $('#PrintInvoice').removeClass('disabled');
                $('#SaleHold').removeClass('disabled');
                $('#tender').removeClass('disabled');
                $('#Cancel').removeClass('disabled');
                $('#Advance').removeClass('disabled');
                $('#keycodenumber').val(1);

                TotalPriceCalculation();


            });
        }
        
     
    });

    $('#Parcel').on('click',function(e)
    {
        e.preventDefault();
        $('#ParcelList').empty();
        SimpleCartClear();
        //$('#ParcelList').append('I am a Good man');
        $.get('/Sale/Order/Parcel',function(data)
        {
            var Parcels=JSON.parse(data);
            for(i=0;i<Parcels.length;i++)
            {
                $('#ParcelList').append('<div class="col-md-2"><button name="Parcels[]" class="Parcels btn btn-success btn-lg btn-block" value="'+Parcels[i].ID+'">'+Parcels[i].ID+'</button></div>');
            }

            $('.Parcels').on('click',function(e)
            {
                $('#TableID').empty();
                $('#TableID').removeClass('bg-maroon');
                $('#TableID').addClass('bg-blue');
                $('#CounterIDforList').val(0);
                $('#TableID').append("Table");
                e.preventDefault();
                $('#ParcelTest').val(1);
                $('#CounterTest').val(0);
                $('#OrderDetailsListBody').empty();
                //SimpleCartClear();

                                //SimpleCartClear();
                var index=$('[name="Parcels[]"]').index(this);
                var OrderID=$('[name="Parcels[]"]').eq(index).val();
                $('#OrderIDforInvoice').val(OrderID);
                $('#OrderIDforOrderUpdate').val(OrderID);
                for(i=0;i<cc;i++)
                {
                    var q = $('input[name="productid[]"]').eq(i).closest('.removeablerow');
                    q.hide();
                    $('input[name="productid[]"]').eq(i).val(0);
                    //$('input[name="productid1[]"]').eq(i).val(0);
                    //$('input[name="productid2[]"]').eq(i).val(0);
                    $('[name="RowClear[]"]').eq(i).attr('id',0);
                    
                }

                cc=0;
                $('#add').empty();
                $.get('/Sale/Order/Parcel/'+OrderID,function(data)
                {
                    OrderKing=JSON.parse(data.Order);
                    ParcelDetails=JSON.parse(data.SubOrders);

                    //alert(OrderKing[0].IsInvoiced);
                    if(OrderKing[0].IsInvoiced==1)
                    {
                        for(i=0;i<ParcelDetails.length;i++)
                        {
                            ParcelDetails[i].Qty=Math.floor(ParcelDetails[i].Qty);
                            AddProductToCart(ParcelDetails[i].ProductID,ParcelDetails[i].ShopID,ParcelDetails[i].Qty);
                        }
                    }
                    if(OrderKing[0].IsInvoiced==0)
                    {
                        $('#RowforOrderDetails').show();
                        $('#OrderCancel').show();
                        for(i=0;i<ParcelDetails.length;i++)
                        {
                            ParcelDetails[i].Qty=Math.floor(ParcelDetails[i].Qty);
                            $('#OrderDetailsListBody').append('<tr><td>'+ParcelDetails[i].Qty+' x '+ParcelDetails[i].ProductName+' ['+ParcelDetails[i].ProductID+']</td><td><button class="orderlistremovebutton duck" type="button" name="orderlistremovebutton[]" value="'+ParcelDetails[i].SubOrderProductID+'"><i class="fa fa-times"></button></td></tr>');

                        }                               
                        
                    }
                    
                    $('#SelectTableModal').modal('hide');
                    $('#ListToTicket').on('click',function(e)
                    {
                        e.preventDefault();
                        //e.preventDefault();
                        $('#SalesPanelKOTRecipt').empty();
                        //$('#OrderTicketForm').empty();
                        //alert("I am Zahid Imran");

                        var OrderID=$('#OrderIDforOrderUpdate').val();
                        //alert(OrderID);
                        $('#OrderTicketForm').append('<input type="hidden" name="DetailsID" value="'+OrderID+'">');

                        $.ajaxSetup({
                        header:$('meta[name="_token"]').attr('content')
                        })
                        //e.preventDefault(e);

                        $.ajax({

                        type:"POST",
                        url:'/Sale/Order/Ticket',
                        data:$('#OrderTicketForm').serialize(),
                        success: function(data)
                        {
                            TempOrderID=JSON.parse(data.TempOrderID);
                            Order=JSON.parse(data.Order);
                            Shop=JSON.parse(data.Shop);
                            ItemQty=JSON.parse(data.ItemQty);
                            ProductID=JSON.parse(data.ProductID);
                            ProductName=JSON.parse(data.ProductName);
                            Qty=JSON.parse(data.Qty);
                            Price=JSON.parse(data.Price);
                            ShopID=JSON.parse(data.ShopID);
                            FinalPrice=JSON.parse(data.FinalPrice);
                            Mapping=JSON.parse(data.Mapping);
                            KitchenID=JSON.parse(data.KitchenID);
                            RealKitchenID=JSON.parse(data.RealKitchenID);
                            RealKitchenName=JSON.parse(data.RealKitchenName);
                            KitchenName=JSON.parse(data.KitchenName);
                            var DDD=new Date(Mapping.updated_at);
                            var Year=DDD.getFullYear();
                            var  Months=DDD.getMonth()+1;
                            var  Days=DDD.getDate();
                            var Hour=DDD.getHours();
                            var Minute=DDD.getMinutes();
                            var meridian="AM";
                            Hour=DDD.getHours();
                            if(Hour>12)
                            {
                                Hour=Hour-12;
                                meridian="PM";
                            }

                            //month=dateadvance.getMonth()+1;
                            if(Months<10)
                            {
                                Months="0"+Months;
                            }
                            if(Minute<10)
                            {
                                Minute="0"+Minute;
                            }

                            for(j=0;j<RealKitchenID.length&&ProductID.length>0;j++)
                            {
                                $('#SalesPanelKOTRecipt').append('<div class="KOTBody">'+
                                '<h4>'+RealKitchenName[j]+'<br>'+Shop.ShopName+
                                '</h4></div>');
                                //'<div class="row">'+

                                $('#SalesPanelKOTRecipt').append('<table><tr><td>Order</td><td>:'+TempOrderID+'</td><td>Table  </td><td> : '+Order.Name+'</td></tr></table>');
                                $('#SalesPanelKOTRecipt').append('<table><tr><td> Guest </td><td> : '+Order.Guests+'</td><td> Waiter </td><td>:'+Order.FirstName+'</td></tr></table>');

                                $('#SalesPanelKOTRecipt').append('<table><tr><td>Date</td><td>:<strong>'+Days+'/'+Months+'/'+Year+'</strong></td><td>Time  </td><td><strong> :'+Hour+':'+Minute+':'+meridian+'</strong></td></tr></table>');
                                //$('#SalesPanelKOTRecipt').append('<table><tr><td> Time </td><td> : '+Order.Guests+'</td><td> Waiter </td><td>:'+Order.FirstName+'</td></tr></table>');
                                //$('#SalesPanelKOTRecipt').append('</table>');
                                
                                

                                $('#SalesPanelKOTRecipt').append('<hr><h4><small>Items</small></h4><hr>');
                                for(i=0;i<ItemQty;i++)
                                {
                                    if(KitchenID[i]==RealKitchenID[j]&&Qty[i]>0)
                                    {
                                        Qty[i]=Math.floor(Qty[i]);
                                        $('#SalesPanelKOTRecipt').append('<table><tr><td>'+Qty[i]+'</td><td>'+ProductName[i]+'</td></tr></table>');

                                    }
                                }           

                                $('#SalesPanelKOTRecipt').append('<hr style="border:1px dotted black;">');
                            }
                            if(Order.Notes!="")
                            {
                                $('#SalesPanelKOTRecipt').append(Order.Notes);

                            }
                            //$('#SalesPanelKOTRecipt').append('</div>');

                             //var KitchenName=JSON.parse(data.KitchenName);
                             $('#PrintKOTModal').modal('show');

                             e.preventDefault();
                            var contents = document.getElementById("#SalesPanelKOTRecipt").innerHTML;
                            var frame1 = document.createElement('iframe');
                            frame1.name = "frame1";
                            //frame1.style.position = "absolute";
                            //frame1.style.top = "-1000000px";
                            document.body.appendChild(frame1);
                            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
                            frameDoc.document.open();
                            //frameDoc.document.write('<html><head><title>DIV Contents</title>');
                            //frameDoc.document.write('</head><body>');
                            frameDoc.document.write(contents);
                            //frameDoc.document.write('</body></html>');
                            frameDoc.document.close();
                            setTimeout(function () {
                            window.frames["frame1"].focus();
                            window.frames["frame1"].print();
                            document.body.removeChild(frame1);
                            }, 500);


                        },
                        error:function(data)
                        {

                        }
                        });
                        //ListToTicket();
    });


    $('.orderlistremovebutton').on('click',function(e)
    {
        e.preventDefault();
        var p = $('[name="orderlistremovebutton[]"]').index(this);
        var MappingID=$('[name="orderlistremovebutton[]"]').eq(p).val();
        //alert(MappingID);
        $.get('/Sale/Order/List/Delete/'+MappingID,function(data)
        {
            if(data=="good")
            {
                $('#OrderCancel').hide();
                $('#RowforOrderDetails').hide();
                $('#TableID').empty();
                $('#TableID').removeClass('bg-maroon');
                $('#TableID').addClass('bg-blue');
                $('#TableID').append('Table');
                $('#OrderPlace').addClass('hidden');
            }
            alertify.success("This Item Has Been Successfully Canceled from Order List");

        });
        //alert(p);
        var q = $(this).closest('tr');
        q.hide();
        //alert("I am Zakir Khan");

    });         

                    $('#OrderCancel').on('click',function(e)
                    {
                        e.preventDefault();
                        alertify.confirm('Order Cancel', 'Are you sure you want to Cancel Order?', function()
                        {

                            var OrderID=$('#OrderIDforOrderUpdate').val();
                            //alert(OrderID);
                            $.get('/Sale/Order/Delete/'+OrderID,function(data)
                            {
                                $('#RowforOrderDetails').hide();
                                $('#OrderCancel').hide();
                                $('#TableID').empty();
                                $('#TableID').removeClass('bg-maroon');
                                $('#TableID').addClass('bg-blue');
                                $('#TableID').append('Table');
                                $('OrderPlace').addClass('hidden');
                                $('#OrderIDforOrderUpdate').val(0);
                                $('#OrderIDforInvoice').val(0);
                                SimpleCartClear();
                                TotalPriceCalculation();
                                $('#BottomOrderID').empty();
                                $('#BottomOrderID').append(0);
                                $('#BottomInvoiceID').empty();
                                $('#BottomInvoiceID').append(0);
                                $('#CounterIDforList').val(0);
                            });        

                        },function(){ alertify.error('Cancel')});        

                    });


                });

            });


        });

    });

    $('#TableReset').on('click',function(e)
    {


        e.preventDefault();
        var InvID=$('#InvoiceIDforTender').val();
        if(InvID>0)
        {
            SimpleCartClear();
        }
        $('#OrderIDforOrderUpdate').val(0);
        $('#OrderIDforInvoice').val(0);
        $('#TableID').empty();
        $('#TableID').removeClass('bg-maroon');
        $('#TableID').addClass('bg-blue');
        $('#CounterIDforList').val(0);
        $('#TableID').append("Table");
        $('#RowforOrderDetails').hide();
        $('#OrderCancel').hide();
        $('#SelectTableModal').modal('hide');
        alertify.success("Table is Successfully Reset");
        $('#InvoiceIDforTender').val(0);
        $('#BottomInvoiceID').empty();
        $('#BottomInvoiceID').append(0);
        $('#BottomOrderID').empty();
        $('#BottomOrderID').append(0);
        $('#OrderIDforOrderUpdate').val(0);
        $('#TableIDforOrder').val(0);        

    });

    $('#ListToTicket').on('click',function(e)
    {
        e.preventDefault();
        $('#SalesPanelKOTRecipt').empty();
        //$('#OrderTicketForm').empty();
        //alert("I am Zahid Imran");

        var OrderID=$('#OrderIDforOrderUpdate').val();
        //alert(OrderID);
        $('#OrderTicketForm').append('<input type="hidden" name="DetailsID" value="'+OrderID+'">');

        $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
        })
        //e.preventDefault(e);

        $.ajax({

        type:"POST",
        url:'/Sale/Order/Ticket',
        data:$('#OrderTicketForm').serialize(),
        success: function(data)
        {
            TempOrderID=JSON.parse(data.TempOrderID);
            Order=JSON.parse(data.Order);
            Shop=JSON.parse(data.Shop);
            ItemQty=JSON.parse(data.ItemQty);
            ProductID=JSON.parse(data.ProductID);
            ProductName=JSON.parse(data.ProductName);
            Qty=JSON.parse(data.Qty);
            Price=JSON.parse(data.Price);
            ShopID=JSON.parse(data.ShopID);
            FinalPrice=JSON.parse(data.FinalPrice);
            Mapping=JSON.parse(data.Mapping);
            KitchenID=JSON.parse(data.KitchenID);
            RealKitchenID=JSON.parse(data.RealKitchenID);
            RealKitchenName=JSON.parse(data.RealKitchenName);
            KitchenName=JSON.parse(data.KitchenName);
            var DDD=new Date(Mapping.updated_at);
            var Year=DDD.getFullYear();
            var  Months=DDD.getMonth()+1;
            var  Days=DDD.getDate();
            var Hour=DDD.getHours();
            var Minute=DDD.getMinutes();
            var meridian="AM";
            Hour=DDD.getHours();
            if(Hour>12)
            {
                Hour=Hour-12;
                meridian="PM";
            }

            //month=dateadvance.getMonth()+1;
            if(Months<10)
            {
                Months="0"+Months;
            }
            if(Minute<10)
            {
                Minute="0"+Minute;
            }

            for(j=0;j<RealKitchenID.length&&ProductID.length>0;j++)
            {
                $('#SalesPanelKOTRecipt').append('<div class="KOTBody">'+
                '<h4>'+RealKitchenName[j]+'<br>'+Shop.ShopName+
                '</h4></div>');
                //'<div class="row">'+

                $('#SalesPanelKOTRecipt').append('<table><tr><td>Order</td><td>:'+TempOrderID+'</td><td>Table  </td><td> : '+Order.Name+'</td></tr></table>');
                $('#SalesPanelKOTRecipt').append('<table><tr><td> Guest </td><td> : '+Order.Guests+'</td><td> Waiter </td><td>:'+Order.FirstName+'</td></tr></table>');

                $('#SalesPanelKOTRecipt').append('<table><tr><td>Date</td><td>:<strong>'+Days+'/'+Months+'/'+Year+'</strong></td><td>Time  </td><td><strong> :'+Hour+':'+Minute+':'+meridian+'</strong></td></tr></table>');
                //$('#SalesPanelKOTRecipt').append('<table><tr><td> Time </td><td> : '+Order.Guests+'</td><td> Waiter </td><td>:'+Order.FirstName+'</td></tr></table>');
                //$('#SalesPanelKOTRecipt').append('</table>');
                
                

                $('#SalesPanelKOTRecipt').append('<hr><h4><small>Items</small></h4><hr>');
                for(i=0;i<ItemQty;i++)
                {
                    if(KitchenID[i]==RealKitchenID[j]&&Qty[i]>0)
                    {
                        Qty[i]=Math.floor(Qty[i]);
                        $('#SalesPanelKOTRecipt').append('<table><tr><td>'+Qty[i]+'</td><td>'+ProductName[i]+'</td></tr></table>');

                    }
                }           

                $('#SalesPanelKOTRecipt').append('<hr style="border:1px dotted black;">');
            }
            if(Order.Notes!="")
            {
                $('#SalesPanelKOTRecipt').append(Order.Notes);

            }
            //$('#SalesPanelKOTRecipt').append('</div>');

             //var KitchenName=JSON.parse(data.KitchenName);
             $('#PrintKOTModal').modal('show');

             e.preventDefault();
            var contents = document.getElementById("#SalesPanelKOTRecipt").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            //frame1.style.position = "absolute";
            //frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
            frameDoc.document.open();
            //frameDoc.document.write('<html><head><title>DIV Contents</title>');
            //frameDoc.document.write('</head><body>');
            frameDoc.document.write(contents);
            //frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            document.body.removeChild(frame1);
            }, 500);



            
            //PrintRecipt();
            



        },
        error:function(data)
        {

        }
        });
        //var OrderID=$('#OrderIDforOrderUpdate').val();
        //$('#OrderTicketForm').append('<input type="hidden" name="DetailsID" value="'+OrderID+'">');
        //window.open('',"OrderTicketWindow","width=297,height=700,left=500");
        //$('#OrderTicketForm').submit();

    });


    $('#OrderCancel').on('click',function(e)
    {
        e.preventDefault();
        alertify.confirm('Order Cancel', 'Are you sure you want to Cancel Order?', function()
        {

            var OrderID=$('#OrderIDforOrderUpdate').val();
            //alert(OrderID);
            $.get('/Sale/Order/Delete/'+OrderID,function(data)
            {
                $('#RowforOrderDetails').hide();
                $('#OrderCancel').hide();
                $('#TableID').empty();
                $('#TableID').removeClass('bg-maroon');
                $('#TableID').addClass('bg-blue');
                $('#TableID').append('Table');
                $('OrderPlace').addClass('hidden');
                $('#OrderIDforOrderUpdate').val(0);
                $('#OrderIDforInvoice').val(0);
                SimpleCartClear();
                TotalPriceCalculation();
                $('#BottomOrderID').empty();
                $('#BottomOrderID').append(0);
                $('#BottomInvoiceID').empty();
                $('#BottomInvoiceID').append(0);
                $('#CounterIDforList').val(0);
            });        
                
        },function(){ alertify.error('Cancel')});        

    });


    $('#TableID').on('click',function(e)
    {

        e.preventDefault();

        //SimpleCartClear();


        $('#TableList').empty();
        
        $.get('/Sale/Counter/Show/',function(data)
        {
            var Counter=JSON.parse(data);

            for(i=0;i<Counter.length;i++)
            {
                    if(Counter[i].IsBooked==0)
                    {
                        $('#TableList').append('<div class="col-md-1 col-sm-1 col-xs-2 col-lg-1"><input type="hidden" name="CounterName[]" value="'+Counter[i].Name+'">'+ 
                            '<input type="hidden" name="CounterBookingChecking[]" value="'+Counter[i].IsBooked+'"><button style="margin-top:10px;" class="btn btn-block btn-lg CounterButton" name="CounterButton[]" value="'+Counter[i].ID+'" >'+Counter[i].Name+'</button></div>');

                    }

                    if(Counter[i].IsBooked==1)
                    {
                        
                        $('#TableList').append('<div class="col-md-1 col-sm-1 col-xs-2 col-lg-1"><input type="hidden" name="CounterName[]" value="'+Counter[i].Name+'">'+
                            '<input type="hidden" name="CounterBookingChecking[]" value="'+Counter[i].IsBooked+'"><button style="margin-top:10px;" class="btn btn-block btn-lg bg-maroon CounterButton CounterUpdate" name="CounterButton[]" value="'+Counter[i].ID+'" >'+Counter[i].Name+'</button></div>');

                    }               

                
            }


            $('.CounterButton').on('click',function(e)
            {
                $('#ParcelTest').val(0);
                $('#CounterTest').val(1);

                if(cc==0)
                $('#OrderPlace').addClass('hidden');
                e.preventDefault();
                var ID=$('[name="CounterButton[]"').index(this);
                var CounterID=  $('[name="CounterButton[]"').eq(ID).val();
                //alert(CounterID);
                $('#OrderDetailsListBody').empty();
                $('#CounterIDforList').val(CounterID);               


                $.get('/Sale/Order/Counter/'+CounterID,function(data)
                {


                    if(data=="NewOrder")
                    {

                        $('#RowforOrderDetails').hide();
                        $('#OrderCancel').hide();
                        var InvforClear=$('#InvoiceIDforTender').val();
                        if(InvforClear>0)
                        {
                            //SimpleCartClear();
                        }
                        $('#InvoiceIDforTender').val(0);
                        $('#OrderIDforInvoice').val(0);
                        $('#OrderIDforOrderUpdate').val(0);
                        $('#BottomOrderID').empty();
                        $('#BottomOrderID').append(0);
                        $('#BottomInvoiceID').empty();
                        $('#BottomInvoiceID').append(0);
                    }

                    var ProductID=JSON.parse(data.ProductID);
                    var ShopID=JSON.parse(data.ShopID);
                    var OrderID=JSON.parse(data.OrderID);
                    var Order=JSON.parse(data.Order);
                    
                    $('#OrderIDforOrderUpdate').val(OrderID);

                    var ProductName=JSON.parse(data.ProductName);
                    var Quantity=JSON.parse(data.Qty);
                    var Price=JSON.parse(data.Price);
                    var SubOrderID=JSON.parse(data.SubOrderID);
                    var SubOrderProductMappingID=JSON.parse(data.SubOrderProductID);
                    var Timing=JSON.parse(data.SubOrder);
                    var Counter=JSON.parse(data.Counter);
                    var Discount=JSON.parse(data.Discount);
                    var Tax=JSON.parse(data.Tax);
                    
                    if(ProductID.length==0)
                    {

                    }

                    $('#BottomOrderID').empty();
                    $('#BottomOrderID').append(OrderID);

                    if(Order.IsInvoiced==1)
                    {
                        var InvIDforCounter=Counter.InvoiceID;
                        $('#BottomInvoiceID').empty();
                        $('#BottomInvoiceID').append(InvIDforCounter);
                    }

                    var InvIDforCounter=Counter.InvoiceID;
                    $('#InvoiceIDforTender').val(InvIDforCounter);
                    var Invvv=$('#InvoiceIDforTender').val();
                    if(Invvv>0 || Order.IsInvoiced==0)
                    {
                        
                        SimpleCartClear();
                    }


                    
                    for(i=0;i<ProductID.length;i++)
                    {
                        var DDD=new Date(Timing[i].updated_at);
                        var Year=DDD.getFullYear();
                        var  Months=DDD.getMonth()+1;
                        var  Days=DDD.getDate();
                        var Hour=DDD.getHours();
                        var Minute=DDD.getMinutes();
                        var meridian="AM";
                        Hour=DDD.getHours();
                        if(Hour>12)
                        {
                            Hour=Hour-12;
                            meridian="PM";
                        }

                        //month=dateadvance.getMonth()+1;
                        if(Months<10)
                        {
                            Months="0"+Months;
                        }
                        if(Minute<10)
                        {
                            Minute="0"+Minute;
                        }
                        Quantity[i]=Math.round(Quantity[i]);
                        Price[i]=Math.round(Price[i]);

                        //Quantity[i]=Math.round(Quantity[i]);
                        if(Order.IsInvoiced==1)
                        {
                            

                            /*for(i=0;i<cc;i++)
                            {
                                var q = $('input[name="productid[]"]').eq(i).closest('.removeablerow');
                                q.hide();
                                $('input[name="productid[]"]').eq(i).val(0);
                                $('input[name="productid1[]"]').eq(i).val(0);
                                $('input[name="productid2[]"]').eq(i).val(0);
                            }*/

                            cc=0;
                            $('#add').empty();

                            //DeleteCartWithoutConfirm();

                            //alert(InvIDforCounter);
                            //
                            $('#RowforOrderDetails').hide();                            
                            // $('#OrderPlace').attr('disabled',false);
                            $('#OrderPlace').removeClass('hidden');
                            AddProductToCart(ProductID[i],ShopID[i],Quantity[i],Discount[i],Tax[i]);
                            


                        }
                                                //Price[i]=Math.round(Price[i]);

                        if(Order.IsInvoiced==0)
                        {

                            if(ProductID.length==0)
                            {
                                alert("It has nothing Left");
                            }

                            
                            if(ProductID.length>0)
                            {
                                //alert(OrderID);
                                $('#RowforOrderDetails').show();
                                $('#OrderCancel').show();
                                //var InvID=$('#InvoiceIDforTender').val(InvIDforCounter);
                                //if(InvID>0)
                                //{
                                    //SimpleCartClear();


                                //}
                                //SimpleCartClear();
                                
                                $('#OrderDetailsListBody').append('<tbody><tr><td>'+Quantity[i]+' x '+ProductName[i]+' ['+ProductID[i]+']</td><td><button class="btn btn-default orderlistremovebutton" type="button" name="orderlistremovebutton[]"><i class="fa fa-trash"></button></td></tr></tbody>');

                            }                            
                        }                       
                    }


                    $('.orderlistremovebutton').on('click',function(e)
                    {
                        e.preventDefault();
                        var p = $('[name="orderlistremovebutton[]"]').index(this);
                        var MappingID=SubOrderProductMappingID[p];
                        //alert(MappingID);
                        $.get('/Sale/Order/List/Delete/'+MappingID,function(data)
                        {
                            if(data=="good")
                            {
                                $('#OrderCancel').hide();
                                $('#RowforOrderDetails').hide();
                                $('#TableID').empty();
                                $('#TableID').removeClass('bg-maroon');
                                $('#TableID').addClass('bg-blue');
                                $('#TableID').append('Table');
                                $('#OrderPlace').addClass('hidden');
                            }
                            alertify.success("This Item Has Been Successfully Canceled from Order List");

                        });
                        //alert(p);
                        var q = $(this).closest('tr');
                        q.hide();
                        //alert("I am Zakir Khan");

                    });           


                });
                $('#TableIDforOrder').val(CounterID);
                var BookedChecking=$('[name="CounterBookingChecking[]"').eq(ID).val();
                if(BookedChecking==1)
                {

                }
                var CounterName=$('input[name="CounterName[]"').eq(ID).val();
                //alert(CounterID);
                $('#TableID').empty();
                $('#TableID').removeClass('bg-blue');
                $('#TableID').addClass('bg-maroon');
                $('#TableID').append('<strong>Table : '+CounterName+'</strong>');
                $('#SelectTableModal').modal('hide');

            });

        });
       
        $('#TableNav').click();
        $('#SelectTableModal').modal('show');

    });

    $('.CategoryFilter').on('click',function(e)
    {
        $('#ProductListContainer').empty();
        e.preventDefault();
        var Index=$('[name="CategoryFilter[]"]').index(this);
        var Total=$('[name="CategoryFilter[]"').length;

        for(i=0;i<Total;i++)
        {
            $('[name="CategoryFilter[]"]').eq(i).removeClass('bg-maroon');
        }

        $('[name="CategoryFilter[]"]').eq(Index).addClass('bg-maroon');

        var CategoryID=$('[name="CategoryFilter[]"]').eq(Index).val();


        $.get('/Sale/Product/Category/Filter/'+CategoryID,function(data)
        {
            var Products=JSON.parse(data);
            var Currency=$('#CurrencySymb').val();
            for(i=0;i<Products.length;i++)
            {
                Products[i].SalePrice=parseFloat(Products[i].SalePrice, 2).toFixed(2);
                if(Products[i].SalePrice % 1 === 0)
                {
                    Products[i].SalePrice=parseFloat(Products[i].SalePrice, 2).toFixed(0);
                }

                $('#ProductListContainer').append('<div class="col-sm-3 col-md-3 col-lg-3 col-xs-6" style="padding:5px 5px 0px 0px;">'+
                    '<button name="ProductSelect[]" class="btn btn-default btn-block ProductSelect" value="'+Products[i].ProductID+'">'+Products[i].ProductName+'<br>'+
                    '<span class="label label-success">'+Products[i].ProductID+'S'+ShopID+'</span> <span class="label label-primary">'+Products[i].SalePrice+' '+Currency+'</span></button>'+
                '</div>');
            }

            //Add Product From Item Lookup Prompt
            $('.ProductSelect').click(function(e) 
            {
                e.preventDefault();
                var p = $('[name="ProductSelect[]"]').index(this);
                var productid = $('[name="ProductSelect[]"]').eq(p).val();
                shopid = $('#IDofTheShop').val();

                AddProductToCart(productid,shopid);
            });
        });
    });

    $('#ProductSearchInput').on('keyup', function(e){        
        e.preventDefault();

        var ProductName = $('#ProductSearchInput').val();
        $.get('/Product/Search/ByName/' + ProductName, function(data){
            $('#ProductListContainer').empty();

            var ProductList = JSON.parse(data);
            var Currency=$('#CurrencySymb').val();

            for(i = 0; i < ProductList.length; i++)
            {
                ProductList[i].SalePrice=parseFloat(ProductList[i].SalePrice, 2).toFixed(2);
                if(ProductList[i].SalePrice % 1 === 0)
                {
                    ProductList[i].SalePrice=parseFloat(ProductList[i].SalePrice, 2).toFixed(0);
                }

                $('#ProductListContainer').append('<div class="col-sm-3 col-md-3 col-lg-3 col-xs-6" style="padding:5px 5px 0px 0px;">'+
                    '<button name="ProductSelect[]" class="btn btn-default btn-block ProductSelect" value="'+ProductList[i].ProductID+'">'+ProductList[i].ProductName+'<br>'+
                    '<span class="label label-success">'+ProductList[i].ProductID+'S'+ShopID+'</span> <span class="label label-primary">'+ProductList[i].SalePrice+' '+Currency+'</span></button>'+
                '</div>');
            }

            // Select product clicking on  it
            $('.ProductSelect').click(function(e) 
            {
                e.preventDefault();
                var p = $('[name="ProductSelect[]"]').index(this);
                var productid = $('[name="ProductSelect[]"]').eq(p).val();
                shopid = $('#IDofTheShop').val();

                AddProductToCart(productid,shopid);
            });
        });
    });

    x = $('#DrawerTest').val();
    if (x == "Edit") 
    {
        $('#OpenBalance').hide();
        $('#EditBalance').show();
        $('#CloseBalance').show(); 
        $('.inner-content').removeClass('hidden');               
    }
    if (x == "Open") 
    {
        $('#EditFahadBalance').hide();
        $('#EditBalance2').hide();
        $('#CloseFahadBalance').hide();
        $('#OpenBalance').show();
        $('.inner-content').addClass('hidden');
        $('#OpeningBalance').modal('show');
    }
    // Clock Initialize
    function clock() 
    {
        var now = new Date();
        var TwentyFourHour = now.getHours();
        var hour = now.getHours();
        var min = now.getMinutes();
        var mid = 'PM';
        if (min < 10) {
          min = "0" + min;
        }

        if (hour > 12) {
          hour = hour - 12;
        }
          
        if(hour==0){ 
          hour=12;
        }

        if(TwentyFourHour < 12) {
           mid = 'AM';
        }          
        document.getElementById('Clock').innerHTML = hour+':'+min +' '+ mid ;
        setTimeout(clock, 1000);
    }

    clock();

    alertify.defaults.theme.ok = "btn btn-primary";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.defaults.theme.input = "form-control";

    $('.DataTable').DataTable({
    language: {
      paginate: {
        next: '<i class="fa fa-chevron-right">',
        previous: '<i class="fa fa-chevron-left">'  
      },
      "sLengthMenu": "Show _MENU_",
      "sSearch":"Search "
    },
    "iDisplayLength": 10,
    "aLengthMenu": [[ 10, 25, 35, 50, 100, -1], [10, 25, 35, 50, 100, "All"]]
    });    

    $('#cash').click(function(e)
    {
        e.preventDefault();
        $('#SalesPanelRecipt').empty();
        if(cc==0)
        {
            $('#SubmitTender').attr('disabled',true);            
            
        }
        $('.AdvanceCashAreaShow').empty();
        $('#PayingAreaShow').empty();
        $('#ExactButtonAreaShow').empty();
        $('#ChangeAreaCashShow').empty();
        $('#CashSubmitAreaShow').empty();

        var Advalue     =parseFloat($('#AdvanceAmountValue').val(),2);
        var Payable     =parseFloat($('#Payable').val(),2);
        var Due         =Payable;
        var Total       =Advalue+Payable;
        var Currency=$('#CurrencySymb').val();
        $('#PayableShow').val(Total);
        if(Advalue>0)
        {
            $('.AdvanceCashAreaShow').append('<div class="col-md-10>"><div class="form-group"><div class="col-xs-12">'+
                      '<h3><label class="label label-primary">Advance Paid:</label></h3>'+
                    '</div><div class="col-xs-12">'+
                    '<input type="text" readonly class="form-control" name="AdvancePaidinTheCashShow" value="'+Advalue+'">'+      
                      
                    '</div>'+
                  '<h3><label class="label label-primary">Due:</label></h3><div class="col-xs-12"><input type="text" readonly class="form-control" name="DueinTheCash" value="'+Due+'"></div></div>');
        }


        $('#PayingAreaShow').append('<h3><label class="label label-primary">Cash Paid</label></h3><input type="number" id="PaidShow" class="form-control" placeholder="Enter the paid amount" step=".0001" autocomplete="off" autofocus >');
        $('#ExactButtonAreaShow').append('<button type="button" class="btn   bg-purple btn-block" id="ExactTenderAmountShow" class="form-control"> Exact Amount </button>');

        $('#ChangeAreaCashShow').append('<h3><label class="label label-primary"> Change</label></h3>'+
                      '<div class="input-group">'+
                        '<input type="text" name="returned" id="ChangeShow" class="form-control" readonly value="0" autocomplete="off">'+                        
                        '<span class="input-group-addon">'+Currency+'</span>'+         
                      '</div>'
        );

        $('#CashSubmitAreaShow').append('<button type="submit" class="btn btn-success btn-lg   btn-block" id="SubmitTenderShow"><i class="fa fa-paper-plane"></i><br><strong>Submit Payment</strong></button>');

        $('#PaidShow').on('keyup click',function(e) 
        {

            e.preventDefault();
            var Value=parseFloat($('#PaidShow').val(),2);
            $('#Paid').val(Value);

            var cusi = $('#Customerid').val();


            if (cusi == "") {
                cusi = 0;
                $('#SubmitTenderShow').attr('disabled',true);
            }

            $('#SubmitTenderShow').attr('disabled',true);

            if(cusi>0)
            $('#SubmitTenderShow').attr('disabled',false);


            var PaidCheck = $('#PaidShow').val();
            var Payable = parseFloat($('#PayableShow').val(), 2);
            var Paid = parseFloat($('#PaidShow').val(), 2);
            $('#Paid').val(Paid);
            var Advance = parseFloat($('#AdvanceAmountValue').val(), 2);
            var DueAdvance=Payable-Advance;
            $('#AdvanceTenderDue').val(DueAdvance);
            var Change = parseFloat((Paid-DueAdvance), 2).toFixed(2);
            if (PaidCheck == "") {
                Paid = 0;
                Change = DueAdvance*(-1);
            }

            if (Change < 0 && cusi == 0) {
                $('#SubmitTenderShow').attr('disabled', true);
            }
            if (Change >= 0 || cusi>0) {
                $('#SubmitTenderShow').attr('disabled', false);
            }
            $('#ChangeShow').val(Change);
            $('#ChangeforCash').val(Change);
            $('#Change').val(Change);            
        });

        $('#ExactTenderAmountShow').click(function()
        {
            var advancevalue=$('#AdvanceAmountValue').val();
            var Payable=parseFloat($('#Payable').val(),2);

            if(advancevalue>0)
            {
                var DueAdvance=Payable;
                $('#PaidShow').val(DueAdvance);
            }
            else
            $('#PaidShow').val($('#Payable').val());
            $('#ChangeShow').val(0);
            $('#Change').val(0);
            $('#PaidShow').focus();
            $('#SubmitTenderShow').attr('disabled',false);
        });

        $('#PaidShow').val(0);

        var ShowforChange=(-1)*$('#PayableShow').val();
        $('#ChangeShow').val(ShowforChange);
        var cusi = $('#Customerid').val();
        if (cusi == "") 
        {
            cusi = 0;
            $('#SubmitTenderShow').attr('disabled',true);
        }

        if(cusi==0)
        {
            $('#SubmitTenderShow').attr('disabled',true);
        }

        if(cusi>0)
            $('#SubmitTenderShow').attr('disabled',false);
        // $('#PaymentCashModalShow').modal('show');
    });
      
    $('#myformshow').on('submit',function(e)
    {
        if(cc==0)
        {
            $('#PrintRecipt').attr('disabled',true);
            $('#SubmitTenderShow').attr('disabled',true);
            $('#ExactTenderAmountShow').attr('disabled',true);
            $('#PaidShow').attr('disabled',true);            
            return false;
        }
        
        e.preventDefault();
        $('#PrintRecipt').attr('disabled',false);
        var Advanvalue=parseFloat($('#AdvanceAmountValue').val(),10);
        var AdCheck=$('#LoadFromAdvanceWithoutReload').val();
        var vat = $('#taxoverall').val();
        //alert(vat);
        var discountall = parseFloat($('#discountoverall').val(),2).toFixed(2);
        $('#discountoverall').val(0);
        var subtotal = $('#subtotaloverall').val();
        //alert(subtotal);
        //var paidtender=parseFloat($('#Paid').val();
        //alert(paidtender);
        paidtender=0;
        //var AdvanTen=parseFloat($('#AdvanceAmountValue').val(),2);
        var Total=paidtender+Advanvalue;
        var paid = Total;
        var rrr = $('#Change').val();
        var cus = $('#Customerid').val();
        var InvID=$('#InvoiceIDforTender').val();
        var Advanvalue=$('#AdvanceAmountValue').val();
        var AdvanID   =$('#AdvanceIDValue').val();
        var OrderIDforTender=$('#OrderIDforInvoice').val();
        var OrderIDforOrderUpdate=$('#OrderIDforOrderUpdate').val();
        var PaidCash=$('#Paid').val();
        
        $('#CashSaleForm').append('<input type="hidden" name="OverAllTax" value="'+vat+'">');
        $('#CashSaleForm').append('<input type="hidden" name="AdvancePaymentValue" value="'+Advanvalue+'">');
        $('#CashSaleForm').append('<input type="hidden" name="AdvanceIDValue" value="'+AdvanID+'">');
        $('#CashSaleForm').append('<input type="hidden" name="OverAllDiscount" value="'+discountall+'">');
        $('#CashSaleForm').append('<input type="hidden" name="OverAllSubTotal" value="'+subtotal+'">');
        $('#CashSaleForm').append('<input type="hidden" name="Paid" value="'+PaidCash+'" >');
        $('#CashSaleForm').append('<input type="hidden" name="InvoiceCheck" value="'+InvID+'">');
        $('#CashSaleForm').append('<input type="hidden" name="Change" value="'+rrr+'">');
        $('#CashSaleForm').append('<input type="hidden" name="customer" value="'+cus+'">');
        $('#CashSaleForm').append('<input type="hidden" name="Order" value="'+OrderIDforTender+'">');
        $('#CashSaleForm').append('<input type="hidden" name="OrderforUpdate" value="'+OrderIDforOrderUpdate+'">');
        
        var totalQuan=$('input[name="total[]"]').length;

        for(i=0;i<cc;i++)
        {
            var Firstquan=parseInt($('input[name="total[]"]').eq(i).val(),10);

            var ID=$('input[name="productid[]"]').eq(i).val();
            var Name=$('input[name="productname[]"]').eq(i).val();
            var Price=$('input[name="Price[]"]').eq(i).val();
            var discount=$('input[name="discount[]"]').eq(i).val();
            var Final=$('input[name="final[]"]').eq(i).val();
            var Shop=$('input[name="Shop[]"]').eq(i).val();
            var Tax=$('input[name="tax[]"]').eq(i).val();
            var TaxValue=$('input[name="taxvalue1[]"]').eq(i).val();
            //var KOTTest=$('#LoadFromKOT').val();
            //if(KOTTest==1)
            //{
               // Tax=0;
              //  TaxValue=0;
           // }              

            if(ID!=0)
            {
                $('#CashSaleForm').append('<input type="hidden" name="total3[]" value="'+Firstquan+'">');
                $('#CashSaleForm').append('<input type="hidden" name="productid3[]" value="'+ID+'">');
                $('#CashSaleForm').append('<input type="hidden" name="productname3[]" value="'+Name+'">');
                $('#CashSaleForm').append('<input type="hidden" name="Price3[]" value="'+Price+'">');
                $('#CashSaleForm').append('<input type="hidden" name="discount3[]" value="'+discount+'">');
                $('#CashSaleForm').append('<input type="hidden" name="final3[]" value="'+Final+'">');
                $('#CashSaleForm').append('<input type="hidden" name="Shop3[]" value="'+Shop+'">');
                $('#CashSaleForm').append('<input type="hidden" name="tax3[]" value="'+Tax+'">');
                $('#CashSaleForm').append('<input type="hidden" name="taxvalue3[]" value="'+TaxValue+'">');
            }
        }

        $("#add").find(":input").clone().appendTo("#CashSaleForm");
        $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
        })
        e.preventDefault(e);

        $.ajax({

        type:"POST",
        url:'/Sale/Invoice',
        data:$('#CashSaleFormSubmit').serialize(),
        success: function(data)
        {


            ItemQty=JSON.parse(data.ItemQty);
            FinalPrice=JSON.parse(data.FinalPrice);
            Price=JSON.parse(data.Price);
            ProductName=JSON.parse(data.ProductName);
            productid=JSON.parse(data.productid);
            Qty=JSON.parse(data.Qty);
            discount=JSON.parse(data.discount);
            User=JSON.parse(data.User);
            tt=JSON.parse(data.tt);
            paid=JSON.parse(data.paid);
            returned=JSON.parse(data.returned);
            Shop=JSON.parse(data.Shop);
            CustomerName=JSON.parse(data.CustomerName);
            vat=JSON.parse(data.vat);



            TotalDiscount=JSON.parse(data.TotalDiscount);

            subtotaltotal=JSON.parse(data.subtotaltotal);
            Invoice=JSON.parse(data.Invoice);
            //Invoice.ServiceCharge=Invoice.ServiceCharge.toFixed(2);
            //alert("Service Charge IS:"+Invoice.ServiceCharge);
            InWords=JSON.parse(data.InWords);
            ProductID=JSON.parse(data.ProductID);
            ShopFooter=JSON.parse(data.ShopFooter);
            ShopID=JSON.parse(data.ShopID);
            AdvanceValue=JSON.parse(data.AdvanceValue);
            AdvanceValue=Math.floor(AdvanceValue);
            //CashAmount=JSON.parse(data.CashAmount);
            //CashAmount=Math.floor(CashAmount);
            CustomerPreviousBalance=JSON.parse(data.CustomerPreviousBalance);
            CustomerCurrentBalance=JSON.parse(data.CustomerCurrentBalance);
            CustomerTotalBalance=JSON.parse(data.CustomerTotalBalance);
            Author=JSON.parse(data.Author);
            Currency=JSON.parse(data.Currency);
            
            Order=JSON.parse(data.Order);
            $('#CurrencySymb').val(Currency);

            var DDD=new Date(Invoice.created_at);
            var Year=DDD.getFullYear();
            var  Months=DDD.getMonth()+1;
            var  Days=DDD.getDate();
            var Hour=DDD.getHours();
            var Minute=DDD.getMinutes();
            var meridian="AM";
            Hour=DDD.getHours();
            if(Hour>12)
            {
                Hour=Hour-12;
                meridian="PM";
            }
            // alert("Hour IS:"+Hour);

            //month=dateadvance.getMonth()+1;
            if(Months<10)
            {
                Months="0"+Months;
            }
            if(Minute<10)
            {
                Minute="0"+Minute;
            }

            var DDDNow=new Date();
            var YearNow=DDDNow.getFullYear();
            var  MonthsNow=DDDNow.getMonth()+1;
            var  DaysNow=DDDNow.getDate();
            var HourNow=DDDNow.getHours();
            var MinuteNow=DDDNow.getMinutes();
            var meridianNow="AM";
            HourNow=DDDNow.getHours();
            if(HourNow>12)
            {
                HourNow=HourNow-12;
                meridianNow="PM";
            }

            //month=dateadvance.getMonth()+1;
            if(MonthsNow<10)
            {
                MonthsNow="0"+MonthsNow;
            }
            if(MinuteNow<10)
            {
                MinuteNow="0"+MinuteNow;
            }

            $('#SalesPanelRecipt').append('<h4 style="font-family:Helvetica,Arial,sans-serif; font-size:14px;" > Sales Invoice</h4>'+
            '<hr style="margin-top:-10px;margin-bottom:-10px; border:1px black dotted">');
            if(Shop.ShopLogo != null)
            $('#SalesPanelRecipt').append(' <img src="/uploads/image/shop/'+Shop.ShopLogo+'" width=70 height=70 class="col-md-offset-5 img img-responsive">');

            $('#SalesPanelRecipt').append('<h4 style="margin-top:-10px;font-family:Helvetica,Arial,sans-serif; font-size:14px;"> '+Shop.ShopName+'</h4>');

            $('#SalesPanelRecipt').append('<table style="margin-top:-20px;">');
            if(Shop.ShopAddress!="")
                $('#SalesPanelRecipt').append('<tr style="font-family:Helvetica,Arial,sans-serif; font-size:14px;"><td>Address</td><td>:'+Shop.ShopAddress+'</td></tr>');
             if(Shop.Phone!="")
                $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:14px;"><td>Phone</td><td>:'+Shop.Phone+'</td></tr>');

            if(Shop.Email!="")
                $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:14px;"><td>Email</td><td>:'+Shop.Email+'</td></tr>');

            if(Shop.Website!="")
                $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:14px;"><td>WebSite</td><td>:'+Shop.Website+'</td></tr>');

            if(Shop.VatRegNo!=""&&Shop.VatRegNo!=null)
                $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:14px;"><td>Vat Reg</td><td>:'+Shop.VatRegNo+'</td></tr>');
            $('#SalesPanelRecipt').append('</table>');
            $('#SalesPanelRecipt').append('<hr>');
            if(Order!=null)                
            $('#SalesPanelRecipt').append('<table style="margin-top:-6px;">');
            if(Order==null)
            $('#SalesPanelRecipt').append('<table style="margin-top:-16px;">');


            if(Order!=null)
            {
                $('#SalesPanelRecipt').append('<tr style="font-family:Helvetica,Arial,sans-serif; font-size:13px;"><td> OrderID </td><td><strong>:'+Order.ID+'</strong><td> Table </td><td>:'+Order.Name+'</td></tr>');
                $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:13px;"><td> Guest </td><td><strong>:'+Order.Guests+'</strong><td> Served By </td><td>:'+Order.FirstName+'</td></tr>');

            }           
            
            $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:13px;"><td>InvoiceID</td><td><strong>:'+Invoice.InvoiceID+'</strong></td>');
            $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:13px;"><td>Invoice Date</td><td><strong>:'+Days+'/' +Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</strong></td>');
            $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:13px;"><td>Print Date</td><td><strong>:'+DaysNow+'/' +MonthsNow+'/'+YearNow+' '+HourNow+':'+MinuteNow+''+meridianNow+'</strong></td>');
            $('#SalesPanelRecipt').append('</table>');
            $('#SalesPanelRecipt').append('<hr style="border:1px black dotted">');

            $('#SalesPanelRecipt').append('<table style="margin-top:-10px; margin-bottom:-15px;font-family:Helvetica,Arial,sans-serif; font-size:14px;"><tr><th>#</th><th>Item/Description </th><th>Amount </th></tr></table>');
            var TotalQty=0;
            var SubTotal=0;



            for(i=0;i<ItemQty;i++)
            {
                j=i+1;
                FinalPrice=Qty[i]*Price[i];
                SubTotal   =SubTotal+FinalPrice;
                Qty[i]=Math.floor(Qty[i]); 
                TotalQty=TotalQty+Qty[i];
                if(Qty[i]>0)
                {
                   
                    if(discount[i]>0)
                    {
                     $('#SalesPanelRecipt').append('<br><tr><td style="font-family:Helvetica,Arial,sans-serif; font-size:13px;"><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']Dis-'+discount[i]+'<td>= '+FinalPrice+'</td></tr>');                        
                    }
                    if(discount[i]==0)
                     $('#SalesPanelRecipt').append('<br><tr style="text-transform:lowercase;"><td><strong>'+j+'. </strong></td><td><h7 style="text-transform:lowercase; margin-top:-10px; margin-bottom:-15px;font-family:Helvetica,Arial,sans-serif; font-size:14px;">'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']= '+FinalPrice+'</h2></td></tr>');
                   
                }
            }
            $('#SalesPanelRecipt').append('</table>');
            $('#SalesPanelRecipt').append('<hr style="border:1px black dotted;"">Total Quantity: '+TotalQty+'<hr>');

            $('#SalesPanelRecipt').append('<table>');
            $('#SalesPanelRecipt').append('<tr style="font-family:Helvetica,Arial,sans-serif; font-size:14px;"><td>Sub Total</td><td> : <strong>'+Invoice.SubTotal+'</strong></td></tr>');
            if(Invoice.TaxTotal>0)
            $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:13px;"><td>Tax Total</td><td> : <strong>'+Invoice.TaxTotal+'</strong></td></tr>');
            if(Invoice.ServiceCharge>0)
            $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:13px;"><td>ServiceCharge</td><td  > : <strong>'+Invoice.ServiceCharge+'</strong></td></tr>');
            if(Invoice.Discount>0)
            $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:13px;"><td>Discount</td><td> : <strong>'+Invoice.Discount+'</strong></td></tr>');
            $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:13px;"><td>Total Due</td><td> : <strong>'+Invoice.Total+'</strong></td></tr>');
            if(AdvanceValue>0)
            {
                $('#SalesPanelRecipt').append('<tr style="font-family:Helvetica,Arial,sans-serif; font-size:13px;"><td>Advance Paid:</td><td> : <strong>'+AdvanceValue+'</strong></td></tr>');
                $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:13px;"><td>Cash Due:</td><td> : <strong>'+CashAmount+'</strong></td></tr>');

            }

            if(Invoice.IsPaid==1)
            {
                $('#SalesPanelRecipt').append('<hr style="border:1px black dotted">');
                if(Invoice.PaidMoney>0)
                {
                $('#SalesPanelRecipt').append('<tr style="margin-top:-10px;font-family:Helvetica,Arial,sans-serif; font-size:14px;"><td>Total Paid:</td><td> : <strong>'+Invoice.PaidMoney+'</strong></td></tr>');


                }
                if(Invoice.ReturnedMoney>0)
                {
                $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:14px;"><td>Changes:</td><td> : <strong>'+Invoice.ReturnedMoney+'</strong></td></tr>');


                }

            } 



            $('#SalesPanelRecipt').append('</table>');

            $('#SalesPanelRecipt').append('<p style="text-transform: capitalize; margin-top:-4px; margin-bottom:-2px;font-family:Helvetica,Arial,sans-serif; font-size:14px;">'+InWords+' '+Currency+' Only</p>');
            if(CustomerName!="Annonymous")
            {
                $('#SalesPanelRecipt').append('<hr style="border:1px black dotted"><table style="margin-bottom:-20px; margin-top:-10px; margin-left:-3px;font-family:Helvetica,Arial,sans-serif; font-size:14px;"><tr><td>Customer</td><td>|'+CustomerName+'</td></tr>');
                if(CustomerPreviousBalance>0)
                {
                $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:13px;"><td>Previous Due</td><td>|'+CustomerPreviousBalance+'</td></tr>');


                }

                if(CustomerCurrentBalance>0)
                {
                $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:13px;"><td>Current Due</td><td>|'+CustomerCurrentBalance+'</td></tr>');
                $('#SalesPanelRecipt').append('<br><tr style="font-family:Helvetica,Arial,sans-serif; font-size:13px;"><td>Total Due</td><td>|'+CustomerTotalBalance+'</td></tr>');


                }

                $('#SalesPanelRecipt').append('</table>');
            }

            if(ShopFooter!="")
            {
                $('#SalesPanelRecipt').append('<hr style="border:1px black dotted;"><div class="InvoiceFooter">'+ShopFooter.Footer+'<div>')
            }

            $('#SalesPanelRecipt').append(' <hr style="border:1px black dotted;">Have a nice Day ! | <span class="">'+User.FirstName+'</span><hr>');
            $('#SalesPanelRecipt').append(' <div class="company-info" style="font-family:Helvetica,Arial,sans-serif; font-size:14px;">Software By: <span class="TechLab">  '+Author+'</span>  01614777555<hr>');
            
            e.preventDefault();
            var contents = document.getElementById("SalesPanelRecipt").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            //frame1.style.position = "absolute";
            //frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
            frameDoc.document.open();
            //frameDoc.document.write('<html><head><title>DIV Contents</title>');
            //frameDoc.document.write('</head><body>');
            frameDoc.document.write(contents);
            //frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            document.body.removeChild(frame1);
            }, 500);



            //var Booking=$('#BookingTest').val();
            //var ID=$('#KOTPrintOrderID').val();
            //var ParcelTest=$('#KOTPrintParcelTest').val();
            //return false;   

            //$('#SubmitTender').attr('disabled',true);
            
        },
        error: function(data)
        {
            alert("Data Not Found");
        }


        });
        //window.open('',"TestWindow","width=297,height=700,left=500");
        //$('#CashSaleFormSubmit').submit();
        $('#discountoverall').val(0);
        SubmitTest();
        TotalPriceCalculation();

        $.get('/Customer/Reset', function(data) {
            $('#Customerid').val(0);
            $('#customerid').val(0);
            $('#customername').empty();
            $('#customername').append('<a class="btn bg-blue" data-toggle="modal" data-target="#CustomerModal" id="customer">Customer</a>');
        });

        // $('#PaymentCashModalShow').modal('hide');            
        //$('#CashModal').modal('hide');
        //$('body').removeClass('modal-open');
        //$('.modal-backdrop').remove();
        
        var AdIDValue=$('#AdvanceIDValue').val();            
          
        if(AdIDValue>0)
        {
            $.get('/Sale/Advance/Complete/'+IDValue,function(data)
            {

                $('#ImranKhan').val("I am Wasim Akram");
            });
        }

        var HoldIDVal=$('#HoldIDValue').val();

        if(HoldIDVal>0)
        {
            $.get('/Sale/Hold/Delete/'+HoldIDVal,function(data)
            {
            });
        }
        
        $('#GrossFooterRow').empty();
        $('#AdvanceAmountValue').val(0);
        //$('#add').hide();
        $('#myformProductList').empty();
        $('#add').empty();            
        ValueReset();
        $('#SubmitTenderShow').attr('disabled',true);
        $('#ExactTenderAmountShow').attr('disabled',true);
        $('#PaidShow').attr('disabled',true);

    });

    //$('#OrderPlace').removeClass('disabled');

    $('#InvoiceListTableforUnpaid').on('click','tr',function(event) 
    {

        var tr = $(this).closest("tr");
        var index = tr.index();
        //alert(index);
        var x=event.target.className.split(" ")[1];
        if(x=="btn-success"||x=="fa-print")
        {
            var invoiceid = $('[name="InvoiceID1[]"]').eq(index).val();
            window.open("/Invoice/Sales/Print/" + invoiceid, "", "width=300,height=750,left=500");                
        }

        else if(x=="btn-info"||x=="fa-info")
        {
            var invoiceid = $('[name="InvoiceID1[]"]').eq(index).val();
            //alert(invoiceid);
            $.get('/Invoice/Sales/Details/'+invoiceid,function(data)
            {
             $('#AddSaleList').empty();
                var Details=JSON.parse(data.Total);
                var Invoice=JSON.parse(data.Invoice);
                for(i=0;i<Details.length;i++)
                {
                    k=i+1;
                    var DDD=new Date(Details[i].created_at);
                    var Year=DDD.getFullYear();
                    var  Months=DDD.getMonth()+1;
                    var  Days=DDD.getDate();
                    var Hour=DDD.getHours();
                    var Minute=DDD.getMinutes();
                    var meridian="AM";
                    Hour=DDD.getHours();
                        if(Hour>12)
                        {
                            Hour=Hour-12;
                            meridian="PM";
                        }

                        //month=dateadvance.getMonth()+1;
                        if(Months<10)
                        {
                            Months="0"+Months;
                        }
                        if(Minute<10)
                        {
                            Minute="0"+Minute;
                        }

                    $('#AddSaleList').append('<tr><td>'+k+'</td><td>'+Details[i].ProductName+'['+Details[i].ProductID+'S'+Details[i].ShopID+']<br>['+Details[i].Price+'X'+Details[i].Qty+']</td><td>'+Details[i].Price*Details[i].Qty+'</td><td>'+Days+'/' +Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</td></tr>');
                }

                $('#AddSaleList').append('<tr><td><strong>Discount:</strong></td>'+
                '<td><strong>'+Invoice.Discount+'</strong></td></tr><tr><td><strong>SubTotal:</strong></td>'+
                '<td><strong>'+Invoice.SubTotal+'</strong></td></tr><tr><td><strong>TAX Total:</strong></td>'+
                '<td><strong>'+Invoice.TaxTotal+'</strong></td></tr>'+
                '<tr><td><strong>Total:</strong></td>'+
                '<td><strong>'+Invoice.Total+'<strong></td></tr><tr>');
                $('#PreviousSaleDetailsModal').modal('show');
            });
        }
        else
        {
            var invoiceid = $('input[name="InvoiceID1[]"]').eq(index).val();
            var orderid = $('input[name="OrderID1[]"]').eq(index).val();
            $('#InvoiceIDforTender').val(invoiceid);
            var InvCheck=$('#InvoiceIDforTender').val();            
            $('#OrderIDforInvoice').val(orderid);
            $.get('/Invoice/Sales/Details/'+invoiceid,function(data)
            {
                $('#BottomInvoiceID').empty();
                $('#BottomInvoiceID').append(invoiceid);
                var OrderID=$('#OrderIDforInvoice').val();

                $('#BottomOrderID').empty();
                $('#BottomOrderID').append(OrderID);
                for(i=0;i<cc;i++)
                {
                    var q = $('input[name="productid[]"]').eq(i).closest('.removeablerow');
                    q.hide();
                    $('input[name="productid[]"]').eq(i).val(0);
                    $('input[name="productid1[]"]').eq(i).val(0);
                    $('input[name="productid2[]"]').eq(i).val(0);
                }
                var Details=JSON.parse(data.Total);
                if(Details.length==0)
                {
                    alert("This Invoice Has No Product Left");
                }

                var Invoice=JSON.parse(data.Invoice);
                var TotalDiscountinInvoice=Invoice.Discount; 

                for(i=0;i<Details.length;i++)
                {
                    Details[i].Qty=Math.floor(Details[i].Qty);
                    AddProductToCart(Details[i].ProductID,Details[i].ShopID,Details[i].Qty,Details[i].Discount,0,0,TotalDiscountinInvoice);
                }

                $('#PreviousInvoiceModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                
            });
        }
    });

    $('#PendingOrdersList tbody').on('click','tr',function(event)
    {
        var tr = $(this).closest("tr");
        var index = tr.index();
        //alert(index);
        var x=event.target.className.split(" ")[1];
        if(x=="btn-success"||x=="fa-arrow-right" ||x=="fa-file-text")
        {
            alertify.confirm('Invoice Print', 'Are you sure you want to generate Invoice?', function(){ 
                var IDs=$('[name="OrderIDforList[]"]').index(this);
                var IDforOrderPrint=$('input[name="OrderIDforList1[]"]').eq(index).val();
                $('#OrderFormforInvoice').append('<input type="hidden" name="OrderID" value="'+IDforOrderPrint+'">');
                window.open('',"OrderWindowforInvoice","width=297,height=700,left=500");
                $('#OrderFormforInvoice').submit(); alertify.success("Invoice Successfully Generated ");
                $('input[name="OrderIDforList1[]"]').eq(index).closest("tr").remove();
            },function(){ alertify.error('Cancel')});
        
        }
        else if(x=="btn-danger"||x=="fa-trash-o")
        {
            alertify.confirm('Delete Order', 'Are you sure you want to Delete This Order?',function()
            {
                var ID=$('input[name="OrderIDforList1[]"]').eq(index).val();
                $.get('/Sale/Order/Delete/'+ID,function(data)
                {
                    alertify.success("Order Information successfully deleted!!!");
                    $('input[name="OrderIDforList1[]"]').eq(index).closest("tr").remove();
                });
            },function(){ 
                alertify.error('Cancel')
            });
        }
        else if(x=="btn-primary"||x=="fa-info")
        {
            var IDforOrderPrint=$('input[name="OrderIDforList1[]"]').eq(index).val();

            $.get('/Sale/Order/Details/'+IDforOrderPrint,function(data)
            {

                        $('#AddOrderList').empty();
                        var ProductID  =JSON.parse(data.ProductID);
                        var ProductName=JSON.parse(data.ProductName);
                        var ShopID     =JSON.parse(data.ShopID);
                        var Qty        =JSON.parse(data.Qty);
                        var Price      =JSON.parse(data.Price);
                        var Timing       =JSON.parse(data.SubOrder);
                        var TotalPrice   =JSON.parse(data.TotalPrice);
                        var TotalTax     =JSON.parse(data.TotalTax);

                        for(i=0;i<ProductID.length;i++)
                        {
                            k=i+1;
                            var DDD=new Date(Timing[i].created_at);
                            var Year=DDD.getFullYear();
                            var  Months=DDD.getMonth()+1;
                            var  Days=DDD.getDate();
                            var Hour=DDD.getHours();
                            var Minute=DDD.getMinutes();
                            var meridian="AM";
                            Hour=DDD.getHours();
                            if(Hour>12)
                            {
                                Hour=Hour-12;
                                meridian="PM";
                            }

                            //month=dateadvance.getMonth()+1;
                            if(Months<10)
                            {
                                Months="0"+Months;
                            }
                            if(Minute<10)
                            {
                                Minute="0"+Minute;
                            }

                            

                            Multiply=parseFloat(Price[i],10)*parseFloat(Qty[i],10);

                        $('#AddOrderList').append('<tr><td>'+k+'</td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>'+
                            '['+Price[i]+'X'+Qty[i]+']</td><td>'+Multiply+'</td><td>'+Days+'/'+Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</td></tr>');
                        }
                        var OverAllTotalPrice=TotalPrice+TotalTax;

                        $('#AddOrderList').append(''+
                        '<tr><td><strong>SubTotal:</strong></td>'+
                        '<td><strong>'+TotalPrice+'</strong></td></tr><tr><td><strong>Total Tax:</strong></td>'+
                        '<td><strong>'+TotalTax+'</strong></td></tr><tr><td><strong>Total Price:</strong></td>'+
                        '<td><strong>'+OverAllTotalPrice+'</strong></td></tr>'+
                        
                        '</tr>');

                        $('#OrderDetailsModal').modal('show');
                        DeleteCartWithoutConfirm();

            });
        }

        else if(x=="btn-warning"||x=="fa-print")
        {
            var IDforOrderPrint=$('input[name="OrderIDforList1[]"]').eq(index).val();
            //alert(IDforOrderPrint);

            $('#OrderTicketForm').append('<input type="text" name="DetailsID" value="'+IDforOrderPrint+'">');
            window.open('',"OrderTicketWindow","width=297,height=700,left=500");
            $('#OrderTicketForm').submit();
        }

        else
        {
            var IDforOrderPrint=$('input[name="OrderIDforList1[]"]').eq(index).val();
            //alert(IDforOrderPrint);
            var ID=$('input[name="OrderIDforList1[]"]').eq(index).val();
            //alert(ID);
            $('#BottomOrderID').empty();
            $('#BottomOrderID').append(ID);
            $('#BottomInvoiceID').empty();
            $('#BottomInvoiceID').append(0);

                        //alert(ID);                    
            $('#OrderIDforInvoice').val(ID);
            $.get('/Sale/Order/Load/'+ID,function(data)
            {
                var Product=JSON.parse(data.ProductID);
                var Shop   =JSON.parse(data.ShopID);
                var Qty    =JSON.parse(data.Qty);
                for(i=0;i<cc;i++)
                {
                    var q = $('input[name="productid[]"]').eq(i).closest('.removeablerow');
                    q.hide();
                    $('input[name="productid[]"]').eq(i).val(0);
                    $('input[name="productid1[]"]').eq(i).val(0);
                    $('input[name="productid2[]"]').eq(i).val(0);
                }
                           

                //DeleteCartWithoutConfirm();


                var Count=Product.length;
                //alert(Count);
                //alert(Products[0].ProductID);
                for(i=0;i<Count;i++)
                {

                    Qty[i]=Math.round(Qty[i]);
                    AddProductToCart(Product[i],Shop[i],Qty[i]);
                }
                //alertify.success("Order Information successfully Loaded!!!");
                if(Count>0)
                {
                    $('#OrderPlaceListModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();

                }                           

            });

        }
    });

    RoleChecking();

    $('#ree').hide();
    $('#CommonCardPayment').hide();
    $('#GrossFooterRow').hide();
    $('#FinalQuantity').hide();
    $('#FinalItem').hide();
    var InvCheck=$('#InvoiceIDforTender').val();
    var OrderCheck=$('#OrderIDforInvoice').val();
    if(InvCheck>0)
    {
        $('#PrintInvoice').addClass('disabled');
    }

    // Disable Right Click
    if (document.addEventListener) 
    {
      document.addEventListener('contextmenu', function(e) {
        alertify.warning('<strong><i class="fa fa-thumbs-up"></i> Wecome to <span class="logo-lg">TechLab</span></strong>'); 
        e.preventDefault();
      }, false);
    } 
    else 
    {
      document.attachEvent('oncontextmenu', function() {
        alertify.success('<strong><i class="fa fa-thumbs-up"></i> Wecome to <span class="logo-lg">TechLab</span></strong>'); 
        window.event.returnValue = false;
      });
    }

    $('#AdvanceCustomerName').keyup(function(e)
    {
        var target = e.target || e.srcElement;
        if ( target.tagName !== "TEXT" )
        {
            e.preventDefault();
        }
    });

    $('#DailyReport').click(function()
    {
        $('#DailyReportModal').modal('show');
    });

    $('#TodaysSummary').click(function()
    {
        $('#DailyReportModal').modal('show');
    });



    //Order Load to Cart


    /*$('.CounterButton').on('click',function(e)
    {
        e.preventDefault();
        var ID=$('[name="CounterButton[]"').index(this);
        var CounterID=  $('[name="CounterButton[]"').eq(ID).val();

        $.get('/Sale/Order/Counter/'+CounterID,function(data)
        {

            for(i=0;i<cc;i++)
            {
                var q = $('input[name="productid[]"]').eq(i).closest('.removeablerow');
                q.hide();
                $('input[name="productid[]"]').eq(i).val(0);
                $('input[name="productid1[]"]').eq(i).val(0);
                $('input[name="productid2[]"]').eq(i).val(0);
            }
            var ProductID=JSON.parse(data.ProductID);
            var ShopID=JSON.parse(data.ShopID);
            var OrderID=JSON.parse(data.OrderID);
            $('#OrderIDforOrderUpdate').val(OrderID);
            //alert(OrderID);
            var ProductName=JSON.parse(data.ProductName);
            var Quantity=JSON.parse(data.Qty);
            var Price=JSON.parse(data.Price);
            var SubOrderID=JSON.parse(data.SubOrderID);
            var SubOrderProductMappingID=JSON.parse(data.SubOrderProductID);
            var Timing=JSON.parse(data.SubOrder);
            for(i=0;i<ProductID.length;i++)
            {
                    
                Quantity[i]=Math.round(Quantity[i]);
                AddProductToCart(ProductID[i],ShopID[i],Quantity[i]);
                //Price[i]=Math.round(Price[i]);

             //$('#OrderDetailsListBody').append('<tr><td>'+ProductID[i]+'</td><td>'+ProductName[i]+'</td><td>'+Quantity[i]+'</td><td>'+Price[i]+'</td><td>'+Days+'/'+Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</td><td><button class="orderlistremovebutton btn   btn-danger duck" type="button" name="orderlistremovebutton[]"><i class="fa fa-times"></button></td></tr>');
            }


        });
        $('#TableIDforOrder').val(CounterID);
        var BookedChecking=$('[name="CounterBookingChecking[]"').eq(ID).val();
        if(BookedChecking==1)
        {
            
        }
        var CounterName=$('input[name="CounterName[]"').eq(ID).val();
        //alert(CounterID);
        $('#TableID').empty();
        $('#TableID').removeClass('bg-blue');
        $('#TableID').addClass('bg-maroon');
        $('#TableID').append('<strong>Table : '+CounterName+'</strong>');
        $('#SelectTableModal').modal('hide');

    });*/




    $('#NewOrderButton').on('click',function()
    {
        $('#CounterID1').empty();
        $('#CounterID2').empty();
        $('#OrderNewBody').hide();
        $('#GuestCount').val(0);
        $('#NotesforNewOrder').val('');

        $('#OrderUpdateID').hide();
        //$('.AvailableCounters').css('color', 'green');
        $(".AvailableCounters").addClass('Jadid');

        $.get('/Sale/Order/Counter/Check',function(data)
        {

            var Count=JSON.parse(data);
            for(i=0;i<Count.length;i++)
            {                
                $('#CounterID1').append('<button type="button" class="btn btn-lg  bg-olive AvailableCounters" name="AvailableCounters[]" value="'+Count[i].ID+'">'+Count[i].Name+'</button>');
                
                //$('#CounterID2').append('<button type="button" class="btn btn-lg    bg-olive AvailableCounters" name="AvailableCounters[]"  value="'+Count[i].ID+'">'+Count[i].Name+'</button>');
            }

            $('#ConfirmOrderPlace').attr('disabled',true);

            $('.AvailableCounters').on('click',function()
            {

                $('#OrderNewBody').show();
                var Total=$('[name="AvailableCounters[]"').length;

                for(i=0;i<Total;i++)
                {
                    $('[name="AvailableCounters[]"').eq(i).removeClass('bg-maroon');
                    $('[name="AvailableCounters[]"').eq(i).addClass('bg-olive');
                }                 
            
            //e.preventDefault();
            //$('[name="total[]"]').index(this);
            //$('.AvailableCounters').css('color', 'green');
            var Index=$('[name="AvailableCounters[]"').index(this);
            var ID   =$('[name="AvailableCounters[]"').eq(Index).val();
            $('[name="AvailableCounters[]"').eq(Index).removeClass('bg-olive');
            $('[name="AvailableCounters[]"').eq(Index).addClass('bg-maroon');
            //alert(ID);
            $('#CounterID').val(ID);
            $('#ConfirmOrderPlace').attr('disabled',false);
            });
        });

        //$('#CounterID').append('<option value=""></option>');
        $('#OrderPlaceModal').modal('show');
    });


    $('#UpdateOrderButton').on('click',function()
    {
        $('#UpdateCounterID1').empty();
        $('#UpdateCounterID2').empty();
        $('#OrderUpdateBody').hide();
        $('#OrderDetailsforUpdate').hide();
        $('#OrderDetailsListBody').empty();

        $.get('/Sale/Order/Counter/Check2',function(data)
        {

            var Count=JSON.parse(data);
            //alert(Count[0].Name);
            //alert(Count[1].Name);
            
            for(i=0;i<Count.length;i++)
            {
                $('#UpdateCounterID1').append('<button type="button" class="btn btn-lg   bg-orange UpdateAvailableCounters" name="UpdateAvailableCounters[]" value="'+Count[i].ID+'">'+Count[i].Name+'/'+Count[i].FirstName+'<br>Order ID:'+Count[i].ID+'</button>');              
                
            }

            $('#UpdateOrderPlace').attr('disabled',true);


            $('.UpdateAvailableCounters').on('click',function()

            {
                //alert("I am Jahid Khan");

                $('#OrderUpdateBody').show();
                $('#UpdateOrderPlace').attr('disabled',true);
                var Index=$('[name="UpdateAvailableCounters[]"').index(this);
                var OrderID=Count[Index].ID;
                $('#OrderDetailsforUpdate').show();
                $('#OrderDetailsListBody').empty();

                $.get('/Sale/Order/List/Update/'+OrderID,function(data)
                {
                    var ProductID=JSON.parse(data.ProductID);
                    var ProductName=JSON.parse(data.ProductName);
                    var Quantity=JSON.parse(data.Qty);
                    var Price=JSON.parse(data.Price);
                    var SubOrderID=JSON.parse(data.SubOrderID);
                    var SubOrderProductMappingID=JSON.parse(data.SubOrderProductID);
                    var Timing=JSON.parse(data.SubOrder);
                    for(i=0;i<ProductID.length;i++)
                    {
                            var DDD=new Date(Timing[i].updated_at);
                            var Year=DDD.getFullYear();
                            var  Months=DDD.getMonth()+1;
                            var  Days=DDD.getDate();
                            var Hour=DDD.getHours();
                            var Minute=DDD.getMinutes();
                            var meridian="AM";
                            Hour=DDD.getHours();
                            if(Hour>12)
                            {
                                Hour=Hour-12;
                                meridian="PM";
                            }

                            //month=dateadvance.getMonth()+1;
                            if(Months<10)
                            {
                                Months="0"+Months;
                            }
                            if(Minute<10)
                            {
                                Minute="0"+Minute;
                            }
                        Quantity[i]=Math.round(Quantity[i]);
                        Price[i]=Math.round(Price[i]);

                     $('#OrderDetailsListBody').append('<tr><td>'+ProductID[i]+'</td><td>'+ProductName[i]+'</td><td>'+Quantity[i]+'</td><td>'+Price[i]+'</td><td>'+Days+'/'+Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</td><td><button class="orderlistremovebutton btn   btn-danger duck" type="button" name="orderlistremovebutton[]"><i class="fa fa-times"></button></td></tr>');
                    }


                    var url="OrderItemRemove";

                    $.get('SalesRole/'+url,function(data)
                    {
                        if(data==0)
                            $('.orderlistremovebutton').hide();
                        if(data==1)
                            $('.orderlistremovebutton').show();
                    }); 


                    $('.orderlistremovebutton').on('click',function(e)
                    {
                        e.preventDefault();
                        var p = $('[name="orderlistremovebutton[]"]').index(this);
                        var MappingID=SubOrderProductMappingID[p];
                        //alert(MappingID);
                        $.get('/Sale/Order/List/Delete/'+MappingID,function(data)
                        {
                            alertify.success("This Item Has Been Successfully Canceled from Order List");

                        });
                        //alert(p);
                        var q = $(this).closest('tr');
                        q.hide();
                        //alert("I am Zakir Khan");

                    });

                });
                //$('#OrderDetailsforUpdate').append("I am Fahad");

                $('#OrderIDUpdate').val(Count[Index].ID);
                //alert(Count[Index].ID);
                $('#UpdateStaffID').val(Count[Index].StaffID);
                $('#UpdateGuestCount').val(Count[Index].Guests);
                $('#UpdateNotes').val(Count[Index].Notes);
                $('#CounterIDUpdate').val(Count[Index].CounterID);
                var Total=$('[name="UpdateAvailableCounters[]"').length;

                for(i=0;i<Total;i++)
                {
                    $('[name="UpdateAvailableCounters[]"').eq(i).removeClass('bg-maroon');
                    $('[name="UpdateAvailableCounters[]"').eq(i).addClass('bg-olive');

                }
            var Index=$('[name="UpdateAvailableCounters[]"').index(this);
            var ID   =$('[name="UpdateAvailableCounters[]"').eq(Index).val();
            $('[name="UpdateAvailableCounters[]"').eq(Index).removeClass('bg-olive');
            $('[name="UpdateAvailableCounters[]"').eq(Index).addClass('bg-maroon');

            //alert(ID);
            $('#CounterIDUpdate').val(ID);
            $('#UpdateOrderPlace').attr('disabled',true);

            });


        });

        //$('#CounterID').append('<option value=""></option>');
        $('#OrderUpdateModal').modal('show');
    });

    $('#OrderPlace').click(function(e)
    {
        e.preventDefault();
        $('.OrderPrint').empty();
        var CounterIDforKOT=$('#CounterIDforList').val();
        $.get('/Sale/Order/Counter/'+CounterIDforKOT,function(data)
        {
            //alert(data);
            if(data=="NewOrder")
            {
                //alert("This is a New Order");
                $('#NotesforNewOrder').val('');
                $('#GuestCount').val(0);
            }

            else
            {
                var Order=JSON.parse(data.Order);
                $('#NotesforNewOrder').val(Order.Notes);
                $('#GuestCount').val(Order.Guests);
                $('#StaffID').val(Order.StaffID);
            }
            $('#SendToKitchen').attr('disabled',false);
            //var Counter=JSON.parse(data.Counter);
            //alert(Counter.Name);

            //alert("I am Fahad");



        });



        /*var Check=0;        
        $('#OrderNewArea').hide();
        var OrderIDforInvoice=$('#OrderIDforInvoice').val();
        if(OrderIDforInvoice==0)
        {
          $('#UpdateOrderPlace').hide();  
        }
        else
            $('#UpdateOrderPlace').show(); 

        //alert(cc);

        if(cc==0)
        {
            $('#NewOrderButton').attr('disabled',true);
        }
        else
        {
            for(i=0;i<cc;i++)
            {
                x=$('input[name="productid[]"]').eq(i).val();
                if(x>0)
                {
                    Check=1;
                    break;
                }
            }
            if(Check==0)
                $('#NewOrderButton').attr('disabled',true);
            if(Check==1)
                $('#NewOrderButton').attr('disabled',false);
        }

        $.get('/Sale/Order/Counter/Check2',function(data)
        {

            var Count=JSON.parse(data);
            if(Count.length==0)
                $('#UpdateOrderButton').attr('disabled',true);
            else
                $('#UpdateOrderButton').attr('disabled',false);           


        });*/
        $('#OrderStart').modal('show');
    });

    $('.OrderNew').click(function()
    {
        $('#OrderNewArea').show();

    });


    $('#refund').click(function()
    {

        //alert("Saeed Anwar")
        var url="Refund";
        $.get('SalesRole/'+url,function(data)
        {
            if(data>0)
            {

                $('#RefProBody').empty();
                $('#RefundforProduct').empty();
                $('#RefundforInvoice').empty();
                $('#ree').empty();
                $('#RefProBody').hide();
                $('#RefundInvoicePrint').empty();
                //$('#ree').hide();
                var CustomerRefund=$('#customerid').val();
                if(CustomerRefund>0)
                    $('.CustomerPaymentforRefund').show();
                
                if(CustomerRefund=="" ||CustomerRefund==null || CustomerRefund==0)
                {
                    $('.CustomerPaymentforRefund').hide();
                }
            


                $('#RefModal').modal('show');
                $('#RefInvID').hide();
                $('#RefProID').hide();
                $('#RefundProductIDFooter').hide();
                $('#RefundProductByID').hide();
                $('.RefundInvoiceFooter').hide();
                $('#RefundID').val('');
                $('#RefundBarcodeID').val('');
                $('#RefundInvoice').attr('disabled', true);
                RefundInvoiCheck();
            }
        });
    });

    $('#SplitPayment').click(function()
    {


        //varPaymentMethod1=[];

        $('#SplitCardMethods').empty();


        $('#SplitPaymentCashPaid').val(0);
        //$('#SplitPaymentCashChange').val(1200);

        //$('#ExactTenderAmount').empty();
        //alert("Fahad is a bad man");
        $('#SplitCardBody').empty();
        $('#SplitPaymentPayable').empty();
        //$('#SubmitSplitPayment').empty();
        $.get('/Sale/Tender/SplitPayment/',function(data)
        {
            $('#SplitCardBody').empty();
            var  Cust=$('#Customerid').val();
            if(Cust>0)
                $('#SubmitSplitPayment').attr('disabled',false);
            else
                $('#SubmitSplitPayment').attr('disabled',true);

            var AdvanceAmount=$('#AdvanceAmountValue').val();
            if(AdvanceAmount>0)
            {
                var SpiltValueWithAdvance=$('#Payable').val();
                var PayableforSplitPayment=SpiltValueWithAdvance;
            }
            else
            var PayableforSplitPayment=$('#Payable').val();
            var vat = $('#taxoverall').val();
            //$('#AllTax').val(vat);
            //xx=$('#AllTax').val();
            var discountall = parseFloat($('#discountoverall').val(),2).toFixed(2);
            var vat = parseFloat($('#taxoverall').val(),2).toFixed(2);
            var subtotal = $('#subtotaloverall').val();

            var Advanvalue=$('#AdvanceAmountValue').val();

            $('#OverAllDiscountforSplit').val(discountall);
            $('#OverAllSubTotalforSplit').val(subtotal);
            $('#OverAllTaxforSplit').val(vat);
            //$('#OverAllDiscountforSplit').val(discountall);
            //$('#OverAllDiscountforSplit').val(discountall);
            $('#AdvancePaymentValueforSplit').val(Advanvalue);

            var Value=$("#SplitPaymentCashPaid").val();
                //alert(Value);
            $("#SplitPaymentCashPaidForm").val(Value);
            var CashPayableFirst=$('#Payable').val();
            var ChangeFirst=parseFloat((Value-CashPayableFirst),10);
            


            $("#SplitPaymentCashChangeForm").val(ChangeFirst);
            $("#SplitPaymentCashChange").val(ChangeFirst);
            $('#SplitPaymentCashPaybaleForm').val(Change);


            //discountt=$('#AllTax').val();
            //var Advanvalue=$('#AdvanceAmountValue').val();
            if(Advanvalue>0)
            {
                //$('#SplitPaymentForm').append('<input type="hidden" name="AdvancePaymentValue" value="'+Advanvalue+'">');
                $('#SplitPaymentPayable').append('<label class="label label-success">Total Advance Paid:'+Advanvalue+'<label>');
            }

            $('#SplitPaymentPayable').append('<br><label class="label label-success" >Total Bill:'+PayableforSplitPayment+'<label>');

            var Payment=JSON.parse(data);
            
            for(i=0;i<Payment.length;i++)
            {
                //alert("I am a bad man");
                $('#SplitCardBody').append('<tr>'+
                '<td><input type="hidden" name="PaymentMethod[]" class="PaymentMethod" value="'+Payment[i].MethodName+'">'+Payment[i].MethodName+'</td><td><input type="text" name="SplitCardHolderName[]" class="SplitCardHolderName form-control" placeholder="CardHolderName"></td>'+
                '<td><input type="text" name="SplitCardNumber[]" class="SplitCardNumber form-control" placeholder="CardNumber"></td>'+
                '<td><input type="number"  step=".0001" name="SplitPaymentAmount[]" class="SplitPaymentAmount form-control" placeholder="Amount" value=""></td></tr>');

                $('#SplitCardMethods').append('<input type="hidden" name="MethodID[]" class="MethodID" value="'+Payment[i].ID+'">'+
                    '<input type="hidden" name="SplitCardHolderName1[]" value="" class="SplitCardHolderName1" placeholder="CardHolderName">'+
                    '<input type="hidden" name="SplitCardNumber1[]" value="" class="SplitCardNumber1" placeholder="CardNumber">'+
                '<input type="hidden" name="SplitPaymentAmount1[]" value="0" class="SplitPaymentAmount1" placeholder="Amount">'+
                '<input type="hidden" name="PaymentMethod1[]" class="PaymentMethod1" value="'+Payment[i].MethodName+'">');
            }

            $('#SplitPaymentCashPaybale').val(PayableforSplitPayment);
            $('#SplitPaymentCashPaybaleForm').val(PayableforSplitPayment);
            $('#SplitPaymentCashPaybaleForm').hide();

            $('.PaymentMethod').on('input',function()
            {
                var Index=$('input[name="PaymentMethod[]"]').index(this);
                var Value=$('input[name="PaymentMethod[]"]').eq(Index).val();
                //alert(Value);
                $('input[name="PaymentMethod1[]"]').eq(Index).val(Value);

            });

            $('.SplitCardHolderName').on('input',function()
            {
                var Index=$('input[name="SplitCardHolderName[]"]').index(this);
                var Value=$('input[name="SplitCardHolderName[]"]').eq(Index).val();
                //alert(Value);
                $('input[name="SplitCardHolderName1[]"]').eq(Index).val(Value);

            });


            $('.SplitCardNumber').on('input',function()
            {
                var Index=$('input[name="SplitCardNumber[]"]').index(this);
                var Value=$('input[name="SplitCardNumber[]"]').eq(Index).val();
                //alert(Value);
                $('input[name="SplitCardNumber1[]"]').eq(Index).val(Value);

            }); 
               
            
            //Showing Cash Amount for Split Payment
            $('.SplitPaymentCashAmount').on('click keyup',function()
            {
                //var Index=$('input[name="SplitPaymentAmount[]"]').index(this);
                var Value=$('input[name="SplitPaymentCashAmount"]').val();
                $('input[name="SplitPaymentCashAmount1[]"]').val(Value);

            });

            $('#SplitPaymentCashPaid').on('click keyup',function()
            {
                //var Index=$('input[name="SplitPaymentAmount[]"]').index(this);

                
                var Value=$("#SplitPaymentCashPaid").val();
                //alert(Value);
                $("#SplitPaymentCashPaidForm").val(Value);
                var CashPayable=$('#SplitPaymentCashPaybaleForm').val();
                var Change=parseFloat((Value-CashPayable),10);
                if(Change>=0)
                    $('#SubmitSplitPayment').attr('disabled',false);
                else
                {
                    var Cust=$('#Customerid').val();
                    if(Cust>0)
                        $('#SubmitSplitPayment').attr('disabled',false);
                    else
                    $('#SubmitSplitPayment').attr('disabled',true);                    
                }

                $("#SplitPaymentCashChangeForm").val(Change);
                $("#SplitPaymentCashChange").val(Change);

            });


        $('.SplitPaymentAmount').on('click keyup',function()
        {
            var Index=$('input[name="SplitPaymentAmount[]"]').index(this);
            var Value=$('input[name="SplitPaymentAmount[]"]').eq(Index).val();
            

            //alert(Value);
            var count=$('input[name="SplitPaymentAmount[]"]').length;
            var TotalCardAmount=0;
            
            for(i=0;i<count;i++)
            {
               var x= $('input[name="SplitPaymentAmount[]"]').eq(i).val();
               if(x=="")
                x=0;
            x=parseFloat(x,10);
               
               //alert(x);
               TotalCardAmount=TotalCardAmount+x;
            }

            //alert(TotalCardAmount);

            TotalCardAmount=parseFloat(TotalCardAmount,10);

            $('input[name="SplitPaymentAmount1[]"]').eq(Index).val(Value);
            $('input[name="SplitPaymentAmount[]"]').eq(Index).val(Value);

            var TotalPayableSplit=parseFloat($('#Payable').val(),10);
            var Ad=parseFloat($('#AdvanceAmountValue').val(),10);
            if(Ad>0)
            {
                TotalPayableSplit=TotalPayableSplit;
            }
            var CurrentPayable=parseFloat((TotalPayableSplit-TotalCardAmount),10);
            var CurrentPayable=CurrentPayable.toFixed(2);

            if(CurrentPayable<=0)
            {
                $('#SubmitSplitPayment').attr('disabled',false);
            }
            else
            {
                var Cust=$('#Customerid').val();
                if(Cust<1)
                $('#SubmitSplitPayment').attr('disabled',true);
                else
                    $('#SubmitSplitPayment').attr('disabled',false);
            }        
            $('#SplitPaymentCashPaybale').val(CurrentPayable);
            $('#SplitPaymentCashPaybaleForm').val(CurrentPayable);

        });           

        });

        // $('#PaymentSplitModal').modal('show');
        $('#ExactAmountforSplitPayment').on('click',function(e)
        {
            e.preventDefault();
            var Current=$('#SplitPaymentCashPaybale').val();
            $('#SplitPaymentCashPaid').val(Current);
            $('#SplitPaymentCashPaidForm').val(Current);
            $("#SplitPaymentCashChange").val(0);
            $("#SplitPaymentCashChangeForm").val(0);
            $('#SubmitSplitPayment').attr('disabled',false);
        });
    });

    
    $('#SubmitSplitPayment').click(function()
    {
        var total=$('input[name="total[]"]').length;
        for(i=0;i<total;i++)
        {
            var Firstquan=parseInt($('input[name="total[]"]').eq(i).val(),10);
            $('input[name="total2[]"]').eq(i).val(Firstquan);
        }
        var Cust=$('#Customerid').val();
        $('#SplitPaymentForm').append('<input type="hidden" name="SplitPaymentCustomerID" value="'+Cust+'">')
        window.open('',"SplitWindow","width=297,height=700,left=500");
        $('#SplitPaymentForm').submit();

        // $('#PaymentSplitModal').modal('hide');
        $('#CashModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();

        $.get('/Customer/Reset', function(data) 
        {
                $('#Customerid').val(0);
                $('#customerid').val(0);
                $('#customername').empty();
                $('#customername').append('<a class="btn btn-primary  " data-toggle="modal" data-target="#CustomerModal" id="customer">Customer</a>');
        });

        var IDValue=$('#AdvanceIDValue').val();              
          if(IDValue>0)
          {
            $.get('/Sale/Advance/Delete/'+IDValue,function(data)
                {
                });

          }


          var HoldIDVal=$('#HoldIDValue').val();

          if(HoldIDVal>0)
          {
            $.get('/Sale/Hold/Delete/'+HoldIDVal,function(data)
            {


            });
          }

          $('#CardProductArea').empty();

        //DeleteCartWithoutConfirm();
        ValueReset();
        TotalPriceCalculation();        
    });      
    
    // Select a Shop For Admin
    var ad = $('#admin').val();
    var ShopID = $('#IDofTheShop').val();


    $('.modal').on('shown.bs.modal', function() {
        $(this).find('[autofocus]').focus();
    });

    $(".modal-body1").on("hidden.bs.modal", function(){
        $('#RefProID').hide();
    });

    $('#Advance').click(function()
    {
        var url="SaleAdvance";
        $.get('SalesRole/'+url,function(data)
        {
            if(data>0)
            {
                $('#AdvanceCustomerName').val('');
                $('#AdvanceCustomerPhone').val('');
                $('#AdvanceCustomerAddress').val('');
                $('#AdvanceNotes').val('');
                $('#AdvanceAmount').val('');
                $('#AdvanceDelivaryDate').val('');
                $('#AdvanceInvoice').empty();

              $('#AdvanceModal').modal('show');
  
            }
        });        
    });

    $('#HoldList').click(function()
    {
        $('#SaleHoldListModal').modal('show');
        HoldList();
    });

    $('#OrderList').click(function()
    {
        $('#OrderPlaceListModal').modal('show');
        OrderList();
    });

    $('#OrderFromDate').on('input',function()
    {
        OrderList();
    });

    $('#OrderToDate').on('input',function()
    {
        OrderList();
    });    

    $('#AdvanceList').click(function()
    {
        $('#PreviousAdvanceModal').modal('show');
        AdvancedList(); 
    });

    $('#SaleHold').click(function()
    {
        var url="SaleHold";
        $.get('SalesRole/'+url,function(data)
        {
            if(data>0)
            $('#SaleHoldModal').modal('show');
        });
    });   

    $('#HoldFromDate').change(function()
    {
        HoldList();
    });

    $('#HoldToDate').change(function()
    {
        HoldList();
    });

    $('#PreviousAdvance').click(function()
    {
        $('#PreviousAdvanceModal').modal('show');
        AdvancedList();
    });

    // Day Summary
    $('#DaySummary').click(function()
    {
        var DailyReportDate=$('#DailyReportDate').val();

        if(DailyReportDate==""||DailyReportDate==null)
        {
            var myWindow = window.open("/DailyReport/DaySummary/", "", "width=297,height=700,left=500");
        }
        else
            var myWindow = window.open("/DailyReport/DaySummary/"+DailyReportDate, "", "width=297,height=700,left=500");
        // $('#DailyReportModal').modal('hide');
        // $('body').removeClass('modal-open');
        // $('.modal-backdrop').remove();        
    });

    // Day Invoices
    $('#DayInvoices').click(function()
    {
        var DailyReportDate = $('#DailyReportDate').val();
        if(DailyReportDate == "" || DailyReportDate == null)
        {
            var myWindow = window.open("/DailyReport/DayInvoices", "", "width=297,height=700,left=500");
        }
        else
            var myWindow = window.open("/DailyReport/DayInvoices/"+DailyReportDate, "", "width=297,height=700,left=500");
        // $('#DailyReportModal').modal('hide');
        // $('body').removeClass('modal-open');
        // $('.modal-backdrop').remove();        
    });

    // Category wise day sales
    $('#DaySales').click(function()
    {
        var DailyReportDate = $('#DailyReportDate').val();
        if(DailyReportDate == "" || DailyReportDate == null)
        {
            var myWindow = window.open("/DailyReport/DaySales", "", "width=297,height=700,left=500");
        }
        else
            var myWindow = window.open("/DailyReport/DaySales/"+DailyReportDate, "", "width=297,height=700,left=500");
        // $('#DailyReportModal').modal('hide');
        // $('body').removeClass('modal-open');
        // $('.modal-backdrop').remove();        
    });

    RoleChecking();

    $('#AdvanceConfirm').attr('disabled',true);
    $('#customer').click(function()
    {
        $.get('/Sale/Customer/List/',function(data)
        {
            //$('#bodyforcustomer').empty();
            var table = $('#example2').DataTable();
            
            
            //alert(Customer[0].FirstName);
                        //$('#bodyforcustomer').append('')

        });
        $('#CustomerModal').modal('show');
        
        var url="Customer/New";
        $.get('NewCustomerRole',function(data)

        {
            if(data==0)                
                $('#NewCusModal').hide();           
        });

        $.get('CustomerDetailRole/',function(data)
        {
            if(data==0)                
                $('.cusdetail').hide();            
        });
    });

    $('#NewCusModal').click(function()
    {
        $.get('NewCustomerRole/',function(data)
        {
            if(data==0)
                alertify.alert("You are Not Authorized");
            if(data==1)
                $('#NewCustomer').modal('show');
        });
    });

    $('#NameCheck').empty();
    $('#Phone').on('keyup click',function(event)
    {
        $('#PhoneCheck').empty();
        $('#AddCus').attr('disabled',false);
        $('#FirstName').attr('disabled',false);
        $('#LastName').attr('disabled',false);
        $('#Address').attr('disabled',false);
        $('#City').attr('disabled',false);
        $('#Province').attr('disabled',false);
        $('#Country').attr('disabled',false);
        $('#Email').attr('disabled',false);
        $('#Notes').attr('disabled',false);
        $('#ZipCode').attr('disabled',false);
        $('#DateOfBirth').attr('disabled',false);
        $('#CustomerImg').attr('disabled',false);
    });

    $('#FirstName').click(function()
    {
        $('#AddCus').attr('disabled',false);
        $('#PhoneCheck').empty();
        $('#NameCheck').empty();
        var ph=$('#Phone').val();
        PhoneNumberCheck(ph);     

    });

    $('#AddCus').click(function()
    {
        $('#NameCheck').empty();            
        var phonee=$('#Phone').val();
        PhoneNumberCheck(phonee);
        var Phone=$('#Phone').val();
        var Shop=$('#ShopID').val();
        var FirstName=$('#FirstName').val();
        NameCheck(FirstName);
        var LastName=$('#LastName').val();
        var Address=$('#Address').val();
        var City=$('#City').val();
        var Province=$('#Province').val();
        var Country=$('#Country').val();
        var ZipCode=$('#ZipCode').val();
        var Email=$('#Email').val();
        var Notes=$('#Notes').val();
        var DateOfBirth=$('#DateOfBirth').val();
        if(LastName=="")
        LastName="Not Specified";
        if(Address=="")
        Address="Not Specified";
        if(City=="")
        City="Not Specified";
        if(Province=="")
        Province="Not Specified";
        if(Country=="")
        Country=0;
        if(Email=="")
        Email="Not Specified";
        if(ZipCode=="")
        ZipCode="Not Specified";
        if(Notes=="")
        Notes="Not Specified";
        if(DateOfBirth=="")
        DateOfBirth=0000-00-00;

        $.get('AddCustomerFromSale/'+Phone+'/'+Shop+'/'+FirstName+'/'+LastName+'/'+Address+'/'+City+'/'+Province+'/'+Country+'/'+Email+'/'+ZipCode+'/'+Notes+'/'+DateOfBirth,function(data)

        {
            //$('#cusnam').modal('hide');
            $('#NewCustomer').modal('hide');
            //$('#CustomerModal').modal('hide');

            alertify.success("Customer Has Been Successfully Added");

            //$('#bodyforcustomer').empty();

            $.get('/Sale/Customer/List/NewAdd/',function(data)
            {

                var t = $('#example2').DataTable();
                t.clear().draw();
                var k=JSON.parse(data);

                for (i = 0; i < k.length; i++)
                {
                    t.row.add( [
                    
                    '<td>'+k[i].FirstName+' '+k[i].LastName+'</td>',
                    
                    '<td>'+k[i].Phone+'</td>',
                    '<td><input type="hidden" name="cusnam[]" value="'+k[i].CustomerID+'" class="cusnam"><button class="btn btn-primary cusselect" name="cusselect[]" type="button" value="'+k[i].FirstName+'" '+k[i].LastName+' >Select</button><button class="btn btn-info   cusdetail " name="cusdetail[]" type="button">Details</button></td>'

                    ] ).draw();

                }
                 







            });


            
        });
    });

    $('#InvoiceList').on('click', function(){
        $('#PreviousInvoiceModal').modal('show');
        PreviousInvoiceCreate();
    });


    $('#RefundList').on('click', function()
    {

        $('#PreviousRefundModal').modal('show');
        PreviousRefundCreate();
    });

    $('#Previousinvoice').on('click',function()
    {
        $('#PreviousInvoiceModal').modal('show');
        PreviousInvoiceCreate();
    });

    $('#FromDate').on('input',function()
    {
        PreviousInvoiceCreate();
    });

    $('#ToDate').on('input',function()
    {
        PreviousInvoiceCreate();            
    });

    $('#datefromadvance').on('input',function()
    {
        AdvancedList();            
    });

    $('#datetoadvance').on('input',function()
    {
      AdvancedList();
    });

    function AdvancedList()
    {
        var FromDate = $('#datefromadvance').val();
        if(FromDate=="")
            FromDate="nofromdate";
        var ToDate = $('#datetoadvance').val();
        if(ToDate=="")
            ToDate="notodate";
         $('#AddAdvance').empty();

         $.get('/Sale/Advance/List/'+FromDate+'/'+ToDate,function(data)
            {
                var t = $('#AdvanceTable').DataTable();
                t.clear().draw();
                var k = JSON.parse(data.Main);                                
                var quan=JSON.parse(data.total);
                var due=JSON.parse(data.Due);
                //alert(quan[1]);

                for (i = 0; i < k.length; i++)
                {
                    var dateadvance=new Date(k[i].created_at);
                    var DDD=new Date(k[i].created_at);
                    var Year=DDD.getFullYear();
                    var  Months=DDD.getMonth()+1;
                    var  Days=DDD.getDate();
                    var Hour=DDD.getHours();
                    var Minute=DDD.getMinutes();
                    var meridian="AM";
                    Hour=DDD.getHours();
                        if(Hour>12)
                        {
                            Hour=Hour-12;
                            meridian="PM";
                        }

                        //month=dateadvance.getMonth()+1;
                        if(Months<10)
                        {
                            Months="0"+Months;
                        }
                        if(Minute<10)
                        {
                            Minute="0"+Minute;
                        }
                    month=dateadvance.getMonth()+1;
                    if(month<10)
                    {
                        month="0"+month;
                    }
                    var DelivaryDDD=new Date(k[i].DeliveryDate);
                    var DelivaryYear=DelivaryDDD.getFullYear();
                    var  DelivaryMonths=DelivaryDDD.getMonth()+1;
                    var  DelivaryDays=DelivaryDDD.getDate();
                    var  DelivaryHour=DelivaryDDD.getHours();
                    var DelivaryMinute=DelivaryDDD.getMinutes();
                    var Delivarymeridian="AM";
                    DelivaryHour=DelivaryDDD.getHours();
                        if(DelivaryHour>12)
                        {
                            DelivaryHour=DelivaryHour-12;
                            Delivarymeridian="PM";
                        }

                        //month=dateadvance.getMonth()+1;
                        if(DelivaryMonths<10)
                        {
                            DelivaryMonths="0"+DelivaryMonths;
                        }
                        if(Minute<10)
                        {
                            DelivaryMinute="0"+DelivaryMinute;
                        }

                    t.row.add( [
                    '<input type="hidden" name="AdvanceCustomerName[]" class="AdvanceCustomerName" value="'+k[i].Name+'">'+
                    '<td>'+k[i].Name+'</td>',
                    
                    '<td>'+k[i].Phone+'</td>',
                    '<td>'+k[i].Amount+'<input type="hidden" name="AdvanceValue[]" value="'+k[i].Amount+'" ></td>',
                    '<td>'+due[i]+'</td>',
                    '<td>'+quan[i]+'</td>',
                    '<td>'+Days+'/'+Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</td>',
                    '<td>'+DelivaryDays+'/'+DelivaryMonths+'/'+DelivaryYear+' '+DelivaryHour+':'+DelivaryMinute+''+Delivarymeridian+'</td>',
                    
                    '<td>'+k[i].Notes+'</td>',
                    '<td><button type="button" class="btn btn-primary  LoadAdvance  " value="Load" name="LoadAdvance[]"><i class="fa fa-plus fa-lg"></i></button> <button type="button" class="btn btn-danger   AdvanceDelete  " name="AdvanceDelete[]"><i class="fa fa-trash-o fa-lg"></i></button> <button class="btn btn-success   AdvancePrint"  name="AdvancePrint[]"><i class="fa fa-print fa-lg"></i></button> <button class="AdvanceDetails btn   btn-info" name="AdvanceDetails[]"><i class="fa fa-info fa-lg"></i></button><input type="hidden" name="AdvanceID[]" value="'+k[i].ID+'"</td>'  

                    ] ).draw();
                }

                var url="AdvanceLoad";
                $.get('SalesRole/'+url,function(data)
                {
                    if(data==0)
                        $('.LoadAdvance').hide();
                });

                var url="AdvanceDelete";
                $.get('SalesRole/'+url,function(data)
                {
                    if(data==0)
                        $('.AdvanceDelete').hide();
                });

                var url="AdvancePrint";
                $.get('SalesRole/'+url,function(data)
                {
                    if(data==0)
                        $('.AdvancePrint').hide();
                });

                var url="AdvanceDetails";
                $.get('SalesRole/'+url,function(data)
                {
                    if(data==0)
                        $('.AdvanceDetails').hide();
                });



                

                


                $('#AdvanceTable').on('click','.AdvanceDelete',function()
                {
                    var index=$('[name="AdvanceDelete[]"]').index(this);
                    //alert(index);
                    $('#IndexForAdvanceDelete').val(index);
                    alertify.confirm('Advance Delete', 'Are you sure to delete advance ?', function(){
                        
                        var index=$('#IndexForAdvanceDelete').val();
                        var ID=$('input[name="AdvanceID[]"]').eq(index).val();
                        //alert(ID);
                        $.get('/Sale/Advance/Delete/'+ID,function(data)
                        {
                            index=$('#IndexForAdvanceDelete').val();
                            $('[name="AdvanceDelete[]"]').eq(index).closest("tr").remove();

                            //$('#PreviousAdvanceModal').modal('hide');
                            //$('body').removeClass('modal-open');
                            //$('.modal-backdrop').remove();
                
                        }); 
                    },function(){
                        alertify.error('Canceled !');
                    })

                               

                }); //End of Delete An Advanced List

                

                $('#AdvanceTable').on('click','.AdvanceDetails',function()
  
                {
                    var index = $('[name="AdvanceDetails[]"]').index(this);
                    var invoiceid = $('[name="AdvanceID[]"]').eq(index).val();
                    $.get('/Invoice/Advance/Details/'+invoiceid,function(data)
                    {
                        $('#AddAdvanceList').empty();
                        var ProductName=JSON.parse(data.ProductName);
                        var ProductID=JSON.parse(data.ProductID);
                        var ProductQuantity=JSON.parse(data.Qty);
                        var ProductPrice=JSON.parse(data.Price);
                        var ProductFinalPrice=JSON.parse(data.FinalPrice);
                        var ProductShop=JSON.parse(data.Shop);
                        var Discount=JSON.parse(data.Discount);
                        var TotalPrice=JSON.parse(data.TotalPrice);
                        var TotalTax=JSON.parse(data.Tax);
                        var AdvancePaid=JSON.parse(data.AdvancePaid);
                        var AdvanceDue=JSON.parse(data.Due);
                        var date=JSON.parse(data.DelivaryDate);
                        //alert(date);

                        for(i=0;i<ProductID.length;i++)
                        {
                        k=i+1;
                        Multiply=parseFloat(ProductPrice[i],10)*parseFloat(ProductQuantity[i],10);
                        //var Dis=parseFloat(Discount,10);
                        //var Real=Multiply-Dis;
                    
                        $('#AddAdvanceList').append('<tr><td>'+k+'</td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ProductShop[i]+']<br>'+
                            '['+ProductPrice[i]+'X'+ProductQuantity[i]+']</td><td>'+Multiply+'</td></tr>');
                        }

                        var Real=TotalPrice-TotalTax;


                        $('#AddAdvanceList').append('<tr><td><strong>Discount:</strong></td>'+
                        '<td><strong>'+Discount+'</strong></td></tr><tr><td><strong>SubTotal:</strong></td>'+
                        '<td><strong>'+Real+'</strong></td></tr><tr><td><strong>Total Tax:</strong></td>'+
                        '<td><strong>'+TotalTax+'</strong></td></tr><tr><td><strong>Total Price:</strong></td>'+
                        '<td><strong>'+TotalPrice+'</strong></td></tr><tr><td><strong>Advance Paid:</strong></td>'+
                        '<td><strong>'+AdvancePaid+'</strong></td></tr><tr><td><strong>Due:</strong></td>'+
                        '<td><strong>'+AdvanceDue+'</strong></td></tr><tr><td><strong>Delivary Date:</strong></td>'+
                        '<td><strong>'+date+'</strong></td></tr>');
                    //$('#PreviousSaleDetailsModal').modal('show');
                        

                        $('#PreviousAdvanceDetailsModal').modal('show');




                    });
                    //window.open("/Invoice/Advance/Print/" + invoiceid, "", "width=300,height=750,left=500");
                    
                });                


            });//End of AdvanceList Append Ajax
    }

    $('#AdvanceTable').on('click','.LoadAdvance',function()
    {
        var index=$('[name="LoadAdvance[]"]').index(this);
        var ID=$('input[name="AdvanceID[]"]').eq(index).val();
        var AdvanceAmount=$('input[name="AdvanceValue[]"]').eq(index).val();
        //alert(AdvanceAmount);

        $('#AdvanceAmountValue').val(AdvanceAmount);
        $('#AdvanceIDValue').val(ID);
        $.get('/Sale/Advance/'+ID,function(data)
        {

            //alert(data);
            var ProductList=JSON.parse(data.Productid);
            var QuantityList=JSON.parse(data.Productquan);
            //alert(QuantityList[0]);
            var ShopList=JSON.parse(data.Productshop);
            var DiscountList=JSON.parse(data.Productdiscount);
            var TotalDiscount=JSON.parse(data.TotalDiscount);
            $('#TotalDiscountforInvoiceforAdvance').val(TotalDiscount);
            //alert(TotalDiscount);

            var total=ProductList.length;
            //alert(total);
            if(total>0)
            {
                $('#PreviousAdvanceCheck').val(1);
            }

            //var shopid = $('#IDofTheShop').val();



            var Total=$('input[name="productid[]"]').length;
            for(i=0;i<Total;i++)
            {
                var q = $('input[name="productid[]"]').eq(i).closest('tr');
                q.hide();
                $('input[name="productid[]"]').eq(i).val(0);
                $('input[name="productid1[]"]').eq(i).val(0);
                $('input[name="productid2[]"]').eq(i).val(0);
            }



            //DeleteCartWithoutConfirm();

            for(i=0;i<total;i++)
            {
                AddProductToCart(ProductList[i],ShopList[i],QuantityList[i],DiscountList[i],0,0,TotalDiscount);
            }

            $('#PreviousAdvanceModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

        });            
    });

    $('#AdvanceTable').on('click','.AdvancePrint',function()
    {
        var index = $('[name="AdvancePrint[]"]').index(this);
        var invoiceid = $('[name="AdvanceID[]"]').eq(index).val();
        window.open("/Invoice/Advance/Print/" + invoiceid, "", "width=300,height=750,left=500");        
    });

    function HoldList()
    {
        var FromDate = $('#HoldFromDate').val();
        if(FromDate=="")
            FromDate="nofromdate";
        var ToDate = $('#HoldToDate').val();
        if(ToDate=="")
            ToDate="notodate";       
         $('#AddAdvance').empty();
         $('#SaleHoldList').empty();


         $.get('/Sale/Hold/List/'+FromDate+'/'+ToDate,function(data)
            {


                var t = $('#HoldTable').DataTable();
                t.clear().draw();


                var k = JSON.parse(data);
                //alert(k[0].Notes);
                for (i = 0; i < k.length; i++)
                {
                    ProductDetail=JSON.parse(k[i].Products);
                    total=ProductDetail.length;
                    IDs="";
                    for(m=0;m<total;m++)
                    {
                        if(m>0)
                        IDs=IDs.concat(',');

                        IDs=IDs.concat(ProductDetail[m].ProductID+"S"+ProductDetail[m].Shop);

                    }
                    //var datehold=new Date(k[i].created_at);
                    var DDD=new Date(k[i].created_at);
                    var Year=DDD.getFullYear();
                    var  Months=DDD.getMonth()+1;
                    var  Days=DDD.getDate();
                    var Hour=DDD.getHours();
                    var Minute=DDD.getMinutes();
                    var meridian="AM";
                    Hour=DDD.getHours();
                    if(Hour>12)
                    {
                        Hour=Hour-12;
                        meridian="PM";
                    }

                    //month=dateadvance.getMonth()+1;
                    if(Months<10)
                    {
                        Months="0"+Months;
                    }
                    if(Minute<10)
                    {
                        Minute="0"+Minute;
                    }
                    /*month=datehold.getMonth()+1;
                    if(month<10)
                    {
                        month="0"+month;
                    }
                    var meridian="AM";

                    hour=datehold.getHours();

                    if(hour>12)
                    {
                        hour=hour-12;
                        meridian="PM";
                    }*/


                     t.row.add( ['<tr>'+                
                    '<td><input type="hidden" '+
                        'readonly style="background:transparent;border:0px" name="HoldName[]" '+
                        'class="HoldName" value="' + k[i].Notes + '">'+
                        '<input type="hidden" name="HoldID[]" class="HoldID" value="'+k[i].ID+'">'+k[i].Notes+'</td>',
                    
                    '<td>'+IDs+'</td>',
                    '<td>'+Days+'/' +Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</td>',
                    '<td><button type="button" class="btn btn-success HoldLoad  " value="Load" name="HoldLoad[]">'+
                        '<i class="fa fa-plus fa-lg"></i></button> '+
                        '<button type="button" class="btn btn-primary   HoldDetails" name="HoldDetails[]">'+
                        '<i class="fa fa-info fa-lg"></i></button> '+
                        '<button type="button" class="btn btn-danger   HoldDelete'+
                        '  " name="HoldDelete[]"><i class="fa fa-trash-o fa-lg"></i>'+
                        '</button></td></tr>'
                  

                    ] ).draw();
                }


                var url="HoldLoad";
                $.get('SalesRole/'+url,function(data)
                {
                    if(data==0)
                        $('.HoldLoad').hide();
                });

                var url="HoldDetails";
                $.get('SalesRole/'+url,function(data)
                {
                    if(data==0)
                        $('.HoldLoad').hide();
                });

                var url="HoldDelete";
                $.get('SalesRole/'+url,function(data)
                {
                    if(data==0)
                        $('.HoldDelete').hide();
                });


                $('.HoldDetails').click(function()
                {
                    var Index=$('[name="HoldDetails[]"]').index(this);
                    var ID=$('input[name="HoldID[]"]').eq(Index).val();
                    $.get('/Sale/Hold/Details/'+ID,function(data)
                    {
                        $('#AddHoldList').empty();
                        var ProductID  =JSON.parse(data.ProductID);
                        var ProductName=JSON.parse(data.ProductName);
                        var ShopID     =JSON.parse(data.ShopID);
                        var Qty        =JSON.parse(data.Qty);
                        var Price      =JSON.parse(data.Price);
                        var Discount   =JSON.parse(data.Discount);
                        var TotalTax   =JSON.parse(data.Tax);
                        var TotalPrice =JSON.parse(data.TotalPrice);
                        //alert(TotalTax);

                        for(i=0;i<ProductID.length;i++)
                        {
                            k=i+1;

                            Multiply=parseFloat(Price[i],10)*parseFloat(Qty[i],10);
                            var Dis=parseFloat(Discount,10);
                            //var Real=Multiply-Dis;
                    
                        $('#AddHoldList').append('<tr><td>'+k+'</td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>'+
                            '['+Price[i]+'X'+Qty[i]+']</td><td>'+Multiply+'</td></tr>');
                        }

                        var Real=TotalPrice-TotalTax;
                        $('#AddHoldList').append('<tr><td><strong>Discount:</strong></td>'+
                        '<td><strong>'+Discount+'</strong></td></tr><tr><td><strong>SubTotal:</strong></td>'+
                        '<td><strong>'+Real+'</strong></td></tr><tr><td><strong>Total Tax:</strong></td>'+
                        '<td><strong>'+TotalTax+'</strong></td></tr><tr><td><strong>Total Price:</strong></td>'+
                        '<td><strong>'+TotalPrice+'</strong></td></tr>'+
                        
                        '</tr>');

                        $('#PreviousHoldDetailsModal').modal('show');


                    });
                });


                $('.HoldLoad').click(function()
                {
                
                    var Index=$('[name="HoldLoad[]"]').index(this);
                    var ID=$('input[name="HoldID[]"]').eq(Index).val();
                    $('#HoldIDValue').val(ID);
                    //alert(ID);


                    //var AdvanceAmount=$('input[name="AdvanceValue[]"]').eq(index).val();

                    //$('#AdvanceAmountValue').val(AdvanceAmount);
                    //$('#HoldIDValue').val(ID);
                    $.get('/Sale/Hold/Load/'+ID,function(data)
                    {
                        

                        var Total=$('input[name="productid[]"]').length;
                        for(i=0;i<Total;i++)
                        {
                            var q = $('input[name="productid[]"]').eq(i).closest('tr');
                            q.hide();
                            $('input[name="productid[]"]').eq(i).val(0);
                            $('input[name="productid1[]"]').eq(i).val(0);
                            $('input[name="productid2[]"]').eq(i).val(0);
                        }

                        //DeleteCartWithoutConfirm();

                        var ProductList=JSON.parse(data.Productid);
                        var Quan=JSON.parse(data.Productquan);
                        var Dis=JSON.parse(data.Productdiscount);
                        var Vat=JSON.parse(data.Productvat);
                        var Shopid = JSON.parse(data.Productshop);
                        var Count=ProductList.length;
                        for(i=0;i<Count;i++)
                        {
                            AddProductToCart(ProductList[i],Shopid[i],Quan[i],Dis[i],Vat[i]);
                        }

                        $('#SaleHoldListModal').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        //ValueReset();
                                                
                    });            
                
                });//End of Load Click Event

                $('.HoldDelete').click(function()
                {
                    var Index=$('[name="Load[]"]').index(this);
                    $('#IndexIDforHoldDelete').val(Index);
                    var ID=$('input[name="HoldID[]"]').eq(Index).val();
                    $('#HoldIDforDelete').val(ID);
                    
                    //var q = $('input[name="productid[]"]').eq(i).closest('tr');
                        alertify.confirm('Delete Hold', 'Are you sure to delete hold ?', function(){                        
                        //alert(ID);
                        ID=$('#HoldIDforDelete').val();
                        Ind=$('#IndexIDforHoldDelete').val();
                        var q =$('input[name="HoldID[]"]').eq(Ind).closest('tr');
                        q.hide();



                        $.get('/Sale/Hold/Delete/'+ID,function(data)
                        {
                            alertify.success("Hold Information successfully deleted!!!");
                            //$('#SaleHoldListModal').modal('hide');
                            //$('body').removeClass('modal-open');
                            //$('.modal-backdrop').remove();
                        });
                    }, function(){
                        alertify.error('Canceled !');
                    })
                });               

            });//End of AdvanceList Append Ajax
    }

    function OrderList()
    {
        var FromDate = $('#OrderFromDate').val();
        if(FromDate=="")
            FromDate="nofromdate";
        var ToDate = $('#OrderToDate').val();
        if(ToDate=="")
            ToDate="notodate";
        $('#OrderListBody').empty();


        $.get('/Sale/Order/List/'+FromDate+'/'+ToDate,function(data)
        {

            //alert(data);
            var t = $('#PendingOrdersList').DataTable();
            t.clear().draw();

            var CompletedOrder = $('#CompletedOrdersList').DataTable();
            CompletedOrder.clear().draw();
            var k = JSON.parse(data);
            for (i = 0; i < k.length; i++)
            {
                var dateorder=new Date(k[i].created_at);
                month=dateorder.getMonth()+1;
                if(month<10)
                {
                    month="0"+month;
                }
                var meridian="AM";

                hour=dateorder.getHours();

                if(hour>12)
                {
                    hour=hour-12;
                    meridian="PM";
                }

                if(k[i].IsInvoiced==1)
                {
                    CompletedOrder.row.add( ['<tr>'+

                     '<td>'+k[i].Name+'</td>',                
                     '<td>'+k[i].ID+'</td>',                
                     '<td>'+k[i].FirstName+'</td>',                
                     '<td>'+k[i].Guests+'<input type="hidden" '+
                        'name="OrderName[]" '+
                        'class="OrderName" value="' + k[i].Notes + '">'+
                        '<input type="hidden" name="OrderIDforList[]" class="OrderIDforList" value="'+k[i].ID+'"></td>',              
                    
                    
                    
                
                    '<td>'+dateorder.getDate()+"/"+month+"/"+dateorder.getFullYear()+" "+hour+":"+dateorder.getMinutes()+" "+meridian+'</td>',
                    '<td>'+k[i].Total+'</td>',
                    '<td>'+
                        '<button type="button" class="btn btn-success   OrderPrintforCompleted" name="OrderPrintforCompleted[]" title="Print Invoice"><i class="fa fa-print fa-lg"></i></button> <button type="button" class="btn btn-primary   OrderDetailsforCompleted" title="Details" name="OrderDetailsforCompleted[]">'+
                        '<i class="fa fa-info fa-lg"></i></button>'+                            
                        '</button><input type="hidden" name="InvoiceIDforCompletedOrder[]" class="InvoiceIDforCompletedOrder" value="'+k[i].InvoiceID+'"></td></tr>'                 

                    ] ).draw(); 
                }

                if(k[i].IsInvoiced==0)
                {
                    t.row.add( ['<tr>'+
                    '<td>'+k[i].Name+'</td>',                
                    '<td>'+k[i].ID+'</td>',                
                    '<td>'+k[i].FirstName+'</td>',                
                    '<td>'+k[i].Guests+'<input type="hidden" '+
                    'name="OrderName1[]" '+
                    'class="OrderName1" value="' + k[i].Notes + '">'+
                    '<input type="hidden" name="OrderIDforList1[]" class="OrderIDforList1" value="'+k[i].ID+'"></td>',                        
                    '<td>'+dateorder.getDate()+"/"+month+"/"+dateorder.getFullYear()+" "+hour+":"+dateorder.getMinutes()+" "+meridian+'</td>',
                    '<td>'+
                    '<button type="button" class="btn btn-success   OrderPrint1" name="OrderPrint1[]" title="Make Invoice"><i class="fa fa-arrow-right fa-lg"></i> <i class="fa fa-file-text fa-lg"></i></button> <button type="button" class="btn btn-primary   OrderDetails1" title="Details" name="OrderDetails1[]">'+
                    '<i class="fa fa-info fa-lg"></i></button> <button type="button" class="btn btn-warning   OrderTicket1" title="Ticket" name="OrderTicket1[]"><i class="fa fa-print fa-lg"></i></button> '+
                    '<button type="button" class="btn btn-danger   OrderDelete1  " title="Delete" name="OrderDelete1[]"><i class="fa fa-trash-o fa-lg"></i></button>'+
                    '</td></tr>'
                    ]).draw();
                }                    
            }
        });        
    }

    function PreviousInvoiceCreate()
    {
        var FromDate = $('#FromDate').val();
        if(FromDate=="")
            FromDate="nofromdate";

        var ToDate = $('#ToDate').val();
        if(ToDate=="")
            ToDate="notodate";

        $.get('/Sale/DateInvoice/'+FromDate+'/'+ToDate,function(data)
        {
            var k = JSON.parse(data);
            var t = $('#InvoiceListTable').DataTable();
            var unpaid = $('#InvoiceListTableforUnpaid').DataTable();
            t.clear().draw();
            unpaid.clear().draw();                    

            for (i = 0; i < k.length; i++)
            {
                
                    dateInvoice=new Date(k[i].updated_at);
                    var DDD=new Date(k[i].updated_at);
                    var Year=DDD.getFullYear();
                    var  Months=DDD.getMonth()+1;
                    var  Days=DDD.getDate();
                    var Hour=DDD.getHours();
                    var Minute=DDD.getMinutes();
                    var meridian="AM";
                    Hour=DDD.getHours();
                        if(Hour>12)
                        {
                            Hour=Hour-12;
                            meridian="PM";
                        }

                        //month=dateadvance.getMonth()+1;
                        if(Months<10)
                        {
                            Months="0"+Months;
                        }
                        if(Minute<10)
                        {
                            Minute="0"+Minute;
                        }
                //monthInvoice=dateInvoice.getMonth()+1;
                //if(monthInvoice<10)
                    //monthInvoice="0"+monthInvoice;

                if(k[i].IsPaid==1)
                {
                    t.row.add([
                    '<td> <input type="hidden" name="InvoiceID[]" '+
                    'class="InvoiceID" value="' + k[i].InvoiceID + '">'+k[i].InvoiceID+'</td>',
                    '<td>'+Days+'/' +Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</td>',
                    '<td>'+k[i].Total+'</td>',
                    '<td>'+k[i].PaidMoney+'</td>',
                    '<td>'+k[i].ReturnedMoney+'</td>',
                    '<td><button class="PPP btn btn-success   InvoicePrintPrevious"  name="InvoicePrintPrevious[]">'+
                    '<i class="fa fa-print fa-lg"></i></button> '+
                    '<button class="btn btn-info   InvoiceDetails" name="InvoiceDetails[]">'+
                    '<i class="fa fa-info fa-lg"></i></button></td'                    
                     ]).draw();

                }


                if(k[i].IsPaid==0)
                {
                    unpaid.row.add([
                    '<td> <input type="hidden" name="InvoiceID1[]" '+
                    'class="InvoiceID1" value="' + k[i].InvoiceID + '">'+k[i].InvoiceID+'</td>',
                    '<td><input name="OrderID1[]" class="OrderID1" type="hidden" value="'+k[i].OrderID+'">'+k[i].OrderID+'</td>',
                    '<td class="dateforinvoice1" name="dateforinvoice1[]">'+Days+'/' +Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</td>',
                    '<td>'+k[i].Total+'</td>',
                    
                    '<td><button class="btn btn-success   InvoicePrintPrevious1" type="button"  name="InvoicePrintPrevious1[]">'+
                    '<i class="fa fa-print fa-lg"></i></button> '+
                    '<button class="btn btn-info   InvoiceDetails1" type="button" name="InvoiceDetails1[]">'+
                    '<i class="fa fa-info fa-lg"></i></button></td>'                    
                    ]).draw();

                }       


                
            }

            var url="InvoicePrint";

            $.get('SalesRole/'+url,function(data)
            {
                if(data==0)
                    $('.InvoicePrint').hide();
            });

            var url="InvoiceDetails";

            $.get('SalesRole/'+url,function(data)
            {
                if(data==0)
                    $('.InvoiceDetails').hide();

            });

            $('#InvoiceListTable').on('click','.InvoiceDetails',function()
            {
                var index = $('[name="InvoiceDetails[]"]').index(this);
                var invoiceid = $('input[name="InvoiceID[]"]').eq(index).val();
                $.get('/Invoice/Sales/Details/'+invoiceid,function(data)
                {
                 $('#AddSaleList').empty();
                    var Details=JSON.parse(data.Total);
                    var Invoice=JSON.parse(data.Invoice);
                    //var Discount=JSON.parse(data.SubTotal);
                    //var TotalSub=JSON.parse(data.TotalSub);
                    //var Invoice=JSON.parse(data.Invoice);

                    for(i=0;i<Details.length;i++)
                    {
                        k=i+1;
                            var DDD=new Date(Details[i].created_at);
                            var Year=DDD.getFullYear();
                            //alert(Year);
                            var  Months=DDD.getMonth()+1;
                            var  Days=DDD.getDate();
                            var Hour=DDD.getHours();
                            var Minute=DDD.getMinutes();
                            var meridian="AM";
                            Hour=DDD.getHours();
                            if(Hour>12)
                            {
                                Hour=Hour-12;
                                meridian="PM";
                            }

                            //month=dateadvance.getMonth()+1;
                            if(Months<10)
                            {
                                Months="0"+Months;
                            }
                            if(Minute<10)
                            {
                                Minute="0"+Minute;
                            }

                        $('#AddSaleList').append('<tr><td>'+k+'</td><td>'+Details[i].ProductName+'['+Details[i].ProductID+'S'+Details[i].ShopID+']<br>['+Details[i].Price+'X'+Details[i].Qty+']</td><td>'+Details[i].Price*Details[i].Qty+'</td><td>'+Days+'/'+Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</td></tr>');
                    }

                    $('#AddSaleList').append('<tr><td><strong>Discount:</strong></td>'+
                    '<td><strong>'+Invoice.Discount+'</strong></td></tr><tr><td><strong>SubTotal:</strong></td>'+
                    '<td><strong>'+Invoice.SubTotal+'</strong></td></tr><tr><td><strong>TAX Total:</strong></td>'+
                    '<td><strong>'+Invoice.TaxTotal+'</strong></td></tr>'+
                    '<tr><td><strong>Total:</strong></td>'+
                    '<td><strong>'+Invoice.Total+'<strong></td></tr><tr>'+
                    '<td><strong>Paid Money:</strong></td>'+
                    '<td><strong>'+Invoice.PaidMoney+'</strong></td></tr>'+
                    '<tr><td><strong>Returned Money:</strong></td>'+
                    '<td><strong>'+Invoice.ReturnedMoney+'</storng></td></tr>');

                    $('#PreviousSaleDetailsModal').modal('show');
                });
            });//End of Invoice Details
        });       
    }

    $('#InvoiceListTable').on('click','.InvoicePrintPrevious',function()
    {
        var index = $('[name="InvoicePrintPrevious[]"]').index(this);
        var invoiceid = $('[name="InvoiceID[]"]').eq(index).val();
        window.open("/Invoice/Sales/Print/" + invoiceid, "", "width=300,height=750,left=500");
    });

    function PreviousRefundCreate()
    {
        var FromDate = $('#FromRefundDate').val();
        if(FromDate=="")
            FromDate="nofromdate";
        var ToDate = $('#ToRefundDate').val();
        if(ToDate=="")
            ToDate="notodate";

        $('#AddRefundInvoice').empty();
        $.get('/Sale/RefundInvoice/',function(data)
        {
            var k = JSON.parse(data.all);            
            var saleDate=JSON.parse(data.SaleDate);
            var xx=new Date(saleDate[0]);
                                 

            for (i = 0; i < k.length; i++)
            {
                
                dateInvoice=new Date(k[i].created_at);
                dateRefundInvoice=new Date(saleDate[i]);
                monthInvoice=dateInvoice.getMonth();
                monthRefundInvoice=dateRefundInvoice.getMonth();
                if(monthInvoice<10)
                    monthInvoice="0"+monthInvoice;
                if(monthRefundInvoice<10)
                    monthRefundInvoice="0"+monthRefundInvoice;

                if(k[i].InvoiceID>0)
                {
                  Year=dateRefundInvoice.getFullYear();
                  Month=monthRefundInvoice;
                  date=dateRefundInvoice.getDate();
                }
                else
                {
                    Year="----";
                    Month="--";
                    date="--";
                }


                $('#AddRefundInvoice').append('<tr><td>'+k[i].ProductID+'</td><td><input type="hidden" name="InvoiceID[]" class="invoiceID" value="' + k[i].InvoiceID + '">'+ k[i].InvoiceID +'</td>'+
                    '<td>'+Year+"-"+Month+"-"+date+'</td>'+
                    '<td>'+dateInvoice.getFullYear()+"-"+monthInvoice+"-"+dateInvoice.getDate()+'</td>'+
                    

                    '<td>' + k[i].Qty + '</td><td>'+k[i].TotalPrice+'</tr>');
            }

            var url="InvoicePrint";
            $.get('SalesRole/'+url,function(data)
            {
                if(data==0)
                    $('.InvoicePrint').hide();

            });
            $('.InvoicePrint').click(function()
            {
                var index = $('[name="InvoicePrint[]"]').index(this);
                var invoiceid = $('[name="InvoiceID[]"]').eq(index).val();
                window.open("Invoice/Sales/Print/" + invoiceid, "", "width=300,height=750,left=500");
            });
        });
    }        

    $('.AdvanceDelete').click(function()
    {
        alertify.confirm('Delete Advance', 'Are you sure to delete advance ?', function(){
        }, function(){
            alertify.error('Canceled !');
        })
    });               
             
    $('#ExpenseSubmit').click(function() 
    {
        var ExpenseCategory = $('#ExpenseCategory').val();
        var ExpenseUser = $('#ExpenseUser').val();
        var ExpenseValue = $('#ExpenseValue').val();
        var ExpenseNotes = $('#ExpenseNotes').val();
        if (ExpenseNotes == "") {
            ExpenseNotes = "Nothing";
        }

        $.get('ExpenseinSales/' + ExpenseCategory + '/' + ExpenseUser + '/' + ExpenseValue + '/' + ExpenseNotes, function(data)
        {            
            $('#NewExpense').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            alertify.success('<strong><i class="fa fa-check"></i> Expense Added Successfully ! </strong>');                
        });
    });



    $('#ClosingBalance').attr('disabled', false);

    $('#OpeningBalanceSubmit').on('click',function(e)
    {

        e.preventDefault();

        var BalanceValue = $('#OpeningBalanceValue').val();
        $('#OpeningBalance').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();

        $.get('/openingbalance/' + BalanceValue, function(data)
        {
            $('#EditingBalanceValue').val(BalanceValue);
            $('#CashDrawerID').val(data);
            $('#OpenBalance').hide();
            $('#EditFahadBalance').show();
            //$('#EditBalance').show();
            $('#CloseFahadBalance').show();
            $('.inner-content').removeClass('hidden');
        });

        alertify.success('<strong><i class="fa fa-check"></i> Balance Open Success !</strong>');
    });

    $('#EditingBalanceSubmit').on('click',function(e)
    {
        e.preventDefault();
        var BalanceValue = $('#EditingBalanceValue').val();
        var CashDrawerID = $('#CashDrawerID').val();

        $.get('editingbalance/' + BalanceValue + '/' + CashDrawerID, function(data)
        {
            $('#EditingBalanceValue').val(BalanceValue);
            alertify.success('<strong><i class="fa fa-check"></i> Balance Edit Success !</strong>');
        });

        $('#EditingBalance').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        //alertify.success('<strong><i class="fa fa-check"></i> Balance Edit Success !</strong>');
    });

    $('#CloseFahadBalance').click(function()
    {
        CloseBalance();         
    });

    // x = $('#DrawerTest').val();
    // if (x == "Edit") {
    //     $('#OpenBalance').hide();
    //     $('#EditBalance').show();
    //     $('#CloseBalance').show();                
    // }
    // if (x == "Open") {
    //     $('#EditFahadBalance').hide();
    //     $('#EditBalance2').hide();
    //     $('#CloseFahadBalance').hide();
    //     $('#OpenBalance').show();
    //     $('.inner-content').hide();
    //     $('#OpeningBalance').modal('show');
    // }


    // Key code for different actions
    // $(document).keyup(function(e) {
    //     e.preventDefault();

    //     //F2
    //     if (e.which == 113) {
    //         $('#ItemLookup').click();
    //     }

    //     //F4

    //     if (e.which == 115) {
    //         $('#refundsub').attr('disabled', true);
    //         $('#refund').click();
    //     }

    //     //F7

    //     if (e.which == 118) {

            
    //         var url="Discount";
    //         $.get('SalesRole/'+url,function(data)
    //         {
    //             if(data==1)
    //             {
    //                 $('#discount').click();
    //                 $('#disca').val(0);
    //                 $('#allpercent').val(0);
    //                 $('#disca').attr('disabled',false);
    //                 $('#allpercent').attr('disabled',false);
    //                 $('#DiscountModal').modal('show');
    //             }

    //         });            
    //     } 
         
    //      //F8
    //     if (e.which == 119) {

    //         url="Vat";
    //         code=119;
    //         $('#TaxModalOverAll').modal('show');               
    //     }

    //     //F9
    //     if (e.which == 120) {

    //         var custom=$('#customerid').val();

    //         if(custom>0)
    //             $('#SubmitTender').attr('disabled',false);
    //         if(custom==0)
    //             $('#SubmitTender').attr('disabled',true);
    //         $('#tender').click();
    //     }

    //     //F10
    //     if (e.which == 121)
    //     {
    //         $('#Advance').click();
    //     }

    //     if (e.keyCode === 27) {
    //         $('#Cancel').click();
    //     }
    // });

    var cc = 0;

    // Different Card Payment Options
    $('#CardSingle').click(function(e)
    {
        //e.preventDefault();
        //alert("I am Zakir Naik");
        $('#CardNumber').val('');
        $('#CardHolderName').val('');
        //var Index=$('[name="PaymentMethodCardNameButton[]"]').index(this);
    
        /*var MethodID=$('input[name="PaymentMethodCardID[]"]').eq(Index).val();
        var MethodName=$('input[name="PaymentMethodCardName[]"]').eq(Index).val();*/
        var Advalue        =$('#AdvanceAmountValue').val();
        $('.AdvanceCardArea').empty();

        //alert(Advalue);
        if(Advalue>0)
        {
            //AdvanceValue=convertedprice-Advalue;
            //$('#PayableCard').val(AdvanceValue);
                        $('.AdvanceCardArea').append('<div class="col-md-10>"><div class="form-group"><div class="col-xs-12">'+
                      '<h3><label class="label label-primary">Advance Paid:</label></h3>'+
                    '</div><div class="col-xs-12">'+
                    '<input type="text" readonly class="form-control" name="AdvancePaidinTheCard" value="'+Advalue+'">'+      
                      
                    '</div>'+
                  '</div></div>');

        }
        //$('#CardPaymentMethodID').val(MethodID);
        //$('#CardPaymentMethodName').val(MethodName);
        //$('#CardName').empty();
        //$('#CardName').append('<p class="label label-primary">'+MethodName+'</p>');       

        var MasterCheck=$('#customerid').val();
        MasterCheck=parseInt(MasterCheck);
        if(MasterCheck==0)
        {
            $('#CustomerCheck').hide();
        }
        else
        {

            $('#CustomerCheck').show();
        }
        // $('#PaymentMasterCardModal').modal('show');

        var Cust=$('#customerid').val();
        if (Cust > 0)
            $('#SubmitTenderCard').attr('disabled', true);
    }); 
    


    $('#refundsub').attr('disabled', true);
    $('#refundfooter').hide();

    cusi = $('customerid').val();

    if (cusi == 0) 
    {
        $('#SubmitTender').attr('disabled', true);
        $('#SubmitTenderCard').attr('disabled', true);
    }

    if (cusi > 0) 
    {
        $('#SubmitTender').attr('disabled', false);
        $('#SubmitTenderCard').attr('disabled', true);
        //alert(cusi);
    }

    $('#discount').click(function() 
    {
        $('#disca').val(0);
        $('#allpercent').val(0);
    });

    // Select Customer
    $('#example2').on('click','.cusselect',function()
    {

        var p = $('[name="cusselect[]"]').index(this);
        var qq = $('input[name="cusnam[]"]').eq(p).val();
        //alert(qq);
        $('#Customerid').val(qq);
        $('#customerid').val(qq);
        //alert($('#Customerid').val());        

        $.get('/Sales/Customer/Select/' + qq, function(data) {

            //$('#Customerid').val(qq);
            //$('#customerid').val(qq);

            $('#customername').empty();
            $('#customername').append('<a class="btn bg-aqua" data-toggle="modal" data-target="#CustomerModal" id="customer">' + data + '</a>');
        });

        $('.CustomerCheck').show();        
        $('#SubmitTender').attr('disabled',false);
        $('#CustomerModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });

    $('#example2').on('click','.cusdetail',function()
    {
        $('#CustomerName').empty();
        $('#modalcustomerdetail').empty();

        var p = $('[name="cusdetail[]"]').index(this);
        var qq = $('input[name="cusnam[]"]').eq(p).val();
        $.get('DetailsCustomer/' + qq, function(data) {            
            var l = JSON.parse(data);

            

            $('#CustomerName').append(l[0].FirstName + ' ' +l[0].LastName);

            document.getElementById('modalcustomerdetail').innerHTML = '<tr><td>Phone</td><td>' + l[0].Phone + '</td></tr><tr><td>Address</td><td>' + l[0].Address + '</td></tr><tr><td>City</td><td>' + l[0].City + '</td></tr><tr><td>Email</td><td>' + l[0].Email + '</td></tr><tr><td>Country</td><td>' + l[0].Country + '</td></tr><tr id="BirthRow"><td>DateOfBirth</td><td>' + l[0].DateOfBirth + '</td></tr><tr id="ImageRow"><td>Image</td><td><img src="/uploads/image/customer/' + l[0].CustomerImg + '" width=50 height=50></td></tr>';

            if(l[0].CustomerImg==null ||l[0].CustomerImg=="")
            {
              $('#ImageRow').hide();
            }

            if(l[0].DateOfBirth==null ||l[0].DateOfBirth=="")
            {
              $('#BirthRow').hide();
            }

            $('#CustomerDetailsModal').modal('show');

            //Select a customer from details 
            $('#SelectFromCustomerDetailsModal').click(function() {
                $.get('/Sales/Customer/Select/' + qq, function(data) {
                    $('#customername').empty();
                    $('#customername').append('<a class="btn bg-aqua" data-toggle="modal" data-target="#CustomerModal" id="customer">' + data + '</a>');
                });
                
                $('#cid').val(qq);
                $('#Customerid').val(qq);
                $('#customerid').val(qq);

                $('#CustomerModal').modal('hide');
                $('#CustomerDetailsModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            });
        });
    });

    // Reset Customer
    $('#CustomerReset').click(function()
    {

        //alertify.alert("You Cannot Reset a customer");
        $.get('Customer/Reset', function(data)
        {
            $('#customername').empty();
            $('#customername').append('<a class="btn bg-blue" data-toggle="modal" data-target="#CustomerModal" id="customer">Customer</a>');
            $('#Customerid').val(0);
            $('#customerid').val(0);
        });

        $('.CustomerCheck').hide();
        alertify.success('<strong><i class="fa fa-check"></i> Customer Reset Success !</strong>');
    });

    // Show uploaded image
    function readURL(input) 
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#CustomerImg").change(function() 
    {
        readURL(this);
    });

    // Overall Tax 
    $('.TaxSelectOverAll').click(function() 
    {
        var taxindex = $('input[name="TaxSelectOverAll[]"]').index(this);
        var taxvalue = parseInt($('input[name="TaxValue[]"]').eq(taxindex).val(), 10);
        var taxing = $('#TaxID').val();
        for (i = 0; i < cc; i++) {
            var Price=parseFloat($('[name="Price[]"]').eq(i).val(), 2);
            var TaxTotalforOverall=Price*taxvalue/100;
            $('input[name="Tax[]"]').eq(i).val(TaxTotalforOverall);
            $('input[name="tax1[]"]').eq(i).val(TaxTotalforOverall);
            $('input[name="tax[]"]').eq(i).val(TaxTotalforOverall);
            SingleProductPriceCalculation(i);
        }
        $('#TotalDiscountforInvoice').val(0);      
        TotalPriceCalculation();
        $('#TaxModalOverAll').modal("hide");
    });

    // Overall Tax Reset
    $('#OverallTaxReset').click(function() 
    {
        for (i = 0; i < cc; i++) {
            $('input[name="Tax[]"]').eq(i).val(0);
            $('input[name="tax[]"]').eq(i).val(0);
            SingleProductPriceCalculation(i);
        }
        $('#TotalDiscountforInvoice').val(0);      
        TotalPriceCalculation();
        $('#TaxModalOverAll').modal('hide');
    });

    // Overall Discount
    $('#discount').click(function() 
    {
        $('#disca').val(0);
        $('#allpercent').val(0);
        $('#disca').attr('disabled', false);
        $('#allpercent').attr('disabled', false);
    });

    $('#taukir').keyup(function() {
        var zz;
        var bip = parseInt($('#Payable').val(), 10);
        var aa = parseInt($('#taukir').val(), 10);
        zz = bip - aa;
        $('#zia').val(zz);
    });
    

    $('#allpercent').on('keyup click',function()
    {
      var DiscountZeroValueCheck=$('#allpercent').val();
      if(DiscountZeroValueCheck >0)
        $('#disca').attr('disabled', true);
      else
        $('#disca').attr('disabled', false);
    });

    $('#disca').on('keyup click',function()
    {
      var DiscountZeroValueCheck=$('#disca').val();
      if(DiscountZeroValueCheck >0)
        $('#allpercent').attr('disabled', true);
      else
        $('#allpercent').attr('disabled', false);
    });


    // Total discount calculate
    $('#OverAllDiscountForm').on('submit',function(e) 
    {
        
        $('#percent').val(0);
        e.preventDefault();
        var RealTotal=0;
        var allff = 0;
        var alldiscountpercentage = parseInt($('#allpercent').val(), 10);
        var allcash = parseInt($('#disca').val(), 10);

        for (rt = 0; rt < cc; rt++)
         {
            var productidvalue = $('input[name="productid[]"]').eq(rt).val();
                if (productidvalue != 0)
                     RealTotal=RealTotal+1;
         }
        var lesscash = allcash / RealTotal;
        lesscash = lesscash.toFixed(2);

        //alert(lesscash);
        var ttall = 0;
        if (allcash >= 0 && alldiscountpercentage == 0) {

            $('#AllDiscountforCash').val(allcash);
            for (i = 0; i < cc; i++) {
                var vv = lesscash;
                //alert(vv);
                $('input[name="discount[]"]').eq(i).val(vv);
                $('input[name="discount1[]"]').eq(i).val(vv);
                $('input[name="discount2[]"]').eq(i).val(vv);
                $('input[name="dismod[]"]').eq(i).val(vv);
                SingleProductPriceCalculation(i);
            }
        }
        if (alldiscountpercentage >= 0 && allcash == 0) {

            $('#DicountPercent').val(1);
            $('#AllDiscountforCash').val(0);
            for (i = 0; i < cc; i++) {
                var quanval = $('[name="total[]"]').eq(i).val();
                var vv = alldiscountpercentage * $('input[name="Price[]"]').eq(i).val() / 100*quanval;
                vv = vv.toFixed(2);
                $('input[name="discount[]"]').eq(i).val(vv);
                $('input[name="discount1[]"]').eq(i).val(vv);
                $('input[name="discount2[]"]').eq(i).val(vv);
                $('input[name="dismod[]"]').eq(i).val(vv);
                SingleProductPriceCalculation(i);
            }
        }

        $('#SingleDiscountforCash').val(0);
        $('#TotalDiscountforInvoice').val(0);

        TotalPriceCalculation();
        $('#DiscountModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });
    
    $('#CardHolderName').keyup(function() 
    {
        var cusi = $('#cid').val();
        if (cusi == "") {
            cusi = 0;
        }
        var namelength = $('#CardHolderName').val().length;
        var numberlength = $('#CardNumber').val().length;
        if (namelength > 0 && numberlength > 0) {
            $('#SubmitTenderCard').attr('disabled', false);
        } else
            $('#SubmitTenderCard').attr('disabled', true);
    });

    $('#PrintInvoice').click(function(e)
    {
        e.preventDefault();
        $('#SalesPanelInvoiceRecipt').empty();

        alertify.confirm("Make Invoice","Are you sure to generate invoice ?", function(){


            //e.preventDefault();
        var Advanvalue=parseFloat($('#AdvanceAmountValue').val(),10);
        var AdCheck=$('#LoadFromAdvanceWithoutReload').val();
        var vat = $('#taxoverall').val();
        //alert(vat);
        var discountall = parseFloat($('#discountoverall').val(),2).toFixed(2);
        $('#discountoverall').val(0);
        var subtotal = $('#subtotaloverall').val();
        //alert(subtotal);
        //var paidtender=parseFloat($('#Paid').val();
        //alert(paidtender);
        paidtender=0;
        //var AdvanTen=parseFloat($('#AdvanceAmountValue').val(),2);
        var Total=paidtender+Advanvalue;
        var paid = Total;
        var rrr = $('#Change').val();
        var cus = $('#Customerid').val();
        var InvID=$('#InvoiceIDforTender').val();
        var Advanvalue=$('#AdvanceAmountValue').val();
        var AdvanID   =$('#AdvanceIDValue').val();
        var OrderIDforTender=$('#OrderIDforInvoice').val();
        var PaidCash=$('#Paid').val();
        
        $('#CashSaleForm').append('<input type="hidden" name="OverAllTax" value="'+vat+'">');
        $('#CashSaleForm').append('<input type="hidden" name="AdvancePaymentValue" value="'+Advanvalue+'">');
        $('#CashSaleForm').append('<input type="hidden" name="AdvanceIDValue" value="'+AdvanID+'">');
        $('#CashSaleForm').append('<input type="hidden" name="OverAllDiscount" value="'+discountall+'">');
        $('#CashSaleForm').append('<input type="hidden" name="OverAllSubTotal" value="'+subtotal+'">');
        $('#CashSaleForm').append('<input type="hidden" name="Paid" value="'+PaidCash+'" >');
        $('#CashSaleForm').append('<input type="hidden" name="InvoiceCheck" value="'+InvID+'">');
        $('#CashSaleForm').append('<input type="hidden" name="Change" value="'+rrr+'">');
        $('#CashSaleForm').append('<input type="hidden" name="customer" value="'+cus+'">');
        $('#CashSaleForm').append('<input type="hidden" name="Order" value="'+OrderIDforTender+'">');
        $('#CashSaleForm').append('<input type="hidden" name="invtest" value="1">');
        
         var totalQuan=$('input[name="total[]"]').length;

         for(i=0;i<cc;i++)
        {
            var Firstquan=parseInt($('input[name="total[]"]').eq(i).val(),10);

            var ID=$('input[name="productid[]"]').eq(i).val();
            var Name=$('input[name="productname[]"]').eq(i).val();
            var Price=$('input[name="Price[]"]').eq(i).val();
            var discount=$('input[name="discount[]"]').eq(i).val();
            var Final=$('input[name="final[]"]').eq(i).val();
            var Shop=$('input[name="Shop[]"]').eq(i).val();
            var Tax=$('input[name="tax[]"]').eq(i).val();
            var TaxValue=$('input[name="taxvalue1[]"]').eq(i).val();              

            if(ID!=0)
            {
                $('#CashSaleForm').append('<input type="hidden" name="total3[]" class="total3" value="'+Firstquan+'">');
                $('#CashSaleForm').append('<input type="hidden" name="productid3[]" class="productid3" value="'+ID+'">');
                $('#CashSaleForm').append('<input type="hidden" name="productname3[]" class="productname" value="'+Name+'">');
                $('#CashSaleForm').append('<input type="hidden" name="Price3[]" class="Price3" value="'+Price+'">');
                $('#CashSaleForm').append('<input type="hidden" name="discount3[]" class="discount3" value="'+discount+'">');
                $('#CashSaleForm').append('<input type="hidden" name="final3[]" class="final3" value="'+Final+'">');
                $('#CashSaleForm').append('<input type="hidden" name="Shop3[]" class="Shop3" value="'+Shop+'">');
                $('#CashSaleForm').append('<input type="hidden" name="tax3[]" class="tax3" value="'+Tax+'">');
                $('#CashSaleForm').append('<input type="hidden" name="taxvalue3[]" class="taxvalue3" value="'+TaxValue+'">');
                
                //$('#CashSaleForm').append('<input type="hidden" name="total3[]" class="total3" value="'+Firstquan+'">');

            }
            
            //alert(Firstquan);
            //$('#CashSaleForm').append('')
            //$('input[name="total1[]"]').eq(i).val(Firstquan);
        }

        

       
        $("#myform").find(":input").clone().appendTo("#CashSaleForm");
         $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
        })
        e.preventDefault(e);

        $.ajax({

        type:"POST",
        url:'/Sale/Invoice',
        data:$('#CashSaleFormSubmit').serialize(),
        success: function(data)
        {
            //$('#LoadFromKOT').val(0);
            ItemQty=JSON.parse(data.ItemQty);
            FinalPrice=JSON.parse(data.FinalPrice);
            Price=JSON.parse(data.Price);
            ProductName=JSON.parse(data.ProductName);
            productid=JSON.parse(data.productid);
            Qty=JSON.parse(data.Qty);
            discount=JSON.parse(data.discount);
            User=JSON.parse(data.User);
            tt=JSON.parse(data.tt);
            paid=JSON.parse(data.paid);
            returned=JSON.parse(data.returned);
            Shop=JSON.parse(data.Shop);
            CustomerName=JSON.parse(data.CustomerName);
            vat=JSON.parse(data.vat);
            TotalDiscount=JSON.parse(data.TotalDiscount);
            subtotaltotal=JSON.parse(data.subtotaltotal);
            Invoice=JSON.parse(data.Invoice);
            InWords=JSON.parse(data.InWords);

            ProductID=JSON.parse(data.ProductID);
            ShopFooter=JSON.parse(data.ShopFooter);
            ShopID=JSON.parse(data.ShopID);
            AdvanceValue=JSON.parse(data.AdvanceValue);
            AdvanceValue=Math.floor(AdvanceValue);
            //CashAmount=JSON.parse(data.CashAmount);
            //CashAmount=Math.floor(CashAmount);
            CustomerPreviousBalance=JSON.parse(data.CustomerPreviousBalance);
            CustomerCurrentBalance=JSON.parse(data.CustomerCurrentBalance);
            CustomerTotalBalance=JSON.parse(data.CustomerTotalBalance);
            Author=JSON.parse(data.Author);
            Currency=JSON.parse(data.Currency);

            Order=JSON.parse(data.Order);
            $('#CurrencySymb').val(Currency);

            var DDD=new Date(Invoice.updated_at);
            var Year=DDD.getFullYear();
            var  Months=DDD.getMonth()+1;
            var  Days=DDD.getDate();
            var Hour=DDD.getHours();
            var Minute=DDD.getMinutes();
            var meridian="AM";
            Hour=DDD.getHours();
            if(Hour>12)
            {
                Hour=Hour-12;
                meridian="PM";
            }

            //month=dateadvance.getMonth()+1;
            if(Months<10)
            {
                Months="0"+Months;
            }
            if(Minute<10)
            {
                Minute="0"+Minute;
            }

            var DDDNow=new Date();
            var YearNow=DDDNow.getFullYear();
            var  MonthsNow=DDDNow.getMonth()+1;
            var  DaysNow=DDDNow.getDate();
            var HourNow=DDDNow.getHours();
            var MinuteNow=DDDNow.getMinutes();
            var meridianNow="AM";
            HourNow=DDDNow.getHours();
            if(HourNow>12)
            {
                HourNow=HourNow-12;
                meridianNow="PM";
            }

            //month=dateadvance.getMonth()+1;
            if(MonthsNow<10)
            {
                MonthsNow="0"+MonthsNow;
            }
            if(MinuteNow<10)
            {
                MinuteNow="0"+MinuteNow;
            }

             $('#SalesPanelInvoiceRecipt').append('<h4><i class="fa fa-shopping-bag fa-lg"></i> Sales Invoice</h4>'+
            '<hr>');
            if(Shop.ShopLogo!="")
            $('#SalesPanelInvoiceRecipt').append(' <img src="/uploads/image/shop/'+Shop.ShopLogo+'" width=70 height=70 class="col-md-offset-5 img img-responsive">');

            $('#SalesPanelInvoiceRecipt').append('<h4>'+Shop.ShopName+'</h4>');

            $('#SalesPanelInvoiceRecipt').append('<table>');
            if(Shop.ShopAddress!="")
                $('#SalesPanelInvoiceRecipt').append('<br><tr><td>Address</td><td>:'+Shop.ShopAddress+'</td></tr>');
             if(Shop.Phone!="")
                $('#SalesPanelInvoiceRecipt').append('<br><tr><td>Phone</td><td>:'+Shop.Phone+'</td></tr>');

            if(Shop.Email!="")
                $('#SalesPanelInvoiceRecipt').append('<br><tr><td>Email</td><td>:'+Shop.Email+'</td></tr>');

            if(Shop.Website!="")
                $('#SalesPanelInvoiceRecipt').append('<br><tr><td>WebSite</td><td>:'+Shop.Website+'</td></tr>');

            if(Shop.VatRegNo!=""&&Shop.VatRegNo!=null)
                $('#SalesPanelInvoiceRecipt').append('<br><tr><td>Vat Reg</td><td>:'+Shop.VatRegNo+'</td></tr>');
            $('#SalesPanelInvoiceRecipt').append('</table>');
            $('#SalesPanelInvoiceRecipt').append('<hr>');
            $('#SalesPanelInvoiceRecipt').append('<table>');
            if(Order!=null)
            {
                $('#SalesPanelInvoiceRecipt').append('<tr><td> OrderID </td><td><strong>:'+Order.ID+'</strong><td> Table </td><td>:'+Order.Name+'</td></tr>');
                $('#SalesPanelInvoiceRecipt').append('<br><tr><td> Guest </td><td><strong>:'+Order.Guests+'</strong><td> Served By </td><td>:'+Order.FirstName+'</td></tr>');

            }
            
            
            $('#SalesPanelInvoiceRecipt').append('<br><tr><td>InvoiceID</td><td><strong>:'+Invoice.InvoiceID+'</strong></td>');
            $('#SalesPanelInvoiceRecipt').append('<br><tr><td>Invoice Date</td><td><strong>:'+Days+'/' +Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</strong></td>');
            $('#SalesPanelInvoiceRecipt').append('<br><tr><td>Print Date</td><td><strong>:'+DaysNow+'/' +MonthsNow+'/'+YearNow+' '+HourNow+':'+MinuteNow+''+meridianNow+'</strong></td>');
            $('#SalesPanelInvoiceRecipt').append('</table>');
            $('#SalesPanelInvoiceRecipt').append('<hr>');

            $('#SalesPanelInvoiceRecipt').append('<table><tr><th>#</th><th>Item/Description </th><th>Amount </th></tr>');
            var TotalQty=0;
            var SubTotal=0;

            for(i=0;i<ItemQty;i++)
            {
                j=i+1;
                FinalPrice=Qty[i]*Price[i];
                SubTotal   =SubTotal+FinalPrice;
                Qty[i]=Math.floor(Qty[i]); 
                TotalQty=TotalQty+Qty[i];
                if(Qty[i]>0)
                {
                   
                    if(discount[i]>0)
                    {
                     $('#SalesPanelInvoiceRecipt').append('<br><tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']Dis-'+discount[i]+'<td>'+FinalPrice+'</td>');                        
                    }
                    if(discount[i]==0)
                     $('#SalesPanelInvoiceRecipt').append('<br><tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']<td>'+FinalPrice+'</td>');
                   
                }
            }
            $('#SalesPanelInvoiceRecipt').append('</table>');
            $('#SalesPanelInvoiceRecipt').append('<hr>Total Quantity: '+TotalQty+'<hr>');

            $('#SalesPanelInvoiceRecipt').append('<table>');
            $('#SalesPanelInvoiceRecipt').append('<tr><td>Sub Total</td><td> : <strong>'+Invoice.SubTotal+'</strong></td></tr>');
            if(Invoice.TaxTotal>0)
            $('#SalesPanelInvoiceRecipt').append('<br><tr><td>Tax Total</td><td> : <strong>'+Invoice.TaxTotal+'</strong></td></tr>');
            if(Invoice.ServiceCharge>0)           

            $('#SalesPanelInvoiceRecipt').append('<br><tr><td>ServiceCharge</td><td> : <strong>'+Invoice.ServiceCharge+'</strong></td></tr>');

            if(Invoice.Discount>0)
            $('#SalesPanelInvoiceRecipt').append('<br><tr><td>Discount</td><td> : <strong>'+Invoice.Discount+'</strong></td></tr>');
            $('#SalesPanelInvoiceRecipt').append('<br><tr><td>Total Due</td><td> : <strong>'+Invoice.Total+'</strong></td></tr>');
            if(AdvanceValue>0)
            {
                $('#SalesPanelInvoiceRecipt').append('<br><tr><td>Advance Paid:</td><td> : <strong>'+AdvanceValue+'</strong></td></tr>');
                $('#SalesPanelInvoiceRecipt').append('<br><tr><td>Cash Due:</td><td> : <strong>'+CashAmount+'</strong></td></tr>');

            }

            if(Invoice.IsPaid==1)
            {
                $('#SalesPanelInvoiceRecipt').append('<br><tr><td colspan="2"><hr></td></tr>');
                if(Invoice.PaidMoney>0)
                {
                $('#SalesPanelRecipt').append('<br><tr><td>Total Paid:</td><td> : <strong>'+Invoice.PaidMoney+'</strong></td></tr>');


                }
                if(Invoice.ReturnedMoney>0)
                {
                $('#SalesPanelInvoiceRecipt').append('<br><tr><td>Changes:</td><td> : <strong>'+Invoice.ReturnedMoney+'</strong></td></tr>');


                }

            } 



            $('#SalesPanelInvoiceRecipt').append('</table>');

            $('#SalesPanelInvoiceRecipt').append('<p class="InWords" style="text-transform: capitalize;">'+InWords+' '+Currency+' Only</p>');
            if(CustomerName!="Annonymous")
            {
                $('#SalesPanelInvoiceRecipt').append('<hr><table><tr><td>Customer</td><td>|'+CustomerName+'</td></tr>');
                if(CustomerPreviousBalance>0)
                {
                $('#SalesPanelInvoiceRecipt').append('<br><tr><td>Previous Due</td><td>|'+CustomerPreviousBalance+'</td></tr>');


                }

                if(CustomerCurrentBalance>0)
                {
                $('#SalesPanelInvoiceRecipt').append('<br><tr><td>Current Due</td><td>|'+CustomerCurrentBalance+'</td></tr>');
                $('#SalesPanelInvoiceRecipt').append('<br><tr><td>Total Due</td><td>|'+CustomerTotalBalance+'</td></tr>');


                }

                $('#SalesPanelInvoiceRecipt').append('</table>');
            }

            if(ShopFooter!="")
            {
                $('#SalesPanelInvoiceRecipt').append('<hr><div class="InvoiceFooter">'+ShopFooter.Footer+'<div>')
            }

            $('#SalesPanelInvoiceRecipt').append(' <hr>Have a nice Day ! | <span class="">'+User.FirstName+'</span><hr>');
            $('#SalesPanelInvoiceRecipt').append(' <br><div class="company-info">Software By: <span class="TechLab">  '+Author+'</span>  01614777555<hr>');
            
            e.preventDefault();
            var contents = document.getElementById("SalesPanelInvoiceRecipt").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            //frame1.style.position = "absolute";
            //frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
            frameDoc.document.open();
            //frameDoc.document.write('<html><head><title>DIV Contents</title>');
            //frameDoc.document.write('</head><body>');
            frameDoc.document.write(contents);
            //frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            document.body.removeChild(frame1);
            }, 500);

            $('#PrintInvoiceModal').modal('show');





        },
        error:function(data)
        {
            alert("Something Wrong Happened");

        }
        });
        //$("#CardProductArea").find(":input").clone().appendTo("#CashSaleForm");
        //window.open('',"TestWindow","width=297,height=700,left=500");
        //$('#CashSaleFormSubmit').submit();

        $('#discountoverall').val(0);
        SimpleCartClear();

        SubmitTest();
        TotalPriceCalculation();

        
        //}
        

        $.get('/Customer/Reset', function(data) {
                $('#Customerid').val(0);
                $('#customerid').val(0);
                $('#customername').empty();
                $('#customername').append('<a class="btn bg-blue" data-toggle="modal" data-target="#CustomerModal" id="customer">Customer</a>');
            });
        // $('#PaymentCashModalShow').modal('hide');
        //$('#PaymentMasterCardModal').modal('hide');
        
        $('#CashModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        
        var AdIDValue=$('#AdvanceIDValue').val();            
          
          if(AdIDValue>0)
          {
            $.get('/Sale/Advance/Complete/'+IDValue,function(data)
                {
                    $('#ImranKhan').val("I am Wasim Akram");
                });

          }

          var HoldIDVal=$('#HoldIDValue').val();

          if(HoldIDVal>0)
          {
            $.get('/Sale/Hold/Delete/'+HoldIDVal,function(data)
            {


            });
          }


         //$('#ImranKhan').val("I am Saeed Anwar");

         $('#GrossFooterRow').empty();
          $('#AdvanceAmountValue').val(0);

          //$('#add').hide();


        $('#myformProductList').empty();
        $('#add').empty();
        
        ValueReset();
        }, function(){
            alertify.error("Canceled !");
        });            
    });

    // Card Payment Status
    $('#myformcard').submit(function(e) 
    {
        e.preventDefault();
        var cardnumber = $('#CardNumber').val();
        var cardholdername = $('#CardHolderName').val();
        var cus=$('#customerid').val();
        var total=$('#PayableCard').val();
        var Advanvalue=parseFloat($('#AdvanceAmountValue').val(),10);

        if(cus>0)
        {
            var cardamountpaid = parseInt($('#CardAmountShow').val(),10);
            if(cardamountpaid>total)
                cardamountpaid=total;
            
        }
        if(cus==0)
        {
            cardamountpaid=total;
        }

        
        var AdCheck=$('#LoadFromAdvanceWithoutReload').val();
        var vat = $('#taxoverall').val();
        //alert(vat);
        var discountall = parseFloat($('#discountoverall').val(),2).toFixed(2);
        $('#discountoverall').val(0);
        var subtotal = $('#subtotaloverall').val();
        //alert(subtotal);
        //var paidtender=parseFloat($('#Paid').val();
        //alert(paidtender);
        paidtender=0;
        //var AdvanTen=parseFloat($('#AdvanceAmountValue').val(),2);
        var Total=total+Advanvalue;
        var paid = Total;
        //var rrr = $('#Change').val();
        var rrr = cardamountpaid-total;

        var cus = $('#Customerid').val();
        var InvID=$('#InvoiceIDforTender').val();
        var Advanvalue=$('#AdvanceAmountValue').val();
        var AdvanID   =$('#AdvanceIDValue').val();
        var OrderIDforTender=$('#OrderIDforInvoice').val();
        var OrderIDforOrderUpdate=$('#OrderIDforOrderUpdate').val();
        var PaidCash=$('#Paid').val();

        for(i=0;i<cc;i++)
        {
            var Firstquan=parseInt($('input[name="total[]"]').eq(i).val(),10);

            var ID=$('input[name="productid[]"]').eq(i).val();
            var Name=$('input[name="productname[]"]').eq(i).val();
            var Price=$('input[name="Price[]"]').eq(i).val();
            var discount=$('input[name="discount[]"]').eq(i).val();
            var Final=$('input[name="final[]"]').eq(i).val();
            var Shop=$('input[name="Shop[]"]').eq(i).val();
            var Tax=$('input[name="tax[]"]').eq(i).val();
            var TaxValue=$('input[name="taxvalue1[]"]').eq(i).val();              

            if(ID!=0)
            {
                $('#SingleCardBody').append('<input type="hidden" name="total1[]" class="total3" value="'+Firstquan+'">');
                $('#SingleCardBody').append('<input type="hidden" name="productid1[]" class="productid3" value="'+ID+'">');
                $('#SingleCardBody').append('<input type="hidden" name="productname1[]" class="productname" value="'+Name+'">');
                $('#SingleCardBody').append('<input type="hidden" name="Price1[]" class="Price3" value="'+Price+'">');
                $('#SingleCardBody').append('<input type="hidden" name="discount1[]" class="discount3" value="'+discount+'">');
                $('#SingleCardBody').append('<input type="hidden" name="final1[]" class="final3" value="'+Final+'">');
                $('#SingleCardBody').append('<input type="hidden" name="Shop1[]" class="Shop3" value="'+Shop+'">');
                $('#SingleCardBody').append('<input type="hidden" name="tax1[]" class="tax3" value="'+Tax+'">');
                $('#SingleCardBody').append('<input type="hidden" name="taxvalue1[]" class="taxvalue3" value="'+TaxValue+'">');
            }
        }
        
        $('#SingleCardBody').append('<input type="hidden" name="OverAllTax" value="'+vat+'">');
        $('#SingleCardBody').append('<input type="hidden" name="AdvancePaymentValue" value="'+Advanvalue+'">');
        $('#SingleCardBody').append('<input type="hidden" name="AdvanceIDValue" value="'+AdvanID+'">');
        $('#SingleCardBody').append('<input type="hidden" name="OverAllDiscount" value="'+discountall+'">');
        $('#SingleCardBody').append('<input type="hidden" name="OverAllSubTotal" value="'+subtotal+'">');
        $('#SingleCardBody').append('<input type="hidden" name="Paid" value="'+PaidCash+'" >');
        $('#SingleCardBody').append('<input type="hidden" name="InvoiceCheck" value="'+InvID+'">');
        $('#SingleCardBody').append('<input type="hidden" name="Change" value="'+rrr+'">');
        $('#SingleCardBody').append('<input type="hidden" name="customer" value="'+cus+'">');
        $('#SingleCardBody').append('<input type="hidden" name="Order" value="'+OrderIDforTender+'">');
        $('#SingleCardBody').append('<input type="hidden" name="OrderforUpdate" value="'+OrderIDforOrderUpdate+'">');

        $('#SingleCardBody').append('<input type="hidden" name="returned" value="'+cardamountpaid+'">');
        $('#SingleCardBody').append('<input type="hidden" name="CardNumber" value="'+cardnumber+'">');
        $('#SingleCardBody').append('<input type="hidden" name="CardHolderName" value="'+cardholdername+'">');
        $('#SingleCardBody').append('<input type="hidden" name="CardPaid" value="'+cardamountpaid+'">');
        $('#SingleCardBody').append('<input type="hidden" name="PaymentMethodID" value="1">');

        //$("#add").find(":input").clone().appendTo("#SingleCardBody");

        var cardamountpayable = $('#PayableCard').val();
        var method = $('#CardPaymentMethodID').val();
         $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
        })
        //e.preventDefault(e);

        $.ajax({

        type:"POST",
        url:'/Sale/Tender/SingleCard',
        data:$('#myformcard').serialize(),
        success:function(data)
        {
            
            ItemQty=JSON.parse(data.ItemQty);
            FinalPrice=JSON.parse(data.FinalPrice);
            Price=JSON.parse(data.Price);
            ProductName=JSON.parse(data.ProductName);
            productid=JSON.parse(data.productid);
            Qty=JSON.parse(data.Qty);
            discount=JSON.parse(data.discount);
            User=JSON.parse(data.User);
            tt=JSON.parse(data.tt);
            paid=JSON.parse(data.paid);
            returned=JSON.parse(data.returned);
            Shop=JSON.parse(data.Shop);
            CustomerName=JSON.parse(data.CustomerName);
            vat=JSON.parse(data.vat);
            TotalDiscount=JSON.parse(data.TotalDiscount);
            subtotaltotal=JSON.parse(data.subtotaltotal);
            Invoice=JSON.parse(data.Invoice);
            InWords=JSON.parse(data.InWords);
            ProductID=JSON.parse(data.ProductID);
            ShopFooter=JSON.parse(data.ShopFooter);
            ShopID=JSON.parse(data.ShopID);
            AdvanceValue=JSON.parse(data.AdvanceValue);
            AdvanceValue=Math.floor(AdvanceValue);
            CashAmount=JSON.parse(data.CashAmount);
            CashAmount=Math.floor(CashAmount);
            CustomerPreviousBalance=JSON.parse(data.CustomerPreviousBalance);
            CustomerPreviousBalance=Math.floor(CustomerPreviousBalance);
            CustomerCurrentBalance=JSON.parse(data.CustomerCurrentBalance);
            CustomerTotalBalance=JSON.parse(data.CustomerTotalBalance);
            Author=JSON.parse(data.Author);
            Currency=JSON.parse(data.Currency);
            MethodName=JSON.parse(data.MethodName);
            CardAmount=JSON.parse(data.CardAmount);

            $('#PrintRecipt').attr('disabled',false);


            TotalMethod=JSON.parse(data.MethodName);
            SingleCard=JSON.parse(data.SingleCard);
            $('#CurrencySymb').val(Currency);

            var DDD=new Date(Invoice.updated_at);
            var Year=DDD.getFullYear();
            var  Months=DDD.getMonth()+1;
            var  Days=DDD.getDate();
            var Hour=DDD.getHours();
            var Minute=DDD.getMinutes();
            var meridian="AM";
            Hour=DDD.getHours();
            if(Hour>12)
            {
                Hour=Hour-12;
                meridian="PM";
            }

            //month=dateadvance.getMonth()+1;
            if(Months<10)
            {
                Months="0"+Months;
            }
            if(Minute<10)
            {
                Minute="0"+Minute;
            }

            var DDDNow=new Date();
            var YearNow=DDDNow.getFullYear();
            var  MonthsNow=DDDNow.getMonth()+1;
            var  DaysNow=DDDNow.getDate();
            var HourNow=DDDNow.getHours();
            var MinuteNow=DDDNow.getMinutes();
            var meridianNow="AM";
            HourNow=DDDNow.getHours();
            if(HourNow>12)
            {
                HourNow=HourNow-12;
                meridianNow="PM";
            }

            //month=dateadvance.getMonth()+1;
            if(MonthsNow<10)
            {
                MonthsNow="0"+MonthsNow;
            }
            if(MinuteNow<10)
            {
                MinuteNow="0"+MinuteNow;
            }



            $('#SalesPanelRecipt').append('<h4><i class="fa fa-shopping-bag fa-lg"></i> Sales Invoice</h4>'+
            '<hr>');
            if(Shop.ShopLogo!="")
            $('#SalesPanelRecipt').append(' <img src="/uploads/image/shop/'+Shop.ShopLogo+'" width=70 height=70 class="col-md-offset-5 img img-responsive">');

            $('#SalesPanelRecipt').append('<h4>'+Shop.ShopName+'</h4>');

            $('#SalesPanelRecipt').append('<table>');
            if(Shop.ShopAddress!="")
                $('#SalesPanelRecipt').append('<br><tr><td>Address</td><td>:'+Shop.ShopAddress+'</td></tr>');
             if(Shop.Phone!="")
                $('#SalesPanelRecipt').append('<br><tr><td>Phone</td><td>:'+Shop.Phone+'</td></tr>');

            if(Shop.Email!="")
                $('#SalesPanelRecipt').append('<br><tr><td>Email</td><td>:'+Shop.Email+'</td></tr>');

            if(Shop.Website!="")
                $('#SalesPanelRecipt').append('<br><tr><td>WebSite</td><td>:'+Shop.Website+'</td></tr>');

            if(Shop.VatRegNo!=""&&Shop.VatRegNo!=null)
                $('#SalesPanelRecipt').append('<br><tr><td>Vat Reg</td><td>:'+Shop.VatRegNo+'</td></tr>');
            $('#SalesPanelRecipt').append('</table>');
            $('#SalesPanelRecipt').append('<hr>');
            $('#SalesPanelRecipt').append('<table>');
            $('#SalesPanelRecipt').append('<tr><td>InvoiceID</td><td><strong>:'+Invoice.InvoiceID+'</strong></td>');
            $('#SalesPanelRecipt').append('<br><tr><td>Invoice Date</td><td><strong>:'+Days+'/' +Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</strong></td>');
            $('#SalesPanelRecipt').append('<br><tr><td>Print Date</td><td><strong>:'+DaysNow+'/' +MonthsNow+'/'+YearNow+' '+HourNow+':'+MinuteNow+''+meridianNow+'</strong></td>');
            $('#SalesPanelRecipt').append('</table>');
            $('#SalesPanelRecipt').append('<hr>');

            $('#SalesPanelRecipt').append('<table><tr><th>#</th><th>Item/Description </th><th>Amount </th></tr>');
            var TotalQty=0;
            var SubTotal=0;

            for(i=0;i<ItemQty;i++)
            {
                j=i+1;
                FinalPrice=Qty[i]*Price[i];
                SubTotal   =SubTotal+FinalPrice;
                Qty[i]=Math.floor(Qty[i]); 
                TotalQty=TotalQty+Qty[i];
                if(Qty[i]>0)
                {
                   
                    if(discount[i]>0)
                    {
                     $('#SalesPanelRecipt').append('<br><tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']Dis-'+discount[i]+'<td>'+FinalPrice+'</td>');                        
                    }
                    if(discount[i]==0)
                     $('#SalesPanelRecipt').append('<br><tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']<td>'+FinalPrice+'</td>');
                   
                }
            }
            $('#SalesPanelRecipt').append('</table>');
            $('#SalesPanelRecipt').append('<hr>Total Quantity: '+TotalQty+'<hr>');

            $('#SalesPanelRecipt').append('<table>');
            $('#SalesPanelRecipt').append('<tr><td>Sub Total</td><td> : <strong>'+Invoice.SubTotal+'</strong></td></tr>');
            if(Invoice.TaxTotal>0)
            $('#SalesPanelRecipt').append('<br><tr><td>Tax Total</td><td> : <strong>'+Invoice.TaxTotal+'</strong></td></tr>');
            if(Invoice.ServiceCharge>0)
            $('#SalesPanelRecipt').append('<br><tr><td>ServiceCharge</td><td> : <strong>'+Invoice.ServiceCharge+'</strong></td></tr>');
            if(Invoice.Discount>0)
            $('#SalesPanelRecipt').append('<br><tr><td>Discount</td><td> : <strong>'+Invoice.Discount+'</strong></td></tr>');
            $('#SalesPanelRecipt').append('<br><tr><td>Total Due</td><td> : <strong>'+Invoice.Total+'</strong></td></tr>');
            
            //for(i=0;i<TotalMethod;i++)
           // {
            $('#SalesPanelRecipt').append('<tr><td colspan="2"><hr></td></tr>');
            $('#SalesPanelRecipt').append('<tr><td>'+MethodName[0]+'</td><td>:<strong>'+CardAmount[0]+'</strong></td></tr>');
          

            //}

            if(AdvanceValue>0)
            {
                $('#SalesPanelRecipt').append('<br><tr><td>Advance Paid:</td><td> : <strong>'+AdvanceValue+'</strong></td></tr>');
                $('#SalesPanelRecipt').append('<br><tr><td>Cash Due:</td><td> : <strong>'+CashAmount+'</strong></td></tr>');

            }

            if(Invoice.IsPaid==1)
            {
                $('#SalesPanelRecipt').append('<br><tr><td colspan="2"><hr></td></tr>');
                if(Invoice.PaidMoney>0)
                {
                $('#SalesPanelRecipt').append('<br><tr><td>Total Paid:</td><td> : <strong>'+Invoice.PaidMoney+'</strong></td></tr>');


                }
                if(Invoice.ReturnedMoney>0)
                {
                $('#SalesPanelRecipt').append('<br><tr><td>Changes:</td><td> : <strong>'+Invoice.ReturnedMoney+'</strong></td></tr>');


                }

            } 



            $('#SalesPanelRecipt').append('</table>');

            $('#SalesPanelRecipt').append('<p class="InWords" style="text-transform: capitalize;">'+InWords+' '+Currency+' Only</p>');
            if(CustomerName!="Annonymous")
            {
                $('#SalesPanelRecipt').append('<hr><table><tr><td>Customer</td><td>|'+CustomerName+'</td></tr>');
                if(CustomerPreviousBalance>0)
                {
                $('#SalesPanelRecipt').append('<br><tr><td>Previous Due</td><td>|'+CustomerPreviousBalance+'</td></tr>');


                }

                if(CustomerCurrentBalance>0)
                {
                $('#SalesPanelRecipt').append('<br><tr><td>Current Due</td><td>|'+CustomerCurrentBalance+'</td></tr>');
                $('#SalesPanelRecipt').append('<br><tr><td>Total Due</td><td>|'+CustomerTotalBalance+'</td></tr>');


                }

                $('#SalesPanelRecipt').append('</table>');
            }

            if(ShopFooter!="")
            {
                $('#SalesPanelRecipt').append('<hr><div class="InvoiceFooter">'+ShopFooter.Footer+'<div>')
            }

            $('#SalesPanelRecipt').append(' <hr>Have a nice Day ! | <span class="">'+User.FirstName+'</span><hr>');
            $('#SalesPanelRecipt').append(' <div class="company-info">Software By: <span class="TechLab">  '+Author+'</span>  01614777555<hr>');
            
            //e.preventDefault();
            var contents = document.getElementById("SalesPanelRecipt").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
            frameDoc.document.open();
            //frameDoc.document.write('<html><head><title>DIV Contents</title>');
            //frameDoc.document.write('</head><body>');
            frameDoc.document.write(contents);
            //frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            document.body.removeChild(frame1);
            }, 500);


            $('#SubmitTenderCard').attr('disabled',true);
            PrintRecipt();

            

        },
        error:function(data)
        {
            alert("Wrong");
        }

        });

        var IDValue=$('#AdvanceIDValue').val();
        if(IDValue>0)
        {
            $.get('/Sale/Advance/Delete/'+IDValue,function(data)
            {

            });
        }
        var HoldIDVal=$('#HoldIDValue').val();

        if(HoldIDVal>0)
        {
            $.get('/Sale/Hold/Delete/'+HoldIDVal,function(data)
            {

            });
        }

        $('#AdvanceIDValue').val(0); 

        $.get('/Customer/Reset', function(data) {
            $('#Customerid').val(0);
            $('#customerid').val(0);
            $('#customername').empty();
            $('#customername').append('<a class="btn bg-blue" data-toggle="modal" data-target="#CustomerModal" id="customer">Customer</a>');
        });
        ValueReset();
        TotalPriceCalculation();

        //PaymentFromCard(cardnumber, cardholdername, cardamountpaid, cardamountpayable, method);
        //$('#CardNumber').val('');
        //$('#CardHolderName').val('');
    });        

    // Refund
    var RefundedRow=0;


    

    $('#formrefund').unbind('submit').submit(
    function(event) 
    {
        event.preventDefault(event);
        $('#refundsub').attr('disabled',true);            
        $('#RefProID').hide();
        $('#ree').hide();
        $('#refundfooter').hide();
        event.preventDefault();
        var RefundInvoiceID = $('#RefundID').val();
        $('#RefundID').val('');
        var RefundProductID=$('#RefundBarcodeID').val();

        //Condition for ProductID
        if(RefundInvoiceID=="" && RefundProductID!="")
        {
            $('#RefInvID').hide();
            $('#rasel').hide();
            $('#RefundforInvoice').hide();
            $('#RefProBody').show();
            $('#RefProID').show();
            $('#RefundProductIDFooter').show();
            $('#RefundProductByID').show();
            var BarcodeText = RefundProductID;
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
                var ShopID = BarcodeText[1];

                if(ShopID == '')
                {
                    alertify.error('<strong><i class="fa fa-exclamation-triangle"></i> Invalid Barcode Number!</strong>');
                }

                $.get('/Sale/Product/AddToCart/' + ProductID + '/' + ShopID, function(data) 
                {
                    var RefundRowCheck = 0;
                    var ProductInformation      = data.search;
                    var ShopQuantityInformation = data.total;
                    var l = JSON.parse(ShopQuantityInformation);
                    var k = JSON.parse(ProductInformation);
                    var count=k.length;

                    for (i = 0; i < RefundedRow; i++) 
                    {
                        var ProductCheck = $('input[name="refproid[]"]').eq(i).val();
                        var ShopCheck=     $('input[name="RefShop[]"]').eq(i).val();
                        if (ProductCheck == k[0].ProductID && ShopCheck==ShopID) 
                        {
                            RefundRowCheck = 1;
                            break;
                        }
                    }
                    $('#RefundProductByID').attr('disabled',false);


                    if(RefundRowCheck==0)
                    {
                        RefundedRow=RefundedRow+1;
                        $('#RefundforProduct').append('<tr >'+
                        '<td class=" " ><input type="hidden" name="refproid1[]" class="refproid1" readonly value="' + k[0].ProductID + '">'+k[0].ProductID+'</td>'+
                        '<td><input type="hidden" name="refpronam[]" class="refpronam text-center " readonly style="background:transparent;border:white;  " value="' + k[0].ProductName + '">'+k[0].ProductName+'</td>'+
                        '<td class="text-center" style=""><input type="number"  step=".0001" name="refqty1[]" min="0" max="'+l[0].Qty+'" class="refqty text-center" value="1" style="background:transparent;border:white;">'+
                        '</td><td class="text-center"><input type="hidden"  name="refprice[]" class="refprice text-center " value="' + k[0].SalePrice + '" readonly>'+k[0].SalePrice+'</td>'+
                        '<td><select class="RefundType" name="RefundType[]"><option value="Shop" selected>BackToShop</option><option value="Waste" class="btn btn-danger">Waste</option> </td>'+
                        '<td><input type="text" name="reason2[]" class="reason2" style="background:transparent;"><input type="text" name="RefShop[]" class="RefShop" value="'+ShopID+'"></td>'+
                        '<input type="hidden" name="inv[]" class="inv" value="0"><input type="hidden" name="dis[]" class="dis" value="0">'+
                        '<input type="hidden" name="price1[]" class="price1" value="0"><input type="hidden" id="text" name="checking[]" class="checking" value="' + 0 + '"></tr>');

                        $('#RefProBody').append('<tr >'+
                        '<td class=" " ><input type="hidden" name="refproid[]" class="refproid" readonly value="' + k[0].ProductID + '">'+k[0].ProductID+"S"+ShopID+'</td>'+
                        '<td><input type="hidden" name="refpronam[]" class="refpronam text-center " readonly style="background:transparent;border:white;  " value="' + k[0].ProductName + '">'+k[0].ProductName+'</td>'+
                        '<td class="text-center" style=""><input type="number" step=".0001"  name="refqty[]" min="0" max="'+k[0].Qty+'" class="refqty text-center" value="1" style="background:transparent;border:white;">'+
                        '</td><td class="text-center"><input type="hidden"  name="refprice[]" class="refprice text-center " value="' + k[0].SalePrice + '" readonly>'+k[0].SalePrice+'</td>'+
                        '<td><select class="RefundType form-control btn btn-success" name="RefundType[]"><option value="Shop" selected>BackToShop</option><option value="Waste" class="btn btn-danger">Waste</option> </td>'+
                        '<td><input type="text" name="reason3[]" class="reason3 form-control" style="background:transparent;"><input type="hidden" name="RefShop[]" class="RefShop" value="'+ShopID+'"></td>'+
                        '<td><button class="removebuttonrefund btn   btn-danger duck" type="button"    name="removebuttonrefund[]"><i class="fa fa-times"></button></td><input type="hidden" name="inv[]" class="inv" value="0"><input type="hidden" name="dis[]" class="dis" value="0">'+
                        '<input type="hidden" name="price[]" class="price" value="0"><input type="hidden" id="text" name="checking[]" class="checking" value="' + 0 + '"></tr>');                              
                    }
                    else
                    {
                        n = parseInt($('input[name="refqty[]"]').eq(i).val(), 10) + 1;
                    
                        $('input[name="refqty[]"]').eq(i).val(n);
                        $('input[name="refqty1[]"]').eq(i).val(n);
                    }

                    $('.removebuttonrefund').click(function()
                    {
                        var p = $('[name="removebuttonrefund[]"]').index(this);
                        $('input[name="refproid1[]"]').eq(p).val(0);                                
                        $('input[name="refproid[]"]').eq(p).val(0);                                
                        var q = $(this).closest('tr');
                        q.hide();
                    });

                    $('#RefundProductByID').unbind('click').click(function(e)
                    {
                        e.preventDefault();
                        
                        var RefundCustomer=$('#customerid').val();
                        var Method=$('#RefundPaymentMethod').val();
                        var total=$('input[name="refproid1[]"]').length;
                        $('#CustomerPaymentRefund').val('');

                        //Refund is used for Customer Due Clearence
                        if(RefundCustomer>0 && Method==1)
                        {
                            var TotalPriceRefund=0;
                            var total=$('input[name="refproid[]"]').length; 
                            for(i=0;i<total;i++)
                            {
                                var x=$('input[name="refproid[]"]').eq(i).val();
                                if(x>0)
                                {                                
                                    var SinglePrice=parseInt($('input[name="refprice[]"]').eq(i).val(),10)*parseInt($('input[name="refqty[]"]').eq(i).val(),10);
                                    TotalPriceRefund=TotalPriceRefund+SinglePrice;
                                }
                            }
                            
                            $('#CustomerRefundForm').val(TotalPriceRefund);
                            $.get('/Sales/Customer/Balance/'+RefundCustomer,function(data)
                            {
                                $('#CustomerBalance').val(data);
                                $('#CustomerBalanceForm').val(data);
                            });
                            
                            $('#CustomerBalancePayment').modal('show');
                            $('#customerpaymentsel').on('click',function(e)
                            {
                                e.preventDefault();
                                var PaymentValue;
                                PaymentValue=$('#CustomerPaymentRefund').val();
                                var RefundedValue=$('#CustomerRefundForm').val();
                                $('#RefundforProduct').append('<input type="hidden" name="CustomerPaymentByRefund" value="'+PaymentValue+'" >');
                                $('#RefundforProduct').append('<input type="hidden" name="CustomerTotalRefund" value="'+RefundedValue+'" >');
                                $.ajaxSetup({
                                header:$('meta[name="_token"]').attr('content')
                                })
                                e.preventDefault(e);

                                $.ajax({
                                type:"POST",
                                url:'/Sales/Refund/Product',
                                data:$('#RefundforProduct').serialize(),
                                success:function(data)
                                {
                                    $('#RefundPrint').attr('disabled',false);
                                    $('#RefundProductByID').attr('disabled',true);
                                    $('#RefundInvoicePrint').empty();

                                    totalPrice=JSON.parse(data.totalPrice);

                                    SubTotalPrice=JSON.parse(data.SubTotalPrice);
                                    totalTax=JSON.parse(data.totalTax);
                                    totalDiscount=JSON.parse(data.totalDiscount);
                                    FinalPrice=JSON.parse(data.FinalPrice);
                                    Price=JSON.parse(data.Price);
                                    ProductName=JSON.parse(data.ProductName);
                                    Qty=JSON.parse(data.Qty);
                                    discount=JSON.parse(data.discount);
                                    User=JSON.parse(data.User);
                                    ItemQty=JSON.parse(data.ItemQty);
                                    paid=JSON.parse(data.paid);
                                    returned=JSON.parse(data.returned);
                                    //Invoice=JSON.parse(data.Invoice);
                                    Shop=JSON.parse(data.Shop);
                                    cusname=JSON.parse(data.cusname);
                                    InWords=JSON.parse(data.InWords);
                                    ShopFooter=JSON.parse(data.ShopFooter);
                                    ProductID=JSON.parse(data.ProductID);
                                    ShopID=JSON.parse(data.ShopID);
                                    Currency=JSON.parse(data.Currency);
                                    CustomerPaymentByRefund=JSON.parse(data.CustomerPaymentByRefund);
                                    Change=totalPrice-CustomerPaymentByRefund;
                                    

                                    var DDDNow=new Date();
                                    var YearNow=DDDNow.getFullYear();
                                    var  MonthsNow=DDDNow.getMonth()+1;
                                    var  DaysNow=DDDNow.getDate();
                                    var HourNow=DDDNow.getHours();
                                    var MinuteNow=DDDNow.getMinutes();
                                    var meridianNow="AM";
                                    HourNow=DDDNow.getHours();
                                    if(HourNow>12)
                                    {
                                        HourNow=HourNow-12;
                                        meridianNow="PM";
                                    }

                                    //month=dateadvance.getMonth()+1;
                                    if(MonthsNow<10)
                                    {
                                        MonthsNow="0"+MonthsNow;
                                    }
                                    if(MinuteNow<10)
                                    {
                                        MinuteNow="0"+MinuteNow;
                                    }

                                    $('#RefundInvoicePrint').append('<h4><i class="fa fa-shopping-bag fa-lg"></i> Refund Invoice</h4>'+
                                    '<hr>');
                                    if(Shop.ShopLogo!="")
                                    $('#RefundInvoicePrint').append(' <img src="/uploads/image/shop/'+Shop.ShopLogo+'" width=70 height=70 class="col-md-offset-5 img img-responsive">');

                                    $('#RefundInvoicePrint').append('<h4>'+Shop.ShopName+'</h4>');

                                    $('#RefundInvoicePrint').append('<table>');
                                    if(Shop.ShopAddress!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>Address</td><td>:'+Shop.ShopAddress+'</td></tr>');
                                    if(Shop.Phone!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>Phone</td><td>:'+Shop.Phone+'</td></tr>');

                                    if(Shop.Email!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>Email</td><td>:'+Shop.Email+'</td></tr>');

                                    if(Shop.Website!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>WebSite</td><td>:'+Shop.Website+'</td></tr>');

                                    if(Shop.VatRegNo!=""&&Shop.VatRegNo!=null)
                                    $('#RefundInvoicePrint').append('<br><tr><td>Vat Reg</td><td>:'+Shop.VatRegNo+'</td></tr>');
                                    $('#RefundInvoicePrint').append('</table>');
                                    $('#RefundInvoicePrint').append('<hr>');
                                    $('#RefundInvoicePrint').append('<table>');
                                    //$('#RefundInvoicePrint').append('<tr><td>InvoiceID</td><td><strong>:'+Invoice.InvoiceID+'</strong></td>');
                                    //$('#RefundInvoicePrint').append('<tr><td>Invoice Date</td><td><strong>:'+Days+'/' +Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</strong></td>');
                                    $('#RefundInvoicePrint').append('<br><tr><td>Refund Date</td><td><strong>:'+DaysNow+'/' +MonthsNow+'/'+YearNow+' '+HourNow+':'+MinuteNow+''+meridianNow+'</strong></td>');
                                    $('#RefundInvoicePrint').append('</table>');
                                    $('#RefundInvoicePrint').append('<hr>');

                                    $('#RefundInvoicePrint').append('<table><tr><th>#</th><th>Item/Description </th><th>SubTotal</th></tr>');
                                    var TotalQty=0;
                                    var TotalQty=0;
                                    var SubTotal=0;

                                    for(i=0;i<ItemQty;i++)
                                    {
                                        j=i+1;
                                        FinalPrice=Qty[i]*Price[i];
                                        SubTotal   =SubTotal+FinalPrice;
                                        Qty[i]=Math.floor(Qty[i]); 
                                        TotalQty=TotalQty+Qty[i];
                                        if(Qty[i]>0)
                                        {
                                            Price[i]=Math.floor(Price[i]);
                                        //if(discount[i]>0)
                                        //{
                                        //$('#AdvanceInvoice').append('<tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']Dis-'+discount[i]+'<td>'+FinalPrice+'</td>');                        
                                        //}
                                        //if(discount[i]==0)
                                            $('#RefundInvoicePrint').append('<br><tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']<td>'+FinalPrice+'</td>');

                                        }
                                    }
                                    $('#RefundInvoicePrint').append('</table>');

                                    $('#RefundInvoicePrint').append('<table>');
                                    $('#RefundInvoicePrint').append('<br><tr><td>Sub Total</td><td> : <strong>'+SubTotalPrice+'</strong></td></tr>');
                                    if(totalDiscount>0)
                                    $('#RefundInvoicePrint').append('<br><tr><td>Discount</td><td> : <strong>'+totalDiscount+'</strong></td></tr>');
                                    if(totalTax>0)
                                    $('#RefundInvoicePrint').append('<br><tr><td>Tax Total</td><td> : <strong>'+totalTax+'</strong></td></tr>');
                                    
                                    
                                    $('#RefundInvoicePrint').append('<br><tr><td>Total</td><td> : <strong>'+totalPrice+'</strong></td></tr></table>');

                                    if(CustomerPaymentByRefund>0)
                                    {
                                         $('#RefundInvoicePrint').append('<table>');
                                         $('#RefundInvoicePrint').append('<tr><td><strong>Due Payment</strong></td><td>:<strong>'+CustomerPaymentByRefund+'</strong></td></tr>');
                                         $('#RefundInvoicePrint').append('<br><tr><td>Change</td><td>:<strong>'+Change+'<strong></td></tr></table>');

                                       
                                    }
                                    $('#RefundInvoicePrint').append('<p class="InWords" style="text-transform: capitalize;">'+InWords+ ' '+Currency+' Only</p>');
                                    
                                    if(cusname!="Anonymous")
                                    {
                                        $('#RefundInvoicePrint').append('<table><tr><td>Customer</td><td>:'+cusname+'</td></tr></table>');
                                    }
                                    if(ShopFooter!="")
                                    {
                                        $('#RefundInvoicePrint').append('<hr><div class="InvoiceFooter">'+ShopFooter.Footer+'<div>')
                                    }

                                        $('#RefundInvoicePrint').append(' <hr>Have a nice Day ! | <span class="">'+User.name+'</span><hr>');
                                        $('#RefundInvoicePrint').append(' <div class="company-info">Software By: <span class="TechLab">  '+Author+'</span>  01614777555<hr>');
                                        $('#RefundCheckforPayment').val(1);
                                        



                                    
                                },
                                error:function(data)
                                {

                                }

                            });
                                //window.open('',"RefundWindowforProduct","width=297,height=700,left=500");

                                //$('#RefundforProduct').submit();
                                $('#CustomerBalancePayment').modal('hide');
                                //$('body').removeClass('modal-open');
                                //$('.modal-backdrop').remove();


                            });
                        }
                        else
                        {
                            $.ajaxSetup({
                            header:$('meta[name="_token"]').attr('content')
                            })
                            e.preventDefault(e);

                            $.ajax({

                                type:"POST",
                                url:'/Sales/Refund/Product',
                                data:$('#RefundforProduct').serialize(),
                                success:function(data)
                                {
                                    //alert(data);
                                    $('#RefundPrint').attr('disabled',false);
                                    $('#RefundProductByID').attr('disabled',true);
                                    $('#RefundInvoicePrint').empty();

                                    totalPrice=JSON.parse(data.totalPrice);

                                    SubTotalPrice=JSON.parse(data.SubTotalPrice);
                                    totalTax=JSON.parse(data.totalTax);
                                    totalDiscount=JSON.parse(data.totalDiscount);
                                    FinalPrice=JSON.parse(data.FinalPrice);
                                    Price=JSON.parse(data.Price);
                                    ProductName=JSON.parse(data.ProductName);
                                    Qty=JSON.parse(data.Qty);
                                    discount=JSON.parse(data.discount);
                                    User=JSON.parse(data.User);
                                    ItemQty=JSON.parse(data.ItemQty);
                                    paid=JSON.parse(data.paid);
                                    returned=JSON.parse(data.returned);
                                    //Invoice=JSON.parse(data.Invoice);
                                    Shop=JSON.parse(data.Shop);
                                    cusname=JSON.parse(data.cusname);
                                    InWords=JSON.parse(data.InWords);
                                    ShopFooter=JSON.parse(data.ShopFooter);
                                    ProductID=JSON.parse(data.ProductID);
                                    ShopID=JSON.parse(data.ShopID);
                                    Currency=JSON.parse(data.Currency);
                                    CustomerPaymentByRefund=JSON.parse(data.CustomerPaymentByRefund);
                                    Change=totalPrice-CustomerPaymentByRefund;
                                    

                                    var DDDNow=new Date();
                                    var YearNow=DDDNow.getFullYear();
                                    var  MonthsNow=DDDNow.getMonth()+1;
                                    var  DaysNow=DDDNow.getDate();
                                    var HourNow=DDDNow.getHours();
                                    var MinuteNow=DDDNow.getMinutes();
                                    var meridianNow="AM";
                                    HourNow=DDDNow.getHours();
                                    if(HourNow>12)
                                    {
                                        HourNow=HourNow-12;
                                        meridianNow="PM";
                                    }

                                    //month=dateadvance.getMonth()+1;
                                    if(MonthsNow<10)
                                    {
                                        MonthsNow="0"+MonthsNow;
                                    }
                                    if(MinuteNow<10)
                                    {
                                        MinuteNow="0"+MinuteNow;
                                    }

                                    $('#RefundInvoicePrint').append('<h4><i class="fa fa-shopping-bag fa-lg"></i> Refund Invoice</h4>'+
                                    '<hr>');
                                    if(Shop.ShopLogo!="")
                                    $('#RefundInvoicePrint').append(' <img src="/uploads/image/shop/'+Shop.ShopLogo+'" width=70 height=70 class="col-md-offset-5 img img-responsive">');

                                    $('#RefundInvoicePrint').append('<h4>'+Shop.ShopName+'</h4>');

                                    $('#RefundInvoicePrint').append('<table>');
                                    if(Shop.ShopAddress!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>Address</td><td>:'+Shop.ShopAddress+'</td></tr>');
                                    if(Shop.Phone!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>Phone</td><td>:'+Shop.Phone+'</td></tr>');

                                    if(Shop.Email!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>Email</td><td>:'+Shop.Email+'</td></tr>');

                                    if(Shop.Website!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>WebSite</td><td>:'+Shop.Website+'</td></tr>');

                                    if(Shop.VatRegNo!=""&&Shop.VatRegNo!=null)
                                    $('#RefundInvoicePrint').append('<br><tr><td>Vat Reg</td><td>:'+Shop.VatRegNo+'</td></tr>');
                                    $('#RefundInvoicePrint').append('</table>');
                                    $('#RefundInvoicePrint').append('<hr>');
                                    $('#RefundInvoicePrint').append('<table>');
                                    //$('#RefundInvoicePrint').append('<tr><td>InvoiceID</td><td><strong>:'+Invoice.InvoiceID+'</strong></td>');
                                    //$('#RefundInvoicePrint').append('<tr><td>Invoice Date</td><td><strong>:'+Days+'/' +Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</strong></td>');
                                    $('#RefundInvoicePrint').append('<br><tr><td>Refund Date</td><td><strong>:'+DaysNow+'/' +MonthsNow+'/'+YearNow+' '+HourNow+':'+MinuteNow+''+meridianNow+'</strong></td>');
                                    $('#RefundInvoicePrint').append('</table>');
                                    $('#RefundInvoicePrint').append('<hr>');

                                    $('#RefundInvoicePrint').append('<table><tr><th>#</th><th>Item/Description </th><th>SubTotal</th></tr>');
                                    var TotalQty=0;
                                    var TotalQty=0;
                                    var SubTotal=0;

                                    for(i=0;i<ItemQty;i++)
                                    {
                                        j=i+1;
                                        FinalPrice=Qty[i]*Price[i];
                                        SubTotal   =SubTotal+FinalPrice;
                                        Qty[i]=Math.floor(Qty[i]); 
                                        TotalQty=TotalQty+Qty[i];
                                        if(Qty[i]>0)
                                        {
                                            Price[i]=Math.floor(Price[i]);
                                        //if(discount[i]>0)
                                        //{
                                        //$('#AdvanceInvoice').append('<tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']Dis-'+discount[i]+'<td>'+FinalPrice+'</td>');                        
                                        //}
                                        //if(discount[i]==0)
                                            $('#RefundInvoicePrint').append('<tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']<td>'+FinalPrice+'</td>');

                                        }
                                    }
                                    $('#RefundInvoicePrint').append('</table>');

                                    $('#RefundInvoicePrint').append('<table>');
                                    $('#RefundInvoicePrint').append('<tr><td>Sub Total</td><td> : <strong>'+SubTotalPrice+'</strong></td></tr>');
                                    if(totalDiscount>0)
                                    $('#RefundInvoicePrint').append('<br><tr><td>Discount</td><td> : <strong>'+totalDiscount+'</strong></td></tr>');
                                    if(totalTax>0)
                                    $('#RefundInvoicePrint').append('<br><tr><td>Tax Total</td><td> : <strong>'+totalTax+'</strong></td></tr>');
                                    
                                    
                                    $('#RefundInvoicePrint').append('<br><tr><td>Total</td><td> : <strong>'+totalPrice+'</strong></td></tr></table>');

                                    if(CustomerPaymentByRefund>0)
                                    {
                                         $('#RefundInvoicePrint').append('<table>');
                                         $('#RefundInvoicePrint').append('<tr><td><strong>Due Payment</strong></td><td>:<strong>'+CustomerPaymentByRefund+'</strong></td></tr>');
                                         $('#RefundInvoicePrint').append('<br><tr><td>Change</td><td>:<strong>'+Change+'<strong></td></tr></table>');

                                       
                                    }
                                    $('#RefundInvoicePrint').append('<p class="InWords" style="text-transform: capitalize;">'+InWords+ ' '+Currency+' Only</p>');
                                    
                                    if(cusname!="Anonymous")
                                    {
                                        $('#RefundInvoicePrint').append('<table><tr><td>Customer</td><td>:'+cusname+'</td></tr></table>');
                                    }
                                    if(ShopFooter!="")
                                    {
                                        $('#RefundInvoicePrint').append('<hr><div class="InvoiceFooter">'+ShopFooter.Footer+'<div>')
                                    }

                                        $('#RefundInvoicePrint').append(' <hr>Have a nice Day ! | <span class="">'+User.name+'</span><hr>');
                                        $('#RefundInvoicePrint').append(' <br><div class="company-info">Software By: <span class="TechLab">  '+Author+'</span>  01614777555<hr>');
                                        $('#RefundCheckforPayment').val(1);
                                    

                                }

                            });
                            
                            //for(i=0;i<reason.length;i++)
                            //{
                                //$('input[name="reason3[]"]').eq(i).val($('input[name="reason2[]"]').eq(i).val());
                            //}
                            //window.open('',"RefundWindowforProduct","width=297,height=700,left=500");
                            //$('#CustomerBalancePayment').modal('show');
                            //$('#RefundforProduct').submit();
                            //$('#RefModal').modal('hide');
                            //$('body').removeClass('modal-open');
                            //$('.modal-backdrop').remove();
                        }
                        //$('#RefModal').modal('hide');
                        //$('body').removeClass('modal-open');
                        //$('.modal-backdrop').remove();                                
                    });
                });
            }
        }

        //Condition for InvoiceID
        if(RefundInvoiceID!="" && RefundProductID=="")
        {
            $('#RefundInvoicePrint').empty();  
            $('#RefundInvoice').attr('disabled',false);
            $('#RefProID').hide();
            $('#RefInvID').show();
            $('#ree').show();
            $('.RefundInvoiceFooter').show();
            $('#RefundInvoice').show();
            var y = $('#IDofTheShop').val();

            // Get already refunded invoice info
            $.get('/ajax-refund-change/' + RefundInvoiceID + '/' + y, function(data)
            {


                var ss=$('input[name="refproid[]"]').length;
                for(i=0;i<ss;i++)
                {
                    $('input[name="refproid[]"]').eq(i).val(0);
                }
                $('#ree').empty();
                $('#RefundforInvoice').empty();
                var dad = JSON.parse(data);
                var count = dad.length;
                var kk;

                for (kk = 0; kk < count; kk++) 
                {
                    $('#ree').append('<tr ><td ><input type="checkbox" name="checkbox[]" class="checkbox"></td>'+
                        '<td class=" " ><input type="hidden" name="refproid[]" class="  refproid" readonly style="background:transparent;border:white; " value="' + dad[kk].ProductID+'">'+dad[kk].ProductID+"S"+dad[kk].ShopID+'</td>'+
                        '<td><input type="hidden" name="refpronam[]" class="refpronam text-center " readonly style="background:transparent;border:white;  " value="' + dad[kk].ProductName + '">'+dad[kk].ProductName+'</td>'+
                        '<td class="text-center" style=""><input type="number" step=".0001"  name="refqty[]" min="0" max="'+dad[kk].Qty+'" class="refqty text-center" value="' + dad[kk].Qty + '" style="background:transparent;border:white;"></td>'+
                        '<td class="text-center"><input type="hidden"  name="refprice[]" class="refprice text-center " value="' + dad[kk].TotalPrice + '" style="  background:transparent;border:white;" readonly>'+dad[kk].TotalPrice+'</td>'+
                        '<td><select class="RefundType form-control" name="RefundType[]"><option value="Shop" selected>BackToShop</option><option value="Waste">Waste</option> </td>'+
                        '<td><input type="text" name="reason[]" class="reason form-control" style="background:transparent;"></td>'+
                        '<input type="hidden" name="inv[]" class="inv" value="' + RefundInvoiceID + '"><input type="hidden" name="dis[]" class="dis" value="' + dad[kk].Discount + '">'+
                        '<input type="hidden" name="price[]" class="price" value="' + dad[kk].Price + '">'+
                        '<input type="hidden" id="text" name="checking[]" class="checking" value="' + 0 + '"></tr>');

                    $('#RefundforInvoice').append('<tr ><td ><input type="checkbox" name="checkbox1[]" class="checkbox1"></td>'+
                        '<td class=" " ><input type="hidden" name="refproid1[]" class="  refproid1" readonly style="background:transparent;border:white; " value="' + dad[kk].ProductID + '">'+dad[kk].ProductID+'</td>'+
                        '<td><input type="hidden" name="refpronam1[]" class="refpronam1 text-center " readonly style="background:transparent;border:white;  " value="' + dad[kk].ProductName + '">'+dad[kk].ProductName+'</td>'+
                        '<td class="text-center" style=""><input type="number"  step=".0001" name="refqty1[]" min="0" max="'+dad[kk].Qty+'" class="refqty1 text-center" value="' + dad[kk].Qty + '" style="background:transparent;border:white;"></td>'+
                        '<td class="text-center"><input type="hidden"  name="refprice1[]" class="refprice1 text-center " value="' + dad[kk].TotalPrice + '" style="  background:transparent;border:white;" readonly>'+dad[kk].TotalPrice+'</td>'+
                        '<td><select class="RefundType1 form-control" name="RefundType1[]"><option value="Shop" selected>BackToShop</option><option value="Waste">Waste</option> </td>'+
                        '<td><input type="text" name="reason1[]" class="reason1 form-control" style="background:transparent;"></td>'+
                        '<input type="hidden" name="inv1[]" class="inv1" value="' + RefundInvoiceID + '"><input type="hidden" name="dis1[]" class="dis1" value="' + dad[kk].Discount + '">'+
                        '<input type="hidden" name="price1[]" class="price1" value="' + dad[kk].Price + '"><input type="text" name="ShopRefund[]" class="ShopRefund" value="'+dad[kk].ShopID+'">'+
                        '<input type="hidden" name="taxrefund1[]" value="'+dad[kk].TaxTotal+'"><input type="hidden" id="text" name="checking1[]" class="checking1" value="' + 0 + '"></tr>');
  
                    if(dad[kk].Qty<1)
                    {
                        $('input[name="checkbox[]"]').eq(kk).prop('disabled',true);
                        $('[name="RefundType[]"]').eq(kk).prop('disabled',true);
                        $('input[name="refqty[]"]').eq(kk).prop('disabled',true);
                        $('input[name="refprice[]"]').eq(kk).prop('disabled',true);
                        $('input[name="reason[]"]').eq(kk).prop('disabled',true);
                    }
                    $('#RefundforInvoice').append('<input type="text" name="RefShop[]" value="'+dad[kk].ShopID+'">');     
                }

                $('#RefundInvoice').unbind('click').click(function(e)
                {
                    e.preventDefault();
                    var RefundCustomer=$('#customerid').val();
                    var Method=$('#RefundPaymentMethod').val();
                    var total=$('input[name="refproid1[]"]').length;
                    $('#CustomerPaymentRefund').val('');
                    $('#RefundPrint').attr('disabled',false);

                    
                    //Refund is used for Customer Due Clearence
                    if(RefundCustomer>0 && Method==1)
                    {
                        var TotalPriceRefund=0;
                        for(i=0;i<total;i++)
                        {
                            var x=$('input[name="checking1[]"]').eq(i).val();
                            if(x>0)
                            {                                
                                var SinglePrice=parseInt($('input[name="refprice1[]"]').eq(i).val(),10)*parseInt($('input[name="refqty1[]"]').eq(i).val(),10);
                                TotalPriceRefund=TotalPriceRefund+SinglePrice;
                            }
                        }
                        $('#CustomerRefundForm').val(TotalPriceRefund);
                        $.get('/Sales/Customer/Balance/'+RefundCustomer,function(data)
                        {
                            $('#CustomerBalance').val(data);
                            $('#CustomerBalanceForm').val(data);
                        });
                        $('#CustomerBalancePayment').modal('show');
                        //$('#RefundInvoice').attr('disabled',true);  
                        $('#customerpaymentsel').unbind('click').click(function(e)
                        {

                            var PaymentValue;
                            PaymentValue=$('#CustomerPaymentRefund').val();
                            var RefundedValue=$('#CustomerRefundForm').val();
                            //e.preventDefault();
                            $('#RefundforInvoice').append('<input type="hidden" name="CustomerPaymentByRefund" value="'+PaymentValue+'" >');
                            $('#RefundforInvoice').append('<input type="hidden" name="CustomerTotalRefund" value="'+RefundedValue+'" >');

                            for(i=0;i<count;i++)
                            {
                                $('input[name="reason1[]"]').eq(i).val($('input[name="reason[]"]').eq(i).val());
                            }
                            $.ajaxSetup({
                            header:$('meta[name="_token"]').attr('content')
                            })
                            e.preventDefault(e);

                            $.ajax({

                                type:"POST",
                                url:'/Sales/Refund/Invoice',
                                data:$('#RefundforInvoice').serialize(),
                                success:function(data)
                                {

                                    totalPrice=JSON.parse(data.totalPrice);
                                    SubTotalPrice=JSON.parse(data.SubTotalPrice);
                                    totalTax=JSON.parse(data.totalTax);
                                    totalDiscount=JSON.parse(data.totalDiscount);
                                    FinalPrice=JSON.parse(data.FinalPrice);
                                    Price=JSON.parse(data.Price);
                                    ProductName=JSON.parse(data.ProductName);
                                    Qty=JSON.parse(data.Qty);
                                    discount=JSON.parse(data.discount);
                                    User=JSON.parse(data.User);
                                    ItemQty=JSON.parse(data.ItemQty);
                                    paid=JSON.parse(data.paid);
                                    returned=JSON.parse(data.returned);
                                    Invoice=JSON.parse(data.Invoice);
                                    Shop=JSON.parse(data.Shop);
                                    cusname=JSON.parse(data.cusname);
                                    InWords=JSON.parse(data.InWords);
                                    ShopFooter=JSON.parse(data.ShopFooter);
                                    ProductID=JSON.parse(data.ProductID);
                                    ShopID=JSON.parse(data.ShopID);
                                    Currency=JSON.parse(data.Currency);
                                    CustomerPaymentByRefund=JSON.parse(data.CustomerPaymentByRefund);
                                    Change=totalPrice-CustomerPaymentByRefund;
                                    var DDD=new Date(Invoice.created_at);
                                    var Year=DDD.getFullYear();
                                    var  Months=DDD.getMonth()+1;
                                    var  Days=DDD.getDate();
                                    var Hour=DDD.getHours();
                                    var Minute=DDD.getMinutes();
                                    var meridian="AM";
                                    Hour=DDD.getHours();
                                    if(Hour>12)
                                    {
                                        Hour=Hour-12;
                                        meridian="PM";
                                    }

                                    //month=dateadvance.getMonth()+1;
                                    if(Months<10)
                                    {
                                        Months="0"+Months;
                                    }
                                    if(Minute<10)
                                    {
                                        Minute="0"+Minute;
                                    }


                                    var DDDNow=new Date();
                                    var YearNow=DDDNow.getFullYear();
                                    var  MonthsNow=DDDNow.getMonth()+1;
                                    var  DaysNow=DDDNow.getDate();
                                    var HourNow=DDDNow.getHours();
                                    var MinuteNow=DDDNow.getMinutes();
                                    var meridianNow="AM";
                                    HourNow=DDDNow.getHours();
                                    if(HourNow>12)
                                    {
                                        HourNow=HourNow-12;
                                        meridianNow="PM";
                                    }

                                    //month=dateadvance.getMonth()+1;
                                    if(MonthsNow<10)
                                    {
                                        MonthsNow="0"+MonthsNow;
                                    }
                                    if(MinuteNow<10)
                                    {
                                        MinuteNow="0"+MinuteNow;
                                    }

                                    $('#RefundInvoicePrint').append('<h4><i class="fa fa-shopping-bag fa-lg"></i> Refund Invoice</h4>'+
                                    '<hr>');
                                    if(Shop.ShopLogo!="")
                                    $('#RefundInvoicePrint').append(' <img src="/uploads/image/shop/'+Shop.ShopLogo+'" width=70 height=70 class="col-md-offset-5 img img-responsive">');

                                    $('#RefundInvoicePrint').append('<h4>'+Shop.ShopName+'</h4>');

                                    $('#RefundInvoicePrint').append('<table>');
                                    if(Shop.ShopAddress!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>Address</td><td>:'+Shop.ShopAddress+'</td></tr>');
                                    if(Shop.Phone!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>Phone</td><td>:'+Shop.Phone+'</td></tr>');

                                    if(Shop.Email!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>Email</td><td>:'+Shop.Email+'</td></tr>');

                                    if(Shop.Website!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>WebSite</td><td>:'+Shop.Website+'</td></tr>');

                                    if(Shop.VatRegNo!=""&&Shop.VatRegNo!=null)
                                    $('#RefundInvoicePrint').append('<br><tr><td>Vat Reg</td><td>:'+Shop.VatRegNo+'</td></tr>');
                                    $('#RefundInvoicePrint').append('</table>');
                                    $('#RefundInvoicePrint').append('<hr>');
                                    $('#RefundInvoicePrint').append('<table>');
                                    $('#RefundInvoicePrint').append('<tr><td>InvoiceID</td><td><strong>:'+Invoice.InvoiceID+'</strong></td>');
                                    $('#RefundInvoicePrint').append('<br><tr><td>Invoice Date</td><td><strong>:'+Days+'/' +Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</strong></td>');
                                    $('#RefundInvoicePrint').append('<br><tr><td>Refund Date</td><td><strong>:'+DaysNow+'/' +MonthsNow+'/'+YearNow+' '+HourNow+':'+MinuteNow+''+meridianNow+'</strong></td>');
                                    $('#RefundInvoicePrint').append('</table>');
                                    $('#RefundInvoicePrint').append('<hr>');

                                    $('#RefundInvoicePrint').append('<table><tr><th>#</th><th>Item/Description </th><th>SubTotal</th></tr>');
                                    var TotalQty=0;
                                    var TotalQty=0;
                                    var SubTotal=0;

                                    for(i=0;i<ItemQty;i++)
                                    {
                                        j=i+1;
                                        FinalPrice=Qty[i]*Price[i];
                                        SubTotal   =SubTotal+FinalPrice;
                                        Qty[i]=Math.floor(Qty[i]); 
                                        TotalQty=TotalQty+Qty[i];
                                        if(Qty[i]>0)
                                        {
                                            Price[i]=Math.floor(Price[i]);
                                        //if(discount[i]>0)
                                        //{
                                        //$('#AdvanceInvoice').append('<tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']Dis-'+discount[i]+'<td>'+FinalPrice+'</td>');                        
                                        //}
                                        //if(discount[i]==0)
                                            $('#RefundInvoicePrint').append('<tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']<td>'+FinalPrice+'</td>');

                                        }
                                    }
                                    $('#RefundInvoicePrint').append('</table>');

                                    $('#RefundInvoicePrint').append('<table>');
                                    $('#RefundInvoicePrint').append('<tr><td>Sub Total</td><td> : <strong>'+SubTotalPrice+'</strong></td></tr>');
                                    if(totalDiscount>0)
                                    $('#RefundInvoicePrint').append('<br><tr><td>Discount</td><td> : <strong>'+totalDiscount+'</strong></td></tr>');
                                    if(totalTax>0)
                                    $('#RefundInvoicePrint').append('<br><tr><td>Tax Total</td><td> : <strong>'+totalTax+'</strong></td></tr>');
                                    
                                    
                                    $('#RefundInvoicePrint').append('<br><tr><td>Total</td><td> : <strong>'+totalPrice+'</strong></td></tr></table>');

                                    if(CustomerPaymentByRefund>0)
                                    {
                                         $('#RefundInvoicePrint').append('<table>');
                                         $('#RefundInvoicePrint').append('<tr><td><strong>Due Payment</strong></td><td>:<strong>'+CustomerPaymentByRefund+'</strong></td></tr>');
                                         $('#RefundInvoicePrint').append('<tr><td>Change</td><td>:<strong>'+Change+'<strong></td></tr></table>');

                                       
                                    }
                                    $('#RefundInvoicePrint').append('<p class="InWords" style="text-transform: capitalize;">'+InWords+ ' '+Currency+' Only</p>');
                                    
                                    if(cusname!="Anonymous")
                                    {
                                        $('#RefundInvoicePrint').append('<table><tr><td>Customer</td><td>:'+cusname+'</td></tr></table>');
                                    }
                                    if(ShopFooter!="")
                                    {
                                        $('#RefundInvoicePrint').append('<hr><div class="InvoiceFooter">'+ShopFooter.Footer+'<div>')
                                    }

                                        $('#RefundInvoicePrint').append(' <hr>Have a nice Day ! | <span class="">'+User.name+'</span><hr>');
                                        $('#RefundInvoicePrint').append(' <div class="company-info">Software By: <span class="TechLab">  '+Author+'</span>  01614777555<hr>');
                                        $('#RefundCheckforPayment').val(1);
                                        //$('#RefundInvoice').attr('disabled',true);

                                        //$( "#RefundPrint" ).trigger( "click" );
                                        //$('#RefundPrint').click();
                                    
                                },
                                error:function(data)
                                {

                                }

                            });
                            //window.open('',"RefundWindow","width=297,height=700,left=500");
                            //$('#RefundforInvoice').submit();
                            $('#CustomerBalancePayment').modal('hide');

                            //$('body').removeClass('modal-open');
                            //$('.modal-backdrop').remove();
                        });


                    }
                    else
                    {
                        for(i=0;i<count;i++)
                        {
                        $('input[name="reason1[]"]').eq(i).val($('input[name="reason[]"]').eq(i).val());
                        }

                        $.ajaxSetup({
                            header:$('meta[name="_token"]').attr('content')
                        })
                        e.preventDefault(e);

                        $.ajax({

                            type:"POST",
                            url:'/Sales/Refund/Invoice',
                            data:$('#RefundforInvoice').serialize(),
                            success:function(data)
                            {
                                totalPrice=JSON.parse(data.totalPrice);
                                SubTotalPrice=JSON.parse(data.SubTotalPrice);
                                totalTax=JSON.parse(data.totalTax);
                                totalDiscount=JSON.parse(data.totalDiscount);
                                FinalPrice=JSON.parse(data.FinalPrice);
                                Price=JSON.parse(data.Price);
                                ProductName=JSON.parse(data.ProductName);
                                Qty=JSON.parse(data.Qty);
                                discount=JSON.parse(data.discount);
                                User=JSON.parse(data.User);
                                ItemQty=JSON.parse(data.ItemQty);
                                paid=JSON.parse(data.paid);
                                returned=JSON.parse(data.returned);
                                Invoice=JSON.parse(data.Invoice);
                                Shop=JSON.parse(data.Shop);
                                cusname=JSON.parse(data.cusname);
                                InWords=JSON.parse(data.InWords);
                                ShopFooter=JSON.parse(data.ShopFooter);
                                ProductID=JSON.parse(data.ProductID);
                                ShopID=JSON.parse(data.ShopID);
                                Currency=JSON.parse(data.Currency);
                                var DDD=new Date(Invoice.created_at);
                                var Year=DDD.getFullYear();
                                var  Months=DDD.getMonth()+1;
                                var  Days=DDD.getDate();
                                var Hour=DDD.getHours();
                                var Minute=DDD.getMinutes();
                                var meridian="AM";
                                Hour=DDD.getHours();
                                if(Hour>12)
                                {
                                    Hour=Hour-12;
                                    meridian="PM";
                                }

                                //month=dateadvance.getMonth()+1;
                                if(Months<10)
                                {
                                    Months="0"+Months;
                                }
                                if(Minute<10)
                                {
                                    Minute="0"+Minute;
                                }


                                var DDDNow=new Date();
                                var YearNow=DDDNow.getFullYear();
                                var  MonthsNow=DDDNow.getMonth()+1;
                                var  DaysNow=DDDNow.getDate();
                                var HourNow=DDDNow.getHours();
                                var MinuteNow=DDDNow.getMinutes();
                                var meridianNow="AM";
                                HourNow=DDDNow.getHours();
                                if(HourNow>12)
                                {
                                    HourNow=HourNow-12;
                                    meridianNow="PM";
                                }

                                //month=dateadvance.getMonth()+1;
                                if(MonthsNow<10)
                                {
                                    MonthsNow="0"+MonthsNow;
                                }
                                if(MinuteNow<10)
                                {
                                    MinuteNow="0"+MinuteNow;
                                }

                                    $('#RefundInvoicePrint').append('<h4><i class="fa fa-shopping-bag fa-lg"></i> Refund Invoice</h4>'+
                                    '<hr>');
                                    if(Shop.ShopLogo!="")
                                    $('#RefundInvoicePrint').append(' <img src="/uploads/image/shop/'+Shop.ShopLogo+'" width=70 height=70 class="col-md-offset-5 img img-responsive">');

                                    $('#RefundInvoicePrint').append('<h4>'+Shop.ShopName+'</h4>');

                                    $('#RefundInvoicePrint').append('<table>');
                                    if(Shop.ShopAddress!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>Address</td><td>:'+Shop.ShopAddress+'</td></tr>');
                                    if(Shop.Phone!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>Phone</td><td>:'+Shop.Phone+'</td></tr>');

                                    if(Shop.Email!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>Email</td><td>:'+Shop.Email+'</td></tr>');

                                    if(Shop.Website!="")
                                    $('#RefundInvoicePrint').append('<br><tr><td>WebSite</td><td>:'+Shop.Website+'</td></tr>');

                                    if(Shop.VatRegNo!=""&&Shop.VatRegNo!=null)
                                    $('#RefundInvoicePrint').append('<br><tr><td>Vat Reg</td><td>:'+Shop.VatRegNo+'</td></tr>');
                                    $('#RefundInvoicePrint').append('</table>');
                                    $('#RefundInvoicePrint').append('<hr>');
                                    $('#RefundInvoicePrint').append('<table>');
                                    $('#RefundInvoicePrint').append('<tr><td>InvoiceID</td><td><strong>:'+Invoice.InvoiceID+'</strong></td>');
                                    $('#RefundInvoicePrint').append('<br><tr><td>Invoice Date</td><td><strong>:'+Days+'/' +Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</strong></td>');
                                    $('#RefundInvoicePrint').append('<br><tr><td>Refund Date</td><td><strong>:'+DaysNow+'/' +MonthsNow+'/'+YearNow+' '+HourNow+':'+MinuteNow+''+meridianNow+'</strong></td>');
                                    $('#RefundInvoicePrint').append('</table>');
                                    $('#RefundInvoicePrint').append('<hr>');

                                    $('#RefundInvoicePrint').append('<table><tr><th>#</th><th>Item/Description </th><th>SubTotal</th></tr>');
                                    var TotalQty=0;
                                    var TotalQty=0;
                                    var SubTotal=0;

                                    for(i=0;i<ItemQty;i++)
                                    {
                                        j=i+1;
                                        FinalPrice=Qty[i]*Price[i];
                                        SubTotal   =SubTotal+FinalPrice;
                                        Qty[i]=Math.floor(Qty[i]); 
                                        TotalQty=TotalQty+Qty[i];
                                        if(Qty[i]>0)
                                        {
                                            Price[i]=Math.floor(Price[i]);
                                        //if(discount[i]>0)
                                        //{
                                        //$('#AdvanceInvoice').append('<tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']Dis-'+discount[i]+'<td>'+FinalPrice+'</td>');                        
                                        //}
                                        //if(discount[i]==0)
                                            $('#RefundInvoicePrint').append('<br><tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']<td>'+FinalPrice+'</td>');

                                        }
                                    }
                                    $('#RefundInvoicePrint').append('</table>');

                                    $('#RefundInvoicePrint').append('<table>');
                                    $('#RefundInvoicePrint').append('<tr><td>Sub Total</td><td> : <strong>'+SubTotalPrice+'</strong></td></tr>');
                                    if(totalDiscount>0)
                                    $('#RefundInvoicePrint').append('<tr><td>Discount</td><td> : <strong>'+totalDiscount+'</strong></td></tr>');
                                    if(totalTax>0)
                                    $('#RefundInvoicePrint').append('<tr><td>Tax Total</td><td> : <strong>'+totalTax+'</strong></td></tr>');
                                    
                                    
                                    $('#RefundInvoicePrint').append('<tr><td>Total</td><td> : <strong>'+totalPrice+'</strong></td></tr></table>');
                                    $('#RefundInvoicePrint').append('<p class="InWords" style="text-transform: capitalize;">'+InWords+ ' '+Currency+' Only</p>');
                                    
                                    if(ShopFooter!="")
                                    {
                                        $('#RefundInvoicePrint').append('<hr><div class="InvoiceFooter">'+ShopFooter.Footer+'<div>')
                                    }

                                    $('#RefundInvoicePrint').append(' <hr>Have a nice Day ! | <span class="">'+User.name+'</span><hr>');
                                    $('#RefundInvoicePrint').append(' <div class="company-info">Software By: <span class="TechLab">  '+Author+'</span>  01614777555<hr>');
    

                                    //$('#RefundInvoice').attr('disabled',true);

                                    //PrintRefund();     


                            },

                            error:function(data)
                            {
                                alert("Something IS Wrong");

                            }

                        });
                        //window.open('',"RefundWindow","width=297,height=700,left=500");
                        //$('#RefundforInvoice').submit();                            
                    }

                    //var Check=$('#RefundCheckforPayment').val();
                    //alert("Status:"+Check);

                     



                    //$('#RefModal').modal('hide');
                    //$('body').removeClass('modal-open');
                    //$('.modal-backdrop').remove();
                    $('#RefundInvoice').attr('disabled',true);

                });

                $('.refqty').on('input',function()
                {
                    var Index=$('input[name="refqty[]"]').index(this);
                    var refundquan=$('input[name="refqty[]"]').eq(Index).val();
                    $('input[name="refqty1[]"]').eq(Index).val(refundquan);
                });

                $('#refundfooter').show();
                //#####Use Checkbox to  refund the product #####
                $('.checkbox').click(function() 
                {
                    var buttondisablecheck = 0;
                    $('.checkbox').each(function(i) {
                        if (this.checked) {
                            $('input[name="checking[]"]').eq(i).val(1);
                            $('input[name="checking1[]"]').eq(i).val(1);
                            $('input[name="checking1[]"]').eq(i).val(1);
                            var proid= $('input[name="refproid[]"]').eq(i).val();

                            $('RefundforInvoice').append('<input type="hidden" name="RefundProductidFahad[]" class="RefundProductidFahad" value="33">');


                        } else {
                            $('input[name="checking[]"]').eq(i).val(0);
                            $('input[name="checking1[]"]').eq(i).val(0);
                            //$('input[name="refproid1[]"]').eq(i).val(0);
                        }
                    });
                    for (i = 0; i < count; i++) {
                        var value = $('input[name="checking[]"]').eq(i).val();
                        if (value == 1) {
                            buttondisablecheck = 1;
                            break;
                        }
                    }
                    if (buttondisablecheck == 1)
                        $('#RefundInvoice').attr('disabled', false);
                    else
                        $('#RefundInvoice').attr('disabled', true);
                });
            });
        }

        $('#RefundBarcodeID').val('');

    });

   /* $('#OrderPlaceForm').on('submit',function(e)
    {

      e.preventDefault();      
      var Counter=$('#TableIDforOrder').val();
      var Staff=$('#StaffID').val();
      var Guest=$('#GuestCount').val();
      var Notes=$('#NotesforNewOrder').val();
      var Order=$('#OrderIDforInvoice').val();
      var OrderID=$('#OrderIDforOrderUpdate').val();
      $('#OrderForm').append('<input type="hidden" name="Counter" value="'+Counter+'">');
      $('#OrderForm').append('<input type="hidden" name="Staff" value="'+Staff+'">');
      $('#OrderForm').append('<input type="hidden" name="Guest" value="'+Guest+'">');
      $('#OrderForm').append('<input type="hidden" name="Notes" value="'+Notes+'">');
      $('#OrderForm').append('<input type="hidden" name="OrderUpdateID" value="'+OrderID+'">');
      
      $("#myform").find(":input").clone().appendTo("#OrderForm");
        //window.open('',"OrderWindow","width=2,height=7,left=500");
        $('#OrderFormSubmit').submit();
        $('#OrderForm').hide();
        
        //$('#OrderPlaceModal').modal('hide');
        //$('#OrderStart').modal('hide');

        //$('body').removeClass('modal-open');
        //$('.modal-backdrop').remove();
        //DeleteCartWithoutConfirm();
        SubmitTest();
        TotalPriceCalculation();
        ValueReset();

        $('#TableIDforOrder').val(0);
        $('#TableID').empty();
        $('#TableID').removeClass('bg-maroon');
        $('#TableID').addClass('bg-blue');
        $('#TableID').append('Table');
        $('#OrderDetailsListBody').empty();
        $('#RowforOrderDetails').hide();
        $('#OrderIDforOrderUpdate').val(0);
        $('#OrderCancel').hide();
        
    });*/

    $('#OrderUpdateForm').on('submit',function(e)
    {
        e.preventDefault();

        var Check=0;
        var RealCheck=0;

        var Counter=$('#CounterIDUpdate').val();
        var Staff=$('#UpdateStaffID').val();
        var Guest=$('#UpdateGuestCount').val();
        var Notes=$('#UpdateNotes').val();
        var Order=$('#OrderIDUpdate').val();

        if(cc==0)
        {
            RealCheck=1;
        }
        else
        {
            for(i=0;i<cc;i++)
            {
                x=$('input[name="productid[]"]').eq(i).val();
                if(x>0)
                {
                    Check=1;
                    break;
                }
            }
            if(Check==0)
            RealCheck=1;
            if(Check==1)
            RealCheck=0;
        }

        if(RealCheck==1)
        {
            $('#OrderFormforUpdateWithoutProduct').append('<input type="hidden" name="Counter" value="'+Counter+'">');
            $('#OrderFormforUpdateWithoutProduct').append('<input type="hidden" name="Staff" value="'+Staff+'">');
            $('#OrderFormforUpdateWithoutProduct').append('<input type="hidden" name="Guest" value="'+Guest+'">');
            $('#OrderFormforUpdateWithoutProduct').append('<input type="hidden" name="Notes" value="'+Notes+'">');
            $('#OrderFormforUpdateWithoutProduct').append('<input type="hidden" name="OrderUpdate" value="'+Order+'">');            
            $('#OrderFormforUpdateWithoutProduct').submit();
        }
        else
        {
            $('#OrderFormforUpdate').append('<input type="hidden" name="Counter" value="'+Counter+'">');
            $('#OrderFormforUpdate').append('<input type="hidden" name="Staff" value="'+Staff+'">');
            $('#OrderFormforUpdate').append('<input type="hidden" name="Guest" value="'+Guest+'">');
            $('#OrderFormforUpdate').append('<input type="hidden" name="Notes" value="'+Notes+'">');
            $('#OrderFormforUpdate').append('<input type="hidden" name="OrderUpdate" value="'+Order+'">');
            $("#myform").find(":input").clone().appendTo("#OrderFormforUpdate");
            window.open('',"OrderWindowUpdate","width=297,height=700,left=500");
            $('#OrderFormforUpdateSubmit').submit();
            $('#OrderFormforUpdate').hide();
            $('#OrderStart').modal('hide');
            $('#OrderUpdateModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            DeleteCartWithoutConfirm();
            ValueReset();
        }
    });

    $('#SaleHoldForm').on('submit',function(e)
    {
        e.preventDefault();
        ProductIDHold=[];
        QuantityHold=[];
        DiscountHold=[];
        VatHold=[];
        ShopHold=[];
        var Name=$('#SaleHoldName').val();

        if(Name==""||Name==null)
        {
            Name="No Name";
        }

        for(i=0;i<cc;i++)
        {
            var check=$('input[name="productid[]"]').eq(i).val();
            var adquan=$('input[name="total[]"]').eq(i).val();
            var holddiscount=$('input[name="discount[]"]').eq(i).val();
            var holdtax=$('input[name="Tax[]"]').eq(i).val();
            var holdShop=$('input[name="Shop[]"]').eq(i).val();
            ProductIDHold[i]=check;
            QuantityHold[i]=adquan;
            DiscountHold[i]=holddiscount;
            VatHold[i]=holdtax;
            ShopHold[i]=holdShop;
        }

        $.get('Sale/Hold/Insert/'+ProductIDHold+"/"+QuantityHold+"/"+DiscountHold+"/"+VatHold+"/"+ShopHold+"/"+Name,function(data)
        {
            if(data=="success")       
            $('#SaleHoldModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            for(i=0;i<cc;i++)
            {
            var q = $('input[name="productid[]"]').eq(i).closest('tr');
            q.hide();
            $('input[name="productid[]"]').eq(i).val(0);
            $('input[name="productid1[]"]').eq(i).val(0);
            $('input[name="productid2[]"]').eq(i).val(0);
            }


            $('#GrossFooterRow').hide();
            $('#FinalQuantity').hide();                
            $('#FinalItem').hide(); 
            $('#VatTotal').empty();
            $('#VatTotal').append(0);
            $('#SubTotal').empty();
            $('#SubTotal').append(0);
            $('#Total').empty();
            $('#Total').append(0);
            $('#AdvanceAmountValue').val(0);
            $('#AdvanceIDValue').val(0);
            $('#myformProductList').empty();
            alertify.success('<strong><i class="fa fa-check"></i> Hold Success !</strong>');
            SubmitTest();
            TotalPriceCalculation();
            SimpleCartClear();
        });
    });

    $('#AdvanceCustomerPhone').keyup(function()
    {
        $('#AdvanceConfirm').attr('disabled',false);

        value=$('#AdvanceCustomerPhone').val();
        if(value=="")
            $('#AdvanceConfirm').attr('disabled',true);
    });

    $('#AdvanceAddForm').on('submit',function(e)
    {

        e.preventDefault();
        var ProductIDAdvance=[];
        var QuantityAdvance=[];
        var VatAdvance=[];
        var DiscountAdvance=[];
        var ShopAdvance=[];

        if(cc==0)
        return false;

        var discountall = parseFloat($('#discountoverall').val(),2).toFixed(2);
        var vat = parseFloat($('#taxoverall').val(),2).toFixed(2);

        $('#AdvanceForm').append('<input type="hidden" name="OverAllTax" value="'+vat+'">');
        $('#AdvanceForm').append('<input type="hidden" name="OverAllDiscount" value="'+discountall+'">');

        var CustomerName=$('#AdvanceCustomerName').val();
        if(CustomerName==""||CustomerName==null)
        {
            CustomerName="No Name";
        }

        $('#AdvanceForm').append('<input type="hidden" name="CustomerName" value="'+CustomerName+'">');

        var CustomerAddress=$('#AdvanceCustomerAddress').val();

        if(CustomerAddress==""||CustomerAddress==null)
        {
            CustomerAddress="No Address";
        }

        $('#AdvanceForm').append('<input type="hidden" name="CustomerAddress" value="'+CustomerAddress+'">');

        var CustomerPhone=$('#AdvanceCustomerPhone').val();
        if(CustomerPhone=="")
        {
            alert("Phone number should be provided");
        }

        $('#AdvanceForm').append('<input type="hidden" name="CustomerPhone" value="'+CustomerPhone+'">');


        var CustomerAmount=$('#AdvanceAmount').val();

        $('#AdvanceAmountValue').val(CustomerAmount);

        $('#AdvanceForm').append('<input type="hidden" name="CustomerAmount" value="'+CustomerAmount+'">');



        var x=$('#AdvanceDelivaryDate').val();
        
        if(x=="" ||x==null)
        {
            var DelivaryDate=new Date().toDateString();               
        }
        else
            var DelivaryDate=new Date(x).toDateString();

        $('#AdvanceForm').append('<input type="hidden" name="DelivaryDate" value="'+DelivaryDate+'">');


        var Notes=$('#AdvanceNotes').val();

        if(Notes==""||Notes==null)
        {
            Notes="No Notes";
        }

        for(i=0;i<cc;i++)
        {
            var Firstquan=parseInt($('input[name="total[]"]').eq(i).val(),10);

            var ID=$('input[name="productid[]"]').eq(i).val();
            var Name=$('input[name="productname[]"]').eq(i).val();
            var Price=$('input[name="Price[]"]').eq(i).val();
            var discount=$('input[name="discount[]"]').eq(i).val();
            var Final=$('input[name="final[]"]').eq(i).val();
            var Shop=$('input[name="Shop[]"]').eq(i).val();
            var Tax=$('input[name="tax[]"]').eq(i).val();
            var TaxValue=$('input[name="taxvalue1[]"]').eq(i).val();              

            if(ID!=0)
            {
                $('#AdvanceForm').append('<input type="hidden" name="total1[]" class="total3" value="'+Firstquan+'">');
                $('#AdvanceForm').append('<input type="hidden" name="productid1[]" class="productid3" value="'+ID+'">');
                $('#AdvanceForm').append('<input type="hidden" name="productname1[]" class="productname" value="'+Name+'">');
                $('#AdvanceForm').append('<input type="hidden" name="Price1[]" class="Price3" value="'+Price+'">');
                $('#AdvanceForm').append('<input type="hidden" name="discount1[]" class="discount3" value="'+discount+'">');
                $('#AdvanceForm').append('<input type="hidden" name="final1[]" class="final3" value="'+Final+'">');
                $('#AdvanceForm').append('<input type="hidden" name="Shop1[]" class="Shop3" value="'+Shop+'">');
                $('#AdvanceForm').append('<input type="hidden" name="tax1[]" class="tax3" value="'+Tax+'">');
                $('#AdvanceForm').append('<input type="hidden" name="taxvalue1[]" class="taxvalue3" value="'+TaxValue+'">');
            }
        }

        $('#AdvanceForm').append('<input type="hidden" name="Notes" value="'+Notes+'">');
        $("#myform").find(":input").clone().appendTo("#AdvanceForm");
        $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
        })
        e.preventDefault(e);

        $.ajax({

            type:"POST",
            url:'/Sale/Advance/Confirm',
            data:$('#AdvanceForm').serialize(),
            success:function(data)
            {
                Shop=JSON.parse(data.Shop);
                Invoice=JSON.parse(data.Invoice);
                ProductName=JSON.parse(data.ProductName);
                Price=JSON.parse(data.Price);
                FinalPrice=JSON.parse(data.FinalPrice);
                Qty=JSON.parse(data.Qty);
                CustomerName=JSON.parse(data.CustomerName);
                Address=JSON.parse(data.Address);
                Phone=JSON.parse(data.Phone);
                DelivaryDate=JSON.parse(data.DelivaryDate);
                ItemQty=JSON.parse(data.ItemQty);
                User=JSON.parse(data.User);
                InWords=JSON.parse(data.InWords);
                TotalPrice=JSON.parse(data.TotalPrice);
                Due=JSON.parse(data.Due);
                AdvancePaid=JSON.parse(data.AdvancePaid);
                ProductID=JSON.parse(data.ProductID);
                ShopFooter=JSON.parse(data.ShopFooter);
                ShopID=JSON.parse(data.ShopID);
                TotalDiscount=JSON.parse(data.TotalDiscount);
                TotalTax=JSON.parse(data.TotalTax);
                SubTotal=JSON.parse(data.SubTotal);
                Author=JSON.parse(data.Author);
                Currency=JSON.parse(data.Currency);

                var DDD=new Date(Invoice.updated_at);
                var Year=DDD.getFullYear();
                var  Months=DDD.getMonth()+1;
                var  Days=DDD.getDate();
                var Hour=DDD.getHours();
                var Minute=DDD.getMinutes();
                var meridian="AM";
                Hour=DDD.getHours();
                if(Hour>12)
                {
                    Hour=Hour-12;
                    meridian="PM";
                }

            //month=dateadvance.getMonth()+1;
                if(Months<10)
                {
                    Months="0"+Months;
                }
                if(Minute<10)
                {
                    Minute="0"+Minute;
                }

                var DDDDelivary=new Date(Invoice.DeliveryDate);
                var YearDelivary=DDDDelivary.getFullYear();
                var  MonthsDelivary=DDDDelivary.getMonth()+1;
                var  DaysDelivary=DDDDelivary.getDate();

                //var HourDelivary=DDDDelivary.getHours();
                //var MinuteDelivary=DDDDelivary.getMinutes();
                //var meridianDelivary="AM";
                //HourDelivary=DDDDelivary.getHours();
                //if(HourDelivary>12)
                //{
                    //HourDelivary=HourDelivary-12;
                    //meridianDelivary="PM";
                //}

            //month=dateadvance.getMonth()+1;
                if(MonthsDelivary<10)
                {
                    MonthsDelivary="0"+MonthsDelivary;
                }
                //if(MinuteDelivary<10)
                //{
                   // MinuteDelivary="0"+MinuteDelivary;
                //}

                var DDDNow=new Date();
                var YearNow=DDDNow.getFullYear();
                var  MonthsNow=DDDNow.getMonth()+1;
                var  DaysNow=DDDNow.getDate();
                var HourNow=DDDNow.getHours();
                var MinuteNow=DDDNow.getMinutes();
                var meridianNow="AM";
                HourNow=DDDNow.getHours();
                if(HourNow>12)
                {
                    HourNow=HourNow-12;
                    meridianNow="PM";
                }

                //month=dateadvance.getMonth()+1;
                if(MonthsNow<10)
                {
                    MonthsNow="0"+MonthsNow;
                }
                if(MinuteNow<10)
                {
                    MinuteNow="0"+MinuteNow;
                }



                $('#AdvanceInvoice').append('<h4><i class="fa fa-shopping-bag fa-lg"></i> Sales Invoice</h4>'+
                '<hr>');
                if(Shop.ShopLogo!="")
                $('#AdvanceInvoice').append(' <img src="/uploads/image/shop/'+Shop.ShopLogo+'" width=70 height=70 class="col-md-offset-5 img img-responsive">');

                $('#AdvanceInvoice').append('<h4>'+Shop.ShopName+'</h4>');

                $('#AdvanceInvoice').append('<table>');
                if(Shop.ShopAddress!="")
                $('#AdvanceInvoice').append('<br><tr><td>Address</td><td>:'+Shop.ShopAddress+'</td></tr>');
                if(Shop.Phone!="")
                $('#AdvanceInvoice').append('<br><tr><td>Phone</td><td>:'+Shop.Phone+'</td></tr>');

                if(Shop.Email!="")
                $('#AdvanceInvoice').append('<br><tr><td>Email</td><td>:'+Shop.Email+'</td></tr>');

                if(Shop.Website!="")
                $('#AdvanceInvoice').append('<br><tr><td>WebSite</td><td>:'+Shop.Website+'</td></tr>');

                if(Shop.VatRegNo!=""&&Shop.VatRegNo!=null)
                $('#AdvanceInvoice').append('<br><tr><td>Vat Reg</td><td>:'+Shop.VatRegNo+'</td></tr>');
                $('#AdvanceInvoice').append('</table>');
                $('#AdvanceInvoice').append('<hr>');
                $('#AdvanceInvoice').append('<table>');
                $//('#AdvanceInvoice').append('<tr><td>InvoiceID</td><td><strong>:'+Invoice.InvoiceID+'</strong></td>');
                $('#AdvanceInvoice').append('<br><tr><td>Invoice Date</td><td><strong>:'+Days+'/' +Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</strong></td>');
                $('#AdvanceInvoice').append('<br><tr><td>Print Date</td><td><strong>:'+DaysNow+'/' +MonthsNow+'/'+YearNow+' '+HourNow+':'+MinuteNow+''+meridianNow+'</strong></td>');
                $('#AdvanceInvoice').append('</table>');
                $('#AdvanceInvoice').append('<hr>');

                $('#AdvanceInvoice').append('<table><tr><th>#</th><th>Item/Description </th><th>SubTotal</th></tr>');
                var TotalQty=0;
                var TotalQty=0;
                var SubTotal=0;

                for(i=0;i<ItemQty;i++)
                {
                    j=i+1;
                    FinalPrice=Qty[i]*Price[i];
                    SubTotal   =SubTotal+FinalPrice;
                    Qty[i]=Math.floor(Qty[i]); 
                    TotalQty=TotalQty+Qty[i];
                    if(Qty[i]>0)
                    {
                       Price[i]=Math.floor(Price[i]);
                        //if(discount[i]>0)
                        //{
                         //$('#AdvanceInvoice').append('<tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']Dis-'+discount[i]+'<td>'+FinalPrice+'</td>');                        
                        //}
                        //if(discount[i]==0)
                         $('#AdvanceInvoice').append('<br><tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']<td>'+FinalPrice+'</td>');
                       
                    }
                }
                $('#AdvanceInvoice').append('</table>');
                $('#AdvanceInvoice').append('<hr>');
                //$('#AdvanceInvoice').append('<hr>Total Quantity: '+TotalQty+'<hr>');

                $('#AdvanceInvoice').append('<table>');
                $('#AdvanceInvoice').append('<tr><td>Sub Total</td><td> : <strong>'+SubTotal+'</strong></td></tr>');
                if(TotalDiscount>0)
                $('#AdvanceInvoice').append('<br><tr><td>Discount</td><td> : <strong>'+TotalDiscount+'</strong></td></tr>');
                if(TotalTax>0)
                $('#AdvanceInvoice').append('<br><tr><td>Tax Total</td><td> : <strong>'+TotalTax+'</strong></td></tr>');
                
                
                $('#AdvanceInvoice').append('<br><tr><td>Total</td><td> : <strong>'+TotalPrice+'</strong></td></tr>');
                $('#AdvanceInvoice').append('<br><tr><td>Adv. Paid:</td><td> : <strong>'+AdvancePaid+'</strong></td></tr>');
                $('#AdvanceInvoice').append('<br><tr><td>Due:</td><td> : <strong>'+Due+'</strong></td></tr>');
                $('#AdvanceInvoice').append('</table>');
                $('#AdvanceInvoice').append('<p class="InWords" style="text-transform: capitalize;">'+InWords+' '+Currency+' Only</p>');
                
                $('#AdvanceInvoice').append('<hr><table><tr><td>Customer Name</td><td>:'+CustomerName+'</td></tr>');
                $('#AdvanceInvoice').append('<tr><td>Phone</td><td>:'+Phone+'</td></tr>');
                $('#AdvanceInvoice').append('<br><tr><td>Address</td><td>:'+Address+'</td></tr>');
                $('#AdvanceInvoice').append('<br><tr><td>Delivary Date</td><td>:'+DaysDelivary+'/' +MonthsDelivary+'/'+YearDelivary+'</td></tr>');
                $('#AdvanceInvoice').append('</table>');
                    
    

                if(ShopFooter!="")
                {
                    $('#AdvanceInvoice').append('<hr><div class="InvoiceFooter">'+ShopFooter.Footer+'<div>')
                }

            $('#AdvanceInvoice').append(' <hr>Have a nice Day ! | <span class="">'+User.name+'</span><hr>');
            $('#AdvanceInvoice').append(' <div class="company-info">Software By: <span class="TechLab ">  '+Author+'</span>  01614777555<hr>');
            e.preventDefault(e);
            var contents = document.getElementById("AdvanceInvoice").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            //frame1.style.position = "absolute";
            //frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
            frameDoc.document.open();
            //frameDoc.document.write('<html><head><title>DIV Contents</title>');
            //frameDoc.document.write('</head><body>');
            frameDoc.document.write(contents);
            //frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            document.body.removeChild(frame1);
            }, 500);

            $('#AdvanceInvoicePrint').attr('disabled',false);
            $('#AdvanceConfirm').attr('disabled',true);

            },
            error:function(data)
            {

            }
        });
        //window.open('',"AdvanceWindow","width=297,height=700,left=500");
        //$('#AdvanceForm').submit();
        $('#AdvanceForm').hide();

        //$('#AdvanceModal').modal('hide');;
        $('#LoadFromAdvanceWithoutReload').val(1);

        for(i=0;i<cc;i++)
        {
            var q = $('input[name="productid[]"]').eq(i).closest('tr');
            q.hide();
            $('input[name="productid[]"]').eq(i).val(0);
            $('input[name="productid1[]"]').eq(i).val(0);
            $('input[name="productid2[]"]').eq(i).val(0);
        }

        $('#GrossFooterRow').hide();
        $('#FinalQuantity').hide();                
        $('#FinalItem').hide(); 
        $('#VatTotal').empty();
        $('#VatTotal').append(0);
        $('#SubTotal').empty();
        $('#SubTotal').append(0);
        $('#Total').empty();
        $('#Total').append(0);
        $('#AdvanceAmountValue').val(0);
        $('#AdvanceIDValue').val(0);  
        $('#myformProductList').empty();


        SubmitTest();
        TotalPriceCalculation();



    });

    // Add Product from Barcode scan
    $('#SidebarForm').on('submit', function(event) 
    {
        
        event.preventDefault();
        var p = 0;
        var BarcodeText = $('#saqlain').val();

        var S = BarcodeText.includes("S");
        var s=  BarcodeText.includes("s");

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
            var ShopID = BarcodeText[1];

            if(ShopID == '')
            {
                alertify.error('<strong><i class="fa fa-exclamation-triangle"></i> Invalid Barcode Number!</strong>');
            }

            $.get('/Sale/Product/ShopExistenceCheck/' + ProductID + '/' + ShopID, function(data) {                         

                if(data=="bad")
                {
                    $('#ShopExistenceCheck').val(0);
                    alertify.error('<strong><i class="fa fa-exclamation-triangle"></i> Incorrect Barcode Number!</strong>');
                }
                
                if(data=="good")
                {
                    $('#LoadFromAdvanceWithoutReload').val(0);
                    AddProductToCart(ProductID, ShopID);
                    alertify.success('<strong><i class="fa fa-check"></i> Product Added !</strong>');
                }              
            });
        }
        else
        {
            //alert("No Shop Information");
            ShopID=-1;
            var ProductID = $('#saqlain').val();
            $.get('/Sale/Product/ShopExistenceCheck/' + ProductID + '/' + ShopID, function(data) {

                                     

                if(data=="bad")
                {
                    $('#ShopExistenceCheck').val(0);
                    alertify.error('<strong><i class="fa fa-exclamation-triangle"></i> Incorrect Barcode Number!</strong>');
                }
                
                if(data=="good")
                {
                    $('#LoadFromAdvanceWithoutReload').val(0);
                    ShopID=$('#ShopID').val();
                    AddProductToCart(ProductID, ShopID);
                    alertify.success('<strong><i class="fa fa-check"></i> Product Added !</strong>');
                }              
            });

        } 

            // var S = $.session.get('ShopID');
            // alert(S);
            //alertify.error('<strong><i class="fa fa-exclamation-triangle"></i> Incorrect Barcode Number!</strong>');
            // AddProductToCart(ProductID,ShopID);
        
        // Clear the form field
        $('#saqlain').val('');
    });

    //Add Product From Onscreen Button
    $('.topitem').click(function() 
    {
        var x = $('#shop_user_name').val();
        var p = 0;
        var count = 0;
        var i = 0;
        var n;
        var p = $('[name="topitem[]"]').index(this);
        var productid = $('[name="hibuid[]"]').eq(p).val();
        var shopid = $('#IDofTheShop').val();

        $('#LoadFromAdvanceWithoutReload').val(0);
        AddProductToCart(productid, shopid);
        // alertify.success('<strong><i class="fa fa-check"></i> Product Added !</strong>');
    });

    

    $('#CategoryIDItemLookup').on('change',function()
    {
        FilterProductinItemLookup();
    });

    function FilterProductinItemLookup()
    {

        var all=$('#LookupProducts').val();
        var k=JSON.parse(all);
        var CategoryID =$('#CategoryIDItemLookup').val();
        var VendorID   = 0;            
        var task = $('#example33').DataTable();
        task.clear().draw();           

        for(i=0;i<k.length;i++)
        {

            if(CategoryID==0 && VendorID==0)
            {
                task.row.add(['<tr><td class="ItemLookupProductName btn   btn-app btn-block" name="ItemLookupProductName[]">'+
                '<span class="badge bg-purple">'+k[i].ProductID+'S'+k[i].ShopID+'</span>'+
                '<strong>'+k[i].ProductName+'</strong> <br> '+k[i].SalePrice+'<br>'+k[i].CategoryName+'</td>','<td class="text-right"> '+
                '<button class="btn btn-info   productdetail" name="productdetail[]" type="button" title="Details"><i class="fa fa-info"></i></button>'+
                '<input type="hidden" name="productmodalid[]" value="'+k[i].ProductID+'" class="productmodalid">'+
                '<input type="hidden" class=" productselect btn btn-success" name="productselect[]" value="'+k[i].ProductID+'"></td></tr>']).draw();
                
            }

            if(CategoryID==0 && VendorID==k[i].VendorID)
            {
                task.row.add(['<tr><td class="ItemLookupProductName btn   btn-app btn-block" name="ItemLookupProductName[]"><span class="badge bg-purple">'+k[i].ProductID+'S'+k[i].ShopID+'</span><strong>'+k[i].ProductName+'</strong> <br> '+k[i].SalePrice+'<br>'+k[i].CategoryName+'</td>','<td class="text-right"> <button class="btn btn-info   productdetail" name="productdetail[]" type="button" title="Details"><i class="fa fa-info"></i></button><input type="hidden" name="productmodalid[]" value="'+k[i].ProductID+'" class="productmodalid"><input type="hidden" class=" productselect btn btn-success" name="productselect[]" value="'+k[i].ProductID+'"></td></tr>']).draw();

            }


            if(CategoryID==k[i].CategoryID && VendorID==0)
            {
                task.row.add(['<tr><td class="ItemLookupProductName btn   btn-app btn-block" name="ItemLookupProductName[]"><span class="badge bg-purple">'+k[i].ProductID+'S'+k[i].ShopID+'</span><strong>'+k[i].ProductName+'</strong> <br> '+k[i].SalePrice+'<br>'+k[i].CategoryName+'</td>','<td class="text-right"> <button class="btn btn-info   productdetail" name="productdetail[]" type="button" title="Details"><i class="fa fa-info"></i></button><input type="hidden" name="productmodalid[]" value="'+k[i].ProductID+'" class="productmodalid"><input type="hidden" class=" productselect btn btn-success" name="productselect[]" value="'+k[i].ProductID+'"></td></tr>']).draw();
            }


            if(CategoryID==k[i].CategoryID && VendorID==k[i].VendorID)
            {
                task.row.add(['<tr><td class="ItemLookupProductName btn   btn-app btn-block" name="ItemLookupProductName[]"><span class="badge bg-purple">'+k[i].ProductID+'S'+k[i].ShopID+'</span><strong>'+k[i].ProductName+'</strong> <br> '+k[i].SalePrice+'<br>'+k[i].CategoryName+'</td>','<td class="text-right"> <button class="btn btn-info   productdetail" name="productdetail[]" type="button" title="Details"><i class="fa fa-info"></i></button><input type="hidden" name="productmodalid[]" value="'+k[i].ProductID+'" class="productmodalid"><input type="hidden" class=" productselect btn btn-success" name="productselect[]" value="'+k[i].ProductID+'"></td></tr>']).draw();
                
            }
        }
    }

    // Add Product to Cart
    function AddProductToCart(ProductID, ShopID,Quantity=1,Discount=0,Tax=0,TaxCode=0,TotalDiscount=0) 
    {
        //alert(Tax);

        var p = 0;
        var user_name = $('#shop_user_name').val();
        var count = 0;
        var i = 0;
        var n;
        var productcurrentquantity;
        $('#OrderPlace').removeClass('hidden');
        $.get('/Sale/Product/AddToCart/' + ProductID +'/'+ShopID, function(data) 
        {            
            var c = 0;
            var kaka = data.search;
            var dada = data.total;
            var l = JSON.parse(dada);
            var k = JSON.parse(kaka);

            for (i = 0; i < cc; i++) 
            {
                var ProductCheck = $('input[name="productid[]"]').eq(i).val();
                var ShopCheck=     $('input[name="Shop[]"]').eq(i).val();
                if (ProductCheck == k[0].ProductID && ShopCheck==ShopID) {
                    c = 1;
                    break;
                }
            }

            //Condition Where The product is added for the first time in the cart
            if (c == 0 && ProductID>0) 
            {
                cc = cc + 1;                
                $('#GrossFooterRow').show();
                $('#FinalQuantity').show();
                $('#FinalItem').show();                
                $('#TaxOverall').removeClass('disabled');
                $('#DiscountOverAll').removeClass('disabled');
                $('#OrderPlace').removeClass('hidden');               
                $('#PrintInvoice').removeClass('disabled');
                $('#SaleHold').removeClass('disabled');
                $('#tender').removeClass('disabled');
                $('#Cancel').removeClass('disabled');
                $('#Advance').removeClass('disabled');
                $('#keycodenumber').val(1);
                var SQty=parseInt(l[0].Qty,10);
                var MinQty=parseInt(k[0].MinQtyLevel,10);
                k[0].SalePrice=parseFloat(k[0].SalePrice, 2).toFixed(2);
                if(k[0].SalePrice % 1 === 0)
                {
                    k[0].SalePrice=parseFloat(k[0].SalePrice, 2).toFixed(0);
                }
                
                //var Multiply=parseFloat(k[0].SalePrice*Quantity,2).toFixed(0);

                //alert(Multiply);

                //amount=k[0].SalePrice;
                //alert(amount);
                //k[0].SalePrice=k[0].SalePrice.toFixed(2);
                if(k[0].TaxPercent==null)
                {
                    k[0].TaxPercent=0;
                    k[0].TaxCodeID=0;
                }

                CartTaxValue=k[0].TaxPercent*k[0].SalePrice*Quantity/100;
                if(Tax>0)
                {
                    CartTaxValue=Tax/Quantity;
                }

                $('#add').append('<div class="panelCartRow box box-solid box-default removeablerow" style="margin:0px 0px 1px 0px;">'+
                    '<input type="hidden" name="quan[]" class="quan" value="' + l[0].Qty + '">'+
                    '<input type="hidden" name="minlevel[]" class="minlevel" value="' + k[0].MinQtyLevel + '">'+
                    '<input type="hidden" name="productname[]" class="productname"  value="' + k[0].ProductName + '"> '+
                    '<input type="hidden" name="productid[]" class="productid " value="' + k[0].ProductID + '" readonly>'+
                    '<input type="hidden" name="Price[]" class="Price[]" value="' + k[0].SalePrice +'">'+
                    '<input type="hidden" name="final[]" class="final" value="' + k[0].SalePrice + '" readonly>'+
                    '<input type="hidden" name="discount[]" class="discount" value="'+Discount+'">'+
                    '<input type="hidden" name="tax[]" class="tax" value="' +CartTaxValue + '">'+
                    '<input type="hidden" name="Tax[]" class="Tax btn btn-sm" value="Tax">'+
                    '<input type="hidden" name="Shop[]" class="Shop" value="'+ShopID+'" >'+

                    '<div class="box-header CartRowHeader" style="padding:2px">'+
                        '<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="padding:1px;">'+
                        '<input type="button" class="total btn btn-sm btn-block" name="total[]" maxlength="5"; value="'+Quantity+'">'+
                        '</div>'+
                        '<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding:1px;">'+
                        '<a data-toggle="collapse" ng-click="chiliSpicy()" class="btn btn-sm btn-block" data-parent="#accordion" href="#CartRow'+k[0].ProductID+'" aria-expanded="false" class="collapsed">'+
                        k[0].ProductName+' <span class="label label-primary">'+k[0].ProductID+'S'+ShopID+'</span></a>'+                        
                        '</div>'+                        
                        '<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="padding:0px;"><strong><span name="SinglePrice[]" class="SinglePrice">'+k[0].SalePrice*Quantity+'</span></strong></div>'+                               
                        '<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="padding:0px;"><button class="removebutton btn btn-sm" name="removebutton[]"><i class="fa fa-trash fa-lg"></i></button></div>'+                    '</div>'+
                    '<div id="CartRow'+k[0].ProductID+'" class="panel-collapse collapse RowClear" name="RowClear[]" aria-expanded="false">'+
                    '<div class="box-body">'+
                        '<input type="button" name="PriceButton[]" class="PriceButton btn btn-sm"  value="'+k[0].SalePrice+'"> '+                        
                        '<input type="button" name="dismod[]" class="dismod btn btn-sm"  value="Discount"> '+                        
                        '<input type="button" name="TaxShow[]" class="TaxShow btn btn-sm" value="Tax"> '+                        
                        '<input type="button" name="saleman[]" class="saleman btn btn-sm"  value="' + user_name + '"> <br><br>'+
                        '<div class="input-group"><span class="input-group-addon"><i class="fa fa-tags"></i></span><input type="text" name="KOTComment[]" placeholder="Notes" class="form-control"></div>'+                            
                    '</div>'+
                  '</div>'+
                  '</div>');                   

                $('#myformProductList').append('<input type="hidden" name="taxvalue1[]" class="taxvalue1" value="0">');
                $('#CardProductArea').append('<input type="hidden" name="tax2[]" class="tax2" value="' +k[0].TaxCodeID + '">');

                ColorChecking(cc-1,SQty,MinQty);
                SingleProductPriceCalculation(cc-1);
                if(TotalDiscount>0)
                {
                    $('#TotalDiscountforInvoice').val(TotalDiscount);
                    TotalPriceCalculation();
                }
                else
                {
                    $('#TotalDiscountforInvoice').val(0);
                    TotalPriceCalculation();
                }                    
            }

            //*****Condition Where The Product is already in the cart*****//
            if (c == 1) 
            {
                n = parseInt($('input[name="total[]"]').eq(i).val(), 10) + 1;
                $('input[name="total[]"]').eq(i).val(n);
                //$('input[name="total1[]"]').eq(i).val(n);
                //$('input[name="total2[]"]').eq(i).val(n);
                SingleProductPriceCalculation(i);
                $('#TotalDiscountforInvoice').val(0);
                TotalPriceCalculation();
                var stq = 0;
                var da = $('[name="total[]"]').index(i);
                var minq = parseInt($('input[name="minlevel[]"]').eq(da).val(), 10);
                var shq = parseInt($('input[name="quan[]"]').eq(da).val(), 10);
                var usq = parseInt($('input[name="total[]"]').eq(da).val(), 10);
                var stq = shq - usq;
                ColorChecking(da,stq,minq);
                $('#TotalDiscountforInvoice').val(0);
                TotalPriceCalculation();
            }

            

            var InvoiceHide=$('#InvoiceIDforTender').val();
            //alert(InvoiceHide);
            if(InvoiceHide>0)
            {
                $('.removebutton').hide();
            }

            var dis = 0;


            //*****//Condition Where The Product is already in the cart*****//
            $('.dismod').unbind('click').click(function() 
            {
                var dis = $('[name="dismod[]"]').index(this);
                $('#idid').val(dis);
                $('#cash_discount').val(0);
                $('#percent').val(0);
                $('#percent').val(0);
                var url="DiscountSingle";
                $.get('SalesRole/'+url,function(data)                    
                {
                    if(data==1)
                    {
                        CookieCheck=$('#DiscountCookieCheck').val();
                        if(CookieCheck==1)
                        {
                            $('#dismodal').modal('show'); 
                        }
                                            }
                });                    
            });
                
            // Salesmane select
            $('.saleman').click(function() 
            {
                var usernam;
                var uss = $('input[name="saleman[]"]').index(this);
                $('#usid').val(uss);
                var url="SaleBy";

                $.get('SalesRole/'+url,function(data)
                {
                    if(data==0)                
                        $('#userselect').modal("hide");

                    if(data==1)
                        $('#userselect').modal("show");


                });
                //$('#userselect').modal("show");
                $('.usersel').click(function() {
                    var ind = $('input[name="usersel[]"]').index(this);
                    var userid = $('input[name="userid[]"]').eq(ind).val();
                    var usernam = $('input[name="usersel[]"]').eq(ind).val();
                    var ussr = $('#usid').val();
                    var uss = $('input[name="saleman[]"]').eq(ussr).val(usernam);
                    $('#userselect').modal("hide");
                });
            });

            // Single Tax Select
            $('.TaxShow').unbind('click').click(function(e) 
            {
                e.preventDefault();
                var Index=$('input[name="TaxShow[]"]').index(this);
                //alert(Index);
                //var taxs = $('input[name="Tax[]"]').index(this);
                $('#TaxID').val(Index);
                var url="VatSingleReset";
                $.get('SalesRole/'+url,function(data)
                {
                    if(data==0)
                        $('#TaxReset').hide();
                });



                var url="VatSingle"; 
                $.get('SalesRole/'+url,function(data)
                {
                    //alert("Fahad is a bad man");
                    if(data==1)
                    {

                        CookieCheck=$('#TaxCookieCheck').val();
                        if(CookieCheck==1)
                        {
                            //alert("Rezwan is a good man");
                            $('#TaxModal').modal("show");  
                        }
                                                }
                });                    
            });

            // Reset Tax
            $('#TaxReset').click(function()
            {
                var index = $('#TaxID').val();
                $('input[name="Tax[]"]').eq(index).val(0);
                $('input[name="tax[]"]').eq(index).val(0);
                $('input[name="tax1[]"]').eq(index).val(0);
                $('input[name="TaxShow[]"]').eq(index).val('Tax');

                $('#TaxModal').modal("hide");
                SingleProductPriceCalculation(index);
                $('#TotalDiscountforInvoice').val(0);
                TotalPriceCalculation();
            });

            // Overall Tax Select
            $('.TaxSelect').unbind('click').click(function() {

                var taxindex = $('input[name="TaxSelect[]"]').index(this);
                var taxvalue = parseInt($('input[name="TaxValue[]"]').eq(taxindex).val(), 10);
                //alert(taxvalue);
                var taxing = $('#TaxID').val();
                var Price=parseFloat($('[name="Price[]"]').eq(taxing).val(), 2);
                var TaxTotalforSingle=Price*taxvalue/100;

                //var VatMoney = $('[name="Price[]"]').eq(taxing).val() * taxvalue / 100;
                //var taxvalue1 = $('[name="Price[]"]').eq(taxing).val() * taxvalue / 100;
                $('input[name="Tax[]"]').eq(taxing).val(TaxTotalforSingle);
                $('input[name="tax[]"]').eq(taxing).val(TaxTotalforSingle);
                $('input[name="tax1[]"]').eq(taxing).val(TaxTotalforSingle);
                $('input[name="TaxShow[]"]').eq(taxing).val(TaxTotalforSingle);
                //$('input[name="taxvalue1[]"]').eq(taxing).val(VatMoney);
                SingleProductPriceCalculation(taxing);
                $('#TotalDiscountforInvoice').val(0);
                TotalPriceCalculation();
                $('#TaxModal').modal("hide");
            });


            // Single discount 
            $('#DiscountForm').on('submit',function(e) 
            {

                $('#allpercent').val(0);
                e.preventDefault();
                $('#percent').attr('disabled', false);
                $('#cash_discount').attr('disabled', false);
                var dis = $('#idid').val();
                var DiscountCash = $('#cash_discount').val();
                var SinglePercent = ($('#percent').val()) / 100 * $('input[name="Price[]"]').eq(dis).val()*$('[name="total[]"]').eq(dis).val();
                SinglePercent = SinglePercent.toFixed(2);
                var DiscountCashValue = $('#cash_discount').val();
                var DiscountParcentValue = $('#percent').val();
                if (DiscountCashValue >= 0 && DiscountParcentValue == 0) {
                    $('#SingleDiscountforCash').val(DiscountCashValue);
                    $('input[name="discount[]"]').eq(dis).val(DiscountCash);
                    $('input[name="discount1[]"]').eq(dis).val(DiscountCash);
                    $('input[name="discount2[]"]').eq(dis).val(DiscountCash);
                    $('input[name="dismod[]"]').eq(dis).val(DiscountCash);
                }
                if (DiscountParcentValue >= 0 && DiscountCashValue == 0) {
                    $('#DicountPercent').val(1);
                    $('#SingleDiscountforCash').val(0);
                    $('input[name="discount[]"]').eq(dis).val(SinglePercent);
                    $('input[name="discount1[]"]').eq(dis).val(SinglePercent);
                    $('input[name="discount2[]"]').eq(dis).val(SinglePercent);

                    $('input[name="dismod[]"]').eq(dis).val(SinglePercent);
                }
                SingleProductPriceCalculation(dis);
                $('#AllDiscountforCash').val(0);
                $('#TotalDiscountforInvoice').val(0);

                TotalPriceCalculation();
                $('#dismodal').modal('hide');
            });

            $('#dismodal').keyup(function() {
                var DiscountCashValue = $('#cash_discount').val();
                var DiscountParcentValue = $('#percent').val();
                if (DiscountCashValue > 0) {
                    $('#percent').attr('disabled', true);
                } else {
                    $('#percent').attr('disabled', false);
                }
                if (DiscountParcentValue > 0) {
                    $('#cash_discount').attr('disabled', true);
                } else {
                    $('#cash_discount').attr('disabled', false);
                }
            });

            // Overall discount 
            $('#discount').click(function() {
                $('#disca').val(0);
                $('#allpercent').val(0);
            });

            $('#taukir').keyup(function() {
                var zz;
                var bip = parseInt($('#Payable').val(), 10);
                var aa = parseInt($('#taukir').val(), 10);
                zz = bip - aa;
                $('#zia').val(zz);
            });

            $('#DiscountModal').keyup(function() 
            {
                var DiscountCashValue = $('#disca').val();
                var DiscountParcentValue = $('#allpercent').val();
                if (DiscountCashValue > 0) {
                    $('#allpercent').attr('disabled', true);
                } else {
                    $('#allpercent').attr('disabled', false);
                }
                if (DiscountParcentValue > 0) {
                    $('#disca').attr('disabled', true);
                } else {
                    $('#disca').attr('disabled', false);
                }
            });


            var Order  =$('#OrderIDforInvoice').val();
            //alert(Order);
            var Invoice=$('#InvoiceIDforTender').val();
            var Advance=$('#AdvanceIDValue').val();

            if(Order>0||Invoice>0||Advance>0)
            {
                if(Order>0)
                {
                    //alert("Saeed Anwar");
                    var url="RemoveOrderedItemFromCart";
                    $.get('SalesRole/'+url,function(data)

                    {
                        //alert(data);
                        if(data==0)
                        {
                            $('.removebutton').hide();
                        }
                        else
                        {
                            $('.removebutton').hide();
                        }
                    });
                }
                else if(Invoice>0)
                {
                    var url="RemoveInvoicedItemFromCart";
                    $.get('SalesRole/'+url,function(data)

                    {
                        if(data==0)
                        {
                            $('.removebutton').hide();
                        }
                        else
                        {
                            $('.removebutton').hide();
                        }
                    });

                }
                else if(Advance>0)
                {
                    var url="RemoveAdvancedItemFromCart";
                    $.get('SalesRole/'+url,function(data)

                    {
                        if(data==0)
                        {
                            $('.removebutton').hide();
                        }
                        else
                        {
                            $('.removebutton').show();
                        }

                    });



                }
            }

            // Remove Single Item form cart
            $('.removebutton').unbind('click').click(function(e)
            {
            
                e.preventDefault();                                                
                var RealTotal=0;
                var jet = 0;
                var p = 0;
                var p = $('[name="removebutton[]"]').index(this);
                $('input[name="final[]"]').eq(p).val(0);
                $('input[name="productid[]"]').eq(p).val(0);
                
                //$('input[name="total[]"]').eq(p).val(0);
                //$('input[name="final1[]"]').eq(p).val(0);
                //$('input[name="productid1[]"]').eq(p).val(0);
                //$('input[name="total1[]"]').eq(p).val(0);
                //$('input[name="total2[]"]').eq(p).val(0);
                //$('input[name="tax[]"]').eq(p).val(0);
                //$('input[name="final2[]"]').eq(p).val(0);
                //$('input[name="productid2[]"]').eq(p).val(0);
                //$('input[name="productname2[]"]').eq(p).val(0);
                //$('input[name="total2[]"]').eq(p).val(0);
                var q = $(this).closest('.removeablerow');
                var Delete=$(this).closest('.collapse');
                $('[name="RowClear[]"]').eq(p).attr('id',0);
            
                //var IDClearforCollapse=$(this).closest('.collapse');
                //IDClearforCollapse.attr("id",0);
                //productid.splice(p,1);
                //productid1.splice(p,1);
                //productid2.splice(p,1);
                q.hide();
                //alert("Now the New Array");
                //for(i=0;i<Total-1;i++)
                //{
                    //IDVal=$('input[name="productid[]"]').eq(i).val();
                    //alert(IDVal);
                //}

                

                for (rt = 0; rt < cc; rt++)
                 {
                    var productidvalue = $('input[name="productid[]"]').eq(rt).val();
                        if (productidvalue != 0)
                             RealTotal=RealTotal+1;
                 }

                if(RealTotal<=0)
                {
                    $('#TaxOverall').addClass('disabled');
                    $('#DiscountOverAll').addClass('disabled');
                    $('#SaleHold').addClass('disabled');
                    $('#tender').addClass('disabled');
                    $('#Cancel').addClass('disabled');
                    $('#Advance').addClass('disabled');
                    $('#OrderPlace').addClass('hidden');
                    $('#PrintInvoice').addClass('disabled');
                    $('#AdvanceAmountValue').val(0);
                    $('#GrossFooterRow').hide();
                    $('#FinalQuantity').hide();
                    $('#FinalItem').hide();
                }
                $('#TotalDiscountforInvoice').val(0);

                TotalPriceCalculation();                    
            });

            $('.total').click(function()
            {
                var quindex = $('[name="total[]"]').index(this);
                var shopquan=$('input[name="quan[]"]').eq(quindex).val();
                $('#ShopQuantity').val(shopquan);
                $('#quanindex').val(quindex);
                var url="CartQuantityChange"; 
                $.get('SalesRole/'+url,function(data)
                {
                    if(data==1)
                    {
                        $('#modalquanchange').val(1);
                        $('#quantityselect').modal("show");

                        $('#QuantityForm').on('submit',function(e)
                        {
                            e.preventDefault();                            
                            var xc = $('#quanindex').val();
                            var val = $('#modalquanchange').val();
                            if(val=="" || val==null)
                            {
                                return false;
                            }

                            $('[name="total[]"]').eq(xc).val(val);
                            //$('[name="total1[]"]').eq(xc).val(val);
                            //$('[name="total2[]"]').eq(xc).val(val);

                            var Check=$('#DicountPercent').val();

                            if(Check==1)
                            {
                                var alldiscountpercentage = parseInt($('#allpercent').val(), 10);
                                var quanval = $('[name="total[]"]').eq(xc).val();
                                if(alldiscountpercentage>0)
                                {
                                    var vv = alldiscountpercentage * $('input[name="Price[]"]').eq(xc).val() / 100*quanval;
                                    vv = vv.toFixed(2);
                                    $('input[name="discount[]"]').eq(xc).val(vv);
                                    //$('input[name="discount1[]"]').eq(xc).val(vv);
                                    //$('input[name="discount2[]"]').eq(xc).val(vv);
                                    $('input[name="dismod[]"]').eq(xc).val(vv);
                                }

                                var ppval=$('#percent').val();
                                if(ppval>0)
                                {
                                    var vv = ($('#percent').val()) / 100 * $('input[name="Price[]"]').eq(xc).val()*$('[name="total[]"]').eq(xc).val();
                                    vv = vv.toFixed(2);
                                    $('input[name="discount[]"]').eq(xc).val(vv);
                                    //$('input[name="discount1[]"]').eq(xc).val(vv);
                                    //$('input[name="discount2[]"]').eq(xc).val(vv);
                                    $('input[name="dismod[]"]').eq(xc).val(vv);
                                } 
                            }
                            SingleProductPriceCalculation(xc);
                            $('#TotalDiscountforInvoice').val(0);
                            TotalPriceCalculation();
                            var tot = $('[name="total[]"]').index(this);
                            var taq = $('input[name="minlevel[]"]').eq(xc).closest('tr');
                            var minlevel = $('input[name="minlevel[]"]').eq(xc).val();
                            var prevquan = $('input[name="quan[]"]').eq(xc).val();
                            var sellquan = $('input[name="total[]"]').eq(xc).val();
                            var remnquan = prevquan - sellquan;
                            var shq = parseInt($('input[name="quan[]"]').eq(xc).val(), 10);
                            var usq = parseInt($('input[name="total[]"]').eq(xc).val(), 10);
                            var stq = shq - usq;
                            ColorChecking(xc,stq,minlevel);

                            
                            if (sellquan < 1) {
                                taq.removeClass('bg-red');
                                taq.removeClass('bg-yellow');                                
                            }
                            $('#quantityselect').modal("hide");
                        });
                    }
                });
            });

            $('.PriceButton').click(function(e)
            {

                e.preventDefault();
                var index=$('input[name="PriceButton[]"]').index(this);
                $('#priceindex').val(index);
                var url="CartPriceChange";
                $.get('SalesRole/'+url,function(data)
                {

                    if(data==0)
                    {
                        return false;
                    }

                    if(data==1)
                    {

                        var Index=$('#priceindex').val();
                        var PriceVal=$('input[name="PriceButton[]"]').eq(Index).val();
                        $('#modalpricechange').val(PriceVal);
                        //alert(PriceVal);
                        $('#PriceSelect').modal("show");
                        $('#pricesel').on('click',function(e)
                        {

                            e.preventDefault();
                            var value=$('#modalpricechange').val();
                            var index=$('#priceindex').val();
                            $('input[name="PriceButton[]"]').eq(index).val(value);
                            $('input[name="Price[]"]').eq(index).val(value);
                            $('input[name="Price1[]"]').eq(index).val(value);
                            $('input[name="Price2[]"]').eq(index).val(value);

                            SingleProductPriceCalculation(index);
                            $('#TotalDiscountforInvoice').val(0);
                            TotalPriceCalculation();
                            $('#PriceSelect').modal("hide");
                        
                        });

                    }
                });                               
            });

            $('#PriceSelect').keypress(function (e) 
            {
                var key = e.which;
                if(key == 13) 
                {
                    $('#pricesel').click();
                    return false;
                }
            });        
        });       
    } 



    var url="Tender";

    $.get('SalesRole/'+url,function(data)
    {
        $('#tender').click(function(e)
        {
            e.preventDefault();

            $('#CardAmountShow').val(0);
            $('#CardHolderName').val('');
            $('#CardNumber').val('');
            
            
            var customertender=$('#Customerid').val();
            var Payable=parseFloat($('#Payable').val(),2);
            //alert(Payable);
            var advancevalue=parseFloat($('#AdvanceAmountValue').val(),2);
            $('#AdvanceTender').val(advancevalue);
            $('#AdvanceTenderDue').val(Payable-advancevalue);
            //$('#Payable').val();
            $('#Paid').val(Payable-advancevalue);
            var advancevalue=parseFloat($('#AdvanceAmountValue').val(),2);
            if(customertender>0)
            {
                $('#SubmitTender').attr('disabled',false);
            }
            if(customertender==0)
            {
                $('#SubmitTender').attr('disabled',true);
            }
            if(Payable==0)
            $('#SubmitTender').attr('disabled',true);
            
            $('#CashModal').modal('show');
            $('.nav-tabs a[href="#CashPaymentTab"]').tab('show');
            $('#cash').click(); 
        });
    });        
    
    function RoleChecking()
    {
        $('#GoToAdmin').hide();
        $('#customer').hide();
        $('.sales-summary').hide();
        $('.Balance').hide();
        $('.notice').hide();
        $('#AdvanceList').hide();
        $('#HoldList').hide();
        $('#DailyReport').hide();
        $('#TodaysSummary').hide();
        $('#Previousinvoice').hide();
        $('#PreviousAdvance').hide();
        $('#AddExpense').hide();
        $('#ShopExpense').hide();
        $('#InvoiceList').hide();
        $('#RefundList').hide();
        $('.topitem').hide();
        $('#CloseBalance').hide();
        $('#EditBalance').hide();
        $('#EditBalance2').hide();
        $('#OpenFahadBalance').hide();
        $('#OpenBalance2').hide();
        $('#OpenItem').hide();
        $('#OrderList').hide();

        var url="OrderList";

        $.get('SalesRole/'+url,function(data)
        {
            if(data==1)
            {
                $('#OrderList').show();
            }
        });

        var url="OpenItem";

        $.get('SalesRole/'+url,function(data)
        {
            if(data==1)
            {
                $('#OpenItem').show();
            }
        });

        var url="CloseBalance";

        $.get('SalesRole/'+url,function(data)
        {
            if(data==1)
            {
                $('#CloseBalance').show();
            }
        });


        var url="EditBalance";

        $.get('SalesRole/'+url,function(data)
        {
            if(data==1)
            {
                $('#EditBalance').show();
                $('#EditBalance2').show();
            }
        });


        var url="OpenBalance";

        $.get('SalesRole/'+url,function(data)
        {
            if(data==1)
            {
                $('#OpenFahadBalance').show();
                $('#OpenBalance2').show();
                
            }
        });

        var url="OSB";
        $.get('SalesRole/'+url,function(data)
        {
            if(data>0)
            {
                $('.topitem').show();
            }
        });

        var url="AdvancedList";
        $.get('SalesRole/'+url,function(data)
        {
            if(data>0)
            {
                $('#AdvanceList').show();
                $('#PreviousAdvance').show();
                AdvancedList();
            }
        });

    
        var url="HeldList";
        $.get('SalesRole/'+url,function(data)
        {
            if(data>0)
            {
                $('#HoldList').show();
                HoldList();                
            }
        });

        var url="InvoiceList";

        $.get('SalesRole/'+url,function(data)
        {
            if(data>0)
            {
                $('#InvoiceList').show();
                $('#Previousinvoice').show();              
            }
        });


        var url="RefundList";

        $.get('SalesRole/'+url,function(data)
        {
            if(data>0)
            {
                $('#RefundList').show();               
            }
        });


        var url="DailyReport";

        $.get('SalesRole/'+url,function(data)
        {
            if(data>0)
            {
                //alert("Something is absurd");
                $('#DailyReport').show();
                $('#TodaysSummary').show();
            }
        });
        var url="AddExpense";

        $.get('SalesRole/'+url,function(data)
        {

            if(data>0)
            {
                $('#ShopExpense').show();
                $('#AddExpense').show();
            }
        });


        var url="Dashboard";
        $.get('SalesRole/'+url,function(data)
        {
            if(data==1)
                $('#GoToAdmin').show();

        });

        var url="SalesSummary";

        $.get('SalesRole/'+url,function(data)
        {
            if(data==1)
                $('.sales-summary').show();

        });

        $url="BalanceSummary";
        $.get('SalesRole/'+$url,function(data)

        {
            if(data==1)
                $('.Balance').show();
        });

        var url="Notice";
        $.get('SalesRole/'+url,function(data)

        {
            if(data==1)
                $('.notice').show();
        });


        var url="CustomerSales"; 
        $.get('SalesRole/'+url,function(data)
        {
            if(data==1)                
                $('#customer').show();
        });


        var url="SearchProduct";

        $.get('SalesRole/'+url,function(data)
        {
           
        });

        var url="Refund";

        $.get('SalesRole/'+url,function(data)
        {
            if(data==1)
              $('#refund').attr('disabled',false);
            if(data==0)
              $('#refund').attr('disabled',true);
        });


        var url="Order";

        // $.get('SalesRole/'+url,function(data)
        // {
        //     if(data==1)
        //       $('#OrderPlace').removeClass('hidden');
        //     if(data==0)
        //       $('#OrderPlace').addClass('hidden');
        // });

        var url="Discount";
        $.get('SalesRole/'+url,function(data)
        {
            
            $('#DiscountOverAll').click(function()
            {
                $('#disca').val(0);
                $('#allpercent').val(0);
                $('#disca').attr('disabled',false);
                $('#allpercent').attr('disabled',false);
                if(data>0)
                $('#DiscountModal').modal('show');
                else
                $('#DiscountModal').modal('hide');
            });      
        });

        var url="Vat";

        $.get('SalesRole/'+url,function(data)
        {
            $('#TaxOverall').click(function()
            {
                if(data>0)               

                $('#TaxModalOverAll').modal('show');
                else
                $('#TaxModalOverAll').modal('hide');
            });                 
        });



        var url="Cancel";

        $.get('SalesRole/'+url,function(data)
        {                
            $('#Cancel').click(function()
            {
                if(data>0)
                DeleteCart();
            });
        });


        var url="Calculator";
        $.get('SalesRole/'+url,function(data)            
        {
            $('#Calculator').click(function()
            {
                $('#CalculatorModal').modal('show');
            });
        });            
        
         
        var url="SaleBy";
        $.get('SalesRole/'+url,function(data)
        {
            if(data==0)                
            $('.saleman').hide();
        });

        var url="ProductDetails";

        $.get('SalesRole/'+url,function(data)
        {
            if(data==0)                
            $('.productdetail').hide();
        });
    }

    function KeyCodeChecking(url,code)
    {
        $.get('SalesRole/'+url,function(data)
        {
            if(data>0)
                $('#keychecking').val(1);
            else
                $('#keychecking').val(0);                
        });            
    }

    //Color Checking of Each Row
    function ColorChecking(RowID,ShopQty,MinQty)
    {
        
        var taq = $('input[name="minlevel[]"]').eq(RowID).closest('.removeablerow');
        taq.removeClass('box-danger');
        taq.removeClass('box-warning');

        if(ShopQty<MinQty)
        {
            taq.addClass('box-warning');

            if(ShopQty < 0)
            {
                taq.removeClass('box-warning');
                taq.addClass('box-danger');
            }
        }
    }

    function SingleProductPriceCalculation(RowID) 
    {
        var TotalQuantity = parseFloat($('[name="total[]"]').eq(RowID).val(), 2);
        var FinalPrice = parseFloat($('[name="Price[]"]').eq(RowID).val(), 2);
        var Discount = parseFloat($('[name="discount[]"]').eq(RowID).val(), 2);
        var VatMoney = parseFloat($('[name="tax[]"]').eq(RowID).val(), 2);
        var VatTotal = TotalQuantity*VatMoney;
        var TotalPricee = TotalQuantity *FinalPrice;
        if(TotalPricee%1==0)
        {
         TotalPricee = TotalPricee.toFixed(0);
        }
        else            
        TotalPricee = TotalPricee.toFixed(2);
        
        $('input[name="final[]"]').eq(RowID).val(TotalPricee);
        //$('input[name="final1[]"]').eq(RowID).val(TotalPricee);
        //$('input[name="final2[]"]').eq(RowID).val(TotalPricee);
        $('input[name="taxvalue1[]"]').eq(RowID).val(VatTotal);
        $('input[name="Tax[]"]').eq(RowID).val(VatTotal);
        $('[name="SinglePrice[]"]').eq(RowID).empty();
        $('[name="SinglePrice[]"]').eq(RowID).append(TotalPricee);
    }

    function PaymentFromCard(Cardnum, CardName, CardAmountPaid, CardAmountPayable, Method) 
    {

        $('#SingleCardArea').empty();
        var vat = $('#taxoverall').val();
        var discount = $('#discountoverall').val();
        var subtotal = $('#subtotaloverall').val();

        var cardnumber = Cardnum;
        var cardholdername = CardName;
        var method = Method;
        var cus = $('#customerid').val();
       // alert("Customer ID is:"+cus);

    
        //var cus = $('#customerid').val();

        if (cus == 0) {
            var paid = CardAmountPayable;
            var payable = CardAmountPayable;
            var rrr = 0;         
        } else {
            var paid = CardAmountPaid;
            var payable = CardAmountPayable;
            var change = parseFloat(paid - payable, 2);
            rrr = change.toFixed(2);
            
        }
        alert("Change  of"+rrr);
        if (paid == "") paid = 0;
        var x = 10;
        var a = [];
        var pn = [];
        var tt = [];
        var pp = [];
        var ff = [];
        var dis = [];
        var tax = [];
        var discountall = parseFloat($('#discountoverall').val(),2).toFixed(2);
        var vat = parseFloat($('#taxoverall').val(),2).toFixed(2);
        var subtotal = $('#subtotaloverall').val();
        var Advanvalue=$('#AdvanceAmountValue').val();
        $('#OverAllDiscountforSplit').val(discountall);
        $('#OverAllSubTotalforSplit').val(subtotal);
        $('#OverAllTaxforSplit').val(vat);
        $('#AdvancePaymentValueforSplit').val(Advanvalue);
        $('#SplitPaymentForm').append('<input type="text" name="Amir" value="'+rrr+'">');
        $('#SingleCardArea').append('<input type="hidden" name="PaymentMethodID" value="'+method+'" >');
        $('#SingleCardArea').append('<input type="hidden" name="CardName" value="'+cardholdername+'" >');
        $('#SingleCardArea').append('<input type="hidden" name="CardNumber" value="'+cardnumber+'" >');
        $('#SingleCardArea').append('<input type="hidden" name="CardPaid" value="'+paid+'" >');
        $('#SingleCardArea').append('<input type="hidden" name="CashPaid" value="'+paid+'" >');
        $('#SingleCardArea').append('<input type="hidden" name="CardPayable" value="'+payable+'" >');
        $('#SingleCardArea').append('<input type="hidden" name="CardReturned" value="'+rrr+'" >');
        $('#SingleCardArea').append('<input type="hidden" name="CashChange" value="'+rrr+'" >');
        $('#SingleCardArea').append('<input type="hidden" name="CustomerCard" value="'+cus+'" >');
        $('#SingleCardArea').append('<input type="hidden" name="SingleCard" value="1" >');
        $('#SingleCardArea').append('<input type="hidden" name="AdvancePaymentValueSplit" value="'+Advanvalue+'" >');
        
         $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
        })
        //e.preventDefault(e);

        $.ajax({

        type:"POST",
        url:'/Sale/Tender/SplitPayment',
        data:$('#SplitPaymentForm').serialize(),
        success:function(data)
        {
            //alert("The Cash Paid Is:"+data);
            ItemQty=JSON.parse(data.ItemQty);
            FinalPrice=JSON.parse(data.FinalPrice);
            Price=JSON.parse(data.Price);
            ProductName=JSON.parse(data.ProductName);
            productid=JSON.parse(data.productid);
            Qty=JSON.parse(data.Qty);
            discount=JSON.parse(data.discount);
            User=JSON.parse(data.User);
            tt=JSON.parse(data.tt);
            paid=JSON.parse(data.paid);
            returned=JSON.parse(data.returned);
            Shop=JSON.parse(data.Shop);
            CustomerName=JSON.parse(data.CustomerName);
            vat=JSON.parse(data.vat);
            TotalDiscount=JSON.parse(data.TotalDiscount);
            subtotaltotal=JSON.parse(data.subtotaltotal);
            Invoice=JSON.parse(data.Invoice);
            InWords=JSON.parse(data.InWords);
            ProductID=JSON.parse(data.ProductID);
            ShopFooter=JSON.parse(data.ShopFooter);
            ShopID=JSON.parse(data.ShopID);
            AdvanceValue=JSON.parse(data.AdvanceValue);
            AdvanceValue=Math.floor(AdvanceValue);
            CashAmount=JSON.parse(data.CashAmount);
            CashAmount=Math.floor(CashAmount);
            CustomerPreviousBalance=JSON.parse(data.CustomerPreviousBalance);
            //alert(CustomerPreviousBalance);
            CustomerCurrentBalance=JSON.parse(data.CustomerCurrentBalance);
            CustomerTotalBalance=JSON.parse(data.CustomerTotalBalance);
            Author=JSON.parse(data.Author);
            Currency=JSON.parse(data.Currency);
            MethodName=JSON.parse(data.MethodName);
            CardAmount=JSON.parse(data.CardAmount);
            //alert(CardAmount[0]);
            $('#PrintRecipt').attr('disabled',false);


            TotalMethod=JSON.parse(data.MethodName);
            SingleCard=JSON.parse(data.SingleCard);
            $('#CurrencySymb').val(Currency);

            var DDD=new Date(Invoice.updated_at);
            var Year=DDD.getFullYear();
            var  Months=DDD.getMonth()+1;
            var  Days=DDD.getDate();
            var Hour=DDD.getHours();
            var Minute=DDD.getMinutes();
            var meridian="AM";
            Hour=DDD.getHours();
            if(Hour>12)
            {
                Hour=Hour-12;
                meridian="PM";
            }

            //month=dateadvance.getMonth()+1;
            if(Months<10)
            {
                Months="0"+Months;
            }
            if(Minute<10)
            {
                Minute="0"+Minute;
            }

            var DDDNow=new Date();
            var YearNow=DDDNow.getFullYear();
            var  MonthsNow=DDDNow.getMonth()+1;
            var  DaysNow=DDDNow.getDate();
            var HourNow=DDDNow.getHours();
            var MinuteNow=DDDNow.getMinutes();
            var meridianNow="AM";
            HourNow=DDDNow.getHours();
            if(HourNow>12)
            {
                HourNow=HourNow-12;
                meridianNow="PM";
            }

            //month=dateadvance.getMonth()+1;
            if(MonthsNow<10)
            {
                MonthsNow="0"+MonthsNow;
            }
            if(MinuteNow<10)
            {
                MinuteNow="0"+MinuteNow;
            }



            $('#SalesPanelRecipt').append('<h4><i class="fa fa-shopping-bag fa-lg"></i> Sales Invoice</h4>'+
            '<hr>');
            if(Shop.ShopLogo!="")
            $('#SalesPanelRecipt').append(' <img src="/uploads/image/shop/'+Shop.ShopLogo+'" width=70 height=70 class="col-md-offset-5 img img-responsive">');

            $('#SalesPanelRecipt').append('<h4>'+Shop.ShopName+'</h4>');

            $('#SalesPanelRecipt').append('<table>');
            if(Shop.ShopAddress!="")
                $('#SalesPanelRecipt').append('<tr><td>Address</td><td>:'+Shop.ShopAddress+'</td></tr>');
             if(Shop.Phone!="")
                $('#SalesPanelRecipt').append('<tr><td>Phone</td><td>:'+Shop.Phone+'</td></tr>');

            if(Shop.Email!="")
                $('#SalesPanelRecipt').append('<tr><td>Email</td><td>:'+Shop.Email+'</td></tr>');

            if(Shop.Website!="")
                $('#SalesPanelRecipt').append('<tr><td>WebSite</td><td>:'+Shop.Website+'</td></tr>');

            if(Shop.VatRegNo!=""&&Shop.VatRegNo!=null)
                $('#SalesPanelRecipt').append('<tr><td>Vat Reg</td><td>:'+Shop.VatRegNo+'</td></tr>');
            $('#SalesPanelRecipt').append('</table>');
            $('#SalesPanelRecipt').append('<hr>');
            $('#SalesPanelRecipt').append('<table>');
            $('#SalesPanelRecipt').append('<tr><td>InvoiceID</td><td><strong>:'+Invoice.InvoiceID+'</strong></td>');
            $('#SalesPanelRecipt').append('<tr><td>Invoice Date</td><td><strong>:'+Days+'/' +Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</strong></td>');
            $('#SalesPanelRecipt').append('<tr><td>Print Date</td><td><strong>:'+DaysNow+'/' +MonthsNow+'/'+YearNow+' '+HourNow+':'+MinuteNow+''+meridianNow+'</strong></td>');
            $('#SalesPanelRecipt').append('</table>');
            $('#SalesPanelRecipt').append('<hr>');

            $('#SalesPanelRecipt').append('<table><tr><th>#</th><th>Item/Description </th><th>Amount </th></tr>');
            var TotalQty=0;
            var SubTotal=0;

            for(i=0;i<ItemQty;i++)
            {
                j=i+1;
                FinalPrice=Qty[i]*Price[i];
                SubTotal   =SubTotal+FinalPrice;
                Qty[i]=Math.floor(Qty[i]); 
                TotalQty=TotalQty+Qty[i];
                if(Qty[i]>0)
                {
                   
                    if(discount[i]>0)
                    {
                     $('#SalesPanelRecipt').append('<tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']Dis-'+discount[i]+'<td>'+FinalPrice+'</td>');                        
                    }
                    if(discount[i]==0)
                     $('#SalesPanelRecipt').append('<tr><td><strong>'+j+'. </strong></td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>['+Qty[i]+'X'+Price[i]+']<td>'+FinalPrice+'</td>');
                   
                }
            }
            $('#SalesPanelRecipt').append('</table>');
            $('#SalesPanelRecipt').append('<hr>Total Quantity: '+TotalQty+'<hr>');

            $('#SalesPanelRecipt').append('<table>');
            $('#SalesPanelRecipt').append('<tr><td>Sub Total</td><td> : <strong>'+Invoice.SubTotal+'</strong></td></tr>');
            if(Invoice.TaxTotal>0)
            $('#SalesPanelRecipt').append('<tr><td>Tax Total</td><td> : <strong>'+Invoice.TaxTotal+'</strong></td></tr>');
            if(Invoice.ServiceCharge>0)
            $('#SalesPanelRecipt').append('<tr><td>ServiceCharge</td><td> : <strong>'+Invoice.ServiceCharge+'</strong></td></tr>');
            if(Invoice.Discount>0)
            $('#SalesPanelRecipt').append('<tr><td>Discount</td><td> : <strong>'+Invoice.Discount+'</strong></td></tr>');
            $('#SalesPanelRecipt').append('<tr><td>Total Due</td><td> : <strong>'+Invoice.Total+'</strong></td></tr>');
            
            //for(i=0;i<TotalMethod;i++)
           // {
            $('#SalesPanelRecipt').append('<tr><td colspan="2"><hr></td></tr>');
            $('#SalesPanelRecipt').append('<tr><td>'+MethodName[0]+'</td><td>:<strong>'+CardAmount[0]+'</strong></td></tr>');
          

            //}

            if(AdvanceValue>0)
            {
                $('#SalesPanelRecipt').append('<tr><td>Advance Paid:</td><td> : <strong>'+AdvanceValue+'</strong></td></tr>');
                $('#SalesPanelRecipt').append('<tr><td>Cash Due:</td><td> : <strong>'+CashAmount+'</strong></td></tr>');

            }

            if(Invoice.IsPaid==1)
            {
                $('#SalesPanelRecipt').append('<tr><td colspan="2"><hr></td></tr>');
                if(Invoice.PaidMoney>0)
                {
                $('#SalesPanelRecipt').append('<tr><td>Total Paid:</td><td> : <strong>'+Invoice.PaidMoney+'</strong></td></tr>');


                }
                if(Invoice.ReturnedMoney>0)
                {
                $('#SalesPanelRecipt').append('<tr><td>Changes:</td><td> : <strong>'+Invoice.ReturnedMoney+'</strong></td></tr>');


                }

            } 



            $('#SalesPanelRecipt').append('</table>');

            $('#SalesPanelRecipt').append('<p class="InWords" style="text-transform: capitalize;">'+InWords+' '+Currency+' Only</p>');
            if(CustomerName!="Annonymous")
            {
                $('#SalesPanelRecipt').append('<hr><table><tr><td>Customer</td><td>|'+CustomerName+'</td></tr>');
                if(CustomerPreviousBalance>0)
                {
                $('#SalesPanelRecipt').append('<tr><td>Previous Due</td><td>|'+CustomerPreviousBalance+'</td></tr>');


                }

                if(CustomerCurrentBalance>0)
                {
                $('#SalesPanelRecipt').append('<tr><td>Current Due</td><td>|'+CustomerCurrentBalance+'</td></tr>');
                $('#SalesPanelRecipt').append('<tr><td>Total Due</td><td>|'+CustomerTotalBalance+'</td></tr>');


                }

                $('#SalesPanelRecipt').append('</table>');
            }

            if(ShopFooter!="")
            {
                $('#SalesPanelRecipt').append('<hr><div class="InvoiceFooter">'+ShopFooter.Footer+'<div>')
            }

            $('#SalesPanelRecipt').append(' <hr>Have a nice Day ! | <span class="">'+User.FirstName+'</span><hr>');
            $('#SalesPanelRecipt').append(' <div class="company-info">Software By: <span class="TechLab">  '+Author+'</span>  01614777555<hr>');
            
            //e.preventDefault();
            var contents = document.getElementById("SalesPanelRecipt").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
            frameDoc.document.open();
            //frameDoc.document.write('<html><head><title>DIV Contents</title>');
            //frameDoc.document.write('</head><body>');
            frameDoc.document.write(contents);
            //frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            document.body.removeChild(frame1);
            }, 500);




            //var Booking=$('#BookingTest').val();
            //var ID=$('#KOTPrintOrderID').val();
            //var ParcelTest=$('#KOTPrintParcelTest').val();
            //return false;   

            $('#SubmitTenderCard').attr('disabled',true);
            PrintRecipt();
            
        },
        
         error: function(data){
            alert("Data Not Found");

        }

        });
        //window.open('',"SplitWindow","width=297,height=700,left=500");            
        //$('#SplitPaymentForm').submit();
        var IDValue=$('#AdvanceIDValue').val();
        if(IDValue>0)
        {
            $.get('/Sale/Advance/Delete/'+IDValue,function(data)
            {

            });
        }
        var HoldIDVal=$('#HoldIDValue').val();

        if(HoldIDVal>0)
        {
            $.get('/Sale/Hold/Delete/'+HoldIDVal,function(data)
            {

            });
        }

        //$('#PaymentCashModal').modal('hide');
        //$('#CashModal').modal('hide');
        //$('#PaymentCashModal').modal('hide');
        // $('#PaymentMasterCardModal').modal('hide');

        $('#AdvanceIDValue').val(0); 
        //$('body').removeClass('modal-open');
        //$('.modal-backdrop').remove();

        $.get('/Customer/Reset', function(data) {
            $('#Customerid').val(0);
            $('#customerid').val(0);
            $('#customername').empty();
            $('#customername').append('<a class="btn bg-blue" data-toggle="modal" data-target="#CustomerModal" id="customer">Customer</a>');
        });
        ValueReset();
        TotalPriceCalculation();
        //$('#SplitPaymentForm').empty();              
    }


    function SimpleCartClear()
    {
        //alert("I am Zikra Naik");

        for(i=0;i<cc;i++)
        {
            var q = $('input[name="productid[]"]').eq(i).closest('.removeablerow');
            q.hide();
            $('input[name="productid[]"]').eq(i).val(0);
            $('input[name="productid1[]"]').eq(i).val(0);
            $('input[name="productid2[]"]').eq(i).val(0);
            $('input[name="total[]"]').eq(i).val(0);
            $('input[name="total1[]"]').eq(i).val(0);
            $('input[name="tota2[]"]').eq(i).val(0);

            $('[name="RowClear[]"]').eq(i).attr('id',0);
        }

        TotalPriceCalculation();
        
        //$('#add').empty();

        cc=0;
        //$('#BottomInvoiceID').empty();
        //$('#BottomInvoiceID').append(0);
        //$('#BottomOrderID').empty();
        //$('#BottomOrderID').append(0);

    }

    function DeleteCart() 
    {
        alertify.confirm('<strong><i class="fa fa-shopping-cart"></i> Cart Clear </strong>','Are you sure to Reset all ?',function(){
            cc=0;

            $('#InvoiceIDforTender').val(0);
            $('#OrderIDforInvoice').val(0);
            $('#BottomInvoiceID').empty();
            $('#BottomInvoiceID').append(0);
            $('#BottomOrderID').empty();
            $('#BottomOrderID').append(0);

            $('#TableID').empty();
            $('#TableID').removeClass('bg-maroon');
            $('#TableID').addClass('bg-blue');
            $('#TableID').append('Table');
            $('#OrderIDforOrderUpdate').val(0);
            $('#CounterIDforList').val(0);
            $('#OrderCancel').hide();
            $('#RowforOrderDetails').hide();

            $('#OrderPlace').addClass('hidden');


            $('#GrossFooterRow').hide();
            $('#FinalQuantity').hide();                
            $('#FinalItem').hide();                
            $('#Cancel').addClass('disabled');
            $('#TaxOverall').addClass('disabled');
            $('#DiscountOverAll').addClass('disabled');
            $('#SaleHold').addClass('disabled');
            $('#tender').addClass('disabled');
            $('#Advance').addClass('disabled');
            $('#PrintInvoice').addClass('disabled');                     
            $('#add').empty();
            $('#VatTotal').empty();
            $('#VatTotal').append(0);
            $('#SubTotal').empty();
            $('#SubTotal').append(0);
            $('#Total').empty();
            $('#Total').append(0);
            $('#AdvanceAmountValue').val(0);
            TotalPriceCalculation();

            $.get('/Customer/Reset', function(data) {
                $('#Customerid').val(0);
                $('#customername').empty();
                $('#customername').append('<a class="btn bg-blue  " data-toggle="modal" data-target="#CustomerModal" id="customer" title="Customer">Customer</a>');
            });

            alertify.success('<strong><i class="fa fa-check"></i> Reset Success ! </strong>');
        },
        function(){
            alertify.error('<strong><i class="fa fa-exclamation-triangle"></i> Canceled</strong');
        }).show();
    }

    function DeleteCartWithoutConfirm() 
    {
        for(i=0;i<cc;i++)
        {
            $('input[name="productid[]"]').eq(i).val(0);
            $('input[name="productid1[]"]').eq(i).val(0);
            $('input[name="productid2[]"]').eq(i).val(0);
            var q = $('input[name="productid[]"]').eq(i).closest('tr');
            q.hide();
        }


        $('#OrderPlace').addClass('hidden');

        //$('#add').hide();
        $('#GrossFooterRow').hide();
        $('#FinalQuantity').hide();                
        $('#FinalItem').hide();            
        $('#Cancel').addClass('disabled');
        $('#TaxOverall').addClass('disabled');
        $('#DiscountOverAll').addClass('disabled');
        $('#SaleHold').addClass('disabled');
        $('#tender').addClass('disabled');
        $('#Advance').addClass('disabled');                 
        $('#add').empty();
        $('#VatTotal').empty();
        $('#VatTotal').append(0);
        $('#SubTotal').empty();
        $('#SubTotal').append(0);
        $('#Total').empty();
        $('#Total').append(0);
        $('#AdvanceAmountValue').val(0);
        $('#AdvanceIDValue').val(0);  
        $.get('/Customer/Reset', function(data) {
        $('#customerid').val(0);
        $('#Customerid').val(0);
        $('#customername').empty();
        $('#customername').append('<a class="btn bg-blue" data-toggle="modal" data-target="#CustomerModal" id="customer">Customer</a>');
        });                 
    }

    function CloseBalance() 
    {
        alertify.confirm('Close Balance','Are you Sure you want to Close Balance?',
        function(){
            
            var CashDrawerID = $('#CashDrawerID').val();
            var myWindow = window.open("/ClosingBalance/" + CashDrawerID, "", "width=297,height=700,left=500");
           
            $('#CloseBalance').hide();
            $('#CloseFahadBalance').hide();
            $('#EditBalance').hide();
            $('#EditFahadBalance').hide();
            $('#EditBalance2').hide();
            $('#OpenBalance').show();
            $('#OpenFahadBalance').show();
            $('#OpenBalance2').show();
            $('#OpeningBalanceValue').val(0);
            alertify.success('Balance Closed');
            $('.inner-content').addClass('hidden');
            
        },
        function(){
            alertify.error('<strong><i class="fa fa-exclamation-triangle"></i> Canceled</strong');
        }).set({transition:'zoom'}).show();
    }

    $('#OpenBalance').click(function()
    {
        $('#OpeningBalanceValue').val(0);
    });

    function NameCheck(FirstName)
    {

        $('#NameCheck').empty();

        if(FirstName=="")
        {
            $('#NameCheck').css('color','red');
            $('#NameCheck').append("Name field cannot be left blank");
            $('#AddCus').attr('disabled',true);
            return true;
        }
        $('#AddCus').attr('disabled',false);
        return true;            
    }

    function PhoneNumberCheck(PhoneNumber)
    {
        $('#AddCus').attr('disabled',true);


        if(PhoneNumber=="")
        {
            $('#AddCus').attr('disabled',true);
            $('#FirstName').attr('disabled',true);
            $('#LastName').attr('disabled',true);
            $('#Address').attr('disabled',true);
            $('#City').attr('disabled',true);
            $('#Province').attr('disabled',true);
            $('#Country').attr('disabled',true);
            $('#Email').attr('disabled',true);
            $('#Notes').attr('disabled',true);
            $('#ZipCode').attr('disabled',true);
            $('#DateOfBirth').attr('disabled',true);
            $('#CustomerImg').attr('disabled',true);                
            $('#PhoneCheck').css('color','red');
            $('#PhoneCheck').append("This field cannot be left blank");

            return true;

        }


        $.get('ajax-phone-check/'+PhoneNumber,function(data)
        {
            if(data==1)
            {
                $('#AddCus').attr('disabled',false);
            }

            if(data==0)
            {
                $('#AddCus').attr('disabled',true);
                $('#FirstName').attr('disabled',true);
                $('#LastName').attr('disabled',true);
                $('#Address').attr('disabled',true);
                $('#City').attr('disabled',true);
                $('#Province').attr('disabled',true);
                $('#Country').attr('disabled',true);
                $('#Email').attr('disabled',true);
                $('#Notes').attr('disabled',true);
                $('#ZipCode').attr('disabled',true);
                $('#DateOfBirth').attr('disabled',true);
                $('#CustomerImg').attr('disabled',true);            
                $('#PhoneCheck').css('color','red');
                $('#PhoneCheck').append("This Number is not Available");

            }
        });

        return true;
    }

    function ValueReset()
    {
        $('#SingleCardBody').empty();
        $('#CardProductArea').empty();
        $('#CashSaleForm').empty();
        $('#add').empty();
        $('#SplitCardMethods').empty();
        $('#SingleCardArea').empty();
        $('#myformProductList').empty();
        $('#CardProductArea').empty();
        $('#OrderFormforUpdate').empty();
        $('#OrderForm').empty();
        $('#GrossFooterRow').empty();
        $('#FinalQuantity').hide();                
        $('#FinalItem').hide();
        $('#Cancel').addClass('disabled');
        $('#TaxOverall').addClass('disabled');
        $('#DiscountOverAll').addClass('disabled');
        $('#SaleHold').addClass('disabled');
        $('#tender').addClass('disabled');
        $('#Advance').addClass('disabled');
        $('#PrintInvoice').addClass('disabled');

        for(i=0;i<cc;i++)
        {
            $('input[name="productid[]"]').eq(i).val(0);
            $('input[name="productid1[]"]').eq(i).val(0);
            $('input[name="productid2[]"]').eq(i).val(0);
        }
        cc=0;

        $('Customerid').val(0);
        $('customerid').val(0);
        $('#PreviousAdvanceCheck').val(0);
        $('#AdvanceIDValue').val(0);
        $('#HoldIDValue').val(0);
        $('#AdvanceAmountValue').val(0);
        $('#AdvanceDueValue').val(0);
        $('#AdvancePayableValue').val(0);
        $('#keychecking').val(0);
        $('#CardPaymentMethodID').val(0);
        $('#CardPaymentMethodName').val(0);
        $('#CustomerBalance').val(0);
        $('#taxoverall').val(0);
        $('#discountoverall').val(0);
        $('#subtotaloverall').val(0);
        $('#OrderIDforInvoice').val(0);
        $('#InvoiceIDforTender').val(0);
        $('#AllDiscountforCash').val(0);
        $('#AllDiscountforPercentage').val(0);
        $('#SingleDiscountforCash').val(0);
        $('#SingleDiscountforPercentage').val(0);
        $('#LoadInvoicefromList').val(0);
        $('#TotalDiscountforInvoice').val(0);
        $('#TotalDiscountforInvoiceforAdvance').val(0);
        $('#NoLoadFromInvoicePrint').val(0);
        $('#NoLoadFromOrderPrint').val(0);
        $('#DicountPercent').val(0);
        $('#AdvanceTender').val(0);
        $('#AdvanceTenderDue').val(0);
        $('#ExactTenderAmount').val(0);
        $('#Change').val(0);
        $('#Payable').val(0);
        $('#PayableCard').val(0);
        $('#Paid').val(0);
    }

    function RefundInvoiCheck()
    {

        $('#RefundID').attr('disabled',false);
        $('#RefundBarcodeID').attr('disabled',false);
        $('#RefundID').on('input',function(e)
        {
            e.preventDefault();
            $('#RefProBody').empty();
            $('#RefundforProduct').empty();   
            var Invoice=$('#RefundID').val();
            if( Invoice=="")
            {

            }
            else
            {
                $('#RefProBody').hide();
                $('#RefProID').hide();
                $('.RefundProductIDFooter').hide();                    
                $('#RefundProductByID').hide();
                $('#RefInvID').show();
                $('.RefundInvoiceFooter').show();
            }            
        });


        //Condition Where Barcode is used for refund,
        $('#RefundBarcodeID').on('input',function()
        {
            $('#RefundforInvoice').empty();
            $('#ree').empty();
            var BarCode=$('#RefundBarcodeID').val();

            if(BarCode=="")
            {

            }
            else
            {

                $('#RefProBody').show();
                $('#RefProID').show();
                $('.RefundProductIDFooter').show();
                $('#RefundProductByID').show();
                $('#RefInvID').hide();
                $('.RefundInvoiceFooter').hide();
            }
        }); 
    }

    $('#CompletedOrdersList tbody').on('click', '.OrderPrintforCompleted', function ()
    {
        var tr = $(this).closest("tr");
        var index = tr.index();
        var IDs=$('[name="OrderPrintforCompleted[]"]').index(this);
        var ID=$('input[name="InvoiceIDforCompletedOrder[]"]').eq(index).val();
        window.open("/Invoice/Sales/Print/" +ID, "", "width=300,height=750,left=500");          
    });

    $('#CompletedOrdersList tbody').on('click', '.OrderDetailsforCompleted', function ()
    {
        var tr = $(this).closest("tr");
        var index = tr.index();
        var ID=$('input[name="OrderIDforList[]"]').eq(index).val();

        $.get('/Sale/Order/Details/'+ID,function(data)
        {

            $('#AddOrderList').empty();
            var ProductID  =JSON.parse(data.ProductID);
            var ProductName=JSON.parse(data.ProductName);
            var ShopID     =JSON.parse(data.ShopID);
            var Qty        =JSON.parse(data.Qty);
            var Price      =JSON.parse(data.Price);
            var Timing       =JSON.parse(data.SubOrder);
            var TotalPrice   =JSON.parse(data.TotalPrice);
            var TotalTax     =JSON.parse(data.TotalTax);

            for(i=0;i<ProductID.length;i++)
            {
                k=i+1;
                var DDD=new Date(Timing[i].created_at);
                var Year=DDD.getFullYear();
                var  Months=DDD.getMonth()+1;
                var  Days=DDD.getDate();
                var Hour=DDD.getHours();
                var Minute=DDD.getMinutes();
                var meridian="AM";
                Hour=DDD.getHours();
                if(Hour>12)
                {
                    Hour=Hour-12;
                    meridian="PM";
                }

                if(Months<10)
                {
                    Months="0"+Months;
                }

                if(Minute<10)
                {
                    Minute="0"+Minute;
                }

                

                Multiply=parseFloat(Price[i],10)*parseFloat(Qty[i],10);
        
                $('#AddOrderList').append('<tr><td>'+k+'</td><td>'+ProductName[i]+'['+ProductID[i]+'S'+ShopID[i]+']<br>'+
                '['+Price[i]+'X'+Qty[i]+']</td><td>'+Multiply+'</td><td>'+Days+'/'+Months+'/'+Year+' '+Hour+':'+Minute+''+meridian+'</td></tr>');
            }

            var OverAllTotalPrice=TotalPrice+TotalTax;
            $('#AddOrderList').append(''+
            '<tr><td><strong>SubTotal:</strong></td>'+
            '<td><strong>'+TotalPrice+'</strong></td></tr><tr><td><strong>Total Tax:</strong></td>'+
            '<td><strong>'+TotalTax+'</strong></td></tr><tr><td><strong>Total Price:</strong></td>'+
            '<td><strong>'+OverAllTotalPrice+'</strong></td></tr>'+                
            '</tr>');
            $('#OrderDetailsModal').modal('show');
            DeleteCartWithoutConfirm();
        });                    
    });

    function SubmitTest()
    {

        $('#OrderPlace').addClass('hidden');
        $('#Payable').val(0);
        $('#Paid').val(0);
        $('#Change').val(0);
        $('#TableID').empty();
        $('#BottomOrderID').empty();
        $('#BottomOrderID').append(0);
        $('#BottomInvoiceID').empty();
        $('#BottomInvoiceID').append(0);
        //$('#CounterIDforList').val(0);
        $('#TableID').removeClass('bg-maroon');
        $('#TableID').addClass('bg-blue');
        $('#TableID').append("Table");
        //$('#SelectTableModal').modal('hide');

        
        $('#OrderIDforOrderUpdate').val(0);
        $('#CounterIDforList').val(0);
        $('#RowforOrderDetails').hide();
        $('#OrderCancel').hide();
        $('#Total').empty();
        $('#HiddenArea').empty();
        $('#HiddenArea').append('<input type="hidden" value="0" id="Customerid">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="PreviousAdvanceCheck">'); 
        $('#HiddenArea').append('<input type="hidden"   value="0" id="AdvanceIDValue">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="HoldIDValue">'); 
        $('#HiddenArea').append('<input type="hidden"   value="0" id="AdvanceAmountValue">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="AdvanceDueValue">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="AdvancePayableValue">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="keychecking">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="CardPaymentMethodID">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="CardPaymentMethodName">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="CustomerBalance">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="taxoverall">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="discountoverall">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="subtotaloverall">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="OrderIDforInvoice">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="InvoiceIDforTender"> '); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="AllDiscountforCash">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="AllDiscountforPercentage">');
        $('#HiddenArea').append('<input type="hidden" value="0" id="SingleDiscountforCash">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="SingleDiscountforPercentage">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="LoadInvoicefromList">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="TotalDiscountforInvoice">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="TotalDiscountforInvoiceforAdvance">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="NoLoadFromInvoicePrint">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="NoLoadFromOrderPrint">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="DicountPercent">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="HoldIDforDelete">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="IndexIDforHoldDelete">'); 
        $('#HiddenArea').append('<input type="hidden" value="0" id="LoadFromAdvanceWithoutReload">'); 
        $('#HiddenArea').append('<input type="hidden"   value="0" id="ImranKhan">'); 
        $('#add').empty();
        $('#CashSaleForm').empty();
        $('#add').empty();
        $('#AdvanceForm').empty();
        $('#SplitCardMethods').empty();
        $('#SingleCardArea').empty();
        $('#myformProductList').empty();
        $('#CardProductArea').empty();
        $('#AdvanceAmountValue').val(0);
        $('#GrossFooterRow').empty();
        $('#TotalArea').empty();
        $('#OrderSpecial').empty();
        $('#AllDiscountforCash').val(0);
        $('#discountoverall').val(0);

        cc=0;
    }
    function TotalPriceCalculation() 
    {


        $('#Total').empty();
        $('#DiscountTotal').empty();
        $('#VatTotal').empty();
        $('#SubTotal').empty();
        $('#ServiceCharge').empty();
        $('#ServiceCharge').append();
        
        var totalpricevalue = 0;
        var totaldiscountvalue = 0;
        var totalvatvalue = 0;
        var totalsubtotalvalue = 0;
        var convertedprice = 0;
        var singlequantity = 0;
        var vatmoney = 0;
        var vattotal = 0;
        var servicecharge=0;
        var servicecheck=$('#ServiceCookieCheck').val();
        if(servicecheck>0)
            var servicevaluecheck=$('#ServiceChargeCookieCheck').val();
        else
            var servicevaluecheck=0;

        //alert(servicevaluecheck);
        var n = 0;       

        for (j = 0; j < cc; j++)
         {
            var productidvalue = $('input[name="productid[]"]').eq(j).val();
            //alert(productidvalue);
            if (productidvalue != 0 &&productidvalue!="" && productidvalue!=null)
             {

                n = $('input[name="total[]"]').eq(j).val();

                var finalprice = parseFloat($('[name="Price[]"]').eq(j).val(), 2);
                vatcode = parseFloat($('[name="Tax[]"]').eq(j).val(), 2);
                /*$.get('/Sale/Vat/CodetoPercentage/'+vatcode,function(data)
                {
                    $('#CodetoValue').val(data);

                });*/

                //vatmoney=parseFloat($('#CodetoValue').val(),2);

                vatmoney = parseFloat($('[name="Tax[]"]').eq(j).val(), 2);
                vattotal =vatmoney;
                totalsubtotalvalue = totalsubtotalvalue + n * parseFloat($('input[name="Price[]"]').eq(j).val(), 2);
                //totalsubtotalvalue = totalsubtotalvalue + n * parseFloat($('input[name="Price[]"]').eq(j).val(), 2);

                totalpricevalue = totalpricevalue + parseFloat($('input[name="final[]"]').eq(j).val(), 2);
                //alert(totalpricevalue)
                var DiscountCheck=$('#AllDiscountforCash').val();
                //alert(DiscountCheck);
                var SingleDiscountCheck=$('#SingleDiscountforCash').val();
                if(DiscountCheck==0 && SingleDiscountCheck==0)
                totaldiscountvalue = totaldiscountvalue + parseFloat($('input[name="discount[]"]').eq(j).val(), 2);
                else
                { 
                    if(DiscountCheck!=0)
                    totaldiscountvalue = DiscountCheck;
                    if(SingleDiscountCheck!=0)
                        totaldiscountvalue = totaldiscountvalue +parseFloat($('input[name="discount[]"]').eq(j).val(), 2);
                     //totaldiscountvalue = SingleDiscountCheck;
                }
                totalvatvalue = totalvatvalue + vattotal;
            }
            //var KOTTest=$('#LoadFromKOT').val();
           // if(KOTTest==1)
            //{
                //totalvatvalue=0;

            //}
        }        

        servicecharge=parseFloat(servicevaluecheck*totalsubtotalvalue/100,2);

        var Dis=$('#TotalDiscountforInvoice').val();
        var AdvanceDis=$('#TotalDiscountforInvoiceforAdvance').val();

        if(Dis>0)
        {
            totaldiscountvalue=Dis;
        }

        if(AdvanceDis>0)
        {
            totaldiscountvalue=AdvanceDis;
        }
        GrandValue=totalsubtotalvalue+totalvatvalue-totaldiscountvalue+servicecharge;

        TotalQuanInTheCart=0;
        TotalItemInTheCart=0;

        for (j = 0; j < cc; j++)
         {
            var productidvalue = $('input[name="productid[]"]').eq(j).val();
            if (productidvalue != 0) 
            {
                n = parseInt($('input[name="total[]"]').eq(j).val(),10);
                TotalQuanInTheCart=TotalQuanInTheCart+n;
                TotalItemInTheCart++;
            }
         }
        $('#InvoiceTotalQty').empty();
        $('#InvoiceTotalItem').empty();

        $('#InvoiceTotalQty').append(TotalQuanInTheCart);
        $('#InvoiceTotalItem').append(TotalItemInTheCart);
        convertedprice = GrandValue.toFixed(2);
        $('#Total').append(convertedprice);
        $('#ServiceCharge').append(servicecharge);
        $('#DiscountTotal').append(totaldiscountvalue);
        $('#taxoverall').val(totalvatvalue);
        $('#subtotaloverall').val(totalsubtotalvalue);
        $('#discountoverall').val(totaldiscountvalue);
        $('#VatTotal').append(totalvatvalue);
        $('#SubTotal').append(totalsubtotalvalue);
        $('#ttt').val(convertedprice);
        $('#Payable').val(convertedprice);
        var Advalue        =$('#AdvanceAmountValue').val();
        if(Advalue>0)
        {
            AdvanceValue=convertedprice-Advalue;
            $('#PayableCard').val(AdvanceValue);
            $('#Payable').val(AdvanceValue);           
        }
        else
        {
            $('#PayableCard').val(convertedprice);
            $('#PayableAECard').val(convertedprice);
            $('#PayableVisaCard').val(convertedprice);
            $('#PayableBKashCard').val(convertedprice);
            $('#PayableRocketCard').val(convertedprice);

        }
        $('#GrossFooterRow').empty();
        $('#GrossFooterRow').append('<tr class="bg-purple">'+
        '<th colspan="3" class="text-center ">Gross Total</th>'+
        '<th><span id="SubTotal">'+totalsubtotalvalue+'</span></th>'+
        '<th><span id="VatTotal">'+totalvatvalue+'</span></th>'+
        '<th><span id="DiscountTotal">'+totaldiscountvalue+'</span></th>'+
        '<th colspan="2"></th>'+
        '</tr>');

            $('#TotalArea').empty();
            $('#TotalArea').append('<strong id="FinalItem"> Total Item :'+TotalItemInTheCart+' |</strong>'+ 
            '<strong id="FinalQuantity" >Total Quantity :'+TotalQuanInTheCart+'</strong>');            
    }

    /*function ListToTicket()
    {
        var OrderID=$('#OrderIDforOrderUpdate').val();
        $('#OrderTicketForm').append('<input type="hidden" name="DetailsID" value="'+OrderID+'">');
        window.open('',"OrderTicketWindow","width=297,height=700,left=500");
        $('#OrderTicketForm').submit();
    }*/

    function ListToCart()
    {
        SimpleCartClear();
        
    }

    function PrintRecipt()
    {
        e.preventDefault();
        var contents = document.getElementById("SalesPanelRecipt").innerHTML;
        var frame1 = document.createElement('iframe');
        frame1.name = "frame1";
        //frame1.style.position = "absolute";
        //frame1.style.top = "-1000000px";
        document.body.appendChild(frame1);
        var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument; 
        frameDoc.document.open();
        //frameDoc.document.write('<html><head><title>DIV Contents</title>');
        //frameDoc.document.write('</head><body>');
        frameDoc.document.write(contents);
        //frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        document.body.removeChild(frame1);
        }, 500);

        var Booking=$('#BookingTest').val();
        var ID=$('#KOTPrintOrderID').val();
        var ParcelTest=$('#KOTPrintParcelTest').val();
        return false;   

    }

    //ProductID, ShopID,Quantity=1,Discount=0,Tax=0,TaxCode=0,TotalDiscount=0

    function AddProductToCartSecond(ProductID, ShopID,Quantity=1,ProductName,Price,Discount=0,Tax=0,TaxCode=0,TotalDiscount=0)
    {

        cc=cc+1;

        var p = 0;
        var user_name = $('#shop_user_name').val();
        var count = 0;
        var i = 0;
        var n;
        var productcurrentquantity;
        $('#OrderPlace').removeClass('hidden');
        Discount=0;
        CartTaxValue=1;
        Qty=1;
        SalePrice=Price;
        SalePrice=Math.floor(SalePrice);
        Tax=0;

        /*if(k[0].TaxPercent==null)
        {
            k[0].TaxPercent=0;
            k[0].TaxCodeID=0;
        }

        //CartTaxValue=k[0].TaxPercent*k[0].SalePrice*Quantity/100;
        if(Tax>0)
        {
            CartTaxValue=Tax/Quantity;
        }*/
        CartTaxValue=0; 

        //ProductID=11;
        //ProductName="Soup";
        //ShopID=1;
        //Quantity=3;
          

        $('#add').append('<div class="panelCartRow box box-solid box-default removeablerow" style="margin: 0px 0px 1px 0px;" ">'+
            '<div class="box-header CartRowHeader">'+
                '<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">'+
                '<a data-toggle="collapse" data-parent="#accordion" href="#CartRow'+ProductID+'" aria-expanded="false" class="collapsed">'+
                '<strong>'+ProductName+'['+ProductID+'S'+ShopID+']</strong>'+
                '</a>'+
                '</div><input type="hidden" name="quan[]" class="quan" value="' +Qty + '">'+
                '<input type="hidden" name="minlevel[]" class="minlevel" value="' +MinQtyLevel + '"><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">'+
                '<input readonly type="hidden" class="productname" name="productname[]" value="' +ProductName + '"> '+'<input type="hidden" class="productid " name="productid[]" value="' +ProductID + '" readonly>'+
                '<strong><input type="button" class="total cart-button" name="total[]" maxlength="5"; value="'+Quantity+'"></strong></div>'+'  '+
                '<input type="hidden" class="final" name="final[]" value="' + SalePrice + '" readonly>'+
                '<input type="hidden" name="Price[]" class="Price[]" value="' +SalePrice +'"><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><strong><input type="button" class="PriceButton cart-button" name="PriceButton[]" value="'+SalePrice+'">'+'</strong></div>'+
                '<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><strong><span name="SinglePrice[]" class="SinglePrice">'+SalePrice*Quantity+'</span></strong></div>'+
                 
                '<input type="hidden" name="Shop[]" class="Shop" value="'+ShopID+'" >'+
                //'<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><button class="removebutton cart-button " name="removebutton[]"><i class="fa fa-trash fa-lg"></i></button></div>'+

            '</div>'+
            '<div id="CartRow'+ProductID+'" class="panel-collapse collapse RowClear" name="RowClear[]" aria-expanded="false">'+

                '<div class="box-body">'+
                    '<input type="hidden" class="discount " name="discount[]" value="'+Discount+'">'+
                    '<input type="button" class="dismod cart-button"  name="dismod[]" value="Discount">'+
                    '<input type="hidden" class="tax" name="tax[]" value="' +CartTaxValue + '">'+
                    '<input type="button" class="TaxShow cart-button" name="TaxShow[]" value="Tax">'+
                    '<input type="hidden" class="Tax cart-button" name="Tax[]" value="'+Tax+'">'+
                    '<input type="button" class="saleman cart-button"  name="saleman[]" value="' + user_name + '"  >'+
                    '<br><input type="text" name="KOTComment[]" placeholder="Notes" class="form-control">'+                            
                '</div>'+
              '</div>'+

            
              '</div>');

        TaxValuee=0;


         $('#add').append('<input type="hidden" name="taxvalue1[]" class="taxvalue1" value="'+TaxValuee+'">');
                
         //$('#add').append('<input type="hidden" name="tax2[]" class="tax2" value="' +k[0].TaxCodeID + '">');


            $('.saleman').unbind('click').click(function(e) 
            {

            e.preventDefault();
            var usernam;
            var uss = $('input[name="saleman[]"]').index(this);
            $('#usid').val(uss);
            var url="SaleBy";

            $.get('SalesRole/'+url,function(data)
            {
            if(data==0)                
            $('#userselect').modal("hide");

            if(data==1)
            $('#userselect').modal("show");


            });
            //$('#userselect').modal("show");
            $('.usersel').click(function() {
            var ind = $('input[name="usersel[]"]').index(this);
            var userid = $('input[name="userid[]"]').eq(ind).val();
            var usernam = $('input[name="usersel[]"]').eq(ind).val();
            var ussr = $('#usid').val();
            var uss = $('input[name="saleman[]"]').eq(ussr).val(usernam);
            $('#userselect').modal("hide");
            });
            });

            $('.TaxShow').unbind('click').click(function(e) 
            {
                e.preventDefault();
                var Index=$('input[name="TaxShow[]"]').index(this);
                //alert(Index);
                //var taxs = $('input[name="Tax[]"]').index(this);
                $('#TaxID').val(Index);
                var url="VatSingleReset";
                $.get('SalesRole/'+url,function(data)
                {
                    if(data==0)
                        $('#TaxReset').hide();
                });



                var url="VatSingle"; 
                $.get('SalesRole/'+url,function(data)
                {
                    //alert("Fahad is a bad man");
                    if(data==1)
                    {

                        CookieCheck=$('#TaxCookieCheck').val();
                        if(CookieCheck==1)
                        {
                            //alert("Rezwan is a good man");
                            $('#TaxModal').modal("show");  
                        }
                                                }
                });                    
            });

            // Reset Tax
            $('#TaxReset').click(function()
            {
                var index = $('#TaxID').val();
                $('input[name="Tax[]"]').eq(index).val(0);
                $('input[name="tax[]"]').eq(index).val(0);
                $('input[name="tax1[]"]').eq(index).val(0);
                $('input[name="TaxShow[]"]').eq(index).val('Tax');

                $('#TaxModal').modal("hide");
                SingleProductPriceCalculation(index);
                $('#TotalDiscountforInvoice').val(0);
                TotalPriceCalculation();
            });

            // Overall Tax Select
            $('.TaxSelect').unbind('click').click(function() {

                var taxindex = $('input[name="TaxSelect[]"]').index(this);
                var taxvalue = parseInt($('input[name="TaxValue[]"]').eq(taxindex).val(), 10);
                //alert(taxvalue);
                var taxing = $('#TaxID').val();
                var Price=parseFloat($('[name="Price[]"]').eq(taxing).val(), 2);
                var TaxTotalforSingle=Price*taxvalue/100;

                //var VatMoney = $('[name="Price[]"]').eq(taxing).val() * taxvalue / 100;
                //var taxvalue1 = $('[name="Price[]"]').eq(taxing).val() * taxvalue / 100;
                $('input[name="Tax[]"]').eq(taxing).val(TaxTotalforSingle);
                $('input[name="tax[]"]').eq(taxing).val(TaxTotalforSingle);
                $('input[name="tax1[]"]').eq(taxing).val(TaxTotalforSingle);
                $('input[name="TaxShow[]"]').eq(taxing).val(TaxTotalforSingle);
                //$('input[name="taxvalue1[]"]').eq(taxing).val(VatMoney);
                SingleProductPriceCalculation(taxing);
                $('#TotalDiscountforInvoice').val(0);
                TotalPriceCalculation();
                $('#TaxModal').modal("hide");
            });


            $('.dismod').unbind('click').click(function() 
            {
                var dis = $('[name="dismod[]"]').index(this);
                $('#idid').val(dis);
                $('#cash_discount').val(0);
                $('#percent').val(0);
                $('#percent').val(0);
                $('#dismodal').modal('show'); 
                /*var url="DiscountSingle";
                $.get('SalesRole/'+url,function(data)                    
                {
                    if(data==1)
                    {
                        CookieCheck=$('#DiscountCookieCheck').val();
                        if(CookieCheck==1)
                        {
                            
                        }
                                            }
                });*/                    
            });


             // Single discount 
            $('#DiscountForm').on('submit',function(e) 
            {

                $('#allpercent').val(0);
                e.preventDefault();
                $('#percent').attr('disabled', false);
                $('#cash_discount').attr('disabled', false);
                var dis = $('#idid').val();
                var DiscountCash = $('#cash_discount').val();
                var SinglePercent = ($('#percent').val()) / 100 * $('input[name="Price[]"]').eq(dis).val()*$('[name="total[]"]').eq(dis).val();
                SinglePercent = SinglePercent.toFixed(2);
                var DiscountCashValue = $('#cash_discount').val();
                var DiscountParcentValue = $('#percent').val();
                if (DiscountCashValue >= 0 && DiscountParcentValue == 0) {
                    $('#SingleDiscountforCash').val(DiscountCashValue);
                    $('input[name="discount[]"]').eq(dis).val(DiscountCash);
                    $('input[name="discount1[]"]').eq(dis).val(DiscountCash);
                    $('input[name="discount2[]"]').eq(dis).val(DiscountCash);
                    $('input[name="dismod[]"]').eq(dis).val(DiscountCash);
                }
                if (DiscountParcentValue >= 0 && DiscountCashValue == 0) {
                    $('#DicountPercent').val(1);
                    $('#SingleDiscountforCash').val(0);
                    $('input[name="discount[]"]').eq(dis).val(SinglePercent);
                    $('input[name="discount1[]"]').eq(dis).val(SinglePercent);
                    $('input[name="discount2[]"]').eq(dis).val(SinglePercent);

                    $('input[name="dismod[]"]').eq(dis).val(SinglePercent);
                }
                SingleProductPriceCalculation(dis);
                $('#AllDiscountforCash').val(0);
                $('#TotalDiscountforInvoice').val(0);

                TotalPriceCalculation();
                $('#dismodal').modal('hide');
            });

            $('#dismodal').keyup(function() {
                var DiscountCashValue = $('#cash_discount').val();
                var DiscountParcentValue = $('#percent').val();
                if (DiscountCashValue > 0) {
                    $('#percent').attr('disabled', true);
                } else {
                    $('#percent').attr('disabled', false);
                }
                if (DiscountParcentValue > 0) {
                    $('#cash_discount').attr('disabled', true);
                } else {
                    $('#cash_discount').attr('disabled', false);
                }
            });

            // Overall discount 
            $('#discount').click(function() {
                $('#disca').val(0);
                $('#allpercent').val(0);
            });

            $('#taukir').keyup(function() {
                var zz;
                var bip = parseInt($('#Payable').val(), 10);
                var aa = parseInt($('#taukir').val(), 10);
                zz = bip - aa;
                $('#zia').val(zz);
            });

            $('#DiscountModal').keyup(function() 
            {
                var DiscountCashValue = $('#disca').val();
                var DiscountParcentValue = $('#allpercent').val();
                if (DiscountCashValue > 0) {
                    $('#allpercent').attr('disabled', true);
                } else {
                    $('#allpercent').attr('disabled', false);
                }
                if (DiscountParcentValue > 0) {
                    $('#disca').attr('disabled', true);
                } else {
                    $('#disca').attr('disabled', false);
                }
            });

            $('.total').click(function()
            {
                var quindex = $('[name="total[]"]').index(this);
                var shopquan=$('input[name="quan[]"]').eq(quindex).val();
                $('#ShopQuantity').val(shopquan);
                $('#quanindex').val(quindex);
                var url="CartQuantityChange"; 
                $.get('SalesRole/'+url,function(data)
                {
                    if(data==1)
                    {
                        $('#modalquanchange').val(1);
                        $('#quantityselect').modal("show");

                        $('#QuantityForm').on('submit',function(e)
                        {
                            e.preventDefault();                            
                            var xc = $('#quanindex').val();
                            var val = $('#modalquanchange').val();
                            if(val=="" || val==null)
                            {
                                return false;
                            }

                            $('[name="total[]"]').eq(xc).val(val);
                            //$('[name="total1[]"]').eq(xc).val(val);
                            //$('[name="total2[]"]').eq(xc).val(val);

                            var Check=$('#DicountPercent').val();

                            if(Check==1)
                            {
                                var alldiscountpercentage = parseInt($('#allpercent').val(), 10);
                                var quanval = $('[name="total[]"]').eq(xc).val();
                                if(alldiscountpercentage>0)
                                {
                                    var vv = alldiscountpercentage * $('input[name="Price[]"]').eq(xc).val() / 100*quanval;
                                    vv = vv.toFixed(2);
                                    $('input[name="discount[]"]').eq(xc).val(vv);
                                    //$('input[name="discount1[]"]').eq(xc).val(vv);
                                    //$('input[name="discount2[]"]').eq(xc).val(vv);
                                    $('input[name="dismod[]"]').eq(xc).val(vv);
                                }

                                var ppval=$('#percent').val();
                                if(ppval>0)
                                {
                                    var vv = ($('#percent').val()) / 100 * $('input[name="Price[]"]').eq(xc).val()*$('[name="total[]"]').eq(xc).val();
                                    vv = vv.toFixed(2);
                                    $('input[name="discount[]"]').eq(xc).val(vv);
                                    //$('input[name="discount1[]"]').eq(xc).val(vv);
                                    //$('input[name="discount2[]"]').eq(xc).val(vv);
                                    $('input[name="dismod[]"]').eq(xc).val(vv);
                                } 
                            }
                            SingleProductPriceCalculation(xc);
                            $('#TotalDiscountforInvoice').val(0);
                            TotalPriceCalculation();
                            var tot = $('[name="total[]"]').index(this);
                            var taq = $('input[name="minlevel[]"]').eq(xc).closest('tr');
                            var minlevel = $('input[name="minlevel[]"]').eq(xc).val();
                            var prevquan = $('input[name="quan[]"]').eq(xc).val();
                            var sellquan = $('input[name="total[]"]').eq(xc).val();
                            var remnquan = prevquan - sellquan;
                            var shq = parseInt($('input[name="quan[]"]').eq(xc).val(), 10);
                            var usq = parseInt($('input[name="total[]"]').eq(xc).val(), 10);
                            var stq = shq - usq;
                            ColorChecking(xc,stq,minlevel);

                            
                            if (sellquan < 1) {
                                taq.removeClass('bg-red');
                                taq.removeClass('bg-yellow');                                
                            }
                            $('#quantityselect').modal("hide");
                        });
                    }
                });
            });

            $('.PriceButton').click(function(e)
            {

                e.preventDefault();
                var index=$('input[name="PriceButton[]"]').index(this);
                $('#priceindex').val(index);
                var url="CartPriceChange";

                var Index=$('#priceindex').val();
                        var PriceVal=$('input[name="PriceButton[]"]').eq(Index).val();
                        $('#modalpricechange').val(PriceVal);
                        //alert(PriceVal);
                        $('#PriceSelect').modal("show");
                        $('#pricesel').on('click',function(e)
                        {

                            e.preventDefault();
                            var value=$('#modalpricechange').val();
                            var index=$('#priceindex').val();
                            $('input[name="PriceButton[]"]').eq(index).val(value);
                            $('input[name="Price[]"]').eq(index).val(value);
                            //$('input[name="Price1[]"]').eq(index).val(value);
                            //$('input[name="Price2[]"]').eq(index).val(value);

                            SingleProductPriceCalculation(index);
                            $('#TotalDiscountforInvoice').val(0);
                            TotalPriceCalculation();
                            $('#PriceSelect').modal("hide");
                        
                        });
                                        
            });







    }

    

});

