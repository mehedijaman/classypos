<?php

namespace ClassyPOS\bank;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{ 
    protected $primaryKey="BankID";
    protected $table="bank";
    protected $fillable=['BankName'];
}
