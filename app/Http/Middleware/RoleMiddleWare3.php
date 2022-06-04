<?php

namespace ClassyPOS\Http\Middleware;

use Closure;
use ClassyPOS\customer\Customer;
use ClassyPOS\shop\Shop;
use Auth;
use ClassyPOS\user\UserRoleCategory;
use ClassyPOS\user\UserRole;

class RoleMiddleWare3
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

        $array=explode('/',$url);

        $url=$array[0].'/'.$array[1].'/'.$array[2];


        $all=UserRoleCategory::where('RoleCategoryName','=',$url)->get();

        if(count($all)==0)
            return $next($request);

        $roleid= $all[0]->RoleCategoryID."<br>";

        $id = Auth::user()->id;
        //echo $id."<br>";


        $Access=UserRole::where('RoleCategoryID','=',$roleid)
                  ->where('UserID',$id)
                  ->get();


                  if(count($Access)==0)
                  {
                    //return "You Are not authorized";
                    return back()->with('status', 'You are Not Authorized to Use This Option');

                    //return redirect('/Dashboard')->with('status', 'You are Not Authorized to Use This Option');
                  }


                  else
                  {

                    return $next($request);
                  }


        return $next($request);
    }
}
