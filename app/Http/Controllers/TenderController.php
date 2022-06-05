<?php

namespace ClassyPOS\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use ClassyPOS\user\UserNew;
use ClassyPOS\user\ActivityLog;
use ClassyPOS\customer\Customer;
use ClassyPOS\customer\CustomerLedger;
use ClassyPOS\customer\CustomerBalance;
use ClassyPOS\customer\CustomerInvoiceMapping;
use PDF2;
use ClassyPOS\Tax\TaxCode;
use ClassyPOS\shop\Shop;
use ClassyPOS\shop\ShopProductMapping;
use ClassyPOS\sales\Invoice;
use ClassyPOS\sales\Advance;
use ClassyPOS\sales\Orders;
use ClassyPOS\sales\Suborders;
use ClassyPOS\sales\SubOrderProductMapping;
use ClassyPOS\sales\Tables;
use ClassyPOS\sales\InvoiceSettings;
use ClassyPOS\sales\InvoiceProductMapping;
use ClassyPOS\sales\InvoiceProductRefundMapping;
use ClassyPOS\sales\CardTransaction;
use ClassyPOS\sales\PaymentMethod;
use ClassyPOS\product\Product;
use ClassyPOS\purchase_invoice;
use ClassyPOS\vendor_ledger;
use ClassyPOS\vendor_balance;
use ClassyPOS\purchase_invoice_product_mapping;
use ClassyPOS\bank_ledger;
use ClassyPOS\bank_balance;
use ClassyPOS\user\User;
use ClassyPOS\waste\Waste;
use Cookie;


class TenderController extends Controller
{

  //#####Creating the Invoice of the Customer#####


  public function saleInvoiceTest(Request $rq)
  {
    return $rq->all();


  }

  public function singleCard(Request $rq)
  {
    if(Cookie::get('IsServiceCharge')==1)
      {
        $ServicePercentage=Cookie::get('ServiceCharge');
      }
      else
        $ServicePercentage=0;

      $custid =session()->get('CustomerID');

      if($custid==0)
        $CustomerName = " Anonymous";

      if($custid!=0)
      {
        $customer=Customer::findOrFail($custid);
        $CustomerName=$customer->FirstName;
      }

      $CustomerPreviousBalance=0;
      $CustomerCurrentBalance =0;
      $CustomerTotalBalance   =0;
      //return $rq->all();
      
      $AdvanceValue=0;

      if(isset($rq->AdvancePaymentValue))
      {
        $AdvanceValue=$rq->AdvancePaymentValue;
      }   

      $CashAmount=$rq->Paid;
      $SingleCard=1;
      $cus=$custid;

      if($cus!=0)
      {
        $customer=Customer::findOrFail($cus);
        $CustomerName=$customer->FirstName;
      }
      
        
      $vat          =  $rq->OverAllTax;
      $TotalDiscount=  $rq->OverAllDiscount;
      $subtotaltotal=  $rq->OverAllSubTotal;

      $ServiceCharge=$subtotaltotal*$ServicePercentage/100;

      //return $subtotaltotal;

      
      $tt=$subtotaltotal+$vat-$TotalDiscount+$ServiceCharge;
      $subtotalinvoice=$subtotaltotal;


      
      $productid1    = $rq->productid1;

      $ProductName1  = $rq->productname1;
      $Qty1          = $rq->total1;
      $Price1        = $rq->Price1;
      $FinalPrice1   = $rq->final1;
      $shop1         = $rq->Shop1;
      $discount1     = $rq->discount1;
      $tax1          = $rq->taxvalue1;
      $paid          = $rq->CardPaid;      
      $returned      = $rq->Change;


      

      $removed1     =[];
      $TotalPrice1  =[];

     
      $tata=count($productid1);            

      //Removed Products are detected
      $tat=count($productid1);
      for($i=0;$i<count($productid1);$i++)
      {
        if($productid1[$i]==0)
        {
          array_push($removed1,$i);
        }
      }

     $bb=count($removed1);

     $productid=[];
     $tax=      [];
     $shop=     [];
     $ProductName=[];
     $Qty=[];
     $Price=[];
     $FinalPrice=[];
     $discount=[];
     $MethodName=[];
     $j=0;


     //Only the Remaining Products are Stored
    for($j=0;$j<$tat;$j++)
    {
      $k=0;
      for($i=0;$i<$bb;$i++)
      {
        if($removed1[$i]==$j)
        {
          $k=1;
        }
      }

      if($k==0)
      {
        array_push($productid,$productid1[$j]);
        array_push($tax,$tax1[$j]);
        array_push($shop,$shop1[$j]);
        array_push($ProductName,$ProductName1[$j]);
        array_push($Qty,$Qty1[$j]);
        array_push($Price,$Price1[$j]);
        array_push($FinalPrice,$FinalPrice1[$j]);
        array_push($discount,$discount1[$j]);        
      }     

    }





    $CostPrice=[];

    for($i=0;$i<count($productid);$i++)
    {
      $Cost=Product::findOrFail($productid[$i])->CostPrice;
      array_push($CostPrice, $Cost);

    }
    

    

    $ItemQty=count($productid);
    
    $idus= Auth::user()->id;
    $User=UserNew::where('UserID','=',$idus)            
    ->get()
    ->first();
    $username= $User->FirstName;

    //$fad->ShopID=session()->get('ShopID');
    $shopid=session()->get('ShopID');
    $totalproduct=count($productid);
     $Shop=Shop::where('ShopID','=',$shopid)->get()->first();


    //Tendered Products Quantities are Adjusted With the Shop Quantites

    for($i=0;$i<$totalproduct;$i++)
    {

      $Shqty=ShopProductMapping::where('ProductID','=',$productid[$i])->where('ShopID','=',$shop[$i])             
      ->first();
      $CurrentQty=$Shqty->Qty;
      $SoldQty=$Qty[$i];
      $UpdatedQty=$CurrentQty-$SoldQty;            
      $Shqty->Qty=$UpdatedQty;
      $Shqty->save();
    }

    $Shop=Shop::where('ShopID','=',$shopid)->get()->first();
    $username= $User->FirstName;
    $tata=count($productid1);

    //$RawAmount=$rq->SplitPaymentAmount1;
    //$Total= count($RawAmount);
    //$InvoicePaidforSplit=0;

    //for($i=0;$i<$Total;$i++)
    //{
      //$InvoicePaidforSplit=$InvoicePaidforSplit+$RawAmount[$i];
    //}

    //$TotalPaidforSplit=$CashAmount+$InvoicePaidforSplit;

//New Invoice is Created and stored
   $Invoice= new Invoice();
   $Invoice->UserID=$idus;             
   $Invoice->ShopID=$shopid;
   $Invoice->SubTotal=$subtotalinvoice;
   $Invoice->Discount=$rq->OverAllDiscount;
   $Invoice->Total=$tt;
   $Invoice->TaxTotal=$vat;
   $Invoice->ServiceCharge=$ServiceCharge;
   //if(isset($rq->PaymentMethodID))
   $Invoice->PaidMoney=$paid;
   //else
   //$Invoice->PaidMoney=$TotalPaidforSplit;             
   $Invoice->ReturnedMoney=$returned;
   $Invoice->IsPaid=1;
   $Invoice->save();
   $inid=$Invoice->InvoiceID;

             
//Each Product information in the Invoice is stored
  for($i=0;$i<$ItemQty;$i++)
  {
    $invp=  new InvoiceProductMapping();
    $invp->UserID=$idus;
    $invp->ShopID=$shop[$i];
    $invp->InvoiceID=$inid;
    $invp->ProductID=$productid[$i];
    $invp->ProductName=$ProductName[$i];
    $invp->Qty=$Qty[$i];
    $invp->Price=$Price[$i];
    $invp->TotalPrice=$FinalPrice[$i]-$discount[$i]+$tax[$i];
    $invp->Discount=$discount[$i];
    $invp->TaxTotal=$tax[$i];
    $invp->CostPrice=$CostPrice[$i];
    $invp->save();
  }




  

  $rq->PaymentMethodID=1;
  //Option for a Single Card Transaction

  if(isset($rq->PaymentMethodID))
  {
    $SingleCardMethodName=PaymentMethod::findOrFail($rq->PaymentMethodID)->MethodName;


    $card=new CardTransaction();
    $card->CustomerID        = session()->get('CustomerID');
    $card->ShopID            = session()->get('ShopID');
    $card->InvoiceID         = $inid;
    $card->MethodID          = $rq->PaymentMethodID;
    $card->TransactionAmount = $rq->CardPaid;
    $card->CardNumber        = $rq->CardNumber;
    $card->CardHolderName    = $rq->CardName;
    $card->save();
    $InWords = $this->ConvertNumberToWord($tt);
    $TotalMethod=1;
    $MethodName=[];
    $CardAmount=[];
    $MethodName[0]=$SingleCardMethodName;
    $CardAmount[0]=$rq->CardPaid;

      
  }




   

  if($custid!=0)    
   {

    $CusID=$custid;
    $map= new CustomerInvoiceMapping();
    $map->CustomerID=$CusID;
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
    $ledger->CustomerID = $CusID;
    $ledger->InvoiceID  = $inid;
    $ledger->Credit     = $tt;
    $ledger->Debit      = $pa;
    $ledger->Balance    = $bal;

    $ledger->save();

    $custom=CustomerBalance::where('CustomerID','=',$CusID)->get()->first();              
     
    $bav=$custom->Balance;
    $CustomerPreviousBalance=$bav;

    if($returned>=0)
    {
      $bav=$bav;
    }
    else
    {
      $bav=$bav+$bal;
    }

    $CustomerCurrentBalance=$bal;

    //return $CustomerCurrentBalance;    
    $CustomerTotalBalance=$bav;

    $custom->Balance=$bav;
    $custom->save();    

   } 

  
  $InWords = $this->ConvertNumberToWord($tt);
  Session::forget('CustomerID');
  Session::forget('CustomerName');


  //Activity Information is stored
  $activity=new ActivityLog();
  $activity->UserID=session()->get('UserID');
  $activity->ShopID=session()->get('ShopID');
  $activity->ActivityName="Tender";
  $activity->save();
  $InvoiceID=$inid;

  $ProductID=[];
  for($i=0;$i<count($productid);$i++)
  {
    $ProductID[$i]=$productid[$i];
  }
  $ShopFooter=InvoiceSettings::where('ShopID','=',session()->get('ShopID'))->first();
   //return $TotalDiscount;
  $ShopID=[];
  for($i=0;$i<count($shop);$i++)
  {
    $ShopID[$i]=$shop[$i];

  }



              $Author=AuthorName();
              $Currency=CurrencyName();
              $JsonItemQty=json_encode($ItemQty);
              $JsonFinalPrice=json_encode($FinalPrice);
              $JsonPrice=json_encode($Price);
              $JsonProductName=json_encode($ProductName);
              $Jsonproductid=json_encode($productid);
              $JsonQty=json_encode($Qty);
              $Jsondiscount=json_encode($discount);
              $JsonUser=json_encode($User);
              $Jsontt=json_encode($tt);
              $Jsonpaid=json_encode($paid);
              $Jsonreturned=json_encode($returned);
              $JsonShop=json_encode($Shop);
              $JsonCustomerName=json_encode($CustomerName);
              $Jsonvat=json_encode($vat);
              $JsonTotalDiscount=json_encode($TotalDiscount);
              $Jsonsubtotaltotal=json_encode($subtotaltotal);
              $JsonInvoice=json_encode($Invoice);
              $JsonInWords=json_encode($InWords);
              $JsonProductID=json_encode($ProductID);
              $JsonShopFooter=json_encode($ShopFooter);
              $JsonShopID=json_encode($ShopID);
              $JsonAdvanceValue=json_encode($AdvanceValue);
              $JsonCashAmount=json_encode($CashAmount);
              $JsonCustomerPreviousBalance=json_encode($CustomerPreviousBalance);
              $JsonCustomerTotalBalance=json_encode($CustomerTotalBalance);
              $JsonCustomerCurrentBalance=json_encode($CustomerCurrentBalance);
              $JsonAuthor=json_encode($Author);
              $JsonCurrency=json_encode($Currency);
              $JsonMethodName=json_encode($MethodName);             
              $JsonCardAmount=json_encode($CardAmount);             
              $JsonTotalMethod=json_encode($TotalMethod);
              $JsonSingleCard=json_encode($SingleCard);




              return response(['ItemQty'=>$JsonItemQty,'FinalPrice'=>$JsonFinalPrice,'Price'=>$JsonPrice,'ProductName'=>$JsonProductName,'productid'=>$Jsonproductid,'Qty'=>$JsonQty,'discount'=>$Jsondiscount,'User'=>$JsonUser,'tt'=>$Jsontt,'paid'=>$Jsonpaid,'returned'=>$Jsonreturned,'Shop'=>$JsonShop,'CustomerName'=>$JsonCustomerName,'vat'=>$Jsonvat,'TotalDiscount'=>$JsonTotalDiscount,'subtotaltotal'=>$Jsonsubtotaltotal,'Invoice'=>$JsonInvoice,'InWords'=>$JsonInWords,'ProductID'=>$JsonProductID,'ShopFooter'=>$JsonShopFooter,'ShopID'=>$JsonShopID,'AdvanceValue'=>$JsonAdvanceValue,'CashAmount'=>$JsonCashAmount,'CustomerPreviousBalance'=>$JsonCustomerPreviousBalance,'CustomerCurrentBalance'=>$JsonCustomerCurrentBalance,'CustomerTotalBalance'=>$JsonCustomerTotalBalance,'Author'=>$JsonAuthor,'Currency'=>$JsonCurrency,'MethodName'=>$JsonMethodName,'CardAmount'=>$JsonCardAmount,'TotalMethod'=>$JsonTotalMethod,'SingleCard'=>$JsonSingleCard]);



  }





