<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Partner;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Config;
use App\Models\Feedback;
use App\Models\Qrcode;
use App\Models\Service;
use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{

    public function index()
    {
        // information of blogs
        $blogs = Blog::where('status',1)->where('type', 0)->orderBy('id','DESC')->limit(3)->get();

        // get all banner of slider
        $sliders = Slider::where('type', 1)->orderBy('position','ASC')->limit(3)->get();

        //feedback of customer
        $feedbacksStudent = Feedback::where('position_type', 1)->where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();

        //feed back of partner
        $feedbacksPartner = Feedback::where('position_type', 2)->where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();

        // logo of partner
        $partner = Partner::orderBy('id', 'ASC')->get();

        // get link for profession
        $configs['link_nghe_le_tan'] = Config::where('key','link_nghe_le_tan')->first()->value;
        $configs['link_nghe_nha_hang'] = Config::where('key','link_nghe_nha_hang')->first()->value;
        $configs['link_nghe_buong'] = Config::where('key','link_nghe_buong')->first()->value;
        $configs['link_mien_phi'] = Config::where('key','link_mien_phi')->first()->value;

        return view('web.home.index',compact('blogs', 'sliders', 'feedbacksStudent', 'feedbacksPartner', 'partner','configs'));
    }

    public function show(Request $request)
    {
        $result = $request->input('search');
        if ($result) {
            $queryString = $request->input('search');
            $client = Client::where('phone', 'LIKE', "%$queryString%")->first();
            if ($client) {
                $services = Service::where('client_id', $client->id)->get();
                return view('web.home.show', compact('client', 'services'));
            }else{
                session()->flash('error','không có dữ liệu');
                return redirect()->back();
            }

        }else{
            session()->flash('error','không có dữ liệu');
            return redirect()->back();
        }

    }


    public function the_bao_hanh()
    {
        $products = Blog::join('categories', 'categories.id', '=', 'blogs.category_id')
                    ->where('categories.slug', '=', 'the-bao-hanh')
                    ->select('blogs.*')
                    ->paginate(10);
        return view('web.the_bao_hanh.index', compact('products'));
    }

    public function doi_tac()
    {
        $partners = Partner::orderBy('id','DESC')->get();
        return view('web.home.doi_tac', compact('partners'));
    }

    public function product()
    {
        $products = Blog::join('categories', 'categories.id', '=', 'blogs.category_id')
                    ->where('categories.slug', '=', 'product')
                    ->select('blogs.*')
                    ->paginate(10);
        return view('web.home.product',compact('products'));
    }

    public function contact()
    {
        return view('web.home.contact');
    }

    public function blog_single($slug)
    {
        $blog = Blog::where('slug', '=', $slug)->limit(1)->first();
        return view('web.blog.blog_single')->with(compact('blog'));
    }

    public function list_blog()
    {
        $news = Blog::orderBy('id','DESC')->paginate(10);
        return view('web.blog.list_blog', compact('news'));
    }

    // public function show_qrcode($url)
    // {
    //     $qrcode = Qrcode::where('url', $url)->first();
    //     $service = Service::where('qrcode_id', $qrcode->id)->first();
    //     if ($service) {
    //         $client = Client::where('id', '=', $service->client_id)->first();
    //         return view('web.home.show', compact('service', 'client'));
    //     }else{
    //         return redirect()->back()->with('error', 'Chưa có thông tin');
    //     }

    // }
    public function partner_single($code)
    {
        $partner = Partner::where('code',$code)->first();
        return view('web.partner', compact('partner'));
    }


    public function introduce()
    {
        return view('web.introduce.index');
    }

}
