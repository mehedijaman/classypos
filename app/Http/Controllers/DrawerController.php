<?php
namespace ClassyPOS\Http\Controllers;

use ClassyPOS\Exceptions\Handler;


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
use ClassyPOS\sales\Advance;
use ClassyPOS\sales\CardTransaction;
use ClassyPOS\sales\InvoiceProductMapping;
use ClassyPOS\sales\InvoiceProductRefundMapping;
use ClassyPOS\sales\CashDrawer;
use ClassyPOS\accounts\expense\ExpenseCategory;
use ClassyPOS\accounts\expense\Expense;
use ClassyPOS\user\User;
use ClassyPOS\user\ActivityLog;
use ClassyPOS\product\Product;
use ClassyPOS\payment\PaymentMethod;
use Illuminate\Support\Facades\Session; 
use Illuminate\Http\Response;
use ClassyPOS\product\ProductCategory;
use ClassyPOS\supplier\Vendor;
use ClassyPOS\waste\Waste;


/**
* Activity Related all operations controller
*/
class DrawerController extends Controller
{	
	public function report()
	{
		$ShopList = Shop::all();
		$UserList = User::all();

		return view('drawer.report.index', compact('ShopList', 'UserList'));
	}


	public function ClosingBalance($CashDrawerID)
	{

		$TotalSales=0;
		$TotalQuantitySold=0;
		$TotalRefund=0;
		$TotalRefundQuantity=0;
		$TotalAdvanceAmount=0;    
		$TotalTax=0;
		$TotalCashTendered=0;
		$TotalCardTendered=0;
		$TotalExpense=0;
		$TotalWaste=0;
		$TotalWasteQuantity=0;
		$PreviousAdvance=0;
		$TotalDiscount=0;




		if($CashDrawerID==0)
		{
		  return "Balance is already closed";
		}

		$Cash=CashDrawer::findOrFail($CashDrawerID);
		$Cash->isClosed=1;
		$OpeningBalance=$Cash->OpeningBalance;
		$Cash->save();

		$CreateTime=$Cash->created_at;
		$EndTime=$Cash->updated_at;
		//$Invoice=Invoice::where('ShopID',)
		$ShopID=session()->get('ShopID');

		//$Invoice=Invoice::where('invoice.ShopID','=',$ShopID)->whereDate('invoice.created_at',$CreateTime)->leftjoin('advance','advance.ID','=','invoice.AdvanceID')->get();

		$Invoice=Invoice::where('invoice.ShopID','=',$ShopID)->whereBetween('invoice.created_at',[$CreateTime,$EndTime])->leftjoin('advance','advance.ID','=','invoice.AdvanceID')->get();

		//$CardAmount=CardTransaction::where('ShopID','=',$ShopID)->whereBetween('created_at',[$CreateTime,$EndTime])->get();
		if(count($Invoice)==0)
		{
		  $TotalSales=0;
		  $TotalTax=0;
		  $TotalCashTendered=0;
		  $PreviousAdvance=0;
		  $TotalDiscount=0;

		}
		else
		{
		  foreach($Invoice as $data)
		  {
		    $TotalSales=$TotalSales+$data->Total;
		    $PreviousAdvance=$PreviousAdvance+$data->Amount;
		    $TotalDiscount=$TotalDiscount+$data->Discount;

		    $TotalTax=$TotalTax+$data->TaxTotal;
		    $TotalCashTendered=$TotalCashTendered+$data->Total;
		  }
		  $TotalSales=$TotalSales-$PreviousAdvance;
		}


		$InvoiceMapping=InvoiceProductMapping::where('ShopID','=',$ShopID)->whereBetween('created_at',[$CreateTime,$EndTime])->get();

		if(count($InvoiceMapping)==0)
		{
		  $TotalQuantitySold=0;
		}

		else
		{
		  foreach($InvoiceMapping as $data)
		  {
		    $TotalQuantitySold=$TotalQuantitySold+$data->Qty;
		  }
		}

		$ProductRefund=InvoiceProductRefundMapping::where('ShopID','=',$ShopID)->whereBetween('created_at',[$CreateTime,$EndTime])->get();

		if(count($ProductRefund)==0)
		{
		  $TotalRefund=0;
		  $TotalRefundQuantity=0;
		}

		else
		{
		  foreach($ProductRefund as $data)
		  {
		    $TotalRefund=$TotalRefund+$data->TotalPrice-$data->Discount;
		    $TotalRefundQuantity=$TotalRefundQuantity+$data->Qty;
		  }
		}    

		$Advance=Advance::where('ShopID','=',$ShopID)->whereBetween('created_at',[$CreateTime,$EndTime])->get();

		if(count($Advance)==0)
		{
		  $TotalAdvanceAmount=0;
		}

		else
		{
		  foreach($Advance as $data)
		  {
		    $TotalAdvanceAmount=$TotalAdvanceAmount+$data->Amount;
		  }
		}

		$ExpenseCategory=ExpenseCategory::all();
		$CardMethod=PaymentMethod::all();
		$CardMethodID=[];
		$CardMethodName=[];
		$CardMethodAmount=[];

		$ExpenseCategoryID=[];
		$ExpenseCategoryAmount=[];
		$ExpenseCategoryName=[];


		foreach($ExpenseCategory as $data)
		{
			array_push($ExpenseCategoryID,$data->CategoryID);
			array_push($ExpenseCategoryAmount,0);
			array_push($ExpenseCategoryName,$data->CategoryName);
		}


		$Expense=Expense::where('ShopID','=',$ShopID)->whereBetween('created_at',[$CreateTime,$EndTime])->get();

		if(count($Expense)==0)
		{
		  $TotalExpense=0;
		}

		else
		{
		  foreach($Expense as $data)
		  {
		    $TotalExpense=$TotalExpense+$data->Amount;
		    $ID=$data->CategoryID;
		    for($i=0;$i<count($ExpenseCategoryID);$i++)
		    {
		    	if($ExpenseCategoryID[$i]==$ID)
		    	{
		    		$ExpenseCategoryAmount[$i]=$ExpenseCategoryAmount[$i]+$data->Amount;
		    	}
		    }

		  }

		}//End of Each of Expense Category


		//Calculation of Total Item Number

		$ID=[];
		$TotalItem=0;
		$InvoiceMapping=InvoiceProductMapping::where('ShopID','=',$ShopID)->whereBetween('created_at',[$CreateTime,$EndTime])->get();

		foreach($InvoiceMapping as $data)
		  {
		    $CurrentID=$data->ProductID;
		    $check=0;
		    for($i=0;$i<count($ID);$i++)
		    {
		    	if($CurrentID==$ID[$i])
		    	{
		    		$check=1;
		    		break;
		    	}
		    }

		    if($check==0)
		    	array_push($ID,$CurrentID);

		  }

		  $TotalItem=count($ID);

		  //End of Calculation of total Item Number



		foreach($CardMethod as $data)
		{
			array_push($CardMethodID,$data->ID);
			array_push($CardMethodAmount,0);
			array_push($CardMethodName,$data->MethodName);
		} 


		$CardAmount=CardTransaction::where('ShopID','=',$ShopID)->whereBetween('created_at',[$CreateTime,$EndTime])->get();

		if(count($CardAmount)==0)
		{
		  $TotalCardTendered=0;

		}

		else
		{
		  foreach($CardAmount as $data)
		  {
		    $TotalCardTendered=$TotalCardTendered+$data->TransactionAmount;
		    $ID=$data->MethodID;

		    for($i=0;$i<count($CardMethodID);$i++)
		    {
		    	if($CardMethodID[$i]==$ID)
		    	{
		    		$CardMethodAmount[$i]=$CardMethodAmount[$i]+$data->TransactionAmount;
		    	}
		    }
		  }

		}






		$ItemQty=count($ExpenseCategoryAmount);
		$CardMethodType=count($CardMethodID);

		$Waste=Waste::where('ShopID','=',$ShopID)->whereBetween('created_at',[$CreateTime,$EndTime])->get();

		if(count($Waste)==0)
		{
		  $TotalWaste=0;
		  $TotalWasteQuantity=0;
		}

		else
		{
		  foreach($Waste as $data)
		  {
		    $TotalWaste=$TotalWaste+$data->TotalPrice;
		    $TotalWasteQuantity=$TotalWasteQuantity+$data->Qty;
		  }
		}



		$CashinHand=$OpeningBalance+$TotalSales+$TotalAdvanceAmount-$TotalRefund-$TotalExpense;




		$Shop=Shop::findOrFail($ShopID);

		$username=session()->get('UserFirstName')." ".session()->get('UserLastName');

		$activity=new ActivityLog();
		$activity->UserID=session()->get('UserID');
		$activity->ShopID=session()->get('ShopID');
		$activity->ActivityName="Closing Balance";
		$activity->save();
		$User=User::findOrFail(session()->get('UserID'));

		$Cash=CashDrawer::findOrFail($CashDrawerID);
		$Cash->ClosingBalance=$CashinHand;

		$Cash->save();

		$Summary=0;

		$ShopID=session()->get('ShopID');
		$Invoice = Invoice::where('ShopID','=',$ShopID)->whereBetween('created_at',[$CreateTime,$EndTime])->get();

		$TotalInvoice=count($Invoice);
		  

		return view('invoice.drawer',compact('TotalSales','TotalQuantitySold','TotalRefund','TotalRefundQuantity','TotalAdvanceAmount','PreviousAdvance','TotalTax','TotalCashTendered','TotalCardTendered','TotalExpense','TotalWaste','TotalWasteQuantity','CreateTime','EndTime','Shop','User','CashinHand','OpeningBalance','Summary','ExpenseCategoryName','ExpenseCategoryAmount','ItemQty','CardMethodName','CardMethodAmount','CardMethodType','TotalInvoice','TotalItem','Invoice','TotalDiscount')); 
	}


