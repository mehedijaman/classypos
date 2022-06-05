<?php

namespace ClassyPOS\accounts\expense;

use Illuminate\Database\Eloquent\Model;
use DB;

class Expense extends Model
{
    protected $table="expense";
    protected $primaryKey="ExpenseID";
    protected $fillable=['CategoryID','ShopID','Amount','ExpenseBy','Notes'];


    public function TodaysTotal()
    {
    	$TodaysTotal = DB::select("SELECT SUM(expense.Amount) as Total FROM expense WHERE date(created_at) = CURDATE()");

    	return $TodaysTotal;
    }

    public function listExpense()
    {
    	$List = DB::select("SELECT
    		expense.ExpenseID,
    		expense_category.CategoryName,
    		shop.ShopName,
    		expense.ExpenseBy,
    		expense.Amount,
    		expense.Notes,
    		expense.created_at,
    		expense.updated_at
    		FROM expense
    		JOIN expense_category ON expense.CategoryID = expense_category.CategoryID
    		JOIN shop ON expense.ShopID = shop.ShopID"
    	);

    	return $List;
    }
}
