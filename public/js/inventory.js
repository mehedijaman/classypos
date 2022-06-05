// Disable Shop List on Change
$('#ShopID').change(function(){
  $('#ShopID').attr('disabled', 'disabled');
  var ShopID = $('#ShopID').val();
});


// Reset inventory
$('#ResetInventory').click(function(){
  alertify.confirm('Reset Inventory', 'Do you really want to reset ?', 
    function(){ 
      var ShopID = $('#ShopID').val();

      if (ShopID == null) {
        alertify.error('Please Select a Shop From the list');
      }
      else{
        $.get('/Product/Inventory/Reset/' + ShopID, function(Data){
          if (Data == 'true') {
            alertify.success('Reset Success !');
          }
          else
            alertify.error('Reset Error !');
        });            
      } 
    },
    function(){ alertify.warning('Reset Canceled !')
  });      
});


// print inventory
$('#PrintInventory').click(function(){
  alertify.confirm('Print Inventory', 'Do you really want to Print ?', 
    function(){ 
      var ShopID = $('#ShopID').val();

      if (ShopID == null){
        alertify.error('Please Select a Shop From the list');          
      }
      else{
        $.get('/Product/Inventory/Report/' + ShopID, function(Data){
          if (Data == false) {
            alertify.error('Sorry , Something wrong !')
          }
          else{
            var Report = JSON.parse(Data);

            if(Report.length == 0){
              alertify.warning('Sorry ! No record found !');
            }
            else{
              
              var URL = "/Product/Inventory/Report/Print/" + ShopID;
              WindowOpen(URL);
            }
          }
        });
      }         
    },
    function(){ alertify.warning('Print Canceled !')
  }); 
});


// Scan barcode and submit form
$('#InventoryCheckForm').on('submit', function(event) {
  event.preventDefault();

  var ProductID = $('#ProductID').val();
  var ShopID    = $('#ShopID').val();

  if (ShopID == null || ProductID == '') {
    alertify.set('notifier','position', 'bottom-right');
    alertify.error('Please Select a Shop and Scan Barcode to Start Checking');
  }
  else
  {
    $.get('/Product/Inventory/Check/' + ShopID + '/' + ProductID, function(Data){
      
      if(Data == 'false'){
        alertify.error('This Product is not Found in this Shop!');
      }
      else{             
        $.get('/Product/Inventory/Store/' + ShopID + '/' + ProductID, function(Data){

          if(Data == 'false'){
            alertify.error('Sorry, Something went wrong !');
          }
          else
            alertify.success('Product Check Success !');
        });        
      }
    });
  }

  $(function(){
   $("#InventoryCheckForm").find("input").val('');
  });
});