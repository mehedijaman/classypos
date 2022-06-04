<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use ClassyPOS\user\UserNew;
use ClassyPOS\customer\Customer;
use ClassyPOS\customer\CustomerLedger;
use ClassyPOS\customer\CustomerBalance;

use ClassyPOS\shop\Shop;
use ClassyPOS\shop\ShopProductMapping;

use ClassyPOS\sales\OnScreenButton;
use ClassyPOS\Tax\TaxCode;
use DB;
use ClassyPOS\sales\Invoice;
use ClassyPOS\sales\InvoiceSettings;
use ClassyPOS\sales\Advance;
use ClassyPOS\sales\Hold;
use ClassyPOS\sales\Orders;
use ClassyPOS\sales\Suborders;
use ClassyPOS\sales\SubOrderProductMapping;
use ClassyPOS\sales\CardTransaction;
use ClassyPOS\sales\InvoiceProductMapping;
use ClassyPOS\sales\InvoiceProductRefundMapping;
use ClassyPOS\sales\CashDrawer;
use ClassyPOS\sales\Counter;
use ClassyPOS\shop\ShopSettings;
use ClassyPOS\accounts\expense\ExpenseCategory;
use ClassyPOS\accounts\expense\Expense;
use ClassyPOS\user\User;
use ClassyPOS\user\ActivityLog;
use ClassyPOS\product\Product;
use Illuminate\Support\Facades\Session; 
use Illuminate\Http\Response;
use ClassyPOS\product\ProductCategory;
use ClassyPOS\supplier\Vendor;
use ClassyPOS\waste\Waste;
use ClassyPOS\payment\PaymentMethod;
use Cookie;
//use Slack;




class WaiterController extends Controller
{
	public function __construct()
	{
		$this->middleware('sale');
	}

  public function saeed(Request $r)
  {

    return $r->all();

    //return "Fahad is a good man";

  }
    
  public function begin()
  {

    //return Cookie::get('Restaurant2');

    //$shid=session()->get('ShopID');

    //return $shid;

    //$ShopSettings=ShopSettings::where('ShopID','=',1)->get()->first();
    //return $ShopSettings;
    //$RestaurantCheck=$ShopSettings->IsRestaurant;

    //return $RestaurantCheck;


    //$RestaurantStatus = Cookie::get('Restaurant');

    //return $RestaurantStatus;



    $ProductPerPage=3;

    //$RestaurantStatus=0;

    //Cookie::queue(\Cookie::forget('myCookie'));
    
    session()->forget('ProductIDforSale');
    $tax=TaxCode::all();

    $admin = 0;
    $id = Auth::user()->id;

    session()->put('UserID',$id);
    $userstatus = Auth::user()->admin;
    $user = UserNew::where('user.UserID','=',$id)
    ->join('shop', 'user.ShopID', '=', 'shop.ShopID')
    ->select('shop.ShopName','user.FirstName','user.ShopID','user.LastName','user.UserImg')
    ->get()
    ->first();

    $sh = $user->ShopID;

    session()->put('UserFirstName',$user->FirstName);
    session()->put('UserLastName', $user->LastName);

    $all=Shop::all();


    if($userstatus>1 && $sh==1)
    {

      $admin = 1;

      if(session()->has('ShopID'))
      {

        $shid=session()->get('ShopID');
        $product=ShopProductMapping::where('ShopID','=',$shid)
        ->join('product','product.ProductID','=','shop_product_mapping.ProductID')
        ->join('product_category','product_category.CategoryID','=','product.CategoryID')
        ->select('shop_product_mapping.Qty','shop_product_mapping.ShopID','product.ProductName','product.ProductID','product.SalePrice','product_category.CategoryName','product.CategoryID','product.VendorID')
        ->get();

        $shh=session()->get('ShopID');
        //$ShopSettings=ShopSettings::where('ShopID','=',$shh)->get()->first();
        
        //return $val;
        //->paginate($ProductPerPage);
        
      }
      else
      {
        session()->put('ShopID',0);
        session()->put('ShopName',"No Shop");

        $shid=1;
        $product=ShopProductMapping::where('ShopID','=',$shid)
        ->join('product','product.ProductID','=','shop_product_mapping.ProductID')
        ->join('product_category','product_category.CategoryID','=','product.CategoryID')
        ->select('shop_product_mapping.Qty','shop_product_mapping.ShopID','product.ProductName','product.ProductID','product.SalePrice','product_category.CategoryName','product.CategoryID','product.VendorID')
        ->get();
        //->paginate($ProductPerPage);
        
      }

      $shh=session()->get('ShopID');

      $cus=Customer::where('ShopID','=',$shh)->where('Inactive','=',0)->get();
    }





    if($userstatus==1)
    {
      $admin=0;


      if(session()->has('ShopID'))
      {

      }

      else
      {

      $ShopSettings=ShopSettings::where('ShopID','=',$sh)->get()->first();
      //$ShopSettings=ShopSettings::where('ShopID','=',$ShopID)->get()->first();
      $RestaurantCheck   =$ShopSettings->IsRestaurant;
      $ServiceChargeCheck=$ShopSettings->IsServiceCharge;
      $TipsCheck         =$ShopSettings->IsTips;
      $TaxCheck          =$ShopSettings->IsTax;
      $OrderCheck        =$ShopSettings->IsOrder;
      $HoldCheck         =$ShopSettings->IsHold;
      $AdvanceCheck      =$ShopSettings->IsAdvance;
      $BarCodeCheck      =$ShopSettings->IsBarcode;
      $InvoiceCheck      =$ShopSettings->InvoiceFormat;
      $Refund            =$ShopSettings->IsRefund;
      $Discount          =$ShopSettings->IsDiscount;

         

      
        //return "My Name is Fahad";

      Cookie::queue(Cookie::make('IsRestaurant',$RestaurantCheck));
      Cookie::queue(Cookie::make('IsServiceCharge',$ServiceChargeCheck));
      Cookie::queue(Cookie::make('IsTips',$TipsCheck));
      Cookie::queue(Cookie::make('IsTax',$TaxCheck));
      Cookie::queue(Cookie::make('IsOrder',$OrderCheck));
      Cookie::queue(Cookie::make('IsHold',$HoldCheck));
      Cookie::queue(Cookie::make('IsAdvance',$AdvanceCheck));
      Cookie::queue(Cookie::make('IsBarcode',$BarCodeCheck));
      Cookie::queue(Cookie::make('InvoiceFormat',$InvoiceCheck));
      Cookie::queue(Cookie::make('IsRefund',$Refund));
      Cookie::queue(Cookie::make('IsDiscount',$Discount));

      }

      
     


      session()->put('ShopID', $sh);
      session()->put('ShopName',$user->ShopName);

      $shh=session()->get('ShopID');
        
      



      
      //Cookie::make('IsDiscount',$Discount);




      //$RestaurantStatus = Cookie::get('Restaurant');

      //return $RestaurantStatus;



      $btn=OnScreenButton::where('ShopID',$shh)->get();

      $cus=Customer::where('ShopID','=',$sh)->where('Inactive','=',0)->get();

      $product=ShopProductMapping::where('ShopID','=',$shh)
        ->join('product','product.ProductID','=','shop_product_mapping.ProductID')
        ->join('product_category','product_category.CategoryID','=','product.CategoryID')
        ->select('shop_product_mapping.Qty','shop_product_mapping.ShopID','product.ProductName','product.ProductID','product.SalePrice','product_category.CategoryName','product.CategoryID','product.VendorID')
        ->get();
        //->paginate($ProductPerPage);
        //$Advance=Advance::where('ShopID','=',$shh)
                 //->get();
    }


    if(session()->get('ShopList')==1)
    {
      $shl = session()->get('ShopID');
      $product=ShopProductMapping::where('ShopID','=',$shl)
        ->join('product','product.ProductID','=','shop_product_mapping.ProductID')
        ->join('product_category','product_category.CategoryID','=','product.CategoryID')
        ->select('shop_product_mapping.Qty','shop_product_mapping.ShopID','product.ProductName','product.ProductID','product.SalePrice','product_category.CategoryName','product.CategoryID','product.VendorID')
        ->get();
        //->paginate($ProductPerPage);
                

      $btn = OnScreenButton::where('ShopID',$shl)->get();
      $cus = Customer::where('ShopID','=',$shl)->where('Inactive','=',0)->get();
    }

    //return session()->get('ShopList');

    $shh = session()->get('ShopID');
    $alluser=UserNew::where('ShopID','=',$sh)->get();

    //return $alluser;

    //$Shoper=Shop::all();
    //foreach($Shoper as $data)
    //{
      //$ShopWiseSaleSummary= DB::select("SELECT SUM(Total) AS Total From invoice WHERE CAST(invoice.created_at AS DATE)=curdate() AND invoice.ShopID=$data->ShopID");
    //}


    //*****                   ShopReport Calculation        *****
    $date= date("Y-m-d");    
    $ShopAll=Shop::all();
    $ShopIDAll=[];
    $ShopNameAll=[];
    $Income=[];
    $TotalIncome=0;

    foreach($ShopAll as $data)
    {
      array_push($ShopIDAll,$data->ShopID);
      array_push($ShopNameAll,$data->ShopName);
    }


    $TotalShops=count($ShopIDAll);



    for($i=0;$i<$TotalShops;$i++)
    {

      $TotalIncomeofEachShop=0;

      $invoicetotal = DB::table('invoice')
        ->whereDate('created_at',$date)
        ->where('ShopID',$ShopIDAll[$i])
        ->select('Total')
        ->get();

      foreach($invoicetotal as $data)
      {
        $TotalIncomeofEachShop=$TotalIncomeofEachShop+$data->Total;
      }

      $TotalIncome=$TotalIncome+$TotalIncomeofEachShop;
      array_push($Income,$TotalIncomeofEachShop);
    }



    //*****                   //ShopReport Calculation        ***** 


    //*****                   CashDrawer Calculation          ***** 

    $CashShopID=session()->get('ShopID');
    if($CashShopID==0)
    $CashShopID=1;
    $BalanceValue=0;
    $CashDrawerID=0;

    $CashDrawer=CashDrawer::where('ShopID','=',$CashShopID)
    ->where('isClosed','=',0)
    ->select('isClosed','OpeningBalance','CashDrawerID')
    ->get();           

    $Drawer=count($CashDrawer);

    if($Drawer==0)
    {
      $Draweropening="Open";
    }

    if($Drawer > 0)
    {
      $BalanceValue=$CashDrawer[0]->OpeningBalance;
      $CashDrawerID=$CashDrawer[0]->CashDrawerID;
      $Draweropening="Edit";
    }

    $ShopIDDD=session()->get('ShopID');

     //*****                   //CashDrawer Calculation          ***** 


    $ExpenseCategoryList  = ExpenseCategory::all();
    $VendorList           = Vendor::all();
    $CategoryList         = ProductCategory::where('product_category.CategoryID','>',0)->leftjoin('product_category_shop_mapping','product_category.CategoryID','=','product_category_shop_mapping.CategoryID')->where('product_category_shop_mapping.ShopID','=',$ShopIDDD)->get();

    //return $CategoryList;
    $TaxCodeList          = TaxCode::all();
    $Payment              = PaymentMethod::all();
    $Counters             = Counter::all();
    $BookedCounters       = Counter::where('IsBooked','=',1)->get();


    

    return view('waiter.content',compact('user','cus','all','admin','shopid','btn','alluser','product','tax','Income','ShopNameAll','TotalShops','TotalIncome','Draweropening','BalanceValue','CashDrawerID','ExpenseCategoryList','ShopAll', 'VendorList', 'CategoryList', 'TaxCodeList','Payment','Counters','BookedCounters'));


  }


