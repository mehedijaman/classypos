<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use ClassyPOS\user\UserRoleCategory;
use ClassyPOS\user\UserRole;


class RoleController extends Controller
{


  
  public function SalesRole($URL)
  {
    
   
   $url=$URL;
   $admin=Auth::user()->admin;
      
      if($admin>=5)
        return 1;    

     $all=UserRoleCategory::where('RoleRouteName','=',$url)->get();

     if(count($all)==0)
            return 1;   

      $roleid= $all[0]->RoleCategoryID;
      $id = Auth::user()->id;
      $admin=Auth::user()->admin;

      $Access=UserRole::where('RoleCategoryID','=',$roleid)
                ->where('UserID','=',$id)
                ->get();

      if(count($Access)==0)
      {
        return 0;
      }


      if(count($Access)==1)
      {

        return 1;
      } 





  }

public function CancelRole()
{


  return 1;


}



public function CalculatorRole()
{


  return 1;


}








  public function CustomerDetailsRole()
  {



  	$admin=Auth::user()->admin;
      
      if($admin>=5)
      	return 1;



  	$url="CustomerDetailsSales";
     $all=UserRoleCategory::where('RoleRouteName','=',$url)->get();

     if(count($all)==0)
            return 1;   

      $roleid= $all[0]->RoleCategoryID;
      $id = Auth::user()->id;    
      $Access=UserRole::where('RoleCategoryID','=',$roleid)
                  ->where('UserID','=',$id)
                  ->get();
      if(count($Access)==0)
      {
        return 0;
      }
      if(count($Access)==1)
      {

        return 1;
      }    



  }



  public function NewCustomerRole()
  {



    $url="NewCustomerSales";


    $admin=Auth::user()->admin;
      
      if($admin>=5)
        return 1;
     $all=UserRoleCategory::where('RoleRouteName','=',$url)->get();

     if(count($all)==0)
            return 1;   

      $roleid= $all[0]->RoleCategoryID;
      $id = Auth::user()->id;    
      $Access=UserRole::where('RoleCategoryID','=',$roleid)
                  ->where('UserID','=',$id)
                  ->get();
      if(count($Access)==0)
      {
        return 0;
      }
      if(count($Access)==1)
      {

        return 1;
      }    







  }




    




}
