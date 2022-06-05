<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use ClassyPOS\payment\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function Index()
    {
    	$MethodList = PaymentMethod::all();

        return view('payment_method.index', compact('MethodList'));
    }

    public function Store(Request $Data)
    {
    	$PaymentMethod = new PaymentMethod;

    	$FormData = $Data->all();

    	$PaymentMethod->MethodName = $FormData['MethodName'];

    	$PaymentMethod->save();

    	return redirect('/PaymentMethod');
    }

    public function Edit($MethodID)
    {
    	$PaymentMethod = new PaymentMethod;

    	$Method = PaymentMethod::where('ID','=',$MethodID)->get();

    	$Json = json_encode($Method);

    	return response($Json);
    }

    public function update(request $rq)
    {
        $Method=PaymentMethod::findOrFail($rq->MethodID);
        $Method->MethodName=$rq->MethodName;
        $Method->save();
        return back();

    }
}
