<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function payments(){
        $payments = Payment::all();
        return view('dashboard.payment.payments',compact('payments'));
    }
}
