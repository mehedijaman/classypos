<?php

namespace ClassyPOS\waste;

use Illuminate\Database\Eloquent\Model;
use DB;

class Waste extends Model
{
	protected $table = 'waste';
	protected $primaryKey = 'WasteID' ;
	protected $fillable = ['ShopID', 'ProductID', 'Qty', 'UnitCost', 'TotalPrice','WastedBy','Note'];

	public function listWaste()
	{
		$List = DB::select("SELECT
			waste.WasteID,
			shop.ShopName,
			product.ProductName,
			waste.Qty,
			waste.UnitCost,
			waste.TotalPrice,
			waste.WastedBy,
			waste.Note,
			waste.created_at,
			waste.updated_at
			FROM waste
			JOIN shop ON waste.ShopID = shop.ShopID 
			JOIN product ON waste.ProductID = product.ProductID"
		);

		return $List;
	}
}
