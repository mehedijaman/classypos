<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use ClassyPOS\customer\Customer;
use ClassyPOS\customer\CustomerLedger;
use ClassyPOS\shop\Shop;
use ClassyPOS\Tax\TaxCode;
use ClassyPOS\sales\Invoice;
use ClassyPOS\sales\InvoiceSettings;
use ClassyPOS\sales\Advance;
use ClassyPOS\sales\Hold;
use ClassyPOS\sales\Orders;
use ClassyPOS\sales\InvoiceProductMapping;
use ClassyPOS\sales\InvoiceProductRefundMapping;
use ClassyPOS\user\User;
use ClassyPOS\product\Product;

/**
* Invoice Controller
*/
class InvoiceController extends Controller
{
	public function index()
	{
		return "Hello Invoice";
	}

    public function listInvoice()
    {
        $ShopList = Shop::all();

        return view('invoice.report.index', compact('ShopList'));
    }

    public function InvoiceList($ShopID, $DateFrom, $DateTo)
    {
        # code...
    }


	public function DateWiseInvoiceList($DateFrom, $DateTo)
	{

		  if($DateFrom=="nofromdate" && $DateTo=="notodate")
           {
           	$start=date("Y-m-d");
           	$end=date("Y-m-d",time() + 86400);

			$ShopID=session()->get('ShopID');
			$ShopID=session()->get('ShopID');
			$Invoice = Invoice::where('ShopID','=',$ShopID)->whereBetween('updated_at',[$start,$end])->get();
			$json=json_encode($Invoice);
			return response($json);           

           }

	      if($DateFrom=="nofromdate")
            {
                $x="1900-01-01";
                $start=date("Y-m-d",strtotime($x));            
                 
            }


           if($DateFrom!="nofromdate")
            {                
                $start=date("Y-m-d",strtotime($DateFrom));       
                 
            }


            if($DateTo=="notodate")
            {
                $end=date("Y-m-d",time() + 86400);
            }

            if($DateTo!="notodate")
            {
                $end   = date("Y-m-d",strtotime($DateTo."+ 1day"));


            }


		//$DateFrom=date("Y-m-d",strtotime($DateFrom));
        //$DateTo = date("Y-m-d",strtotime($DateTo."+1 day"));
        //return $DateFrom;
        $ShopID=session()->get('ShopID');
        $Invoice = Invoice::where('ShopID','=',$ShopID)->whereBetween('created_at',[$start,$end])->get();
        $json=json_encode($Invoice);
        return response($json);
	}



    public function DateWiseRefundInvoiceList()
    {
          //When the Day is Today 
            $start=date("Y-m-d");
            $end=date("Y-m-d",time() + 86400);

            $ShopID=session()->get('ShopID');
            $Invoice = InvoiceProductRefundMapping::where('ShopID','=',$ShopID)->whereBetween('updated_at',[$start,$end])->get();

            $SaleDate=[];

            for($i=0;$i<count($Invoice);$i++)
            {
                if($Invoice[$i]->InvoiceID==0)
                {
                    $Time="0000-00-00";
                }
                else
                {
                    $Time=Invoice::findOrFail($Invoice[$i]->InvoiceID)->created_at;
                }

                $timer=date("Y-m-d",strtotime($Time));

                array_push($SaleDate,$timer);

            }

            $SalesDate=json_encode($SaleDate);  


            $json=json_encode($Invoice);           

            return response(['all'=>$json,'SaleDate'=>$SalesDate]);           

           

        
    }


