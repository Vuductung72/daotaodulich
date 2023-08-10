<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCustomer
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
        // check if the customer is logged in
        if(! (Auth::guard('customer')->check())){
            return $next($request);
        }
        
        // redirect expert page 
        if(Auth::guard('customer')->user()->type == 1) return redirect()->route('us.expert.index');
        
        // redirect internship page 
        if(Auth::guard('customer')->user()->type == 2) return redirect()->route('us.internship.index');
        return $next($request);
    }
}
