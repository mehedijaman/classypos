<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use ClassyPOS\product\Product;
use Illuminate\Support\Facades\Session; 
use Illuminate\Http\Response;
use ClassyPOS\sales\Suborders;
use ClassyPOS\sales\Orders;
use ClassyPOS\sales\SubOrderProductMapping;
use ClassyPOS\shop\Shop;
use ClassyPOS\sales\Tables;
use ClassyPOS\product\ProductCategory;
use ClassyPOS\Kitchen\Kitchen;
use ClassyPOS\Kitchen\KitchenCategory;
use Cookie;
use Auth;
use ClassyPOS\user\UserNew;

class KitchenController extends Controller
{


	

	public function create()
	{
		$Shop=Shop::all();
		$Kitchen=Kitchen::where('ID','>',0)->leftjoin('shop','shop.ShopID','=','kitchen.ShopID')->get();
		//return $Kitchen;
		return view('settings.kitchen',compact('Shop','Kitchen'));
	}

	public function store(Request $rq)
	{
		//return $rq->all();
		$Kitchen=new Kitchen();
		$Kitchen->ShopID=$rq->Shop;
		$Kitchen->Name=$rq->KitchenName;
		$Kitchen->IsOpen=1;
		$Kitchen->save();
		return back();

	}

	public function update(Request $rq)
	{

		$Kitchen=Kitchen::findOrFail($rq->KitchenID);
		$Kitchen->ShopID=$rq->Shop;
		$Kitchen->Name=$rq->KitchenName;
		$Kitchen->IsOpen=1;
		$Kitchen->save();
		return back();

	}
	public function delete($ID)
	{
		Kitchen::findOrFail($ID)->delete();
	}

	public function mapping()
	{
		$CategoryList = ProductCategory::all();
		$Shop=Shop::all();
		$KitchenCategory=KitchenCategory::all();
		//return $KitchenCategory;
		$Kitchen=Kitchen::where('ID','>',0)->leftjoin('shop','shop.ShopID','=','kitchen.ShopID')->get();

    	return view('kitchen.mapping',compact('CategoryList','Shop','Kitchen','KitchenCategory'));     
	}

	public function categoryToKitchen($CategoryID,$KitchenID)
	{

		$Total=KitchenCategory::where('CategoryID','=',$CategoryID)->get();
		if(count($Total)==0)
		{
			$Mapping=new KitchenCategory();
			$Mapping->KitchenID=$KitchenID;
			$Mapping->CategoryID=$CategoryID;
			$Mapping->save();
		}

		if(count($Total)==1)
		{

			$Total[0]->KitchenID=$KitchenID;
			$Total[0]->CategoryID=$CategoryID;
			$Total[0]->save();

		}
		
		
	}


	public function index()
	{
		$Admin=Auth::user()->Admin;
		return view('kitchen.index',compact('Admin'));
	}

	public function newKOT()
	{
		//return "Fahad";
		$UserID=Auth::user()->id;
		$Admin=Auth::user()->admin;
		if(session()->has('KitchenID'))
		{
			$KitchenName=session()->get('KitchenName');
			$Kitchen=Kitchen::all();		
			return view('kitchen.new',compact('KitchenName','Kitchen','Admin'));

		}
		if($Admin==5)
		{
			$KitchenName="Select A Kitchen";
			session()->put('KitchenID',0);
			session()->put('KitchenName',$KitchenName);
		}
		else
		{
			$UserAll=UserNew::findOrFail($UserID);
			$KitchenID=$UserAll->KitchenID;
			$KitchenName=Kitchen::findOrFail($KitchenID)->Name;
			session()->put('KitchenID',$KitchenID);
			session()->put('KitchenName',$KitchenName);
			$Admin=0;

		}
		
		$Kitchen=Kitchen::all();		
		return view('kitchen.new',compact('KitchenName','Kitchen','Admin'));
	}

	public function confirmedKOT()
	{
		return view('kitchen.confirmed');
	}

	public function completedKOT()
	{
		//$Admin=Auth::user()->Admin;

		$UserID=Auth::user()->id;
		$Admin=Auth::user()->admin;
		if(session()->has('KitchenID'))
		{
			$KitchenName=session()->get('KitchenName');
			$Kitchen=Kitchen::all();		
			return view('kitchen.completed',compact('KitchenName','Kitchen','Admin'));

		}
		if($Admin==5)
		{
			$KitchenName="Select A Kitchen";
			session()->put('KitchenID',0);
			session()->put('KitchenName',$KitchenName);
		}
		else
		{
			$UserAll=UserNew::findOrFail($UserID);
			$KitchenID=$UserAll->KitchenID;
			$KitchenName=Kitchen::findOrFail($KitchenID)->Name;
			session()->put('KitchenID',$KitchenID);
			session()->put('KitchenName',$KitchenName);
			$Admin=0;

		}
		
		$Kitchen=Kitchen::all();		
		return view('kitchen.completed',compact('Admin','Kitchen'));
	}

