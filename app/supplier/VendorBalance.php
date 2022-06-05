<?php

namespace ClassyPOS\supplier;

use Illuminate\Database\Eloquent\Model;

class VendorBalance extends Model
{
    protected $table="vendor_balance";
    protected $primaryKey="BalanceID";
    protected $fillable=['VendorID','Balance'];

}
