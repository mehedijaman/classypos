<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use ClassyPOS\user\UserNew;
use ClassyPOS\user\UserRoleCategory;
use ClassyPOS\user\UserRole;
use ClassyPOS\shop\Shop;
use ClassyPOS\User;
use ClassyPOS\user\ActivityLog;
use ClassyPOS\sales\Invoice;
use ClassyPOS\Kitchen\Kitchen;
use DB;

class UserController extends Controller
{   
  public function index()
  {
    return view('user.index');
  }


  
  # Load user create view
  public function create()    
  {

    $Kitchen=Kitchen::all();
    $us = User::where('admin','=',0)->get();
    //$ShopID=session()->get('ShopID');
    $all = Shop::all();
        
    return view('user.new',compact('all','us','Kitchen'));
  }

  # Store Users into database
  public function store(Request $data)
  {



    $user = new UserNew(); 
    $all  = $data->all();
    //return $all['Kitchen'];
    

    $user['Phone']      = $all['Phone'];
    $user['UserID']     = $all['UserID'];
    $user['ShopID']     = $all['ShopID'];
    $user['FirstName']  = $all['FirstName'];
    $user['LastName']   = $all['LastName'];
    $user['Address']    = $all['Address'];
    $user['City']       = $all['City'];
    $user['Province']   = $all['Province'];
    $user['ZipCode']    = $all['ZipCode'];
    $user['Country']    = $all['Country'];
    $user['DateOfBirth']= $all['DateOfBirth'];
    if($data->Kitchen>0)
      $user['KitchenID']  = $all['Kitchen'];
    else
      $user['KitchenID']=0;


    if($data->file('UserImg'))
    {
      $imageName = $data->file('UserImg')->getClientOriginalName();

      $user['UserImg'] = $imageName;

      $user->save();

      $path = base_path() . '/public/uploads/image/user';
      $data->file('UserImg')->move($path , $imageName);
        
    } 

    $user->save();    

    $iden = $all['UserID'];
    $mail = $all['Email'];
    $pass = $all['Password'];

    $good = User::findOrFail($iden);

    $good->name     = $all['LastName'];
    $good->admin    = $all['Duty'];
    $good->email    = $mail;
    $good->password = bcrypt($pass);
    $good->phone    = $all['Phone'];

    // Insert into database
    $good->save();       

    return redirect('/User/List');
  }

  # Return users list
  public function listUser()
  {
    // get all user list
    $UserList = DB::table('user')
    ->leftjoin('users', 'user.UserID', '=', 'users.id')
    ->leftjoin('shop', 'user.ShopID', '=', 'shop.ShopID')
    ->select('user.UserID', 'user.ShopID', 'user.KitchenID', 'user.Phone', 'user.FirstName', 'user.LastName', 'user.Address', 'user.City', 'user.Province', 'user.ZipCode', 'user.Country', 'user.DateOfBirth', 'user.UserImg', 'user.created_at', 'user.updated_at', 'shop.ShopName', 'users.email', 'users.admin')
    ->get();

    // return $UserList;

    return view('user.list',compact('UserList'));
  }

  # Delete a user
  public function destroy($id)
  {

    $UserNew = UserNew::findOrFail($id);
    $User    = User::findOrFail($id);

    $UserNew->delete();
    $User->delete();

    return redirect('/User/List');

  }


  # Loead user edit view
  public function edit($UserID)
  {
    // retrieving all shop list
    $ShopList  = Shop::all();

    // retrieving user details
  	$User = UserNew::findOrFail($UserID);

    // return to user edit form view
  	return view('user.edit',compact('User','ShopList'));
  }
  

