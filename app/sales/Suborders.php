<?php

namespace ClassyPOS\sales;

use Illuminate\Database\Eloquent\Model;

class SubOrders extends Model
{
    protected $table="suborder";
    protected $primaryKey="SubOrderID";
    protected $fillable=['OrderID','KitchenID','IsConfirmed','IsComplete'];
}