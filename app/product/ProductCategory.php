<?php

namespace ClassyPOS\product;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
	protected $primaryKey="CategoryID";
    protected $table="product_category";
    protected $fillable=['CategoryName'];
}
