<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use ClassyPOS\bank\Bank;
use ClassyPOS\bank\BankBalance;
use ClassyPOS\bank\BankLedger;
use ClassyPOS\purchase\PurchaseInvoice;
use ClassyPOS\supplier\Vendor;
use ClassyPOS\supplier\VendorBalance;
use ClassyPOS\supplier\VendorLedger;
use ClassyPOS\user\ActivityLog;


class VendorController extends Controller
{ 
  public function index()
  {
    return view('supplier.index');
  }

  # Load Vendor Create View
  public function createVendor()
  {         
    return view('supplier.new');
  }


  # Load vendor Ledger create view
  public function createLedger()
  {         
    return view('supplier.ledger');
  }


  # Create New Vendor
  public function storeVendor(Request $rq)
  {

    $vendor_new=new Vendor();
    $all=$rq->all();

    // If vendor image is not selected its null
    if($rq->file('VendorImg') == "")
    {
      $imageName = "";
    }
    else
    {
      $imageTempName = $rq->file('VendorImg')->getPathname();
      $imageName     = $rq->file('VendorImg')->getClientOriginalName();
      
      $path          = base_path() . '/public/uploads/image/vendor';
      $rq->file('VendorImg')->move($path , $imageName);
    }  
    
    // listing into an array to insert into vendor table
    $vendor_new->VendorName   = $all['VendorName'];
    $vendor_new->ContactName  = $all['ContactName'];
    $vendor_new->Address      = $all['Address'];
    $vendor_new->City         = $all['City'];
    $vendor_new->Province     = $all['Province'];
    $vendor_new->ZipCode      = $all['ZipCode'];
    $vendor_new['Country']    = $all['Country'];
    $vendor_new['Phone1']     = $all['Phone1'];
    $vendor_new['Phone2']     = $all['Phone2'];
    $vendor_new['Fax']        = $all['Fax'];
    $vendor_new['Email']      = $all['Email'];
    $vendor_new['Website']    = $all['Website'];
    $vendor_new['VendorImg']  = $imageName;

    // Insert into vendor Table
    $vendor_new->save();

    // Acquire vendor_id after inserting
    $venid = $vendor_new['VendorID'];


    // Initialize vendor_balane model
    $venbal = new VendorBalance();

    $venbal->VendorID = $venid;

    $venbal->Balance = 0;

    // Insert into vendor_balance table
    $venbal->save();

    // Inititalize vendor_vendor ledger model
    $venledger = new VendorLedger();

    // Listing into array to insert into vendor_ledger table
    $venledger->VendorID  = $venid;
    $venledger->InvoiceID = 0;
    $venledger->Debit     = 0;
    $venledger->Credit    = 0;       
    $venledger->Balance   = 0;

    // Insert into vendor_ledger table
    $venledger->save();

    $activity=new ActivityLog();
    $activity->UserID=session()->get('UserID');
    $activity->ShopID=session()->get('ShopID');
    $activity->ActivityName="Vendor Added";
    $activity->save();

    return redirect( '/Vendor/List');
  }


  # Store Vendor Ledger
  public function storeLedger(Request $data)
  {
    # code...
  }



  # Vendor List
  public function listVendor()    
  {
    $every=Vendor::where('vendor.VendorID','>',0)
    ->join('vendor_balance','vendor.VendorID','=','vendor_balance.VendorID')
    ->get();
      
    return view('supplier.list',compact('every'));
  }


  # list Vendor Ledger 
  public function listLedger($VendorID)
  {
    $VendorLedger = VendorLedger::where('VendorID','=',$VendorID)->get();
    $Vendor       = Vendor::findOrFail($VendorID);
    // $Balance      = VendorBalance::findOrFail($VendorID);

    return view('supplier.ledger.list',compact('VendorLedger', 'Vendor'));
  }



  # Load Vendor Edit View
  public function editVendor($VendorID)
  {

    $Vendor = Vendor::findOrFail($VendorID);

    return view('supplier.edit',compact('Vendor'));
  }


  # Load Vendor Ledger Edit View
  public function editLedger( $LedgerID)
  {
    
    
    $VendorLedger=VendorLedger::findOrFail($LedgerID);
    $Vendor=Vendor::where('VendorID','=',$VendorLedger->VendorID)->get()->first();
    $VendorName=$Vendor->VendorName;
    return view('supplier.ledger.edit',compact('VendorLedger','VendorName'));
    
  }

  # Load Vendor balance View
  public function editBalance($balance, $id)
  {
    # code...
  }




  # Delete  Vendor
  public function destroyVendor($VendorID)
  {
    
    $identity = Vendor::findOrFail($VendorID);
    $identity->delete();

    $LedgerDelete =VendorLedger:: where('VendorID','=',$VendorID)->delete();
    $BalanceDelete=VendorBalance::where('VendorID','=',$VendorID)->delete();  

    
    $activity=new ActivityLog();
    $activity->UserID=session()->get('UserID');
    $activity->ShopID=session()->get('ShopID');
    $activity->ActivityName="Vendor Deleted";
    $activity->save();
    return redirect('Vendor/List');     
  }

  # Delete Vendor Ledger
  public function destroyLedger($LedgerID)
  {

    $VendorLedger=VendorLedger::findOrFail($LedgerID);
    $LedgerBalance=$VendorLedger->Balance;
    $VendorID=$VendorLedger->VendorID;
    $VendorBalance=VendorBalance::where('VendorID','=',$VendorID)->get()->first();

    $PreviuosBalance=$VendorBalance->Balance;
    $NewBalance=$PreviuosBalance-$LedgerBalance;
    $VendorBalance->Balance=$NewBalance;
    $VendorBalance->save();
    $VendorLedger->delete();

    return redirect('/Vendor/List');

     






    
  }

