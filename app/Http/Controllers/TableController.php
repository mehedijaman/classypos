<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use ClassyPOS\sales\Tables;
use ClassyPOS\shop\Shop;

use ClassyPOS\product\ProductCategory;

class TableController extends Controller
{
    public function create()
    {

    	$Shop=Shop::all();
    	//$CategoryList = ProductCategory::all();
    	$Counter=Tables::where('tables.ID','>',0)->leftjoin('shop','shop.ShopID','=','tables.ShopID')->get();
    	//return $Counter;
    	return view('settings.table',compact('Counter','Shop'));

    }


    public function store(Request $rq)
    {
    	
    	$Counter=new Tables();
    	$Counter->ShopID=$rq->Shop;
    	$Counter->Name=$rq->TableName;
    	$Counter->Location=$rq->TableLocation;
    	$Counter->Capacity=$rq->TableCapacity;
    	$Counter->IsBooked=0;
    	$Counter->save();
    	return back();

    }



    public function update(Request $rq)
    {

    	$Counter=Tables::findOrFail($rq->TableID);
    	$Counter->ShopID=$rq->Shop;
    	$Counter->Name=$rq->TableName;
    	$Counter->Location=$rq->TableLocation;
    	$Counter->Capacity=$rq->TableCapacity;
    	$Counter->save();
    	return back();
    }


    public function details($TableID)
    {
    	$Counter=Tables::where('ID','=',$TableID)->get();
    	$json=json_encode($Counter);
    	return response($json);
    }

    public function delete($TableID)
    {
    	$Counter=Tables::findOrFail($TableID);
    	$Counter->delete();

    }
}
