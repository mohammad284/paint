<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeWork;
use App\Models\BranshWork;
use App\Models\BranshType;
class BranshWorkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function branshes(){
        $branshes = BranshWork::with('type')->get();
        return view('dashboard.bransh.branshes',compact('branshes'));
    }
    public function addBransh(){
        $branshes = BranshWork::all();
        $types    = TypeWork::all();
        return view('dashboard.bransh.add-bransh',compact('branshes','types'));
    }
    public function storeBransh(Request $request){
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_gr,
            ],
        ];
        $bransh =  BranshWork::create($data);

        $works_id = $request->works_id;
        
        foreach($works_id as $work_id) {
            BranshType::insert( [
                'type_id'=>  $work_id,
                'bransh_id'=> $bransh->id
            ]);
        }

        return redirect('/admin/branshes')->withErrors('added successfully');
    }
    public function editBransh($bransh_id){
        $bransh = BranshWork::with('type')->find($bransh_id);
        $types    = TypeWork::all();
        return view('dashboard.bransh.edit-bransh',compact('bransh','types'));
    }
    public function updateBransh(Request $request,$bransh_id){
        $bransh =  BranshWork::find($bransh_id);

        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'gr' => [
                'name' => $request -> name_gr,
            ],
        ];

        $types = BranshType::where('bransh_id',$bransh->id)->delete();

        $works_id = $request->works_id;
        
        foreach($works_id as $work_id) {
            BranshType::insert( [
                'type_id'=>  $work_id,
                'bransh_id'=> $bransh->id
            ]);
        }
        $bransh->update($data);
        return redirect('/admin/branshes')->withErrors('updated successfully');
    }
    public function deleteBransh($bransh_id){
        $bransh = BranshWork::find($bransh_id)->delete();
        return redirect()->back();
    }
}
