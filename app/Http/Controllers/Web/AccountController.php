<?php

namespace App\Http\Controllers\web;

use App\Models\Bank;
use App\Models\User;
use App\Models\Payment;
use App\Models\CustomerBank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\ResetPassRequest;
use App\Http\Requests\UpdatePaswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\UserCustomer;

class AccountController extends Controller
{
    public function index()
    {

        if (customer()->user()) {
            return view('web.account.index');

        } else {
            return redirect()->route('w.home')->with('info', 'Bạn chưa đăng nhập!');
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();
        // if ($request->password) {

        //     $request->validate([
        //         'password' => 'required|min:6|max:15'
        //     ]);

        //     $data['password'] = Hash::make($request->password);
        // }else{
        //     $data['password'] = $user->password;
        // }
        if ($request->avatar != null) {
            $request->validate([
                'avatar' => 'required|mimes:jpeg,png,jpg,gif,svg|max:5120'
            ],[
                'avatar.required' => 'Ảnh đại diện chưa được chọn.',
                'avatar.mimes' => 'Ảnh đại diện không đúng định dạng jpeg,png,jpg,gif,svg.',
                'avatar.max' => 'Kích thước ảnh đại diện tối đa là 5120 Mb.',
            ]);
            $path = $this->uploadFile($request->avatar);
            $data['avatar'] = $path;
        }
        $user->update($data);

        return redirect()->route('w.tai-khoan.index')->with('success','Cập nhật tài khoản thành công');
    }

//     public function resetpass(ResetPassRequest $request) {

//         $user = customer()->user();
//         $hasher = app('hash');

//         if ($hasher->check($request->oldpassword, $user->password)) {

//            if($request->newpassword == $request->confirmpassword) {

//                $user->password = bcrypt($request->newpassword);
//                $user->save();

//                session()->flash('success', 'Đổi mật khẩu thành công!');

//            } else {
//             session()->flash('error', 'Mật khẩu mới không khớp nhau!');
//            }

//         } else {
//             session()->flash('error', 'Mật khẩu cũ không đúng!');
//         }

//         return redirect()->route('w.account');
//     }

//     public function recharge() {
// //        $recharges = Payment::where('type', '=', 0)->where('user_id', '=', customer()->user()->id)->orderBy('id', 'DESC')->take(10)->get();
//         return $this->view('account.recharge');
//     }

//     public function withdraw() {
// //        $withdraws = Payment::where('type', '=', 1)->where('user_id', '=', customer()->user()->id)->orderBy('id', 'DESC')->take(10)->get();
//         return $this->view('account.withdraw');
//     }


    // lịch sử nạp tiền
    public function payHistory() {
        $histories = Payment::where('user_id', '=', customer()->user()->id)->orderBy('id', 'DESC')->paginate(15);

        // $withdraws = Payment::where('type', '=', 1)->where('user_id', '=', customer()->user()->id)->orderBy('id', 'DESC')->take(10)->get();
        return view('web.account.history')->with(compact('histories'));
    }

    public function transaction() {
        $histories = Payment::where('user_id', '=', customer()->user()->id)->orderBy('id', 'DESC')->take(10)->paginate(10);

        // $withdraws = Payment::where('type', '=', 1)->where('user_id', '=', customer()->user()->id)->orderBy('id', 'DESC')->take(10)->get();
        return $this->view('account.transaction')->with(compact('histories'));
    }

    public function updatePassword()
    {
        if (customer()->user()) {
            return view('web.account.password');

        } else {
            return redirect()->route('w.home')->with('info', 'Bạn chưa đăng nhập!');
        }
    }

    public function changePassword(UpdatePaswordRequest $request, User $user)
    {
        $data['password'] = Hash::make($request->password);
        $user->update($data);
        return redirect()->back()->with('success','Cập nhật mật khẩu thành công');
    }

    public function intership()
    {
        $userCustomers = UserCustomer::where('type', 1)->where('user_id', customer()->user()->id)->orderBy('id', 'DESC')->paginate();
        return view('web.account.internship', compact('userCustomers'));
    }

    public function evaluate(UserCustomer $userCustomer)
    {
        if ($userCustomer->status == 2) {
            return view('web.account.evaluate', compact('userCustomer'));
        } else {
            return redirect()->back()->with('info','Tin thực tập chưa được xác nhận!');
        }

    }

}
