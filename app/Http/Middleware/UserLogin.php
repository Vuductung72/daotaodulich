<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(! customer()->check()){
            return redirect()->route('w.get_login')->with('info','Bạn cần đăng nhập trước');
        }

        return $next($request);
    }
}
