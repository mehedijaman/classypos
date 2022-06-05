<?php
namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;

use ClassyPOS\accounts\income\Income;
use ClassyPOS\accounts\income\IncomeCategory;
use ClassyPOS\shop\Shop;



class IncomeController extends Controller
{

  # Load Income Category create view
  public function createCategory()
  {
    $CategoryList = IncomeCategory::all();      

    return view('accounts.income.category',compact('CategoryList'));      
  }

  # Load Income Create view
  public function createIncome()
  {     
    $CategoryList = IncomeCategory::all(); 

    $ShopList = Shop::all();

    return view('accounts.income.new',compact('CategoryList','ShopList'));
  }


  # Store Income 
  public function storeIncome(Request $Data) 
  {

    try {
      $FormData = $Data->all();

      $Income = new Income;  

      $Income->CategoryID   = $FormData['CategoryID'];
      $Income->ShopID       = $FormData['ShopID'];
      $Income->Amount       = $FormData['Amount'];
      $Income->AccountName  = $FormData['AccountName'];
      $Income->Notes        = $FormData['Notes'];
        

      $Income->save();

      return redirect('/Income/New');
      
    } catch (\Exception $e) {
      echo $e->getMessage();
      // return redirect('/Income/New', compact('ErrorMsg'));
    }
  }

  
  # Store Income Category
  public function storeCategory(Request $Data)
  {
    $FormData= $Data->all(); 

    $Category = new IncomeCategory();

    $Category['CategoryName']=$FormData['CategoryName'];        

    $Category->save();

    return redirect('/Income/Category');    

  }


  # Load Income Edit View
  public function editIncome($IncomeID)
  {

    $IncomeCategory=IncomeCategory::all();
    $Shop=Shop::all();
    $IncomeEdit=Income::where('IncomeID','=',$IncomeID)->get()->first();

    return view('accounts.income.edit',compact('IncomeEdit','IncomeCategory','Shop'));    
  }

  # Load Income Category Edit View
  public function editCategory($id)
  {
    # code...
  }

    #Update Category
  public function updateCategory($CategoryID,$CategoryName)
  {
    $IncomeCategory=IncomeCategory::findOrFail($CategoryID);
    $IncomeCategory->CategoryName=$CategoryName;
    $IncomeCategory->save();
    return "Success";

  }



  #Update Income
  public function updateIncome(Request $Data, $IncomeID)
  {

    $IncomeUpdate=Income::where('IncomeID','=',$IncomeID)->get()->first();

    $IncomeUpdate->Amount=$Data->Amount;
    $IncomeUpdate->ShopID=$Data->ShopID;
    $IncomeUpdate->CategoryID=$Data->CategoryID;
    //$IncomeUpdate->Amount=1000;
    $IncomeUpdate->Notes=$Data->Notes;
    $IncomeUpdate->AccountName=$Data->AccountName;
    $IncomeUpdate->save();
    return redirect('/Income/List');    
  }

 

  # Show Income Category List
  public function listCategory()
  {
    # code...
  }

  #Show Income List
  public function listIncome()
  {
    $Income = new Income;

    $IncomeList = $Income->listIncome();

    return view('accounts.income.list', compact('IncomeList'));
  }

  // Delete a Income
  public function deleteIncome($IncomeID)
  {
    try {
      Income::findOrFail($IncomeID)->delete();
      return redirect('/Income/List');
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }


}
