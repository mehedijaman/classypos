// On change events
$(document).ready(function()
{
	$('#ShopID').on('change',function()
	{
		ListProduct();
	});

	$('#CategoryID').on('change',function()
	{
		ListProduct();
	});


	$('#VendorID').on('change',function()
	{
		ListProduct();
	});
});

// list products by filtering
function ListProduct()
{

	$('.ProductOption').hide();



	var ShopID = $('#ShopID').val();
	if (ShopID == null) {
		ShopID = 0;
	}

	var CategoryID = $('#CategoryID').val();	
	if (CategoryID == null) {
		CategoryID = 0;
	}

	var VendorID = $('#VendorID').val();
	if(VendorID == null){
		VendorID = 0;
	}

	var DateFrom = 0;
	var DateTo	 = 0;

	$.get('/Product/List/' + ShopID + '/' + CategoryID + '/' + VendorID + '/' + DateFrom + '/' + DateTo,function(data)

	{
	  var Product=JSON.parse(data);

	  for(i=0;i<Product.length;i++)
	  {	  	
	  	$('#ProductID').append('<option class="ProductOption" value="'+Product[i].ProductID+'">'+Product[i].ProductID+'-'+Product[i].ProductName+'</option>');
	  }	  
	});
}




$('#ProductID').on('change',function()
{
	var ProductID=$('#ProductID').val();
	$.get('/Product/Details/JSON/' + ProductID ,function(data)
	{
		var Details = JSON.parse(data);
		var CostPrice = Details[0].CostPrice;

		$('#UnitCost').val(CostPrice);
		$('#Qty').val(1);
		$('#TotalCost').val(CostPrice);
	});
});


$('#Qty').on('click keyup',function()
{
	var Qty=$('#Qty').val();
	var UnitCost=$('#UnitCost').val();
    var TotalCost=Qty*UnitCost;
    $('#TotalCost').val(TotalCost);
});


$('#WasteSubmit').on('click',function()
{
   var ShopID=$('#ShopID').val();
   if (ShopID == null) {
		ShopID = 0;
	}

	var ProductID=$('#ProductID').val();
	var TotalCost=$('#TotalCost').val();
	var UnitCost=$('#UnitCost').val();
	var Qty     =$('#Qty').val();
	var WastedBy=$('#WastedBy').val();
	var Note=$('#Note').val();

    $.get('/Waste/New/'+ShopID+'/'+ProductID+'/'+Qty+'/'+UnitCost+'/'+TotalCost+'/'+WastedBy+'/'+Note,function(data)
	{
	 	alertify.success("Successfully Added to the Wasted List");
	});

});