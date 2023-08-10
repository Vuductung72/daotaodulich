<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
class AutoEmailController extends Controller
{
    public function sendWhenOverTime(){
        $users = User::all();
        foreach ($users as $key => $user) {
            // check last login time of user 
            $dateTime = \Carbon\Carbon::now()->diffInDays($user->last_login);
            if($dateTime >= 3){
                // send email notication for email
                Mail::send('web.mail.notification',compact('user'),function($email)use($user){
                    $email->subject('ATM - Thông báo học tập');
                    $email->to($user->email);
                });
            }
        }
        Log::info('Thông báo email cho học viên đã không hoạt động trong 3 ngày qua thành công');
    }
}
