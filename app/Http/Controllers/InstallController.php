<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class InstallController extends Controller
{
    //load install view
    public function index()
    {
    	return view('install.index');
    }

    // Migrate database on post request
    public function install()
    {
    	Artisan::call('migrate');
    	return back()->with('message', 'Installation Completed !');
    }
}
