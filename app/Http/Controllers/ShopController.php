<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use ClassyPOS\shop\Shop;
use ClassyPOS\shop\ShopCategoryMapping;
use ClassyPOS\shop\ShopProductMapping;
use ClassyPOS\shop\ShopSettings;
use ClassyPOS\sales\InvoiceSettings;
use ClassyPOS\user\UserRoleCategory;
use ClassyPOS\user\UserRole;



class ShopController extends Controller
{
  public function index()
  {
    return view('shop.shop');
  }

    # Load New Shop create view
    public function create()
    {      
      return view('shop.new');
    }


    # Store New shop
    public function store(Request $Data)
    {
      // Shop object declare
    	$Shop = new Shop;

      // extracting form data
      $FormData = $Data->all();


      if($Data->file('ShopLogo') == "")
      {
        $ImageName = "";
        
      }
      else
      {
        // retrieve original file path
        $ImageTempName = $Data->file('ShopLogo')->getPathName();

        //retrieve original file name 
        $ImageName = $Data->file('ShopLogo')->getClientOriginalName();
        
        // define path to upload image
        $Path = base_path() . '/public/uploads/image/shop';

        // upload image to defined path directory
        $Data->file('ShopLogo')->move($Path , $ImageName);
      }  
      
      // collecting data for shop table
      $Shop->ShopName     = $FormData['ShopName'];
      $Shop->ShopAddress  = $FormData['ShopAddress'];
      $Shop->Phone        = $FormData['Phone'];
      $Shop->Email        = $FormData['Email'];
      $Shop->Website      = $FormData['Website'];
      $Shop->ShopLogo     = $ImageName;

      

      try 
      {
        // store shop to shop table
        $Shop->save();
        $Settings=new InvoiceSettings();
        $Settings->ShopID=$Shop->ShopID;
        $Settings->Header="";
        $Settings->Footer="";
        $Settings->save(); 
        

        // return to Shop create view
        return redirect('/Shop/New');       
      } 
      catch (\Exception $e) 
      {
        echo $e->getMessage();
      }


    }

    #Shop Details
    public function details($ShopID)
    {
      $Shop = Shop::findOrFail($ShopID);

      return view('shop.details', compact('Shop'));
    }

    # Show Shop List
    public function listShop()
    {
      $ShopList = Shop::all();
      $UserID=session()->get('UserID');

      $UserRoleCategory=UserRoleCategory::all();

      $TotalCategory=count($UserRoleCategory);

      $UserRole=UserRole::where('UserID','=',$UserID)->get();

      $SingleUserRole=[];
      $RoleID=[];
      $RoleRouteName=[];
      $RoleCategoryName=[];

      foreach($UserRoleCategory as $data)
      {

        array_push($RoleID,$data->RoleCategoryID);
        array_push($RoleCategoryName,$data->RoleCategoryName);
        array_push($RoleRouteName,$data->RoleRouteName);
      }

      foreach($UserRole as $data)
        array_push($SingleUserRole,$data->RoleCategoryID);

      $TotalRole=count($SingleUserRole);

      return view('shop.list',compact('ShopList','UserRoleCategory','UserID','SingleUserRole','TotalCategory','TotalCategory','TotalRole','RoleID','RoleCategoryName','RoleRouteName'));
    }

    # Load shop edit view
    public function edit($ShopID)
    {
      // retrive shop data
      $Shop = Shop::findOrFail($ShopID);

      // load edit view
      return view('shop.edit', compact('Shop'));
    }

    public function mapping($ShopID)
    {

      $Shop=Shop::findOrFail($ShopID);

      $Category=ShopCategoryMapping::where('ShopID','=',$ShopID)->leftjoin('product_category','product_category_shop_mapping.CategoryID','=','product_category.CategoryID')->get();

      //return $Category;

      //return "I am Fahad";
      return view('shop.categorymapping',compact('Shop','Category'));

    }

