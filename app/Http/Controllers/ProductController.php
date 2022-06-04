<?php
    namespace ClassyPOS\Http\Controllers;

    use Illuminate\Http\Request;  
    use Illuminate\Http\Response;
    use URL;
    use Illuminate\Pagination\Paginator;  

    use ClassyPOS\shop\Shop;
    use ClassyPOS\supplier\Vendor;
    //use ClassyPOS\Item;
    use ClassyPOS\product\Product;
    use ClassyPOS\product\ProductCategory;
    use ClassyPOS\shop\ShopProductMapping;
    use ClassyPOS\shop\ShopCategoryMapping;
    use ClassyPOS\sales\InvoiceProductMapping;
    use Illuminate\Support\Facades\Session;

    use ClassyPOS\Tax\TaxCode;
    use DB;
    use ClassyPOS\user\ActivityLog;
    use Yajra\Datatables\Datatables;

    class ProductController extends Controller
    {

        public function Massive()
        {
            return "Fahad";
        }

        public function index()
        {
            return view('product.index');
        }

        // New category create view
        public function createCategory()
        {
            $CategoryList = ProductCategory::all();      

            return view('product.category',compact('CategoryList'));          

        }

        // New Product create view
        public function createProduct()
        {
            $CategoryList = ProductCategory::all();
            $VendorList =   Vendor::all();
            $TaxList =      TaxCode::all();
            return view('product.new',compact('CategoryList','VendorList', 'TaxList'));

        }

        // Store new product via post method
        public function storeProduct(Request $Data)
        {
            // Product Object declare

            //return $Data->all();



            $Product = new Product;
            // extract form data 
            $FormData = $Data->all();

            // if file is not selected it will be empty string
            if($Data->file('ProductImg') == "")
            {
                $ImageName = "No Image";
            }
            else
            {
                // retrieve original file path
                $ImageTempName = $Data->file('ProductImg')->getPathName();
                //retrieve original file name 
                $ImageName = $Data->file('ProductImg')->getClientOriginalName();
                // define path to upload image
                $Path = base_path() . '/public/uploads/image/product';
                // upload image to defined path directory
                $Data->file('ProductImg')->move($Path , $ImageName);
            }

            // Collecting data for Product table
            $Product->CategoryID         = $FormData['CategoryID'];
            $Product->VendorID           = $FormData['VendorID'];
            $Product->ProductName        = $FormData['ProductName'];
            if($FormData['ProductDescription']="" || $FormData['ProductDescription']==null)
            $Product->ProductDescription = "No Description";
            else
            {
                //$Product->ProductDescription = $FormData['ProductDescription'];
              $Product->ProductDescription =$Data->ProductDescription;
            }
            
            $Product->ProductImg         = $ImageName;
            if(isset($FormData['ProductEntryFromSale']))
            {
                $Product->Qty                = 0;
            }
            else
            $Product->Qty                = $FormData['Qty'];
            $Product->CostPrice          = $FormData['CostPrice'];
            $Product->SalePrice          = $FormData['SalePrice'];
            if(isset($FormData['PreferredPrice']))
            {
                if($FormData['PreferredPrice']=="" || $FormData['PreferredPrice']==null)
                    $Product->PreferredPrice=0;
                else
                    $Product->PreferredPrice     = $FormData['PreferredPrice'];

            }
            
            if($FormData['Unit']=="" || $FormData['Unit']==null)
            $Product->Unit=0;
            else
            $Product->Unit               = $FormData['Unit'];
            if($FormData['TaxCode']=="" || $FormData['TaxCode']==null)
            $Product->TaxCode=0;
            else                    
            $Product->TaxCode            = $FormData['TaxCode'];
            if($FormData['MinQtyLevel']=="" || $FormData['MinQtyLevel']==null)
            $Product->MinQtyLevel=0;
            else     
            $Product->MinQtyLevel        = $FormData['MinQtyLevel'];

            try {
                $Product->save();
                //$Success = 1;
            } catch (\Exception $e) {
                echo $e->getMessage();
                //$Success = 0;
            }


            $activity=new ActivityLog();
            $activity->UserID=session()->get('UserID');
            $activity->ShopID=session()->get('ShopID');
            $activity->ActivityName="Add New Product";
            $activity->save();

            //IF New Product Comes From Sales Panel It Will be Stored To the Shop

            if(isset($FormData['ProductEntryFromSale']))
            {
                $Mapping=new ShopProductMapping();
                $Mapping->ProductID=$Product->ProductID;
                $Mapping->ShopID=session()->get('ShopID');
                $Mapping->Qty=$Data->Qty;
                $Mapping->save();
                          


            }


            return back()->with('ProductInsert',"Product Added Successfully");            

        }

        // Store New product with minimum properties
        public function storeProductMin(Request $Data)
        {
            $Product=new Product();
            $Product->CategoryID         = $Data->CategoryID; 
            $Product->VendorID           = $Data->VendorID;
            $Product->ProductName        = $Data->ProductName;
            $Product->ProductDescription = $Data->ProductDescription;
            $Product->ProductImg         = "Nothing";
            $Product->Qty                = $Data->Qty;
            $Product->CostPrice          = $Data->CostPrice;
            $Product->SalePrice          = $Data->SalePrice;
            $Product->Unit               = $Data->Unit;
            $Product->TaxCode            = $Data->TaxCode;
            $Product->MinQtyLevel        = $Data->MinQtyLevel;

            try {
                $Product->save();
            } catch (\Exception $e) {

                echo $e->getMessage();
            } 
        }

        // Open Product for Instant Sale
        public function openProduct(Request $Data)
        {
            $Product = new Product();
            $Product->CategoryID         = $Data->CategoryID; 
            $Product->VendorID           = $Data->VendorID;
            $Product->ProductName        = $Data->ProductName;
            $Product->ProductDescription = $Data->ProductDescription;
            $Product->ProductImg         = "Nothing";
            $Product->Qty                = $Data->Qty;
            $Product->CostPrice          = $Data->CostPrice;
            $Product->SalePrice          = $Data->SalePrice;
            $Product->Unit               = $Data->Unit;
            $Product->TaxCode            = $Data->TaxCode;
            $Product->MinQtyLevel        = $Data->MinQtyLevel;

            $Prodct->save();
        }



        // Store Product Category
        public function storeCategory(Request $Data)
        {
            // declare new Category object
            $Category = new ProductCategory();

            // Extracting Form data
            $FormData = $Data->all();

            $Category->CategoryName = $FormData['CategoryName'];    

            // Inserting into database
            $Category->save();

            $activity=new ActivityLog();
            $activity->UserID=session()->get('UserID');
            $activity->ShopID=session()->get('ShopID');
            $activity->ActivityName="New Category Added";
            $activity->save();

            // return to category list view
            return redirect('/Product/Category');
        }

        // Category details
        public function detailsCategory($CategoryID)
        {
            $Details = ProductCategory::findOrFail($CategoryID);
            $Details = json_encode($Details);

            return response($Details);
        }

         // Category update
        public function updateCategory(Request $rq)
        {




            //$Product = Product::findOrFail($Data->ProductID);
            $Update = ProductCategory::findOrFail($rq->CategoryID);           
            $FormData = $rq->all();
            //return $FormData;      
            $ImageName=$Update->Image;            
            $Size=filesize($rq->file('CategoryImage'));

            //$ImageName = $rq->file('CategoryImage')->getClientOriginalName();
            //return response($ImageName);
            $Size=$Size/1024;
            
            if($Size<30 && $Size>0)
            {
                $Path = base_path() . '/public/uploads/image/productCategory/';
                $filenameImage=$Path.$Update->Image;
                if (file_exists($filenameImage) && !is_dir($filenameImage))
                {
                    unlink($Path.$Update->Image);
                }
                // retrieve original file path
                $Path = base_path() . '/public/uploads/image/productCategory/';
                //unlink($Path.$Product->ProductImg);
                $ImageTempName = $rq->file('CategoryImage')->getPathName();
                //retrieve original file name 
                $ImageName = $Update->CategoryID.$rq->file('CategoryImage')->getClientOriginalName();
                // define path to upload image
                $Path = base_path() . '/public/uploads/image/productCategory';
                // upload image to defined path directory
                $rq->file('CategoryImage')->move($Path , $ImageName);

            }
            $Update = ProductCategory::findOrFail($rq->CategoryID);
            $Update->CategoryName=$rq->CategoryName;
            $Update->Image=$ImageName;
            $Update->save();           

            //return response("good");
            return back();
        }



        public function storeCategoryByGetMethod($CategoryName)
        {
            $category = new ProductCategory;

            $category['CategoryName'] = $CategoryName;         

            #Inserting into database
            $category->save();

            return $category->CategoryID;

        }

        public function makeList()
        {
            $ProductList = DB::table('product')
            ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
            ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
            ->select('product.ProductID','product.ProductName','product.CostPrice', 'product.SalePrice', 'product.Qty', 'product_category.CategoryName','vendor.VendorName','product.InactiveProduct');
            // $ProductList = Product::all();

            return Datatables::of($ProductList)->make(true);
        }

        // Product  List
        public function listProduct()
        {

            $ProductList = DB::table('product')
            ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
            ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
            ->paginate(10); 

            $CategoryList = ProductCategory::all();
            $VendorList =   Vendor::all();

            $TaxList=TaxCode::all();
            return view('product.list',compact('ProductList', 'CategoryList','VendorList','TaxList'));
        }


        public function listProductMapping($ShopID)
        {
            $ProductList = DB::table('product')
            ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
            ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
            ->get();


            $json=json_encode($ProductList);

            $Mapping=ShopProductMapping::where('ShopID','=',$ShopID)->get();
            $jsonMapping=json_encode($Mapping);

            //$ShopProductList=

            return response(['ProductList'=>$json,'Mapping'=>$jsonMapping]);

            //return $ProductList;            

            //return view('product.list',compact('ProductList'));

        }



        // Filter Product List
        public function filterProductList($ShopID, $CategoryID, $VendorID, $DateFrom, $DateTo)
        {
            if ($DateFrom == 0) {
                $DateFrom = '0000-01-01';
            }

            if ($DateTo == 0) {
                $DateTo = date('Y-m-d', strtotime('+1 day'));
            }

            // If shop is not seleted
            if ($ShopID == 0) {

                // 00
                if ($CategoryID == 0 && $VendorID == 0) {
                    $List = DB::select("SELECT 
                        product.ProductID,
                        
                        product.CategoryID,
                        product_category.CategoryName,

                        product.VendorID,
                        vendor.VendorName,

                        product.ProductName,
                        product.ProductDescription,
                        product.ProductImg,
                        product.Qty,
                        product.CostPrice,
                        product.SalePrice,
                        product.Unit,
                        
                        product.TaxCode,
                        tax_code.TaxPercent,

                        product.InactiveProduct,
                        product.MinQtyLevel,
                        product.IsPurchased,
                        product.created_at,
                        product.updated_at

                        FROM product
                        LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
                        LEFT JOIN vendor ON product.VendorID = vendor.VendorID
                        LEFT JOIN tax_code ON product.TaxCode = tax_code.TaxCodeID

                        WHERE product.created_at BETWEEN '$DateFrom' AND '$DateTo'
                    ");

                    $List = json_encode($List);               
                }

                // 01
                if ($CategoryID == 0 && $VendorID != 0) {
                    $List = DB::select("SELECT 
                        product.ProductID,
                        
                        product.CategoryID,
                        product_category.CategoryName,

                        product.VendorID,
                        vendor.VendorName,

                        product.ProductName,
                        product.ProductDescription,
                        product.ProductImg,
                        product.Qty,
                        product.CostPrice,
                        product.SalePrice,
                        product.Unit,
                        
                        product.TaxCode,
                        tax_code.TaxPercent,

                        product.InactiveProduct,
                        product.MinQtyLevel,
                        product.IsPurchased,
                        product.created_at,
                        product.updated_at

                        FROM product
                        LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
                        LEFT JOIN vendor ON product.VendorID = vendor.VendorID
                        LEFT JOIN tax_code ON product.TaxCode = tax_code.TaxCodeID

                        WHERE product.VendorID = $VendorID AND product.created_at BETWEEN '$DateFrom' AND '$DateTo'
                    ");

                    $List = json_encode($List);               
                }

                // 10
                if ($CategoryID != 0 && $VendorID == 0) {
                    $List = DB::select("SELECT 
                        product.ProductID,
                        
                        product.CategoryID,
                        product_category.CategoryName,

                        product.VendorID,
                        vendor.VendorName,

                        product.ProductName,
                        product.ProductDescription,
                        product.ProductImg,
                        product.Qty,
                        product.CostPrice,
                        product.SalePrice,
                        product.Unit,
                        
                        product.TaxCode,
                        tax_code.TaxPercent,

                        product.InactiveProduct,
                        product.MinQtyLevel,
                        product.IsPurchased,
                        product.created_at,
                        product.updated_at

                        FROM product
                        LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
                        LEFT JOIN vendor ON product.VendorID = vendor.VendorID
                        LEFT JOIN tax_code ON product.TaxCode = tax_code.TaxCodeID

                        WHERE product.CategoryID = $CategoryID AND product.created_at BETWEEN '$DateFrom' AND '$DateTo'
                    ");

                    $List = json_encode($List);               
                }

                // 11
                if ($CategoryID != 0 && $VendorID != 0) {
                    $List = DB::select("SELECT 
                        product.ProductID,
                        
                        product.CategoryID,
                        product_category.CategoryName,

                        product.VendorID,
                        vendor.VendorName,

                        product.ProductName,
                        product.ProductDescription,
                        product.ProductImg,
                        product.Qty,
                        product.CostPrice,
                        product.SalePrice,
                        product.Unit,
                        
                        product.TaxCode,
                        tax_code.TaxPercent,

                        product.InactiveProduct,
                        product.MinQtyLevel,
                        product.IsPurchased,
                        product.created_at,
                        product.updated_at

                        FROM product
                        LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
                        LEFT JOIN vendor ON product.VendorID = vendor.VendorID
                        LEFT JOIN tax_code ON product.TaxCode = tax_code.TaxCodeID

                        WHERE product.CategoryID = $CategoryID AND product.VendorID = $VendorID AND product.created_at BETWEEN '$DateFrom' AND '$DateTo'
                    ");

                    $List = json_encode($List);               
                }
            }
            // If shop is selected
            else{
                // 00
                if ($CategoryID == 0 && $VendorID == 0) {
                    $List = DB::select("SELECT 
                        shop_product_mapping.ProductID,
                        
                        product.CategoryID,
                        product_category.CategoryName,

                        product.VendorID,
                        vendor.VendorName,

                        product.ProductName,
                        product.ProductDescription,
                        product.ProductImg,
                        shop_product_mapping.Qty,
                        product.CostPrice,
                        product.SalePrice,
                        product.Unit,
                        
                        product.TaxCode,
                        tax_code.TaxPercent,

                        product.InactiveProduct,
                        product.MinQtyLevel,
                        product.IsPurchased,
                        shop_product_mapping.created_at,
                        shop_product_mapping.updated_at

                        FROM shop_product_mapping
                        LEFT JOIN product ON shop_product_mapping.ProductID = product.ProductID
                        LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
                        LEFT JOIN vendor ON product.VendorID = vendor.VendorID
                        LEFT JOIN tax_code ON product.TaxCode = tax_code.TaxCodeID

                        WHERE shop_product_mapping.ShopID = $ShopID AND shop_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'
                    ");

                    return $List = json_encode($List);               
                }

                // 01
                if ($CategoryID == 0 && $VendorID != 0) {
                    $List = DB::select("SELECT 
                        shop_product_mapping.ProductID,
                        
                        product.CategoryID,
                        product_category.CategoryName,

                        product.VendorID,
                        vendor.VendorName,

                        product.ProductName,
                        product.ProductDescription,
                        product.ProductImg,
                        shop_product_mapping.Qty,
                        product.CostPrice,
                        product.SalePrice,
                        product.Unit,
                        
                        product.TaxCode,
                        tax_code.TaxPercent,

                        product.InactiveProduct,
                        product.MinQtyLevel,
                        product.IsPurchased,
                        shop_product_mapping.created_at,
                        shop_product_mapping.updated_at

                        FROM shop_product_mapping
                        LEFT JOIN product ON shop_product_mapping.ProductID = product.ProductID
                        LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
                        LEFT JOIN vendor ON product.VendorID = vendor.VendorID
                        LEFT JOIN tax_code ON product.TaxCode = tax_code.TaxCodeID

                        WHERE shop_product_mapping.ShopID = $ShopID AND product.VendorID = $VendorID AND shop_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'
                    ");

                    $List = json_encode($List);               
                }

                // 10
                if ($CategoryID != 0 && $VendorID == 0) {
                    $List = DB::select("SELECT 
                        shop_product_mapping.ProductID,
                        
                        product.CategoryID,
                        product_category.CategoryName,

                        product.VendorID,
                        vendor.VendorName,

                        product.ProductName,
                        product.ProductDescription,
                        product.ProductImg,
                        shop_product_mapping.Qty,
                        product.CostPrice,
                        product.SalePrice,
                        product.Unit,
                        
                        product.TaxCode,
                        tax_code.TaxPercent,

                        product.InactiveProduct,
                        product.MinQtyLevel,
                        product.IsPurchased,
                        shop_product_mapping.created_at,
                        shop_product_mapping.updated_at

                        FROM shop_product_mapping
                        LEFT JOIN product ON shop_product_mapping.ProductID = product.ProductID
                        LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
                        LEFT JOIN vendor ON product.VendorID = vendor.VendorID
                        LEFT JOIN tax_code ON product.TaxCode = tax_code.TaxCodeID

                        WHERE shop_product_mapping.ShopID = $ShopID AND product.CategoryID = $CategoryID AND shop_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'
                    ");

                    $List = json_encode($List);               
                }

                // 11
                if ($CategoryID != 0 && $VendorID != 0) {
                    $List = DB::select("SELECT 
                        shop_product_mapping.ProductID,
                        
                        product.CategoryID,
                        product_category.CategoryName,

                        product.VendorID,
                        vendor.VendorName,

                        product.ProductName,
                        product.ProductDescription,
                        product.ProductImg,
                        shop_product_mapping.Qty,
                        product.CostPrice,
                        product.SalePrice,
                        product.Unit,
                        
                        product.TaxCode,
                        tax_code.TaxPercent,

                        product.InactiveProduct,
                        product.MinQtyLevel,
                        product.IsPurchased,
                        shop_product_mapping.created_at,
                        shop_product_mapping.updated_at

                        FROM shop_product_mapping
                        LEFT JOIN product ON shop_product_mapping.ProductID = product.ProductID
                        LEFT JOIN product_category ON product.CategoryID = product_category.CategoryID
                        LEFT JOIN vendor ON product.VendorID = vendor.VendorID
                        LEFT JOIN tax_code ON product.TaxCode = tax_code.TaxCodeID

                        WHERE shop_product_mapping.ShopID = $ShopID AND product.CategoryID = $CategoryID AND product.VendorID = $VendorID AND shop_product_mapping.created_at BETWEEN '$DateFrom' AND '$DateTo'
                    ");

                    $List = json_encode($List);               
                }
            }

            return response($List);            
        }

        // Destroy Single Product From Main Stock
        public function destroyProduct($ProductID)
        {
            // find and object of product
            $Product = Product::findOrFail($ProductID);

            // delete the product
            $Product->delete();

            // return to list view
            return redirect('/Product/List');
        }

        // Load Product Edit Form
        public function editProduct($ProductID)
        {
            // retrieving all category list
            $CategoryList = ProductCategory::all();

            $JsonCategory=json_encode($CategoryList);

            // retrieving all vendor list
            $VendorList = Vendor::all();
            $JsonVendor=json_encode($VendorList);

            // retrieving product details
            $Product = Product::findOrFail($ProductID);
            $JsonProduct=json_encode($Product);

            // retriving Tax list
            $TaxList= TaxCode::all();

            $JsonTax=json_encode($TaxList);

            return response(['CategoryList'=>$JsonCategory,'Product'=>$JsonProduct,'VendorList'=>$JsonVendor,'TaxList'=>$JsonTax]);

            // return to product edit view
            //return view('product.edit',compact('Product','CategoryList','VendorList', 'TaxList'));
        }

        // Update Product
        public function updateProduct(Request $Data)
        {
            


            $Product = Product::findOrFail($Data->ProductID);
            //if($Product->ProductImg==null)
            //{
                //$Product->ProductImage="No Image";
            //$ImageName="No Image";
            //}
            
            
            // Extract form data
            $FormData = $Data->all();
            
            //return $FormData;



            //if($Data->file('ProductImg') == "")
            //{
                $ImageName=$Product->ProductImg;
                //if($ImageName==null)
                    //$ImageName="No Image";
                //$ImageName = "No Image";
            //}
            //else
            //{
                $Size=filesize($Data->file('ProductImg'));
                $Size=$Size/1024;
                if($Size<30 && $Size>0)
                {
                    $Path = base_path() . '/public/uploads/image/product/';
                    $filenameImage=$Path.$Product->ProductImg;
                    if (file_exists($filenameImage) && !is_dir($filenameImage))
                    {
                        unlink($Path.$Product->ProductImg);
                    }
                    // retrieve original file path
                    $Path = base_path() . '/public/uploads/image/product/';
                    //unlink($Path.$Product->ProductImg);
                    $ImageTempName = $Data->file('ProductImg')->getPathName();
                    //retrieve original file name 
                    $ImageName = $Data->ProductID.$Data->file('ProductImg')->getClientOriginalName();
                    // define path to upload image
                    $Path = base_path() . '/public/uploads/image/product';
                    // upload image to defined path directory
                    $Data->file('ProductImg')->move($Path , $ImageName);

                }

                
            //}

            if($FormData['ProductName']==""||$FormData['ProductName']==null)
                $Product->ProductName="No Name";
            else
            $Product->ProductName=$FormData['ProductName'];

            $Product->ProductDescription = $FormData['ProductDescription'];
            $Product->CategoryID         = $FormData['CategoryID'];
            $Product->VendorID           = $FormData['VendorID'];
            $Product->Qty                = $FormData['Qty'];
            $Product->CostPrice          = $FormData['CostPrice'];
            $Product->SalePrice          = $FormData['SalePrice'];
            $Product->ProductImg         = $ImageName;
            if($FormData['PreferredPrice']==""||$FormData['PreferredPrice']==null)
                $Product->PreferredPrice=0;
            else
                $Product->PreferredPrice    = $FormData['PreferredPrice'];


            $Product->MinQtyLevel        = $FormData['MinQtyLevel'];
            $Product->Unit               = $FormData['Unit'];
            $Product->TaxCode            = $FormData['TaxCode'];

            try {
                $Product->save();
                //$Success = 1;
            } catch (\Exception $e) {
                echo $e->getMessage();
                //$Success = 0;
            }           

            return back()->with('ProductEdit', 'Product Edited Successfully!');

        }

        // Single Product Details
        public function detailsProduct($ProductID)
        {
            // find product by ProductID
            $Product = Product::findOrFail($ProductID);
            $JsonProduct=json_encode($Product);

            $CategoryID = $Product->CategoryID;
            $VendorID    = $Product->VendorID;

            $Category = ProductCategory::findOrFail($CategoryID);
            $Vendor   = Vendor::findOrFail($VendorID);

            $CategoryName = $Category->CategoryName;
            $JsonCategoryName = json_encode($CategoryName);
            $VendorName    = $Vendor->VendorName;
            $JsonVendorName    =json_encode($VendorName);

            return response(['Product'=>$JsonProduct,'CategoryName'=>$JsonCategoryName,'VendorName'=>$JsonVendorName]);



            return view('product.details',compact('Product','CategoryName','VendorName'));

        }


        public function detailsProductforAdmin($ProductID)
        {
            // find product by ProductID
            $Product = Product::findOrFail($ProductID);

            $CategoryID = $Product->CategoryID;
            $VedorID    = $Product->VendorID;

            $Category = ProductCategory::findOrFail($CategoryID);
            $Vendor   = Vendor::findOrFail($VedorID);

            $CategoryName = $Category->CategoryName;
            $VendorName   = $Vendor->VendorName;

            $ProductJson      = json_encode($Product);
            $CategoryNameJson = json_encode($CategoryName);
            $VendorNameJson   = json_encode($VendorName);

            return response(['Product'=>$ProductJson,'CategoryName'=>$CategoryNameJson,'VendorName'=>$VendorNameJson]);


            //return view('product.details',compact('Product','CategoryName','VendorName'));

        }



        // Product Details
        public function detailsProductOfStock($ProductID)
        {
            $Details = Product::where('ProductID','=',$ProductID)->get();        
            $Details = json_encode($Details);

            return response($Details);
        }

        // Product Details from specific shop
        public function detailsProductOfShop($ProductID)
        {   
            // Retrieve ShopID from session
            $ShopID = session()->get('ShopID');

            $Details = ShopProductMapping::where('ShopID','=',$ShopID)
            ->join('product','product.ProductID','=','shop_product_mapping.ProductID')
            ->join('product_category','product_category.CategoryID','=','product.CategoryID')
            ->join('vendor','product.VendorID','vendor.VendorID')
            ->select('shop_product_mapping.Qty','product.ProductID','product.ProductName','product.SalePrice','product.CostPrice','product.PreferredPrice','product.ProductImg','vendor.VendorName','product_category.CategoryName')
            ->where('shop_product_mapping.ProductID','=',$ProductID)
            ->get();

            $Details = json_encode($Details);

            return response($Details);
        }  



        // Distribute 
        public function shopProductMapping()
        {

            $ven = Vendor::all();
            $shop=Shop::all();
            $Category=ProductCategory::all();

            return view('product.distribute.index',compact('ven','shop','Category'));

        }        

        // Distribute Many to One
        public function storeShopProductMapping(Request $r,$id)
        {
            $total=0;

            $quantity=[];

            foreach ($r->Quantity as $key => $value)
            {
                $total += $value;

                array_push($quantity,$value);
            }

            $pro=Product::findOrFail($id);

            $pro->Qty=$pro->Qty-$total;

            $pro->save();

            $identity=[];

            foreach ($r->Identity as $key => $value)
            {
                array_push($identity,$value);
            }

            $count=sizeof($identity);

            $shops=[];

            for($i=0;$i<$count;$i++)
            {
                $search=ShopProductMapping::where('ProductID','=',$id)->where('ShopID','=',$identity[$i])->first();

                if(sizeof($search)==0)
                {      
                    $pro= new ShopProductMapping();    
                    $pro->ShopID=$identity[$i];
                    $pro->ProductID=$id;
                    $pro->Qty=$quantity[$i];
                    $pro->save();
                }
                else
                {
                    $nana= $search->ID;
                    $dada  =ShopProductMapping::findOrFail($nana);
                    $dada->Qty=$dada->Qty+$quantity[$i];

                    $dada->save();
                }
            }

            return redirect('/Product/Distribute/'.$id);

        }

        # Distribute One to Many
        public function shopProductMappingList($ProductID)
        {

            $pro     = Product::findOrFail($ProductID);

            $proid   = $pro->ProductID;
            $ProductName    = $pro->ProductName;
            $ProductQuantity= $pro->Qty;
            $id      = $pro->ProductID;
            $all     = Shop::all();
            return view('product.distribute.list',compact('all','ProductQuantity','id','ProductName'));

        } 

        // Edit Many to one Distibute
        public function editShopProductMapping($id)
        {





            $pr=Product::findOrFail($id);
            $quantityintheinventory=$pr->Qty; 
            $all=Shop::all();

            $shopname=[];

            foreach($all as $data)
            {
                array_push($shopname,$data->ShopName);
            }

            $identity=[];

            foreach($all as $data)
            {
                array_push($identity,$data->ShopID);
            }

            $total=sizeof($all);

            $raider=ShopProductMapping::where('ProductID','=',$id)->get();



            $quantity=[];

            $tp=0;

            if(sizeof($raider)==0)
            {
                for($i=0;$i<$total;$i++)

                array_push($quantity,0);
            }
            else
            {

                for($i=0;$i<$total;$i++)
                {

                    $search =ShopProductMapping::where('ProductID','=',$id)->where('ShopID','=',$identity[$i])->first();

                    if(sizeof($search)==0)
                    {
                        $sq=0;
                    }

                    else
                    {
                        $sq=$search->Qty;

                    }                   

                    array_push($quantity,$sq);

                    $tp += $sq;
                }  
            }

            $JsonShop=json_encode($all);
            $JsonQuantity=json_encode($quantity);
            $Jsonid=json_encode($id);
            $JsonIdentity=json_encode($identity);
            $Jsontp=json_encode($tp);
            $Jsontotal=json_encode($total);
            $Jsonshopname=json_encode($shopname);
            $Jsonquantityintheinventory=json_encode($quantityintheinventory);
            $Jsonpr=json_encode($pr);

            return response(['all'=>$JsonShop,'quantity'=>$JsonQuantity,'identity'=>$JsonIdentity,'id'=>$Jsonid,'tp'=>$Jsontp,'total'=>$Jsontotal,'shopname'=>$Jsonshopname,'quantityintheinventory'=>$Jsonquantityintheinventory,'pr'=>$Jsonpr]);

            //return view('product.distribute.edit',compact('all','quantity','id','identity','tp','total','shopname','quantityintheinventory','pr'));

        }

        // Update Many to One Distribute


        public function updateShopProductMapping(Request $r)
        {



            $ID=$r->ProductIDDistribute;
            $prev=$r->ProductPreviousQuantity;

            $total=0;
            $quantity=[];

            foreach ($r->Quantity as $key => $value) 
            {                
                $total=$total+$value;

                array_push($quantity,$value);
            }

            $pro=Product::findOrFail($ID);



            $Cate=ProductCategory::where('CategoryID','=',$pro->CategoryID)->get();

            $CategoryID=$Cate[0]->CategoryID;

            $extra=0;

            if($total>=$prev)
            {
                $extra=$total-$prev;

                $pro->Qty=$pro->Qty-$extra;

                $pro->save();
            }
            else
            {
                $min=$prev-$total;

                $pro->Qty=$pro->Qty+$min;

                $pro->save();
            }

            $identity=[];

            foreach ($r->Identity as $key => $value) 
            {
                array_push($identity,$value);
            }

            $count=sizeof($identity);

            for($i=0;$i<$count;$i++)
            {
                $CategorySearch=ShopCategoryMapping::where('CategoryID','=',$CategoryID)->where('ShopID','=',$identity[$i])->get();

                if(sizeof($CategorySearch)==0)
                {
                    $CategoryMapping=new ShopCategoryMapping();
                    $CategoryMapping->ShopID=$identity[$i];
                    $CategoryMapping->CategoryID=$CategoryID;
                    $CategoryMapping->save();
                }     

            }



            $shops=[];

            for($i=0;$i<$count;$i++)
            {                
                $search=ShopProductMapping::where('ProductID','=',$ID)->where('ShopID','=',$identity[$i])->get()->first();

                if(sizeof($search)==0)
                {
                    $pro= new ShopProductMapping();
                    $pro->ShopID=$identity[$i];
                    $pro->ProductID=$ID;
                    $pro->Qty=$quantity[$i];
                    $pro->save();             


                }
                else
                {
                    $nana= $search->ID;
                    $dada  =ShopProductMapping::findOrFail($nana);
                    $dada->Qty=$quantity[$i];
                    $dada->save();
                }
            }

            
            return back();

        }



       /* public function updateShopProductMapping(Request $r, $id)
        {


            return $id;
            $tp= $r->saeed;           


            $prev= $tp;

            //return $prev;



            $total=0;
            $quantity=[];

            foreach ($r->Quantity as $key => $value) 
            {                
                $total=$total+$value;

                array_push($quantity,$value);
            }


            $pro=Product::findOrFail($id);

            $Cate=ProductCategory::where('CategoryID','=',$pro->CategoryID)->get();

            $CategoryID=$Cate[0]->CategoryID;

            $extra=0;

            if($total>=$prev)
            {
                $extra=$total-$prev;

                $pro->Qty=$pro->Qty-$extra;

                $pro->save();
            }
            else
            {
                $min=$prev-$total;

                $pro->Qty=$pro->Qty+$min;

                $pro->save();
            }

            $identity=[];

            foreach ($r->Identity as $key => $value) 
            {
                array_push($identity,$value);
            }

            $count=sizeof($identity);

            for($i=0;$i<$count;$i++)
            {
                $CategorySearch=ShopCategoryMapping::where('CategoryID','=',$CategoryID)->where('ShopID','=',$identity[$i])->get();

                if(sizeof($CategorySearch)==0)
                {
                    $CategoryMapping=new ShopCategoryMapping();
                    $CategoryMapping->ShopID=$identity[$i];
                    $CategoryMapping->CategoryID=$CategoryID;
                    $CategoryMapping->save();
                }     

            }

                

            $shops=[];

            for($i=0;$i<$count;$i++)
            {                
                $search=ShopProductMapping::where('ProductID','=',$id)->where('ShopID','=',$identity[$i])->first();

                if(sizeof($search)==0)
                {
                    $pro= new ShopProductMapping();
                    $pro->ShopID=$identity[$i];
                    $pro->ProductID=$id;
                    $pro->Qty=$quantity[$i];
                    $pro->save();

                    


                }
                else
                {
                    $nana= $search->ID;

                    $dada  =ShopProductMapping::findOrFail($nana);

                    $dada->Qty=$quantity[$i];

                    $dada->save();
                }
            }

            return redirect('/Product/Distribute/Edit/'.$id);

        }*/ 

        # Shopwise Product List By Ajax Call
        public function shopWiseProductListByAjax($id)
        {
            $good=product_shop_mapping::where('ShopID','=',$id)
            ->join('product','product.ProductID','=','shop_product_mapping.ProductID')
            ->getArray();

            $dad=json_encode($good);
            return Response::json($dad);

        }

        // Shopwise Product List
        public function ShopWiseProductList($ShopID)
        {
            $good=ShopProductMapping::where('ShopID','=',$id)
            ->join('product','product.ProductID','=','shop_product_mapping.ProductID')
            ->select('shop_product_mapping.Qty','shop_product_mapping.ShopID','product.ProductName','product.ProductID')
            ->get();

            $json = json_encode($good);        

            return response()->json($json);

        }

        // Product Report
        public function Report()
        {
            $ShopList = Shop::all();
            $VendorList = Vendor::all();
            $CategoryList = ProductCategory::all();
            
            return view ('product.report.index', compact('ShopList', 'VendorList', 'CategoryList'));

        }

        // Many to one distribute
        public function ShopByShop(Request $request)
        {


            //return $request->all(); 
            //ini_set('memory_limit', '1024M');
            //ini_set('max_execution_time', 3000);
            $Change=$request->Change;
            $ShopID=$request->ShopID;
            $Checked=[];
            $Productid=[];
            $productid=[];
            $Quantity=[];
            $quantity=[];

            $quantity=[];
            $ProductName=[];
            foreach($request->checking1 as $key=>$value)
                {
                    array_push($Checked,$value);
                }

                //return sizeof($Checked);

            foreach($request->ProductID1 as $key=>$value)
                {
                    array_push($productid,$value);
                }

            foreach($request->Quantity1 as $key=>$value)
                {
                    array_push($quantity,$value);
                }


                
            $total=sizeof($Checked);

            //return $total;

            for($i=0;$i<$total;$i++)
            {
                if($Checked[$i]==1)
                {
                    array_push($Productid,$productid[$i]);
                    array_push($Quantity,$quantity[$i]);

                }
            }

          
            $count=sizeof($Productid);
            $ProductCategory=[];

            for($i=0;$i<$count;$i++)
            {
                $Category=Product::where('ProductID','=',$Productid)->get();
                array_push($ProductCategory,$Category[0]->CategoryID);

            }

            for($i=0;$i<$count;$i++)
            {

                $CategorySearch=ShopCategoryMapping::where('CategoryID','=',$ProductCategory[$i])->where('ShopID','=',$ShopID)->get();

                if(sizeof($CategorySearch)==0)
                {
                $CategoryMapping=new ShopCategoryMapping();
                $CategoryMapping->ShopID=$ShopID;
                $CategoryMapping->CategoryID=$ProductCategory[$i];
                $CategoryMapping->save();
                }

            }

            




            //return $count;

            if($Change=="Edit")
            {

                 //return "I am Fahad";
                for($i=0;$i<$count;$i++)
                {                
                    $search=ShopProductMapping::where('ProductID','=',$Productid[$i])->where('ShopID','=',$ShopID)->first();
                    
                    $ID= $search->ID;
                    $dada  =ShopProductMapping::findOrFail($ID);
                    $PreviousShopQuantity=$dada->Qty;
                    $dada->Qty=$Quantity[$i];
                    $dada->save();
                    $ChangedQuantity=$Quantity[$i]-$PreviousShopQuantity;
                    $product=Product::findOrFail($Productid[$i]);
                    $PreviousInventoryQuantity=$product->Qty;
                    $CurrentInventoryQuantity=$PreviousInventoryQuantity-$ChangedQuantity;
                    $product->Qty=$CurrentInventoryQuantity;
                    $product->save();
                    


                }

                return back()->with('ShopWiseProductEdit','WonderFul');

            }

            for($i=0;$i<$count;$i++)
            {                
                $search=ShopProductMapping::where('ProductID','=',$Productid[$i])->where('ShopID','=',$ShopID)->get();



                if(sizeof($search) == 0)
                {
                    $pro= new ShopProductMapping();
                    $pro->ShopID=$ShopID;
                    $pro->ProductID=$Productid[$i];
                    $pro->Qty=$Quantity[$i];
                    $pro->save();

                    $product=Product::findOrFail($Productid[$i]);
                    $InventoryQuantity=$product->Qty;
                    $NewInventoryQuantity=$InventoryQuantity-$Quantity[$i];
                    $product->Qty=$NewInventoryQuantity;
                    $product->save();

                    
                }
                else
                {
                    $ID= $search[0]->ID;
                    $dada  =ShopProductMapping::findOrFail($ID);
                    $PreviousShopQuantity=$dada->Qty;                    
                    $NewShopQuantity=$Quantity[$i]+$PreviousShopQuantity;
                    $ChangedQuantity=$NewShopQuantity-$PreviousShopQuantity;
                    $dada->Qty=$NewShopQuantity;
                    $dada->save();
                    $product=Product::findOrFail($Productid[$i]);
                    $InventoryQuantity=$product->Qty;
                    $NewInventoryQuantity=$InventoryQuantity-$ChangedQuantity;
                    $product->Qty=$NewInventoryQuantity;
                    $product->save();
                }
            }

            return back(); 

        }

        public function TopSold()
        {
            $InvoiceProductMapping = new InvoiceProductMapping;
            $TopSold = $InvoiceProductMapping->TopSold(5);
            $TopSold = json_encode($TopSold);

            return response($TopSold);
        }

        public function saleNewProduct(Request $rq)
        {
          return $rq->all();
        }

        public function shopProductList()
        {
            $ven = Vendor::all();
            $shop=Shop::all();
            $Category=ProductCategory::all();
            return view('product.ShopProductMapping',compact('ven','shop','Category'));
        }


        /* public function productSearch(Request $request)
        {


            if($request->has('titlesearch')){
            $items = Item::search($request->titlesearch)
            ->paginate(5);
            }else{
            $items = Item::paginate(5);

            //return $items;
            }

            //return $items;

            //return $request->titlesearch;



            return Product::search($request->titlesearch)->paginate(5);


            /*$ProductList = DB::table('product')
            ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
            ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
            ->search($request->titlesearch)
            ->paginate(15);

            //return $ProductList;            

            

            if($request->has('titlesearch'))
            {

                $ProductList = DB::table('product')
                ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
                ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
                ->search($request->titlesearch)
                ->paginate(15);
                //$items = Product::search($request->titlesearch)
                //->paginate(5);
            }
            else
            {

                $ProductList = DB::table('product')
                ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
                ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
                ->search($request->titlesearch)
                ->paginate(15);
                //$items = Product::paginate(5);
            }

            return view('product.list',compact('ProductList'));

        }*/


        public function searchItemByName(Request $rq,$SearchValue,$CategoryID)
        {

            $currentpage=1;

            $uri = $_SERVER['REQUEST_URI'];

            $needle = "page=";
            if (strpos($uri, $needle) == false)
            {
                $currentpage=1;



             //echo "Found!";
            }

            if (strpos($uri, $needle) != false)
            {
                $pieces = explode("page=", $uri);
                $currentpage=$pieces[1];

             //echo "Found!";
            }


            /*$currentPage = 3; // You can set this to any page you want to paginate to

            // Make sure that you call the static method currentPageResolver()
            // before querying users
            Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
            });*/


            //return $currentpage;


                        //return $pieces[1];

            
             
             

             //return $currentpage;


             //$currentpage=22;

             //return $currentpage;




            //$currentURL = URL::current();
            //return $currentURL;

            //00
            if($CategoryID==0 && $SearchValue=="NoName")
            {





                //$currentURL = URL::current();

                //return $currentURL;



                //$url=$request->path();

                //return $url;


                //return Product::paginate(6, ['*'], 'page',6);


                // $ProductList = DB::table('product')
                // ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
                // ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
                // ->paginate(10);

                return view('product.list',compact('ProductList'));
                //->paginate(10,['*'],'page',11);


                $pagi = ''.$ProductList->links().'';
                $page=json_encode($pagi);
                $jsonProduct=json_encode($ProductList);
                //return response($jsonProduct);
                return response(['product'=>$jsonProduct,'page'=>$page]);

            }
            //return $CategoryID;
            //11
            if($CategoryID!=0 && $SearchValue!="NoName")
            {

                //return "I am Faahd";

                $Aus=$SearchValue;
                $ProductList = DB::table('product')
                ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
                ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
                ->where('product.ProductName','LIKE',"%{$Aus}%")
                ->where('product.CategoryID','=',$CategoryID)
                ->paginate(10);

                //return view('product.list',compact('ProductList'));
                //->paginate(10,['*'],'page',$currentpage);
                $pagi = ''.$ProductList->links('vendor.pagination.default').'';
                $page=json_encode($pagi);
                $jsonProduct=json_encode($ProductList);
                //return response($jsonProduct);
                return response(['product'=>$jsonProduct,'page'=>$page]);
                //$jsonProduct=json_encode($ProductList);
                //return response($jsonProduct);

            }


            //01
            if($CategoryID==0 && $SearchValue!="NoName")
            {

                //return "I am Faahd";

                $Aus=$SearchValue;
                $ProductList = DB::table('product')
                ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
                ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
                ->where('product.ProductName','LIKE',"%{$Aus}%")
                ->paginate(13);
                //->paginate(13,['*'],'page',$currentpage);
                $pagi = ''.$ProductList->links().'';
                $page=json_encode($pagi);
                $jsonProduct=json_encode($ProductList);
                //return response($jsonProduct);
                return response(['product'=>$jsonProduct,'page'=>$page]);


            }



            //10
            if($CategoryID!=0 && $SearchValue=="NoName")
            {



                //return "I am Jahid";

                $ProductPerPage=10;

                $ProductLen= DB::table('product')
                ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
                ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
                ->where('product.CategoryID','=',$CategoryID)
                ->get();

                $Total=sizeof($ProductLen);

                if($Total<$ProductPerPage)
                {
                    $ProductPerPage=$Total;
                }

                $ProductList = DB::table('product')
                ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
                ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
                ->where('product.CategoryID','=',$CategoryID)
                ->paginate($ProductPerPage);

                //return view('product.new');
                //return view('product.list',compact('ProductList'));
                //return view('product.list',compact('ProductList'));
                //->paginate(10,['*'],'page',$currentpage);
                $pagi = ''.$ProductList->links().'';
                $page=json_encode($pagi);
                $jsonProduct=json_encode($ProductList);
                //return response($jsonProduct);
                return response(['product'=>$jsonProduct,'page'=>$page]);

            }

           /* if($SearchValue=="")
            {
                $ProductList = DB::table('product')
                ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
                ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
                ->get();

            }
            else
            {
                $Aus=$SearchValue;
                $ProductList = DB::table('product')
                ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
                ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
                ->where('product.ProductName','LIKE',"%{$Aus}%")
                ->get();

            }*/
            

            //$search = 'hdtopi';
//$user = User::where('name','LIKE',"%{$search}%")
              //->get();

            //$jsonProduct=json_encode($ProductList);
            //return response($jsonProduct);
            //return view('Item-search',compact('items'));
        }


        public function searchItemByID($SearchValue)
        {
            //return $SearchValue;

            if($SearchValue=="")
            {
                $ProductList = DB::table('product')
                ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
                ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
                ->get();

            }
            else
            {
                $Aus=$SearchValue;
                $ProductList = DB::table('product')
                ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
                ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
                ->where('product.ProductID','=',$SearchValue)
                ->get();

            }
            

            //$search = 'hdtopi';
//$user = User::where('name','LIKE',"%{$search}%")
              //->get();

            $jsonProduct=json_encode($ProductList);
            return response($jsonProduct);
            //return view('Item-search',compact('items'));
        }


        public function ProductListAjax(Request $request)
        {


            $products = DB::table('product')
            ->leftjoin('product_category', 'product.CategoryID', '=', 'product_category.CategoryID')
            ->leftjoin('vendor', 'product.VendorID', '=', 'vendor.VendorID')
            ->paginate(10);

            //return $ProductList;    

            $CategoryList = ProductCategory::all();

            //return view('product.list',compact('ProductList', 'CategoryList'));

            //$products = Product::paginate(5);
            if ($request->ajax()) 
            {
            return view('presult', compact('products','CategoryList'));
            }
        return view('productlist',compact('products','CategoryList'));

        }

        public function searchProduct($ProductName)
        {
            $ProductList = DB::table('product')
            ->select('product.ProductID', 'product.ProductName', 'product.SalePrice')
            ->where('product.ProductName','LIKE',"%{$ProductName}%")
            ->get();

            $ProductList = json_encode($ProductList);

            return response($ProductList);
        }
        
    }
