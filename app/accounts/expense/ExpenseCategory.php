<?php

namespace ClassyPOS\accounts\expense;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $table="expense_category";
    protected $primaryKey="CategoryID";
    protected $fillable=['CategoryName'];
}

