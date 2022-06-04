<?php

namespace ClassyPOS\sales;

use Illuminate\Database\Eloquent\Model;
use DB;

class InvoiceProductRefundMapping extends Model
{ 
	protected $table="invoice_product_refund_mapping";
	protected $primaryKey="InvoiceProductID";
	protected $fillable=['UserID','ShopID','InvoiceID','ProductID','ProductName','Qty','Price','TotalPrice','Discount','RefundReason'];
	

   	public function TodaysTotal()
	{
		$TodaysTotal = DB::select("SELECT SUM(invoice_product_refund_mapping.TotalPrice) as TotalPrice FROM invoice_product_refund_mapping WHERE date(created_at) = CURDATE()");

		return $TodaysTotal;
	}
}
