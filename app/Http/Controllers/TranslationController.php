<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;

class TranslationController extends Controller
{
	/**
	* Change session locale
	* @param  Request $request
	* @return Response
	*/
	public function changeLocale(Request $request)
	{
	//$this->validate($request, ['locale' => 'required|in:bn,en']);

	\Session::put('locale', $request->locale);

	return redirect()->back();
	}
}
