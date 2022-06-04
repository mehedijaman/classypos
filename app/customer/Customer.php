<?php

namespace ClassyPOS\customer;

use Illuminate\Database\Eloquent\Model;
use DB;

class Customer extends Model
{
    protected $table="customer";
    protected $primaryKey="CustomerID";
    protected $fillable=['ShopID','FirstName','LastName','Address','City','Province','ZipCode','Country','Phone','Email','DateOfBirth','Notes','CustomerImg'];

    public function ListCustomer()
    {
    	$List = DB::select("SELECT customer.CustomerID,
    		customer.Phone,
    		customer.FirstName,
    		customer.LastName,
    		customer.Address,
    		customer.City,
    		customer.Province,
    		customer.ZipCode,
    		customer.Country,
    		customer.Email,
    		customer.DateOfBirth,
    		customer.Inactive,
    		customer.Notes,
    		customer.CustomerImg,
    		customer.created_at,
    		customer.updated_at,
    		shop.ShopName,
    		customer_balance.Balance 

    		FROM customer 

    		JOIN shop ON customer.ShopID = shop.ShopID
    		JOIN customer_balance ON customer.CustomerID = customer_balance.CustomerID"
    	);

    	return $List;
    }
}
