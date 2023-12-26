<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
class ColorController extends Controller
{
    public function colors(){
        $colors = Color::all();
        return response()->json([
            'status' => 200,
            'details'=> $colors
        ]);
    }

}
