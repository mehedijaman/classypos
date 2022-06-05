<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use ClassyPOS\shop\Shop;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Shop=Shop::all();
        if(auth::check())
        {
            if(auth::user()->admin==5)                
                return view('begin',compact('Shop'));

            if(auth::user()->admin==1)
                return redirect('/Sales');
             if(auth::user()->admin==3)
                return redirect('/Kitchen/KOT/New');
            if(auth::user()->admin==2)
                return redirect('/Waiter');


        }
        return view('auth.login');
    }
}
