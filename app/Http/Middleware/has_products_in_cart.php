<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class has_products_in_cart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session::has('carrito')):
            if(count(Session::get('carrito')) > 0):
                return $next($request);
            else:
                return redirect('/');
            endif;
        elseif(Auth::user()->id_tasks == "2"):
            return $next($request);
        else:
            return redirect('/');
        endif;
    }
}
