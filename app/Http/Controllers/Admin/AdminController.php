<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Validator;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function admins(){
        $admins = Admin::all();
        return view('dashboard.admins',compact('admins'));
    }
    public function addAdmin(Request $request){

        $validator = Validator::make($request->all(), [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'type'     => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $admin =  Admin::create([
            'name'     => $request['name'],
            'type'     => $request['type'],
            'email'    => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
            return redirect()->back()->withErrors('A new admin has been added');

    }
    public function deleteAdmin($admin_id){

        $admins = Admin::all();
        if(count($admins) == 1){
            return redirect()->back()->withErrors('there must be at least one admin');

        }else{
            $admin = Admin::where('id',$admin_id)->first();
            $admin->delete();
            return redirect()->back()->withErrors('The admin has been removed successfully');

        }
    }
    public function updateAdmin(Request $request,$admin_id){
        $admin = Admin::where('id',$admin_id)->first();
        if ($admin->email != $request->email) {
            $simular_email = Admin::where('email',$request->email)->get();
            if (count($simular_email) > 0) {
                return redirect()->back()->withErrors('email has taken');
            }   
        }
        $validator = Validator::make($request->all(), [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255'],
            'type'      => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->password == null){
            $data = [
                'name'          => $request['name'],
                'type'          => $request['type'],
                'email'         => $request['email'],
            ];
        }else{
            $data = [
                'name'          => $request['name'],
                'type'          => $request['type'],
                'email'         => $request['email'],
                'password'      => Hash::make($request['password']),
            ];
        }

        $admin->update();
            return redirect()->back()->withErrors('The admin has been modified successfully');

    }
}
