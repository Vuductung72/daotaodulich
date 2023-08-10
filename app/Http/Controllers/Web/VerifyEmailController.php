<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class VerifyEmailController extends Controller
{
    public function web(){
        return view('web.verify.index');
    }

    public function checkVerifyCode(Request $request, User $user){
        // check value of form
        $request->validate([
            'verify_code' => 'required|numeric'
        ],[
            'required' => 'Mã xác thực không được để trống',
            'numeric' => 'Mã xác thực phải là dạng số',
        ]);

        // update veriry_code
        if($user->verify_code == $request->verify_code){
            $user->update(['email_verified' => 1]);
            return redirect()->route('w.home')->with('success','Xác thực Email thành công');
        }
        return back()->with('error','Xác thực Email thất bại');
    }

    public function sendVerifyCode(){
        $user = customer()->user();
        Mail::send('web.verify.messages',compact('user'),function($email)use($user){
            $email->subject('ATM - Mã xác thực email');
            $email->to($user->email);
        });
        return back()->with('success','Mã xác thực đã được gửi về Email của bạn');
    }
}
