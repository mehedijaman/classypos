$(document).ready(function(){


  $('#StockQuantity').empty();
  $('#StockQuantity').append('Stock');


  $('#SupplierID').on('change',function(){

    var bankid=-10;

    var p=$('#PaymentMethod').val();

    if(p=="Bank"){

      bankid=$('#BankAdd').val();
    }

    var vid=$('#SupplierID').val();

    if(vid==null){

      $('#PurchaseButton').attr('disabled',true);
    }

    else{
      if(bankid!=null)
        $('#PurchaseButton').attr('disabled',false);
    }
  });

  var TotalAddedProducts = 0;

  var vid=$('#SupplierID').val();

  if(vid==null){

    $('#PurchaseButton').attr('disabled',true);
  } 

  var due=$('#TotalPrice').val()-$('#Paid').val();     

  $('#Withdraw').keyup(function() {

    var due=$('#TotalPrice').val()-$('#Paid').val()-$('#Withdraw').val();
    $('#Due').val(due);
  });

  $('#Withdraw').click(function() {

    var due=$('#TotalPrice').val()-$('#Paid').val()-$('#Withdraw').val();

    $('#Due').val(due);
  });

  $('#Paid').on('keyup click',function()
  {
    var due=$('#TotalPrice').val()-$('#Paid').val()-$('#Withdraw').val();

    $('#Due').val(due);
  });

  $('#PurchaseButton').click(function() {


    var pid=[];
    var qty=[];
    var unitPrice=[];
    var subTotal=[];
    var reason=[];
    var shopID=[];


    var vid=$('#SupplierID').val();
    //var ShopID=$('#ShopID').val();
    var InvoiceID=$('#InvoiceID').val();       

    var totalprice=$('#TotalPrice').val();

    var paid=$('#Paid').val();

    var due=$('#Due').val();        


    for(i=0;i<=TotalAddedProducts;i++){

      var zz=$('[name="ProductID[]"]').eq(i).val();

      if(zz==null) {

        pid[i]=0;

        qty[i]=0;
        unitPrice[i]=0;
        subTotal[i]=0;

        reason[i]="0";
        shopID[i]=0;

      }
      else {

        pid[i]=$('[name="ProductID[]"]').eq(i).val();
        qty[i]=$('[name="Qty[]"]').eq(i).val();
        unitPrice[i]=$('[name="UnitPrice[]"]').eq(i).val();
        subTotal[i]=$('[name="SubTotal[]"]').eq(i).val();
        if($('[name="Reason[]"]').eq(i).val()=="")
        {
          $('[name="Reason[]"]').eq(i).val("No Reason");
        }
        reason[i]=$('[name="Reason[]"]').eq(i).val();
        shopID[i]=$('[name="ShopID[]"]').eq(i).val();

      } 
    }

    var myWindow = window.open("/ReturnPurchaseInvoice/"+InvoiceID+"/"+shopID+"/"+pid+"/"+qty+"/"+unitPrice+"/"+subTotal+"/"+reason+"/"+vid+"/"+totalprice+"/"+paid+"/"+due, "", "width=297,height=700,left=500");
    location.reload();
  });

  $('#BankAdd').empty();

  $('#Banking').hide();

  $('#PaymentMethod').on('change',function() {

    $('#PurchaseButton').attr('disabled',true);

    $('#BankAdd').empty();

    var p=$('#PaymentMethod').val();

    if(p=="Cash") {

      var vid=$('#SupplierID').val();

      $('#Banking').hide();

      if(vid!=null){

        $('#PurchaseButton').attr('disabled',false);
      }
    }   
  });

  $('#TotalPrice').val(0);

  $('.Qty').on('keyup click',function() { 

    var qq=$('[name="Qty[]"]').index(this);

    var quantity=$('[name="Qty[]"]').eq(qq).val();

    var price=$('[name="UnitPrice[]"]').eq(qq).val();

    var total=quantity*price;

    $('[name="SubTotal[]"]').eq(qq).val(total);

    var alltotal_quantity=0;
    var current_due;

    for(i=0;i<=TotalAddedProducts;i++) {

      alltotal_quantity=alltotal_quantity+ parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
    }

    $('#TotalPrice').val(alltotal_quantity);

    current_due=alltotal_quantity-$('#Paid').val();

    $('#Due').val(current_due);             
  });


  $('.UnitPrice').on('keyup click',function() { 

    var qq=$('[name="UnitPrice[]"]').index(this);

    var quantity=$('[name="Qty[]"]').eq(qq).val();

    var price=$('[name="UnitPrice[]"]').eq(qq).val();

    var total=quantity*price;

    $('[name="SubTotal[]"]').eq(qq).val(total);

    var alltotal_unit=0;

    for(i=0;i<=TotalAddedProducts;i++) {

      alltotal_unit=alltotal_unit+ parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
    }

    var current_due;

    $('#TotalPrice').val(alltotal_unit);

    current_due=alltotal_unit-$('#Paid').val();

    $('#Due').val(current_due); 
  });




  // filter product list on category change
  $('.ProductCategory').on('change',function() {
    ListProduct();
  });

  // Filter product list on shop change
  $('.ShopID').on('change',function() {

    

    //alert("I am a sad man");
    ListProduct();
  }); 


  // Calculate product price on product change
  $('.ProductID').on('change',function() {
    detailsProduct();
  });  
    

  $('#increase').click(function() {

    //alert("Fahad");

    TotalAddedProducts ++;
        
    $('#NewProductRow').append($('#FirstProductRow').html());

    $('[name="minus[]"]').eq(TotalAddedProducts).removeClass().addClass('fa fa-minus ');

    $('[name="addbutton[]"]').eq(TotalAddedProducts).removeClass().addClass('btn bg-maroon btn-flat addbutton');
    
    $('.Qty').on('keyup click',function(){ 

      var qq=$('[name="Qty[]"]').index(this);

      var quantity=$('[name="Qty[]"]').eq(qq).val();

      var price=$('[name="UnitPrice[]"]').eq(qq).val();

      var total=quantity*price;

      $('[name="SubTotal[]"]').eq(qq).val(total);
      var alltotald=0;

      for(i=0;i<=TotalAddedProducts;i++) {
        alltotald=alltotald+ parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
      }



      $('#TotalPrice').val(alltotald);

      current_due=alltotald-$('#Paid').val();

    $('#Due').val(current_due);  
    });

    $('.UnitPrice').on('keyup',function() {

      var qq=$('[name="UnitPrice[]"]').index(this);
      var quantity=$('[name="Qty[]"]').eq(qq).val();
      var price=$('[name="UnitPrice[]"]').eq(qq).val();
      var total=quantity*price;

      $('[name="SubTotal[]"]').eq(qq).val(total);

      var alltotalc=0;

      for(i=0;i<=TotalAddedProducts;i++) {
        alltotalc=alltotalc+ parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
      }

      $('#TotalPrice').val(alltotalc);
      $('#Due').val(4563);          
    });  

    // filter product list on category change
    $('.ProductCategory').on('change',function() {

      
      ListProduct();
    });

    // Filter product list on shop change
    $('.ShopID').on('change',function() {

      
      ListProduct();
    });

    // When product is changed
      $('.ProductID').on('change',function() {
        detailsProduct();
      });




    $('.addbutton').click(function() {
      var qq=$('[name="addbutton[]"]').index(this);
      if(qq>0) {
        $('[name="Qty[]"]').eq(qq).val(0);
        $('[name="ProductID[]"]').eq(qq).val(0);
        $('[name="ProductCategory[]"]').eq(qq).val(0);
        $('[name="UnitPrice[]"]').eq(qq).val(0);
        $('[name="SubTotal[]"]').eq(qq).val(0);

        var alltotala=0;
        for(i=0;i<=TotalAddedProducts;i++) {

          alltotala=alltotala+parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
        }
        $('#TotalPrice').val(alltotala);

        var good=$(this).closest('tr');

        good.hide();

        $('[name="Qty[]"]').eq(qq).val(0);
        $('[name="ProductID[]"]').eq(qq).val(0);
        $('[name="ProductCategory[]"]').eq(qq).val(0);
        $('[name="UnitPrice[]"]').eq(qq).val(0);
        $('[name="SubTotal[]"]').eq(qq).val(0);
      }
    });
    

    // Retrieve product details and calculate price 
    $('.ProductID').on('change',function() {
      detailsProduct();      
    });    
  });

  // Filter product list based on parameter
  function ListProduct(){


    $('#StockQuantity').empty();
    $('#StockQuantity').append('Stock fahad');


    var p = $('[name="ProductCategory[]"]').index(this);

    $('[name="ProductID[]"]').eq(p).empty();

    var CategoryID  = $('[name="ProductCategory[]"]').eq(p).val();  
    var ShopID      = $('[name="ShopID[]"]').eq(p).val();
    var VendorID    = 0;
    var DateFrom    = 0;
    var DateTo      = 0;

    $.get('/Product/List/' + ShopID + '/' + CategoryID + '/' + VendorID + '/' + DateFrom + '/' + DateTo, function(data) 
    {


      var kaka=JSON.parse(data);

      $('#StockQuantity').empty();
      $('#StockQuantity').append(kaka[0].Qty);


      //alert(kaka[0].Qty);

      $('[name="ProductID[]"]').eq(p).empty(); 

      $('[name="ProductID[]"]').eq(p).append('<option disabled selected>Choose a Product </option>');

      var total=kaka.length;

      for(i=0;i<=total;i++) {

        $('[name="ProductID[]"]').eq(p).append('<option value="'+kaka[i].ProductID+'">'+kaka[i].ProductName+'</option>');
      } 
    });
  }
  
  // Retreive product details and calculate price
  function detailsProduct(){
    var tot=$('#TotalPrice').val();            
    var due=$('#TotalPrice').val()-$('#Paid').val();
    var qq=$('[name="ProductID[]"]').index(this);
    var ProductID =$('[name="ProductID[]"]').eq(qq).val();                 

    $('[name="Qty[]"]').eq(qq).val(1);

    // getting product details via JSON
    $.get('/Product/Details/JSON/' + ProductID,function(data) {

      var price=JSON.parse(data);
      var costprice=price[0].CostPrice;

      $('[name="UnitPrice[]"]').eq(qq).val(costprice);

      var quantity=$('[name="Qty[]"]').eq(qq).val();
      var total=quantity*costprice;

      $('[name="SubTotal[]"]').eq(qq).val(total);

      var alltotal=0;

      for(i=0;i<=TotalAddedProducts;i++) {
        alltotal=alltotal+ parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
      }

      $('#TotalPrice').val(alltotal);

      var tot=$('#TotalPrice').val();
      var due=$('#TotalPrice').val()-$('#Paid').val();
      
      $('#Due').val(due);
    });
  }
});  