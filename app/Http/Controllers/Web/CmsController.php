<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function view($slug )
    {
        $cms = Cms::where('slug', '=', $slug)->limit(1)->first();
        return view('web.cms.view')->with(compact('cms'));
    }
}
