<?php

namespace ClassyPOS\shop;

use Illuminate\Database\Eloquent\Model;

class ShopSettings extends Model
{
    

    //protected $table="shop";
    //protected $primaryKey="ShopID";
    //protected $fillable=['ShopName','ShopAddress','Phone','Email','Website','ShopLogo'];


    protected $table="settings";
    protected $primaryKey="ID";
    protected $fillable=['ShopID','IsRestaurant','IsServiceCharge','IsTips', 'IsTax', 'IsOrder', 'IsHold', 'IsAdvance', 'IsBarcode','IsRefund','InvoiceSize'];

}
