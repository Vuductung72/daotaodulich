<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{

    public function getLogin()
    {
        if (customer()->user()) {
            return redirect()->route('w.home')->with('success', 'Bạn đã đăng nhập!');
        } else {
            return view('web.login.login');
        }
        
    }

    public function login(LoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (customer()->attempt($login)) {
            customer()->user()->update(['last_login'=>\Carbon\Carbon::now()->toDateTimeString()]);
            return redirect()->route('w.home')->with('success', 'Bạn đã đăng nhập thành công');
        } else {
            return redirect()->back()->with('warning', 'Bạn đã đăng nhập thất bại');
        }

    }

    public function getRegister()
    {
        if (customer()->user()) {
            return redirect()->route('w.home')->with('success', 'Bạn đã đăng nhập!');
        } else {
            return view('web.login.register');
        }
       
    }

    public function register(RegisterRequest $request)
    {
        $new_user = $request->only('name', 'email', 'phone', 'gender');
        if ($request->has('address')) $new_user['address'] = $request->address;
        $new_user['password'] = Hash::make($request->password);
        $new_user['avatar'] = '/web/asset/images/avatar-mac-dinh.png';
        $new_user['verify_code'] = random_int(000000,999999);
        $new_user['last_login'] = \Carbon\Carbon::now()->toDateTimeString();
        if(! $user = User::create($new_user)) {
            return redirect()->back()->with('warning', 'Bạn đã đăng ký thất bại');
        }

        // send verify_code about user's email
        Mail::send('web.verify.messages',compact('user'),function($email)use($user){
            $email->subject('ATM - Mã xác thực email');
            $email->to($user->email);
        });

        // login auto 
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if ( customer()->attempt($login)) {
            return redirect()->route('w.home')->with('success', 'Chúc mừng bạn đăng ký thành công');
        }
        return redirect()->route('w.login')->with('success', 'Chúc mừng bạn đăng ký thành công');
    }

    public function logout(){
        customer()->logout();
        return redirect()->route('w.home')->with('success', 'Bạn đã đăng xuất thành công');
    }
}
