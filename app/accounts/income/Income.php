<?php

namespace ClassyPOS\accounts\income;

use Illuminate\Database\Eloquent\Model;
use DB;

class Income extends Model
{
    protected $table		="income";
    protected $primaryKey	="IncomeID";
    protected $fillable		=['CategoryID','ShopID','AccountName','Amount','Notes'];

    public function listIncome()
    {
    	$List = DB::select("SELECT
    		income.IncomeID,
    		income_category.CategoryName,
    		shop.ShopName,
    		income.AccountName,
    		income.Amount,
    		income.Notes,
    		income.created_at,
    		income.updated_at
    		FROM income
    		JOIN income_category ON income.CategoryID = income_category.CategoryID
    		JOIN shop ON income.ShopID = shop.ShopID"
    	);

    	return $List;
    }
}

