<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Privacy;
use App\Models\Term;
class PrivacyController extends Controller
{
    public function privacy(){
        $privacy = Privacy::find(1);
        return response()->json([
            'status' => 200,
            'details'=> $privacy
        ]);
    }
    public function terms(){
        $terms = Term::find(1);
        return response()->json([
            'status' => 200,
            'details'=> $terms
        ]);
    }
}