	public function AdvanceList($DateFrom,$DateTo)
	{

        //return "Golam Kader";
           
           if($DateFrom=="nofromdate" && $DateTo=="notodate")
           {


           	$start=date("Y-m-d");
           	$end=date("Y-m-d",time() + 86400);
            $ShopID=session()->get('ShopID');
            $Advance=Advance::where('ShopID','=',$ShopID)
                     ->whereBetween('updated_at',[$start,$end])
                     ->where('IsSold','=',0)
                     ->get();                     

             $goodJson=json_encode($Advance);
             $totalprice=0;
             $finalprice=[];
             $Due=[];
            
                
             $totalProd=count($Advance);

             for($k=0;$k<$totalProd;$k++)
             {
                 $all=$Advance[$k]->Products;
                 $common=json_decode($all);
                 $TaxTotal=$common[0]->AllTax;

                 $totalprice=0;
                 $SingleAdvanceProduct=[];
                 $SingleAdvanceQuantity=[];                

                for($i=0;$i<count($common);$i++)
                {
                    $salevalue=Product::findOrFail($common[$i]->ProductID)->SalePrice;
                    //array_push($SingleAdvanceProduct,$salevalue);
                    $quantity=$common[$i]->Quantity;
                    //array_push($SingleAdvanceQuantity,$quantity);
                    $price=$salevalue*$quantity;
                    $totalprice=$totalprice+$price;
                }

                $totalprice=$totalprice+$TaxTotal;

                array_push($finalprice,$totalprice);
             }

             

             for($i=0;$i<$totalProd;$i++)
             {
                $amount=$finalprice[$i]-$Advance[$i]->Amount;
                array_push($Due,$amount);
             }          

             $count=json_encode($finalprice);
             $Dues=json_encode($Due);
             return response(['Main' => $goodJson,'total'=> $count,'Due'=>$Dues]);



           }



	      if($DateFrom=="nofromdate")
            {
                $x="1900-01-01";
                $start=date("Y-m-d",strtotime($x));            
                 
            }




            if($DateFrom!="nofromdate")
            {                
                $start=date("Y-m-d",strtotime($DateFrom));    
                 
            }




            if($DateTo=="notodate")
            {
                $end=date("Y-m-d",time() + 86400);
            }

            if($DateTo!="notodate")
            {
                $end=date("Y-m-d",strtotime($DateTo."+ 1day"));
            }




            $ShopID=session()->get('ShopID');


            $Advance=Advance::where('ShopID','=',$ShopID)
                     ->whereBetween('updated_at',[$start,$end])
                     ->where('IsSold','=',0)
                     ->get();

             $goodJson=json_encode($Advance);


             $totalprice=0;
             $finalprice=[];
             $Due=[];
            
                
             $totalProd=count($Advance);

             for($k=0;$k<$totalProd;$k++)
             {
                 $all=$Advance[$k]->Products;
                 $common=json_decode($all);
                 $TaxTotal=$common[0]->AllTax;

                 $totalprice=0;
                 $SingleAdvanceProduct=[];
                 $SingleAdvanceQuantity=[];                

                for($i=0;$i<count($common);$i++)
                {
                    $salevalue=Product::findOrFail($common[$i]->ProductID)->SalePrice;
                    //array_push($SingleAdvanceProduct,$salevalue);
                    $quantity=$common[$i]->Quantity;
                    //array_push($SingleAdvanceQuantity,$quantity);
                    $price=$salevalue*$quantity;
                    $totalprice=$totalprice+$price;
                }

                $totalprice=$totalprice+$TaxTotal;
                array_push($finalprice,$totalprice);
             }

             for($i=0;$i<$totalProd;$i++)
             {
                $amount=$finalprice[$i]-$Advance[$i]->Amount;
                array_push($Due,$amount);
             }



             $count=json_encode($finalprice);
             $Dues=json_encode($Due);
             return response(['Main' => $goodJson,'total'=> $count,'Due'=>$Dues]);


             //return $TotalAdvancePrice;

             //return response(['Main' => $goodJson,'total'=> $count]);


             //return response($goodJson);





	}

