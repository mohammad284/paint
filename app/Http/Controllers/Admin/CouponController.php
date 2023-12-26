<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Coupon;
class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function coupons(){
        $coupons = Coupon::all();
        $users = User::all();
        return view('store.coupon.coupons',compact('coupons','users'));
    }
    public function addNewCoupon(Request $request){
        $data = [
            'name'             => $request->name,
            'quantity_num'     => $request->quantity_num,
            'quantity_percent' => $request->quantity_percent,
            'min_bill'         => $request->min_bill,
            'from_time'        => $request->from_time,
            'to_time'          => $request->to_time,
            'use_times'        => $request->use_times,
            'status'           => 0
        ];
        Coupon::create($data);
        return redirect()->back()->withErrors('added successfully');
    }
    public function updateCoupon(Request $request , $cop_id){
        $coupon = Coupon::find($cop_id);
        $data = [
            'name'             => $request->name,
            'quantity_num'     => $request->quantity_num,
            'quantity_percent' => $request->quantity_percent,
            'min_bill'         => $request->min_bill,
            'from_time'        => $request->from_time,
            'to_time'          => $request->to_time,
            'use_times'        => $request->use_times
        ];
        $coupon->update($data);
        return redirect()->back()->withErrors('updated successfully');
    }
    public function activeDisCoupon($cop_id){
        $coupon = Coupon::find($cop_id);
        if($coupon->status == 0 || $coupon->status == null){$coupon->status = 1;$coupon->save();}
        else{$coupon->status = 0;$coupon->save();}
        return redirect()->back()->withErrors('message','changed status successfully');
    }
    public function deleteCoupon($cop_id){
        $coupon = Coupon::find($cop_id)->delete();
        return redirect()->back()->withErrors('deleted successfully');
    }
    public function activeCoupon($cop_id){
        $users = User::all();
        return view('store.coupon.active-coupon',compact('users','cop_id'));
    }
    public function activeCouponFor(Request $request){
        
    }
}
