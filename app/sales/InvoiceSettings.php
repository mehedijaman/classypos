<?php

namespace ClassyPOS\sales;

use Illuminate\Database\Eloquent\Model;
//use DB;

class InvoiceSettings extends Model
{
    protected $table="invoice_settings";
    protected $primaryKey="ID";
    protected $fillable=['ShopID','UserID','SubTotal','PaidMoney','ReturnedMoney'];
}