$(document).ready(function()
{
  $('#HideTheCheckbox').hide();
  $('#SelectAllArea').hide();

  $('#example').on('click','tr',function(event) {

    if(event.target.type=='checkbox')
    {

    }
    else
    {
      if (event.target.type!='number') {
            $(':checkbox', this).trigger('click');
        }

    }
        
  });

  
  //$("#paginatedTable").on("click", ".test .toggleTest", function ...);

   


  var t = $('#example').DataTable({
    "iDisplayLength": 15,
    "aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]]
});
  
  //var info = t.page.info();
  //alert(info.page+1);

 // $('#example tbody').on("click",".checkbox",function()
   //{
    //var index=$('input[name="checkbox[]"]').index(this);
    //alert(index);
    //var sas  =$('input[name="checking[]"]').eq(index).val();

    //var t = $('#example').DataTable();
    //var sad=t.row( this ).index();
    //alert(sad);
    //var info = t.page.info();
    //alert(info.page+1);
     //alert(index);
   //});


    //var counter = 1;
     
     
      


        

    
 
    
        
    
 
    // Automatically add a first row of data
    //$('#addRow').click();


});

$('#check').hide();

$('#VendorID').on('change',function(e)
{
  ListProduct();
});

$('#CategoryID').on('change',function(e)
{
  ListProduct();
});

$('#ShopID').on('change',function(e)
{    
  ShopNameCheck();
  //ListProduct();
});

$('#From').on('input',function()
{
  ListProduct();
});

$('#To').on('input',function()
{
  ListProduct();
});

$('#ShowAllBtn').click(function(){
  ListProduct();
});

