<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userFrontController extends Controller
{
    public function showAddLogin(){
        return view('front-end.login');
    }
}
