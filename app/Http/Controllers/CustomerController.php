<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use ClassyPOS\shop\Shop;
use ClassyPOS\customer\Customer;
use ClassyPOS\customer\CustomerBalance;
use ClassyPOS\customer\CustomerLedger;
use Validator;
use Input;
use Auth;
use ClassyPOS\user\UserRoleCategory;
use ClassyPOS\user\UserRole;
use ClassyPOS\user\ActivityLog;
use ClassyPOS\bank\Bank;
use ClassyPOS\bank\BankLedger;
use ClassyPOS\bank\BankBalance;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session; 
use Yajra\Datatables\Datatables;

class CustomerController extends Controller
{
  public function index()
  {
    return view('customer.index');
  }
  
  # Load Customer Create view
  public function createCustomer()
  {
  	$all = Shop::all();

  	return view( 'customer.new', compact( 'all' ) );
  }

  #Load Customer Barcode View
  public function createBarcode()
  {
    return view('customer.barcode');
  }

  # Load Customer Ledger Create View
  public function CreateLedger()
  {
    if (func_num_args() == 0) {
      return view('customer.ledger');
    }
    else{
      echo "Show that Customers ledger";
    }  
  }


  public function showLedger($CustomerID)
  {
    $CustomerLedger=CustomerLedger::where('customer.CustomerID','=',$CustomerID)
    ->join('customer','customer.CustomerID','=','customer_ledger.CustomerID')->get();
    return view('customer.ledger.list',compact('CustomerLedger'));
  }

  # Load Customer Balance View
  public function createBalance($CustomerID = null)
  {
    if ($CustomerID == null) {
      return "No Customer Balance";
    }
    else
      return "That Customer Balance";
    // if (func_num_args() == 0) {
    //   return view('customer.balance');
    // }
    // else{
    //   echo "Show that Customers balance";
    // }    
  }

  # Load Customer Balance View
  // public function createBalance($CustomerID)
  // {
  //   return view('customer.balance');
  // }