  public function ShopProductList($id2)
  {

    $iden= Auth::user()->id;
    $us=UserNew::findOrFail($iden);
    $dokan=$us->ShopID;

    $good=ShopProductmapping::where('ShopID','=',$dokan)

    ->where('ProductID','=',$id2)
    ->join('product','product.ProductID','=','shop_product_mapping.ProductID')
    ->select('shop_product_mapping.Qty','shop_product_mapping.ShopID','product.ProductName','product.ProductID','product.SalePrice')
    ->get();

    $json = json_encode($good);


    return response()->json($json);

  }
      
  // Search product from left sidebar 
  public function search(Request $r)
  {

    if($r->ajax())   
    {
      $result=Product::findOrFail($r->search);
    }   
    return Response($result);
  }


  public function filterProduct($CategoryID)
  {
    $FilteredProducts=Product::where('CategoryID','=',$CategoryID)->get();
    $JsonProducts=json_encode($FilteredProducts);
    return response($JsonProducts);


  }


  public function ShopWiseSaleSummary()
  {

    $Shop=Shop::all();
    $TotalShopNumber=count($Shop);

    foreach($Shop as $data)
    {
      $ShopWiseSaleSummary[$data->ShopID]= DB::select("SELECT SUM(Total) AS Total From invoice WHERE CAST(invoice.created_at AS DATE)=curdate() AND invoice.ShopID=$data->ShopID");
    }

    return $ShopWiseSaleSummary;
  }



  public function OpeningBalance($Balance)
  {

    //return $rq->all();

    $cash=new CashDrawer();

    $cash->ShopID = session()->get('ShopID');  

    $cash->UserID = Auth::user()->id;

    $cash->OpeningBalance = $Balance;

    $cash->save();

      $activity=new ActivityLog();
      $activity->UserID=session()->get('UserID');
      $activity->ShopID=session()->get('ShopID');
      $activity->ActivityName="Opening Balance";
      $activity->save();

      return $cash->CashDrawerID;


      
  }

  public function OpeningBalanceSubmit(Request $rq)
  {
    return back();



  }

  public function EditingBalanceSubmit(Request $rq)
  {
    return back();
  }







  public function EditingBalance($Balance,$CashDrawerID)
  {
    $Cash=CashDrawer::findOrFail($CashDrawerID);
    $Cash->OpeningBalance=$Balance;
    $Cash->save();
      $activity=new ActivityLog();
      $activity->UserID=session()->get('UserID');
      $activity->ShopID=session()->get('ShopID');
      $activity->ActivityName="Editing Balace";
      $activity->save();


  }


  


  public function Expense($ExpenseCategory,$ExpenseUser,$ExpenseValue,$ExpenseNotes)

  {

    $Expense=new Expense();
    $Expense->CategoryID=$ExpenseCategory;
    $Expense->ShopID=session()->get('ShopID');
    $Expense->ExpenseBy=$ExpenseUser;
    $Expense->Notes=$ExpenseNotes;
    $Expense->Amount=$ExpenseValue;
    $Expense->save(); 

      $activity=new ActivityLog();
      $activity->UserID=session()->get('UserID');
      $activity->ShopID=session()->get('ShopID');
      $activity->ActivityName="New Expense Has been Added";
      $activity->save();

      return "Fahad";


  }




  public function AddCustomer($Phone,$Shop,$FirstName,$LastName,$Address,$City,$Province,$Country,$Email,$ZipCode,$Notes,$DateOfBirth)
  {

        
    $Customer=new Customer();
    $Customer->ShopID=$Shop;
    $Customer->Phone=$Phone;
    $Customer->FirstName=$FirstName;    
    $Customer->LastName=$LastName;    
    $Customer->Address=$Address;  
    $Customer->City=$City;    
    $Customer->Province=$Province;    
    $Customer->Country=$Country;    
    $Customer->Email=$Email;    
    $Customer->ZipCode=$ZipCode;  
    $Customer->Notes=$Notes;    
    $Customer->DateOfBirth=$DateOfBirth;
    $Customer->save();    
    $CustomerID = $Customer->CustomerID;
      // CustomerBalance object
    $CustomerBalance = new CustomerBalance();
    // collecting data for Customer Balance insert
    $CustomerBalance['CustomerID'] = $CustomerID;
    $CustomerBalance['Balance']    = 0;
    // insert Customer Balance 
    $CustomerBalance->save();
    // CustomerLedger Object
    $CustomerLedger = new CustomerLedger();
    // collecting data for CustomerLedger
    $CustomerLedger['CustomerID'] = $CustomerID;
    $CustomerLedger['InvoiceID']  = 0;
    $CustomerLedger['Debit']      = 0;
    $CustomerLedger['Credit']     = 0;
    $CustomerLedger['Balance']    = 0;

    // insert into CustomerLedger Table
    $CustomerLedger->save();
      $activity=new ActivityLog();
      $activity->UserID=session()->get('UserID');
      $activity->ShopID=session()->get('ShopID');
      $activity->ActivityName="New Customer Addition";
      $activity->save();




  }

  public function ShopSelect($ShopID)
  {
    $Shop = Shop::findOrFail($ShopID);
    $ShopName = $Shop->ShopName;
    session()->put('ShopList', 1);
    session()->put('ShopID', $ShopID);
    session()->put('ShopName', $ShopName);
    //$value=12;
    //$cookie = Cookie::make($Restaurant,$value);
    $ShopSettings=ShopSettings::where('ShopID','=',$ShopID)->get()->first();
    $RestaurantCheck=$ShopSettings->IsRestaurant;
    $ServiceChargeCheck=$ShopSettings->IsServiceCharge;
    $TipsCheck=$ShopSettings->IsTips;
    $TaxCheck=$ShopSettings->IsTax;
    $OrderCheck=$ShopSettings->IsOrder;
    $HoldCheck=$ShopSettings->IsHold;
    $AdvanceCheck=$ShopSettings->IsAdvance;
    $BarCodeCheck=$ShopSettings->IsBarcode;
    $InvoiceCheck=$ShopSettings->InvoiceFormat;
    $RefundCheck=$ShopSettings->IsRefund;
    $DiscountCheck=$ShopSettings->IsDiscount;

    Cookie::queue(Cookie::make('IsRestaurant',$RestaurantCheck));
    Cookie::queue(Cookie::make('IsServiceCharge',$ServiceChargeCheck));
    Cookie::queue(Cookie::make('IsTips',$TipsCheck));
    Cookie::queue(Cookie::make('IsTax',$TaxCheck));
    Cookie::queue(Cookie::make('IsOrder',$OrderCheck));
    Cookie::queue(Cookie::make('IsHold',$HoldCheck));
    Cookie::queue(Cookie::make('IsAdvance',$AdvanceCheck));
    Cookie::queue(Cookie::make('IsBarcode',$BarCodeCheck));
    Cookie::queue(Cookie::make('InvoiceFormat',$InvoiceCheck));
    Cookie::queue(Cookie::make('IsRefund',$RefundCheck));
    Cookie::queue(Cookie::make('IsDiscount',$DiscountCheck));
    return $ShopName;

  }

