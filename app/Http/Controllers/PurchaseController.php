<?php

  namespace ClassyPOS\Http\Controllers;

  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Session;
  use Auth;  
  use ClassyPOS\bank\Bank;
  use ClassyPOS\bank\BankBalance;
  use ClassyPOS\bank\BankLedger;
  use ClassyPOS\customer\Customer;
  use ClassyPOS\customer\CustomerBalance;
  use ClassyPOS\customer\CustomerLedger;
  use ClassyPOS\product\Product;
  use ClassyPOS\purchase\PurchaseInvoice;
  use ClassyPOS\purchase\PurchaseInvoiceProductMapping;
  use ClassyPOS\purchase\PurchaseInvoiceProductReturnMapping;
  use ClassyPOS\supplier\Vendor;
  use ClassyPOS\supplier\VendorLedger;
  use ClassyPOS\supplier\VendorBalance;


  use ClassyPOS\Tax\TaxCode;

  use ClassyPOS\user_new;
  use ClassyPOS\invoice;
  
  use ClassyPOS\product\ProductCategory;


  use ClassyPOS\shop\Shop;
  use ClassyPOS\shop\ShopProductMapping;

  use DB;

  


  class PurchaseController extends Controller
  {
    public function index()
    {
      return view('product.purchase.index');
    }

    # Load Product Purchase Create View
    public function Create()
    {
      $VendorList   = Vendor::all();
      $CategoryList = ProductCategory::all();
      $BankList     = Bank::all();  
      $TaxCodeList  = TaxCode::all();    

      return view('product.purchase.new',compact('VendorList','CategoryList','BankList','TaxCodeList'));
    }



    # Store Purchase Products, Bank, Ledger, Etc
    public function Store($id,$id2,$id3,$id4,$id5,$id6,$id7,$id8,$id9,$id10,$id11,$id12)
    {       

      $productid1   = explode(',', $id);
      $quantity1    = explode(',', $id2);
      $unitprice1   = explode(',', $id3);
      $subtotal1    = explode(',', $id4);     

      $productid    = [];
      $quantity     = [];
      $unitprice    = [];
      $subtotal     = [];

      $total        = count($productid1);
      
      $removed1     = [];
      $Totalprice1  = [];

      $tat          = count($productid1);



      for( $i = 0; $i < count( $productid1 ); $i++ )
      {
        if( $productid1[$i] == 0 )
        {
          array_push( $removed1, $i );
        }
      }

      $bb         = count($removed1);
      $productid  = [];
      $j          = 0;

              
      for( $j = 0; $j < $tat; $j++ )
      {
        $k = 0;
     
        for($i = 0; $i < $bb; $i++ )
        {
          if( $removed1[$i] == $j )
          {
            $k = 1;
          }

        }

        if($k == 0)
        {
          array_push($productid,$productid1[$j]);
          array_push($quantity,$quantity1[$j]);
          array_push($unitprice,$unitprice1[$j]);
          array_push($subtotal,$subtotal1[$j]);
        } 
      }

      $vid = $id5;

      $totalprice = $id6;
      $paid       = $id7;
      $due        = $id8;
      $bank       = $id9;
      $debit      = $paid+$bank;
      $memo       = $id10; 

      $tata       = count($productid);


      $inv        = new PurchaseInvoice();

      $inv->VendorID    = $vid;
      $inv->MemoID      = $memo;
      $inv->TotalPrice  = $totalprice;
      $inv->CashPayment = $paid;
      $inv->BankPayment = $bank;
      $inv->Due         = $due;

      $inv->save();



      $invid     =   $inv->PurchaseInvoiceID;


      $purledger =   new VendorLedger();

      $purledger ->VendorID  = $vid;
      $purledger ->InvoiceID = $invid;
      $purledger ->Credit    = $totalprice;
      $purledger ->Debit     = $debit;
      $purledger ->Balance   = $due;

      $purledger  ->save();         
           
      $purbal            =  VendorBalance::where('VendorID','=',$vid)->get()->first();
        
      $purbal ->Balance   = $purbal ->Balance + $due;


      $purbal ->save();    

      for($i = 0; $i<$tata ; $i++)
      {        

        $invpromap = new PurchaseInvoiceProductMapping();
        $invpromap ->PurchaseInvoiceID   =  $invid;
        $invpromap ->ProductID           =  $productid[$i];
        $invpromap ->Qty                 =  $quantity[$i];
        $invpromap ->CostPrice           =  $unitprice[$i];
        $invpromap ->TotalPrice          =  $subtotal[$i];
        $invpromap ->save();
      }  


      if($id11!=0)
      {



        //return "I am Doing Banking";
        $led         = new BankLedger();


        $led->BankID               = $id11;

        $led->ChequeNumber         = $id12;
        $led->RefChequeNumber      = 0;
        $led->RefBank              = "";
        $led->Deposit              = 0;
        $led->Withdraw             = $id9;

        
        $led->TxBy                 = "";
        $led->Notes                = "Purchase Product";

        

        $sss= BankBalance::where('BankID','=',$id11)->get()->first();        

        $sss->Balance=$sss->Balance-$id9;

        $sss->save();   
        
        $purbal ->Balance   = $purbal ->Balance + $due;

        $purbal ->save();

        $led->Balance              = $sss->Balance;

        $led->save();
      }


      for( $i = 0; $i<$tata; $i++ )
      {

        $all=Product::findOrFail($productid[$i]);

        $all->Qty = $all->Qty+$quantity[$i];

        $all->IsPurchased=1;


        $all->save();
      }

    return view('invoice.purchase',compact('productid','quantity','unitprice','subtotal','vid','tata','totalprice','paid','due'));
  }  


  public function ListPurchaseInvoice()
  {
    $PurchaseInvoice = new PurchaseInvoice();

    $List = $PurchaseInvoice->ListPurchaseInvoice();

    return view('product.purchase.list', compact('List'));
  }


  # load Product Purchase Edit View
  public function Edit()
  {
    #Code...    
  }



  #Update Product Purchase and adjust all other things related to it
  public function update()
  {

    # Code...
    
  }

  # Destroy Product Purchase and Adjust all other things related to it
  public function destroy()
  {
    #Code...    
  }

  public function PurchaseReturn()
  {
    $VendorList   = vendor::all();
    $CategoryList = ProductCategory::all();
    $BankList     = Bank::all();
    $TaxCodeList  = TaxCode::all();
    $Shop         = Shop::all();

    return view('product.purchase.return', compact('VendorList', 'CategoryList', 'BankList', 'TaxCodeList','Shop'));

  }

  public function returnStore($InvoiceID,$ShopID,$ProductID,$Quantity,$UnitPrice,$SubTotal,$Reason,$VendorID,$TotalPrice,$Paid,$Due)
  {
      $shopid1      = explode(',', $ShopID);
      $reason1      = explode(',', $Reason);
      $productid1   = explode(',', $ProductID);
      $quantity1    = explode(',', $Quantity);
      $unitprice1   = explode(',', $UnitPrice);
      $subtotal1    = explode(',', $SubTotal);     

      $productid    = [];
      $quantity     = [];
      $unitprice    = [];
      $subtotal     = [];
      $shopid       = [];  
      $reason       = [];  

      $total        = count($productid1);
      
      $removed1     = [];
      $Totalprice1  = [];

      $TotalProducts          = count($productid1);

      for( $i = 0; $i < count( $productid1 ); $i++ )
      {
        if( $productid1[$i] == 0 )
        {
          array_push( $removed1, $i );
        }
      }

      $totalremoved         = count($removed1);
      $productid  = [];
      $j          = 0;
              
      for( $j = 0; $j < $TotalProducts; $j++ )
      {
        $k = 0;
     
        for($i = 0; $i < $totalremoved; $i++ )
        {
          if( $removed1[$i] == $j )
          {
            $k = 1;
          }

        }

        if($k == 0)
        {
          array_push($productid,$productid1[$j]);
          array_push($quantity,$quantity1[$j]);
          array_push($unitprice,$unitprice1[$j]);
          array_push($subtotal,$subtotal1[$j]);
          array_push($shopid,$shopid1[$j]);
          array_push($reason,$reason1[$j]);
        } 
      }

      $TotalIDs=count($productid);

      for($i=0;$i<$TotalIDs;$i++)
      {
        if($shopid[$i]==0)
        {
          $Product=Product::findOrFail($productid[$i]);
          $PrevQuan=$Product->Qty;
          $ReturnQuan=$quantity[$i];
          $CurrentQuan=$PrevQuan-$ReturnQuan;
          $Product->Qty=$CurrentQuan;
          $Product->save();
        }

        if($shopid[$i]>0)
        {
          $Shop=ShopProductMapping::where('ShopID','=',$shopid[$i])->where('ProductID','=',$productid[$i])->get();
          $PrevQuan=$Shop[0]->Qty;
          $ReturnQuan=$quantity[$i];
          $CurrentQuan=$PrevQuan-$ReturnQuan;
          $Shop[0]->Qty=$CurrentQuan;
          $Shop[0]->save();
        }

      }

      $vid = $VendorID;

      $totalprice = $TotalPrice;
      $paid       = $Paid;
      $due        = $Due;     
      $memo       = $InvoiceID;
      $userid     = Auth::user()->id; 
      $shopid     = session()->get('ShopID');
      $tata       = count($productid);

       for($i = 0; $i<$tata ; $i++)
      {        

        $invpromap = new PurchaseInvoiceProductReturnMapping();
        $invpromap ->UserID              =  $userid;
        $invpromap ->ShopID              =  $shopid;
        $invpromap ->InvoiceID           =  $memo;
        $invpromap ->Qty                 =  $quantity[$i];
        $invpromap ->ProductID           =  $productid[$i];
        $invpromap ->Price               =  $unitprice[$i];
        $invpromap ->TotalPrice          =  $subtotal[$i];
        $invpromap ->ReturnReason        =  $reason[$i];
        $invpromap ->save();
      }   


      //$invid     =   $inv->PurchaseInvoiceID;


      $purledger =   new VendorLedger();
      $purledger ->VendorID  = $vid;
      $purledger ->InvoiceID = $memo;
      $purledger ->Credit    = $TotalPrice;
      $purledger ->Debit     = 0;
      $purledger ->Balance   = (-1)*$TotalPrice;
      $purledger  ->save();        
           
      $purbal            =  VendorBalance::where('VendorID','=',$vid)->get()->first();
        
      $purbal ->Balance   = $purbal ->Balance - $TotalPrice;
      $purbal ->save();
      $paid=0;
      $due=$TotalPrice;
    return view('invoice.purchase',compact('productid','quantity','unitprice','subtotal','vid','tata','totalprice','paid','due'));
  }

  public function listReturn()
  {
    $List = DB::select("SELECT 
      purchase_invoice_product_return_mapping.ID,
      purchase_invoice_product_return_mapping.UserID,

      purchase_invoice_product_return_mapping.ShopID,
      shop.ShopName,

      purchase_invoice_product_return_mapping.InvoiceID,

      purchase_invoice_product_return_mapping.ProductID,
      product.ProductName,

      vendor.VendorName,

      purchase_invoice_product_return_mapping.Qty,
      purchase_invoice_product_return_mapping.Price,
      purchase_invoice_product_return_mapping.TotalPrice,
      purchase_invoice_product_return_mapping.ReturnReason,
      purchase_invoice_product_return_mapping.created_at,
      purchase_invoice_product_return_mapping.updated_at

      FROM purchase_invoice_product_return_mapping

      LEFT JOIN shop ON purchase_invoice_product_return_mapping.ShopID = shop.ShopID
      LEFT JOIN product ON purchase_invoice_product_return_mapping.ProductID = product.ProductID
      LEFT JOIN vendor ON product.VendorID = vendor.VendorID
    ");

    return view('product.purchase.return_list', compact('List'));
  }
}
