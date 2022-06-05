$('#TotalNetProfit').click(function(){
	var ShopID = $('#TotalNetProfitShopID').val();
	var DateFrom = $('#TotalNetProfitDateFrom').val();
	var DateTo = $('#TotalNetProfitDateTo').val();

	if(DateFrom == ''){
		DateFrom = 0;
	}

	if (DateTo == '') {
		DateTo = 0;
	}	

	var URL = '/Report/Sales/NetProfit/' + ShopID + '/' + DateFrom + '/' + DateTo;

	WindowOpen(URL);

});

$('#LeastSold').click(function(){
	var ShopID = $('#LeastSoldShopID').val();
	var DateFrom = $('#LeastSoldDateFrom').val();
	var DateTo = $('#LeastSoldDateTo').val();

	if(DateFrom == ''){
		DateFrom = 0;
	}

	if (DateTo == '') {
		DateTo = 0;
	}

	var URL = '/Report/Sales/LeastSold/' + ShopID + '/' + DateFrom + '/' + DateTo;

	WindowOpen(URL);

});


$('#MostSold').click(function(){
	var ShopID = $('#MostSoldShopID').val();
	var DateFrom = $('#MostSoldDateFrom').val();
	var DateTo = $('#MostSoldDateTo').val();

	if(DateFrom == ''){
		DateFrom = 0;
	}

	if (DateTo == '') {
		DateTo = 0;
	}

	var URL = '/Report/Sales/MostSold/' + ShopID + '/' + DateFrom + '/' + DateTo;

	WindowOpen(URL);

});

$('#Discount').click(function(){
	var ShopID = $('#DiscountShopID').val();
	var DateFrom = $('#DiscountDateFrom').val();
	var DateTo = $('#DiscountDateTo').val();

	if(DateFrom == ''){
		DateFrom = 0;
	}

	if (DateTo == '') {
		DateTo = 0;
	}

	var URL = '/Report/Sales/Discount/' + ShopID + '/' + DateFrom + '/' + DateTo;

	WindowOpen(URL);

});

$('#Refund').click(function(){
	var ShopID = $('#RefundShopID').val();
	var DateFrom = $('#RefundDateFrom').val();
	var DateTo = $('#RefundDateTo').val();

	if(DateFrom == ''){
		DateFrom = 0;
	}

	if (DateTo == '') {
		DateTo = 0;
	}

	var URL = '/Report/Sales/Refund/' + ShopID + '/' + DateFrom + '/' + DateTo;

	WindowOpen(URL);

});


function WindowOpen(URL){
	var params = [
    'height='+screen.height,
    'width='+screen.width,
    'location=no',
    'fullscreen=yes' // only works in IE, but here for completeness
	].join(',');

	var popup = window.open(URL, '', params); 
	popup.moveTo(0,0);
}