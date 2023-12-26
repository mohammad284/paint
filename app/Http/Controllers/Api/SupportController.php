<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SupportMail;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Support;
class SupportController extends Controller
{
    public function support(Request $request){
        $user = User::find($request->user_id);
        $data = [
            'user_id' => $request->user_id,
            'question' => $request->question,
        ];
        Support::create($data);
        $mail = [
            'first_name'=>$user->first_name,
            'last_name'=>$user->last_name,
            'mobile'=>$user->mobile,
            'email'=>$user->email,
            'message' => $request->question
        ];

        Mail::to('')->send(new SupportMail($mail));
        return response()->json([
            'details' => 'Thank you for contacting us'
        ]);
    }
}
