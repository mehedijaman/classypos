<?php

namespace ClassyPOS\bank;

use Illuminate\Database\Eloquent\Model;

class BankBalance extends Model
{
    

    protected $table="bank_balance";
    protected $primaryKey="BalanceID";
    protected $fillable=['BankID','Balance'];

}