  public function CustomerSelect($id)
  {
    $cust = Customer::findOrFail($id);

    session()->put('CustomerName',$cust->FirstName);

    session()->put('CustomerID',$id);

    $custid   = session()->get('CustomerID');
    $custname = session()->get('CustomerName');
    $total    = $custname." (".$custid." )";

    return $total;
  }



  public function AddProductToCart($id, $id2)
  {
    $search=Product::where('ProductID','=',$id)
    ->leftjoin('tax_code','tax_code.TaxCodeID','=','product.TaxCode')
    ->get()->toJson();


    $singleproduct=ShopProductMapping::where('ShopID','=',$id2)->where('ProductID','=',$id)
    ->get()->first();  


    Session::push('ProductID',$singleproduct->ProductID);
    Session::push('ProductName',$singleproduct->ProductName);
    Session::push('Qty',$singleproduct->Qty);
    Session::push('Price',$singleproduct->Price);
    Session::push('TotalPrice',$singleproduct->TotalPrice);
    Session::push('Discount',$singleproduct->Discount);


    $single="fahad";
    $count=ShopProductMapping::where('ShopID','=',$id2)->where('ProductID','=',$id)
    ->get()
    ->toJson();
    return response(['search' => $search,'total'=> $count]);
  }

  public function shopExistenceCheck($ProductID,$ShopID)
  {

    $check=ShopProductMapping::where('ShopID','=',$ShopID)->where('ProductID','=',$ProductID)
    ->get();

    if(count($check)==0)
    {
      return "bad";
    }

    else

      return "good";


  }


  public function report()
  {
    $ShopList = Shop::all();
    $CategoryList = ProductCategory::all();
    $VendorList = Vendor::all();
    $UserList = User::all();

    return view('sales.report.index', compact('ShopList', 'CategoryList', 'VendorList', 'UserList'));
  }

 /* public function productIDAdvance($ProductID,$Quantity,$CustomerName,$Address,$Phone,$Amount,$DelivaryDate,$Notes)

  {



    $Date=date("Y-m-d",strtotime($DelivaryDate));
    $User=User::findOrFail(session()->get('UserID'));
    $productidprimary=explode(',', $ProductID);
    $productquantityprimary=explode(',', $Quantity);
    //$productdiscountprimary=explode(',', $DiscountAdvance);
    //$productvatprimary=explode(',', $VatAdvance);
    $totalprimaryid=count($productidprimary);
    $productid1=[];
    $Qty=[];
    $Vat=[];
    $Discount=[];
    for($i=0;$i<$totalprimaryid;$i++)
    {
      if($productidprimary[$i]>0)
      {
        array_push($productid1,$productidprimary[$i]);
        array_push($Qty,$productquantityprimary[$i]);
        //array_push($Discount,$productdiscountprimary[$i]);
        //array_push($Vat,$productvatprimary[$i]);
      }
    }

    $total=count($productid1);
    $Complex=[];

    for($i=0;$i<$total;$i++)
    {
      $Complex[$i]=array('ProductID'=>$productid1[$i],'Quantity'=>$Qty[$i]);

    }



    $ProductName=[];
    $Price=[];
    $FinalPrice=[];    

    $Total=count($productid1);
    for($i=0;$i<$Total;$i++)
    {
      $Name=Product::findOrFail($productid1[$i])->ProductName;
      $UnitPrice=Product::findOrFail($productid1[$i])->SalePrice;
      $TotalPriceAdvance=$UnitPrice*$Qty[$i];
      array_push($Price,$UnitPrice);
      array_push($ProductName,$Name);
      array_push($FinalPrice,$TotalPriceAdvance);
    }

    $ItemQty=count($productid1);
    
    $Total= count($FinalPrice);

    $TotalPrice=0;

    for($i=0;$i<$Total;$i++)
    {
      $TotalPrice=$TotalPrice+$FinalPrice[$i];
    }

    

    //$productid1 = explode(',', $ProductID);
    //$Qty = explode(',', $Quantity);

    //$jsonArray = array();
    //foreach (array_combine( $productid1, $Qty ) as $name => $value) {
      //$jsonArray[] = array('ProductID' => $name, 'Quantity' => $value);
    //}

    $json = json_encode($Complex);


    //$json = json_encode($jsonArray);

    //return $json;

    


    //$Merge=array_merge($ProductID,$Quantity);

    


    //return $User;


    //return $Date;
    $ShopID =session()->get('ShopID');
    $Advance=new Advance();
    $Advance->ShopID =$ShopID;
    $Advance->Name   =$CustomerName;
    $Advance->Phone  =$Phone;
    $Advance->Address=$Address;
    $Advance->Products=$json;
    $Advance->Notes=$Notes;
    $Advance->DeliveryDate=$Date;
    $Advance->Amount=$Amount;
    $Advance->save();

    $ID=$Advance->ID;

    $Invoice=Advance::findOrFail($ID);
    //$ProductIDs= Advance::findOrFail($ID)->Products;




    
    //$productid1 = explode(',', $ProductID);

    $ItemQty=count($productid1);

    //return $productid1;


   /* $Product=Product::whereIn('ProductID',$productid1)->get();

    $ProductName=[];
    $Price=[];
    $FinalPrice=[];
    

    $TotalPrice=0;

    

    foreach($Product as $data)
    {
      array_push($ProductName,$data->ProductName);
      array_push($Price,$data->SalePrice);

      $totalprice=$data->SalePrice;


      $TotalPrice=$TotalPrice+$totalprice;

      //array_push($FinalPrice,$totalprice);
      //array_push($Qty,1);
    }

    $TotalPrice=0;

    for($i=0;$i<count($Product);$i++)
    {
      $nn=$Price[$i]*$Qty[$i];
      $TotalPrice=$TotalPrice+$nn;
      array_push($FinalPrice,$nn);
    }*/



    /*$Due=$TotalPrice-$Amount;
    $AdvancePaid=$Amount;
    $InWords=app('ClassyPOS\Http\Controllers\TenderController')->ConvertNumberToWord($TotalPrice);

    //return $InWords;


    //$InWords = $this->ConvertNumberToWord($TotalPrice);
    $Shop=Shop::findOrFail($ShopID);


    //return $quantity1;
    //return $ItemQty;
    
    return view('invoice.advance',compact('Shop','Invoice','ProductName','Price','FinalPrice','Qty','CustomerName','Address','Phone','DelivaryDate','ItemQty','User','InWords','TotalPrice','Due','AdvancePaid'));
    

  }*/


  public function saleHold($ProductID,$Quantity,$Discount,$Vat,$Shop,$Name)
  {
    $productidprimary=explode(',', $ProductID);
    $productquantityprimary=explode(',', $Quantity);
    $productdiscountprimary=explode(',', $Discount);
    $productvatprimary=explode(',', $Vat);
    $productshopprimary=explode(',', $Shop);
    $totalprimaryid=count($productidprimary);
    $productid1=[];
    $Qty=[];
    $Discount=[];
    $Vat=[];
    $Shop=[];
    for($i=0;$i<$totalprimaryid;$i++)
    {
      if($productidprimary[$i]>0)
      {
        array_push($productid1,$productidprimary[$i]);
        array_push($Qty,$productquantityprimary[$i]);
        array_push($Discount,$productdiscountprimary[$i]);
        array_push($Vat,$productvatprimary[$i]);
        array_push($Shop,$productshopprimary[$i]);
      }
    }

    $total=count($productid1);
    $Complex=[];


    for($i=0;$i<$total;$i++)
    {
      $Complex[$i]=array('ProductID'=>$productid1[$i],'Quantity'=>$Qty[$i],'Discount'=>$Discount[$i],'Vat'=>$Vat[$i],'Shop'=>$Shop[$i]);

    }

    //$jsonArray = array();
    //foreach (array_combine( $productid1, $Qty,$Discount,$Vat) {
      //$jsonArray[] = array('ProductID' => $productid1, 'Quantity' => $Qty,'Discount'=>$Discount,'Vat'=>$Vat)
    //}

    $json = json_encode($Complex);

    $ShopID=session()->get('ShopID');

    $Hold=new Hold();
    $Hold->ShopID=$ShopID;
    $Hold->Products=$json;
    $Hold->Notes=$Name;
    $Hold->save();

    return "success";




  }


  public function saleCounterCheck()
  {
    
    $ShopID=session()->get('ShopID');
    $Count=Counter::where('IsBooked','=',0)->where('ShopID','=',$ShopID)->get();
    $json=json_encode($Count);
    return response($json);


  }


  public function saleCounterUpdateCheck()
  {

    $ShopID=session()->get('ShopID');

    $Count=Counter::where('counter.IsBooked','=',1)->where('counter.ShopID','=',$ShopID)->leftjoin('orders','counter.ID','=','orders.CounterID')
    ->leftjoin('user','orders.StaffID','=','user.UserID')
    ->where('orders.IsInvoiced','=',0)

    ->select('orders.ID','counter.Name','orders.CounterID','orders.Guests','orders.Notes','orders.StaffID','counter.IsBooked','user.FirstName','orders.IsComplete')
    ->get();

    //for($i=0;$i<count($Count);$i++)
    //{
      //Orders::where('CounterID','=',$Count[$i]->ID)->get();
    //}
    //$Ordering=json_encode()
    $json=json_encode($Count);
    return response($json);


  }



