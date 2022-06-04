<?php

namespace ClassyPOS\shop;

use Illuminate\Database\Eloquent\Model;

class ShopProductMapping extends Model
{
	protected $primaryKey="ID";
    protected $table="shop_product_mapping";
   	protected $fillable=['ShopID','ProductID','Qty'];
}
