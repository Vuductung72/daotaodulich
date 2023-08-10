<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\Admin\SearchUserRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'DESC')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->only('name', 'email', 'phone', 'gender', 'code', 'type');
        $data['password'] = Hash::make($request->password);

        User::create($data);
        return redirect()->route('ad.user.index')->with('success', 'Thêm tài khoản thành công');

    }


    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        if ($request->password) {

            $request->validate([
                'password' => 'required|min:6|max:15'
            ]);

            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        session()->flash('success', 'Thành công');

        return redirect()->route('ad.user.index');
    }

    public function destroy(User $user)
    {
        $client = Client::where('user_id','=',$user->id)->first();
        if(isset($client->id)) {
            session()->flash('error', 'Đại lý đã có khách hàng. Không thể xóa !');
        } else {
            $user->delete();
            session()->flash('success', 'Thành công');
        }
        return redirect()->route('ad.user.index');
    }

    public function showresetpass() {
        return view('customer.client.resetpass');
    }
    public function resetpass(Request $request) {
        $this->validate($request, [
            'password' => 'required|min:6|max:15',
        ]);
        $data['password'] = Hash::make($request->password);
        $return = Customer()->user()->update($data);
        session()->flash('success', 'Thành công');
        return redirect()->route('us.home.index');
    }

    protected function searchListUser($name,$phone,$startDate,$endDate){
        $users = $name ? User::where('name', 'like', "%$name%") : User::where('name', 'like',"%");
        $users = $phone ? $users->where('phone', 'like', '%' .$phone. '%') : $users;
        $users = $startDate ? $users->whereDate('created_at','>=',$startDate) : $users;
        $users = $endDate ? $users->whereDate('created_at','<=',$endDate) : $users;
        return $users;
    }

    public function search(SearchUserRequest $request){
        $name = $request->name ?? '';
        $phone = $request->phone ?? '';
        $startDate = $request->startDate ?? '';
        $endDate = $request->endDate ?? '';
        $users = $this->searchListUser($name,$phone,$startDate,$endDate)->paginate(20);

        return view('admin.users.index', compact('users','name','phone','startDate','endDate'));
    }

    public function show(User $user){
        return view('admin.users.show',compact('user'));
    }

    public function count(Request $request, $id)
    {
        $user = User::find($id);
        $countType = $request->input('count-type');
        $countMoney = $request->input('count-money');
        $money = $user->money;
        if ($countType == 1) {
            $money += $countMoney;
        }  
        if ($countType == 0) {
            if($money == 0){
                return back()->with('warning', 'Không thể thực hiện phương thức trừ tiền!');
            }
            else{
                if($money<$countMoney){
                    return back()->with('warning', 'Số tiền trừ lớn hơn số tiền hiện tại!');
                }
                $money -= $countMoney;
            }
        } 
        $data['money'] = $money;
        $user->update($data);
        return back()->with('success', 'Số tiền đã cập nhật thành công!');
    }
     
    public function exportUser(Request $request){
        $name = $request->name ?? '';
        $phone = $request->phone ?? '';
        $startDate = $request->startDate ?? '';
        $endDate = $request->endDate ?? '';
        $users = $this->searchListUser($name,$phone,$startDate,$endDate);
        $export = new \App\Exports\UsersExport($users->get());
        return  Excel::download($export, 'danh_sach_hoc_vien_'.date('d-m-Y').'.xlsx');
    }
}
