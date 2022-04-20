<?php

namespace App\Http\Middleware;

use Closure, Session;
use Illuminate\Http\Request;

class purchase_steps_processs
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
        if (Session::has('estado-proceso-compra')) {
            session()->forget('estado-proceso-compra');
            return $next($request);
        } else {
            return $next($request);
        }
    }
}