  public function saleInvoice(Request $rq)
  {

      if(Cookie::get('IsServiceCharge')==1)
      {
        $ServicePercentage=Cookie::get('ServiceCharge');
      }
      else
        $ServicePercentage=0;


      $CustomerPreviousBalance=0;
      $CustomerCurrentBalance =0;
      $CustomerTotalBalance   =0;

      $AdvanceValue=0;
      if(isset($rq->AdvancePaymentValue))
      {
        $AdvanceValue=$rq->AdvancePaymentValue;
      }

      $AdvanceIDValue=0;

      if(isset($rq->AdvanceIDValue))
      {
        $AdvanceIDValue=$rq->AdvanceIDValue;        
      }

      //$SingleTax1= $rq->taxvalue1;     
      $productid1= $rq->productid3;
      //return $productid1;
      $ProductName1= $rq->productname3;
      $Qty1= $rq->total3;
      $Price1=$rq->Price3;
      $FinalPrice1=$rq->final3;
      $discount1=$rq->discount3;
      $tax1=$rq->taxvalue3;
      //return $tax1;
      $taxcode1=$rq->tax3;
      //return $taxcode1;   
      $shop1=$rq->Shop3;    
      $vat=$rq->OverAllTax;   
      $paid=$rq->Paid;
      //return $paid;
      $returned=$rq->Change;

      $cus= $rq->customer;
      $overalldiscount=$rq->OverAllDiscount;
    //return $overalldiscount;

     if($cus!=0)
      {
        $customer=Customer::findOrFail($cus);
        $CustomerName=$customer->FirstName;
      }
      else
        $CustomerName = "Annonymous";
      
        $removed1     =[];
        $TotalPrice1  =[];
        $tat=count($productid1);

        for($i=0;$i<count($productid1);$i++)
        {
          if($productid1[$i]==0)
          {
            array_push($removed1,$i);
          }
        }

       $bb=count($removed1);

       $productid=[];
       $tax=      [];
       $shop=     [];
       $ProductName=[];
       $Qty=[];
       $Price=[];
       $FinalPrice=[];
       $discount=[];
       $taxcode=[];

     $j=0;

     $GrossQuan=0;

    for($j=0;$j<$tat;$j++)

    {
      $k=0;
      for($i=0;$i<$bb;$i++)
      {
        if($removed1[$i]==$j)
        {
          $k=1;
        }

      }

      if($k==0)
      {
        array_push($productid,$productid1[$j]);
        array_push($tax,$tax1[$j]*$Qty1[$j]);
        array_push($taxcode,$taxcode1[$j]);
        array_push($shop,$shop1[$j]);
        array_push($ProductName,$ProductName1[$j]);
        array_push($Qty,$Qty1[$j]);
        array_push($Price,$Price1[$j]);
        array_push($FinalPrice,$FinalPrice1[$j]);
        //array_push($discount,$discount1[$j]*$Qty1[$j]);
        array_push($discount,$discount1[$j]);
        $GrossQuan=$GrossQuan+$Qty1[$i];
      }        

    }//End of for loop to store only selectd products


    $ExtraPrice=0;


    if($overalldiscount<0)
    {
      $ExtraPrice=(-1)*$overalldiscount/$GrossQuan;
      $ExtraPrice=number_format((float) $ExtraPrice,3, '.', '');



      for($i=0;$i<count($productid);$i++)
      {
        $Price[$i]=$Price[$i]+$ExtraPrice;
      }

    }   

    $CostPrice=[];

    for($i=0;$i<count($productid);$i++)
    {
      $Cost=Product::findOrFail($productid[$i])->CostPrice;
      array_push($CostPrice, $Cost);

    }

    $TotalDiscount=0;
    for($i=0;$i<count($productid);$i++)
    {
      $TotalDiscount=$TotalDiscount+$discount[$i];

    }


    //return $TotalDiscount;
    $TotalDiscount=$rq->OverAllDiscount;
    //$subtotaltotal=$rq->OverAllSubTotal;
    $subtotaltotal=0;
    for($i=0;$i<count($productid);$i++)
    {
      $subtotaltotal=$subtotaltotal+$Price[$i]*$Qty[$i];
    }
    $ServiceCharge=$subtotaltotal*$ServicePercentage/100;
    if($overalldiscount<0)
    {
      $tt=$subtotaltotal+$vat+$ServiceCharge;
    }

    else
    {
      $tt=$subtotaltotal+$vat-$overalldiscount+$ServiceCharge;
    }
                        //$returned=$paid-$tt;
            //return $tt;           
    $idus= Auth::user()->id;
    $User=UserNew::where('UserID','=',$idus)            
    ->get()
    ->first();
    //$fad->ShopID=session()->get('ShopID');
    $shopid=session()->get('ShopID');
    $totalproduct=count($productid);
    for($i=0;$i<$totalproduct;$i++)
    {

      $Shqty=ShopProductMapping::where('ProductID','=',$productid[$i])->where('ShopID','=',$shop[$i])             
     ->first();
     $CurrentQty=$Shqty->Qty;

     $SoldQty=$Qty[$i];

     $UpdatedQty=$CurrentQty-$SoldQty;            
     $Shqty->Qty=$UpdatedQty;
     $Shqty->save();
    }     

          
    $Shop=Shop::where('ShopID','=',$shopid)->get()->first();
    $username= $User->FirstName;
    $tata=count($productid1);
    $TotalDiscount=0;
    $TotalDiscount=$overalldiscount;            
    //$subtotalinvoice=$subtotaltotal-$overalldiscount;
    $subtotalinvoice=$subtotaltotal;

                              //**********Parcel Options**********//
    if($rq->Order>0)
    {
      $Order=Orders::findOrFail($rq->Order);
      $TableID=$Order->TableID;
      if($TableID==0)
      {
        //Parcel Tender
        if(!isset($rq->invtest))
        {
          $Order->IsInvoiced=1;
          $Order->IsComplete=1;          
          $Order->save();
        }
        if(isset($rq->invtest))
        {
          $Order->IsInvoiced=1;
          $Order->IsComplete=0;
          $Order->save();
          
        }

          $Invoice= new Invoice();
          $Invoice->UserID=$idus;
          $Invoice->ShopID=$shopid;
          $Invoice->SubTotal=$subtotalinvoice;
          $Invoice->Total=$tt;
          $Invoice->ServiceCharge=$ServiceCharge;
          $Invoice->TaxTotal=$vat;
          $Invoice->Discount=$TotalDiscount;
          $Invoice->AdvanceID=$AdvanceIDValue;
          $Invoice->IsPaid=1;
          $Invoice->PaidMoney=$paid;             
          $Invoice->ReturnedMoney=$returned;
          $Invoice->OrderID=$rq->Order;
          $Invoice->save();
          $inid=$Invoice->InvoiceID;  

          $ItemQty=count($productid);          
          for($i=0;$i<$ItemQty;$i++)
          {
            $invp=  new InvoiceProductMapping();
            $invp->UserID=$idus;
            $invp->ShopID=$shop[$i];
            $invp->InvoiceID=$inid;
            $invp->ProductID=$productid[$i];
            $invp->ProductName=$ProductName[$i];
            $invp->Qty=$Qty[$i];
            $invp->Price=$Price[$i]-$ExtraPrice;
            $invp->TotalPrice=$FinalPrice[$i]+$tax[$i]-$discount[$i];
            $invp->Discount=$discount[$i];
            $invp->TaxTotal=$tax[$i];
            $invp->CostPrice=$CostPrice[$i];           
            $invp->save();
          }
          $InWords = $this->ConvertNumberToWord($tt);
          $this->CustomerInformation($cus,$inid,$tt,$paid,$returned);
          $this->saleFinalProcessing($tt);
          $Order=Orders::where('orders.ID','=',$rq->Order)
          ->leftjoin('user','user.UserID','=','orders.StaffID')
          ->select('orders.ID','orders.Guests','orders.created_at','user.FirstName')
          ->first();

          $ProductID=[];
          for($i=0;$i<count($productid);$i++)
          {
            $ProductID[$i]=$productid[$i];
          }
          $ShopFooter=InvoiceSettings::where('ShopID','=',session()->get('ShopID'))->first();
          $ShopID=[];
          for($i=0;$i<count($shop);$i++)
          {
            $ShopID[$i]=$shop[$i];

          }
           
          //$Order=Orders::findOrFail($rq->Order);              
          //$Order->IsInvoiced=1;
          //$Order->save();
          if($overalldiscount<0)
          {
            $TotalDiscount=0;
          }
              $ProductID=[];
              for($i=0;$i<count($productid);$i++)
              {
                $ProductID[$i]=$productid[$i];
              }
              $ItemQty=count($productid);

              $Author=AuthorName();
              $Currency=CurrencyName();
              $JsonItemQty=json_encode($ItemQty);
              $JsonFinalPrice=json_encode($FinalPrice);
              $JsonPrice=json_encode($Price);
              $JsonProductName=json_encode($ProductName);
              $Jsonproductid=json_encode($productid);
              $JsonQty=json_encode($Qty);
              $Jsondiscount=json_encode($discount);
              $JsonUser=json_encode($User);
              $Jsontt=json_encode($tt);
              $Jsonpaid=json_encode($paid);
              $Jsonreturned=json_encode($returned);
              $JsonShop=json_encode($Shop);
              $JsonCustomerName=json_encode($CustomerName);
              $Jsonvat=json_encode($vat);
              $JsonTotalDiscount=json_encode($TotalDiscount);
              $Jsonsubtotaltotal=json_encode($subtotaltotal);
              $JsonInvoice=json_encode($Invoice);
              $JsonInWords=json_encode($InWords);
              $JsonProductID=json_encode($ProductID);
              $JsonShopFooter=json_encode($ShopFooter);
              $JsonShopID=json_encode($ShopID);
              $JsonAdvanceValue=json_encode($AdvanceValue);
              //$JsonCashAmount=json_encode($CashAmount);
              $JsonCustomerPreviousBalance=json_encode($CustomerPreviousBalance);
              $JsonCustomerTotalBalance=json_encode($CustomerTotalBalance);
              $JsonCustomerCurrentBalance=json_encode($CustomerCurrentBalance);
              $JsonAuthor=json_encode($Author);
              $JsonCurrency=json_encode($Currency);
              $JsonOrder=json_encode($Order);
                          

              return response(['ItemQty'=>$JsonItemQty,'FinalPrice'=>$JsonFinalPrice,'Price'=>$JsonPrice,'ProductName'=>$JsonProductName,'productid'=>$Jsonproductid,'Qty'=>$JsonQty,'discount'=>$Jsondiscount,'User'=>$JsonUser,'tt'=>$Jsontt,'paid'=>$Jsonpaid,'returned'=>$Jsonreturned,'Shop'=>$JsonShop,'CustomerName'=>$JsonCustomerName,'vat'=>$Jsonvat,'TotalDiscount'=>$JsonTotalDiscount,'subtotaltotal'=>$Jsonsubtotaltotal,'Invoice'=>$JsonInvoice,'InWords'=>$JsonInWords,'ProductID'=>$JsonProductID,'ShopFooter'=>$JsonShopFooter,'ShopID'=>$JsonShopID,'AdvanceValue'=>$JsonAdvanceValue,'CustomerPreviousBalance'=>$JsonCustomerPreviousBalance,'CustomerCurrentBalance'=>$JsonCustomerCurrentBalance,'CustomerTotalBalance'=>$JsonCustomerTotalBalance,'Author'=>$JsonAuthor,'Currency'=>$JsonCurrency,'Order'=>$JsonOrder]);

          //return "I am Fazil";


          //return view('invoice.sales',compact('ItemQty','FinalPrice','Price','ProductName','productid','Qty','discount','User','tt','paid','returned','Shop','CustomerName','vat','TotalDiscount','subtotaltotal','Invoice','InWords','ProductID','ShopFooter','ShopID','Order','AdvanceValue','CustomerPreviousBalance','CustomerCurrentBalance','CustomerTotalBalance'));
          }  

        }
                                   //**********End of Parcel Option**********// 


            //return $subtotaltotal;

            //return $rq->InvoiceCheck; 


             //Condition where an Invoice is Loaded
             if($rq->InvoiceCheck>0)
             {
              //$ShopID=session()->get('ShopID');
              for($i=0;$i<count($productid);$i++)
              {
                $ProductID[$i]=$productid[$i];
              }

              $ShopFooter=InvoiceSettings::where('ShopID','=',session()->get('ShopID'))->first();

              $ShopID=[];
              for($i=0;$i<count($shop);$i++)
              {
                $ShopID[$i]=$shop[$i];

              }
              $InWords = $this->ConvertNumberToWord($tt);
              
              $Invoice=Invoice::findOrFail($rq->InvoiceCheck);

              $OrderID=$Invoice->OrderID;
              //return $Invoice;

              $OrderIDfirst=$Invoice->OrderID;
              // invoice is gettting updated,invoice button is pressed
              if(isset($rq->invtest))
                {
                  //010=2;
                  $Invoice->IsPaid=0;
                  $Invoice->UserID=$idus;
                  $Invoice->ShopID=$shopid;
                  $Invoice->SubTotal=$subtotalinvoice;
                  $Invoice->Total=$tt;
                  $Invoice->TaxTotal=$vat;
                  $Invoice->Discount=$TotalDiscount;
                  InvoiceProductMapping::where('InvoiceID','=',$rq->InvoiceCheck)->delete();


                  


                  for($i=0;$i<count($productid);$i++)
                  {
                    $MappingInvoice=new InvoiceProductMapping();
                    $MappingInvoice->UserID=$idus;
                    $MappingInvoice->ShopID=$shop[$i];
                    $MappingInvoice->InvoiceID=$rq->InvoiceCheck;
                    $MappingInvoice->ProductID=$productid[$i];
                    $MappingInvoice->ProductName=$ProductName[$i];
                    $MappingInvoice->Qty=$Qty[$i];
                    $MappingInvoice->Price=$Price[$i]-$ExtraPrice;
                    $MappingInvoice->TotalPrice=$FinalPrice[$i]+$tax[$i]-$discount[$i];
                    $MappingInvoice->CostPrice=$CostPrice[$i];
                    $MappingInvoice->Discount=$discount[$i];
                    $MappingInvoice->TaxTotal=$tax[$i];           
                    $MappingInvoice->save();                    
                  }
                  $Invoice->save();
                  $inid=$rq->InvoiceCheck;                
                  
                }

                //Tender Button is Pressed with Invoice Load
                else
                {


                  //return "We Are trying to tender an Invoice";

                  //return "This is Fahad";
                  //011=3;
                  $Invoice->IsPaid=1;
                  $Invoice->UserID=$idus;
                  $Invoice->ShopID=$shopid;
                  $Invoice->SubTotal=$subtotalinvoice;
                  $Invoice->Total=$tt;
                  $Invoice->TaxTotal=$vat;
                  $Invoice->Discount=$TotalDiscount;
                  $Invoice->PaidMoney=$paid;             
                  $Invoice->ReturnedMoney=$returned;

                  InvoiceProductMapping::where('InvoiceID','=',$rq->InvoiceCheck)->delete();

                  for($i=0;$i<count($productid);$i++)
                  {
                    $MappingInvoice=new InvoiceProductMapping();
                    $MappingInvoice->UserID=$idus;
                    $MappingInvoice->ShopID=$shop[$i];
                    $MappingInvoice->InvoiceID=$rq->InvoiceCheck;
                    $MappingInvoice->ProductID=$productid[$i];
                    $MappingInvoice->ProductName=$ProductName[$i];
                    $MappingInvoice->Qty=$Qty[$i];
                    $MappingInvoice->Price=$Price[$i]-$ExtraPrice;
                    $MappingInvoice->TotalPrice=$FinalPrice[$i]+$tax[$i]-$discount[$i];
                    $MappingInvoice->Discount=$discount[$i];
                    $MappingInvoice->TaxTotal=$tax[$i];
                    $MappingInvoice->CostPrice=$CostPrice[$i];           
                    $MappingInvoice->save();                    
                  }

                  $OrderID=$Invoice->OrderID;


                  if($OrderID>0)
                  {
                    $TableIDforOrder=Orders::findOrFail($OrderID)->TableID;
                    $OrderTender=Orders::findOrFail($OrderID);
                    $OrderTender->IsComplete=1;
                    $OrderTender->save();
                    $Cou=Tables::findOrFail($TableIDforOrder);
                    $Cou->IsBooked=0;
                    $Cou->InvoiceID=0;
                    $Cou->OrderID=0;
                    $Cou->save();

                  }
                  $Invoice->save();
                  $inid=$rq->InvoiceCheck;

                }//Tender button with invoice load end

                $Order=Orders::where('orders.ID','=',$OrderID)
                ->leftjoin('tables','orders.TableID','=','tables.ID')
                ->leftjoin('user','user.UserID','=','orders.StaffID')
                ->select('orders.ID','orders.Guests','orders.created_at','tables.Name','user.FirstName')
                ->first();

                //return $Order;

              if($overalldiscount<0)
              {
                $TotalDiscount=0;
              }

              $Author=AuthorName();
              $Currency=CurrencyName();
              $ProductID=[];
              for($i=0;$i<count($productid);$i++)
              {
                $ProductID[$i]=$productid[$i];
              }
              $ItemQty=count($productid);


              $JsonItemQty=json_encode($ItemQty);

              $JsonFinalPrice=json_encode($FinalPrice);
              $JsonPrice=json_encode($Price);
              $JsonProductName=json_encode($ProductName);
              $Jsonproductid=json_encode($productid);


              $JsonQty=json_encode($Qty);
              $Jsondiscount=json_encode($discount);
              $JsonUser=json_encode($User);
              $Jsontt=json_encode($tt);
              $Jsonpaid=json_encode($paid);
              $Jsonreturned=json_encode($returned);
              $JsonShop=json_encode($Shop);
              $JsonCustomerName=json_encode($CustomerName);
              $Jsonvat=json_encode($vat);
              $JsonTotalDiscount=json_encode($TotalDiscount);
              $Jsonsubtotaltotal=json_encode($subtotaltotal);
              $JsonInvoice=json_encode($Invoice);
              

              
              $JsonInWords=json_encode($InWords);
              $JsonProductID=json_encode($ProductID);
              
              $JsonShopFooter=json_encode($ShopFooter);
              $JsonShopID=json_encode($ShopID);
              $JsonAdvanceValue=json_encode($AdvanceValue);

              //$JsonCashAmount=json_encode($CashAmount);
              $JsonCustomerPreviousBalance=json_encode($CustomerPreviousBalance);
              $JsonCustomerTotalBalance=json_encode($CustomerTotalBalance);
              $JsonCustomerCurrentBalance=json_encode($CustomerCurrentBalance);
              $JsonAuthor=json_encode($Author);
              $JsonCurrency=json_encode($Currency);
              $JsonOrder=json_encode($Order);


              return response(['ItemQty'=>$JsonItemQty,'FinalPrice'=>$JsonFinalPrice,'Price'=>$JsonPrice,'ProductName'=>$JsonProductName,'productid'=>$Jsonproductid,'Qty'=>$JsonQty,'discount'=>$Jsondiscount,'User'=>$JsonUser,'tt'=>$Jsontt,'paid'=>$Jsonpaid,'returned'=>$Jsonreturned,'Shop'=>$JsonShop,'CustomerName'=>$JsonCustomerName,'vat'=>$Jsonvat,'TotalDiscount'=>$JsonTotalDiscount,'subtotaltotal'=>$Jsonsubtotaltotal,'Invoice'=>$JsonInvoice,'InWords'=>$JsonInWords,'ProductID'=>$JsonProductID,'ShopFooter'=>$JsonShopFooter,'ShopID'=>$JsonShopID,'AdvanceValue'=>$JsonAdvanceValue,'CustomerPreviousBalance'=>$JsonCustomerPreviousBalance,'CustomerCurrentBalance'=>$JsonCustomerCurrentBalance,'CustomerTotalBalance'=>$JsonCustomerTotalBalance,'Author'=>$JsonAuthor,'Currency'=>$JsonCurrency,'Order'=>$JsonOrder]);


                //return view('invoice.sales',compact('ItemQty','FinalPrice','Price','ProductName','productid','Qty','discount','User','tt','paid','returned','Shop','CustomerName','vat','TotalDiscount','subtotaltotal','Invoice','InWords','ProductID','ShopFooter','ShopID','Order','AdvanceValue','CustomerPreviousBalance','CustomerCurrentBalance','CustomerTotalBalance'));
                 

             }//End of Invoice Load//

            //Condition for New Invoice
            //Here Invoice is not Loaded to Cart 
             else
             {


                $Invoice= new Invoice();
                $Invoice->UserID=$idus;
                $Invoice->ShopID=$shopid;
                $Invoice->SubTotal=$subtotalinvoice;
                $Invoice->Total=$tt;
                $Invoice->ServiceCharge=$ServiceCharge;
                $Invoice->TaxTotal=$vat;
                $Invoice->Discount=$TotalDiscount;
                $Invoice->AdvanceID=$AdvanceIDValue;  
                

                               
                if($rq->Order>0)
                {
                  //101=5,100=4;
                  //Tender Button is Pressed
                  if(!isset($rq->invtest))
                  {
                    //Order is Loaded and Directly Tendered
                    $Invoice->IsPaid=1;
                    $Invoice->PaidMoney=$paid;             
                    $Invoice->ReturnedMoney=$returned;
                    $TableIDforOrder=Orders::findOrFail($rq->Order)->TableID;
                    $ReleaseTable=Tables::where('ID','=',$TableIDforOrder)->get();
                    $ReleaseTable[0]->IsBooked=0;
                    $ReleaseTable[0]->OrderID=0;
                    $ReleaseTable[0]->save();
                    $DirectOrderTender=Orders::findOrFail($rq->Order);
                    $DirectOrderTender->IsComplete=1;
                    $DirectOrderTender->IsInvoiced=1;
                    $DirectOrderTender->save();
                    //return "Tender button is pressed for order to payment";
                  }
                  else
                  {
                    //Order is Loaded and Invoiced
                    $Invoice->IsPaid=0;
                    $Invoice->PaidMoney=0;             
                    $Invoice->ReturnedMoney=0;
                    $OrderInvoice=Orders::findOrFail($rq->Order);
                    $OrderInvoice->IsInvoiced=1;
                    $OrderInvoice->save();
                    $TableforInvoice=Tables::where('OrderID','=',$rq->Order)->get()->first();
                  }

                  $Invoice->OrderID=$rq->Order;
                  $Invoice->save();
                  $inid=$Invoice->InvoiceID;                                 
                }//Order Loading Completed

                //Normal Tender is Done here
                //No Order is Loaded Here, No Invoice Is Loaded Here
                else
                {

                    //Invoice is Directly Printed from Cart through Invoice button
                    if(isset($rq->invtest))
                    {
                      //000=0;
                      $Invoice->IsPaid=0;
                    }
                    else
                    {
                      //001=1;
                      $Invoice->IsPaid=1;

                      if($AdvanceIDValue>0)
                      {

                        $Invoice->AdvanceID=$AdvanceIDValue;
                        $AdvanceUpdate=Advance::findOrFail($AdvanceIDValue);
                        $AdvanceUpdate->IsSold=1;
                        $AdvanceUpdate->save();

                      }
                      //$Invoice->PaidMoney=$paid;

                    }

                    $Invoice->PaidMoney=$paid;
                    //return $rq->returned;             
                    $Invoice->ReturnedMoney=$rq->Change;                  
                    $Invoice->OrderID=0;
                    $Invoice->save();
                    $inid=$Invoice->InvoiceID;               

                }
                


                if($rq->Order>0 && isset($rq->invtest))
                {
                  $TableforInvoice=Tables::where('OrderID','=',$rq->Order)->get()->first();
                  $TableforInvoice->InvoiceID=$inid;
                  $TableforInvoice->save();
                }




                

                             //IF The Customer is Registered
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

                   $CustomerPreviousBalance=$bav;

                   if($returned>=0)
                   {
                     $bav=$bav;
                   }                 

                  else
                  {
                   $bav=$bav+$bal;
                  }

                  $CustomerCurrentBalance=$bal;
                  $CustomerTotalBalance=$bav;



                  $custom->Balance=$bav;              
                  $custom->save();

               }


               $ItemQty=count($productid);
               for($i=0;$i<$ItemQty;$i++)
               {

                 $invp=  new InvoiceProductMapping();
                 $invp->UserID=$idus;
                 $invp->ShopID=$shop[$i];
                 $invp->InvoiceID=$inid;
                 $invp->ProductID=$productid[$i];
                 $invp->ProductName=$ProductName[$i];
                 $invp->Qty=$Qty[$i];
                 $invp->Price=$Price[$i]-$ExtraPrice;
                 $invp->TotalPrice=$FinalPrice[$i]+$tax[$i]-$discount[$i];
                 $invp->Discount=$discount[$i];
                 $invp->TaxTotal=$tax[$i];
                 $invp->CostPrice=$CostPrice[$i];           
                 $invp->save();

               }

            }//End of Option Where Data is not loaded from Invoice ID


