<?php

namespace ClassyPOS\shop;

use Illuminate\Database\Eloquent\Model;

class ShopCategoryMapping extends Model
{
	protected $primaryKey="ID";
    protected $table="product_category_shop_mapping";
   	protected $fillable=['ShopID','ProductID'];
}
