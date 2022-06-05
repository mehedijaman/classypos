<?php

namespace ClassyPOS\product;

use Illuminate\Database\Eloquent\Model;

class PackageProductMapping extends Model
{
    protected $table = "package_product_mapping";
    protected $primaryKey = "MappingID";
    protected $fillable = ['ProductID', 'Qty', 'Price'];    
}