           $ItemQty=count($productid);
           $InWords = $this->ConvertNumberToWord($tt);
           Session::forget('CustomerID');
           Session::forget('CustomerName');
           $activity=new ActivityLog();
           $activity->UserID=session()->get('UserID');
           $activity->ShopID=session()->get('ShopID');
           $activity->ActivityName="Tender";
           $activity->save();
           $InvoiceID=$inid;

           $ProductID=[];

           for($i=0;$i<count($productid);$i++)
           {
            $ProductID[$i]=$productid[$i];
           }

           $ShopFooter=InvoiceSettings::where('ShopID','=',session()->get('ShopID'))->first();
           
           $ShopID=[];
           for($i=0;$i<count($shop);$i++)
           {
            $ShopID[$i]=$shop[$i];

           }

           //Condition where data is loaded from OrderList

           if(isset($rq->Order))
            {
              if($rq->Order>0)
              {
                $OrderUpdate=Orders::findOrFail($rq->Order);
                $OrderUpdate->IsInvoiced=1;
                $OrderUpdate->save();       
                
              }
              
              
            }

           if(isset($rq->Order))
            {
              if($rq->Order>0)
              {
                $Order=Orders::where('orders.ID','=',$rq->Order)
                ->leftjoin('tables','orders.TableID','=','tables.ID')
                ->leftjoin('user','user.UserID','=','orders.StaffID')
                ->select('orders.ID','orders.Guests','orders.created_at','tables.Name','user.FirstName')
                ->first();
                //$Order=Orders::findOrFail($rq->Order);              
                //$Order->IsInvoiced=1;
                //$Order->save();
                if($overalldiscount<0)
                {
                  $TotalDiscount=0;
                }

                //return "I am Shoaib Akhtar";

              $Author=AuthorName();
              $Currency=CurrencyName();

              $JsonItemQty=json_encode($ItemQty);
              $JsonFinalPrice=json_encode($FinalPrice);
              $JsonPrice=json_encode($Price);
              $JsonProductName=json_encode($ProductName);
              $Jsonproductid=json_encode($productid);
              $JsonQty=json_encode($Qty);
              $Jsondiscount=json_encode($discount);
              $JsonUser=json_encode($User);
              $Jsontt=json_encode($tt);
              $Jsonpaid=json_encode($paid);
              $Jsonreturned=json_encode($returned);
              $JsonShop=json_encode($Shop);
              $JsonCustomerName=json_encode($CustomerName);
              $Jsonvat=json_encode($vat);
              $JsonTotalDiscount=json_encode($TotalDiscount);
              $Jsonsubtotaltotal=json_encode($subtotaltotal);
              $JsonInvoice=json_encode($Invoice);
              $JsonInWords=json_encode($InWords);
              $JsonProductID=json_encode($ProductID);
              $JsonShopFooter=json_encode($ShopFooter);
              $JsonShopID=json_encode($ShopID);
              $JsonAdvanceValue=json_encode($AdvanceValue);
              //$JsonCashAmount=json_encode($CashAmount);
              $JsonCustomerPreviousBalance=json_encode($CustomerPreviousBalance);
              $JsonCustomerTotalBalance=json_encode($CustomerTotalBalance);
              $JsonCustomerCurrentBalance=json_encode($CustomerCurrentBalance);
              $JsonAuthor=json_encode($Author);
              $JsonCurrency=json_encode($Currency);
              $JsonOrder=json_encode($Order);
              //return response("I am Jakaria Khan");


              

              return response(['ItemQty'=>$JsonItemQty,'FinalPrice'=>$JsonFinalPrice,'Price'=>$JsonPrice,'ProductName'=>$JsonProductName,'productid'=>$Jsonproductid,'Qty'=>$JsonQty,'discount'=>$Jsondiscount,'User'=>$JsonUser,'tt'=>$Jsontt,'paid'=>$Jsonpaid,'returned'=>$Jsonreturned,'Shop'=>$JsonShop,'CustomerName'=>$JsonCustomerName,'vat'=>$Jsonvat,'TotalDiscount'=>$JsonTotalDiscount,'subtotaltotal'=>$Jsonsubtotaltotal,'Invoice'=>$JsonInvoice,'InWords'=>$JsonInWords,'ProductID'=>$JsonProductID,'ShopFooter'=>$JsonShopFooter,'ShopID'=>$JsonShopID,'AdvanceValue'=>$JsonAdvanceValue,'CustomerPreviousBalance'=>$JsonCustomerPreviousBalance,'CustomerCurrentBalance'=>$JsonCustomerCurrentBalance,'CustomerTotalBalance'=>$JsonCustomerTotalBalance,'Author'=>$JsonAuthor,'Currency'=>$JsonCurrency,'Order'=>$JsonOrder]);


                //return view('invoice.sales',compact('ItemQty','FinalPrice','Price','ProductName','productid','Qty','discount','User','tt','paid','returned','Shop','CustomerName','vat','TotalDiscount','subtotaltotal','Invoice','InWords','ProductID','ShopFooter','ShopID','Order','AdvanceValue','CustomerPreviousBalance','CustomerCurrentBalance','CustomerTotalBalance'));
              }
              
              
            }


