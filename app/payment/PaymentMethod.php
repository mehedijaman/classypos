<?php

namespace ClassyPOS\payment;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table="payment_method";
	protected $primaryKey="ID";
    protected $fillable=['MethodName'];
}
