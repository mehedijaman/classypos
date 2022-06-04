<?php
namespace ClassyPOS\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Cookie;

class LogoutController extends Controller
{   
  public function logout()
  {
    Auth::logout(); 
    Session::flush(); 
    Cookie::queue(Cookie::forget('IsDiscount'));
    Cookie::queue(Cookie::forget('IsTax'));
    Cookie::queue(Cookie::forget('IsOrder'));
    Cookie::queue(Cookie::forget('IsHold'));
    Cookie::queue(Cookie::forget('IsAdvance'));
    Cookie::queue(Cookie::forget('IsRefund'));
    Cookie::queue(Cookie::forget('IsRestaurant'));
    Cookie::queue(Cookie::forget('IsServiceCharge'));

    return redirect('/');  
  }
}
