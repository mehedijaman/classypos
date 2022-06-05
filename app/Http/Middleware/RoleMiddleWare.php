<?php

namespace ClassyPOS\Http\Middleware;

use Closure;
use ClassyPOS\customer\Customer;
use ClassyPOS\shop\Shop;
use Auth;
use ClassyPOS\user\UserRoleCategory;
use ClassyPOS\user\UserRole;

class RoleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard=null)
    {


      if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }
             else 
            {
                return redirect()->guest('login');
            }
        }



        if((Auth::guard($guard)->user()->admin)>=5)
        {
            return $next($request);
        }

        $url=$request->path();

        //$array=explode('/',$url);

        //echo $array[0]."<br>";
        //echo $array[1]."<br>";
        //$url =$array[0].'/'.$array[1];

        //implode($good,$array[0],$array[1]);

        //echo $url;







        //echo $url."<br>";


        //return $url;

        $all=UserRoleCategory::where('RoleRouteName','=',$url)->get();

        if(count($all)==0)
            return $next($request);

        $roleid= $all[0]->RoleCategoryID;

        $id = Auth::user()->id;
        //echo $id."<br>";


        $Access=UserRole::where('RoleCategoryID','=',$roleid)
                  ->where('UserID','=',$id)
                  ->get();


                  if(count($Access)==0)
                  {
                    //return "You Are not authorized";
                    //return redirect('/Dashboard')->with('status', 'You are Not Authorized to Use This Option');

                    return back()->with('status', 'You are Not Authorized to Use This Option');
                  }


                  else
                  {

                    return $next($request);
                  }




        //return $all;

        //echo $all;
        //$value=$role;

        ///echo $value."<br>";

        //$name=$request->route('ali');
        //$ja=$request->route('jahid');


        //echo $name."<br>".$ja."<br>";
               //$cust=Customer::findOrFail(45);
        //$shop=Shop::findOrFail(8);
        //Customer::findOrFail()
        //echo $shop->ShopName;
        //echo "<br>".$cust->FirstName;
        //echo "<br>Role: ".$role;*/      
        return $next($request);
    }
}