    public function holdList($DateFrom, $DateTo)
    {       
        if($DateFrom=="nofromdate" && $DateTo=="notodate")
           {           

            $start=date("Y-m-d");
            $end=date("Y-m-d",time() + 86400);
            $ShopID=session()->get('ShopID');
            $Hold=Hold::where('ShopID','=',$ShopID)
                     ->whereBetween('updated_at',[$start,$end])
                     ->get();
             $goodJson=json_encode($Hold);            
             return response($goodJson);       

           }



           if($DateFrom=="nofromdate")
            {
                $x="1900-01-01";
                $start=date("Y-m-d",strtotime($x));            
                 
            }


            if($DateFrom!="nofromdate")
            {                
                $start=date("Y-m-d",strtotime($DateFrom));                 
                 
            }


            if($DateTo=="notodate")
            {
                $end=date("Y-m-d",time() + 86400);

                
            }

            if($DateTo!="notodate")
            {
                $end=date("Y-m-d",strtotime($DateTo."+ 1day"));
            }

            




            $ShopID=session()->get('ShopID');
            $Hold=Hold::where('ShopID','=',$ShopID)
                     ->whereBetween('updated_at',[$start,$end])
                     ->get();
             $goodJson=json_encode($Hold);            
             return response($goodJson);       





    }


    public function orderList($DateFrom, $DateTo)
    {       
        if($DateFrom=="nofromdate" && $DateTo=="notodate")
       {           

            $start=date("Y-m-d");
            $end=date("Y-m-d",time() + 86400);
            $ShopID=session()->get('ShopID');
            $Order=Orders::where('orders.ShopID','=',$ShopID)             
            ->whereBetween('orders.updated_at',[$start,$end])
            ->leftjoin('invoice','orders.ID','=','invoice.OrderID')
            
            ->leftjoin('tables','orders.TableID','=','tables.ID')
            ->leftjoin('user','user.UserID','=','orders.StaffID')
            ->select('user.FirstName','tables.Name','orders.ID','orders.Guests','orders.created_at','orders.IsComplete','invoice.Total','invoice.InvoiceID','orders.IsInvoiced')
            ->get();

            $AllOrderID=[];
            for($i=0;$i<count($Order);$i++)
            {
                array_push($AllOrderID,$Order[$i]->ID);
            }

            $goodJson=json_encode($Order);            
            return response($goodJson); 
        }

       if($DateFrom=="nofromdate")
        {
            $x="1900-01-01";
            $start=date("Y-m-d",strtotime($x));           
             
        }


        if($DateFrom!="nofromdate")
        {                
            $start=date("Y-m-d",strtotime($DateFrom));   

                          
             
        }


        if($DateTo=="notodate")
        {
            $end=date("Y-m-d",time() + 86400);

            
        }

        if($DateTo!="notodate")
        {
            $end=date("Y-m-d",strtotime($DateTo."+ 1day"));
        }  

        $ShopID=session()->get('ShopID');
        $Order=Orders::where('orders.ShopID','=',$ShopID)             
        ->whereBetween('orders.updated_at',[$start,$end])
        ->leftjoin('invoice','orders.ID','=','invoice.OrderID')        
        ->leftjoin('counter','orders.CounterID','=','counter.ID')
        ->leftjoin('user','user.UserID','=','orders.StaffID')
        ->select('user.FirstName','counter.Name','orders.ID','orders.Guests','orders.created_at','orders.IsComplete','invoice.Total','invoice.InvoiceID','orders.IsInvoiced')
        ->get();   

        $goodJson=json_encode($Order);            
        return response($goodJson); 
            /*$Hold=Hold::where('ShopID','=',$ShopID)
                     ->whereBetween('updated_at',[$start,$end])
                     ->get();
             $goodJson=json_encode($Hold);            
             return response($goodJson);*/       





    }

	public function listByUser($UserID)
	{
		$User = User::findOrFail($UserID);

		$Invoice = new Invoice;

		$InvoiceList = $Invoice->listByUser($UserID);

		$Json = json_encode($InvoiceList);

		return response($Json);
	}

