<?php

namespace ClassyPOS\sales;

use Illuminate\Database\Eloquent\Model;

class SubOrderProductMapping extends Model
{
    
    protected $table="suborder_product_mapping";
    protected $primaryKey="SubOrderProductID";
    protected $fillable=['SubOrderID','ProductID','Qty'];

}
