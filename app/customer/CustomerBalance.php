<?php

namespace ClassyPOS\customer;

use Illuminate\Database\Eloquent\Model;

class CustomerBalance extends Model
{
    protected $table="customer_balance";
    protected $primaryKey="BalanceID";

    protected $fillable=['CustomerID','Balance'];
}
