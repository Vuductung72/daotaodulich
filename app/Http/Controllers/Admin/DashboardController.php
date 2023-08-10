<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\HtmlString;
use App\Components\Partners\Vnpay;

class DashboardController extends Controller
{
    protected $vnpay;
    public function __construct(Vnpay $vnpay)
    {
        $this->vnpay = $vnpay;
    }

    public function index(Request $request)
    {

    // Get số tiền trong ví VNPay
        $sign = md5("vnpay997113|cf24b249492e117655c405477658c9d5");
        $data = [
            'merchant_no' => 'vnpay997113',
            'sign'   => $sign
        ];
        $uri = new HtmlString($this->vnpay->balance($data));
        $response = Http::withoutVerifying()->get($uri);
//        dd($response->json());
        if($response->json()['status'] == 200) {
            $wallet['momo_wallet'] = number_format($response->json()['data']['momoBalance']);
            $wallet['online_wallet'] = number_format($response->json()['data']['onlineBalance']);
        } else {
            $wallet['momo_wallet'] = 0;
            $wallet['online_wallet'] = 0;
        }
        //End

        // Payment chart
        $day = 30;
        $date_now = date('Y-m-j');
        $date = strtotime ( '-30 day' , strtotime($date_now));
        $date = date ( 'Y-m-j' , $date );
//        dd($date);
        $y = 0;
        for ($i = 0; $i<=$day; $i++) {
            $new_date = strtotime ( '+'.$i.' day' , strtotime ( $date ) ) ;
            $new_date_format = date ( 'Y-m-j' , $new_date );
            $date_start = date ( 'Y-m-j 00:00:00' , $new_date );
            $date_end = date ( 'Y-m-j 23:59:59' , $new_date );
//            dd($date_start,$date_end);
            $money = Payment::where('created_at','>=',$date_start)->where('created_at','<=',$date_end)->where('status',1)->sum('amount');
            $payments[$y][0] = $new_date_format;
            $payments[$y][1] = intval($money);
            $y++;
//            dd($money);
        }

        $users = User::get();
        return view('admin.home', compact( 'users','wallet', 'payments'));
    }
}
