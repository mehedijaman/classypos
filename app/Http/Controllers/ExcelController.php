<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use DB;
use Excel;
use ClassyPOS\Http\Requests;
use ClassyPOS\Http\Controllers\Controller;

use ClassyPOS\product\Product;
use ClassyPOS\product\ProductCategory;
use ClassyPOS\income_add;
use ClassyPOS\expense_add;

use ClassyPOS\supplier\Vendor;
use ClassyPOS\supplier\VendorBalance;
use ClassyPOS\supplier\VendorLedger;
use ClassyPOS\customer\Customer;
use ClassyPOS\customer\CustomerLedger;
use ClassyPOS\customer\CustomerBalance;
use ClassyPOS\shop\Shop;





class ExcelController extends Controller
{
    
  

  # Import Vendor from CSV
  public function getVendor()
  {

	return view('excel.VendorImport');
     }



     # Import Customer from CSV
    public function getCustomer()
     {

	     return view('excel.CustomerImport');
     }


     # Import Income from CSV
     public function getIncome()
     {

     	return view('excel.IncomeImport');
     }

     # Import Expense from CSV
      public function getExpense()
     {

      return view('excel.ExpenseImport');
     }



  

 

  # Insert Product To Database
  public function postProduct()
  {

    $path = Input::file('ProductSheet')->getRealPath();
    $Name=Input::file('ProductSheet')->getClientOriginalName();
    $array=explode('.',$Name);
    //return $array[1];
    if($array[1]=="csv")
    {
      $data = Excel::load($path, function($reader) {
      })->get();
      $num=count($data);


      for($i=0;$i<$num;$i++)
      {
        $result=[];
        $j=[];
        $j=$data[$i];
        foreach($j as $key=>$value)
        {
          array_push($result, $value);
        }
        //Searching Whether this CategoryName is new or not
        $SearchProductCategory=ProductCategory::where('CategoryName','=',$result[0])->get();
        //This is a new Category
        if(count($SearchProductCategory)==0)
        {
          $NewCategory=new ProductCategory();
          $NewCategory->CategoryName=$result[0];
          $NewCategory->save();
          $CategoryID =$NewCategory->CategoryID;
        }

        //This is an old Category

        if(count($SearchProductCategory)>0)
        {
          $CategoryID=$SearchProductCategory[0]->CategoryID;        
        }

        //Searching Whether this VendorName is new or not

        $SearchVendorName=Vendor::where('VendorName','=',$result[1])->get();

        //This is a new VendorName

        if(count($SearchVendorName)==0)
        {
          $NewVendor=new Vendor();
          $NewVendor->VendorName=$result[1];
          $NewVendor->save();
          $VendorID =$NewVendor->VendorID;
          $venbal = new VendorBalance();
          $venbal->VendorID = $VendorID;
          $venbal->Balance = 0;
          // Insert into vendor_balance table
          $venbal->save();
          // Inititalize vendor_vendor ledger model
          $venledger = new VendorLedger();
          // Listing into array to insert into vendor_ledger table
          $venledger->VendorID  = $VendorID;
          $venledger->InvoiceID = 0;
          $venledger->Debit     = 0;
          $venledger->Credit    = 0;       
          $venledger->Balance   = 0;
          // Insert into vendor_ledger table
          $venledger->save();
        }


        if(count($SearchVendorName)>0)
        {
          $VendorID=$SearchVendorName[0]->VendorID;        
        }
        $Total=Product::where('ProductName','=',$result[2])->get();
        //if(count($Total)==0)
        //{
        $add=new Product();
        //}
        //else
        //{
          //$add=Product::where('ProductName','=',$result[2])->first();
        //}
        //$add=Product::firstOrNew(['CategoryID'=>$result[0],'ProductName'=>$result[2]]);
        //$add=new Product();     
        $add->CategoryID=$CategoryID;
        $add->VendorID=$VendorID;
        $add->ProductName=$result[2];
        //$add->ProductDescription=$result[3];
        //$add->ProductImg=$result[4];
        $add->Qty=$result[3];
        $add->CostPrice=$result[4];
        $add->SalePrice=$result[5];
        //$add->PreferredPrice=$result[8];
        //$add->Unit=$result[9];
        $add->TaxCode=$result[6];
        $add->MinQtyLevel=$result[7];
     
        try{
          $add->save();
        }

        catch(\Exception $e){
          echo $e->getMessage();}

      }//End of For Loop
      
    }//End of csv file uploading

    if($array[1]=="xlsx")
    {
      $data = Excel::load($path, function($reader) {
      $reader->each(function ($row) {


            foreach($row as $key=>$value)
            {
            
              $CategoryName=$value->categoryname;
              $VendorName=$value->vendorname;
              $ProductName=$value->productname;
              $Qty=$value->qty;
              $CostPrice=$value->costprice;
              $SalePrice=$value->saleprice;
              $TaxCode=$value->taxcode;
              $MinQtyLevel=$value->minqtylevel;

              $SearchProductCategory=ProductCategory::where('CategoryName','=',$CategoryName)->get();
              //This is a new Category
              if(count($SearchProductCategory)==0)
              {
                $NewCategory=new ProductCategory();
                $NewCategory->CategoryName=$CategoryName;
                $NewCategory->save();
                $CategoryID =$NewCategory->CategoryID;
              }
              //This is an old Category
              if(count($SearchProductCategory)>0)
              {
                $CategoryID=$SearchProductCategory[0]->CategoryID;        
              }

              $SearchVendorName=Vendor::where('VendorName','=',$VendorName)->get();

              //This is a new VendorName

              if(count($SearchVendorName)==0)
              {
                $NewVendor=new Vendor();
                $NewVendor->VendorName=$VendorName;
                $NewVendor->save();
                $VendorID =$NewVendor->VendorID;
                $venbal = new VendorBalance();
                $venbal->VendorID = $VendorID;
                $venbal->Balance = 0;
                // Insert into vendor_balance table
                $venbal->save();
                // Inititalize vendor_vendor ledger model
                $venledger = new VendorLedger();
                // Listing into array to insert into vendor_ledger table
                $venledger->VendorID  = $VendorID;
                $venledger->InvoiceID = 0;
                $venledger->Debit     = 0;
                $venledger->Credit    = 0;       
                $venledger->Balance   = 0;
                // Insert into vendor_ledger table
                $venledger->save();
              }


              if(count($SearchVendorName)>0)
              {
                $VendorID=$SearchVendorName[0]->VendorID;        
              }

              //$Total=Product::where('ProductName','=',$ProductName)->get();
              //if(count($Total)==0)
              //{
                $Product=new Product();
              //}
              //else
              //{
               // $Product=Product::where('ProductName','=',$ProductName)->first();
              //}
              $Product->CategoryID=$CategoryID;
              $Product->VendorID=$VendorID;
              $Product->ProductName=$ProductName;
              $Product->Qty=$Qty;
              $Product->CostPrice=$CostPrice;
              $Product->SalePrice=$SalePrice;
              $Product->TaxCode=0;
              $Product->MinQtyLevel=$MinQtyLevel;
              $Product->save();

            }

            });
          })->get();


    }//End of xlsx file uploading

    $ali=$num." Products Added.";




    return Redirect::to('Product/New')->with('ProductInsertwithExcel',$ali);


    //return back()->withErrors(['msg', 'The Message']);   

     //return back()->with();
  }


