<?php

namespace ClassyPOS\sales;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    
    protected $table="orders";
    protected $primaryKey="ID";
    protected $fillable=['ShopID','UserID','TableID','StaffID', 'Notes', 'IsReady', 'IsDelivered', 'IsInvoiced', 'IsComplete'];

}