  # Delete Vendor Balance
  public function destroyBalance($id)
  {
    # code...
  }


  # Update Vendor
  public function updateVendor(Request $Data, $VendorID)
  {      
    $FormData = $Data->all();         

    $Vendor = Vendor::findOrFail($VendorID); 

    // Listing into an array to insert into vendor table       
    $Vendor->VendorName   = $FormData['VendorName'];
    $Vendor->ContactName  = $FormData['ContactName'];
    $Vendor->Address      = $FormData['Address'];
    $Vendor->City         = $FormData['City'];
    $Vendor->Province     = $FormData['Province'];
    $Vendor->ZipCode      = $FormData['ZipCode'];
    $Vendor->Country      = $FormData['Country'];
    $Vendor->Phone1       = $FormData['Phone1'];
    $Vendor->Phone2       = $FormData['Phone2'];
    $Vendor->Email        = $FormData['Email'];
    $Vendor->Website      = $FormData['Website'];

    try {
      // update vendor   
      $Vendor->save();
      $Success = 1;
    } catch (\Exception $e) {
      $Success = 0;
    }
    $activity=new ActivityLog();
    $activity->UserID=session()->get('UserID');
    $activity->ShopID=session()->get('ShopID');
    $activity->ActivityName="Vendor Updated";
    $activity->save();

    return redirect('/Vendor/Edit/'.$VendorID.'?Success='.$Success);
  }

  #Update Vendor Ledger
  public function updateLedger(Request $Data,$LedgerID)
  {

    $VendorLedger=VendorLedger::findOrFail($LedgerID);
        
    $PreviousBalance=$VendorLedger->Balance;
    $NewBalance   =$Data->Balance;
    $ChangedBalance=$NewBalance-$PreviousBalance;
    $VendorLedger->InvoiceID=$Data->InvoiceID;
    $VendorLedger->Balance=$Data->Balance;
    $VendorLedger->Debit=$Data->Debit;
    //$VendorLedger->Credit=$Data->Credit;
    //$VendorLedger->VendorID=$Data->VendorID;
    $VendorLedger->save();

    $VendorID=$VendorLedger->VendorID;
    $VendorBalance=VendorBalance::where('VendorID','=',$VendorID)->get()->first();
    $NewVendorBalance=$VendorBalance->Balance+$ChangedBalance;
    $VendorBalance->Balance=$NewVendorBalance;
    $VendorBalance->save();




    
  }

  # Update vendor balance
  public function updateBalance(Request $data, $id)
  {
    # code...
  }

  # Vendor Details
  public function detailsVendor($VendorID)
  {
    $VendorDetails=Vendor::where('vendor.VendorID','=',$VendorID)
    ->join('vendor_balance','vendor.VendorID','=','vendor_balance.VendorID')->get()->first();

    return view('supplier.details',compact('VendorDetails'));
  }

  # Show balance of a vendor
  public function showBalance()
  {

    $VendorBalance=VendorBalance::where('vendor.VendorID','>',0)
    ->join('vendor','vendor.VendorID','=','vendor_balance.VendorID')
    ->get();
    return view('supplier.balance',compact('VendorBalance'));
  }

  public function listInvoice($VendorID)
  {

    $VendorHistory=PurchaseInvoice::where('purchase_invoice.VendorID','=',$VendorID)
     ->join('vendor','vendor.VendorID','=','purchase_invoice.VendorID')
     ->select('purchase_invoice.PurchaseInvoiceID','purchase_invoice.VendorID','vendor.VendorName','purchase_invoice.created_at','purchase_invoice.TotalPrice','purchase_invoice.MemoID')
     ->get();

    $Vendor = Vendor::findOrFail($VendorID);

    return view('supplier.purchase_history',compact('VendorHistory', 'Vendor'));
  }


  public function showPayment($VendorID)
  {


     $Bank=Bank::all();

    return view('supplier.ledger.new',compact('Bank','VendorID'));

  }



   public function ajaxPayment($VendorID,$Amount,$MemoID,$Withdraw,$BankID,$ChequeNumber)
  {


    if($BankID>0)
    {


      $BankBalance=BankBalance::where('BankID','=',$BankID)->get()->first();
      $OldBanalce=$BankBalance->Balance;
      $UpdatedBalance=$BankBalance->Balance-$Withdraw;

      $BankBalance->Balance=$UpdatedBalance;
      $BankBalance->save();

      $BankLedger=new BankLedger();
      $BankLedger->BankID=$BankID;
      $BankLedger->ChequeNumber=$ChequeNumber;
      $BankLedger->Deposit=0;
      $BankLedger->Withdraw=$Withdraw;
      $BankLedger->Balance=$UpdatedBalance;
      //$BankLedger->Balance=$BankLedger->Balance-$Withdraw;
      $BankLedger->save();
      $Amount=$Amount+$Withdraw;
    }

    $VendorLedger=new VendorLedger();
    $VendorLedger->VendorID=$VendorID;
    $VendorLedger->Credit=(-1)*$Amount;
    $VendorLedger->Debit=0;
    $VendorLedger->Balance=(-1)*$Amount;
    $VendorLedger->InvoiceID=$MemoID;
    $VendorLedger->save();

    $VendorBalance=VendorBalance::where('VendorID','=',$VendorID)->get()->first();
    $Balance=$VendorBalance->Balance;
    $UpdateBalance=$Balance-$Amount;
    $VendorBalance->Balance=$UpdateBalance;
    $VendorBalance->save();    

    return response("Great");
    
  }





   
}
