<?php

namespace ClassyPOS\sales;

use Illuminate\Database\Eloquent\Model;
use DB;

class Invoice extends Model
{
    protected $table="invoice";
    protected $primaryKey="InvoiceID";
    protected $fillable=['ShopID','UserID','SubTotal','PaidMoney','ReturnedMoney'];


    public function LatestInvoices($Limit = 10)
    {
    	$LatestInvoices = DB::select("
    		SELECT invoice.InvoiceID,  
    		invoice.TaxTotal, 
    		invoice.Total, 
    		user.FirstName, 
    		shop.ShopName, 
    		invoice.created_at
			FROM invoice 
			JOIN shop ON invoice.ShopID = shop.ShopID
			JOIN user ON invoice.UserID = user.UserID
			ORDER BY InvoiceID DESC
			LIMIT $Limit"
		);

		return $LatestInvoices;
    }


    public function listByUser($UserID)
    {
        $List = DB::select("SELECT
            invoice.InvoiceID,  
            shop.ShopName,
            invoice.SubTotal,
            invoice.TaxTotal,
            invoice.Total, 
            invoice.PaidMoney,
            invoice.ReturnedMoney,
            invoice.created_at
            FROM invoice 
            JOIN shop ON invoice.ShopID = shop.ShopID
            WHERE invoice.UserID = $UserID"
        );

        return $List;
    }


    public function TodaysTotal()
    {
        $TodaysTotal = DB::select("SELECT SUM(invoice.Total) as SubTotal, SUM(invoice.TaxTotal) as TaxTotal FROM invoice WHERE date(created_at) = CURDATE()");

        return  $TodaysTotal;
    }
    
}
