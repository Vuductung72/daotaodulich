<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\UserCustomer;

class CheckSelectExpert
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
        $slug = $request->route()->parameters();
        $course = Course::where('slug', $slug)->first();
        $getUserCustomerByUserAndCourse = UserCustomer::where(
            ['user_id' => customer()->user()->id,'course_id' => $course->id]
        )->get();

        if($getUserCustomerByUserAndCourse->count() > 0){
            return $next($request);
        }else{
            return redirect()->route('w.course.select_expert', $slug);
        }
    }
}