	public function InvoiceSearchForRefund($id, $ShopID)
	{
		$soldproducts=InvoiceProductMapping::where('InvoiceID','=',$id)        
        ->get();
        $productquantityintheinvoice=[];
        $productquantityintherefundedinvoice=[];
        $productidintheinvoice=[];
        $productshopintheinvoice=[];



        $totalproductintheinvoice=count($soldproducts);

        for($i=0;$i<$totalproductintheinvoice;$i++)
        {
            $aa= $soldproducts[$i];
            array_push($productquantityintheinvoice,$aa->Qty);
            array_push($productidintheinvoice,$aa->ProductID);
            array_push($productshopintheinvoice,$aa->ShopID);
        }



        for($j=0;$j<count($soldproducts);$j++)
        {
            $numberofrefundedproducts=0;


           $refundedproducts = InvoiceProductRefundMapping::where('InvoiceID','=',$id)->where('ProductID','=',$productidintheinvoice[$j])->where('ShopID','=',$productshopintheinvoice[$j])
           ->select('Qty')
           ->get();

           

           $cnn=count($refundedproducts);
           for($k=0;$k<$cnn;$k++)
           {
            $numberofrefundedproducts=$numberofrefundedproducts+$refundedproducts[$k]->Qty;
           }

           array_push($productquantityintherefundedinvoice,$numberofrefundedproducts);
           
        }

        //return response(json_encode($productquantityintherefundedinvoice));

        
        for($z=0;$z<count($soldproducts);$z++)
        {
            $current=$productquantityintheinvoice[$z]-$productquantityintherefundedinvoice[$z];
            $aa=$soldproducts[$z];
            $aa->Qty=$current;

        }
        $json = json_encode($soldproducts);
        return response($json);
	}
	

	// Print Invoice
	public function InvoicePrint($InvoiceID)
	{

		$CustomerID=CustomerLedger::where('InvoiceID','=',$InvoiceID)->get();

		if(count($CustomerID)==0)
		  $CustomerName="Annonymous";

		else
		{
		  $customer=Customer::findOrFail($CustomerID[0]->CustomerID);
		  $CustomerName=$customer->FirstName;
		}



		$ProductName  = [];
		$FinalPrice   = [];
		$Price        = [];
		$Qty          = [];
		$discount     = [];
        $ProductID    = [];
        $ShopID       = [];

		$InvoiceProduct=InvoiceProductMapping::where('InvoiceID','=',$InvoiceID)->get();

		foreach($InvoiceProduct as $data)
		{

		  array_push($ProductName,$data->ProductName);
		  array_push($FinalPrice, $data->TotalPrice);
		  array_push($Price,$data->Price);
		  array_push($Qty,$data->Qty);
          array_push($discount,$data->Discount); 
          array_push($ProductID,$data->ProductID); 
		  array_push($ShopID,$data->ShopID); 
		}



		$ItemQty = count($ProductName);

		$TotalDiscount = 0;
		for ($i=0; $i < $ItemQty ; $i++) { 
		  $TotalDiscount += $discount[$i]*$Qty[$i];
		}


		$Invoice  = Invoice::findOrFail($InvoiceID);

        if($Invoice->OrderID!=0)
        {
            $Order=Orders::where('orders.ID','=',$Invoice->OrderID)
                ->leftjoin('counter','orders.CounterID','=','counter.ID')
                ->leftjoin('user','user.UserID','=','orders.StaffID')
                ->select('orders.ID','orders.Guests','orders.created_at','counter.Name','user.FirstName')
                ->first();
            

        }

		$Shop     = Shop::findOrFail($Invoice->ShopID);
		$User     = User::findOrFail($Invoice->UserID);
		$InWords=app('ClassyPOS\Http\Controllers\TenderController')->ConvertNumberToWord($Invoice->Total);
		//$InWords  = $this->convertNumberToWord($Invoice->Total);

       $ShopFooter=InvoiceSettings::where('ShopID','=',session()->get('ShopID'))->first();

       if($Invoice->OrderID==0)
       {
        return view('invoice.sales',compact('Invoice','ItemQty','FinalPrice','Price','ProductName','Qty','TotalDiscount','User','Shop','CustomerName','InWords','ProductID','ShopFooter','ShopID','discount'));

       }
        
		return view('invoice.sales',compact('Invoice','ItemQty','FinalPrice','Price','ProductName','Qty','TotalDiscount','User','Shop','CustomerName','InWords','ProductID','ShopFooter','ShopID','Order','discount'));
	}



