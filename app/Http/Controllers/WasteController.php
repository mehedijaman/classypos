<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use ClassyPOS\waste\Waste;
use ClassyPOS\shop\Shop;
use ClassyPOS\product\ProductCategory;
use ClassyPOS\supplier\Vendor;
use ClassyPOS\product\Product;
use ClassyPOS\shop\ShopProductMapping;




/**
* Waste Couunt Controller
*/
class WasteController extends Controller
{
	
	public function index()
	{
		return view('waste.index');
	}


	public function create()
	{
		$ShopList = Shop::all();
		$CategoryList = ProductCategory::all();
		$VendorList = Vendor::all();
		$ProductList = Product::all();

		return view('waste.new', compact('ShopList', 'CategoryList', 'VendorList', 'ProductList'));
	}


	public function store($ShopID,$ProductID,$Qty,$UnitCost,$TotalPrice,$WastedBy,$Note )
	{


		$Waste=new Waste();
		$Waste->ShopID=$ShopID;
		$Waste->ProductID=$ProductID;
		$Waste->Qty=$Qty;
		$Waste->UnitCost=$UnitCost;
		$Waste->TotalPrice=$TotalPrice;
		$Waste->WastedBy=$WastedBy;
		$Waste->Note=$Note;
		$Waste->save();

		if($ShopID>0)
		{
			$Pr=ShopProductMapping::where('ShopID','=',$ShopID)->where('ProductID','=',$ProductID)->get()->first();
			$CurQty=$Pr->Qty;
			$UpdatedQty=$CurQty-$Qty;
			$Pr->Qty=$UpdatedQty;
			$Pr->save();
		}

		if($ShopID==0)
		{
			$Pr=Product::where('ProductID','=',$ProductID)->get()->first();
			$CurQty=$Pr->Qty;
			$UpdatedQty=$CurQty-$Qty;
			$Pr->Qty=$UpdatedQty;
			$Pr->save();
		}
	}
	

	public function listWaste()
	{

		$WasteList = Waste::where('waste.ProductID','>',0)
		->join('product','product.ProductID','=','waste.ProductID')
		->leftJoin('shop','shop.ShopID','=','waste.ShopID')
		->select('waste.Qty','waste.UnitCost','waste.TotalPrice','waste.WastedBy','waste.Note','product.ProductName','shop.ShopName','waste.WasteID', 'waste.created_at', 'waste.updated_at')
		->get();

		$WasteInventory=Waste::where('waste.ProductID','>',0)->where('waste.ShopID','=',0)
		->join('product','product.ProductID','=','waste.ProductID')
		->select('waste.Qty','waste.UnitCost','waste.TotalPrice','waste.WastedBy','waste.Note','product.ProductName','waste.WasteID')
		->get();
		
		return view ('waste.list', compact('WasteList','WasteInventory'));
	}


	public function edit($WasteID)
	{


		$Shop=Shop::all();
		$Product=Product::all();

		$WasteEdit=Waste::where('WasteID','=',$WasteID)->get()->first();

		return view('waste.edit',compact('Shop','Product','WasteEdit'));



	}


	public function update(Request $Data,$WasteID)
	{
		
		$WasteUpdate=Waste::where('WasteID','=',$WasteID)->get()->first();
		$WasteUpdate->ShopID=$Data->ShopID;
		$WasteUpdate->ProductID=$Data->ProductID;
		$WasteUpdate->Qty=$Data->Quantity;
		$WasteUpdate->WastedBy=$Data->WastedBy;
		$WasteUpdate->Note=$Data->Notes;
		$WasteUpdate->save();

		return redirect('Waste/List');


	}

	public function destroy($WasteID)
	{

		$Waste=Waste::where('WasteID','=',$WasteID)->get()->first();
		$ShopID=$Waste->ShopID;
		$ProductID=$Waste->ProductID;
		$WastedQty=$Waste->Qty;
		if($ShopID>0)
		{
			$Shop=ShopProductMapping::where('ShopID','=',$ShopID)->where('ProductID','=',$ProductID)->get()->first();
			$CurQty=$Shop->Qty;
			$UpdatedQty=$CurQty+$WastedQty;
			$Shop->Qty=$UpdatedQty;
			$Shop->save();

		}

		if($ShopID==0)
		{

			$Product=Product::where('ProductID','=',$ProductID)->get()->first();
			$CurQty=$Product->Qty;
			$UpdatedQty=$CurQty+$WastedQty;
			$Product->Qty=$UpdatedQty;
			$Product->save();

		}
		
		Waste::findOrFail($WasteID)->delete();


		return redirect('Waste/List');
	}

	public function report()
	{
		$ShopList = Shop::all();
		return view('waste.report.index', compact('ShopList'));
	}
}