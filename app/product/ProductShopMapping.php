<?php

namespace ClassyPOS;

use Illuminate\Database\Eloquent\Model;

class ProductShopMapping extends Model
{

	protected $primaryKey="ID";
    protected $table="shop_product_mapping";
    //$primaryKey="";
   
   protected $fillable=['ShopID','ProductID','Qty'];
}
