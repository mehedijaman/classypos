<?php

namespace ClassyPOS\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class salesman
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
            if((Auth::guard($guard)->user()->admin)>=1)
            {
                return $next($request);
            }
            else
            {
                //die('not an editor');
                  return redirect()->guest('login');
            }
        }

        return $next($request);
    }

}