	public function DaySummary($DailyReportDate = 0)
	{
		$ShopID = session()->get('ShopID');
		$Shop 	= Shop::findOrFail($ShopID);

		if($DailyReportDate==0)
		{
			$CreateTime=date("Y-m-d");
			$EndTime=date("Y-m-d",time() + 86400);

		}
		else
		{
			$CreateTime=date("Y-m-d",strtotime($DailyReportDate));
			$EndTime=   date("Y-m-d",time()+86400);
		}  


		//return Carbon::now();
		$Cash=CashDrawer::where('ShopID','=',session()->get('ShopID'))->where('isClosed','=',0)->whereDate('created_at',$CreateTime)->get();

		if(count($Cash)==0)
		{
			$OpeningBalance=0;
		}

		if(count($Cash)>0)
		{
			$OpeningBalance=$Cash[0]->OpeningBalance;
		}

		$TotalSales=0;
		$TotalQuantitySold=0;
		$TotalRefund=0;
		$TotalRefundQuantity=0;
		$TotalAdvanceAmount=0;    
		$TotalTax=0;
		$TotalCashTendered=0;
		$TotalCardTendered=0;
		$TotalExpense=0;
		$TotalWaste=0;
		$TotalWasteQuantity=0;
		$PreviousAdvance=0;
		$TotalDiscount=0;

		$Invoice=Invoice::where('invoice.ShopID','=',session()->get('ShopID'))->whereDate('invoice.created_at',$CreateTime)->leftjoin('advance','advance.ID','=','invoice.AdvanceID')->get();


		
		if(count($Invoice)==0)
		{
		  $TotalSales=0;
		  $TotalTax=0;
		  $TotalCashTendered=0;
		  $PreviousAdvance=0;
		  $TotalDiscount=0;

		}
		else
		{
		  foreach($Invoice as $data)
		  {
		    $TotalSales=$TotalSales+$data->Total;
		    $PreviousAdvance=$PreviousAdvance+$data->Amount;
		    $TotalTax=$TotalTax+$data->TaxTotal;
		    $TotalCashTendered=$TotalCashTendered+$data->Total;
		    $TotalDiscount=$TotalDiscount+$data->Discount;
		  }

		  $TotalSales=$TotalSales-$PreviousAdvance;
		}


		//return $PreviousAdvance;

		$ID=[];

		$TotalItem=0;


		$InvoiceMapping=InvoiceProductMapping::where('ShopID','=',$ShopID)->whereDate('created_at',$CreateTime)->get();

		foreach($InvoiceMapping as $data)
		  {
		    $CurrentID=$data->ProductID;
		    $check=0;
		    for($i=0;$i<count($ID);$i++)
		    {
		    	if($CurrentID==$ID[$i])
		    	{
		    		$check=1;
		    		break;
		    	}
		    }

		    if($check==0)
		    	array_push($ID,$CurrentID);

		  }

		  $TotalItem=count($ID);



		if(count($InvoiceMapping)==0)
		{
		  $TotalQuantitySold=0;
		}

		else
		{
		  foreach($InvoiceMapping as $data)
		  {
		    $TotalQuantitySold=$TotalQuantitySold+$data->Qty;
		  }
		}




		$ProductRefund=InvoiceProductRefundMapping::where('ShopID','=',$ShopID)->whereDate('created_at',$CreateTime)->get();

		if(count($ProductRefund)==0)
		{
		  $TotalRefund=0;
		  $TotalRefundQuantity=0;
		}

		else
		{
		  foreach($ProductRefund as $data)
		  {
		    $TotalRefund=$TotalRefund+$data->TotalPrice;
		    $TotalRefundQuantity=$TotalRefundQuantity+$data->Qty;
		  }
		}



		$Advance=Advance::where('ShopID','=',$ShopID)->whereDate('created_at',$CreateTime)->get();

		if(count($Advance)==0)
		{
		  $TotalAdvanceAmount=0;
		}

		else
		{
		  foreach($Advance as $data)
		  {
		    $TotalAdvanceAmount=$TotalAdvanceAmount+$data->Amount;
		  }

		}

		$ExpenseCategory=ExpenseCategory::all();
		$CardMethod=PaymentMethod::all();
		$CardMethodID=[];
		$CardMethodName=[];
		$CardMethodAmount=[];

		$ExpenseCategoryID=[];
		$ExpenseCategoryAmount=[];
		$ExpenseCategoryName=[];


		foreach($ExpenseCategory as $data)
		{
			array_push($ExpenseCategoryID,$data->CategoryID);
			array_push($ExpenseCategoryAmount,0);
			array_push($ExpenseCategoryName,$data->CategoryName);
		}

		$Expense=Expense::where('ShopID','=',$ShopID)->whereDate('created_at',$CreateTime)->get();

		if(count($Expense)==0)
		{
		  $TotalExpense=0;
		}

		else
		{
		  foreach($Expense as $data)
		  {
		    $TotalExpense=$TotalExpense+$data->Amount;
		    $ID=$data->CategoryID;
		    for($i=0;$i<count($ExpenseCategoryID);$i++)
		    {
		    	if($ExpenseCategoryID[$i]==$ID)
		    	{
		    		$ExpenseCategoryAmount[$i]=$ExpenseCategoryAmount[$i]+$data->Amount;
		    	}
		    }

		  }

		}//End of Each of Expense Category

		//Card Method for each type

		foreach($CardMethod as $data)
		{
			array_push($CardMethodID,$data->ID);
			array_push($CardMethodAmount,0);
			array_push($CardMethodName,$data->MethodName);
		} 

		$CardAmount=CardTransaction::where('ShopID','=',$ShopID)->whereDate('created_at',$CreateTime)->get();

		if(count($CardAmount)==0)
		{
		  $TotalCardTendered=0;
		}

		else
		{
		  foreach($CardAmount as $data)
		  {
		    $TotalCardTendered=$TotalCardTendered+$data->TransactionAmount;
		    $ID=$data->MethodID;

		    for($i=0;$i<count($CardMethodID);$i++)
		    {
		    	if($CardMethodID[$i]==$ID)
		    	{
		    		$CardMethodAmount[$i]=$CardMethodAmount[$i]+$data->TransactionAmount;
		    	}
		    }
		  }

		}

		//return $CardMethodAmount;

		$ItemQty=count($ExpenseCategoryAmount);
		$CardMethodType=count($CardMethodID);



		$Waste=Waste::where('ShopID','=',$ShopID)->whereDate('created_at',$CreateTime)->get();

		if(count($Waste)==0)
		{
		  $TotalWaste=0;
		  $TotalWasteQuantity=0;
		}

		else
		{
		  foreach($Waste as $data)
		  {
		    $TotalWaste=$TotalWaste+$data->TotalPrice;
		    $TotalWasteQuantity=$TotalWasteQuantity+$data->Qty;
		  }
		}
		$CashinHand=$OpeningBalance+$TotalSales+$TotalAdvanceAmount-$TotalRefund-$TotalExpense-$TotalCardTendered;
		

		$username=session()->get('UserFirstName')." ".session()->get('UserLastName');

		$activity=new ActivityLog();
		$activity->UserID=session()->get('UserID');
		$activity->ShopID=session()->get('ShopID');
		$activity->ActivityName="Closing Balance";
		$activity->save();
		$User=User::findOrFail(session()->get('UserID'));

		$Summary=1;


		//$start=date("Y-m-d");
		//$end=date("Y-m-d",time() + 86400);

		$ShopID=session()->get('ShopID');
		$ShopID=session()->get('ShopID');
		$Invoice = Invoice::where('ShopID','=',$ShopID)->whereDate('created_at',$CreateTime)->get();

		$TotalInvoice=count($Invoice);
		  

		return view('report.daily_report.day_summary',compact('TotalSales','TotalQuantitySold','TotalRefund','TotalRefundQuantity','TotalAdvanceAmount','PreviousAdvance','TotalTax','TotalCashTendered','TotalCardTendered','TotalExpense','TotalWaste','TotalWasteQuantity','CreateTime','EndTime','Shop','User','CashinHand','OpeningBalance','Summary','ExpenseCategoryName','ExpenseCategoryAmount','ItemQty','CardMethodName','CardMethodAmount','CardMethodType','Invoice','TotalInvoice','TotalItem','DailyReportDate','TotalDiscount'));
	}

