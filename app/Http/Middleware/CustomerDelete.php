<?php

namespace ClassyPOS\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class CustomerDelete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
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



        else
        {
            if((Auth::guard($guard)->user()->admin)==3)
            {
                //$message="You are not Authorized to delete a customer";
                //return back()->with('message',$message);
                return redirect('/Customer/List')->with('status', 'You are Not Authorized to delete a Customer');
                //die("Yo are not authorized to delete a customer");
            }

            else
            {
                return $next($request);

                //die('not an editor');
                  
            }
        }

        return $next($request);
    }
}
