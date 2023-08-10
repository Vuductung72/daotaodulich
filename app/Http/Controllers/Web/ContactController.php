<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactInfo;
use App\Http\Requests\ContactRequest;
class ContactController extends Controller
{
    public function index()
    {
        return view('web.contact.index');
    }

    public function store(ContactRequest $request){
        $contact = $request->only('name','email','phone','note');
        ContactInfo::create($contact);
        return back()->with('success','Thông tin của bạn đã được gửi thành công!');
    }
}
