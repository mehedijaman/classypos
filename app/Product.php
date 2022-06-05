<?php

namespace ClassyPOS;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use DB;

class Product extends Model
{
    use Searchable;
    //protected $table="product";
    //protected $primaryKey="ProductID";
    protected $fillable=['CategoryID','VendorID','ProductName','ProductDescription','ProductImg','Qty','CostPrice','SalePrice','PreferredPrice','Unit','TaxCode','MinQtyLevel'];


    /**
     * Get the index name for the model.
     *
     * @return string
    */


    public function searchableAs()
    {
        return 'product_index';
    }


    public function LatestProducts($Limit = 5)
    {


    	$LatestProducts = DB::select("SELECT product.ProductID,
    		product.ProductName,
    		product.SalePrice 
    		FROM product 
    		ORDER BY ProductID DESC
    		LIMIT $Limit"
    	);

    	return $LatestProducts;
    }

    
}