  public function saleOrderUpdate(request $rq)
  {

    //return $rq->all();
    $productidprimary= $rq->productid1;
    $productquantityprimary=$rq->total1;
    $productshopprimary= $rq->Shop1;
    $totalprimaryid=count($productidprimary);
    $productid1=[];
    $Qty=[];
    $Discount=[];
    $Vat=[];
    $Shop=[];

    for($i=0;$i<$totalprimaryid;$i++)
    {
      if($productidprimary[$i]>0)
      {
        array_push($productid1,$productidprimary[$i]);
        array_push($Qty,$productquantityprimary[$i]);
        array_push($Shop,$productshopprimary[$i]);
      }
    }

    $total=count($productid1);
    $Complex=[];
    $ProductName=[];
    $ProductID=[];


    for($i=0;$i<$total;$i++)
    {
      $Complex[$i]=array('ProductID'=>$productid1[$i],'Quantity'=>$Qty[$i],'Shop'=>$Shop[$i]);
    }

    $json = json_encode($Complex);
    $ShopID=session()->get('ShopID');

      $OrderUpdate=Orders::findOrFail($rq->OrderUpdate);
      //$OrderUpdate->ShopID=$ShopID;
      //$OrderUpdate->UserID=session()->get('UserID');
      //$OrderUpdate->CustomerID=session()->get('CustomerID');
      //$OrderUpdate->CounterID=$rq->Counter;
      $OrderUpdate->Notes=$rq->Notes;
      $OrderUpdate->StaffID =$rq->Staff;
      $OrderUpdate->Guests=$rq->Guest;
      //$OrderUpdate->IsInvoiced=0;
      //$OrderUpdate->IsComplete=0;
      $OrderUpdate->save();

    $SubOrder=new Suborders();
    $SubOrder->OrderID=$rq->OrderUpdate;
    $SubOrder->save();

    //Update Order
   /* if(isset($rq->Check))
    {
      $OrderingID=$rq->OrderIDInvoice;
      $Order=Orders::findOrFail($OrderingID);
      $Order->ShopID=$ShopID;
      $Order->UserID=session()->get('UserID');
      $Order->CustomerID=session()->get('CustomerID');
      $Order->CounterID=$rq->Counter;
      $Order->Notes=$rq->Notes;
      $Order->StaffID =$rq->Staff;
      $Order->Guests=$rq->Guest;
      $Order->IsReady=0;
      $Order->IsDelivered=0;
      $Order->IsInvoiced=0;
      $Order->IsComplete=0;
      $Order->save();*/

      for($i=0;$i<$total;$i++)
      {
        $Mapping=new SubOrderProductMapping();
        $Mapping->SubOrderID=$SubOrder->SubOrderID;
        $Mapping->ProductID=$productid1[$i];
        $Mapping->Qty=$Qty[$i];
        $Mapping->ShopID=$Shop[$i];
        $Mapping->IsCanceled=0;
        $Mapping->save();
      }

      /*$Mapping=new SubOrderProductMapping();
      $Mapping->
      
      $Mapping=SubOrderProductMapping::where('OrderID','=',$OrderingID)->delete();
      for($i=0;$i<$total;$i++)
      {
        $Mapping=new OrderProductMapping();
        $Mapping->OrderID=$OrderingID;
        $Mapping->ProductID=$productid1[$i];
        $Mapping->Qty=$Qty[$i];
        $Mapping->ShopID=$Shop[$i];
        $Mapping->save();
      }


      //return $OrderID;
    }*/

    //New Order
    //else
    //{

    $ProductName=[];
    $ProductID=[];
    $ShopID=[];
    $Price=[];
    $FinalPrice=[];

      

    for($i=0;$i<$total;$i++)
    {
      array_push($ProductID,$productid1[$i]);
      $Name=Product::findOrFail($productid1[$i])->ProductName;
      $Pr=Product::findOrFail($productid1[$i])->SalePrice;
      array_push($ProductName,$Name);
      array_push($ShopID,$Shop[$i]);
      array_push($Price,$Pr);
      array_push($FinalPrice,$Pr*$Qty[$i]);
    }     

    $ItemQty=$total;
    $shh=session()->get('ShopID');

    $Shop = Shop::findOrFail(session()->get('ShopID'));

    $TempOrderID=$rq->OrderUpdate;
    $TempSubOrderID=$SubOrder->SubOrderID;


    $Order = Orders::where('orders.ID','=',$rq->OrderUpdate)
    ->leftjoin('counter','orders.CounterID','=','counter.ID')
    ->leftjoin('user','user.UserID','=','orders.StaffID')  
    ->select('orders.ID', 'counter.Name', 'orders.Guests', 'orders.Notes', 'user.FirstName', 'orders.updated_at')      
    ->first();

    if($ItemQty==0)
      return "Nothing to print";

    return view('invoice.order',compact('TempOrderID','TempSubOrderID','Order','Shop','ItemQty','ProductID','ProductName','Qty','Price','ShopID','FinalPrice','Mapping'));
  }


  public function saleOrderUpdateWithoutProduct(request $rq)
  {



    $OrderUpdate=Orders::findOrFail($rq->OrderUpdate);
    $OrderUpdate->Notes=$rq->Notes;
    $OrderUpdate->StaffID =$rq->Staff;
    $OrderUpdate->Guests=$rq->Guest;
    $OrderUpdate->save();
    return back();
  }


   public function saleOrderListUpdate($OrderID)
   {
    //return "I am Zahid";
    $Order=Orders::findOrFail($OrderID);
     $SubOrders=SubOrders::where('OrderID','=',$OrderID)->leftjoin('suborder_product_mapping','suborder.SubOrderID','=','suborder_product_mapping.SubOrderID')->where('suborder_product_mapping.IsCanceled','=',0)->get();

     $ProductID=[];
     $ShopID=[];
     $Qty=[];
     $ProductName=[];
     $Price=[];
     $FinalPrice=[];
     $SubOrderID=[];
     $SubOrderProductID=[];
     for($i=0;$i<count($SubOrders);$i++)
     {
      array_push($ProductID,$SubOrders[$i]->ProductID);
      array_push($ShopID,$SubOrders[$i]->ShopID);
      array_push($Qty,$SubOrders[$i]->Qty);
      array_push($SubOrderID,$SubOrders[$i]->SubOrderID);
      array_push($SubOrderProductID,$SubOrders[$i]->SubOrderProductID);
     }

     for($i=0;$i<count($ProductID);$i++)
     {
      $Product=Product::findOrFail($ProductID[$i]);
      array_push($ProductName,$Product->ProductName);
      array_push($Price,$Product->SalePrice);
      array_push($FinalPrice,$Product->SalePrice*$Qty[$i]);

     }

     $jsonProductID=json_encode($ProductID);
     $jsonProductName=json_encode($ProductName);
     $jsonPrice=json_encode($Price);
     $jsonQuantity=json_encode($Qty);
     $jsonSubOrderID=json_encode($SubOrderID);
     $jsonSubOrderProductID=json_encode($SubOrderProductID);
     $jsonSubOrder=json_encode($SubOrders);

     return response(['ProductID'=>$jsonProductID,'ProductName'=>$jsonProductName,'Price'=>$jsonPrice,'Qty'=>$jsonQuantity,'SubOrderID'=>$jsonSubOrderID,'SubOrderProductID'=>$jsonSubOrderProductID,'SubOrder'=>$jsonSubOrder]);
     //$jsonProductID=json_encode($ProductID);





   }

   public function saleOrderListDelete($ID)
   {
    //return "Ali Kahn";
    $Mapping= SubOrderProductMapping::findOrFail($ID);
    $Mapping->IsCanceled=1;
    $Mapping->save();
    return "good";

   }






