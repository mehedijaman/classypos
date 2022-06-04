<?php

namespace ClassyPOS\sales;

use Illuminate\Database\Eloquent\Model;

class ShopSettings extends Model
{
    
    protected $table="settings";
    protected $primaryKey="ID";
    protected $fillable=['ShopID','IsRestaurant','IsServiceCharge','IsTips', 'IsTax', 'IsOrder', 'IsHold', 'IsAdvance', 'IsBarcode','InvoiceFormat'];

}
