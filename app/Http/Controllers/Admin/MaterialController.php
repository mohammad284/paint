<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function material(){
        $materials = Material::all();
        return view('dashboard.material.materials',compact('materials'));
    }
    public function addMaterial(Request $request){
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_gr,
            ],
        ];
        Material::create($data);
        return redirect()->back()->withErrors('New materials have been added');
    }
    public function updateMaterial(Request $request,$mat_id){
        $material = Material::find($mat_id);
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_gr,
            ],
        ];
        $material->update($data);
        return redirect()->back();
    }
    public function deleteMaterial($mat_id){
        $material = Material::find($mat_id)->delete();
        return redirect()->back()->withErrors('material has been deleted successfully');
    }
}