 # Insert to Vendor To Database
  public function postVendor()
  {
    $path = Input::file('VendorSheet')->getRealPath();
    $data = Excel::load($path, function($reader) {

    })->get();



    $num=count($data);
    //echo $num."<br>";

  #echo $num;

  for($i=0;$i<$num;$i++)
  {
    //echo "<br>";
    //echo "<h1>Record number".$i."</h1>";
    $result=[];
    $j=[];
    $j=$data[$i];
    foreach($j as $key=>$value)
    {
      echo "<br>";
      array_push($result, $value);
    }

    $add=Vendor::firstOrNew(['VendorName'=>$result[0],'ContactName'=>$result[1]]);
    $add->Address=$result[2];
    $add->City=$result[3];
    //$add->Province=$result[4];
    //$add->ZipCode=$result[5];
    $add->Country=$result[4];
    $add->Phone1=$result[5];
    //$add->Phone2=$result[8];
    //$add->Fax=$result[9];
    $add->Email=$result[6];
    //$add->Website=$result[11];
    //$add->VendorImg=$result[12];
    $add->save();

    $VendorID=$add->VendorID;


    $VendorBalance = VendorBalance::firstOrNew(['VendorID'=>$VendorID]);

      // collecting data for Vendor Balance insert
      $VendorBalance['VendorID'] = $VendorID;
      $VendorBalance['Balance']  = 0;
      // insert Vendor Balance 
      $VendorBalance->save();


      $VendorLedger = VendorLedger::firstOrNew(['VendorID'=>$VendorID]);
      // collecting data for CustomerLedger
      $VendorLedger['VendorID'] = $VendorID;
      $VendorLedger['InvoiceID']  = 0;
      $VendorLedger['Debit']      = 0;
      $VendorLedger['Credit']     = 0;
      $VendorLedger['Balance']    = 0;
      // insert into CustomerLedger Table
      $VendorLedger->save();
  }


  return back();


  }

 # Insert to Customer To Database

