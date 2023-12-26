<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class NotificationController extends Controller
{

    public function reciveNot(Request $request){
        $token   = JWTAuth::authenticate($request->token);
        $notifications = Notification::with('send','recive.images','send.images','tender:id,title,inside,created_at')
        ->where('reciver',$token->id)
        ->get();
        return response()->json([
            'status'=>200,
            'details' => $notifications
        ]);
    }
    public function readNot(Request $request){
        $notifications = Notification::whereIn('id',$request->nots)->update(['user_read'=>'1']);
        return response()->json('done');
    }
}