  public function saleOrder(request $rq)
  {


    $productidprimary= $rq->productid1;
    $productquantityprimary=$rq->total1;
    $productshopprimary= $rq->Shop1;
    $totalprimaryid=count($productidprimary);
    $productid1=[];
    $Qty=[];
    $Discount=[];
    $Vat=[];
    $Shop=[];

    for($i=0;$i<$totalprimaryid;$i++)
    {
      if($productidprimary[$i]>0)
      {
        array_push($productid1,$productidprimary[$i]);
        array_push($Qty,$productquantityprimary[$i]);
        array_push($Shop,$productshopprimary[$i]);
      }
    }

    $total=count($productid1);
    $Complex=[];
    $ProductName=[];
    $ProductID=[];


    for($i=0;$i<$total;$i++)
    {
      $Complex[$i]=array('ProductID'=>$productid1[$i],'Quantity'=>$Qty[$i],'Shop'=>$Shop[$i]);
    }

    $json = json_encode($Complex);
    $ShopID=session()->get('ShopID');

    //Update Order
   /* if(isset($rq->Check))
    {
      $OrderingID=$rq->OrderIDInvoice;
      $Order=Orders::findOrFail($OrderingID);
      $Order->ShopID=$ShopID;
      $Order->UserID=session()->get('UserID');
      $Order->CustomerID=session()->get('CustomerID');
      $Order->CounterID=$rq->Counter;
      $Order->Notes=$rq->Notes;
      $Order->StaffID =$rq->Staff;
      $Order->Guests=$rq->Guest;
      $Order->IsReady=0;
      $Order->IsDelivered=0;
      $Order->IsInvoiced=0;
      $Order->IsComplete=0;
      $Order->save();
      
      $Mapping=SubOrderProductMapping::where('OrderID','=',$OrderingID)->delete();
      for($i=0;$i<$total;$i++)
      {
        $Mapping=new OrderProductMapping();
        $Mapping->OrderID=$OrderingID;
        $Mapping->ProductID=$productid1[$i];
        $Mapping->Qty=$Qty[$i];
        $Mapping->ShopID=$Shop[$i];
        $Mapping->save();
      }


      //return $OrderID;
    }*/

    //New Order
    //else
    //{

      $Order=new Orders();
      $Order->ShopID=$ShopID;
      $Order->UserID=session()->get('UserID');
      $Order->CustomerID=session()->get('CustomerID');
      $Order->CounterID=$rq->Counter;
      $Order->Notes=$rq->Notes;
      $Order->StaffID =$rq->Staff;
      $Order->Guests=$rq->Guest;
      $Order->IsReady=0;
      $Order->IsDelivered=0;

      $Order->IsInvoiced=0;
      $Order->IsComplete=0;
      $Order->save();

      $SubOrders=new SubOrders();
      $SubOrders->OrderID=$Order->ID;
      $SubOrders->save();

      $CounterTable=Counter::findOrFail($rq->Counter);
      $CounterTable->IsBooked=1;
      $CounterTable->save();

      for($i=0;$i<$total;$i++)
      {
        $Mapping=new SubOrderProductMapping();
        $Mapping->SubOrderID=$SubOrders->SubOrderID;
        $Mapping->ProductID=$productid1[$i];
        $Mapping->Qty=$Qty[$i];
        $Mapping->ShopID=$Shop[$i];
        $Mapping->IsCanceled=0;
        $Mapping->save();
      }

    //}    

    $TempOrderID = $Order->ID;

    $ProductName=[];
    $ProductID=[];
    $ShopID=[];
    $Price=[];
    $FinalPrice=[];

    for($i=0;$i<$total;$i++)
    {
      array_push($ProductID,$productid1[$i]);
      $Name=Product::findOrFail($productid1[$i])->ProductName;
      $Pr=Product::findOrFail($productid1[$i])->SalePrice;
      array_push($ProductName,$Name);
      array_push($ShopID,$Shop[$i]);
      array_push($Price,$Pr);
      array_push($FinalPrice,$Pr*$Qty[$i]);
    }     

    $ItemQty=$total;
    $shh=session()->get('ShopID');

    $Shop = Shop::findOrFail(session()->get('ShopID'));


    $Order = Orders::where('orders.ID','=',$Order->ID)
    ->leftjoin('counter','orders.CounterID','=','counter.ID')
    ->leftjoin('user','user.UserID','=','orders.StaffID')  
    ->select('orders.ID', 'counter.Name', 'orders.Guests', 'orders.Notes', 'user.FirstName', 'orders.created_at')      
    ->first();

    return view('invoice.order',compact('TempOrderID','Order','Shop','ItemQty','ProductID','ProductName','Qty','Price','ShopID','FinalPrice'));
  }








  public function advancePrintFromList($ID)
  {

    $User=User::findOrFail(session()->get('UserID'));
    $ShopingID =session()->get('ShopID');
    $advance=Advance::findOrFail($ID);
    $CustomerName=$advance->Name;
    $Address=$advance->Address;
    $Phone=$advance->Phone;
    $DelivaryDate=$advance->DeliveryDate;
    $Amount=$advance->Amount;
    $List=$advance->Products;
    $productid1=[];
    $Qty=[];
    $ShopID=[];

    $all=json_decode($List);

    $allDiscount=$all[0]->AllDiscount;
    $allTax     =$all[0]->AllTax;
    $TotalDiscount=$allDiscount;
    $TotalTax=$allTax;
    //$Net=$allTax-$allDiscount;
    //return $Net;
    for($i=0;$i<count($all);$i++)
    {
      array_push($productid1,$all[$i]->ProductID);
      array_push($Qty,$all[$i]->Quantity);
      array_push($ShopID,$all[$i]->ShopID);
    }

    $ProductName=[];
    $Price=[];
    $FinalPrice=[];   

    $Total=count($productid1);
    $ProductID=[];
    for($i=0;$i<count($productid1);$i++)
    {
      $ProductID[$i]=$productid1[$i];
    }
    for($i=0;$i<$Total;$i++)
    {
      $Name=Product::findOrFail($productid1[$i])->ProductName;
      $UnitPrice=Product::findOrFail($productid1[$i])->SalePrice;
      $TotalPriceAdvance=$UnitPrice*$Qty[$i];
      array_push($Price,$UnitPrice);
      array_push($ProductName,$Name);
      array_push($FinalPrice,$TotalPriceAdvance);
    }

    $ItemQty=count($productid1);
    
    $Total= count($FinalPrice);

    $TotalPrice=0;

    for($i=0;$i<$Total;$i++)
    {
      $TotalPrice=$TotalPrice+$FinalPrice[$i];
    }

    $TotalPrice=$TotalPrice+$allTax-$TotalDiscount;

    //$Product=Product::whereIn('ProductID',$productid1)->get();

    //return  $Product[0]->ProductName;



    $Due=$TotalPrice-$Amount;
    $AdvancePaid=$Amount;
    $InWords=app('ClassyPOS\Http\Controllers\TenderController')->ConvertNumberToWord($TotalPrice);

    $Invoice=Advance::findOrFail($ID);

    //return $InWords;


    //$InWords = $this->ConvertNumberToWord($TotalPrice);
    $Shop=Shop::findOrFail($ShopingID);

    $ShopFooter=InvoiceSettings::where('ShopID','=',$ShopingID)->first();
    
    return view('invoice.advance',compact('Shop','Invoice','ProductName','Price','FinalPrice','Qty','CustomerName','Address','Phone','DelivaryDate','ItemQty','User','InWords','TotalPrice','Due','AdvancePaid','ShopFooter','ProductID','ShopID','TotalDiscount','TotalTax'));


  }


  public function advanceDetailsFromList($ID)
  {



    $User=User::findOrFail(session()->get('UserID'));
    $ShopingID =session()->get('ShopID');
    $advance=Advance::findOrFail($ID);
    $CustomerName=$advance->Name;
    $Address=$advance->Address;
    $Phone=$advance->Phone;
    $DelivaryDate=$advance->DeliveryDate;
    $Amount=$advance->Amount;
    $List=$advance->Products;
    $productid1=[];
    $Qty=[];
    $ShopID=[];
    $Discount=[];

    $all=json_decode($List);

    $allDiscount=$all[0]->AllDiscount;
    $allTax     =$all[0]->AllTax;
    //$Net=$allTax-$allDiscount;
    //return $Net;
    for($i=0;$i<count($all);$i++)
    {
      array_push($productid1,$all[$i]->ProductID);
      array_push($Qty,$all[$i]->Quantity);
      array_push($ShopID,$all[$i]->ShopID);
      array_push($Discount,$all[$i]->Discount);
    }

    $ProductName=[];
    $Price=[];
    $FinalPrice=[];   

    $Total=count($productid1);
    $ProductID=[];
    for($i=0;$i<count($productid1);$i++)
    {
      $ProductID[$i]=$productid1[$i];
    }
    for($i=0;$i<$Total;$i++)
    {
      $Name=Product::findOrFail($productid1[$i])->ProductName;
      $UnitPrice=Product::findOrFail($productid1[$i])->SalePrice;
      $TotalPriceAdvance=$UnitPrice*$Qty[$i]-$Discount[$i];
      array_push($Price,$UnitPrice);
      array_push($ProductName,$Name);
      array_push($FinalPrice,$TotalPriceAdvance);
    }

    $jsonProductName=json_encode($ProductName);
    $jsonProductID=json_encode($ProductID);
    $jsonShopID=json_encode($ShopID);
    $jsonQty=json_encode($Qty);
    $jsonPrice=json_encode($Price);
    $jsonFinalPrice=json_encode($FinalPrice);
    $jsonAllDiscount=json_encode($allDiscount);
    $jsonAllTax=json_encode($allTax);
    $jsonDelivaryDate=json_encode($DelivaryDate);

    

    $ItemQty=count($productid1);
    
    $Total= count($FinalPrice);

    $TotalPrice=0;

    for($i=0;$i<$Total;$i++)
    {
      $TotalPrice=$TotalPrice+$FinalPrice[$i];
    }

    $TotalPrice=$TotalPrice+$allTax;
    $jsonTotalPrice=json_encode($TotalPrice);

    //$Product=Product::whereIn('ProductID',$productid1)->get();

    //return  $Product[0]->ProductName;



    $Due=$TotalPrice-$Amount;
    $AdvancePaid=$Amount;

    $jsonAdvancePaid=json_encode($AdvancePaid);
    $jsonDue=json_encode($Due);

    return response(['ProductName'=>$jsonProductName,'ProductID'=>$jsonProductID,'Price'=>$jsonPrice,'FinalPrice'=>$jsonFinalPrice,'Qty'=>$jsonQty,'Shop'=>$jsonShopID,'Discount'=>$jsonAllDiscount,'TotalPrice'=>$jsonTotalPrice,'AdvancePaid'=>$jsonAdvancePaid,'Due'=>$jsonDue,'Tax'=>$jsonAllTax,'DelivaryDate'=>$jsonDelivaryDate]);
    $InWords=app('ClassyPOS\Http\Controllers\TenderController')->ConvertNumberToWord($TotalPrice);

    $Invoice=Advance::findOrFail($ID);

    //return $InWords;


    //$InWords = $this->ConvertNumberToWord($TotalPrice);
    $Shop=Shop::findOrFail($ShopingID);

    $ShopFooter=InvoiceSettings::where('ShopID','=',$ShopingID)->first();
    
    return view('invoice.advance',compact('Shop','Invoice','ProductName','Price','FinalPrice','Qty','CustomerName','Address','Phone','DelivaryDate','ItemQty','User','InWords','TotalPrice','Due','AdvancePaid','ShopFooter','ProductID','ShopID'));


  }


