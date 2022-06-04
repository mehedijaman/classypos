<?php
namespace ClassyPOS\Http\Controllers;

use ClassyPOS\Exceptions\Handler;
use ClassyPOS\shop\Shop;


/**
* Activity Related all operations controller
*/
class AccountsController extends Controller
{	
	public function index()
	{
		return view('accounts.index');
	}
	
	public function report()
	{
		$ShopList = Shop::all();

		return view('accounts.report.index', compact('ShopList'));
	}
}