<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
    public function index()
    {
        $admins = Admin::orderBy('id', 'DESC')->paginate();
        return view('admin.admins.index', compact('admins'));
    }
    
    public function create()
    {
        return view('admin.admins.create');
    }
    
    public function store(CreateAdminRequest $request)
    {
        $data = $request->only('name', 'email', 'phone','role');
        $data['password'] = Hash::make($request->password);

        Admin::create($data);
        session()->flash('success', 'Thêm mới tài khoản thành công');

        return redirect()->route('ad.admin.index');
    }
    
    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }
    
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $data = $request->only('name', 'phone','role');
        $data['password'] = Hash::make($request->password);
        if ($request->password) {
            
            $request->validate([
                'password' => 'required|min:6|max:15'
            ]);

            $data['password'] = Hash::make($request->password);
        }
        
        $admin->update($data);
        session()->flash('success', 'Cập nhật tài khoản thành công');

        return redirect()->route('ad.admin.index');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        session()->flash('success', 'Xóa tài khoản thành công');

        return redirect()->route('ad.admin.index');
    }
}