  public function advancetoProduct($ID)
  {

    $ProductIDs= Advance::findOrFail($ID)->Products;
    $all=json_decode($ProductIDs);
    $productid=[];
    $quantity=[];
    $shop=[];
    $discount=[];
    $TotalDiscountforAdvance=$all[0]->AllDiscount;

    for($i=0;$i<count($all);$i++)
    {
      array_push($productid,$all[$i]->ProductID);
      array_push($quantity,$all[$i]->Quantity);
      array_push($shop,$all[$i]->ShopID);
      array_push($discount,$all[$i]->Discount);
    }


    $totalprice=0;

    
    //return $productid;

    //return $all[0]->ProductID;
    
    //return count($all);
    //$productid1 = explode(',', $ProductIDs);
    $jsonProduct=json_encode($productid);
    $jsonQuantity=json_encode($quantity);
    $jsonShop=json_encode($shop);
    $jsonDiscount=json_encode($discount);
    $jsonTotalDiscount=json_encode($TotalDiscountforAdvance);

    return response(['Productid'=>$jsonProduct,'Productquan'=>$jsonQuantity,'Productshop'=>$jsonShop,'Productdiscount'=>$jsonDiscount,'TotalDiscount'=>$jsonTotalDiscount]);    
  }

  public function holdtoProduct($ID)
  {    

    $ProductIDs= Hold::findOrFail($ID)->Products;
    $all=json_decode($ProductIDs);
    $productid=[];
    $quantity=[];
    $discount=[];
    $vat=[];
    $shop=[];

    for($i=0;$i<count($all);$i++)
    {
      array_push($productid,$all[$i]->ProductID);
      array_push($quantity,$all[$i]->Quantity);
      array_push($discount,$all[$i]->Discount);
      array_push($vat,$all[$i]->Vat);
      array_push($shop,$all[$i]->Shop);
    }

    /*for($i=0;$i<count($all);$i++)
    {
      $productid[$i]=$productid[$i]."S".$shop[$i];
    }*/


    $totalprice=0;

    //$Hold=Hold::findOrFail($ID);
    //$Hold->delete();

    
    //return $productid;

    //return $all[0]->ProductID;
    
    //return count($all);
    //$productid1 = explode(',', $ProductIDs);
    $jsonProduct=json_encode($productid);
    $jsonQuantity=json_encode($quantity);
    $jsonDiscount=json_encode($discount);
    $jsonVat=json_encode($vat);
    $jsonshop=json_encode($shop);

    return response(['Productid'=>$jsonProduct,'Productquan'=>$jsonQuantity,'Productdiscount'=>$jsonDiscount,'Productvat'=>$jsonVat,'Productshop'=>$jsonshop]);    
  }


  public function ordertoProduct($ID)
  {


    $SubOrderID=[];
    $ProductID=[];
    $ShopID=[];
    $Qty=[]; 
    $SubOrders=SubOrders::where('OrderID','=',$ID)->get();
    //return count($SubOrders);
    
    for($i=0;$i<count($SubOrders);$i++)
    {
      $SubOrderID[$i]=$SubOrders[$i]->SubOrderID;
    }

    for($i=0;$i<count($SubOrderID);$i++)
    {
      $Total=SubOrderProductMapping::where('SubOrderID','=',$SubOrderID[$i])->get();
      for($j=0;$j<count($Total);$j++)
      {
        array_push($ProductID,$Total[$j]->ProductID);
        array_push($ShopID,$Total[$j]->ShopID);
        array_push($Qty,$Total[$j]->Qty);

      }
      
    }

    $jsonProductID=json_encode($ProductID);
    $jsonShopID   =json_encode($ShopID);
    $jsonQty      =json_encode($Qty);
    //$jsonProductID=json_encode($ProductID);

    return response(['ProductID'=>$jsonProductID,'ShopID'=>$jsonShopID,'Qty'=>$jsonQty]);

    //return $ProductID;
    $Orders=Orders::where('ID','=',$ID)->leftjoin('suborder','orders.ID','=','suborder.OrderID')->leftjoin('suborder_product_mapping','suborder.SubOrderID','=','suborder_product_mapping.SubOrderID')
    ->select('suborder_product_mapping.ProductID','suborder_product_mapping.Qty','suborder_product_mapping.ShopID','orders.IsInvoiced','orders.IsComplete')
    ->get();
    //return $Orders;
    $jsonOrders=json_encode($Orders);
    return response($jsonOrders);    

    /*$ProductIDs= Hold::findOrFail($ID)->Products;
    $all=json_decode($ProductIDs);
    $productid=[];
    $quantity=[];
    $discount=[];
    $vat=[];
    $shop=[];

    for($i=0;$i<count($all);$i++)
    {
      array_push($productid,$all[$i]->ProductID);
      array_push($quantity,$all[$i]->Quantity);
      array_push($discount,$all[$i]->Discount);
      array_push($vat,$all[$i]->Vat);
      array_push($shop,$all[$i]->Shop);
    }

    
    $jsonProduct=json_encode($productid);
    $jsonQuantity=json_encode($quantity);
    $jsonDiscount=json_encode($discount);
    $jsonVat=json_encode($vat);
    $jsonshop=json_encode($shop);

    return response(['Productid'=>$jsonProduct,'Productquan'=>$jsonQuantity,'Productdiscount'=>$jsonDiscount,'Productvat'=>$jsonVat,'Productshop'=>$jsonshop]);*/    
  }




  public function saleOrderInvoice(request $rq)
  {

    //return $rq->all();

    $Check=Orders::findOrFail($rq->OrderID);
    if($Check->IsInvoiced==1)
    {
      return "This Invoice has already been created";
    }


    $Order=Orders::where('orders.ID','=',$rq->OrderID)
    ->where('orders.IsComplete','=',0)
    ->leftjoin('counter','orders.CounterID','=','counter.ID')
    ->leftjoin('user','user.UserID','=','orders.StaffID')
    ->select('orders.ID','orders.Guests','orders.created_at','counter.Name','user.FirstName')
    ->first();


  


    $SubOrderID=[];
    $ProductID=[];
    $ShopID=[];
    $Qty=[]; 
    $SubOrders=SubOrders::where('OrderID','=',$rq->OrderID)->get();
    
    for($i=0;$i<count($SubOrders);$i++)
    {
      $SubOrderID[$i]=$SubOrders[$i]->SubOrderID;
    }

    for($i=0;$i<count($SubOrderID);$i++)
    {
      $Total=SubOrderProductMapping::where('SubOrderID','=',$SubOrderID[$i])->where('IsCanceled','=',0)->get();
      for($j=0;$j<count($Total);$j++)
      {
        array_push($ProductID,$Total[$j]->ProductID);
        array_push($ShopID,$Total[$j]->ShopID);
        array_push($Qty,$Total[$j]->Qty);

      }
      
    }

    $ProductName=[];
    $Price=[];
    $FinalPrice=[];
    $discount=[];
    $taxcode=[];
    $tax=[];
    $subtotaltotal=0;

    for($i=0;$i<count($ProductID);$i++)
    {
      $Pr=Product::findOrFail($ProductID[$i]);
      array_push($ProductName,$Pr->ProductName);
      array_push($Price,$Pr->SalePrice);
      array_push($FinalPrice,$Pr->SalePrice*$Qty[$i]);
      array_push($taxcode,$Pr->TaxCode);
      $subtotaltotal=$subtotaltotal+$Pr->SalePrice*$Qty[$i];
      array_push($discount,0);
      $Per=TaxCode::where('TaxCodeID','=',$Pr->TaxCode)->get();
      if(count($Per)==0)
        array_push($tax,0);
      else
      array_push($tax,$Per[0]->TaxPercent*$Pr->SalePrice/100*$Qty[$i]);
    }

    $vat=0;

    for($i=0;$i<count($tax);$i++)
    {
      $vat=$vat+$tax[$i];
    }

    $Shop=Shop::findOrFail(session()->get('ShopID'));
    $ItemQty=count($ProductID);
    $InWords=app('ClassyPOS\Http\Controllers\TenderController')->ConvertNumberToWord($subtotaltotal);

    $ShopFooter=InvoiceSettings::where('ShopID','=',session()->get('ShopID'))->first();


    $TotalDiscount=0;
    $tt=$subtotaltotal+$vat;
    $paid=0;
    $returned=0;
    $Customer=session()->get('CustomerID');
    $cus=$Customer;
    if($Customer==0)
    {
      $CustomerName="Annonymous";
    }
    else
    {
      $CustomerName=Customer::findOrFail($Customer)->FirstName;
    }

    //$vat=0;

    for($i=0;$i<count($ProductID);$i++)
      {

        $Shqty=ShopProductMapping::where('ProductID','=',$ProductID[$i])->where('ShopID','=',$ShopID[$i])             
       ->first();
       $CurrentQty=$Shqty->Qty;
       $SoldQty=$Qty[$i];

       $UpdatedQty=$CurrentQty-$SoldQty;            
       $Shqty->Qty=$UpdatedQty;
       $Shqty->save();
      }

      $idus= Auth::user()->id;
      $User=UserNew::where('UserID','=',$idus)            
      ->get()
      ->first();
      $username= $User->FirstName;
      $subtotalinvoice=$subtotaltotal;

      $Invoice= new Invoice();
      $Invoice->UserID=$idus;
      $Invoice->ShopID=session()->get('ShopID');
      $Invoice->SubTotal=$subtotalinvoice;
      $Invoice->Total=$tt;
      $Invoice->TaxTotal=$vat;
      $Invoice->Discount=$TotalDiscount;

      $Invoice->IsPaid=0;
      $Invoice->OrderID=$rq->OrderID;
      $Invoice->PaidMoney=0;             
      $Invoice->ReturnedMoney=0;
      $Invoice->save();
      $inid=$Invoice->InvoiceID;
      $IDforOrder=Orders::findOrFail($rq->OrderID);
      $IDforOrder->IsInvoiced=1;
      $IDforOrder->IsComplete=0;
      $IDforOrder->save();

      if($cus>0)
       {

          $map= new CustomerInvoiceMapping();
          $map->CustomerID=$cus;
          $map->InvoiceID=$inid;
          $map->save();

          if($returned>=0)
          {
            $bal=0;
            $pa=$tt;
          }

          else
          {
            $bal=$returned*(-1);
            $pa=$paid;
          }              


          $ledger= new CustomerLedger();
          $ledger->CustomerID=$cus;
          $ledger->InvoiceID=$inid;
          $ledger->Credit=$tt;
          $ledger->Debit=$pa;
          $ledger->Balance=$bal;
          $ledger->save();
          $custom=CustomerBalance::where('CustomerID','=',$cus)->get()->first();         
         
           $bav=$custom->Balance;

           if($returned>=0)
           {
             $bav=$bav;
           }                 

          else
          {
           $bav=$bav+$bal;
          }
          $custom->Balance=$bav;              
          $custom->save();

       }


       $ItemQty=count($ProductID);
       for($i=0;$i<$ItemQty;$i++)
       {

         $invp=  new InvoiceProductMapping();
         $invp->UserID=$idus;
         $invp->ShopID=$ShopID[$i];
         $invp->InvoiceID=$inid;
         $invp->ProductID=$ProductID[$i];
         $invp->ProductName=$ProductName[$i];
         $invp->Qty=$Qty[$i];
         $invp->Price=$Price[$i];
         $invp->TotalPrice=$FinalPrice[$i]+$tax[$i]*$Qty[$i]-$discount[$i];
         $invp->Discount=$discount[$i];
         $invp->TaxTotal=$tax[$i];           
         $invp->save();

       }
       

    return view('invoice.sales',compact('ItemQty','FinalPrice','Price','ProductName','Qty','discount','User','tt','paid','returned','Shop','CustomerName','vat','TotalDiscount','subtotaltotal','Invoice','InWords','ProductID','ShopFooter','ShopID','Order'));

    /*$jsonProductID=json_encode($ProductID);
    $jsonShopID   =json_encode($ShopID);
    $jsonQty      =json_encode($Qty);
    //$jsonProductID=json_encode($ProductID);

    return response(['ProductID'=>$jsonProductID,'ShopID'=>$jsonShopID,'Qty'=>$jsonQty]);

    //return $ProductID;
    $Orders=Orders::where('ID','=',$ID)->leftjoin('suborder','orders.ID','=','suborder.OrderID')->leftjoin('suborder_product_mapping','suborder.SubOrderID','=','suborder_product_mapping.SubOrderID')
    ->select('suborder_product_mapping.ProductID','suborder_product_mapping.Qty','suborder_product_mapping.ShopID')
    ->get();
    //return $Orders;
    $jsonOrders=json_encode($Orders);
    return response($jsonOrders);*/    

      
  }


