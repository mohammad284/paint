<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuildingType;
class BuildingTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function buildings(){
        $buildings = BuildingType::all();
        return view('dashboard.building-type.types',compact('buildings'));
    }
    public function addBuildingType (Request $request){
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_gr,
            ],
        ];
        BuildingType::create($data);
        return redirect()->back()->withErrors('added successfully');
    }
    public function updateBuildingType (Request $request,$cat_id){
        $category = BuildingType::find($cat_id);
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_gr,
            ],
        ];
        $category->update($data);
        return redirect()->back()->withErrors('updated successfully');
    }
    public function deleteBuildingType ($cat_id){
        $category = BuildingType::find($cat_id)->delete();
        return redirect()->back()->withErrors('deleted successfully');
    }
}
