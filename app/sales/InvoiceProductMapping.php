<?php

namespace ClassyPOS\sales;

use Illuminate\Database\Eloquent\Model;
use DB;

class InvoiceProductMapping extends Model
{


    protected $table="invoice_product_mapping";
    protected $primaryKey="InvoiceProductID";
    protected $fillable=['UserID','ShopID','InvoiceID','ProductID','ProductName','Qty','Price','TotalPrice','Discount','CostPrice'];


    public function TopSold($Limit)
    {
        $TopSold = DB::select("SELECT invoice_product_mapping.ProductID, SUM(invoice_product_mapping.Qty) AS Qty
            FROM invoice_product_mapping
            GROUP BY ProductID
            ORDER BY SUM(Qty)   DESC
            LIMIT $Limit"
        );

        return $TopSold;
    }


    public function NetProfit($ShopID, $DateFrom, $DateTo)
    {
        if ($ShopID == 0 && $DateFrom == 0 && $DateTo == 0) {
            
            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID"
            );

            return $Report;
        }


        if ($ShopID == 0 && $DateFrom == 0 && $DateTo != 0) {
            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.created_at <= $DateTo "
            );

            return $Report;
        }



        if ($ShopID == 0 && $DateFrom != 0 && $DateTo = 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.created_at > $DateFrom"
            );

            return $Report;
        }


        if ($ShopID == 0 && $DateFrom != 0 && $DateTo != 0) {
            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.created_at  BETWEEN $DateFrom AND $DateTo"
            );

            return $Report;
        }


        if ($ShopID != 0 && $DateFrom == 0 && $DateTo == 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID"
            );

            return $Report;
        }

        if ( $ShopID != 0 && $DateFrom == 0 && $DateTo != 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at <= $DateTo "
            );

            return $Report;
        }



        if ($ShopID != 0 && $DateFrom != 0 && $DateTo == 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at >= $DateFrom "
            );

            return $Report;
        }



        if ($ShopID != 0 && $DateFrom != 0 && $DateTo != 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at BETWEEN $DateFrom AND $DateTo"
            );

            return $Report;
        }
    }



    public function LeastSold($ShopID, $DateFrom, $DateTo)
    {
        if ($ShopID == 0 && $DateFrom == 0 && $DateTo == 0) {
            
            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID"
            );

            return $Report;
        }


        if ($ShopID == 0 && $DateFrom == 0 && $DateTo != 0) {
            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.created_at <= $DateTo "
            );

            return $Report;
        }



        if ($ShopID == 0 && $DateFrom != 0 && $DateTo = 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.created_at > $DateFrom"
            );

            return $Report;
        }


        if ($ShopID == 0 && $DateFrom != 0 && $DateTo != 0) {
            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.created_at  BETWEEN $DateFrom AND $DateTo"
            );

            return $Report;
        }


        if ($ShopID != 0 && $DateFrom == 0 && $DateTo == 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID"
            );

            return $Report;
        }

        if ( $ShopID != 0 && $DateFrom == 0 && $DateTo != 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at <= $DateTo "
            );

            return $Report;
        }



        if ($ShopID != 0 && $DateFrom != 0 && $DateTo == 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at >= $DateFrom "
            );

            return $Report;
        }



        if ($ShopID != 0 && $DateFrom != 0 && $DateTo != 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at BETWEEN $DateFrom AND $DateTo"
            );

            return $Report;
        }
    }



    public function MostSold($ShopID, $DateFrom, $DateTo)
    {
        if ($ShopID == 0 && $DateFrom == 0 && $DateTo == 0) {
            
            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID"
            );

            return $Report;
        }


        if ($ShopID == 0 && $DateFrom == 0 && $DateTo != 0) {
            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.created_at <= $DateTo "
            );

            return $Report;
        }



        if ($ShopID == 0 && $DateFrom != 0 && $DateTo = 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.created_at > $DateFrom"
            );

            return $Report;
        }


        if ($ShopID == 0 && $DateFrom != 0 && $DateTo != 0) {
            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.created_at  BETWEEN $DateFrom AND $DateTo"
            );

            return $Report;
        }


        if ($ShopID != 0 && $DateFrom == 0 && $DateTo == 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID"
            );

            return $Report;
        }

        if ( $ShopID != 0 && $DateFrom == 0 && $DateTo != 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at <= $DateTo "
            );

            return $Report;
        }



        if ($ShopID != 0 && $DateFrom != 0 && $DateTo == 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at >= $DateFrom "
            );

            return $Report;
        }



        if ($ShopID != 0 && $DateFrom != 0 && $DateTo != 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at BETWEEN $DateFrom AND $DateTo"
            );

            return $Report;
        }
    }


    public function Discount($ShopID, $DateFrom, $DateTo)
    {
        if ($ShopID == 0 && $DateFrom == 0 && $DateTo == 0) {
            
            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID"
            );

            return $Report;
        }


        if ($ShopID == 0 && $DateFrom == 0 && $DateTo != 0) {
            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.created_at <= $DateTo "
            );

            return $Report;
        }



        if ($ShopID == 0 && $DateFrom != 0 && $DateTo = 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.created_at > $DateFrom"
            );

            return $Report;
        }


        if ($ShopID == 0 && $DateFrom != 0 && $DateTo != 0) {
            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.created_at  BETWEEN $DateFrom AND $DateTo"
            );

            return $Report;
        }


        if ($ShopID != 0 && $DateFrom == 0 && $DateTo == 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID"
            );

            return $Report;
        }

        if ( $ShopID != 0 && $DateFrom == 0 && $DateTo != 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at <= $DateTo "
            );

            return $Report;
        }



        if ($ShopID != 0 && $DateFrom != 0 && $DateTo == 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at >= $DateFrom "
            );

            return $Report;
        }



        if ($ShopID != 0 && $DateFrom != 0 && $DateTo != 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at BETWEEN $DateFrom AND $DateTo"
            );

            return $Report;
        }
    }

    public function Refund($ShopID, $DateFrom, $DateTo)
    {
        if ($ShopID == 0 && $DateFrom == 0 && $DateTo == 0) {
            
            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID"
            );

            return $Report;
        }


        if ($ShopID == 0 && $DateFrom == 0 && $DateTo != 0) {
            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.created_at <= $DateTo "
            );

            return $Report;
        }



        if ($ShopID == 0 && $DateFrom != 0 && $DateTo = 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.created_at > $DateFrom"
            );

            return $Report;
        }


        if ($ShopID == 0 && $DateFrom != 0 && $DateTo != 0) {
            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.created_at  BETWEEN $DateFrom AND $DateTo"
            );

            return $Report;
        }


        if ($ShopID != 0 && $DateFrom == 0 && $DateTo == 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID"
            );

            return $Report;
        }

        if ( $ShopID != 0 && $DateFrom == 0 && $DateTo != 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at <= $DateTo "
            );

            return $Report;
        }



        if ($ShopID != 0 && $DateFrom != 0 && $DateTo == 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at >= $DateFrom "
            );

            return $Report;
        }



        if ($ShopID != 0 && $DateFrom != 0 && $DateTo != 0) {

            $Report = DB::select("SELECT 
                invoice_product_mapping.created_at, 
                invoice_product_mapping.ProductID, 
                product.ProductName,

                product.SalePrice AS RegularPrice, 
                (SELECT SUM(RegularPrice) FROM product ) AS TotalRegularPrice,

                product.CostPrice, 
                -- (SELECT SUM(CostPrice) FROM product) AS TotalCostPrice,

                invoice_product_mapping.Price AS SoldPrice, 
                -- (SELECT SUM(Price) FROM invoice_product_mapping) AS TotalSoldPrice,

                invoice_product_mapping.Qty, 
                -- (SELECT SUM(Qty) FROM invoice_product_mapping) AS TotalQty,

                (product.CostPrice * invoice_product_mapping.Qty) AS TotalCost, 

                invoice_product_mapping.TotalPrice, 
                -- (SELECT SUM(TotalPrice) FROM invoice_product_mapping) AS TotalTotalPrice,

                (invoice_product_mapping.TotalPrice - (product.CostPrice * invoice_product_mapping.Qty)) AS TotalProfit

                FROM invoice_product_mapping

                JOIN product ON invoice_product_mapping.ProductID = product.ProductID 

                WHERE invoice_product_mapping.ShopID = $ShopID AND invoice_product_mapping.created_at BETWEEN $DateFrom AND $DateTo"
            );

            return $Report;
        }
    }

}
