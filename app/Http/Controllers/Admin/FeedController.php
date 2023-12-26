<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeedBack;
class FeedController extends Controller
{
    public function feeds()
    {
        $feeds = FeedBack::with('users')->get();
        return view('dashboard.feed.feeds',[
            'feeds'=>$feeds
        ]);
    }
}