	public function DayInvoices($DailyReportDate = 0)
	{
		if($DailyReportDate == 0)
		{
			$CreateTime = date("Y-m-d");
			$EndTime 	= date("Y-m-d",time() + 86400);
		}
		else
		{
			$CreateTime = date("Y-m-d",strtotime($DailyReportDate));
			$EndTime 	= date("Y-m-d",time()+86400);
		}

		$Shop=Shop::findOrFail(session()->get('ShopID'));

		$Invoice=Invoice::where('invoice.ShopID','=',session()
			->get('ShopID'))->whereDate('invoice.created_at',$CreateTime)
			->leftjoin('advance','advance.ID','=','invoice.AdvanceID')
			->get();

		return view('report.daily_report.day_invoices', compact('Shop','CreateTime', 'EndTime','DailyReportDate','Invoice'));
	}

	public function DaySales($DailyReportDate = 0)
	{
		$Shop = Shop::findOrFail(session()->get('ShopID'));

		if($DailyReportDate == 0)
		{
			$CreateTime = date("Y-m-d");
			$EndTime 	= date("Y-m-d",time() + 86400);
		}
		else
		{
			$CreateTime = date("Y-m-d",strtotime($DailyReportDate));
			$EndTime 	= date("Y-m-d",time()+86400);
		}

		$Report = DB::select("
            SELECT COUNT(invoice_product_mapping.Qty) AS Qty,
            product_category.CategoryName

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID           

            WHERE DATE(invoice_product_mapping.created_at) BETWEEN '$CreateTime' AND '$EndTime'

            GROUP BY product.CategoryID

            ORDER BY product.CategoryID ASC
            "
        );

		return view('report.daily_report.day_sales', compact('Shop', 'CreateTime', 'EndTime', 'DailyReportDate','Report'));		
	}
}