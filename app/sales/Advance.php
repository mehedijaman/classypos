<?php

namespace ClassyPOS\sales;

use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    
    protected $table="advance";
    protected $primaryKey="ID";
    protected $fillable=['ShopID','Name','Phone','Email','Address','Products','Notes', 'DeliveryDate'];

}
