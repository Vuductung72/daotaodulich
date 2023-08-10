<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profession;
use App\Models\Customer;
use App\Models\Expert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numberPage = $this->getConfigByKey('phan_trang_chuyen_gia')->value;
        $experts =  Expert::whereHas('profession', function (Builder $query) {
            $query->where('status', '1');
        })->whereHas('customer',function (Builder $query){
            $query->where('status','2');
        })->paginate($numberPage);
        $professions = Profession::where('status',1)->get();
        return view('web.expert.index',compact('professions','experts'));
    }

    public function show($customer_slug)
    {
        $customer = Customer::where('slug', $customer_slug)->first();
        $social_network = json_decode($customer->expert->social_network,true);
        return view('web.expert.show',compact('customer','social_network'));
    }

    public function searchByProfession($slug)
    {
        $professions = Profession::where('status',1)->get();
        $numberPage = $this->getConfigByKey('phan_trang_chuyen_gia')->value;
        $experts = Expert::whereHas('profession', function (Builder $query) use ($slug){
            $query->where(['status' => '1', 'slug' => $slug]);
        })->whereHas('customer',function (Builder $query){
            $query->where('status','2');
        })->paginate($numberPage);
        return view('web.expert.index',compact('experts','professions'));
    }
}