            //Condition Where Data is Loaded from Invoice List

            if(isset($rq->InvoiceCheck))
            {

              if($rq->InvoiceCheck>0)
              {
                $Order=Orders::where('orders.ID','=',$OrderID)
                ->leftjoin('tables','orders.TableID','=','tables.ID')
                ->leftjoin('user','user.UserID','=','orders.StaffID')
                ->select('orders.ID','orders.Guests','orders.created_at','tables.Name','user.FirstName')
                ->first();

                  if($overalldiscount<0)
                  {
                    $TotalDiscount=0;
                  }

                return view('invoice.sales',compact('ItemQty','FinalPrice','Price','ProductName','productid','Qty','discount','User','tt','paid','returned','Shop','CustomerName','vat','TotalDiscount','subtotaltotal','Invoice','InWords','ProductID','ShopFooter','ShopID','Order','AdvanceValue','CustomerPreviousBalance','CustomerCurrentBalance','CustomerTotalBalance'));
              }
              
            }

            
              $CashAmount=$tt-$AdvanceValue;

              if($overalldiscount<0)
              {
                $TotalDiscount=0;
              }

              $Order=Orders::where('orders.ID','=',0)
                ->leftjoin('tables','orders.TableID','=','tables.ID')
                ->leftjoin('user','user.UserID','=','orders.StaffID')
                ->select('orders.ID','orders.Guests','orders.created_at','tables.Name','user.FirstName')
                ->first();

