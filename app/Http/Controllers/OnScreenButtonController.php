<?php
  namespace ClassyPOS\Http\Controllers;

  use Illuminate\Http\Request;
  use ClassyPOS\shop\Shop;
  use ClassyPOS\shop\ShopProductMapping;
  use ClassyPOS\product\ProductCategory;
  use ClassyPOS\sales\OnScreenButton;

  class OnScreenButtonController extends Controller
  {
      
    # Load On Screen Button create form
    public function createOnScreenButton()
    { 

      $ShopList = Shop::all();

      $CategoryList = ProductCategory::all();

      $OnscreenButton = new OnscreenButton;
      $OnScreenButtonList = $OnscreenButton->ListAll();

      return view('settings.osb',compact('ShopList','CategoryList','OnScreenButtonList'));
    }


    # STore On Screen Button
    public function storeOnScreenButton($id1,$id2,$id3)
    { 


      $all = OnscreenButton::where('ShopID','=',$id1)->where('ProductID','=',$id2)->get();

      $total = count($all);

      if( $total > 0 )
       	return $total;

      $topr   = OnScreenButton::where('ShopID','=',$id1)->get();

      $toprco = count($topr);

      if($toprco > 9)
        return $toprco;  

      $sh = new OnScreenButton();

      $sh->ShopID     = $id1;
      $sh->ProductID  = $id2;
      $sh->DisplayText= $id3;

      $sh->save();
    }
    

    # List On Screen Buttons From Database
    public function listOnScreenButton()
    {
      # code...
    }

    # Delete On Screen Buttons From Database
    public function destroy($ButtonID)
    {
      $Button = OnScreenButton::findOrFail($ButtonID);

      $Button->delete();

      return redirect('/OnScreenButton');
    }

    public function ShopwiseCategoryList($ShopID)
        {


            $List = ShopProductMapping::where('ShopID','=',$ShopID)
            ->join('product','shop_product_mapping.ProductID','=','product.ProductID')
            ->join('product_category','product.CategoryID','=','product_category.CategoryID')
            ->select('product_category.CategoryName','product_category.CategoryID')
            ->get();
            $Json = json_encode($List);
            return response($Json);  

        }
  }
