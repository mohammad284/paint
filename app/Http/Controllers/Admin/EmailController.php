<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
class EmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function emails(){
        return view('dashboard.email.send-email');
    }
    public function sendContact(Request $request) {
        $data = array('name'=> $request->name, 'email' => $request->email, 'subject' => $request->subject,'phone' => $request->phone, 'message_txt' =>$request->message );
        Mail::send('dashboard.email.mail', $data, function($message) use ($data) {
           $message->to('hussenmohammad915@gmail.com', 'Message from website')->subject
              ($data['subject']);
           $message->from($data['email'], $data['name']);
        });
        
      return response()->json('تم ارسال رسالتك بنجاح');
    }
}
