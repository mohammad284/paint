<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Question;
Use App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function aboutUs(){
        $about_us = AboutUs::all();
        return response()->json([
            'status' => 200,
            'details' => $about_us
        ]);
    }
}
