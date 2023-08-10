<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Components\Partners\Vnpay;
use App\Models\User;
use Illuminate\Support\HtmlString;
use App\Components\Partners\Tele;

class PaymentController extends Controller
{
    protected $vnpay;
    protected $tele;

    public function __construct(Vnpay $vnpay, Tele $tele)
    {
        $this->vnpay = $vnpay;
        $this->tele = $tele;
    }


    public function payRecharge()
    {
        return view('web.account.payment');
    }

    public function method_bank($method_bank)
    {
        return view('web.account.payment.' . $method_bank . '');
    }

    public function getOnline()
    {
        $name = array(
            [
                'name' => 'VP BANK',
                'code' => 'VP',
            ],
            [
                'name' => 'ACB BANK',
                'code' => 'ACB',
            ],
            [
                'name' => 'BIDV',
                'code' => 'BIDV',
            ],
            [
                'name' => 'VIETINBANK',
                'code' => 'VTB',
            ],
            [
                'name' => 'MB BANK',
                'code' => 'MB',
            ],
            [
                'name' => 'TP BANK',
                'code' => 'TPB',
            ],
            [
                'name' => 'VIETCOMBANK',
                'code' => 'VCB',
            ],
        );
        return view('web.account.payment.debit_card')->with(compact('name'));
    }

    public function getQrbank()
    {
        $name = array(
            [
                'name' => 'VP BANK',
                'code' => 'VP',
            ],
            [
                'name' => 'ACB BANK',
                'code' => 'ACB',
            ],
            [
                'name' => 'BIDV',
                'code' => 'BIDV',
            ],
            [
                'name' => 'VIETINBANK',
                'code' => 'VTB',
            ],
            [
                'name' => 'MB BANK',
                'code' => 'MB',
            ],
            [
                'name' => 'TP BANK',
                'code' => 'TPB',
            ],
            [
                'name' => 'VIETCOMBANK',
                'code' => 'VCB',
            ],
        );
        return view('web.account.payment.qr_bank')->with(compact('name'));
    }


    public function success(Request $request)
    {
//        $this->tele->send(customer()->user(),'success',20000);
        $amount = $request->amount;
        $method = $request->type;

        //$oderid = $request->oderid;
        switch ($method) {
            case 'momopay':
                $method = 'momo_qr';
                break;
            case 'debit_card':
                $method = 'bank_transfer';
                break;
            case 'qr_bank':
                $method = 'bank_qr';
                break;
            case 'zalopay':
                $method = 'zalo_qr';
                break;
            default;
        }
        if ($method == 'bank_qr') {
//            $type_bank = $request->code;
            $bankcode = $request->code;
        } else if ($method == 'bank_transfer') {
            $bankcode = $request->code;
        } else {
            $bankcode = '';
        }

        $oderid = time();
        $data = [
            // 'user_id' => customer()->user()->id,
            'user_id' => customer()->user()->id,
            'amount' => $amount,
            'method' => $method,
            'error_code' => null,
            'order_code' => $oderid,
            'type_bank' => $bankcode
        ];
        // dd($data);

        Payment::create($data);

        $sign = md5("vnpay997113|" . $oderid . "|" . $amount . "|" . $method . "|cf24b249492e117655c405477658c9d5");
        $data = [
            'merchant_no' => 'vnpay997113',
            'order_no' => $oderid,
            'amount' => $amount,
            'channel' => $method,
            'bank_code' => $bankcode,
            // 'notify_url' => 'http://103.150.125.209:5555/ResultPayment/', //'https://ibet66.com/payment/result',
            'notify_url' => 'https://daotaonghedulich.com/api/payment/result', //'',
            'c_ip' => '',
            'result_url' => 'https://daotaonghedulich.com/payment/notify',
            'phone_number' => '',
            'extra_param' => '',
            'sign' => $sign,
        ];

        $response = new HtmlString($this->vnpay->pay($data));
        return \Redirect::to($response);

    }

    public function notify(Request $request) {
        $order_no = $request->orderNo;
        $payment = Payment::where('order_code', $order_no)->first();
        if($payment['status'] == 1) {
            return redirect()->route('w.payment.recharge')->with('success', 'Nạp tiền thành công!');
        } else return redirect()->route('w.payment.recharge')->with('error', 'Nạp tiền thất bại!');
    }

    public function result(Request $request)
    {
        $result_code = $request->result_code;
        $order_no = $request->order_no;
        $ylt_order_no = $request->ylt_order_no;
        $amount = $request->amount;
        $channel = $request->channel;
        $sign = $request->sign;
        \Log::info('log info: ', ['info' => $request->all()]);

        $verify = md5("vnpay997113|" . $order_no . "|" . $ylt_order_no . "|" . $amount . "|" . $channel . "|cf24b249492e117655c405477658c9d5");

        if ($result_code == 'success') { //check xem có thành công hay không
            if ($verify == $sign) { //check xem chữ ký có giống nhau hay không
                //hàm này cộng tiền cho user
                $payment = Payment::where('order_code', $order_no)->first();
                $user = User::find($payment->user_id);
                if ($payment->status == 0) {
                    $payment2 = Payment::find($payment->id);
                    $payment2->status = 1;
                    $payment2->error_code = $result_code;
                    $payment2->save();
                    $user->money = $user->money + (floatval($amount));
                    $user->save();
                    $this->tele->send($user,'success',$amount);
                    return response('success', 200)
                        ->header('Content-Type', 'text/plain');
                } else {
                    dd('false');
                }
            } else {
                dd('false');
            }
        } else {
            dd('false');
        }
    }


}
