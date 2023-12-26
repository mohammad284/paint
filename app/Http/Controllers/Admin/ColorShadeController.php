<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ColorShade;
use App\Models\Color;
class ColorShadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function colorDegree ($col_id){
        $degrees = ColorShade::where('color_id',$col_id)->get();
        $color = Color::find($col_id);
        return view('dashboard.color.degree',compact('degrees','col_id','color'));
    }
    public function addDegree(Request $request,$col_id){
        $data = [
            'degree' => $request->degree,
            'color_id' => $col_id
        ];
        ColorShade::create($data);
        return redirect()->back()->withErrors('added successfully');
    }
}