    // Print Invoice
    public function InvoiceDetails($InvoiceID)
    {


        //return "I am Fahad";


        $CustomerID=CustomerLedger::where('InvoiceID','=',$InvoiceID)->get();

        if(count($CustomerID)==0)
          $CustomerName="Annonymous";

        else
        {
          $customer=Customer::findOrFail($CustomerID[0]->CustomerID);
          $CustomerName=$customer->FirstName;
        }

        $ProductName  = [];
        $FinalPrice   = [];
        $Price        = [];
        $Qty          = [];
        $Discount     = [];
        $TaxCode      = [];
        $ProductID    = [];
        $ShopID       = [];

        $InvoiceProduct=InvoiceProductMapping::where('InvoiceID','=',$InvoiceID)        

            ->get();

        $Invoice=Invoice::findOrFail($InvoiceID);    

            //$TaxPercent=[];
            //$TaxCode   =[];
            //foreach($InvoiceProduct as $data)
            //{
               // if($data->TaxPercent==null)
                  //  $data->TaxPercent=0;
                //array_push($TaxPercent,$data->TaxPercent);
                //array_push($TaxCode,$data->TaxPercent);
            //}
            //return $TaxPercent;
            //$Jsontax=json_encode($TaxPercent);
            //return response($Jsontax);
            $TotalDiscount=Invoice::findOrFail($InvoiceID)->Discount;
            $jsonDiscount=json_encode($Invoice);
            $json=json_encode($InvoiceProduct);
        return response(['Total'=>$json,'Invoice'=>$jsonDiscount]);
        
        foreach($InvoiceProduct as $data)
        {

          array_push($ProductName,$data->ProductName);
          array_push($FinalPrice, $data->TotalPrice);
          array_push($Price,$data->Price);
          array_push($Qty,$data->Qty);
          array_push($Discount,$data->Discount); 
          //array_push($TaxCode,$data->Discount); 
          array_push($ProductID,$data->ProductID); 
          array_push($ShopID,$data->ShopID); 
        }

        $ItemQty = count($ProductName);

        $TotalDiscount = 0;
        for ($i=0; $i < $ItemQty ; $i++) { 
          $TotalDiscount += $Discount[$i]*$Qty[$i];
        }

        $TotalDiscount=Invoice::findOrFail($InvoiceID)->Discount;
        $TotalPrice = 0;
        for ($i=0; $i < $ItemQty ; $i++) { 
          $TotalPrice += $Price[$i]*$Qty[$i];
        }

        $TotalSubTotal=0;
        

        $TotalSubTotal=$TotalPrice-$TotalDiscount;
        $Invoice  = Invoice::findOrFail($InvoiceID);
        $Invoice=json_encode($Invoice);




        return response(['Total'=>$json,'Discount'=>$TotalDiscount,'TotalSub'=>$TotalSubTotal,'Invoice'=>$Invoice,'Tax'=>$Jsontax]);



        $Invoice  = Invoice::findOrFail($InvoiceID);
        $Shop     = Shop::findOrFail($Invoice->ShopID);
        $User     = User::findOrFail($Invoice->UserID);
        $InWords=app('ClassyPOS\Http\Controllers\TenderController')->ConvertNumberToWord($Invoice->Total);
        //$InWords  = $this->convertNumberToWord($Invoice->Total);

       $ShopFooter=InvoiceSettings::where('ShopID','=',session()->get('ShopID'))->first();
        
        return view('invoice.sales',compact('Invoice','ItemQty','FinalPrice','Price','ProductName','Qty','TotalDiscount','User','Shop','CustomerName','InWords','ProductID','ShopFooter','ShopID'));
    }



