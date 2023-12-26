<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\floarType;
class FloarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function floars(){
        $floars = floarType::all();
        return view('dashboard.floars.types',compact('floars'));
    }
    public function addFloar (Request $request){
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_gr,
            ],
        ];
        floarType::create($data);
        return redirect()->back()->withErrors('added successfully');
    }
    public function updateFloar (Request $request,$cat_id){
        $floar = floarType::find($cat_id);
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_gr,
            ],
        ];
        $floar->update($data);
        return redirect()->back()->withErrors('updated successfully');
    }
    public function deleteFloar ($cat_id){
        $floar = floarType::find($cat_id)->delete();
        return redirect()->back()->withErrors('deleted successfully');
    }
}
