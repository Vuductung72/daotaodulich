<?php

use App\Models\Blog;
use App\Models\Category;
use App\Models\Config;
use App\Models\Course;

if (!function_exists('mkConfig')) {
    function mkConfig($key)
    {
        if($value = Cache::get($key)) {
            return $value;
        }

        $config = Config::where('key', $key)->first();

        if(! $config) {
            $config = Config::create([
                'key' => $key,
                'value' => ''
            ]);

            return $config->value;
        }

        return $config->value;
    }
}

if (!function_exists('menu')) {
    function menu()
    {
        return Category::orderBy('position', 'ASC')->get();
    }
}

if (!function_exists('courses')) {

    function courses($number = 1) {
        if ($number == 1) {
            return Course::orderBy('position', 'ASC')->first();
        }

        return Course::orderBy('position', 'ASC')->limit($number)->get();
    }
}
if (!function_exists('randomBlogs')) {

    function randomBlogs($number = 7) {
        return Blog::inRandomOrder()->with('category')->limit($number)->get();
    }
}

if (!function_exists('agent')) {
    function agent() {
        return app('Jenssegers\Agent\Agent');
    }
}

if (! function_exists('customer')) {
    function customer()
    {
        return \Auth::guard('user');
    }
}

if (! function_exists('isAdmin')) {
    function isAdmin($admin)
    {
        if($admin->role == 1) return true;
        return false;        
    }
}

if (! function_exists('cate')) {
    function cate()
    {
        return Category::all();       
    }
}
