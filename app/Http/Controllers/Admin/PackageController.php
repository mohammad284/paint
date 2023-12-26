<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function allPackage(){

        $packages = Package::all();
        return view('dashboard.package.all-package',compact('packages'));
    }

    public function addPackage(Request $request){
        $data = [
            'price'=> $request->price,
            'name' => $request -> name,
        ];
        $package = Package::create($data);

        return redirect()->back()->withErrors('A new package has been added successfully');

    }

    public function updatePackage(Request $request,$pac_id){
        $package = Package::find($pac_id);
        $data = [
            'price'=>$request->price,
            'name' => $request -> name,
        ];
        $package->update($data);
            return redirect()->back()->withErrors('Package has been successfully modified');

        
    }
    public function deletePackage($pac_id){
        $package_en = Package::where('id',$pac_id)->delete();
        return redirect()->back()->withErrors('Package has been deleted successfully');
    }
}
