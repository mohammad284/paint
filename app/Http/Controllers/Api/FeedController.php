<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeedBack;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class FeedController extends Controller
{
    //
    public function add_feed(Request $request)
    {
        $user = JWTAuth::authenticate($request->token);
        FeedBack::create([
            'user_id' => $user->id,
            'comment' => $request->comment,
            'rate' => $request->rate
        ]);
        return response()->json([
            'details' => 'added successfully'
        ],200);
    }
}