	public function confirmed($SubOrderID)
	{
		$SubOrder=SubOrders::findOrFail($SubOrderID);
		$SubOrder->IsConfirmed=1;
		$SubOrder->save();

		# code...
	}

	public function undoConfirmed($ShopID, $KitchenID, $DateFrom, $DateTo)
	{
		
		# code...
	}


	public function completed($SubOrderID)
	{
		//return $SubOrderID;
		$SubOrder=SubOrders::findOrFail($SubOrderID);
		$SubOrder->IsComplete=1;
		$SubOrder->save();
	}

	public function undoCompleted($SubOrderID)
	{
		$SubOrder=SubOrders::findOrFail($SubOrderID);
		$SubOrder->IsComplete=0;
		$SubOrder->IsConfirmed=0;
		$SubOrder->save();

		
	}

	public function kitchenSelect($KitchenID)
	{
		$Kitchen = Kitchen::findOrFail($KitchenID);
		$KitchenName = $Kitchen->Name;
		//session()->put('ShopList', 1);
		session()->put('KitchenID', $KitchenID);
		session()->put('KitchenName', $KitchenName);
		return session()->get('KitchenName');


	}

	public function newSubOrder($SubOrderID)
     {
     		$Times=[];
	       	$OrderID=[];
	       	$CounterName=[];
	       	$CounterNameCompleted=[];
     	//return $KitchenID;
        //return "I am Zahid";
        // $Products=SubOrders::where('suborder.ShopID','=',$ShopID)->where('KitchenID','=',$KitchenID)->leftjoin('suborder_product_mapping','suborder.SubOrderID','=','suborder_product_mapping.SubOrderID')->leftjoin('product','product.ProductID','=','suborder_product_mapping.ProductID')->where('suborder_product_mapping.IsCanceled','=',0)->whereBetween('suborder.updated_at',[$start,$end])->select('suborder_product_mapping.Qty','product.ProductName','product.ProductID','suborder_product_mapping.SubOrderID','suborder.OrderID','suborder_product_mapping.Notes')->get();
        $Products=SubOrders::where('suborder.SubOrderID','=',$SubOrderID)->leftjoin('suborder_product_mapping','suborder.SubOrderID','=','suborder_product_mapping.SubOrderID')->leftjoin('product','product.ProductID','=','suborder_product_mapping.ProductID')->where('suborder_product_mapping.IsCanceled','=',0)->select('suborder_product_mapping.Qty','product.ProductName','product.ProductID','suborder_product_mapping.SubOrderID','suborder.OrderID','suborder_product_mapping.Notes','suborder_product_mapping.SubOrderProductID')->get();


        $SubOrders=SubOrders::where('SubOrderID','=',$SubOrderID)->get();

        $Total=count($SubOrders);

       			for($i=0;$i<$Total;$i++)
       			{
       				$SubID=$SubOrders[$i]->SubOrderID;
       				$All=SubOrders::where('SubOrderID','=',$SubID)->get();
       				$OrderingID=$SubOrders[$i]->OrderID;
       				array_push($Times,$All[0]);
       				array_push($OrderID,$OrderingID);
       			}
       			//return $Times;

       		    for($i=0;$i<count($OrderID);$i++)
       		    {
       		    	$CounterIDs=Orders::where('ID','=',$OrderID[$i])->get()->first();
       		    	$Counter=Tables::where('tables.ID','=',$CounterIDs->TableID)->get();
       		    	//$Counter=Counter::where('OrderID','=',$OrderID[$i])->get();
       		    	if(count($Counter)==1)
       		    		array_push($CounterName,$Counter[0]->Name);
       		        if(count($Counter)==0)
       		        	array_push($CounterName,"Parcel");

       		    }

       		    //return $CounterName;

				$jsonProducts=json_encode($Products);
				$jsonSubOrders=json_encode($SubOrders);
				$jsonSubID=json_encode($SubID);
				$jsonAll=json_encode($All);
				$jsonTimes=json_encode($Times);
				$jsonCounterName=json_encode($CounterName);
				return response(['Products'=>$jsonProducts,'SubOrders'=>$jsonSubOrders,'Total'=>$jsonSubID,'All'=>$jsonAll,'Times'=>$jsonTimes,'CounterName'=>$jsonCounterName]);
     }

     public function orderDelete($OrderID)
     {
     	return $OrderID;

     }


}
