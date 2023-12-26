<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
class AddressController extends Controller
{
    public function postalCode(){
        $address = Address::all();
        return response()->json([
            'status' => 200,
            'details' =>  $address
        ]);
    }
    public function getMultiZip(Request $request)
    {
        $zip = Address::where('Place_Name', 'Like', '%' .$request->search. '%')->get();
        $zip_o = [];
        $zip_array = [];
        foreach($zip as $row){
            $wall_damages = explode(',', $row->Place_Name);
            foreach($wall_damages as $key){
                if(in_array($key, $zip_o)) {

                }else{
                    array_push($zip_o ,$key );
                    // $data = Address::create([
                    //     'Place_Name' => $key,
                    //     'Postal_Code' =>$row->Postal_Code,

                    // ]);
                    // $final = array('Place_Name' => $key,'Postal_Code' =>$row->Postal_Code );
                    // array_push($zip_array ,$final );
                }
            }
            
        }
        return $zip_o;
    }
}
