<?php

namespace ClassyPOS\product;

use Illuminate\Database\Eloquent\Model;

class ProductPackage extends Model
{
    protected $table = "product_package";
    protected $primaryKey = "PackageID";
    protected $fillable = ['PackageName', 'Price'];    
}
