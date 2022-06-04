<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ClassyPOS\product\ProductCategory;
use ClassyPOS\supplier\Vendor;
use ClassyPOS\shop\Shop;
use ClassyPOS\product\Product;
use ClassyPOS\shop\ShopProductMapping;
use PDF;
use PDF2;
use Illuminate\Http\Response;


class BarCodeController extends Controller
{

	#Load the Barcode Selection Page
	public function index()
	{
		$ven = Vendor::all();
	    $shop=Shop::all();
	    $Category=ProductCategory::all();
	    $all = 0;
	    return view('product.barcode.index',compact('ven','shop','Category'));
	}

	public function QRCode()
	{
		$ven = Vendor::all();
	    $shop=Shop::all();
	    $Category=ProductCategory::all();
	    $all = 0;
	    return view('product.qrcode.index',compact('ven','shop','Category'));
	}


	#Single PRoduct PDF
	public function printing($ProductID) 
	{
		$pr=Product::findOrFail($ProductID);
		$customPaper = array(0,0,360,360); 
		$all="rezwan";
		$pdf = PDF2::loadView('barcode',compact('pr'));

		$pdf->setPaper("A4","potrait");
		return $pdf->download('singleproduct.pdf'); 
	}




	# Datewise Product List
	public function datelist($id1,$id2,$id3)
	{


		$start = date("Y-m-d",strtotime($id1));
		$end = date("Y-m-d",strtotime($id2."+1 day"));

		$today=date("Y-m-d");

		

		//$start="2017-01-01";
		//$end  ="2017-06-22";
		$all=ShopProductMapping::whereBetween('shop_product_mapping.created_at',[$start,$end])
		->where('ShopID','=',$id3)
		->join('product','product.ProductID','=','shop_product_mapping.ProductID')
		->select('shop_product_mapping.Qty','product.ProductName')
		->get();

		$json = json_encode($all);
		return response($json);
	}


	#  barcode PRint
	public function PrintBarCode(Request $r)
	{

		ini_set('memory_limit', '512M');
		ini_set('max_execution_time', 300);


		if($r->ShopID>0)
		{
			$shop=Shop::findOrFail($r->ShopID);
			$shopnam=$r->UserDefinedShopName;
			$ShopID=$r->ShopID;
		}

		if($r->ShopID==0)
		{
			//$shopnam="Inventory";
			$shopnam=$r->UserDefinedShopName;
			$ShopID=0;
		}

		$total=count($r->ProductID);
		$productid  =[];
		$productname=[];
		$saleprice  =[];
		$quantity   =[];
		$shopname   =[];
		$vendorid   =[];

		for($i=0;$i<$total;$i++)
		{
			if($r->checking[$i]==1)
			{


				$VendorID=Product::findOrFail($r->ProductID[$i])->VendorID;
				// If the ProductID is less than 3 digits add extra 0 with the number
				if ($r->ProductID[$i] < 100) {
					if($r->ProductID[$i] < 10){
						$ProductID = '00'.$r->ProductID[$i];
					}
					else
						$ProductID = '0'.$r->ProductID[$i];
				}
				else
					$ProductID = $r->ProductID[$i];

				array_push($productid,  $ProductID);
				array_push($productname,$r->ProductName[$i]);
				array_push($quantity,   $r->Quantity[$i]);
				array_push($saleprice,  $r->SalePrice[$i]);
				array_push($shopname,   $shopnam);
				array_push($vendorid,$VendorID);                      

			}
		}


		$total=count($productid);


		$megaproductid=[];
		$megavendorid=[];
		$megashopname=[];
		$megaproductname=[];
		$megaproductsaleprice=[];              
		$totalquantity=0;

		for($i=0;$i<$total;$i++)
		{
			$totalquantity=$totalquantity+$quantity[$i];

			for($j=0;$j<$quantity[$i];$j++)
			{
				array_push($megaproductid,$productid[$i]);
				array_push($megavendorid,$vendorid[$i]);
				array_push($megaproductname,$productname[$i]);
				array_push($megaproductsaleprice,$saleprice[$i]);
				array_push($megashopname,$shopname[$i]);

			}
		}
			

		return view('product.barcode.print',compact('megaproductname','megaproductsaleprice','megaproductid','megavendorid','megashopname','totalquantity','ShopID'));
	}

	#  barcode PRint
	public function PrintQRCode(Request $r)
	{

		ini_set('memory_limit', '512M');
		ini_set('max_execution_time', 300);


		if($r->ShopID>0)
		{
			$shop=Shop::findOrFail($r->ShopID);
			$shopnam=$r->UserDefinedShopName;
			$ShopID=$r->ShopID;
		}

		if($r->ShopID==0)
		{
			//$shopnam="Inventory";
			$shopnam=$r->UserDefinedShopName;
			$ShopID=0;
		}

		$total=count($r->ProductID);
		$productid  =[];
		$productname=[];
		$saleprice  =[];
		$quantity   =[];
		$shopname   =[];
		$vendorid   =[];

		for($i=0;$i<$total;$i++)
		{
			if($r->checking[$i]==1)
			{


				$VendorID=Product::findOrFail($r->ProductID[$i])->VendorID;
				// If the ProductID is less than 3 digits add extra 0 with the number
				if ($r->ProductID[$i] < 100) {
					if($r->ProductID[$i] < 10){
						$ProductID = '00'.$r->ProductID[$i];
					}
					else
						$ProductID = '0'.$r->ProductID[$i];
				}
				else
					$ProductID = $r->ProductID[$i];

				array_push($productid,  $ProductID);
				array_push($productname,$r->ProductName[$i]);
				array_push($quantity,   $r->Quantity[$i]);
				array_push($saleprice,  $r->SalePrice[$i]);
				array_push($shopname,   $shopnam);
				array_push($vendorid,$VendorID);                      

			}
		}


		$total=count($productid);


		$megaproductid=[];
		$megavendorid=[];
		$megashopname=[];
		$megaproductname=[];
		$megaproductsaleprice=[];              
		$totalquantity=0;

		for($i=0;$i<$total;$i++)
		{
			$totalquantity=$totalquantity+$quantity[$i];

			for($j=0;$j<$quantity[$i];$j++)
			{
				array_push($megaproductid,$productid[$i]);
				array_push($megavendorid,$vendorid[$i]);
				array_push($megaproductname,$productname[$i]);
				array_push($megaproductsaleprice,$saleprice[$i]);
				array_push($megashopname,$shopname[$i]);

			}
		}
			

		return view('product.qrcode.print',compact('megaproductname','megaproductsaleprice','megaproductid','megavendorid','megashopname','totalquantity','ShopID'));
	}

	public function idtoName($ShopID)
	{
		

		$sh=Shop::findOrFail($ShopID);
		return $sh->ShopName;

	}
}
