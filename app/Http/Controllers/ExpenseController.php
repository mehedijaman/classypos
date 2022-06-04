<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Exception;
use ClassyPOS\accounts\expense\ExpenseCategory;
use ClassyPOS\shop\Shop;
use ClassyPOS\accounts\expense\Expense;

class ExpenseController extends Controller
{

  # Load Expense Create Form
  public function createExpense()
  {

    $CategoryList = ExpenseCategory::all(); 

    $ShopList = Shop::all();

    return view('accounts.expense.new',compact('CategoryList','ShopList'));

  }  

  # Load Expense Category Create Form
  public function createCategory()
  {

    $CategoryList = ExpenseCategory::all();
      
    return view('accounts.expense.category',compact('CategoryList'));      
  }


  # Store Expense
  public function storeExpense(Request $Data)
  {
    try {
      $Expense = new Expense;

      $FormData = $Data->all();

      $Expense->CategoryID  = $FormData['CategoryID'];
      $Expense->ShopID      = $FormData['ShopID'];
      $Expense->Amount      = $FormData['Amount'];
      $Expense->ExpenseBy   = $FormData['ExpenseBy'];
      $Expense->Notes       = $FormData['Notes'];

      // Creating new expense into database
      $Expense->save();

      return redirect('/Expense/New');
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }
   
  # Store Expense Category
  public function storeCategory(Request $Data)
  {

  	try {
      $FormData   = $Data->all();       
        
      $Category = new ExpenseCategory;

      $Category['CategoryName'] = $FormData['CategoryName'];
         

      //Inserting Category name into database
      $Category->save();

      return redirect('/Expense/Category');
    } catch (\Exception $e) {
      echo $e->getMessage();
    }

  }

  #Show Expense List
  public function listExpense()
  {
    $Expense = new Expense;

    $ExpenseList = $Expense->listExpense();

    return view('accounts.expense.list', compact('ExpenseList'));
  }


  # Load Expense Edit View
  public function editExpense($ExpenseID)
  {

    $ExpenseCategory=ExpenseCategory::all();


    $Shop=Shop::all();

    $ExpenseEdit=Expense::where('ExpenseID','=',$ExpenseID)->get()->first();
    return view('accounts.expense.edit',compact('ExpenseEdit','ExpenseCategory','Shop'));


  
  }

  # Load Expense Category Edit View
  public function editCategory($id)
  {
    # code...
  }


  #Update Expense
  public function updateExpense(Request $Data, $ExpenseID)
  { 

    $ExpenseUpdate=Expense::where('ExpenseID','=',$ExpenseID)->get()->first();
    $ExpenseUpdate->Amount=$Data->Amount;    
    $ExpenseUpdate->Notes=$Data->Notes;
    $ExpenseUpdate->CategoryID=$Data->CategoryID;
    $ExpenseUpdate->ShopID=$Data->ShopID;

    $ExpenseUpdate->ExpenseBy=$Data->ExpenseBy;
    $ExpenseUpdate->save();
    return redirect('/Expense/List');    
    
  }

  #Update Expense Category
  public function updateCategory($CategoryID, $CategoryName)
  {
    $Expense=ExpenseCategory::findOrFail($CategoryID);
    $Expense->CategoryName=$CategoryName;
    $Expense->save();
  }

  // Delete a Expense
  public function deleteExpense($ExpenseID)
  {
    try {
      Expense::findOrFail($ExpenseID)->delete();
      return redirect('/Expense/List');
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }

}
