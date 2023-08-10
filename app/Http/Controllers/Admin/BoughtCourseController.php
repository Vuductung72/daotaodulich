<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseBuy;
class BoughtCourseController extends Controller
{
    public function index(){
        $course_buys = CourseBuy::orderBy('id','DESC')->paginate(9);
        return view('admin.courses.bought',compact('course_buys'));
    }

    public function search(Request $request) {
        $startDate = $request->startDate ?? '';
        $endDate = $request->endDate ?? '';

        $course_buys = CourseBuy::when($startDate, function($query, $startDate){
            return $query->whereDate('created_at','>=',$startDate);
        })->when($endDate, function($query, $endDate){
            return $query->whereDate('created_at','<=',$endDate);
        })->orderBy('id', 'desc')->paginate(10);

        return view('admin.courses.bought',compact('course_buys', 'startDate', 'endDate'));


    }
}