function ListProduct()
{

    var ShopID = $('#ShopID').val();
    var VendorID = $('#VendorID').val();    
    var CategoryID = $('#CategoryID').val();
    
    var DateFrom = $('#From').val();
    if(DateFrom == "")
    {
      DateFrom = 0;
    }

    var DateTo = $('#To').val();
    if(DateTo == "")
    {
      DateTo = 0;
    } 

    $.get('/Product/List/'+ ShopID +'/'+ CategoryID +'/'+ VendorID +'/'+ DateFrom +'/'+ DateTo, function(data)
    {
      //document.write(data);
      $('#ProductList').empty();
      $('#fad').empty();
      var k=JSON.parse(data);
      $('#check').show();
      $('#SelectAllArea').show();
      var t = $('#example').DataTable();
      t.clear().draw();
      var counter = 1;

      for(i=0;i<k.length;i++)
      {
        t.row.add( [
        '<input type="checkbox" name="checkbox[]" class="checkbox">'+
        '<input type="hidden" name="ProductID[]" class="ProductID" value="'+k[i].ProductID+'">'+
        '<input type="hidden" name="SalePrice[]" class="SalePrice" value="'+k[i].SalePrice+'">'+
        '<input type="hidden" id="text" name="checking[]" class="checking" value="'+0 +'">'+
        '<input type="hidden" name="ProductName[]" class="ProductName"value="'+k[i].ProductName+'">',
        '<td class="RealProductID" name="RealProductID[]">'+k[i].ProductID+'</td>',
        '<td class="text-center RealProductName" name="RealProductName[]">'+k[i].ProductName+'</td>',
        '<td class="text-center Time" name="Time[]">'+k[i].created_at+'</td',
        '<td class="text-center">'+
          '<input type="number" min="0" name="Quantity[]" class="Quantity form-control" value="'+k[i].Qty+'">'+
          '</td>'
        ] ).draw();

      }
     /* for(i=0;i<k.length;i++)
      {
        $('#ProductList').append('<tr><td ><input type="checkbox" name="checkbox[]" class="checkbox">'+
          '<input type="hidden" name="ProductID[]" class="ProductID" value="'+k[i].ProductID+'">'+
          '<input type="hidden" name="SalePrice[]" class="SalePrice" value="'+k[i].SalePrice+'">'+
          '<input type="hidden" id="text" name="checking[]" class="checking" value="'+0 +'">'+
          '<input type="hidden" name="ProductName[]" class="ProductName"value="'+k[i].ProductName+'"></td>'+
          '<td class="RealProductID" name="RealProductID[]">'+k[i].ProductID+'</td>'+
          '<td class="text-center RealProductName" name="RealProductName[]">'+k[i].ProductName+'</td>'+
          '<td class="text-center Time" name="Time[]">'+k[i].created_at+'</td><td class="text-center">'+
          '<input type="number" min="0" name="Quantity[]" class="Quantity form-control" value="'+k[i].Qty+'">'+
          '</td></tr>').hide().fadeIn(10);       
      }*/



      $('#ProductList').append('<input type="hidden" name="shop" value="'+k[0].ShopID+'">');
      $('#ProductList').append('</table>');
      var shop=$('#ShopID').val();
      if(shop>=0)
      {
        $('#fad').append('<input type="submit" name="submitBarCode" id="BarCodeButton" value="Generate Barcode"  class="btn btn-flat btn-lg btn-block bg-purple">').hide().delay(500).fadeIn(200);
        $('#BarCodeButton').attr('disabled',true);
        
      }  
      

      if(shop==null)
      {
        $('#BarCodeButton').hide();
      }

      var length=$('.checkbox').length;       

      $('#example').on('click','.checkbox',function()
      {
        Checking();

      });

      /*$('.RealProductID').click(function()
      {
          var p = $('[name="RealProductID[]"]').index(this);

          var test=$('.checkbox')[p].checked;
          if(test==false)
            $('.checkbox')[p].checked=true;
          if(test==true)
            $('.checkbox')[p].checked=false;
          Checking();          
      });

      $('.RealProductName').click(function()
      {
          var p = $('[name="RealProductName[]"]').index(this);
          var test=$('.checkbox')[p].checked;
          if(test==false)
            $('.checkbox')[p].checked=true;
          if(test==true)
            $('.checkbox')[p].checked=false;
          Checking();       
      });

      $('.Time').click(function()
      {
          var p = $('[name="Time[]"]').index(this);
          var test=$('.checkbox')[p].checked;
          if(test==false)
            $('.checkbox')[p].checked=true;
          if(test==true)
            $('.checkbox')[p].checked=false;
          Checking();       
      });*/                

      $('#common').on('change',function()
      {
        var x=this.value;

        $(".checkbox").each(function(i)
        {
          $('input[name="Quantity[]"]').eq(i).val(x);
        });                      
      });
    });



    $('#SelectAll').on('click',function()

        {
          var length=$('.checkbox').length;      
          if(this.checked)
          {

            $('#BarCodeButton').attr('disabled',false);

            for(i=0;i<length;i++)
            {
              $('input[name="checking[]"]').eq(i).val(1);
            }            
            $('.checkbox').prop('checked',true);          
          }

          else
          {
            $('#BarCodeButton').attr('disabled',true);
            $('.checkbox').prop('checked',false);
            for(i=0;i<length;i++)
            {
              $('input[name="checking[]"]').eq(i).val(0);
            } 
          }         
          
        });

}

function Checking()
{
   
  //var x=$('#RowNumber').val();
  //alert(x);
  $(".checkbox").each(function(i)            
    {
      if(this.checked)
      {
              $('input[name="checking[]"]').eq(i).val(1);
                       
      }

      else
      {
        $('input[name="checking[]"]').eq(i).val(0);
        //$('#BarCodeButton').attr('disabled',true);
      }
    });

    var length=$('.checkbox').length;
    //var ButtonCheck=0;
    var C=0;
    for(i=0;i<length;i++)
    {
      var ButtonCheck=$('input[name="checking[]"]').eq(i).val();
      if(ButtonCheck==1)
      {
        C=1;
        break;
      }

    }
    if(C==1)
      $('#BarCodeButton').attr('disabled',false);
    if(C==0)
      $('#BarCodeButton').attr('disabled',true);


}

function ShopNameCheck()
{

  var ShopIDValue=$('#ShopID').val();

  if(ShopIDValue>0)
  {
    $.get('/Product/Barcode/ShopIDtoName/'+ShopIDValue,function(data)
    {
      $('#modalshopname').val(data);
      $('#ShopNameselect').modal('show');
    });
  }

  else
  {
    $('#modalshopname').val('');
    $('#ShopNameselect').modal('show');
  }


   

}

$('#shopname').click(function()
{
  var value=$('#modalshopname').val();
  $('#UserDefinedShopName').val(value);
  //$('#ShopID').val(1000);
  $('#ShopNameselect').modal('hide');
  $('body').removeClass('modal-open');
  $('.modal-backdrop').remove();

});