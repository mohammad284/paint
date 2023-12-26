<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlasterType;
class PlasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function plasterType(){
        $types = PlasterType::all();
        return view('dashboard.plaster.type',compact('types'));
    }
    public function storePlasterType(Request $request){
        $data = [
            'type'      => $request->type,
            'thickness' => $request->thickness,
        ];
        PlasterType::create($data);
        return redirect()->back()->withErrors('added successfully');
    }
    public function updatePlasterType(Request $request){
        $type = PlasterType::find($request->type_id);
        $data = [
            'type'      => $request->type,
            'thickness' => $request->thickness,
        ];
        $type->update($data);
        return redirect()->back()->withErrors('updated successfully');
    }
    public function deletplasterType($type_id){
        $type = PlasterType::find($type_id)->delete();
        return redirect()->back()->withErrors('deleted successfully');
    }
}
