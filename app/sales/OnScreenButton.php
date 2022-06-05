<?php

namespace ClassyPOS\sales;

use Illuminate\Database\Eloquent\Model;
use DB;

class OnScreenButton extends Model
{
    
    protected $table="on_screen_button";
    protected $primaryKey="ButtonID";
    protected $fillable=['ShopID','ProductID','DisplayText'];

    public function ListAll()
    {
    	$List = DB::select("SELECT 
    		on_screen_button.ButtonID,
    		shop.ShopName,
    		on_screen_button.ProductID ,
    		product.ProductName, 
    		on_screen_button.DisplayText, 
    		on_screen_button.created_at    	
    		FROM on_screen_button
    		JOIN shop ON on_screen_button.ShopID = shop.ShopID
    		JOIN product ON on_screen_button.ProductID = product.ProductID"
    	);

    	return $List;
    }

}
