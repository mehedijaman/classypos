<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;

use ClassyPOS\shop\Shop;
use ClassyPOS\supplier\Vendor;
use ClassyPOS\user\User;

use ClassyPOS\product\Product;
use ClassyPOS\product\ProductCategory;
use ClassyPOS\purchase\PurchaseInvoiceProductMapping;
use ClassyPOS\shop\ShopProductMapping;
use ClassyPOS\sales\InvoiceProductMapping;
use DB;


class ReportController extends Controller
{

  public function index()
  {
    return view('report.index');
  }

  public function salesReport()
  {
      $ShopList = Shop::all();
      $CategoryList = ProductCategory::all();
      $VendorList = Vendor::all();
      $UserList = User::all();

      return view('report.sales.index', compact('ShopList', 'CategoryList', 'VendorList', 'UserList'));
  }

  /*************************** Product Report ************************/
  public function product($ShopID,$CategoryID,$VendorID,$DateFrom,$DateTo,$Quantity)
  {

    $start  = date("Y/m/d",strtotime($DateFrom));            
    $end    = date("Y/m/d",strtotime($DateTo));
    $endreal= date("Y/m/d",strtotime($DateTo."+1 day"));

    $ReportName="Product Report";
    $ShopName="Main Stock";

    $fahad= DB::select("SELECT product.ProductName,product.ProductID,product.created_at from product where product.created_at <='$endreal'");
    
    // 00000
    if($ShopID==0 && $CategoryID == 0 && $VendorID==0 && $DateFrom==0 && $DateTo==0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];

      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where product.Qty<=$Quantity");



      //$this->productReport($TotalProduct);

      //return $abc;

      //Find out the different attributes of these products
      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }

      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product
        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product
        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");

        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");
        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;

        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;


        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }

      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalStockQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];
        //$TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        
      }




    }

    //00001
    if($ShopID==0 && $CategoryID==0 && $VendorID==0 && $DateFrom==0 && $DateTo!=0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID WHERE product.created_at<='$endreal' AND product.Qty<=$Quantity");

      //return $TotalProduct;

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);


      }
      $Total=count($TotalProductID);

        

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product
        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product
        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");

        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");


        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;


        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);

        $TotalWastedQuantity=0;
        $TotalSoldQuantity=0;
        $TotalPurchasedQuantity=0;
        $TotalCostPriceValue=0;
        $TotalSalePriceValue=0;
        $TotalStockQuantity=0;
        $TotalRefundedQuantity=0;
      }

        for($i=0;$i<$Total;$i++)
        {
          $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
          $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
          $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
          $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];

          $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
          $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
          $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


        }
      
    }

    //00010
    if($ShopID==0 && $CategoryID==0 && $VendorID==0 && $DateFrom!=0 && $DateTo==0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID WHERE product.created_at >='$DateFrom'AND product.Qty<=$Quantity");

      //return $TotalProduct;

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product
        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product
        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");


        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;

        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;

        //\Total Sale Calculation
        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);

      }

        $TotalWastedQuantity=0;
        $TotalSoldQuantity=0;
        $TotalPurchasedQuantity=0;
        $TotalCostPriceValue=0;
        $TotalSalePriceValue=0;
        $TotalStockQuantity=0;
        $TotalRefundedQuantity=0;

        for($i=0;$i<$Total;$i++)
        {
          $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
          $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
          $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
          $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];

          $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
          $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
          $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];

        }
      
    }

    //00011
    if($ShopID==0 && $CategoryID==0 && $VendorID==0 && $DateFrom!=0 && $DateTo!=0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,product.created_at,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID WHERE product.created_at>='$DateFrom' and product.created_at <='$endreal'AND product.Qty<=$Quantity");

      //return $TotalProduct;

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }

      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product

        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        
        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;


        //\Total Sale Calculation
        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
        
      }

        $TotalWastedQuantity=0;
        $TotalSoldQuantity=0;
        $TotalPurchasedQuantity=0;
        $TotalStockQuantity=0;
        $TotalCostPriceValue=0;
        $TotalSalePriceValue=0;
        $TotalStockQuantity=0;
        $TotalRefundedQuantity=0;

        for($i=0;$i<$Total;$i++)
        {
          $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
          $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
          $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
          $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];
          //$TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
          $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
          $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
          $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
          
        }
      
    }

    //00100    
    if($ShopID==0 && $CategoryID==0 && $VendorID>0 && $DateFrom==0 && $DateTo==0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where product.VendorID=$VendorID AND product.Qty<=$Quantity");





      //Find out the different attributes of these products
      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }



      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product
        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");



        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;     

        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;



        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);

      }



        

        $TotalWastedQuantity=0;
        $TotalSoldQuantity=0;
        $TotalPurchasedQuantity=0;
        $TotalCostPriceValue=0;
        $TotalSalePriceValue=0;
        $TotalStockQuantity=0;
        $TotalRefundedQuantity=0;

        for($i=0;$i<$Total;$i++)
        {
          $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
          $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
          $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
          $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];

          $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
          $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
          $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


        }
      
    }

    //00101  
    if($ShopID==0 && $CategoryID==0 && $VendorID>0 && $DateFrom==0 && $DateTo!=0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where product.VendorID=$VendorID and product.created_at<='$endreal' AND product.Qty<=$Quantity");


      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product
        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        

        //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }

        $TotalWastedQuantity=0;
        $TotalSoldQuantity=0;
        $TotalPurchasedQuantity=0;
        $TotalCostPriceValue=0;
        $TotalSalePriceValue=0;
        $TotalStockQuantity=0;
        $TotalRefundedQuantity=0;

        for($i=0;$i<$Total;$i++)
        {
          $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
          $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
          $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
          $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
          $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
          $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
          $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];



        }
    }

    //00110    
    if($ShopID==0 && $CategoryID==0 && $VendorID>0 && $DateFrom!=0 && $DateTo==0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where product.VendorID=$VendorID and product.created_at>='$DateFrom' AND product.Qty<=$Quantity");
      

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product
        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;

        
        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }

      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];



      }
    }

    //00111    
    if($ShopID==0 && $CategoryID==0 && $VendorID>0 && $DateFrom!=0 && $DateTo!=0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where product.VendorID=$VendorID and product.created_at>='$DateFrom' and product.created_at<='$DateTo' AND product.Qty<=$Quantity");
      

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product
        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");



        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
        $TotalWastedQuantity=0;
        $TotalSoldQuantity=0;
        $TotalPurchasedQuantity=0;
        $TotalCostPriceValue=0;
        $TotalSalePriceValue=0;
        $TotalStockQuantity=0;
        $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }

    }

    //01000    
    if($ShopID==0 && $CategoryID>0 && $VendorID==0 && $DateFrom==0 && $DateTo==0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      //Get All The products according to search

      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where product.CategoryID=$CategoryID AND product.Qty<=$Quantity");

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product
        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");



        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

              
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }

      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];



      }

    }

    //01001    
    if($ShopID==0 && $CategoryID>0 && $VendorID==0 && $DateFrom==0 && $DateTo!=0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];



      //Get All The products according to search

      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where product.CategoryID=$CategoryID and product.created_at<='$endreal' AND product.Qty<=$Quantity");

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation
        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
        $TotalWastedQuantity=0;
        $TotalSoldQuantity=0;
        $TotalPurchasedQuantity=0;
        $TotalCostPriceValue=0;
        $TotalSalePriceValue=0;
        $TotalStockQuantity=0;
        $TotalStockQuantity=0;
        $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];



      }
      
    }

    //01010    
    if($ShopID==0 && $CategoryID>0 && $VendorID==0 && $DateFrom!=0 && $DateTo==0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];



      //Get All The products according to search
      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where product.CategoryID=$CategoryID and product.created_at>='$DateFrom' AND product.Qty<=$Quantity");

      //Find out the different attributes of these products
      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product
        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //01011  
    if($ShopID==0 && $CategoryID>0 && $VendorID==0 && $DateFrom!=0 && $DateTo!=0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];



      //Get All The products according to search

      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where product.CategoryID=$CategoryID and product.created_at>='$DateFrom' and product.created_at<='$endreal' AND product.Qty<=$Quantity");

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product
        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
       

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //01100    
    if($ShopID==0 && $CategoryID>0 && $VendorID>0 && $DateFrom==0 && $DateTo==0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];



      //Get All The products according to search

      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where product.CategoryID=$CategoryID and product.VendorID=$VendorID AND product.Qty<=$Quantity");

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product
        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation
        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //01101    
    if($ShopID==0 && $CategoryID>0 && $VendorID>0 && $DateFrom==0 && $DateTo!=0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];



      //Get All The products according to search

      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where product.CategoryID=$CategoryID and product.VendorID=$VendorID and product.created_at<='$endreal' AND product.Qty<=$Quantity");

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product
        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");


        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation
        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //01110    
    if($ShopID==0 && $CategoryID>0 && $VendorID>0 && $DateFrom!=0 && $DateTo==0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];



      //Get All The products according to search

      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where product.CategoryID=$CategoryID and product.VendorID=$VendorID and product.created_at>='$DateTo' AND product.Qty<=$Quantity");

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation
        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //01111    
    if($ShopID==0 && $CategoryID>0 && $VendorID>0 && $DateFrom!=0 && $DateTo!=0)
    {
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];



      //Get All The products according to search

      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,product.Qty,product_category.CategoryName,vendor.VendorName from product INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where product.CategoryID=$CategoryID and product.VendorID=$VendorID and product.created_at<='$endreal' and product.created_at>='$DateTo' AND product.Qty<=$Quantity");

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=0 group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //10000
    if($ShopID>0 && $CategoryID==0 && $VendorID==0 && $DateFrom==0 && $DateTo==0)
    {


      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;

      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID AND shop_product_mapping.Qty<=$Quantity group by shop_product_mapping.ProductID");

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }

      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");


        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
        $TotalWastedQuantity=0;
        $TotalSoldQuantity=0;
        $TotalPurchasedQuantity=0;
        $TotalCostPriceValue=0;
        $TotalSalePriceValue=0;
        $TotalStockQuantity=0;
        $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //10001
    if($ShopID>0 && $CategoryID==0 && $VendorID==0 && $DateFrom==0 && $DateTo!=0)
    {


      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;

      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID and shop_product_mapping.created_at<='$endreal'AND shop_product_mapping.Qty<=$Quantity group by shop_product_mapping.ProductID");

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }

      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation
        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //10010
    if($ShopID>0 && $CategoryID==0 && $VendorID==0 && $DateFrom!=0 && $DateTo==0)
    {


      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;

      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID and shop_product_mapping.created_at>='$DateFrom' AND shop_product_mapping.Qty<=$Quantity group by shop_product_mapping.ProductID");

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }

      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
        $TotalWastedQuantity=0;
        $TotalSoldQuantity=0;
        $TotalPurchasedQuantity=0;
        $TotalCostPriceValue=0;
        $TotalSalePriceValue=0;
        $TotalStockQuantity=0;
        $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //10011
    if($ShopID>0 && $CategoryID==0 && $VendorID==0 && $DateFrom!=0 && $DateTo!=0)
    {

      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;

      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID and shop_product_mapping.created_at>='$DateFrom' and shop_product_mapping.created_at<='$endreal' AND shop_product_mapping.Qty<=$Quantity group by shop_product_mapping.ProductID");

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      
      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product
        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product
        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
        $TotalWastedQuantity=0;
        $TotalSoldQuantity=0;
        $TotalPurchasedQuantity=0;
        $TotalCostPriceValue=0;
        $TotalSalePriceValue=0;
        $TotalStockQuantity=0;
        $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //10100
    if($ShopID>0 && $CategoryID==0 && $VendorID>0 && $DateFrom==0 && $DateTo==0)
    {

      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID AND product.VendorID=$VendorID AND shop_product_mapping.Qty<=$Quantity group by shop_product_mapping.ProductID");

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
    


      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //10101
    if($ShopID>0 && $CategoryID==0 && $VendorID>0 && $DateFrom==0 && $DateTo!=0)
    {
      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID AND product.VendorID=$VendorID and shop_product_mapping.created_at<='$endreal' AND shop_product_mapping.Qty<=$Quantity group by shop_product_mapping.ProductID");

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      
      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
        

      }
        $TotalWastedQuantity=0;
        $TotalSoldQuantity=0;
        $TotalPurchasedQuantity=0;
        $TotalCostPriceValue=0;
        $TotalSalePriceValue=0;
        $TotalStockQuantity=0;
        $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //10110
    if($ShopID>0 && $CategoryID==0 && $VendorID>0 && $DateFrom!=0 && $DateTo==0)
    {

      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID AND product.VendorID=$VendorID and shop_product_mapping.created_at>='$DateFrom'AND shop_product_mapping.Qty<=$Quantity group by shop_product_mapping.ProductID");

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }

      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //10111
    if($ShopID>0 && $CategoryID==0 && $VendorID>0 && $DateFrom!=0 && $DateTo!=0)
    {

      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID AND product.VendorID=$VendorID and shop_product_mapping.created_at>='$DateFrom' and shop_product_mapping.created_at<='$endreal'AND shop_product_mapping.Qty<=$Quantity group by shop_product_mapping.ProductID");

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      
      $Total=count($TotalProductID);

      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //11000
    if($ShopID>0 && $CategoryID>0 && $VendorID==0 && $DateFrom==0 && $DateTo==0)
    {

      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID AND product.CategoryID=$CategoryID group by shop_product_mapping.ProductID");


      

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }

      $Total=count($TotalProductID);



      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }  

    //11001
    if($ShopID>0 && $CategoryID>0 && $VendorID==0 && $DateFrom==0 && $DateTo!=0)
    {

      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID AND product.CategoryID=$CategoryID and shop_product_mapping.created_at<='$endreal' AND shop_product_mapping.Qty<=$Quantity group by shop_product_mapping.ProductID");


      

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      $Total=count($TotalProductID);



      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation


        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }

      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //11010
    if($ShopID>0 && $CategoryID>0 && $VendorID==0 && $DateFrom!=0 && $DateTo==0)
    {

      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID AND product.CategoryID=$CategoryID and shop_product_mapping.created_at>='$DateFrom' AND shop_product_mapping.Qty<=$Quantity group by shop_product_mapping.ProductID");


      

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      $Total=count($TotalProductID);



      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");

        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //11011
    if($ShopID>0 && $CategoryID>0 && $VendorID==0 && $DateFrom!=0 && $DateTo!=0)
    {

      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID AND product.CategoryID=$CategoryID and shop_product_mapping.created_at<='$endreal' and shop_product_mapping.created_at>='$DateFrom'AND shop_product_mapping.Qty<=$Quantity group by shop_product_mapping.ProductID");


      

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
      $Total=count($TotalProductID);



      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");
        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //11100
    if($ShopID>0 && $CategoryID>0 && $VendorID>0 && $DateFrom==0 && $DateTo==0)
    {

      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID AND product.CategoryID=$CategoryID AND product.VendorID=$VendorID AND shop_product_mapping.Qty<=$Quantity group by shop_product_mapping.ProductID");     

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
     $Total=count($TotalProductID);



      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");
        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //11101
    if($ShopID>0 && $CategoryID>0 && $VendorID>0 && $DateFrom==0 && $DateTo!=0)
    {

      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID AND product.CategoryID=$CategoryID AND product.VendorID=$VendorID and product.created_at<='$endreal' AND shop_product_mapping.Qty<=$Quantity group by shop_product_mapping.ProductID");     

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
     $Total=count($TotalProductID);



      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");
        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation
        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //11110
    if($ShopID>0 && $CategoryID>0 && $VendorID>0 && $DateFrom!=0 && $DateTo==0)
    {

      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID AND product.CategoryID=$CategoryID AND product.VendorID=$VendorID and product.created_at>='$DateFrom' AND shop_product_mapping.Qty<=$Quantity group by shop_product_mapping.ProductID");     

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
     $Total=count($TotalProductID);



      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");
        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation
        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);
      }
      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

    //11111
    if($ShopID>0 && $CategoryID>0 && $VendorID>0 && $DateFrom!=0 && $DateTo!=0)
    {

      $shop=Shop::findOrFail($ShopID);
      $ShopName=$shop->ShopName;
      $TotalProductID=[];
      $TotalProductName=[];
      $TotalSalePrice=[];
      $TotalCostPrice=[];
      $TotalCategoryName=[];
      $TotalVendorName=[];
      $TotalStock=[];
      $Wasted=[];
      $Purchase=[];
      $Sold=[];
      $Refunded=[];


      $TotalProduct=DB::select("SELECT product.ProductName,vendor.VendorName,product.ProductID,product.SalePrice,product.CostPrice,sum(shop_product_mapping.Qty)as Qty,product_category.CategoryName,vendor.VendorName from shop_product_mapping INNER JOIN product ON shop_product_mapping.ProductID=product.ProductID  INNER JOIN vendor ON product.VendorID=vendor.VendorID INNER JOIN product_category ON product.CategoryID=product_category.CategoryID where shop_product_mapping.ShopID=$ShopID AND product.CategoryID=$CategoryID AND product.VendorID=$VendorID AND product.created_at>='$DateFrom' AND product.created_at<='$endreal' AND shop_product_mapping.Qty<=$Quantity group by shop_product_mapping.ProductID");     

      //Find out the different attributes of these products

      foreach($TotalProduct as $Data)
      {
        array_push($TotalProductID,$Data->ProductID);
        array_push($TotalProductName,$Data->ProductName);
        array_push($TotalSalePrice,$Data->SalePrice);
        array_push($TotalCostPrice,$Data->CostPrice);
        array_push($TotalCategoryName,$Data->CategoryName);
        array_push($TotalVendorName,$Data->VendorName);
        array_push($TotalStock,$Data->Qty);
      }
     $Total=count($TotalProductID);



      for($i=0;$i<count($TotalProductID);$i++)
      {
        //Get the number of wasted products for each product
        $TotalWaste=DB::select("SELECT product.ProductName,vendor.VendorName,sum(waste.Qty)as totalwasted from waste INNER JOIN product on product.ProductID=waste.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and waste.ShopID=$ShopID group by waste.ProductID ");

        //Get the number of Purchased products for each product

        $TotalPurchase=DB::select("SELECT product.ProductName,vendor.VendorName,sum(purchase_invoice_product_mapping.Qty)as purchased from purchase_invoice_product_mapping INNER JOIN product on product.ProductID=purchase_invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by purchase_invoice_product_mapping.ProductID");

        //Get the number of Sold products for each product

        $TotalSale=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_mapping.Qty)as sold from invoice_product_mapping INNER JOIN product on product.ProductID=invoice_product_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i] and invoice_product_mapping.ShopID=$ShopID  group by invoice_product_mapping.ProductID");

        //Get the number of refunded products for each product        
        $TotalRefund=DB::select("SELECT product.ProductName,vendor.VendorName,sum(invoice_product_refund_mapping.Qty)as refunded from invoice_product_refund_mapping INNER JOIN product on product.ProductID=invoice_product_refund_mapping.ProductID INNER JOIN vendor ON product.VendorID=vendor.VendorID where product.ProductID=$TotalProductID[$i]  group by invoice_product_refund_mapping.ProductID");
        
        //TotalWaste Calculation
        if(count($TotalWaste)==0)      
          $WasteQuantity=0;
        else
          $WasteQuantity=$TotalWaste[0]->totalwasted;

        //\TotalWaste Calculation
        
        //Total Purchase Calculation
        if(count($TotalPurchase)==0)      
          $PurchaseQuantity=0;
        else
          $PurchaseQuantity=$TotalPurchase[0]->purchased;
        //\Total Purchase Calculation

         //Total Sale Calculation
        if(count($TotalSale)==0)      
          $SoldQuantity=0;
        else
          $SoldQuantity=$TotalSale[0]->sold;
        //\Total Sale Calculation

        //Total Refund Calculation
        if(count($TotalRefund)==0)      
          $RefundQuantity=0;
        else
          $RefundQuantity=$TotalRefund[0]->refunded;
        //\Total Refund Calculation

        array_push($Wasted,$WasteQuantity);
        array_push($Purchase,$PurchaseQuantity);
        array_push($Sold,$SoldQuantity);
        array_push($Refunded,$RefundQuantity);

      }

      $TotalWastedQuantity=0;
      $TotalSoldQuantity=0;
      $TotalPurchasedQuantity=0;
      $TotalCostPriceValue=0;
      $TotalSalePriceValue=0;
      $TotalStockQuantity=0;
      $TotalRefundedQuantity=0;

      for($i=0;$i<$Total;$i++)
      {
        $TotalWastedQuantity=$TotalWastedQuantity+$Wasted[$i];
        $TotalSoldQuantity=$TotalSoldQuantity+$Sold[$i];
        $TotalPurchasedQuantity=$TotalPurchasedQuantity+$Purchase[$i];
        $TotalCostPriceValue=$TotalCostPriceValue+$TotalCostPrice[$i];
        $TotalSalePriceValue=$TotalSalePriceValue+$TotalSalePrice[$i];
        $TotalStockQuantity=$TotalStockQuantity+$TotalStock[$i];
        $TotalRefundedQuantity=$TotalRefundedQuantity+$Refunded[$i];


      }
    }

      

    return view('product.report.print',compact('ReportName','ShopID','ShopName','DateFrom','DateTo','TotalProductID','TotalProductName','TotalSalePrice','TotalCostPrice','TotalCategoryName','TotalVendorName','TotalStock','Wasted','Purchase','Sold','Total','TotalWastedQuantity','TotalSoldQuantity','TotalPurchasedQuantity','TotalStockQuantity','TotalSalePriceValue','TotalCostPriceValue','Refunded','TotalRefundedQuantity'));       
  }

  /*************************** Sales Report ************************/
  public function sales($ReportName, $ShopID, $CategoryID, $VendorID, $UserID, $DateFrom, $DateTo)
  {
    if ($DateFrom == 0) {
      $DateFrom = '2000-01-01';
    }

    if ($DateTo == 0) {
      $DateTo = date('Y-m-d');
    }
    else
      $DateTo = date('Y-m-d', strtotime($DateTo));


    switch ($ReportName) {
      case 'ProdutWise':
        $ReportName = 'Product Wise Sales Report';

        // 0000
        if ($ShopID == 0 && $CategoryID == 0 && $VendorID == 0 && $UserID == 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE DATE(invoice_product_mapping.created_at) BETWEEN '$DateFrom' AND '$DateTo' 

            ORDER BY InvoiceID ASC
            "
          );
        }

        // 0001
        if ($ShopID == 0 && $CategoryID == 0 && $VendorID == 0 && $UserID != 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.UserID = $UserID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 0010
        if ($ShopID == 0 && $CategoryID == 0 && $VendorID != 0 && $UserID == 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE product.VendorID = $VendorID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 0011
        if ($ShopID == 0 && $CategoryID == 0 && $VendorID != 0 && $UserID != 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.UserID = $UserID AND product.VendorID = $VendorID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 0100
        if ($ShopID == 0 && $CategoryID != 0 && $VendorID == 0 && $UserID == 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE product.CategoryID = $CategoryID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 0101
        if ($ShopID == 0 && $CategoryID != 0 && $VendorID == 0 && $UserID != 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE product.CategoryID = $CategoryID AND invoice_product_mapping.UserID = $UserID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 0110
        if ($ShopID == 0 && $CategoryID != 0 && $VendorID != 0 && $UserID == 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE product.CategoryID = $CategoryID AND product.VendorID = $VendorID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 0111
        if ($ShopID == 0 && $CategoryID != 0 && $VendorID != 0 && $UserID != 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE product.CategoryID = $CategoryID AND product.VendorID = $VendorID AND invoice_product_mapping.UserID = $UserID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1000
        if ($ShopID != 0 && $CategoryID == 0 && $VendorID == 0 && $UserID == 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1001
        if ($ShopID != 0 && $CategoryID == 0 && $VendorID == 0 && $UserID != 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.UserID = $UserID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1010
        if ($ShopID != 0 && $CategoryID == 0 && $VendorID != 0 && $UserID == 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND product.VendorID = $VendorID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1000
        if ($ShopID != 0 && $CategoryID == 0 && $VendorID != 0 && $UserID != 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND product.VendorID = $VendorID AND invoice_product_mapping.UserID = $UserID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1100
        if ($ShopID != 0 && $CategoryID != 0 && $VendorID == 0 && $UserID == 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND product.CategoryID = $CategoryID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1101
        if ($ShopID != 0 && $CategoryID != 0 && $VendorID == 0 && $UserID != 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND product.CategoryID = $CategoryID AND invoice_product_mapping.UserID = $UserID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1110
        if ($ShopID != 0 && $CategoryID != 0 && $VendorID != 0 && $UserID == 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND product.CategoryID = $CategoryID AND product.VendorID = $VendorID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1111
        if ($ShopID != 0 && $CategoryID != 0 && $VendorID != 0 && $UserID != 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND product.CategoryID = $CategoryID AND product.VendorID = $VendorID AND invoice_product_mapping.UserID = $UserID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // Calculate number of rows in Report
        $Length = count($Report);

        // initialize the variables
        $TotalQty          = 0; 
        $TotalCostPrice    = 0;
        $TotalSalePrice    = 0;
        $TotalDiscount     = 0;
        $TotalTax          = 0;
        $NetTotalSalePrice = 0;
        $TotalProfitAmount = 0;

        for($Counter = 0; $Counter < $Length; $Counter++)
        {
          $TotalQty         += $Report[$Counter]->Qty; 
          $TotalCostPrice   += $Report[$Counter]->CostPrice;
          $TotalSalePrice   += $Report[$Counter]->Price;
          $TotalDiscount    += $Report[$Counter]->Discount;
          $TotalTax         += $Report[$Counter]->TaxTotal;
          $NetTotalSalePrice+= $Report[$Counter]->TotalPrice; 
          $TotalProfitAmount+= $Report[$Counter]->TotalPrice - $Report[$Counter]->TaxTotal - $Report[$Counter]->Discount - ($Report[$Counter]->CostPrice);
        }

        if($NetTotalSalePrice == 0)
          $TotalProfitPercent = 0;
        else
          $TotalProfitPercent = ($TotalProfitAmount / ($NetTotalSalePrice - $TotalTax)) * 100;


        return view('report.sales.productwise', compact('Report', 'ReportName', 'DateFrom', 'DateTo', 'ShopName', 'TotalQty','TotalCostPrice', 'TotalSalePrice', 'TotalDiscount','TotalTax' ,'NetTotalSalePrice','TotalProfitAmount', 'TotalProfitPercent'));
        break;

      case 'CategoryWise':
        $ReportName = 'Product Wise Sales Report';

        // 0000
        if ($ShopID == 0 && $CategoryID == 0 && $VendorID == 0 && $UserID == 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT COUNT(invoice_product_mapping.Qty) AS Qty,
            product_category.CategoryName

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID           

            WHERE DATE(invoice_product_mapping.created_at) BETWEEN '$DateFrom' AND '$DateTo'

            GROUP BY product.CategoryID

            ORDER BY product.CategoryID ASC
            "
          );
        }

        // 0001
        if ($ShopID == 0 && $CategoryID == 0 && $VendorID == 0 && $UserID != 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.UserID = $UserID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 0010
        if ($ShopID == 0 && $CategoryID == 0 && $VendorID != 0 && $UserID == 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE product.VendorID = $VendorID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 0011
        if ($ShopID == 0 && $CategoryID == 0 && $VendorID != 0 && $UserID != 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.UserID = $UserID AND product.VendorID = $VendorID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 0100
        if ($ShopID == 0 && $CategoryID != 0 && $VendorID == 0 && $UserID == 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE product.CategoryID = $CategoryID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 0101
        if ($ShopID == 0 && $CategoryID != 0 && $VendorID == 0 && $UserID != 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE product.CategoryID = $CategoryID AND invoice_product_mapping.UserID = $UserID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 0110
        if ($ShopID == 0 && $CategoryID != 0 && $VendorID != 0 && $UserID == 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE product.CategoryID = $CategoryID AND product.VendorID = $VendorID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 0111
        if ($ShopID == 0 && $CategoryID != 0 && $VendorID != 0 && $UserID != 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE product.CategoryID = $CategoryID AND product.VendorID = $VendorID AND invoice_product_mapping.UserID = $UserID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1000
        if ($ShopID != 0 && $CategoryID == 0 && $VendorID == 0 && $UserID == 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1001
        if ($ShopID != 0 && $CategoryID == 0 && $VendorID == 0 && $UserID != 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.UserID = $UserID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1010
        if ($ShopID != 0 && $CategoryID == 0 && $VendorID != 0 && $UserID == 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND product.VendorID = $VendorID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1000
        if ($ShopID != 0 && $CategoryID == 0 && $VendorID != 0 && $UserID != 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND product.VendorID = $VendorID AND invoice_product_mapping.UserID = $UserID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1100
        if ($ShopID != 0 && $CategoryID != 0 && $VendorID == 0 && $UserID == 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND product.CategoryID = $CategoryID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1101
        if ($ShopID != 0 && $CategoryID != 0 && $VendorID == 0 && $UserID != 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND product.CategoryID = $CategoryID AND invoice_product_mapping.UserID = $UserID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1110
        if ($ShopID != 0 && $CategoryID != 0 && $VendorID != 0 && $UserID == 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND product.CategoryID = $CategoryID AND product.VendorID = $VendorID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // 1111
        if ($ShopID != 0 && $CategoryID != 0 && $VendorID != 0 && $UserID != 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_mapping.UserID,
            user.FirstName,

            invoice_product_mapping.ShopID,
            shop.ShopName,

            invoice_product_mapping.InvoiceID,
            invoice_product_mapping.ProductID,

            product.ProductName,            

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_mapping.ProductName,

            invoice_product_mapping.Qty,

            product.CostPrice * invoice_product_mapping.Qty AS CostPrice,
            invoice_product_mapping.Price * invoice_product_mapping.Qty AS Price,
            IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal) AS TaxTotal,
            invoice_product_mapping.Discount,
            invoice_product_mapping.TotalPrice,

            invoice_product_mapping.TotalPrice - (IF(invoice_product_mapping.TaxTotal IS NULL, 0, invoice_product_mapping.TaxTotal)) - invoice_product_mapping.Discount - (product.CostPrice * invoice_product_mapping.Qty) AS ProfitAmount,
            
            invoice_product_mapping.created_at,
            invoice_product_mapping.updated_at

            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_mapping.UserID = user.UserID

            WHERE invoice_product_mapping.ShopID = $ShopID AND product.CategoryID = $CategoryID AND product.VendorID = $VendorID AND invoice_product_mapping.UserID = $UserID AND invoice_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo' ORDER BY InvoiceID ASC"
          );
        }

        // Calculate number of rows in Report
        // $Length = count($Report);

        // initialize the variables
        // $TotalQty          = 0; 
        // $TotalCostPrice    = 0;
        // $TotalSalePrice    = 0;
        // $TotalDiscount     = 0;
        // $TotalTax          = 0;
        // $NetTotalSalePrice = 0;
        // $TotalProfitAmount = 0;

        // for($Counter = 0; $Counter < $Length; $Counter++)
        // {
        //   $TotalQty         += $Report[$Counter]->Qty; 
        //   $TotalCostPrice   += $Report[$Counter]->CostPrice;
        //   $TotalSalePrice   += $Report[$Counter]->Price;
        //   $TotalDiscount    += $Report[$Counter]->Discount;
        //   $TotalTax         += $Report[$Counter]->TaxTotal;
        //   $NetTotalSalePrice+= $Report[$Counter]->TotalPrice; 
        //   $TotalProfitAmount+= $Report[$Counter]->TotalPrice - $Report[$Counter]->TaxTotal - $Report[$Counter]->Discount - ($Report[$Counter]->CostPrice);
        // }

        // if($NetTotalSalePrice == 0)
        //   $TotalProfitPercent = 0;
        // else
        //   $TotalProfitPercent = ($TotalProfitAmount / ($NetTotalSalePrice - $TotalTax)) * 100;


        $Report =  json_encode($Report);
        return response($Report);


        // return view('report.sales.productwise', compact('Report', 'ReportName', 'DateFrom', 'DateTo', 'ShopName', 'TotalQty','TotalCostPrice', 'TotalSalePrice', 'TotalDiscount','TotalTax' ,'NetTotalSalePrice','TotalProfitAmount', 'TotalProfitPercent'));
        break;

      case 'ShopwiseGPSummary':
        $ReportName = "GP Summary";
        $ShopName = 'All Shop';

        if ($ShopID == 0 && $CategoryID == 0 && $VendorID == 0 && $UserID == 0) {
          $Report = DB::select("
            SELECT  
            invoice_product_mapping.ShopID,
            shop.ShopName,

            SUM(product.CostPrice * invoice_product_mapping.Qty) AS GrossTotalCost,

            SUM(invoice_product_mapping.Price * invoice_product_mapping.Qty)  AS GrossTotalSale,

            SUM(invoice_product_mapping.Discount) AS GrossTotalDiscount,

            SUM(invoice_product_mapping.TaxTotal) AS GrossTotalTax,

            SUM(invoice_product_mapping.TotalPrice) - SUM(invoice_product_mapping.TaxTotal) AS GrossTotalSoldPrice,
            
            SUM(invoice_product_mapping.TotalPrice) - SUM(invoice_product_mapping.TaxTotal) - SUM(product.CostPrice * invoice_product_mapping.Qty) AS GrossTotalProfitAmount,

            SUM(invoice_product_mapping.TotalPrice) - SUM(invoice_product_mapping.TaxTotal) - SUM(product.CostPrice * invoice_product_mapping.Qty) AS GrossTotalProfitPercent


            FROM invoice_product_mapping

            LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
            LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID

            WHERE DATE(invoice_product_mapping.created_at) BETWEEN '$DateFrom' AND '$DateTo'

            GROUP BY ShopID            
          ");
        }
        // 0000
        // 0011
        // 0100
        // 0111
        // 1000
        // 1011
        // 1100
        // 1110

        $NetTotalCost         = 0;
        $NetTotalSale         = 0;
        $NetTotalDiscount     = 0;
        $NetTotalTax          = 0;
        $NetTotalSoldPrice    = 0;

        $NetTotalProfit       = 0;
        $NetTotalProfitAmount = 0;
        $NetTotalProfitPercent= 0;

        $Length = count($Report);

        for($Counter = 0; $Counter < $Length; $Counter++){

          $NetTotalCost           += $Report[$Counter]->GrossTotalCost;
          $NetTotalSale           += $Report[$Counter]->GrossTotalSale;
          $NetTotalDiscount       += $Report[$Counter]->GrossTotalDiscount;
          $NetTotalTax            += $Report[$Counter]->GrossTotalTax;
          $NetTotalSoldPrice      += $Report[$Counter]->GrossTotalSoldPrice;

          $NetTotalProfitAmount   += $Report[$Counter]->GrossTotalProfitAmount;
          $NetTotalProfitPercent  += $Report[$Counter]->GrossTotalProfitPercent;
        }

        // $AvgProfitPercent = $NetTotalProfitPercent / $Length;

        return view('report.sales.GPSummary', compact('ReportName', 'ShopName', 'DateFrom', 'DateTo', 'Report', 'NetTotalCost', 'NetTotalSale', 'NetTotalDiscount','NetTotalTax','NetTotalSoldPrice', 'NetTotalProfitAmount', 'AvgProfitPercent'));
        break;

      case 'MonthwiseGpSummary':
        $ReportName = "Monthwise GP Summary";
        $ShopName = 'SHIULE ENTERPRISE';

        // if ($ShopID == 0 && $CategoryID == 0 && $VendorID == 0 && $UserID == 0) {
        //   $Report = DB::select("
        //     SELECT  
        //     invoice_product_mapping.ShopID,
        //     shop.ShopName,

        //     SUM(product.CostPrice * invoice_product_mapping.Qty) AS GrossTotalCost,

        //     SUM(invoice_product_mapping.Price * invoice_product_mapping.Qty)  AS GrossTotalSale,

        //     SUM(invoice_product_mapping.Discount) AS GrossTotalDiscount,

        //     SUM(invoice_product_mapping.TaxTotal) AS GrossTotalTax,

        //     SUM(invoice_product_mapping.TotalPrice) - SUM(invoice_product_mapping.TaxTotal) AS GrossTotalSoldPrice,
            
        //     SUM(invoice_product_mapping.TotalPrice) - SUM(invoice_product_mapping.TaxTotal) - SUM(product.CostPrice * invoice_product_mapping.Qty) AS GrossTotalProfitAmount,

        //     SUM(invoice_product_mapping.TotalPrice) - SUM(invoice_product_mapping.TaxTotal) - SUM(product.CostPrice * invoice_product_mapping.Qty) AS GrossTotalProfitPercent


        //     FROM invoice_product_mapping

        //     LEFT JOIN product ON invoice_product_mapping.ProductID = product.ProductID
        //     LEFT JOIN shop ON invoice_product_mapping.ShopID = shop.ShopID

        //     WHERE DATE(invoice_product_mapping.created_at) BETWEEN '$DateFrom' AND '$DateTo'

        //     GROUP BY ShopID            
        //   ");
        // }
        // 0000
        // 0011
        // 0100
        // 0111
        // 1000
        // 1011
        // 1100
        // 1110

        // $NetTotalCost         = 0;
        // $NetTotalSale         = 0;
        // $NetTotalDiscount     = 0;
        // $NetTotalTax          = 0;
        // $NetTotalSoldPrice    = 0;

        // $NetTotalProfit       = 0;
        // $NetTotalProfitAmount = 0;
        // $NetTotalProfitPercent= 0;

        // $Length = count($Report);

        // for($Counter = 0; $Counter < $Length; $Counter++){

        //   $NetTotalCost           += $Report[$Counter]->GrossTotalCost;
        //   $NetTotalSale           += $Report[$Counter]->GrossTotalSale;
        //   $NetTotalDiscount       += $Report[$Counter]->GrossTotalDiscount;
        //   $NetTotalTax            += $Report[$Counter]->GrossTotalTax;
        //   $NetTotalSoldPrice      += $Report[$Counter]->GrossTotalSoldPrice;

        //   $NetTotalProfitAmount   += $Report[$Counter]->GrossTotalProfitAmount;
        //   $NetTotalProfitPercent  += $Report[$Counter]->GrossTotalProfitPercent;
        // }

        // $AvgProfitPercent = $NetTotalProfitPercent / $Length;

        // return view('report.sales.monthwise_gp_summary', compact('ReportName', 'ShopName', 'DateFrom', 'DateTo', 'Report', 'NetTotalCost', 'NetTotalSale', 'NetTotalDiscount','NetTotalTax','NetTotalSoldPrice', 'NetTotalProfitAmount', 'AvgProfitPercent'));

        return view('report.sales.monthwise_gp_summary');
        break;

      case 'Refund':
        $ReportName = 'Reund Report';

        // 0000
        if ($ShopID == 0 && $CategoryID == 0 && $VendorID == 0 && $UserID == 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'
            "
          );
        }

        // 0001
        if ($ShopID == 0 && $CategoryID == 0 && $VendorID == 0 && $UserID != 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE invoice_product_refund_mapping.UserID = $UserID AND invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'"
          );
        }

        // 0010
        if ($ShopID == 0 && $CategoryID == 0 && $VendorID != 0 && $UserID == 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE product.VendorID = $VendorID AND invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'"
          );
        }

        // 0011
        if ($ShopID == 0 && $CategoryID == 0 && $VendorID != 0 && $UserID != 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE invoice_product_refund_mapping.UserID = $UserID AND product.VendorID = $VendorID AND invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'"
          );
        }

        // 0100
        if ($ShopID == 0 && $CategoryID != 0 && $VendorID == 0 && $UserID == 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE product.CategoryID = $CategoryID AND invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'"
          );
        }

        // 0101
        if ($ShopID == 0 && $CategoryID != 0 && $VendorID == 0 && $UserID != 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE product.CategoryID = $CategoryID AND invoice_product_refund_mapping.UserID = $UserID AND invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'"
          );
        }

        // 0110
        if ($ShopID == 0 && $CategoryID != 0 && $VendorID != 0 && $UserID == 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE product.CategoryID = $CategoryID AND product.VendorID = $VendorID AND invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'"
          );
        }

        // 0111
        if ($ShopID == 0 && $CategoryID != 0 && $VendorID != 0 && $UserID != 0) {
          $ShopName = "All Shop";

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE product.CategoryID = $CategoryID AND product.VendorID = $VendorID AND invoice_product_refund_mapping.UserID = $UserID AND invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'"
          );
        }

        // 1000
        if ($ShopID != 0 && $CategoryID == 0 && $VendorID == 0 && $UserID == 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE invoice_product_refund_mapping.ShopID = $ShopID AND invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'"
          );
        }

        // 1001
        if ($ShopID != 0 && $CategoryID == 0 && $VendorID == 0 && $UserID != 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE invoice_product_refund_mapping.ShopID = $ShopID AND invoice_product_refund_mapping.UserID = $UserID AND invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'"
          );
        }

        // 1010
        if ($ShopID != 0 && $CategoryID == 0 && $VendorID != 0 && $UserID == 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE invoice_product_refund_mapping.ShopID = $ShopID AND product.VendorID = $VendorID AND invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'"
          );
        }

        // 1000
        if ($ShopID != 0 && $CategoryID == 0 && $VendorID != 0 && $UserID != 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE invoice_product_refund_mapping.ShopID = $ShopID AND product.VendorID = $VendorID AND invoice_product_refund_mapping.UserID = $UserID AND invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'"
          );
        }

        // 1100
        if ($ShopID != 0 && $CategoryID != 0 && $VendorID == 0 && $UserID == 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE invoice_product_refund_mapping.ShopID = $ShopID AND product.CategoryID = $CategoryID AND invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'"
          );
        }

        // 1101
        if ($ShopID != 0 && $CategoryID != 0 && $VendorID == 0 && $UserID != 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE invoice_product_refund_mapping.ShopID = $ShopID AND product.CategoryID = $CategoryID AND invoice_product_refund_mapping.UserID = $UserID AND invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'"
          );
        }

        // 1110
        if ($ShopID != 0 && $CategoryID != 0 && $VendorID != 0 && $UserID == 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE invoice_product_refund_mapping.ShopID = $ShopID AND product.CategoryID = $CategoryID AND product.VendorID = $VendorID AND invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'"
          );
        }

        // 1111
        if ($ShopID != 0 && $CategoryID != 0 && $VendorID != 0 && $UserID != 0) {

          $Shop = Shop::findOrFail($ShopID);
          $ShopName = $Shop->ShopName;

          $Report = DB::select("
            SELECT
            invoice_product_refund_mapping.UserID,
            user.FirstName,

            invoice_product_refund_mapping.ShopID,
            shop.ShopName,

            invoice_product_refund_mapping.InvoiceID,
            invoice_product_refund_mapping.ProductID,

            product.ProductName,
            product.CostPrice,

            product_category.CategoryName,
            vendor.VendorName,
            invoice_product_refund_mapping.ProductName,

            invoice_product_refund_mapping.Qty,

            invoice_product_refund_mapping.Price,

            invoice_product_refund_mapping.TotalPrice,
            invoice_product_refund_mapping.Discount,
            invoice_product_refund_mapping.TaxTotal,
            invoice_product_refund_mapping.RefundReason,
            invoice_product_refund_mapping.created_at,
            invoice_product_refund_mapping.updated_at

            FROM invoice_product_refund_mapping

            LEFT JOIN product ON invoice_product_refund_mapping.ProductID = product.ProductID
            LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
            LEFT JOIN vendor ON product.VendorID = vendor.VendorID
            LEFT JOIN shop ON invoice_product_refund_mapping.ShopID = shop.ShopID
            LEFT JOIN user ON invoice_product_refund_mapping.UserID = user.UserID

            WHERE invoice_product_refund_mapping.ShopID = $ShopID AND product.CategoryID = $CategoryID AND product.VendorID = $VendorID AND invoice_product_refund_mapping.UserID = $UserID AND invoice_product_refund_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'"
          );
        }

        $Length = count($Report);

        $TotalQty          = 0; 
        $TotalCostPrice    = 0;
        $TotalSalePrice    = 0;
        $TotalDiscountPrice= 0;
        $TotalDiscount     = 0;

        for($Counter = 0; $Counter < $Length; $Counter++)
        {
          $TotalQty         += $Report[$Counter]->Qty; 
          $TotalCostPrice   += $Report[$Counter]->CostPrice * $Report[$Counter]->Qty;
          $TotalSalePrice   += $Report[$Counter]->Price * $Report[$Counter]->Qty;
          // $TotalDiscountPrice += $Report[$Counter]->
          $TotalDiscount    += $Report[$Counter]->Discount * $Report[$Counter]->Qty;
        }


        return view('report.sales.refund', compact('Report', 'ReportName', 'DateFrom', 'DateTo', 'ShopName', 'TotalQty', 'TotalCostPrice', 'TotalSalePrice', 'TotalDiscount'));
        break;
      
      default:
        return "Please select a parameter" ;
        break;
    }    
    
  }


  /*************************** Activity Report ************************/
  public function activity($ShopID, $UserID, $DateFrom, $DateTo)
  {

    if ($DateFrom == 0) {
      $DateFrom = '0000-01-01';
    }

    if ($DateTo == 0) {
      $DateTo = date('Y-m-d');
    }

    $ReportName = 'Activity Log';

    // 00
    if ($ShopID == 0 && $UserID == 0) {

      $Report = DB::select("
        SELECT 
        activity_log.ActivityID,
        activity_log.UserID,
        user.FirstName,
        user.LastName,
        activity_log.ShopID,
        shop.ShopName,
        activity_log.ActivityName,
        activity_log.created_at,
        activity_log.updated_at 

        FROM activity_log

        JOIN user ON activity_log.UserID = user.UserID
        JOIN shop ON activity_log.ShopID = shop.ShopID

        WHERE activity_log.created_at BETWEEN $DateFrom AND '$DateTo'
      ");
    }

    //01
    if ($ShopID == 0 && $UserID != 0) {

      $Report = DB::select("
        SELECT 
        activity_log.ActivityID,
        activity_log.UserID,
        user.FirstName,
        user.LastName,
        activity_log.ShopID,
        shop.ShopName,
        activity_log.ActivityName,
        activity_log.created_at,
        activity_log.updated_at 

        FROM activity_log

        JOIN user ON activity_log.UserID = user.UserID
        JOIN shop ON activity_log.ShopID = shop.ShopID

        WHERE activity_log.UserID = $UserID AND activity_log.created_at BETWEEN $DateFrom AND '$DateTo'
      ");

      
    }

    //10
    if ($ShopID != 0 && $UserID == 0) {

      $Report = DB::select("
        SELECT 
        activity_log.ActivityID,
        activity_log.UserID,
        user.FirstName,
        user.LastName,
        activity_log.ShopID,
        shop.ShopName,
        activity_log.ActivityName,
        activity_log.created_at,
        activity_log.updated_at 

        FROM activity_log

        JOIN user ON activity_log.UserID = user.UserID
        JOIN shop ON activity_log.ShopID = shop.ShopID

        WHERE activity_log.ShopID = $ShopID AND activity_log.created_at BETWEEN $DateFrom AND '$DateTo'
      ");

      
    }

    //11
    if ($ShopID != 0 && $UserID != 0) {
      $Report = DB::select("
        SELECT 
        activity_log.ActivityID,
        activity_log.UserID,
        user.FirstName,
        user.LastName,
        activity_log.ShopID,
        shop.ShopName,
        activity_log.ActivityName,
        activity_log.created_at,
        activity_log.updated_at 

        FROM activity_log

        JOIN user ON activity_log.UserID = user.UserID
        JOIN shop ON activity_log.ShopID = shop.ShopID

        WHERE activity_log.ShopID = $ShopID AND activity_log.UserID = $UserID AND activity_log.created_at BETWEEN $DateFrom AND '$DateTo'
      ");      
    }

    return view('activity.report.print', compact('ReportName', 'Report', 'DateFrom', 'DateTo'));
  }

  /*************************** Waste  Report ************************/
  public function waste($ShopID, $DateFrom, $DateTo)
  {
    if ($DateFrom == 0) {
      $DateFrom = '0000-01-01';
    }

    if ($DateTo == 0) {
      $DateTo = date('Y-m-d');
    }

    $ReportName = 'Waste Report';

    if ($ShopID < 0) {

      $ShopName = "All Shops and Main Stock";

      $Report = DB::select("
        SELECT
        waste.WasteID,
        waste.ShopID,
        shop.ShopName,
        waste.ProductID,
        product.ProductName,
        waste.Qty,
        waste.UnitCost,
        waste.TotalPrice,
        waste.WastedBy,
        waste.Note,
        waste.created_at,
        waste.updated_at

        FROM waste

        JOIN product ON waste.ProductID = product.ProductID
        LEFT JOIN shop ON shop.ShopID = waste.ShopID

        WHERE waste.created_at BETWEEN $DateFrom AND '$DateTo'
      ");

    }

    if ($ShopID == 0) {

      $ShopName = 'Main Stock';

      $Report = DB::select("
        SELECT
        waste.WasteID,
        waste.ShopID,
        shop.ShopName,
        waste.ProductID,
        product.ProductName,
        waste.Qty,
        waste.UnitCost,
        waste.TotalPrice,
        waste.WastedBy,
        waste.Note,
        waste.created_at,
        waste.updated_at

        FROM waste

        JOIN product ON waste.ProductID = product.ProductID
        LEFT JOIN shop ON shop.ShopID = waste.ShopID

        WHERE waste.ShopID = 0 AND waste.created_at BETWEEN $DateFrom AND '$DateTo'
      ");
    }

    if ($ShopID > 0) {

      $Shop = Shop::findOrFail($ShopID);
      $ShopName = $Shop->ShopName;

      $Report = DB::select("
        SELECT
        waste.WasteID,
        waste.ShopID,
        shop.ShopName,
        waste.ProductID,
        product.ProductName,
        waste.Qty,
        waste.UnitCost,
        waste.TotalPrice,
        waste.WastedBy,
        waste.Note,
        waste.created_at,
        waste.updated_at

        FROM waste

        JOIN product ON waste.ProductID = product.ProductID
        LEFT JOIN shop ON shop.ShopID = waste.ShopID

        WHERE waste.ShopID = $ShopID AND waste.created_at BETWEEN $DateFrom AND '$DateTo'
      ");
    }

    // return $Report;
    return view('waste.report.print', compact('ReportName', 'ShopName' , 'Report', 'DateFrom', 'DateTo'));
  }

  /*************************** Cash Drawer  Report ************************/
  public function drawer($ShopID, $UserID, $Status, $DateFrom, $DateTo)
  {
    if ($DateFrom == 0) {
      $DateFrom = '0000-01-01';
    }

    if ($DateTo == 0) {
      $DateTo = date('Y-m-d');
    }
    
    $ReportName = 'Drawer Report';

    switch ($Status) {
      case '0':
        //00
        if ($ShopID == 0 && $UserID == 0) {

          $ShopName = 'All';

          return $Report = DB::select("
            SELECT
            cash_drawer.ShopID,
            shop.ShopName,
            cash_drawer.UserID,
            user.FirstName, 
            user.LastName,
            cash_drawer.OpeningBalance,
            cash_drawer.ClosingBalance,
            cash_drawer.IsClosed,
            cash_drawer.created_at,
            cash_drawer.updated_at

            FROM cash_drawer

            LEFT JOIN shop ON cash_drawer.ShopID = shop.ShopID
            LEFT JOIN user ON cash_drawer.UserID = user.UserID

            WHERE cash_drawer.IsClosed = 0 AND cash_drawer.created_at BETWEEN $DateFrom AND '$DateTo'
          ");
        }

        //01
        if ($ShopID == 0 && $UserID != 0) {
          $ShopName = 'All';
          $Report = DB::select("
            SELECT
            cash_drawer.ShopID,
            shop.ShopName,
            cash_drawer.UserID,
            user.FirstName, 
            user.LastName,
            cash_drawer.OpeningBalance,
            cash_drawer.ClosingBalance,
            cash_drawer.IsClosed,
            cash_drawer.created_at,
            cash_drawer.updated_at

            FROM cash_drawer

            LEFT JOIN shop ON cash_drawer.ShopID = shop.ShopID
            LEFT JOIN user ON cash_drawer.UserID = user.UserID

            WHERE cash_drawer.IsClosed = 0 AND cash_drawer.UserID = $UserID AND cash_drawer.created_at BETWEEN $DateFrom AND '$DateTo'
          ");
        }

        //10
        if ($ShopID != 0 && $UserID == 0) {
          $Report = DB::select("
            SELECT
            cash_drawer.ShopID,
            shop.ShopName,
            cash_drawer.UserID,
            user.FirstName, 
            user.LastName,
            cash_drawer.OpeningBalance,
            cash_drawer.ClosingBalance,
            cash_drawer.IsClosed,
            cash_drawer.created_at,
            cash_drawer.updated_at

            FROM cash_drawer

            LEFT JOIN shop ON cash_drawer.ShopID = shop.ShopID
            LEFT JOIN user ON cash_drawer.UserID = user.UserID

            WHERE cash_drawer.IsClosed = 0 AND cash_drawer.ShopID = $ShopID AND cash_drawer.created_at BETWEEN $DateFrom AND '$DateTo'
          ");
        }

        //11
        if ($ShopID != 0 && $UserID != 0) {
          $Report = DB::select("
            SELECT
            cash_drawer.ShopID,
            shop.ShopName,
            cash_drawer.UserID,
            user.FirstName, 
            user.LastName,
            cash_drawer.OpeningBalance,
            cash_drawer.ClosingBalance,
            cash_drawer.IsClosed,
            cash_drawer.created_at,
            cash_drawer.updated_at

            FROM cash_drawer

            LEFT JOIN shop ON cash_drawer.ShopID = shop.ShopID
            LEFT JOIN user ON cash_drawer.UserID = user.UserID

            WHERE cash_drawer.IsClosed = 0 AND cash_drawer.ShopID = $ShopID AND cash_drawer.UserID = $UserID AND cash_drawer.created_at BETWEEN $DateFrom AND '$DateTo'
          ");
        }

        break;

      case '1':
        //00
        if ($ShopID == 0 && $UserID == 0) {
          $Report = DB::select("
            SELECT
            cash_drawer.ShopID,
            shop.ShopName,
            cash_drawer.UserID,
            user.FirstName, 
            user.LastName,
            cash_drawer.OpeningBalance,
            cash_drawer.ClosingBalance,
            cash_drawer.IsClosed,
            cash_drawer.created_at,
            cash_drawer.updated_at

            FROM cash_drawer

            LEFT JOIN shop ON cash_drawer.ShopID = shop.ShopID
            LEFT JOIN user ON cash_drawer.UserID = user.UserID

            WHERE cash_drawer.IsClosed = 1 AND cash_drawer.created_at BETWEEN $DateFrom AND '$DateTo'
          ");
        }

        //01
        if ($ShopID == 0 && $UserID != 0) {
          $Report = DB::select("
            SELECT
            cash_drawer.ShopID,
            shop.ShopName,
            cash_drawer.UserID,
            user.FirstName, 
            user.LastName,
            cash_drawer.OpeningBalance,
            cash_drawer.ClosingBalance,
            cash_drawer.IsClosed,
            cash_drawer.created_at,
            cash_drawer.updated_at

            FROM cash_drawer

            LEFT JOIN shop ON cash_drawer.ShopID = shop.ShopID
            LEFT JOIN user ON cash_drawer.UserID = user.UserID

            WHERE cash_drawer.IsClosed = 1 AND cash_drawer.UserID = $UserID AND cash_drawer.created_at BETWEEN $DateFrom AND '$DateTo'
          ");
        }

        //10
        if ($ShopID != 0 && $UserID == 0) {
          $Report = DB::select("
            SELECT
            cash_drawer.ShopID,
            shop.ShopName,
            cash_drawer.UserID,
            user.FirstName, 
            user.LastName,
            cash_drawer.OpeningBalance,
            cash_drawer.ClosingBalance,
            cash_drawer.IsClosed,
            cash_drawer.created_at,
            cash_drawer.updated_at

            FROM cash_drawer

            LEFT JOIN shop ON cash_drawer.ShopID = shop.ShopID
            LEFT JOIN user ON cash_drawer.UserID = user.UserID

            WHERE cash_drawer.IsClosed = 1 AND cash_drawer.ShopID = $ShopID AND cash_drawer.created_at BETWEEN $DateFrom AND '$DateTo'
          ");
        }

        //11
        if ($ShopID != 0 && $UserID != 0) {
          $Report = DB::select("
            SELECT
            cash_drawer.ShopID,
            shop.ShopName,
            cash_drawer.UserID,
            user.FirstName, 
            user.LastName,
            cash_drawer.OpeningBalance,
            cash_drawer.ClosingBalance,
            cash_drawer.IsClosed,
            cash_drawer.created_at,
            cash_drawer.updated_at

            FROM cash_drawer

            LEFT JOIN shop ON cash_drawer.ShopID = shop.ShopID
            LEFT JOIN user ON cash_drawer.UserID = user.UserID

            WHERE cash_drawer.IsClosed = 1 AND cash_drawer.ShopID = $ShopID AND cash_drawer.UserID = $UserID AND cash_drawer.created_at BETWEEN $DateFrom AND '$DateTo'
          ");
        }

        break;
      
      default:
        //00
        if ($ShopID == 0 && $UserID == 0) {
          $Report = DB::select("
            SELECT
            cash_drawer.ShopID,
            shop.ShopName,
            cash_drawer.UserID,
            user.FirstName, 
            user.LastName,
            cash_drawer.OpeningBalance,
            cash_drawer.ClosingBalance,
            cash_drawer.IsClosed,
            cash_drawer.created_at,
            cash_drawer.updated_at

            FROM cash_drawer

            LEFT JOIN shop ON cash_drawer.ShopID = shop.ShopID
            LEFT JOIN user ON cash_drawer.UserID = user.UserID

            WHERE cash_drawer.created_at BETWEEN $DateFrom AND '$DateTo'
          ");
        }

        //01
        if ($ShopID == 0 && $UserID != 0) {
          $Report = DB::select("
            SELECT
            cash_drawer.ShopID,
            shop.ShopName,
            cash_drawer.UserID,
            user.FirstName, 
            user.LastName,
            cash_drawer.OpeningBalance,
            cash_drawer.ClosingBalance,
            cash_drawer.IsClosed,
            cash_drawer.created_at,
            cash_drawer.updated_at

            FROM cash_drawer

            LEFT JOIN shop ON cash_drawer.ShopID = shop.ShopID
            LEFT JOIN user ON cash_drawer.UserID = user.UserID

            WHERE cash_drawer.UserID = $UserID AND cash_drawer.created_at BETWEEN $DateFrom AND '$DateTo'
          ");
        }

        //10
        if ($ShopID != 0 && $UserID == 0) {
          $Report = DB::select("
            SELECT
            cash_drawer.ShopID,
            shop.ShopName,
            cash_drawer.UserID,
            user.FirstName, 
            user.LastName,
            cash_drawer.OpeningBalance,
            cash_drawer.ClosingBalance,
            cash_drawer.IsClosed,
            cash_drawer.created_at,
            cash_drawer.updated_at

            FROM cash_drawer

            LEFT JOIN shop ON cash_drawer.ShopID = shop.ShopID
            LEFT JOIN user ON cash_drawer.UserID = user.UserID

            WHERE cash_drawer.ShopID = $ShopID AND cash_drawer.created_at BETWEEN $DateFrom AND '$DateTo'
          ");
        }

        //11
        if ($ShopID != 0 && $UserID != 0) {
          $Report = DB::select("
            SELECT
            cash_drawer.ShopID,
            shop.ShopName,
            cash_drawer.UserID,
            user.FirstName, 
            user.LastName,
            cash_drawer.OpeningBalance,
            cash_drawer.ClosingBalance,
            cash_drawer.IsClosed,
            cash_drawer.created_at,
            cash_drawer.updated_at

            FROM cash_drawer

            LEFT JOIN shop ON cash_drawer.ShopID = shop.ShopID
            LEFT JOIN user ON cash_drawer.UserID = user.UserID

            WHERE cash_drawer.ShopID = $ShopID AND cash_drawer.UserID = $UserID AND cash_drawer.created_at BETWEEN $DateFrom AND '$DateTo'
          ");
        }

      break;
    }

    return view('drawer.report.print', compact('ReportName', 'Report', 'DateFrom', 'DateTo'));
  }
}

