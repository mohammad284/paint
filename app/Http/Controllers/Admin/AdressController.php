<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
class AdressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function address(){
        $address = Address::paginate(100);  
        return view('dashboard.address.address-index',compact('address'));
    }
    public function updateAdress(Request $request,$add_id){
        $address = Address::find($add_id);
        $data = [
            'objectId'  => $request-> objectId,
            'Postal_Code'  => $request-> Postal_Code,
            'CountryCode'  => $request->CountryCode ,
            'Place_Name'  => $request->Place_Name ,
            'Latitude'  => $request->Latitude ,
            'Longitude'  => $request-> Longitude,
            'Admin_Name'  => $request->Admin_Name ,
            'Admin_Code3'  => $request-> Admin_Code3,
            'Admin_Name3'  => $request->Admin_Name3 ,
            'Accuracy'  => $request->Accuracy ,
        ];
        $address->update($data);
        return redirect()->back()->withErrors('The location has been modified successfully');
    }
    public function deleteAddress($add_id){
        $address = Address::where('id',$add_id)->delete();
        return redirect()->back()->withErrors('The location has been deleted successfully');
    }
}