    public function settings($ShopID)
    {

      //$Settings=ShopSettings::findOrFail($ShopID);
      $Settings=ShopSettings::where('ShopID','=',$ShopID)->get()->first();

      if(count($Settings)==0)
      {
        $SettingsCreate=new ShopSettings();
        $SettingsCreate->ShopID      =$ShopID;
        $SettingsCreate->IsRestaurant=0;
        $SettingsCreate->IsServiceCharge=0;
        $SettingsCreate->ServiceCharge=0;
        $SettingsCreate->IsTips=0;
        $SettingsCreate->IsTax=0;
        $SettingsCreate->IsOrder=0;
        $SettingsCreate->IsHold=0;
        $SettingsCreate->IsAdvance=0;
        $SettingsCreate->IsBarcode=0;
        $SettingsCreate->IsRefund=0;
        $SettingsCreate->IsDiscount=0;
        $SettingsCreate->InvoiceSize="Mini";
      
        $SettingsCreate->save();

        return "NoSetting";
      }
      $JsonSettings=json_encode($Settings);
      return response($JsonSettings);

      


    }

    public function settingsUpdate($ShopID,$Index,$Value,$Service)
    {

      
      
      $Settings=ShopSettings::where('ShopID','=',$ShopID)->get()->first();

      if($Index==0)
      {
        $Settings->IsRestaurant=$Value;
        $Settings->save();
      }
      if($Index==1)
      {
        $Settings->IsServiceCharge=$Value;        
        if($Value==1)
        {
          $Settings->ServiceCharge=$Service;
        }
        $Settings->save();
      }
      if($Index==2)
      {
        $Settings->IsTax=$Value;
        $Settings->save();
      }
      if($Index==3)
      {
        $Settings->IsOrder=$Value;
        $Settings->save();
      }
      if($Index==4)
      {
        $Settings->IsHold=$Value;
        $Settings->save();
      }
      if($Index==5)
      {
        $Settings->IsTips=$Value;
        $Settings->save();
      }
      if($Index==6)
      {
        $Settings->IsAdvance=$Value;
        $Settings->save();
      }
      if($Index==7)
      {
        $Settings->IsBarcode=$Value;
        $Settings->save();
      }
      if($Index==8)
      {
        $Settings->IsRefund=$Value;
        $Settings->save();
      }

      if($Index==9)
      {
        $Settings->IsDiscount=$Value;
        $Settings->save();
      }




      //if(count($Settings)==0)
        //return "This Shop Is Getting Updated for the First Time";
      //$JsonSettings=json_encode($Settings);


      //return response($JsonSettings);

      


    }


    public function mappingProduct($ShopID)
    {

      $Shop=Shop::findOrFail($ShopID);

      $Category=ShopProductMapping::where('ShopID','=',$ShopID)->leftjoin('product','shop_product_mapping.ProductID','=','product.ProductID')->get();

      //return $Category;

      //return "I am Fahad";
      return view('shop.productmapping',compact('Shop','Category'));

    }


    public function mappingDelete($MappingID)
    {

      ShopCategoryMapping::findOrFail($MappingID)->delete();
      
    }


    public function mappingProductDelete($MappingID)
    {

      //$Saeed=0;

      //$Saeed=$Saeed+1;

      ShopProductMapping::findOrFail($MappingID)->delete();
      //return response($Saeed);
      
    }


    # Update Shop
    public function update(Request $Data, $ShopID)
    {
      // find and object of shop

      $Shop = Shop::findOrFail($ShopID);

      if($Data->file('ShopLogo') == "")
      {
        $ImageName = $Shop->ShopLogo;
        
      }
      else
      {
        // retrieve original file path
        $ImageTempName = $Data->file('ShopLogo')->getPathName();

        //retrieve original file name 
        $ImageName = $Data->file('ShopLogo')->getClientOriginalName();
        
        // define path to upload image
        $Path = base_path() . '/public/uploads/image/shop';

        // upload image to defined path directory
        $Data->file('ShopLogo')->move($Path , $ImageName);
      }  
      $Shop = Shop::findOrFail($ShopID);
      
      // extract form data
      $FormData = $Data->all();

      // collecting form data for update
      $Shop->ShopName = $FormData['ShopName'];
      $Shop->ShopAddress = $FormData['ShopAddress'];
      $Shop->Phone = $FormData['Phone'];
      $Shop->Email = $FormData['Email'];
      $Shop->Website = $FormData['Website'];
      $Shop->ShopLogo = $ImageName;

      try {
        // update shop
        $Shop->save();
      } 
      catch (\Exception $e) {
        echo $e->getMessage();
      }

      return redirect('/Shop/Edit/'.$ShopID);

    }
    

    # Destroy a shop
    public function destroy($id)
    {

      $del=Shop::findOrFail($id);
      $del->delete();
      return redirect('ShopList');
    }
}
