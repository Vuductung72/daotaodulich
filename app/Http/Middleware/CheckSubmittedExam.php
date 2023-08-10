<?php

namespace App\Http\Middleware;

use App\Models\Result;
use Closure;
use Illuminate\Http\Request;
use App\Models\Course;
class CheckSubmittedExam
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
        // if(customer()->check()){
            
        // }else{
        //     return back();
        // }
        // return $next($request);
    }
}
