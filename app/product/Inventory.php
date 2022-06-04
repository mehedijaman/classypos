<?php 
namespace ClassyPOS\product;

use Illuminate\Database\Eloquent\Model;
use DB;


class Inventory extends Model
{
    protected $table="inventory";
    protected $primaryKey="ID";
    protected $fillable=['ShopID','ProductID','SoftQty','HardQty','Remark','UserID'];


    public function Report($ShopID)
    {
        $Report = DB::select("SELECT 
            inventory.ProductID, 
            product_category.CategoryName, 
            vendor.VendorName, 
            product.ProductName, 
            product.CostPrice,
            product.SalePrice,
            inventory.SoftQty,
            inventory.HardQty,
            inventory.Remark,
            inventory.UserID,
            inventory.created_at

            FROM inventory 

            JOIN product ON inventory.ProductID = product.ProductID
            JOIN product_category ON product.CategoryID = product_category.CategoryID
            JOIN vendor ON product.VendorID = vendor.VendorID

            WHERE inventory.ShopID = ".$ShopID." ORDER BY product_category.CategoryName ASC"
        );

        // $Json = json_encode($Report);

        // return response($Json);
        return $Report;
    }
}
