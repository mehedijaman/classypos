<?php

namespace ClassyPOS\purchase;

use Illuminate\Database\Eloquent\Model;

class PurchaseInvoiceProductReturnMapping extends Model
{ 
    protected $table="purchase_invoice_product_return_mapping";
    protected $primaryKey="ID";
    protected $fillable=['UserID','ShopID','InvoiceID','ProductID','Qty','Price','TotalPrice','ReturnReason'];
}
