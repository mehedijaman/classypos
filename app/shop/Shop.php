<?php

namespace ClassyPOS\Shop;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table="shop";
    protected $primaryKey="ShopID";
    protected $fillable=['ShopName','ShopAddress','Phone','Email','Website','ShopLogo'];
}
