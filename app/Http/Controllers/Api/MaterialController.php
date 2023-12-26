<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function materials(){
        $materials = Material::all();
        return response()->json([
            'status' => 200,
            'details' => $materials
        ]);
    }
}
