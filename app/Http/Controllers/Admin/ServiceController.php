<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function services(){
        $services = Service::all();
        return view('dashboard.service.services',compact('services'));
    }
    public function addService (Request $request){
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_gr,
            ],
        ];
        Service::create($data);
        return redirect()->back()->withErrors('New services added successfully');
    }
    public function updateService (Request $request,$cat_id){
        $category = Service::find($cat_id);
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_gr,
            ],
        ];
        $category->update($data);
        return redirect()->back()->withErrors('The service has been successfully modifiedy');
    }
    public function deleteService ($cat_id){
        $category = Service::find($cat_id)->delete();
        return redirect()->back()->withErrors('Der Dienst wurde erfolgreich geändert');
    }

}
