<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Support;
use App\Mail\SupportReply;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
class SupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function support(){
        $questions = Support::with('user')->get();
        return view('dashboard.support',compact('questions'));
    }
    public function reply(Request $request,$id){
        $support = Support::find($id);
        $support->reply = $request->reply;
        $support->save();
        $user = User::find($support->user_id);
        $mail = [
            'message' => $request->reply
        ];
        Mail::to('mohammadhussein769@gmail.com')->send(new SupportReply($mail));
        return redirect()->back()->withErrors('send sucessfully');
    }
}
