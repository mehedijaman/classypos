<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use ClassyPOS\Http\Requests;
use ClassyPOS\Item;

class ItemSearchController extends Controller
{

	/**
     * Get the index name for the model.
     *
     * @return string
    */
    public function index(Request $request)
    {
    	if($request->has('titlesearch')){
    		$items = Item::search($request->titlesearch)
    			->paginate(5);
    	}else{
    		$items = Item::paginate(5);

            //return $items;
    	}
    	return view('Item-search',compact('items'));
    }

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function create(Request $request)
    {
    	$this->validate($request,['title'=>'required']);

    	$items = Item::create($request->all());
    	return back();
    }
}