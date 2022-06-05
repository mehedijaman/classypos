<?php 

	namespace ClassyPOS\Http\Controllers;

    use Illuminate\Http\Request;    

    use ClassyPOS\shop\Shop;
    use ClassyPOS\supplier\Vendor;

    use ClassyPOS\product\Product;
    use ClassyPOS\product\Inventory;
    use ClassyPOS\product\ProductCategory;
    use ClassyPOS\shop\ShopProductMapping;

    use DB;

	/**
	* Inventory Controller
	*/
	class InventoryController extends Controller
	{
		
		// Loead Inventory check view
	    public function Inventory()
	    {
	        $ShopList = Shop::all();

	        return view('product.inventory.check', compact('ShopList'));
	    }


	    // Check if the product is in the shop
	    public function CheckProduct($ShopID, $ProductID)
	    {
	        $Result = DB::select("SELECT * FROM shop_product_mapping WHERE ShopID =".$ShopID." AND ProductID =".$ProductID);

	        if(count($Result) == 0)
	        	return response('false');
	        else
	        	return response('true');
	    }  

	    // Check , Store , and update Inventory 
	    public function CheckInventory($ShopID, $ProductID)
	    {
	    	// Check if the product is already in the cheklist or not
	    	$Result = DB::select("SELECT ID FROM inventory WHERE ShopID = ".$ShopID." AND ProductID = ". $ProductID);

	    	// if the product is not in the check list insert a new row
	    	if (count($Result) == 0) {
	    		// retriving product details for Shop_Product_Mapping
	    		$Product = DB::select("SELECT shop_product_mapping.ID, shop_product_mapping.Qty FROM shop_product_mapping WHERE ShopID = ".$ShopID." AND ProductID = ".$ProductID);

	    		// retrieving Soft Qty
	    		$SoftQty = $Product[0]->Qty;

	    		// object for Inventory
	    		$Inventory = new Inventory();

	    		// collecting data to insert into Inventory
	    		$Inventory->ShopID 		= $ShopID;
	    		$Inventory->ProductID 	= $ProductID;
	    		$Inventory->SoftQty 	= $SoftQty;
	    		$Inventory->HardQty 	= 1;
	    		$Inventory->Remark 		= $SoftQty - 1;
	    		$Inventory->UserID 		= 1;
	    		
	    		try {
	    			// Insert into inventory
	    			$Inventory->save();
	    			return response('true');
	    		} catch (\Exception $e) {
	    			
	    			return response('false');
	    		}
	    	}
	    	// if the product is already in the inventory table just update it
	    	else{
	    		// retrive Record ID
	    		$ID = $Result[0]->ID;

	    		$Inventory = Inventory::findOrFail($ID);

	    		$Inventory->HardQty += 1;
	    		$Inventory->Remark = $Inventory->SoftQty - $Inventory->HardQty;

	    		try {
	    			$Inventory->save();
	    			return response('true');
	    		} catch (\Exception $e) {
	    			return response('false');
	    		}	    		
	    	}	    		    	
	    }


	    // Reset Inventory
	    public function Reset($ShopID)
	    {
	        try {
	            DB::select("DELETE FROM inventory WHERE ShopID = ".$ShopID);
	            return response('true'); 

	        } catch (\Exception $e) {
	            return response('false');
	        }            
	    }

	    // print inventory report
	    public function Report($ShopID)
	    {
	        try {
	            $InventoryReport = DB::select("SELECT * FROM inventory WHERE ShopID = ".$ShopID);

	            $Json = json_encode($InventoryReport);

	            return response($Json);
	        } catch (\Exception $e) {
	            return false;                
	        }
	    }

	    public function PrintReport($ShopID)
	    {
	    	$Shop = Shop::findOrFail($ShopID);
	        $ShopName = $Shop->ShopName;

	        $ObjInventory  = new Inventory;	        
	        $Report = $ObjInventory->Report($ShopID);

	        return view('product.inventory.report', compact('Report', 'ShopName'));
	    }
	}