<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $contacts = ContactInfo::orderBy('id','DESC')->get();
        return view('admin.contacts.index',compact('contacts'));
    }
}