  # Create New Customer
  public function storeCustomer(Request $Data)
  {


    try {
      // Customer object
      $Customer = new Customer(); 

      // Extracting FormData
      $FormData  = $Data->all();

      // if file is not selected it will be empty string
      if($Data->file('CustomerImg') == "")
      {
        $ImageName = "";
      }
      else
      {
        // retrieve original file path
        $ImageTempName = $Data->file('CustomerImg')->getPathName();

        //retrieve original file name 
        $ImageName = $Data->file('CustomerImg')->getClientOriginalName();
        
        // define path to upload image
        $Path = base_path() . '/public/uploads/image/customer';

        // upload image to defined path directory
        $Data->file('CustomerImg')->move($Path , $ImageName);
      }  

      // collecting data to insert into customer table
      $Customer['ShopID']     = $FormData['ShopID'];
      $Customer['FirstName']  = $FormData['FirstName'];
      $Customer['LastName']   = $FormData['LastName'];
      $Customer['Address']    = $FormData['Address'];
      $Customer['City']       = $FormData['City'];
      $Customer['Province']   = $FormData['Province'];
      $Customer['Country']    = $FormData['Country'];
      $Customer['Phone']      = $FormData['Phone'];
      $Customer['Email']      = $FormData['Email'];
      $Customer['DateOfBirth']= $FormData['DateOfBirth'];
      $Customer['Notes']      = $FormData['Notes'];
      $Customer['CustomerImg']= $ImageName;      
      $Customer['ZipCode']    = $FormData['ZipCode'];
      $Customer->Inactive     =0;

      // Creating new Customer into database
      $Customer->save();

      // retrieve CustomerID after inserting a new Customer
      $CustomerID = $Customer['CustomerID'];

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

      return redirect('/Customer/List');
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }



  public function storeCustomerSales(Request $Data)
  {

    
    try {
      // Customer object
      $Customer = new Customer(); 

      // Extracting FormData
      $FormData  = $Data->all();

      // if file is not selected it will be empty string
      if($Data->file('CustomerImg') == "")
      {
        $ImageName = "";
      }
      else
      {
        // retrieve original file path
        $ImageTempName = $Data->file('CustomerImg')->getPathName();

        //retrieve original file name 
        $ImageName = $Data->file('CustomerImg')->getClientOriginalName();
        
        // define path to upload image
        $Path = base_path() . '/public/uploads/image/customer';

        // upload image to defined path directory
        $Data->file('CustomerImg')->move($Path , $ImageName);
      }  

      // collecting data to insert into customer table
      $Customer['ShopID']     = $FormData['ShopID'];
      $Customer['FirstName']  = $FormData['FirstName'];
      $Customer['LastName']   = $FormData['LastName'];
      $Customer['Address']    = $FormData['Address'];
      $Customer['City']       = $FormData['City'];
      $Customer['Province']   = $FormData['Province'];
      $Customer['Country']    = $FormData['Country'];
      $Customer['Phone']      = $FormData['Phone'];
      $Customer['Email']      = $FormData['Email'];
      $Customer['DateOfBirth']= $FormData['DateOfBirth'];
      $Customer['Notes']      = $FormData['Notes'];
      $Customer['CustomerImg']= $ImageName;      
      $Customer['ZipCode']    = $FormData['ZipCode'];
      $Customer->Inactive     =0;

      // Creating new Customer into database
      $Customer->save();

      // retrieve CustomerID after inserting a new Customer
      $CustomerID = $Customer['CustomerID'];

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

      return redirect('/sales');
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }



  # Create New Customer Ledger
  public function storeLedger(Request $data)
  {
    # code...
  }

  public function makeList()
  {
    $Customer = new Customer;
    $CustomerList = $Customer->ListCustomer();
    return Datatables::of($CustomerList)
    // ->addColumn('action', function ($user) {
    //     return '<a href="#edit-'.$Customer->CustomerID.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
    // })
    // ->editColumn('CustomerID', 'CustomerID: {{$CustomerID}}')
    ->make(true);
  }

  # Show Customer List
  public function listCustomer()
  {
    // return $this->makeList();
    return view('customer.list');
  }

  #Show Customer LEdger List
  public function listLedger()
  {
    $CustomerLedger=CustomerLedger::where('CustomerID','=',$VendorID)->get();
    return view('supplier.ledger',compact('VendorLedger'));

  }

  public function detailsCustomer($CustomerID)
  {
    
    $Details = Customer::where('CustomerID','=',$CustomerID)->get()->first();

    return view('customer.details',compact('Details'));

    //$Json = json_encode($Details);

    //return response($Json);
  }

   public function AjaxCustomer($CustomerID)
  {
    $Details = Customer::where('CustomerID','=',$CustomerID)->get();
    //return view('customer.details',compact('Details'));
    $Json = json_encode($Details);
    return response($Json);
  }




  # Ledger Details
  public function detailsLedger($id)
  {
    # code...
  }


  # Customer Balance Details
  public function detailsBalance($id)
  {
    # code...
  }


  # Delete Customer
  public function destroyCustomer($CustomerID)
  {
    $cust=Customer::findOrFail($CustomerID);
    $cust->delete();
    $LedgerDelete= CustomerLedger::where('CustomerID','=',$CustomerID)->delete();
    $BalanceDelete=CustomerBalance::where('CustomerID','=',$CustomerID)->delete();    

    return redirect('/Customer/List');
    
  }

  # Delete Ledger
  public function destroyLedger($LedgerID)
  {

    $CustomerLedger=CustomerLedger::findOrFail($LedgerID);
    $LedgerBalance=$CustomerLedger->Balance;
    $CustomerID=$CustomerLedger->CustomerID;
    $CustomerBalance=CustomerBalance::where('CustomerID','=',$CustomerID)->get()->first();

    $PreviuosBalance=$CustomerBalance->Balance;
    $NewBalance=$PreviuosBalance-$LedgerBalance;
    $CustomerBalance->Balance=$NewBalance;
    $CustomerBalance->save();
    $CustomerLedger->delete();

    return redirect('/Customer/Ledger/'.$CustomerID);

    
  }

  # Delete Balance
  public function destroyBalance($id)
  {
    # code...
  }


  # Load Edit Customer Form
  public function editCustomer($id)
  {
    $ShopList = Shop::all();
    $Customer = Customer::findOrFail($id);

    return view('customer.edit',compact('Customer','ShopList'));
  }

  # Lead Customer Ledger Edit view
  public function editLedger($LedgerID)
  {
    
    $CustomerLedger=CustomerLedger::findOrFail($LedgerID);
    $CustomerID=Customer::where('CustomerID','=',$CustomerLedger->CustomerID)->get()->first();
    $CustomerName=$CustomerID->FirstName." ".$CustomerID->LastName;
    return view('customer.ledger.edit',compact('CustomerLedger','CustomerName'));
  }


  # Edit Customer Balance
  public function editBalance($value='')
  {
    # code...
  }

  # Customer Update
  public function updateCustomer($CustomerID,Request $Data)
  {

    $FormData = $Data->all();
    
    $Customer = Customer::findOrFail($CustomerID);

    $Customer['ShopID']       = $FormData['ShopID'];
    $Customer['FirstName']    = $FormData['FirstName'];
    $Customer['LastName']     = $FormData['LastName'];
    $Customer['Address']      = $FormData['Address'];
    $Customer['City']         = $FormData['City'];
    $Customer['Province']     = $FormData['Province'];
    $Customer['Country']      = $FormData['Country'];
    $Customer['Phone']        = $FormData['Phone'];
    $Customer['Email']        = $FormData['Email'];
    $Customer['DateOfBirth']  = $FormData['DateOfBirth'];
    $Customer['Notes']        = $FormData['Notes'];
    $Customer->Inactive       = $Data->Inactive;

    try {
      $Customer->save();
    } catch (\Exception $e) {
      echo $e->getMessage();
    }   

    return redirect('/Customer/Edit/'.$CustomerID);   
  }

  # Update Ledger
  public function updateLedger(Request $Data, $LedgerID)
  {
    try{

      $CustomerLedger=CustomerLedger::findOrFail($LedgerID);        
      $PreviousBalance=$CustomerLedger->Balance;
      $NewBalance   =$Data->Balance;
      $ChangedBalance=$NewBalance-$PreviousBalance;
      $CustomerLedger->InvoiceID=$Data->InvoiceID;
      $CustomerLedger->Balance=$Data->Balance;
      $CustomerLedger->Debit=$Data->Debit;
      $CustomerLedger->Credit=$Data->Credit;
      //$CustomerLedger->CustomerID=$Data->VendorID;
      $CustomerLedger->save();
      $CustomerID=$CustomerLedger->CustomerID;
      $CustomerBalance=CustomerBalance::where('CustomerID','=',$CustomerID)->get()->first();
      $NewCustomerBalance=$CustomerBalance->Balance+$ChangedBalance;
      $CustomerBalance->Balance=$NewCustomerBalance;
      $CustomerBalance->save();

    }

    catch (\Exception $e) {
      echo $e->getMessage();
    }

    return redirect('/Customer/Ledger/'.$CustomerID);   
    
  }

  # Update Balance 
  public function updateBalance($balance, $id)
  {
    # code...
  }  


  # Check if Customer is already exist by Phone
  public function searchCustomerByPhone($id)  
  {   

      $sh = session()->get('ShopID');
      //$val = $r->search;

      $cust = Customer::where('ShopID','=',$sh)->where('Phone','=',$id)->get();
      $cc = count($cust);
      $result =1;
      if($cc > 0)
      {
        $result =0;
      }
      return $result;       

    //return Response($result);
  }



  public function reset()
  {
    Session::forget('CustomerID');
    Session::forget('CustomerName');
  }

  public function Role()
  {
    echo "<br>I am a middle Man";
  }

  public function CreatePayment($CustomerID)
  {
    $Bank = Bank::all();

    return view ('customer.payment', compact('Bank','CustomerID'));
  }


  public function ajaxPayment($CustomerID,$Amount,$MemoID,$Deposit,$BankID,$ChequeNumber)
  {
           

    if($BankID>0)
    {

      $BankBalance=BankBalance::where('BankID','=',$BankID)->get()->first();
      $BankBalance->Balance=$BankBalance->Balance+$Deposit;
      $BankBalance->save();

      $BankLedger=new BankLedger();
      $BankLedger->BankID=$BankID;
      $BankLedger->ChequeNumber=$ChequeNumber;
      $BankLedger->Deposit=$Deposit;
      $BankLedger->Withdraw=0;
      $BankLedger->Balance=$BankBalance->Balance;
      $BankLedger->save();     

      $Amount=$Amount+$Deposit;
    }


    $CustomerBalance = CustomerBalance::where('CustomerID','=',$CustomerID)->get()->first();
    $Balance = $CustomerBalance->Balance;
    $UpdateBalance = $Balance-$Amount;
    $CustomerBalance->Balance=$UpdateBalance;
    $CustomerBalance->save(); 

    $CustomerLedger = new CustomerLedger();
    $CustomerLedger->CustomerID=$CustomerID;
    $CustomerLedger->Credit= 0;
    $CustomerLedger->Debit = $Amount;
    $CustomerLedger->Balance = $UpdateBalance ;
    $CustomerLedger->InvoiceID=$MemoID;
    $CustomerLedger->save();
    return response("Payment Accepted !");
    
  }

  public function customerBalanceSale($CustomerID)
  {

    $Customer=CustomerBalance::findOrFail($CustomerID)->Balance;
    return $Customer;
  }

  public function listforSales()
  {
    $shid=session()->get('ShopID');
    $shh=session()->get('ShopID');
    $cus=Customer::where('ShopID','=',$shh)->where('Inactive','=',0)->get();
    $json=json_encode($cus);
    return response($json);
  }

  public function checkforSales()
  {
    if(session()->has('CustomerID'))
    {
      $CustomerID=session()->get('CustomerID');
      if($CustomerID>0)
      return response("good");
      if($CustomerID==0)
        return response("bad");
    }
    else
      return response("bad");
  }

  public function getCustomerID()
  {
    if(session()->has('CustomerID'))
    {
      $CustomerID=session()->get('CustomerID');
    }
    else
      $CustomerID=0;
    return response($CustomerID);
  }

   public function listforSalesforNewCustomer()
  {
    $shid=session()->get('ShopID');
    $shh=session()->get('ShopID');
    $cus=Customer::where('ShopID','=',$shh)->where('Inactive','=',0)->get();
    $json=json_encode($cus);
    return response($json);



  }






}
