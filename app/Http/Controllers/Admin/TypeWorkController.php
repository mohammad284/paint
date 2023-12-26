<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeWork;
use App\Models\Notification;
use Validator;
class TypeWorkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function allTypeWork(){
        $app_lan = app()->getLocale();
        $types = TypeWork::all();
        $types_lan = TypeWork::all();
        return view('dashboard.type-work.all-type-work',compact('types','types_lan'));
        
    }

    public function storeWorkType(Request $request){
        $app_lan = app()->getLocale();
        $validator = Validator::make($request->all(), [
            'type_of_work_en'=> ['required'],
            'type_of_work_gr'=> ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'en' => [
                'type_of_work' => $request -> type_of_work_en,
            ],
            'de' => [
                'type_of_work' => $request -> type_of_work_gr,
            ],
        ];
        $data = TypeWork::create($data);

        return redirect()->back()->with('message','A new job type has been added');

        
    }

    public function updateWorkType(Request $request ,$type_id){
        $app_lan = app()->getLocale();
        $type = TypeWork::where('id',$type_id)->first();

        $data = [
            'en' => [
                'type_of_work' => $request -> type_of_work_en,
            ],
            'de' => [
                'type_of_work' => $request -> type_of_work_gr,
            ],
        ];
        $type->update($data);
        if($app_lan == 'en'){
            return redirect()->back()->with('message','updated successfully');
        }else{
            return redirect()->back()->with('message','updated successfully');
        }
    }
    public function deleteTypeWork($type_id){
        $type = TypeWork::where('id',$type_id)->delete();
        return redirect()->back(); 
    }
}
