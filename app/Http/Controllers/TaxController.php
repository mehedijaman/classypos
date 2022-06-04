<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use ClassyPOS\Tax\TaxCode;

/**
* Tax Controller
*/
class TaxController extends Controller
{
	
	public function Index()
	{
		$TaxList = TaxCode::all();
		return view('settings.tax', compact('TaxList'));
	}

	public function Store(Request $Data)
	{
		$FormData = $Data->all();

		$TaxCode = new TaxCode;

		$TaxCode->TaxCode = $FormData['TaxCode'];
		$TaxCode->TaxPercent = $FormData['Parcent'];

		try {
			$TaxCode->save();
			return redirect('/Tax');
		} catch (\Exception $e) {
			return $e->getMessage();
		}

		
	}

	public function delete($TaxCodeID)
	{
		TaxCode::findOrFail($TaxCodeID)->delete();
		return back();

	}

	public function update(request $rq)
	{

		$Tax=TaxCode::findOrFail($rq->editTaxID);
		$Tax->TaxCode=$rq->editTaxCode;
		$Tax->TaxPercent=$rq->editPercent;
		$Tax->save();
		return back();

	}


	
}