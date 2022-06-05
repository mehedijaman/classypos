<?php
namespace ClassyPOS\Http\Controllers;

use ClassyPOS\Exceptions\Handler;
use ClassyPOS\shop\Shop;
use ClassyPOS\user\User;


/**
* Activity Related all operations controller
*/
class ActivityController extends Controller
{	
	public function report()
	{
		$ShopList = Shop::all();
		$UserList = User::all();

		return view('activity.report.index', compact('ShopList', 'UserList'));
	}
}