  # Update user
  public function update(Request $Data,$UserID)
  {
    // extracting form data
    $FormData  = $Data->all();         

    // find and object the user from table
    $User = UserNew::findOrFail($UserID);
        
    // collecting form data for update
    $User['Phone']      = $FormData['Phone'];
    $User['ShopID']     = $FormData['ShopID']; 
    $User['FirstName']  = $FormData['FirstName'];
    $User['LastName']   = $FormData['LastName'];
    $User['Address']    = $FormData['Address'];
    $User['City']       = $FormData['City'];
    $User['Province']   = $FormData['Province'];
    $User['ZipCode']    = $FormData['ZipCode'];
    $User['Country']    = $FormData['Country'];     
    $User['DateOfBirth']= $FormData['DateOfBirth'];
      
    try {
      $User->save();      
    } catch (\Exception $e) {
      echo $e->getMessage();
    }

    return redirect('/User/Edit/'.$UserID);
  }

  # Show user details
  public function details($UserID)
  {
    // rertrieving user details
    $User = UserNew::findOrFail($UserID);

    // return to user details page
    return view('user.details',compact('User'));
  }

  # Load Permission Table
  public function permission($UserID)
  {
    $UserRoleCategory=UserRoleCategory::all();

    $UserRole=UserRole::where('UserID','=',$UserID)->get();

    $SingleUserRole=[];
    $RoleID=[];
    $RoleRouteName=[];
    $RoleCategoryName=[];
    //$userrolename=[];


    foreach($UserRoleCategory as $data)
    {

      array_push($RoleID,$data->RoleCategoryID);
      array_push($RoleCategoryName,$data->RoleCategoryName);
      array_push($RoleRouteName,$data->RoleRouteName);
    }

    $TotalCategory=count($UserRoleCategory);

    //return $userrolecategory;

    foreach($UserRole as $data)
      array_push($SingleUserRole,$data->RoleCategoryID);

    $TotalRole=count($SingleUserRole);

    //return $userrole;
     

    return view('user.permission',compact('UserRoleCategory','UserID','SingleUserRole','TotalCategory','TotalRole','RoleID','RoleCategoryName','RoleRouteName'));
  }


  public function storePermission(Request $data,$UserID)
  {


    $checking=[];
    $RoleID=[];


    foreach($data->RoleID as $dd)
      array_push($RoleID,$dd);

  

    foreach($data->checking as $data)

      array_push($checking,$data);

    $total=count($checking);

    $DeleteItems=[];

    for($i=0;$i<$total;$i++)
    {
      if($checking[$i]==1)
      {


        $Selected=UserRole::where('RoleCategoryID','=',$RoleID[$i])
                  ->where('UserID','=',$UserID)
                  ->get();


        if(count($Selected)==0)
        {

          $UR=new UserRole();
          $UR->RoleCategoryID=$RoleID[$i];
          $UR->UserID=$UserID;
          $UR->save();

        } 
        
      }
      if($checking[$i]==0)
      {

        $SelectedDelete=UserRole::where('RoleCategoryID','=',$RoleID[$i])
        ->where('UserID','=',$UserID)
        ->get();

        if(count($SelectedDelete)==1)
        {
          $CR=UserRole::where('RoleCategoryID','=',$RoleID[$i])
          ->where('UserID','=',$UserID)
          ->delete();
        }
        
      }


    }//End of For Loop

    return back();

  }

  // activity loglist
  public function activityLog($UserID)
  {

    $Activity=ActivityLog::where('UserID','=',$UserID)->join('shop','shop.ShopID','=','activity_log.ShopID')->get();

    $User=UserNew::where('UserID','=',$UserID)->get()->first();
    return view('user.activity',compact('Activity','User'));
  }

  // sales history
  public function history($UserID)
  {
    $User = User::findOrFail($UserID);

  

    $InvoiceList = Invoice::where('UserID','=',$UserID)
    ->join('shop','invoice.ShopID','=','shop.ShopID')
    ->get();

    return view('user.history', compact('User', 'InvoiceList'));
  }


  public function RoleAssignment()
  {

    $UserRoleCategory=UserRoleCategory::all();
    //return $UserRoleCategory;
    return view('user.rolecategory',compact('UserRoleCategory'));


  }


  public function storeRoleAssignment(Request $data)

    {

      $UserRole=new UserRoleCategory();
      $UserRole->RoleCategoryName=$data->CategoryName;
      $UserRole->RoleRouteName=$data->RouteName;
      $UserRole->save();


      return back();







    }


  
}
