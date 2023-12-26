<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaperType;

class PaperController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function papers(){
        $papers = PaperType::all();
        return view('dashboard.paper.all-papers',compact('papers'));
    }
    public function addPaper(Request $request){
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_gr,
            ],
        ];
        PaperType::create($data);
        return redirect()->back()->withErrors('a new wallpaper has been added successfully');
    }
    public function updatePaper(Request $request ,$pap_id){
        $paper = PaperType::find($pap_id);
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_gr,
            ],
        ];
        $paper->update($data);
        return redirect()->back()->withErrors('wallpaper updated successfully');
    }
    public function deletePaper($pap_id){
        $paper = PaperType::find($pap_id)->delete();
        return redirect()->back()->withErrors('deleted successfully');
    }
}
