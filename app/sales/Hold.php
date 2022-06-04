<?php

namespace ClassyPOS\sales;

use Illuminate\Database\Eloquent\Model;

class Hold extends Model
{
    
    protected $table="sale_hold";
    protected $primaryKey="ID";
    protected $fillable=['ShopID','Products','Notes'];

}