  public function saleHoldDelete($ID)
  {
    $hold=Hold::findOrFail($ID);
    $hold->delete();
    return "good";
  }


  public function saleOrderDelete($ID)
  {

    
    $order=Orders::findOrFail($ID);
    $CounterID=$order->CounterID;
    //return $CounterID;
    $Reserve=Counter::findOrFail($CounterID);
    $Reserve->IsBooked=0;
    $Reserve->save();
    $order->delete();
    $suborders=Suborders::where('OrderID','=',$ID)->get();
    Suborders::where('OrderID','=',$ID)->delete();
    $total=count($suborders);

    for($i=0;$i<$total;$i++)
    {
      SubOrderProductMapping::where('SubOrderID','=',$suborders[$i]->SubOrderID)->delete();

    }

    


    
  }

  public function saleOrderTicket(request $rq)
  {

     $Order=Orders::findOrFail($rq->DetailsID);
     $Mapping=Orders::findOrFail($rq->DetailsID);
     $SubOrders=SubOrders::where('OrderID','=',$rq->DetailsID)->leftjoin('suborder_product_mapping','suborder.SubOrderID','=','suborder_product_mapping.SubOrderID')->where('suborder_product_mapping.IsCanceled','=',0)->get();

     $ProductID=[];
     $ShopID=[];
     $Qty=[];
     $ProductName=[];
     $Price=[];
     $FinalPrice=[];
     for($i=0;$i<count($SubOrders);$i++)
     {
      array_push($ProductID,$SubOrders[$i]->ProductID);
      array_push($ShopID,$SubOrders[$i]->ShopID);
      array_push($Qty,$SubOrders[$i]->Qty);
     }

     for($i=0;$i<count($ProductID);$i++)
     {
      $Product=Product::findOrFail($ProductID[$i]);
      array_push($ProductName,$Product->ProductName);
      array_push($Price,$Product->SalePrice);
      array_push($FinalPrice,$Product->SalePrice*$Qty[$i]);

     }

     $TempOrderID=$rq->DetailsID;
     $Shop=Shop::findOrFail(session()->get('ShopID'));
     $ItemQty=count($ProductID);


     
     //for($i=0;$i<count($SubOrders);)
     return view('invoice.order',compact('TempOrderID','Order','Shop','ItemQty','ProductID','ProductName','Qty','Price','ShopID','FinalPrice','Mapping'));
  }


  public function saleHoldDetails($ID)
  {

    $hold=Hold::findOrFail($ID);
    $all=$hold->Products;

    $total=json_decode($all);
    $ProductID=[];
    $ProductName=[];
    $ShopID=[];
    $Qty=[];
    $Price=[];
    $Discount=[];
    $FinalPrice=[];
    $TotalDiscount=0;
    for($i=0;$i<count($total);$i++)
    {
      array_push($ProductID,$total[$i]->ProductID);
      $Name=Product::findOrFail($total[$i]->ProductID)->ProductName;
      $SinglePrice=Product::findOrFail($total[$i]->ProductID)->SalePrice;
      $Name=Product::findOrFail($total[$i]->ProductID)->ProductName;
      array_push($ProductName,$Name);
      array_push($ShopID,$total[$i]->Shop);
      array_push($Qty,$total[$i]->Quantity);
      array_push($Price,$SinglePrice);
      array_push($Discount,$total[$i]->Discount);
      $TotalDiscount=$TotalDiscount+$total[$i]->Discount*$total[$i]->Quantity;

    }

    $TotalTax=0;


    $TotalPrice=0;
    for($i=0;$i<count($ProductID);$i++)
    {
      $TotalPrice=$TotalPrice+$Price[$i]*$Qty[$i]-$Discount[$i]*$Qty[$i];
    }

    $TotalPrice=$TotalPrice+$TotalTax;

    //return $TotalPrice;



    $jsonProductID  =json_encode($ProductID);
    $jsonProductName=json_encode($ProductName);
    $jsonShopID     =json_encode($ShopID);
    $jsonQty        =json_encode($Qty);
    $jsonPrice      =json_encode($Price);
    $jsonDiscount   =json_encode($TotalDiscount);
    $jsonTax        =json_encode($TotalTax);
    $jsonTotalPrice =json_encode($TotalPrice);

    return response(['ProductID'=>$jsonProductID,'ProductName'=>$jsonProductName,'ShopID'=>$jsonShopID,'Qty'=>$jsonQty,'Price'=>$jsonPrice,'Discount'=>$jsonDiscount,'TotalPrice'=>$jsonTotalPrice,'Tax'=>$jsonTax]);
    //$jsonProductID=json_encode($ProductID);
    //return $ProductName;
    return $total[0]->ProductID;
    //return response($jsonhold);  
  }


