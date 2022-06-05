<?php

namespace ClassyPOS\accounts\income;

use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    protected $table="income_category";
    protected $primaryKey="CategoryID";
    protected $fillable=['CategoryName'];
}
