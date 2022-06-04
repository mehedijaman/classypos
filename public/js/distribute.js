$(document).ready(function()
{

  var t = $('#Example').DataTable({
    "iDisplayLength": 300,
    "aLengthMenu": [[10, 15, 25, 35, 50, 100,200,300, -1], [10, 15, 25, 35, 50, 100,200,300, "All"]]
});
  

  $('#Example').on('click','tr',function(event) {
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
  $(".select2").select2({
    theme: "bootstrap"
  });

 // $('#From').datepicker();
  //$('#To').datepicker();
  
  $('#HideTheCheckbox').hide();
  $('#SelectAllArea').hide();
  $('#ShopID').val(0);
  $("#Shop").prop('value', 'Shop');
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

$('#From').on('input',function(e)
{
  ListProduct();
});

$('#To').on('input',function(e)
{
  ListProduct();  
});

$('#ShowAllBtn').click(function(){
  ListProduct();
});

//Choose A Shop
$('#Shop').on('click',function()
{
  $('#shopselect').modal('show');
   // *****Select a Shop For Admin*****
    $('.shopselect').click(function()

     {
        var p = $('[name="shopselect[]"]').index(this);
        var qq = $('input[name="shopnam[]"]').eq(p).val();
        $('#ShopID').val(qq);
                $('#ShopEdit').empty();

        $.get('/Sales/Shop/Select/' + qq, function(data) {

            $('.box-title').empty();
            $('.box-header').append('<h3 class="box-title">'+data+'</h3>');
            $("#Shop").prop('value',data);
            $('#ShopName').val(data);
            //$('#fad').append('<input type="submit" name="submit" value="Send to Shop" class="btn btn-flat btn-danger btn-lg col-md-offset-4 col-md-2" id="ShopEditDistribution">').hide().delay(500).fadeIn(200);

        });
        $('#ShopEdit').append('<input type="button" class="btn btn-info btn-flat EditDistribution" id="EditDistribution" value="Edit Distribution">');
        $('#shopselect').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        $('#ShopEditDistribution').prop('disabled',false);
    });

});

$('#ShopEdit').click(function()
{
  ListProduct();
  $('#Change').val("Edit");
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
        //alert(data);
        $('#ProductList').empty();
        $('#fad').empty();
        var k=JSON.parse(data);
        $('#check').show();
        $('#SelectAllArea').show();
        var t = $('#Example').DataTable();
        t.clear().draw();
        for(i=0;i<k.length;i++)
        {


          t.row.add( [
        '<input type="checkbox" name="checkbox[]" class="checkbox" value="0">'+
        '<input type="hidden" name="ProductID[]" class="ProductID" value="'+k[i].ProductID+'">'+
        '<input type="hidden" name="SalePrice[]" class="SalePrice" value="'+k[i].SalePrice+'">'+
        '<input type="hidden" id="text" name="checking[]" class="checking" value="'+0 +'">'+
        '<input type="hidden" name="ProductName[]" class="ProductName"value="'+k[i].ProductName+'">',
        '<td>'+k[i].ProductID+'</td>',
        '<td>'+k[i].ProductName+'</td>',
        '<td>'+new Date(k[i].created_at).toDateString()+'</td',
        '<td class="text-center">'+
          '<input type="number" min="0" step=".0001" name="Quantity[]" class="Quantity form-control" value="'+k[i].Qty+'">'+
          '</td>'
        ] ).draw();


          $('#FormforDistributeController').append('<input type="hidden" name="ProductID1[]" class="ProductID1" value="'+k[i].ProductID+'"> <input type="hidden" id="text" name="checking1[]" class="checking1" value="'+0 +'"><input type="number" step=".0001" min="0" name="Quantity1[]" class="Quantity1" value="'+k[i].Qty+'">');

         /* t.row.add(['<tr><td ><input type="checkbox" name="checkbox[]" class="checkbox" value="0">'+
            '<input type="hidden" name="ProductID[]" class="ProductID" value="'+k[i].ProductID+'">'+
            '<input type="hidden" name="SalePrice[]" class="SalePrice" value="'+k[i].SalePrice+'">'+
            '<input type="hidden" id="text" name="checking[]" class="checking" value="'+0 +'">'+
            '<input type="hidden" name="ProductName[]" class="ProductName" value="'+k[i].ProductName+'"></td>'+
            '<td class="RealProductID" name="RealProductID[]">'+k[i].ProductID+'</td>'+
            '<td class="RealProductName" name="RealProductName[]">'+k[i].ProductName+'</td>'+
            '<td class="RealDate" name="RealDate[]">'+new Date(k[i].created_at).toDateString()+'</td>'+
            '<td><input type="number" name="Quantity[]" class="Quantity form-control" '+
            'value="'+k[i].Qty+'"></td></tr>']).draw();*/

          /*$('#ProductList').append('<tr><td ><input type="checkbox" name="checkbox[]" class="checkbox" value="0">'+
            '<input type="hidden" name="ProductID[]" class="ProductID" value="'+k[i].ProductID+'">'+
            '<input type="hidden" name="SalePrice[]" class="SalePrice" value="'+k[i].SalePrice+'">'+
            '<input type="hidden" id="text" name="checking[]" class="checking" value="'+0 +'">'+
            '<input type="hidden" name="ProductName[]" class="ProductName" value="'+k[i].ProductName+'"></td>'+
            '<td class="RealProductID" name="RealProductID[]">'+k[i].ProductID+'</td>'+
            '<td class="RealProductName" name="RealProductName[]">'+k[i].ProductName+'</td>'+
            '<td class="RealDate" name="RealDate[]">'+new Date(k[i].created_at).toDateString()+'</td>'+
            '<td><input type="number" name="Quantity[]" class="Quantity form-control" '+
            'value="'+k[i].Qty+'"></td></tr>').hide().fadeIn(10);*/       
        }


        $('.Quantity1').hide();

        $('input[name="checkbox1[]"]').hide();


        //$('#ProductList').append('<input type="hidden" name="shop" value="'+k[0].ShopID+'">');
        //$('#ProductList').append('</table>');

        $('#fad').append('<input type="button" name="submit"  value="Distribute" class="btn btn-flat bg-purple btn-lg col-md-offset-4 col-md-2" id="ShopEditDistribution">').hide().delay(500).fadeIn(200);
        
        $('#ShopEditDistribution').on('click',function()
        {

          var length=$('input[name="checkbox1[]"]').length;
          //$('#FormforDistributeController').append('<input type="checkbox" name="checkbox1[]" value="0">');

          for(i=0;i<length;i++)
          {
            var Val=$('input[name="Quantity[]"]').eq(i).val();
            
            $('input[name="Quantity1[]"]').eq(i).val(Val);
          }
          //alert(length);

          $('#FormforDistributeController').submit();

        });
        var Shop=$('#ShopID').val();
        if(Shop==0)
        {
          $('#ShopEditDistribution').prop('disabled',true);
        }

        if(Shop>0)
        {
          var ShopName=$('#ShopName').val();
          $("#ShopEditDistribution").prop('value',"Edit Distribution");
          $('#EditDistribution').prop('value','Product List of '+ShopName);
          $('#ShopEditDistribution').prop('disabled',false);

        }      


        var length=$('.checkbox').length;

        $('#Example').on('click','.checkbox',function()
        {
          Checking();
        });

        //$('.checkbox').click(Checking);

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

        $('.RealDate').click(function()
        {
            var p = $('[name="RealDate[]"]').index(this);
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
          //alert(length);      
          if(this.checked)
          {

            for(i=0;i<length;i++)
            {
              $('input[name="checking[]"]').eq(i).val(1);
              $('input[name="checking1[]"]').eq(i).val(1);
            }            
            $('.checkbox').prop('checked',true);          
          }

          else
          {
            $('.checkbox').prop('checked',false);
            for(i=0;i<length;i++)
            {
              $('input[name="checking[]"]').eq(i).val(0);
              $('input[name="checking1[]"]').eq(i).val(0);
            }

          }        
          
        });

}

function Checking()
{

  

  $(".checkbox").each(function(i)            
    {
      if(this.checked)
      {
              $('input[name="checking[]"]').eq(i).val(1);         
              $('input[name="checking1[]"]').eq(i).val(1);         
      }

      else
      {
              $('input[name="checking[]"]').eq(i).val(0);
              $('input[name="checking1[]"]').eq(i).val(0);
      }
    });

}