  public function saleOrderDetails($ID)
  {


    $Order=Orders::findOrFail($ID);
     $SubOrders=SubOrders::where('OrderID','=',$ID)->leftjoin('suborder_product_mapping','suborder.SubOrderID','=','suborder_product_mapping.SubOrderID')->where('suborder_product_mapping.IsCanceled','=',0)->get();

     $ProductID=[];
     $ShopID=[];
     $Qty=[];
     $ProductName=[];
     $Price=[];
     $FinalPrice=[];
     $Time      =[];
     $TaxValue   =[];
     $TotalTax=0;
     $TotalPrice=0;
     for($i=0;$i<count($SubOrders);$i++)
     {
      array_push($ProductID,$SubOrders[$i]->ProductID);
      array_push($ShopID,$SubOrders[$i]->ShopID);
      array_push($Qty,$SubOrders[$i]->Qty);
      array_push($Time,$SubOrders[$i]->created_at);
     }

     for($i=0;$i<count($ProductID);$i++)
     {
      $Product=Product::findOrFail($ProductID[$i]);
      array_push($ProductName,$Product->ProductName);
      array_push($Price,$Product->SalePrice);
      array_push($FinalPrice,$Product->SalePrice*$Qty[$i]);
      $TotalPrice=$TotalPrice+$Product->SalePrice*$Qty[$i];
      $TaxAll=TaxCode::where('TaxCodeID','=',$Product->TaxCode)->get();
      if(count($TaxAll)==0)
      {
        $TotalTax=$TotalTax+0;
      }
      else
      {
        $Percent=$TaxAll[0]->TaxPercent*$Product->SalePrice*$Qty[$i]/100;
        $TotalTax=$TotalTax+$Percent;
      }
      //$Percent=TaxCode::findOrFail($Product->TaxCode)->TaxPercent;
      //$TaxOrder=$Percent*$Product->SalePrice*$Qty[$i]/100;
      //array_push($TaxValue,$TaxOrder);
      //$TotalTax=$TotalTax+$TaxOrder;
     }

    
     //return $TotalPrice;
     //return $TotalTax;

     //$TempOrderID=$ID;
     $Shop=Shop::findOrFail(session()->get('ShopID'));
     //$ItemQty=count($ProductID);


   /* $hold=Hold::findOrFail($ID);
    $all=$hold->Products;

    $total=json_decode($all);
    $ProductID=[];
    $ProductName=[];
    $ShopID=[];
    $Qty=[];
    $Price=[];
    $Discount=[];
    $FinalPrice=[];
    $TotalDiscount=0;
    for($i=0;$i<count($total);$i++)
    {
      array_push($ProductID,$total[$i]->ProductID);
      $Name=Product::findOrFail($total[$i]->ProductID)->ProductName;
      $SinglePrice=Product::findOrFail($total[$i]->ProductID)->SalePrice;
      $Name=Product::findOrFail($total[$i]->ProductID)->ProductName;
      array_push($ProductName,$Name);
      array_push($ShopID,$total[$i]->Shop);
      array_push($Qty,$total[$i]->Quantity);
      array_push($Price,$SinglePrice);
      array_push($Discount,$total[$i]->Discount);
      $TotalDiscount=$TotalDiscount+$total[$i]->Discount*$total[$i]->Quantity;

    }*/

    //$TotalTax=0;


   // $TotalPrice=0;
    //for($i=0;$i<count($ProductID);$i++)
   // {
     // $TotalPrice=$TotalPrice+$Price[$i]*$Qty[$i]-$Discount[$i]*$Qty[$i];
   // }

    //$TotalPrice=$TotalPrice+$TotalTax;

    //return $TotalPrice;



    $jsonProductID  =json_encode($ProductID);
    $jsonProductName=json_encode($ProductName);
    $jsonShopID     =json_encode($ShopID);
    $jsonQty        =json_encode($Qty);
    $jsonPrice      =json_encode($Price);
    $jsonTime       =json_encode($SubOrders);
    $jsonTotalPrice =json_encode($TotalPrice);
    $jsonTotalTax   =json_encode($TotalTax);
    

    return response(['ProductID'=>$jsonProductID,'ProductName'=>$jsonProductName,'ShopID'=>$jsonShopID,'Qty'=>$jsonQty,'Price'=>$jsonPrice,'SubOrder'=>$jsonTime,'TotalPrice'=>$jsonTotalPrice,'TotalTax'=>$jsonTotalTax]);
    //$jsonDiscount   =json_encode($TotalDiscount);
    //$jsonTax        =json_encode($TotalTax);
    //$jsonTotalPrice =json_encode($TotalPrice);

    return response(['ProductID'=>$jsonProductID,'ProductName'=>$jsonProductName,'ShopID'=>$jsonShopID,'Qty'=>$jsonQty,'Price'=>$jsonPrice,'Discount'=>$jsonDiscount,'TotalPrice'=>$jsonTotalPrice,'Tax'=>$jsonTax]);
    //$jsonProductID=json_encode($ProductID);
    //return $ProductName;
    return $total[0]->ProductID;
    //return response($jsonhold);  
  }




  public function advanceListDelete($ID)
  {

    $ProductIDs= Advance::findOrFail($ID);
    $ProductIDs->delete();
    return back();
  }

  public function advanceListComplete($ID)
  {

    $ProductIDs= Advance::findOrFail($ID);
    $ProductIDs->IsSold=1;
    return back();
  }




  public function ShopCheck($ID)
  {

    $Shop=Shop::where('ShopID','>',0)->get();
    $total=count($Shop);

    if($total==0)
      return "0";
    else 
      return "1";

  }

  public function splitPayment()

  {

    $all=PaymentMethod::all();
    $json=json_encode($all);
    return response($json);
  }


  public function paymentMethodIDToName($MethodID)
  {

  }



  public function advanceConfirm(Request $rq)
  {

    //return $rq->all();

    //$tax1=$rq->taxvalue1;
    //return $tax1; 

    
    $allTax=$rq->OverAllTax;
    $allDiscount=$rq->OverAllDiscount;

    $CustomerName=$rq->CustomerName;
    $Address=$rq->CustomerAddress;
    $Phone=$rq->CustomerPhone;
    
    $DelivaryDate=$rq->DelivaryDate;
    $Date=date("Y-m-d",strtotime($DelivaryDate));
    $User=User::findOrFail(session()->get('UserID'));
    $productidprimary=$rq->productid1;
    $productquantityprimary=$rq->total1;
    $ShopID1=$rq->Shop1;
    $Discount1=$rq->discount1;

    $Tax1=$rq->taxvalue1;
    //return $Tax1;
    //$productdiscountprimary=explode(',', $DiscountAdvance);
    //$productvatprimary=explode(',', $VatAdvance);
    $totalprimaryid=count($productidprimary);
    $productid1=[];
    $Qty=[];
    $Tax=[];
    $Discount=[];
    $ShopID=[];
    for($i=0;$i<$totalprimaryid;$i++)
    {
      if($productidprimary[$i]>0)
      {
        array_push($productid1,$productidprimary[$i]);
        array_push($Qty,$productquantityprimary[$i]);
        array_push($Discount,$Discount1[$i]);
        array_push($Tax,$Tax1[$i]);
        array_push($ShopID,$ShopID1[$i]);
        //array_push($Discount,$productdiscountprimary[$i]);
        //array_push($Vat,$productvatprimary[$i]);
      }
    }
    //return $Discount;
    


    $total=count($productid1);
    $Complex=[];

    for($i=0;$i<$total;$i++)
    {
      $Complex[$i]=array('ProductID'=>$productid1[$i],'Quantity'=>$Qty[$i],'Discount'=>$Discount[$i],'Tax'=>$Tax[$i],'ShopID'=>$ShopID[$i],'AllTax'=>$allTax,'AllDiscount'=>$allDiscount);

    }



    $ProductName=[];
    $Price=[];
    $FinalPrice=[];    

    $Total=count($productid1);
    for($i=0;$i<$Total;$i++)
    {
      $Name=Product::findOrFail($productid1[$i])->ProductName;
      $UnitPrice=Product::findOrFail($productid1[$i])->SalePrice;
      $TotalPriceAdvance=$UnitPrice*$Qty[$i];
      array_push($Price,$UnitPrice);
      array_push($ProductName,$Name);
      array_push($FinalPrice,$TotalPriceAdvance);
    }

    $ItemQty=count($productid1);
    
    $Total= count($FinalPrice);

    $TotalPrice=0;

    for($i=0;$i<$Total;$i++)
    {
      $TotalPrice=$TotalPrice+$FinalPrice[$i];
    }
    $SubTotal=$TotalPrice;
    $TotalPrice=$TotalPrice+$allTax-$allDiscount;

    $json = json_encode($Complex);

    $ShopingID =session()->get('ShopID');
    $Advance=new Advance();
    $Advance->ShopID =$ShopingID;
    $Advance->Name   =$rq->CustomerName;
    $Advance->Phone  =$rq->CustomerPhone;
    $Advance->Address=$rq->CustomerAddress;
    $Advance->Products=$json;
    $Advance->Notes=$rq->Notes;
    $Advance->DeliveryDate=$Date;
    $Advance->Amount=$rq->CustomerAmount;
    $Advance->IsSold=0;
    $Advance->save();

    $ID=$Advance->ID;

    $Invoice=Advance::findOrFail($ID);
    $ItemQty=count($productid1);
    $Due=$TotalPrice-$rq->CustomerAmount;
    $AdvancePaid=$rq->CustomerAmount;
    $InWords=app('ClassyPOS\Http\Controllers\TenderController')->ConvertNumberToWord($TotalPrice);
    $Shop=Shop::findOrFail($ShopingID);

    $TotalDiscount=$allDiscount;
    /*for($i=0;$i<count($productid1);$i++)
    {
      $TotalDiscount=$TotalDiscount+$Discount[$i];
    }*/
    

    $ProductID=[];

           for($i=0;$i<count($productid1);$i++)
           {
            $ProductID[$i]=$productid1[$i];
           }

           $ShopFooter=InvoiceSettings::where('ShopID','=',session()->get('ShopID'))->first();
    
    $TotalTax=$allTax;    
    return view('invoice.advance',compact('Shop','Invoice','ProductName','Price','FinalPrice','Qty','CustomerName','Address','Phone','DelivaryDate','ItemQty','User','InWords','TotalPrice','Due','AdvancePaid','ProductID','ShopFooter','ShopID','TotalDiscount','TotalTax','SubTotal'));
  }



  public function taxCodetoPercentage($VatID)
  {

    $Tax=TaxCode::where('TaxCode','=',$VatID)->get();
    if(count($Tax)==0)
    {
      return 0;
    }

    else
    {
      return $Tax[0]->TaxPercent;
    }

    //return TaxCode::findOrFail($VatID)->TaxPercent;
  }


  public function ALI(Request $rq)
  {

    return $rq->all();
  }



  


  




  
}
