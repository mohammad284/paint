<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');Color::orderby('name')->get();
    }
    public function colors(){
        $colors = Color::orderby('rgb','asc')->paginate(100);  
        return view('dashboard.color.colors',compact('colors'));
    }

    public function updateColor(Request $request,$col_id){
        $color = Color::find($col_id);
        $data = [
            'color' => $request->color,
            'code'  => $request->code
        ];
        $color->update($data);
        return redirect()->back()->withErrors('updated successfully');
    }
    public function deleteColor($col_id){
        $color = Color::find($col_id)->delete();
        return redirect()->back()->withErrors('deleted successfully');
    }
}
