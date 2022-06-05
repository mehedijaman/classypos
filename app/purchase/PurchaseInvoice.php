<?php

namespace ClassyPOS\purchase;

use Illuminate\Database\Eloquent\Model;
use DB;

class PurchaseInvoice extends Model
{
    
    protected $table="purchase_invoice";
    protected $primaryKey="PurchaseInvoiceID";
    protected $fillable=['VendorID','MemoID','TotalPrice','CashPayment','BankPayment','Due'];

    public function TodaysTotal()
    {
    	$TodaysTotal = DB::select("SELECT SUM(purchase_invoice.TotalPrice) as Total FROM purchase_invoice WHERE date(created_at) = CURDATE()");

    	return $TodaysTotal;
    }

    public function ListPurchaseInvoice()
    {
    	$List = DB::select("SELECT 
    		purchase_invoice.PurchaseInvoiceID,
    		purchase_invoice.MemoID,
    		vendor.VendorName,
    		purchase_invoice.TotalPrice,
    		purchase_invoice.CashPayment,
    		purchase_invoice.BankPayment,
    		purchase_invoice.Due,
    		purchase_invoice.created_at
    		FROM purchase_invoice
    		JOIN vendor ON purchase_invoice.VendorID = vendor.VendorID"
    	);

    	return $List;
    }
}