  public function postCustomer()
  {

    $path = Input::file('CustomerSheet')->getRealPath();

    $data = Excel::load($path, function($reader) {

    })->get();

    //return $data[0];

    $num=count($data);

    for($i=0;$i<$num;$i++)
    {
      echo "<br>";
      
      $result=[];
      $j=[];
      $j=$data[$i];
      foreach($j as $key=>$value)
      {
        echo "<br>";
        array_push($result, $value);
      }
      $add=Customer::firstOrNew(['ShopID'=>$result[0],'FirstName'=>$result[1]]);
      $add->LastName=$result[2];
      $add->Address=$result[3];
      $add->City=$result[4];
      $add->Province=$result[5];
      $add->ZipCode=$result[6];
      $add->Country=$result[7];
      $add->Phone=$result[8];
      $add->Email=$result[9];
      //$newformat = date('Y-m-d',$result[10]);
      //$add->DateOfBirth=$result[10];
      $add->Notes=$result[11];
      $add->CustomerImg=$result[12];
      $add->save();      

      $CustomerID= $add->CustomerID;


      $CustomerBalance = CustomerBalance::firstOrNew(['CustomerID'=>$CustomerID]);

      // collecting data for Customer Balance insert
      $CustomerBalance['CustomerID'] = $CustomerID;
      $CustomerBalance['Balance']    = 0;
      // insert Customer Balance 
      $CustomerBalance->save();

      // CustomerLedger Object
      $CustomerLedger = CustomerLedger::firstOrNew(['CustomerID'=>$CustomerID]);
      // collecting data for CustomerLedger
      $CustomerLedger['CustomerID'] = $CustomerID;
      $CustomerLedger['InvoiceID']  = 0;
      $CustomerLedger['Debit']      = 0;
      $CustomerLedger['Credit']     = 0;
      $CustomerLedger['Balance']    = 0;
      // insert into CustomerLedger Table
      $CustomerLedger->save();



    }


    return redirect('Customer/List');



  }


              # Insert to Income To Database
             public function postIncome()
             {
                    $path = Input::file('income')->getRealPath();

            $data = Excel::load($path, function($reader) {

            })->get();



             $num=count($data);



                   for($i=0;$i<$num;$i++)
                   {
                    echo "<br>";


                    echo "<h1>Record number".$i."</h1>";

                    $result=[];

                     $j=[];

                   $j=$data[$i];


                   foreach($j as $key=>$value)
                   {
                     echo "<br>";

                          array_push($result, $value);

                    
                   }
                   $add=income_add::firstOrNew(['CategoryID'=>$result[0],'ShopID'=>$result[1]]);

                    $add->AccountName=$result[2];

                    $add->Amount=$result[3];

                    $add->IncomeDate=$result[4];


     
                   $add->Notes=$result[5];

                   
        
                   $add->save();
               }


                   return redirect('Dashboard');








                         
             }


              # Insert to Expense To Database
             public function postExpense()
             {


                    $path = Input::file('expense')->getRealPath();

            $data = Excel::load($path, function($reader) {

            })->get();



             $num=count($data);



                   for($i=0;$i<$num;$i++)
                   {
                    echo "<br>";


                    #echo "<h1>Record number".$i."</h1>";

                    $result=[];

                     $j=[];

                   $j=$data[$i];


                   foreach($j as $key=>$value)
                   {
                     echo "<br>";

                          array_push($result, $value);

                    
                   }
                   $add=expense_add::firstOrNew(['CategoryID'=>$result[0],'ShopID'=>$result[1]]);

                    $add->ExpenseDate=$result[2];

                    $add->Amount=$result[3];

                    $add->ExpenseBy=$result[4];


     
                   $add->Notes=$result[5];

                   
        
                   $add->save();
               }


                   return redirect('dashboard');


             }


             # Export Product to CSV
             public function exportproduct()
             {




                $ven=vendor_new::all();





                           $all=DB::table('product')
                          ->join('vendor', 'product.VendorID', '=', 'vendor.VendorID')
                          ->join('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')->select('product.ProductID','product_category.CategoryName','vendor.VendorName','product.ProductName','product.CostPrice','product.SalePrice')

          
                            ->get();


                            #return $all;


                            foreach($all as $product) {
                 $data[] = array(
                    $product->ProductID,
                    $product->CategoryName,
                    $product->VendorName,
                    $product->ProductName,
                    $product->CostPrice,
                    $product->SalePrice

                );
            }

                              
                    Excel::create('product report',function($excel) use($data)
                     
                     {

                         

                      $excel->sheet('sheet 1',function($sheet) use($data)
                      {
                                
                                 $sheet->fromArray($data,null,'A1',false,false);



                                 $headings = array('Product_ID', 'CategoryName', 'VendorName', 'ProductName', 'CostPrice','SalePrice');

                                 $sheet->prependRow(1, $headings);


                      });




                     })->download('csv');
             }





              
            # Export Vendor to CSV
              public function exportVendor()
                


                {


                     
                    
                    $all=vendor_new::all();
                    Excel::create('vendor report',function($excel) use($all)
                     
                     {

                         $excel->setTitle('vendor list');
       
        $excel->setDescription('vendor file');

                      $excel->sheet('sheet 1',function($sheet) use ($all)
                      {
                                

                                $sheet->fromArray($all);


                      });




                     })->download('xlsx');

             }



                          public function exportshop()
             {
                     
                    
                    $all=shop_new::all();
                    Excel::create('shop report',function($excel) use($all)
                     
                     {

                         $excel->setTitle('shop list');
       
                      $excel->setDescription('shop file');

                      $excel->sheet('sheet 1',function($sheet) use ($all)
                      {
                                

                                $sheet->fromArray($all);


                      });




                     })->download('xlsx');
             }  


}
