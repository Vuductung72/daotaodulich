<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function getRecharge() {
        $payments = Payment::orderBy('id','DESC')->paginate(20);
        return view('admin.payments.recharge', compact('payments'));
    }
}
