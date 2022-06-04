<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;   

use ClassyPOS\sales\Invoice; 
use ClassyPOS\product\Product;
use ClassyPOS\sales\InvoiceProductMapping;
use ClassyPOS\sales\InvoiceProductRefundMapping;
use ClassyPOS\accounts\expense\Expense;
use ClassyPOS\purchase\PurchaseInvoice;
use Auth;
use ClassyPOS\user\UserNew;
use DB;



class DashboardController extends Controller
{


  public function index()
  {
    // Todays Total Sale

    $UserID = Auth::user()->id;
    $User = UserNew::where('UserID','=',$UserID)->get()->first();
    $UserName=$User->FirstName." ".$User->LastName;
    session()->put('UserName',$UserName);
    $UserImageName=$User->UserImg;    
    session()->put('UserImageName',$UserImageName);

    $Invoice = new Invoice;
    $TodaysSaleTotal = $Invoice->TodaysTotal();

    // Todays Total Refund
    $Refund = new InvoiceProductRefundMapping;
    $TodaysTotalRefund = $Refund->TodaysTotal();


    // Todays Total expense
    $Expense = new Expense;
    $TodaysTotalExpense = $Expense->TodaysTotal();

    // Todays Total Purchase
    $Purchase = new PurchaseInvoice;
    $TodaysTotalPurchase = $Purchase->TodaysTotal();

    // Latest Invoices    
    $LatestInvoices = $Invoice->LatestInvoices(9);

    //Latest Products
    $Product = new Product;
    $LatestProducts = $Product->LatestProducts(7);

    $TotalItem      = $this->TotalItem();
    $TotalQty       = $this->TotalQty();
    $TotalCategory  = $this->TotalCategory();
    $TotalVendor    = $this->TotalVendor();

    return view('admin.dashboard', compact('TodaysSaleTotal','TodaysTotalRefund','TodaysTotalExpense','TodaysTotalPurchase','LatestInvoices', 'LatestProducts','UserName','TotalItem', 'TotalQty', 'TotalCategory', 'TotalVendor'));
  }

  public function TotalItem()
  {
      $Total = DB::select("SELECT COUNT(product.ProductID) FROM product WHERE product.InactiveProduct = 0");
      return $Total;
  }

  public function TotalQty()
  {
      $Total = DB::select("SELECT COUNT(product.Qty) FROM product WHERE product.InactiveProduct = 0");
      return $Total;
  }

  public function TotalCategory()
  {
      $Total = DB::select("SELECT COUNT(product_category.CategoryID) FROM product_category");
      return $Total;
  }

  public function TotalVendor()
  {
      $Total = DB::select("SELECT COUNT(vendor.VendorID) FROM vendor");
      return $Total;
  }

  public function TopSold($Limit = 5)
  {
      $InvoiceProductMapping = new InvoiceProductMapping;

      $TopSold = $InvoiceProductMapping->TopSold($Limit);

      $Json = json_encode($TopSold);
      return response($Json);
  }

  public function createSettings()
  {
    return view('settings.index');
  }



}