              $Author=AuthorName();
              $Currency=CurrencyName();

              $JsonItemQty=json_encode($ItemQty);
              $JsonFinalPrice=json_encode($FinalPrice);
              $JsonPrice=json_encode($Price);
              $JsonProductName=json_encode($ProductName);
              $Jsonproductid=json_encode($productid);
              $JsonQty=json_encode($Qty);
              $Jsondiscount=json_encode($discount);
              $JsonUser=json_encode($User);
              $Jsontt=json_encode($tt);
              $Jsonpaid=json_encode($paid);
              $Jsonreturned=json_encode($returned);
              $JsonShop=json_encode($Shop);
              $JsonCustomerName=json_encode($CustomerName);
              $Jsonvat=json_encode($vat);
              $JsonTotalDiscount=json_encode($TotalDiscount);
              $Jsonsubtotaltotal=json_encode($subtotaltotal);
              $JsonInvoice=json_encode($Invoice);
              $JsonInWords=json_encode($InWords);
              $JsonProductID=json_encode($ProductID);
              $JsonShopFooter=json_encode($ShopFooter);
              $JsonShopID=json_encode($ShopID);
              $JsonAdvanceValue=json_encode($AdvanceValue);
              $JsonCashAmount=json_encode($CashAmount);
              $JsonCustomerPreviousBalance=json_encode($CustomerPreviousBalance);
              $JsonCustomerTotalBalance=json_encode($CustomerTotalBalance);
              $JsonCustomerCurrentBalance=json_encode($CustomerCurrentBalance);
              $JsonAuthor=json_encode($Author);
              $JsonCurrency=json_encode($Currency);
              $JsonOrder=json_encode($Order);

              

              return response(['ItemQty'=>$JsonItemQty,'FinalPrice'=>$JsonFinalPrice,'Price'=>$JsonPrice,'ProductName'=>$JsonProductName,'productid'=>$Jsonproductid,'Qty'=>$JsonQty,'discount'=>$Jsondiscount,'User'=>$JsonUser,'tt'=>$Jsontt,'paid'=>$Jsonpaid,'returned'=>$Jsonreturned,'Shop'=>$JsonShop,'CustomerName'=>$JsonCustomerName,'vat'=>$Jsonvat,'TotalDiscount'=>$JsonTotalDiscount,'subtotaltotal'=>$Jsonsubtotaltotal,'Invoice'=>$JsonInvoice,'InWords'=>$JsonInWords,'ProductID'=>$JsonProductID,'ShopFooter'=>$JsonShopFooter,'ShopID'=>$JsonShopID,'AdvanceValue'=>$JsonAdvanceValue,'CashAmount'=>$JsonCashAmount,'CustomerPreviousBalance'=>$JsonCustomerPreviousBalance,'CustomerCurrentBalance'=>$JsonCustomerCurrentBalance,'CustomerTotalBalance'=>$JsonCustomerTotalBalance,'Author'=>$JsonAuthor,'Currency'=>$JsonCurrency,'Order'=>$JsonOrder]);
            
              //return view('invoice.sales',compact('ItemQty','FinalPrice','Price','ProductName','productid','Qty','discount','User','tt','paid','returned','Shop','CustomerName','vat','TotalDiscount','subtotaltotal','Invoice','InWords','ProductID','ShopFooter','ShopID','AdvanceValue','CashAmount','CustomerPreviousBalance','CustomerCurrentBalance','CustomerTotalBalance'));
           

           //return $TotalDiscount;
                    

  }  


  
    



public function storeSplitPayment(Request $rq)

