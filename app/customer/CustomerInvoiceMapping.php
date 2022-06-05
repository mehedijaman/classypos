<?php

namespace ClassyPOS\customer;

use Illuminate\Database\Eloquent\Model;

class CustomerInvoiceMapping extends Model
{
    protected $table="customer_invoice_mapping";
    protected $primaryKey="CustomerInvoiceID";
    protected $fillable=['CustomerID','InvoiceID'];
}
