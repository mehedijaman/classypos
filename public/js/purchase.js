$(document).ready(function(){
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

      var cc = 0;

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

      $('#Paid').on('keyup click',function(){
        var due=$('#TotalPrice').val()-$('#Paid').val()-$('#Withdraw').val();

        $('#Due').val(due);
      });

      $('#PurchaseButton').click(function() {


        var pid=[];

        var qty=[];

        var unitPrice=[];

        var subTotal=[];

        var vid=$('#SupplierID').val();

        

        var totalprice=$('#TotalPrice').val();

        var paid=$('#Paid').val();

        var due=$('#Due').val();

        var bank=$('#Withdraw').val();

        var bankid=$('#BankAdd').val();

        var memo=0;

        var memo=$('#InvoiceID').val();

        var cheque=$('#ChequeNumber').val();  


        for(i=0;i<=cc;i++){

          var zz=$('[name="ProductID[]"]').eq(i).val();

          if(zz==null) {

            pid[i]=0;

            qty[i]=0;
            unitPrice[i]=0;
            subTotal[i]=0;
          }
          else {

            pid[i]=$('[name="ProductID[]"]').eq(i).val();

            qty[i]=$('[name="Qty[]"]').eq(i).val();
            unitPrice[i]=$('[name="UnitPrice[]"]').eq(i).val();

            subTotal[i]=$('[name="SubTotal[]"]').eq(i).val();
          } 
        }

        var myWindow = window.open("/purchasevoice/"+pid+"/"+qty+"/"+unitPrice+"/"+subTotal+"/"+vid+"/"+totalprice+"/"+paid+"/"+due+"/"+bank+"/"+memo+"/"+bankid+"/"+cheque, "", "width=297,height=700,left=500");
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
            

        if(p=="Bank") {                  

          $('#Banking').show();

          $.get('/purchase-bank',function(data) { 

            var bank=JSON.parse(data);                    
              $('#BankAdd').append('<option value="0" selected disabled>Bank</option>');

            for(i=0;i<bank.length;i++) {

              $('#BankAdd').append('<option value="'+bank[i].BankID+'">'+bank[i].BankName+'</option>');
            }
          });

          var bid=$('#BankAdd').val();

          var vid=$('#SupplierID').val();
        }



        $('#BankAdd').on('change',function() {
          if(vid!=null)
              $('#PurchaseButton').attr('disabled',false);
        });
      });

       
      $('#newproaj').click(function() {

        $CategoryID=$('#PrCat').val();
        $VendorID=$('#VendorID').val();
        $ProductName=$('#ProductName').val();
        $ProductDescription=$('#ProductDescription').val();

        $Qty=$('#Qty').val();
        $CostPrice=$('#CostPrice').val();
        $SalePrice=$('#SalePrice').val();
        $PreferredPrice=$('#PreferredPrice').val();
        $Unit=$('#Unit').val();
        $TaxCode=$('#TaxCode').val();
        $MinQtyLevel=$('#MinQtyLevel').val();              

        $.ajax( { 

          type: "get",
          url:'{{URL::to('addproaj')}}',         

          data: {'CategoryID':$CategoryID,'VendorID':$VendorID,'ProductName':$ProductName,
          'ProductDescription':$ProductDescription, 'Qty':$Qty,  'CostPrice':$CostPrice,  'SalePrice':$SalePrice, 'PreferredPrice':$PreferredPrice,'Unit':$Unit,'TaxCode':$TaxCode,'MinQtyLevel':$MinQtyLevel},

          success:function(data) {

            //alert(data);
          }
        });

        $('#NewProductModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
      });  


      // Submit New Product Category
      $('#CategoryNewForm').submit(function(event) {

        event.preventDefault();

        var xy=$('#modcat').val();

        //$.get('/purchase-new-cat/{id}','ProductController@')

        $.get('/purchase-new-cat/'+xy,function(data) {

          $('#PrCat').append('<option value="'+data+'">'+xy+'</option>');

          $('#MaPrCat').append('<option value="'+data+'">'+xy+'</option>');
        });


        $('#NewCategoryModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
      });


      //Bank Modal processing
      $('#NewBankForm').submit(function(event) {

        event.preventDefault();

        var xy=$('#modbank').val();

        var bal=$('#modbankbalance').val();

        $.get('/purchase-new-bank/'+xy+'/'+bal,function(data) {

          $('#BankAdd').append('<option value="'+data+'">'+xy+'</option>');
        });


        $('#NewBankModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
      });

      $('#TotalPrice').val(0);

      // when Qty is changed
      $('.Qty').on('keyup click',function() { 

        var qq=$('[name="Qty[]"]').index(this);

        var quantity=$('[name="Qty[]"]').eq(qq).val();

        var price=$('[name="UnitPrice[]"]').eq(qq).val();

        var total=quantity*price;

        $('[name="SubTotal[]"]').eq(qq).val(total);

        var alltotal_quantity=0;
        var current_due;

        for(i=0;i<=cc;i++) {

          alltotal_quantity=alltotal_quantity+ parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
        }

        $('#TotalPrice').val(alltotal_quantity);

        current_due=alltotal_quantity-$('#Paid').val();

        $('#Due').val(current_due);             

      });

      // when unit price is changed
      $('.UnitPrice').on('keyup click',function() { 

        var qq=$('[name="UnitPrice[]"]').index(this);

        var quantity=$('[name="Qty[]"]').eq(qq).val();

        var price=$('[name="UnitPrice[]"]').eq(qq).val();

        var total=quantity*price;

        $('[name="SubTotal[]"]').eq(qq).val(total);

        var alltotal_unit=0;

        for(i=0;i<=cc;i++) {

          alltotal_unit=alltotal_unit+ parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
        }

        var current_due;

        $('#TotalPrice').val(alltotal_unit);

        current_due=alltotal_unit-$('#Paid').val();

        $('#Due').val(current_due); 
      });

      // When category is changed
      $('.ProductCategory').on('change',function() {
        ListProduct();
      });

      // When product is changed
      $('.ProductID').on('change',function() {
        detailsProduct();
      });            

      // Works when a new row is inserted via plus button
      $('#increase').click(function() {

        cc ++;
            
        $('#NewProductRow').append($('#FirstProductRow').html());

        $('[name="minus[]"]').eq(cc).removeClass().addClass('fa fa-minus ');

        $('[name="addbutton[]"]').eq(cc).removeClass().addClass('btn bg-maroon btn-flat addbutton');
        $('.Qty').on('keyup click',function(){ 

          var qq=$('[name="Qty[]"]').index(this);

          var quantity=$('[name="Qty[]"]').eq(qq).val();

          var price=$('[name="UnitPrice[]"]').eq(qq).val();

          var total=quantity*price;

          $('[name="SubTotal[]"]').eq(qq).val(total);
          var alltotald=0;

          for(i=0;i<=cc;i++) {
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

          for(i=0;i<=cc;i++) {
            alltotalc=alltotalc+ parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
          }

          $('#TotalPrice').val(alltotalc);
          $('#Due').val(4563);          
        });

        $('.ProductCategory').on('change',function() {
          ListProduct();
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
            for(i=0;i<=cc;i++) {

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

        // Retrive product list by filtering
        $('.ProductCategory').on('change',function() {
          ListProduct();
        });

        // Retrieve product details and calculate price
        $('.ProductID').on('change',function() {
          detailsProduct();
        });
      });

      // Retrieve product details and calculate price
      function detailsProduct(){
        var tot=$('#TotalPrice').val();            
        var due=$('#TotalPrice').val()-$('#Paid').val();
        var qq=$('[name="ProductID[]"]').index(this);
        var ProductID = $('[name="ProductID[]"]').eq(qq).val();                 

        $('[name="Qty[]"]').eq(qq).val(1);

        $.get('/Product/Details/JSON/' + ProductID,function(data) {

          var price=JSON.parse(data);
          var costprice=price[0].CostPrice;

          $('[name="UnitPrice[]"]').eq(qq).val(costprice);

          var quantity=$('[name="Qty[]"]').eq(qq).val();
          var total=quantity*costprice;

          $('[name="SubTotal[]"]').eq(qq).val(total);

          var alltotal=0;

          for(i=0;i<=cc;i++) {
            alltotal=alltotal+ parseInt($('[name="SubTotal[]"]').eq(i).val(),10);
          }

          $('#TotalPrice').val(alltotal);

          var tot=$('#TotalPrice').val();
          var due=$('#TotalPrice').val()-$('#Paid').val();
          
          $('#Due').val(due);
        });
      }

      // Retrive product list by filtering
      function ListProduct(){
        var p=$('[name="ProductCategory[]"]').index(this);
        
        $('[name="ProductID[]"]').eq(p).empty();

        var CategoryID  = $('[name="ProductCategory[]"]').eq(p).val();
        var ShopID      = 0;
        var VendorID    = 0;
        var DateFrom    = 0;
        var DateTo      = 0;

        $.get('/Product/List/' + ShopID + '/' + CategoryID + '/' + VendorID + '/' + DateFrom + '/' + DateTo, function(data) 
        {        

          var kaka=JSON.parse(data);

          $('[name="ProductID[]"]').eq(p).empty();

          $('[name="ProductID[]"]').eq(p).append('<option disabled selected>Choose a Product </option>');

          var total=kaka.length;

          for(i=0;i<total;i++) {

            $('[name="ProductID[]"]').eq(p).append('<option value="'+kaka[i].ProductID+'">'+kaka[i].ProductName+'</option>');
          }
        });
      }  
    }); 