    public function InvoiceDetailsforModal($InvoiceID)
    {


        //return "I am Fahad";


        $CustomerID=CustomerLedger::where('InvoiceID','=',$InvoiceID)->get();

        if(count($CustomerID)==0)
          $CustomerName="Annonymous";

        else
        {
          $customer=Customer::findOrFail($CustomerID[0]->CustomerID);
          $CustomerName=$customer->FirstName;
        }

        $ProductName  = [];
        $FinalPrice   = [];
        $Price        = [];
        $Qty          = [];
        $Discount     = [];
        $TaxCode      = [];
        $ProductID    = [];
        $ShopID       = [];

        $InvoiceProduct=InvoiceProductMapping::where('InvoiceID','=',$InvoiceID)

        ->leftjoin('product','product.ProductID','=','invoice_product_mapping.ProductID')
        

        ->select('invoice_product_mapping.Qty','invoice_product_mapping.ProductID','invoice_product_mapping.TaxCode','invoice_product_mapping.Discount','invoice_product_mapping.ShopID','product.ProductName','product.SalePrice')
        ->get();

            
        $TotalDiscount=Invoice::findOrFail($InvoiceID)->Discount;
        $jsonTotalDiscount=json_encode($TotalDiscount);
        $json=json_encode($InvoiceProduct);
        return response(['Total'=>$json,'Discount'=>$jsonTotalDiscount]);
        
        foreach($InvoiceProduct as $data)
        {

          array_push($ProductName,$data->ProductName);
          array_push($FinalPrice, $data->TotalPrice);
          array_push($Price,$data->Price);
          array_push($Qty,$data->Qty);
          array_push($Discount,$data->Discount); 
          //array_push($TaxCode,$data->Discount); 
          array_push($ProductID,$data->ProductID); 
          array_push($ShopID,$data->ShopID); 
        }

        $ItemQty = count($ProductName);

        $TotalDiscount = 0;
        for ($i=0; $i < $ItemQty ; $i++) { 
          $TotalDiscount += $Discount[$i]*$Qty[$i];
        }

        $TotalDiscount=Invoice::findOrFail($InvoiceID)->Discount;
        $TotalPrice = 0;
        for ($i=0; $i < $ItemQty ; $i++) { 
          $TotalPrice += $Price[$i]*$Qty[$i];
        }

        $TotalSubTotal=0;
        

        $TotalSubTotal=$TotalPrice-$TotalDiscount;
        $Invoice  = Invoice::findOrFail($InvoiceID);
        $Invoice=json_encode($Invoice);




        return response(['Total'=>$json,'Discount'=>$TotalDiscount,'TotalSub'=>$TotalSubTotal,'Invoice'=>$Invoice]);



        $Invoice  = Invoice::findOrFail($InvoiceID);
        $Shop     = Shop::findOrFail($Invoice->ShopID);
        $User     = User::findOrFail($Invoice->UserID);
        $InWords=app('ClassyPOS\Http\Controllers\TenderController')->ConvertNumberToWord($Invoice->Total);
        //$InWords  = $this->convertNumberToWord($Invoice->Total);

       $ShopFooter=InvoiceSettings::where('ShopID','=',session()->get('ShopID'))->first();
        
        return view('invoice.sales',compact('Invoice','ItemQty','FinalPrice','Price','ProductName','Qty','TotalDiscount','User','Shop','CustomerName','InWords','ProductID','ShopFooter','ShopID'));
    }
    
    
	
	
	// Express in words 
	

	public function createSettings()
	{
        $ShopList = Shop::all();

		return view('invoice.settings.index', compact('ShopList'));
	}


    public function updateSettings(Request $rq)
    {
        


        $Settings=InvoiceSettings::where('ShopID','=',$rq->ShopID)->get()->first();
        if(count($Settings==0))
        {
            $SettingsNew=new InvoiceSettings();
            $SettingsNew->ShopID=$rq->ShopID;
            $SettingsNew->Header=$rq->InvoiceHeader;
            $SettingsNew->Footer=$rq->InvoiceFooter;
            $SettingsNew->save();
        }
        else
        {
            $Settings->ShopID=$rq->ShopID;
            $Settings->Header=$rq->InvoiceHeader;
            $Settings->Footer=$rq->InvoiceFooter;
            $Settings->save();

        }
        

        return back();

        //$ShopList = Shop::all();

        //return view('invoice.settings.index', compact('ShopList'));
    }

    public function footerEdit($ShopID)
    {
        $all=InvoiceSettings::where('ShopID','=',$ShopID)->first();
        $json=json_encode($all);
        return response($json);

    }





    
}