{

      if(Cookie::get('IsServiceCharge')==1)
      {
        $ServicePercentage=Cookie::get('ServiceCharge');
      }
      else
        $ServicePercentage=0;


      $custid =session()->get('CustomerID');

      if($custid==0)
        $CustomerName = " Anonymous";

      if($custid!=0)
      {
        $customer=Customer::findOrFail($custid);

        $CustomerName=$customer->FirstName;
      }

      $CustomerPreviousBalance=0;
      $CustomerCurrentBalance =0;
      $CustomerTotalBalance   =0;
      //return $rq->all();
      
      $AdvanceValue=0;

      if(isset($rq->AdvancePaymentValueSplit))
      {
        $AdvanceValue=$rq->AdvancePaymentValueSplit;
      }

      //return $AdvanceValue;
      //$AdvanceValue=$rq->AdvancePaymentForCard;

    

            
      /*if(session()->has('CustomerID'))
      {
        //return "Customer is not Selected";
        $custname = session()->get('CustomerName');
        $CustomerName=$custname;
        $custid   = session()->get('CustomerID');
      }
      return $custid;*/
      //return $custname;


      $CashAmount=$rq->CashPaid;
      $SingleCard=$rq->SingleCard;

          
      //$cus=session()->get('CustomerID');
      //return $cus;
      $cus=$rq->CustomerCard;
      $Split=1;
      if(isset($rq->PaymentMethodID))
        $Split=0;

      else
        $Split=1;

      //session()->put('CustomerID',$cus);

      if($cus!=0)
      {
        $customer=Customer::findOrFail($cus);
        $CustomerName=$customer->FirstName;
      }
      
        
      $vat          =  $rq->OverAllTaxSplit;
      $TotalDiscount=  $rq->OverAllDiscountSplit;
      $subtotaltotal=  $rq->OverAllSubTotalSplit;

      $ServiceCharge=$subtotaltotal*$ServicePercentage/100;

      //return $subtotaltotal;

      
      $tt=$subtotaltotal+$vat-$TotalDiscount+$ServiceCharge;
      $subtotalinvoice=$subtotaltotal;


      
      $productid1    = $rq->productid2;
      $ProductName1  = $rq->productname2;
      $Qty1          = $rq->total2;
      $Price1        = $rq->Price2;
      $FinalPrice1   = $rq->final2;
      $shop1         = $rq->Shop2;
      $discount1     = $rq->discount2;
      $tax1          = $rq->taxvalue1;
      $paid          = $rq->CashPaid;      
      $returned      = $rq->CashChange;

      $removed1     =[];
      $TotalPrice1  =[];

     
      $tata=count($productid1);            

      //Removed Products are detected
      $tat=count($productid1);
      for($i=0;$i<count($productid1);$i++)
      {
        if($productid1[$i]==0)
        {
          array_push($removed1,$i);
        }
      }

     $bb=count($removed1);

     $productid=[];
     $tax=      [];
     $shop=     [];
     $ProductName=[];
     $Qty=[];
     $Price=[];
     $FinalPrice=[];
     $discount=[];
     $MethodName=[];
     $j=0;


     //Only the Remaining Products are Stored
    for($j=0;$j<$tat;$j++)
    {
      $k=0;
      for($i=0;$i<$bb;$i++)
      {
        if($removed1[$i]==$j)
        {
          $k=1;
        }
      }

      if($k==0)
      {
        array_push($productid,$productid1[$j]);
        array_push($tax,$tax1[$j]);
        array_push($shop,$shop1[$j]);
        array_push($ProductName,$ProductName1[$j]);
        array_push($Qty,$Qty1[$j]);
        array_push($Price,$Price1[$j]);
        array_push($FinalPrice,$FinalPrice1[$j]);
        array_push($discount,$discount1[$j]);        
      }     

    }



    $CostPrice=[];

    for($i=0;$i<count($productid);$i++)
    {
      $Cost=Product::findOrFail($productid[$i])->CostPrice;
      array_push($CostPrice, $Cost);

    }
    

    

    $ItemQty=count($productid);
    
    $idus= Auth::user()->id;
    $User=UserNew::where('UserID','=',$idus)            
    ->get()
    ->first();
    $username= $User->FirstName;

    //$fad->ShopID=session()->get('ShopID');
    $shopid=session()->get('ShopID');
    $totalproduct=count($productid);
     $Shop=Shop::where('ShopID','=',$shopid)->get()->first();


    //Tendered Products Quantities are Adjusted With the Shop Quantites

    for($i=0;$i<$totalproduct;$i++)
    {

      $Shqty=ShopProductMapping::where('ProductID','=',$productid[$i])->where('ShopID','=',$shop[$i])             
      ->first();
      $CurrentQty=$Shqty->Qty;
      $SoldQty=$Qty[$i];
      $UpdatedQty=$CurrentQty-$SoldQty;            
      $Shqty->Qty=$UpdatedQty;
      $Shqty->save();
    }

    $Shop=Shop::where('ShopID','=',$shopid)->get()->first();
    $username= $User->FirstName;
    $tata=count($productid1);  
    $RawAmount=$rq->SplitPaymentAmount1;
    $Total= count($RawAmount);
    $InvoicePaidforSplit=0;

    for($i=0;$i<$Total;$i++)
    {
      $InvoicePaidforSplit=$InvoicePaidforSplit+$RawAmount[$i];
    }

    $TotalPaidforSplit=$CashAmount+$InvoicePaidforSplit;

//New Invoice is Created and stored
   $Invoice= new Invoice();
   $Invoice->UserID=$idus;             
   $Invoice->ShopID=$shopid;
   $Invoice->SubTotal=$subtotalinvoice;
   $Invoice->Discount=$rq->OverAllDiscountSplit;
   $Invoice->Total=$tt;
   $Invoice->TaxTotal=$vat;
   $Invoice->ServiceCharge=$ServiceCharge;
   if(isset($rq->PaymentMethodID))
   $Invoice->PaidMoney=$paid;
   else
   $Invoice->PaidMoney=$TotalPaidforSplit;             
   $Invoice->ReturnedMoney=$returned;
   $Invoice->IsPaid=1;
   $Invoice->save();
   $inid=$Invoice->InvoiceID;

             
//Each Product information in the Invoice is stored
  for($i=0;$i<$ItemQty;$i++)
  {
    $invp=  new InvoiceProductMapping();
    $invp->UserID=$idus;
    $invp->ShopID=$shop[$i];
    $invp->InvoiceID=$inid;
    $invp->ProductID=$productid[$i];
    $invp->ProductName=$ProductName[$i];
    $invp->Qty=$Qty[$i];
    $invp->Price=$Price[$i];
    $invp->TotalPrice=$FinalPrice[$i]-$discount[$i]+$tax[$i];
    $invp->Discount=$discount[$i];
    $invp->TaxTotal=$tax[$i];
    $invp->CostPrice=$CostPrice[$i];
    $invp->save();
  }




  $rq->PaymentMethodID=1;
  //Option for a Single Card Transaction

  if(isset($rq->PaymentMethodID))
  {
    $SingleCardMethodName=PaymentMethod::findOrFail($rq->PaymentMethodID)->MethodName;


    $card=new CardTransaction();
    $card->CustomerID        = session()->get('CustomerID');
    $card->ShopID            = session()->get('ShopID');
    $card->InvoiceID         = $inid;
    $card->MethodID          = $rq->PaymentMethodID;
    $card->TransactionAmount = $rq->CardPaid;
    $card->CardNumber        = $rq->CardNumber;
    $card->CardHolderName    = $rq->CardName;
    $card->save();
    $InWords = $this->ConvertNumberToWord($tt);
    $TotalMethod=1;
    $MethodName=[];
    $CardAmount=[];
    $MethodName[0]=$SingleCardMethodName;
    $CardAmount[0]=$rq->CardPaid;

    //return view('invoice.sales',compact('ItemQty','FinalPrice','Price','ProductName','Qty','discount','User','tt','paid','returned','Shop','CustomerName','vat','TotalDiscount','subtotaltotal','Invoice','InWords','MethodName','TotalMethod','CardAmount'));
    
  }


  

  //Condition for Split Payment
  else
  {
    $MethodName1   =$rq->PaymentMethod1;
    $TotalMethod   =count($MethodName1);
    $CardAmount=[];
    $CardNumber=[];
    $CardHolderName=[];
    $MethodID=[];
    $MethodnName=[];
    $RawCardNumber=$rq->SplitCardNumber1;
    $RawCardHolderName=$rq->SplitCardHolderName1;
    $RawAmount=$rq->SplitPaymentAmount1;
    $RawMethodID=$rq->MethodID;

    //$CashAmount=$rq->SplitPaymentCashAmount1;

    $Total= count($RawAmount);

    //Card Information where money amount is provided  are stored
    for($i=0;$i<$Total;$i++)
    {
      if($RawAmount[$i]>0)      
      {        
        array_push($CardNumber,$RawCardNumber[$i]);
        array_push($CardHolderName,$RawCardHolderName[$i]);
        array_push($CardAmount,$RawAmount[$i]);
        array_push($MethodID,$RawMethodID[$i]);
        array_push($MethodName,$MethodName1[$i]);
      }
    }
    $TotalMethod=count($MethodName);      
    $CardTotal=count($CardAmount);
    for($i=0;$i<$CardTotal;$i++)
    {
      $Card=new CardTransaction();
      $Card->InvoiceID=$inid;
      $Card->CustomerID=session()->get('CustomerID');
      $Card->ShopID=session()->get('ShopID');
      $Card->MethodID=$MethodID[$i];
      $Card->CardNumber=$CardNumber[$i];
      $Card->CardHolderName=$CardHolderName[$i];
      $Card->TransactionAmount=$CardAmount[$i];
      $Card->save();
    }

  }
   


  if($custid!=0)    
   {

    $CusID=$custid;
    $map= new CustomerInvoiceMapping();
    $map->CustomerID=$CusID;
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
    $ledger->CustomerID = $CusID;
    $ledger->InvoiceID  = $inid;
    $ledger->Credit     = $tt;
    $ledger->Debit      = $pa;
    $ledger->Balance    = $bal;

    $ledger->save();

    $custom=CustomerBalance::where('CustomerID','=',$CusID)->get()->first();              
     
    $bav=$custom->Balance;
    $CustomerPreviousBalance=$bav;

    if($returned>=0)
    {
      $bav=$bav;
    }
    else
    {
      $bav=$bav+$bal;
    }

    $CustomerCurrentBalance=$bal;

    //return $CustomerCurrentBalance;    
    $CustomerTotalBalance=$bav;

    $custom->Balance=$bav;
    $custom->save();    

   } 

  
  $InWords = $this->ConvertNumberToWord($tt);
  Session::forget('CustomerID');
  Session::forget('CustomerName');

  //Activity Information is stored
  $activity=new ActivityLog();
  $activity->UserID=session()->get('UserID');
  $activity->ShopID=session()->get('ShopID');
  $activity->ActivityName="Tender";
  $activity->save();
  $InvoiceID=$inid;

  $ProductID=[];
  for($i=0;$i<count($productid);$i++)
  {
    $ProductID[$i]=$productid[$i];
  }
  $ShopFooter=InvoiceSettings::where('ShopID','=',session()->get('ShopID'))->first();
   //return $TotalDiscount;
  $ShopID=[];
  for($i=0;$i<count($shop);$i++)
  {
    $ShopID[$i]=$shop[$i];

  }

              $Author=AuthorName();
              $Currency=CurrencyName();
              $JsonItemQty=json_encode($ItemQty);
              $JsonFinalPrice=json_encode($FinalPrice);
              $JsonPrice=json_encode($Price);
              $JsonProductName=json_encode($ProductName);
              $Jsonproductid=json_encode($productid);
              $JsonQty=json_encode($Qty);
              $Jsondiscount=json_encode($discount);
              $JsonUser=json_encode($User);
              $Jsontt=json_encode($tt);
              $Jsonpaid=json_encode($paid);
              $Jsonreturned=json_encode($returned);
              $JsonShop=json_encode($Shop);
              $JsonCustomerName=json_encode($CustomerName);
              $Jsonvat=json_encode($vat);
              $JsonTotalDiscount=json_encode($TotalDiscount);
              $Jsonsubtotaltotal=json_encode($subtotaltotal);
              $JsonInvoice=json_encode($Invoice);
              $JsonInWords=json_encode($InWords);
              $JsonProductID=json_encode($ProductID);
              $JsonShopFooter=json_encode($ShopFooter);
              $JsonShopID=json_encode($ShopID);
              $JsonAdvanceValue=json_encode($AdvanceValue);
              $JsonCashAmount=json_encode($CashAmount);
              $JsonCustomerPreviousBalance=json_encode($CustomerPreviousBalance);
              $JsonCustomerTotalBalance=json_encode($CustomerTotalBalance);
              $JsonCustomerCurrentBalance=json_encode($CustomerCurrentBalance);
              $JsonAuthor=json_encode($Author);
              $JsonCurrency=json_encode($Currency);
              $JsonMethodName=json_encode($MethodName);             
              $JsonCardAmount=json_encode($CardAmount);             
              $JsonTotalMethod=json_encode($TotalMethod);
              $JsonSingleCard=json_encode($SingleCard);             


              return response(['ItemQty'=>$JsonItemQty,'FinalPrice'=>$JsonFinalPrice,'Price'=>$JsonPrice,'ProductName'=>$JsonProductName,'productid'=>$Jsonproductid,'Qty'=>$JsonQty,'discount'=>$Jsondiscount,'User'=>$JsonUser,'tt'=>$Jsontt,'paid'=>$Jsonpaid,'returned'=>$Jsonreturned,'Shop'=>$JsonShop,'CustomerName'=>$JsonCustomerName,'vat'=>$Jsonvat,'TotalDiscount'=>$JsonTotalDiscount,'subtotaltotal'=>$Jsonsubtotaltotal,'Invoice'=>$JsonInvoice,'InWords'=>$JsonInWords,'ProductID'=>$JsonProductID,'ShopFooter'=>$JsonShopFooter,'ShopID'=>$JsonShopID,'AdvanceValue'=>$JsonAdvanceValue,'CashAmount'=>$JsonCashAmount,'CustomerPreviousBalance'=>$JsonCustomerPreviousBalance,'CustomerCurrentBalance'=>$JsonCustomerCurrentBalance,'CustomerTotalBalance'=>$JsonCustomerTotalBalance,'Author'=>$JsonAuthor,'Currency'=>$JsonCurrency,'MethodName'=>$JsonMethodName,'CardAmount'=>$JsonCardAmount,'TotalMethod'=>$JsonTotalMethod,'SingleCard'=>$JsonSingleCard]);




  //return view('invoice.sales',compact('ItemQty','FinalPrice','Price','ProductName','Qty','discount','User','tt','paid','returned','Shop','CustomerName','vat','TotalDiscount','subtotaltotal','Invoice','InWords','MethodName','TotalMethod','CardAmount','CashAmount','SingleCard','ProductID','ShopFooter','ShopID','AdvanceValue','CustomerPreviousBalance','CustomerCurrentBalance','CustomerTotalBalance'));      
    

      
}


  


    public function saleRefundProductID(Request $rq)
    {



      $inid         = 0;
      $paid         = 0;
      $returned     = 0;

      $cusname      = "Anonymous";
      $removed1     = [];
      $TotalPrice1  = [];        

      $ProductID1   = $rq->refproid1;
      //return $ProductID1;
      $ProductName1 = $rq->refpronam;
      $Qty1         = $rq->refqty1;
      
      $Price1       = $rq->refprice;
      $FinalPrice1  = $rq->price;
      $Discount1    = $rq->dis;
      $Reason1      = $rq->reason1;
      $Type1        = $rq->RefundType;
      $ShopID1        =$rq->RefShop;
      $CustomerPaymentByRefund=0;



      $tat = count($ProductID1);

      for($i=0;$i<count($ProductID1);$i++)
      {
        if($ProductID1[$i]==0)
        {
          array_push($removed1,$i);
        }
      }

      $TotalRemoved=count($removed1);

      $ProductID=[];
      $ProductName=[];
      $Type=[];    
      $Qty=[];
      $Discount=[];
      $Reason=[];
      $FinalPrice=[];
      $Price=[];
      $ShopID=[];



      $j=0;
      for($j=0;$j<$tat;$j++)
      {
        $k=0;

        for($i=0;$i<$TotalRemoved;$i++)
        {
          if($removed1[$i]==$j)
          {
            $k=1;
          }
        }

        if($k==0)
        {
          array_push($ProductName,$ProductName1[$j]);
          array_push($ProductID,$ProductID1[$j]);
          array_push($Type,$Type1[$j]);
          array_push($Qty,$Qty1[$j]);
          //array_push($FinalPrice,$FinalPrice1[$j]);
          array_push($Price,$Price1[$j]);
          array_push($Reason,$Reason1[$j]);
          array_push($Discount,$Discount1[$j]);
          array_push($ShopID,$ShopID1[$j]);
        }
      }

      $Taxing=[];
      $TaxCode=[];

      for($i=0;$i<count($ProductID);$i++)
      {
        $TaxCode1=Product::findOrFail($ProductID[$i])->TaxCode;
        array_push($TaxCode,$TaxCode1);

      }

      //return $TaxCode;

      for($i=0;$i<count($ProductID);$i++)
      {
        $value=TaxCode::where('TaxCodeID','=',$TaxCode[$i])->get();
        if(count($value)==0)
        {
          $Percent=0;
        }
        else
        {
          $Percent=$value[0]->TaxPercent;
        }
        array_push($Taxing,$Percent);
      }




      
      //$AllProducts=count($ProductID);

      $TaxValue=[];
      $totalTax=0;

      for($i=0;$i<count($ProductID);$i++)
      {
        $FinalPrice[$i]=$Price[$i]*$Qty[$i];
        $TaxValue[$i]=$Price[$i]*$Qty[$i]*$Taxing[$i]/100;
        $totalTax=$totalTax+$TaxValue[$i];
      }


      for($i=0;$i<count($ProductID);$i++)
        $FinalPrice[$i]=$FinalPrice[$i]+$TaxValue[$i];
      

      $totalPrice=0;
      for($i=0;$i<count($ProductID);$i++)
        $totalPrice=$totalPrice+$FinalPrice[$i];
      $SubTotalPrice=$totalPrice-$totalTax;
      //$totalPrice=$totalPrice+$totalTax;
      $totalDiscount=0;

    $idus= Auth::user()->id;
    $fad=UserNew::where('UserID','=',$idus)->get()->first();
    $fad->ShopID=session()->get('ShopID');
    $Shop = Shop::where('ShopID','=',$fad->ShopID)->get()->first();
    //$shopID=$fad->ShopID;
    $ItemQty = count($ProductID);


    for($i = 0; $i < $ItemQty; $i++)
    {
      $invp=  new InvoiceProductRefundMapping();      
      $invp->UserID=$idus;
      $invp->ShopID=$ShopID[$i];
      $invp->InvoiceID=$inid;
      $invp->ProductID=$ProductID[$i];
      $invp->ProductName=$ProductName[$i];
      $invp->Qty=$Qty[$i];
      $invp->Price=$Price[$i];
      $invp->TotalPrice=$FinalPrice[$i];
      $invp->Discount=$Discount[$i];
      $invp->TaxTotal=$TaxValue[$i];
      $invp->RefundReason=$Reason[$i];
      $invp->save();
    }


    

    

    for($i = 0; $i < $ItemQty; $i++)
    {
      if($Type[$i]=="Waste")
      {

        $waste=new Waste();
        $ProductIDforWaste=$ProductID[$i];
        $QuantityWaste=$Qty[$i];
        $UnitCost=Product::findOrFail($ProductIDforWaste)->CostPrice;
        $TotalCost=$QuantityWaste*$UnitCost;
        $waste->ShopID=$ShopID[$i];
        $waste->ProductID=$ProductIDforWaste;
        $waste->Qty=$QuantityWaste;
        $waste->UnitCost=$UnitCost;
        $waste->TotalPrice=$TotalCost;
        $waste->save();
      }

      if($Type[$i]=="Shop")
      {

        $ShopRefund=ShopProductMapping::where('ShopID','=',$ShopID[$i])->where('ProductID','=',$ProductID[$i])->get()->first();
        $UpdatedShopQuantity=$ShopRefund->Qty+$Qty[$i];
        $ShopRefund->Qty=$UpdatedShopQuantity;
        $ShopRefund->save();

        
      }

    }


    $CustomerRefund=session()->get('CustomerID');
      if($CustomerRefund>0)
      {
        $CustomerPaymentByRefund=$rq->CustomerPaymentByRefund;
        $CustomerTotalRefund=$rq->CustomerTotalRefund;
        if($CustomerPaymentByRefund>0)
        {

          $CustomerBalance = CustomerBalance::where('CustomerID','=',$CustomerRefund)->get()->first();
          $Balance = $CustomerBalance->Balance;
          $UpdateBalance = $Balance-$CustomerPaymentByRefund;
          $CustomerBalance->Balance=$UpdateBalance;
          $CustomerBalance->save();
          $CustomerLedger = new CustomerLedger();
          $CustomerLedger->CustomerID=$CustomerRefund;
          $CustomerLedger->Credit= 0;
          $CustomerLedger->Debit = $CustomerPaymentByRefund;
          $CustomerLedger->Balance = $UpdateBalance ;
          $CustomerLedger->InvoiceID=$inid;
          $CustomerLedger->save();
          //return response("Payment Accepted !");

        }

      }


    $ShopingID=session()->get('ShopID');
    $fad->ShopID=session()->get('ShopID');
    $Shop = Shop::where('ShopID','=',$ShopingID)->get()->first();



    //$Invoice = Invoice::findOrFail($inid);
    $User = User::findOrFail(session()->get('UserID'));




    //$cus=CustomerInvoiceMapping::where('InvoiceID','=',$inid)->get()->first();

    $InWords = $this->ConvertNumberToWord($totalPrice);

    if(session()->has('CustomerID'))
    {
      if($CustomerPaymentByRefund>0 && $CustomerRefund>0)
      {
        $ChangeRefund=$CustomerTotalRefund+$totalTax-$CustomerPaymentByRefund;
        $InWords = $this->ConvertNumberToWord($ChangeRefund);
      }

    }




    $activity=new ActivityLog();
    $activity->UserID=session()->get('UserID');
    $activity->ShopID=session()->get('ShopID');
    $activity->ActivityName="Refund";
    $activity->save();


    
      $ShopFooter=InvoiceSettings::where('ShopID','=',session()->get('ShopID'))->first();

      $Author=AuthorName();
      $Currency=CurrencyName();
      $jsontotalPrice=json_encode($totalPrice);
      $jsonSubTotalPrice=json_encode($SubTotalPrice);
      $jsontotalTax=json_encode($totalTax);


      $jsontotalDiscount=json_encode($totalDiscount);
      $jsonFinalPrice=json_encode($FinalPrice);
      $jsonPrice=json_encode($Price);
      $jsonProductName=json_encode($ProductName);
      $jsonQty=json_encode($Qty);


      $jsondiscount=json_encode($Discount);

      $jsonUser=json_encode($User);

      $jsonItemQty=json_encode($ItemQty);
      $jsonpaid=json_encode($paid);
      $jsonreturned=json_encode($returned);
      //$jsonInvoice=json_encode($Invoice);
      $jsonShop=json_encode($Shop);
      $jsoncusname=json_encode($cusname);
      $jsonInWords=json_encode($InWords);
      $jsonCustomerPaymentByRefund=json_encode($CustomerPaymentByRefund);
      $jsonShopFooter=json_encode($ShopFooter);
      $jsonProductID=json_encode($ProductID);
      $jsonShopID=json_encode($ShopID);
      $jsonAuthor=json_encode($Author);
      $jsonCurrency=json_encode($Currency);
       



      return response(['totalPrice'=>$jsontotalPrice,'SubTotalPrice'=>$jsonSubTotalPrice,'totalTax'=>$jsontotalTax,'totalDiscount'=>$jsontotalDiscount,'FinalPrice'=>$jsonFinalPrice,'Price'=>$jsonPrice,'ProductName'=>$jsonProductName,'Qty'=>$jsonQty,'discount'=>$jsondiscount,'User'=>$jsonUser,'ItemQty'=>$jsonItemQty,'paid'=>$jsonpaid,'returned'=>$jsonreturned,'Shop'=>$jsonShop,'cusname'=>$jsoncusname,'InWords'=>$jsonInWords,'ShopFooter'=>$jsonShopFooter,'ProductID'=>$jsonProductID,'ShopID'=>$jsonShopID,'Author'=>$jsonAuthor,'Currency'=>$jsonCurrency,'CustomerPaymentByRefund'=>$jsonCustomerPaymentByRefund]);







    

    return view('invoice.refund',compact('totalPrice','SubTotalPrice','totalTax','totalDiscount','FinalPrice','Price','ProductName','Qty','discount','User','ItemQty','paid','returned','Shop','cusname','InWords','CustomerPaymentByRefund','ProductID','ShopFooter','ShopID'));


    //return back();    


    }

    public function saleRefundInvoice(Request $rq)
    {
      //return $rq->all();      
      //$ShopIDs=$rq->RefShop;

      //return "I am Fahad";
      //return response("I am Abir Azzam");
      

      $CustomerPaymentByRefund=0;

      $InvoiceID    = $rq->inv1;
      $inid         = $InvoiceID[0];
      $paid         = 0;
      $returned     = 0;

      $cusname      = "Anonymous";
      $removed1     = [];
      $TotalPrice1  = [];        

      $ProductID1   = $rq->refproid1;
      $ProductName1 = $rq->refpronam1;
      $Qty1         = $rq->refqty1;      
      $Price1       = $rq->price1;


      $FinalPrice1  = $rq->refprice1;
      $Discount1    = $rq->dis1;
      $Reason1      = $rq->reason1;
      //return $Reason1;

      $Type1        = $rq->RefundType1;
      $Checking1    = $rq->checking1;
      $RefShopID1   = $rq->RefShop;
      $taxtotal1     = $rq->taxrefund1;

      $tat = count($ProductID1);
      for($i=0;$i<count($ProductID1);$i++)
      {
        if($Checking1[$i]==0)
        {
          array_push($removed1,$i);
        }
      }

      $TotalRemoved=count($removed1);

      $ProductID=[];
      $ProductName=[];
      $Type=[];    
      $Qty=[];
      $Discount=[];
      $Reason=[];
      $FinalPrice=[];
      $Price=[];
      $taxtotal=[];
      $RefShopID=[];
      $j=0;
      for($j=0;$j<$tat;$j++)
      {
        $k=0;

        for($i=0;$i<$TotalRemoved;$i++)
        {
          if($removed1[$i]==$j)
          {
            $k=1;
          }
        }

        if($k==0)
        {
          array_push($ProductName,$ProductName1[$j]);
          array_push($ProductID,$ProductID1[$j]);
          array_push($Type,$Type1[$j]);
          array_push($Qty,$Qty1[$j]);
          //array_push($FinalPrice,$FinalPrice1[$j]);
          array_push($Price,$Price1[$j]);
          array_push($Reason,$Reason1[$j]);
          array_push($Discount,$Discount1[$j]);
          array_push($RefShopID,$RefShopID1[$j]);
          array_push($taxtotal,$taxtotal1[$j]);
        }
      }

      $OriginalQty=[];
      $TaxPerProduct=[];
      $DiscountPerProduct=[];
      for($i=0;$i<count($ProductID);$i++)
      {
        $Total=InvoiceProductMapping::where('InvoiceID','=',$inid)->where('ProductID','=',$ProductID[$i])->get();
        array_push($OriginalQty,$Total[0]->Qty);
        array_push($TaxPerProduct,(float)$taxtotal[$i]/(float)$Total[0]->Qty);
        array_push($DiscountPerProduct,(float)$Total[0]->Discount/(float)$Total[0]->Qty);

      }


      
      $MappingDiscount=[];
      $MappingTax     =[];

      for($i=0;$i<count($ProductID);$i++)
      {
        $MappingTax[$i]=$TaxPerProduct[$i]*$Qty[$i];
        $MappingDiscount[$i]=$DiscountPerProduct[$i]*$Qty[$i];

      }
      //return $Qty;
      $TaxPercent=[];
      /*for($i=0;$i<count($taxcode);$i++)
      {
        $Percent=TaxCode::where('TaxCode','=',$taxcode[$i])->get();
        if(count($Percent)==0)
        {
          $value=0;
        }
        if(count($Percent)==1)
        {
          $value=$Percent[0]->TaxPercent;
        }
        array_push($TaxPercent,$value);
      }*/

      $Taxvalue=[];

      for($i=0;$i<count($ProductID);$i++)
      {
        //$FinalPrice[$i]=$Price[$i]*$Qty[$i]+$MappingTax[$i]-$MappingDiscount[$i];
        $FinalPrice[$i]=$Price[$i]*$Qty[$i];
        //$Taxvalue[$i]=$taxtotal[$i];
      }

      $totalPrice=0;
      $totalTax=0;
      $totalDiscount=0;
      $SubTotalPrice=0;

      for($i=0;$i<count($ProductID);$i++)
      {
        $totalPrice=$totalPrice+$FinalPrice[$i];
        $totalTax=$totalTax+$MappingTax[$i];
        $totalDiscount=$totalDiscount+$MappingDiscount[$i];
        $SubTotalPrice=$SubTotalPrice+$Price[$i]*$Qty[$i];

      }

      $totalPrice=$totalPrice+$totalTax-$totalDiscount;
      //return $Taxvalue; 
      

     // $totalPrice=0;
      //$totalTax=0;
      //$totalDiscount=0;
      //for($i=0;$i<count($ProductID);$i++)
      //{

       // $totalPrice=$totalPrice+$FinalPrice[$i];
       // $totalTax=$totalTax+$Taxvalue[$i];
       // $totalDiscount=$totalDiscount+$Discount[$i];
      //}
      //$SubTotalPrice=$totalPrice;      
      //$totalPrice=$totalPrice+$totalTax-$totalDiscount;
      $CustomerRefund=session()->get('CustomerID');


      $Inv=Invoice::findOrFail($inid);
      $Inv->IsRefunded=1;
      $Inv->save();

      
      //Condition Where Customer is registered
      if($CustomerRefund>0)
      {
        $CustomerPaymentByRefund=$rq->CustomerPaymentByRefund;
        $CustomerTotalRefund=$rq->CustomerTotalRefund;

        //Condition where Customer Wants to adjust his dues
        if($CustomerPaymentByRefund>0)
        {

          $CustomerBalance = CustomerBalance::where('CustomerID','=',$CustomerRefund)->get()->first();
          $Balance = $CustomerBalance->Balance;
          $UpdateBalance = $Balance-$CustomerPaymentByRefund;
          $CustomerBalance->Balance=$UpdateBalance;
          $CustomerBalance->save();
          $CustomerLedger = new CustomerLedger();
          $CustomerLedger->CustomerID=$CustomerRefund;
          $CustomerLedger->Credit= 0;
          $CustomerLedger->Debit = $CustomerPaymentByRefund;
          $CustomerLedger->Balance = $UpdateBalance ;
          $CustomerLedger->InvoiceID=$inid;
          $CustomerLedger->save();
          //return response("Payment Accepted !");

        }

      }

    $idus= Auth::user()->id;
    $fad=UserNew::where('UserID','=',$idus)->get()->first();
    $fad->ShopID=session()->get('ShopID');
    $Shop = Shop::where('ShopID','=',$fad->ShopID)->get()->first();
    $shopID=$fad->ShopID;
    $ItemQty = count($ProductID);


    for($i = 0; $i < $ItemQty; $i++)
    {
      $invp=  new InvoiceProductRefundMapping();      
      $invp->UserID=$idus;
      $invp->ShopID=$RefShopID[$i];
      $invp->InvoiceID=$inid;
      $invp->ProductID=$ProductID[$i];
      $invp->ProductName=$ProductName[$i];
      $invp->Qty=$Qty[$i];
      $invp->Price=$Price[$i];
      $invp->TotalPrice=$FinalPrice[$i];
      $invp->Discount=$MappingDiscount[$i];
      $invp->TaxTotal=$MappingTax[$i];
      $invp->RefundReason=$Reason[$i];
      $invp->save();
    }





    //$ShopID=session()->get('ShopID');
    
    //return $ProductID;
    //return $Qty;
    

    for($i = 0; $i < $ItemQty; $i++)
    {
      if($Type[$i]=="Waste")
      {

        $waste=new Waste();
        $ProductIDforWaste=$ProductID[$i];
        $QuantityWaste=$Qty[$i];
        $UnitCost=Product::findOrFail($ProductIDforWaste)->CostPrice;
        $TotalCost=$QuantityWaste*$UnitCost;
        $waste->ShopID=$RefShopID[$i];
        $waste->ProductID=$ProductIDforWaste;
        $waste->Qty=$QuantityWaste;
        $waste->UnitCost=$UnitCost;
        $waste->TotalPrice=$TotalCost;
        $waste->save();
      }




   

      if($Type[$i]=="Shop")
      {

        $ShopRefund=ShopProductMapping::where('ShopID','=',$RefShopID[$i])->where('ProductID','=',$ProductID[$i])->get()->first();
        $UpdatedShopQuantity=$ShopRefund->Qty+$Qty[$i];
        $ShopRefund->Qty=$UpdatedShopQuantity;
        $ShopRefund->save();
        
      }

    }



    //$Invoice = Invoice::findOrFail($inid);
    //$User = User::findOrFail($Invoice->UserID);


    //$cus=CustomerInvoiceMapping::where('InvoiceID','=',$inid)->get()->first();

    $InWords = $this->ConvertNumberToWord($totalPrice);


    //return response("I am Zahid Anwar");

    if(session()->has('CustomerID'))
    {

      $CustID=session()->get('CustomerID');
      $cusname=session()->get('CustomerName');
      if($CustomerPaymentByRefund>0 && $CustomerRefund>0 && $CustID>0)
      {
        $ChangeRefund=$CustomerTotalRefund+$totalTax-$CustomerPaymentByRefund;
        $InWords = $this->ConvertNumberToWord($ChangeRefund);
      }

      //return response($InWords);


    }


    

    $activity=new ActivityLog();
    $activity->UserID=session()->get('UserID');
    $activity->ShopID=session()->get('ShopID');
    $activity->ActivityName="Refund";
    $activity->save();

    $Invoice = Invoice::findOrFail($inid);
    $User = User::findOrFail(session()->get('UserID'));

    



      $ShopFooter=InvoiceSettings::where('ShopID','=',session()->get('ShopID'))->first();

      $ShopID=[];

    for($i=0;$i<count($RefShopID);$i++)
    {
      $ShopID[$i]=$RefShopID[$i];

    }
    


    $Author=AuthorName();
    $Currency=CurrencyName();
    $jsontotalPrice=json_encode($totalPrice);
    $jsonSubTotalPrice=json_encode($SubTotalPrice);
    $jsontotalTax=json_encode($totalTax);


    $jsontotalDiscount=json_encode($totalDiscount);
    $jsonFinalPrice=json_encode($FinalPrice);
    $jsonPrice=json_encode($Price);
    $jsonProductName=json_encode($ProductName);
    $jsonQty=json_encode($Qty);
    
    
    $jsondiscount=json_encode($Discount);

    $jsonUser=json_encode($User);

    $jsonItemQty=json_encode($ItemQty);
    $jsonpaid=json_encode($paid);
    $jsonreturned=json_encode($returned);
    $jsonInvoice=json_encode($Invoice);
    $jsonShop=json_encode($Shop);
    $jsoncusname=json_encode($cusname);
    $jsonInWords=json_encode($InWords);
    $jsonCustomerPaymentByRefund=json_encode($CustomerPaymentByRefund);
    $jsonShopFooter=json_encode($ShopFooter);
    $jsonProductID=json_encode($ProductID);
    $jsonShopID=json_encode($ShopID);
    $jsonAuthor=json_encode($Author);
    $jsonCurrency=json_encode($Currency);
    //return response("I am Naik Ali"); 






    
      return response(['totalPrice'=>$jsontotalPrice,'SubTotalPrice'=>$jsonSubTotalPrice,'totalTax'=>$jsontotalTax,'totalDiscount'=>$jsontotalDiscount,'FinalPrice'=>$jsonFinalPrice,'Price'=>$jsonPrice,'ProductName'=>$jsonProductName,'Qty'=>$jsonQty,'discount'=>$jsondiscount,'User'=>$jsonUser,'ItemQty'=>$jsonItemQty,'paid'=>$jsonpaid,'returned'=>$jsonreturned,'Invoice'=>$jsonInvoice,'Shop'=>$jsonShop,'cusname'=>$jsoncusname,'InWords'=>$jsonInWords,'ShopFooter'=>$jsonShopFooter,'ProductID'=>$jsonProductID,'ShopID'=>$jsonShopID,'Author'=>$jsonAuthor,'Currency'=>$jsonCurrency,'CustomerPaymentByRefund'=>$jsonCustomerPaymentByRefund]);
    


    return view('invoice.refund',compact('totalPrice','SubTotalPrice','totalTax','totalDiscount','FinalPrice','Price','ProductName','Qty','discount','User','ItemQty','paid','returned','Invoice','Shop','cusname','InWords','CustomerPaymentByRefund','ShopFooter','ProductID','ShopID'));

    return back();    

      



    }


    public function cardPayment(Request $rq)
    {

      return $rq->all();



    }

    function CustomerInformation($CustomerID,$inid,$tt,$pa,$returned)
    {
        $cus=$CustomerID;

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
          $CustomerPreviousBalance=$bav;
          if($returned>=0)
          {
            $bav=$bav;
          }                 

          else
          {
            $bav=$bav+$bal;
          }

          $CustomerCurrentBalance=$bal;
          $CustomerTotalBalance=$bav;
          $custom->Balance=$bav;              
          $custom->save();

        }


    }


    function saleFinalProcessing($TotalPrice)
    {
      $InWords = $this->ConvertNumberToWord($TotalPrice);
      Session::forget('CustomerID');
      Session::forget('CustomerName');
      $activity=new ActivityLog();
      $activity->UserID=session()->get('UserID');
      $activity->ShopID=session()->get('ShopID');
      $activity->ActivityName="Tender";
      $activity->save();
      



    }


    //#####Creating the Invoice of the Customer#####

   


    



    // Express in words 
    function ConvertNumberToWord($num = false)
    {
      $num = str_replace(array(',', ' '), '' , trim($num));
      if(! $num) {
          return false;
      }
      $num = (int) $num;
      $words = array();

      $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
          'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
      );

      $list2 = array('', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'seventy', 'eighty', 'ninety', 'hundred');

      $list3 = array('', 'Thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
          'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
          'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
      );

      $num_length = strlen($num);
      $levels = (int) (($num_length + 2) / 3);
      $max_length = $levels * 3;
      $num = substr('00' . $num, -$max_length);
      $num_levels = str_split($num, 3);
      for ($i = 0; $i < count($num_levels); $i++) {
          $levels--;
          $hundred = (int) ($num_levels[$i] / 100);
          $hundred = ($hundred ? ' ' . $list1[$hundred] . ' hundred' . ( $hundred == 1 ? '' : '' ) . ' ' : '');
          $tens = (int) ($num_levels[$i] % 100);
          $singles = '';
          if ( $tens < 20 ) {
              $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
          } else {
              $tens = (int)($tens / 10);
              $tens = ' ' . $list2[$tens] . ' ';
              $singles = (int) ($num_levels[$i] % 10);
              $singles = ' ' . $list1[$singles] . ' ';
          }
          $words[] = $hundred . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
      } //end for loop
      $commas = count($words);
      if ($commas > 1) {
          $commas = $commas - 1;
      }
      return implode(' ', $words);
    }
  }
