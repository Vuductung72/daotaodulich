<?php

namespace App\Http\Controllers\web;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePaswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function forgetPassword()
    {
        return view('web.password.index');
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users'
        ],[
            'required' => 'Địa chỉ email không được để trống!',
            'exists' => 'Địa chỉ email này không tồn tại trong hệ thống!',
        ]);

        $token=strtoupper(Str::random(10));
        $user = User::where('email', $request->email)->first();
        $user->update([
            'token' => $token
        ]);
        // dd($user->token);

        Mail::send('web.password.messages',compact('user'),function($email)use($user){
            $email->subject('ATM - Hướng dẫn đặt lại mật khẩu');
            $email->to($user->email);
        });


        return redirect()->back()->with('info', 'Vui lòng kiểm tra email để thay đổi mật khẩu!');
    }

    public function getPass(User $user, $token)
    {
        if($user->token === $token){
            return view('web.password.change', compact('user'));
        }
        return redirect()->route('w.home')->with('info', 'Thời gian thay đổi mật khẩu đã hết hạn!');
    }

    public function changePass(UpdatePaswordRequest $request,User $user)
    {
        $data['password'] = Hash::make($request->password);
        $data['token'] = null;
        $user->update($data);
        return redirect()->route('w.login')->with('success','Thay đổi mật khẩu mới thành công!');
    }

}
