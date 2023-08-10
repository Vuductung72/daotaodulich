<?php

namespace App\Providers;

use App\Models\Blog;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Profession;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('list_category',Category::where('type', 0)->where('status', 1)->get());
        View::share('list_profession',Profession::where('status',1)->get());
        View::share('list_term', Blog::where(['type' => 1, 'status' => 1])->get());
    }
}
