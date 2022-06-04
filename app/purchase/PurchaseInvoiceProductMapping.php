<?php

namespace ClassyPOS\purchase;

use Illuminate\Database\Eloquent\Model;

class PurchaseInvoiceProductMapping extends Model
{
    



    protected $table="purchase_invoice_product_mapping";
    protected $primaryKey="PurchaseID";
    protected $fillable=['PurchaseInvoiceID','ProductID','Qty','TotalPrice','CostPrice'];
}
