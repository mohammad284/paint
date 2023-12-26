<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessProvider;
use App\Models\BusinessSub;
use App\Models\AllBusiness;
use App\Models\Question;
use App\Models\SubBusiness;
use App\Models\WorkLicense;
use App\Models\Answer;
use App\Models\Icon;
use Image;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\OtherQuestion;

class BusinessController extends Controller
{
    public function all_business()
    {
        $businesses = AllBusiness::with('sub_business.icons','icons')
        ->get();
        return response()->json([
            'details' => $businesses
        ]);
    }

    public function provider_business(Request $request)
    {
        $businesses = BusinessProvider::with('business')->where('provider_id',$request->provider_id)->get();
        return response()->json([
            'details'=> $businesses
        ]);
    }
    // add and display and active bissiness licinse 
    public function add_dis_active_business(Request $request)
    {
        $provider_id   = JWTAuth::authenticate($request->token)->id;
        $business_provider = BusinessProvider::where('provider_id',$provider_id)
        ->where('work_license_id',$request->license_id)
        ->first();
        // return $business_provider;
        if($request->main_work_id){
            $business_provider = BusinessProvider::where('provider_id',$provider_id)
            ->where('business_id',$request->main_work_id)
            ->first();
            if($business_provider != null){
                if($business_provider->active == '1'){
                    $business_provider->active = 0;
                    $business_provider->save();
                }elseif($business_provider->active == '0'){
                    $business_provider->active = 1;
                    $business_provider->save();
                }
                return response()->json([
                    'details' => $business_provider
                ]);
            }
            $licenses = WorkLicense::where('business_id',$request->main_work_id)->pluck('id');
            foreach ($licenses as $license){
                $business_provider = BusinessProvider::create( [
                    'business_id' => $request->main_work_id,
                    'work_license_id'=> $license,
                    'provider_id' => $provider_id,
                    'status'      => 0,
                    'active'      => 1,
                ]);
            }
        }else{
            if($business_provider->active == '1'){
                $business_provider->active = 0;
                $business_provider->save();
            }elseif($business_provider->active == '0'){
                $business_provider->active = 1;
                $business_provider->save();
            }
        }
        return response()->json([
            'details' => $business_provider
        ]);
    }
    // all questions
    public function questions(Request $request)
    {
        $questions = Question::with('answers.icon','other_answer.icon')
        ->where('sub_business',$request->sub_business)->get();
        return response()->json([
            'details' => $questions
        ]);
    }

    public function worlLicense(){
        $All_business = AllBusiness::where('id','>',1)->get();
        foreach($All_business as $business ){
            WorkLicense::create([
                'name' => $business->name,
                'business_id'=>$business->id
            ]);
        }
        return $All_business;
    }
}
