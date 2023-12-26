<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TenderInterested;
use App\Models\User;
use App\Models\Payment;
use Mail;
use PDF;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class ReportController extends Controller
{
    public function reports(Request $request){
        $provider = User::find($request->provider_id);
        $interests = TenderInterested::whereBetween('updated_at', [$request->start_date, $request->end_date])->where('provider_id',$provider->id)->where('status','interested')->count();
        $connectes = TenderInterested::whereBetween('updated_at', [$request->start_date, $request->end_date])->where('provider_id',$provider->id)->where('status','connected')->count();
        $deals     = TenderInterested::whereBetween('updated_at', [$request->start_date, $request->end_date])->where('provider_id',$provider->id)->where('status','deal')->count();
        $payments  = Payment::with('tender','package')->whereBetween('updated_at', [$request->start_date, $request->end_date])->where('user_id',$request->provider_id)->get();
        return response()->json([
            'interests' => $interests,
            'connectes' => $connectes,
            'deals'     => $deals,
            'provider'  => $provider,
            'payments'  => $payments
        ]);
    }
    public function allReport(Request $request){
        $provider = JWTAuth::authenticate($request->token);
        if($request->start_date){
            $interests = TenderInterested::whereBetween('updated_at', [$request->start_date, $request->end_date])->where('provider_id',$provider->id)->where('status','interested')->get();
            $connectes = TenderInterested::whereBetween('updated_at', [$request->start_date, $request->end_date])->where('provider_id',$provider->id)->where('status','connected')->get();
            $deals     = TenderInterested::with('user','tender')->whereBetween('updated_at', [$request->start_date, $request->end_date])->where('provider_id',$provider->id)->where('status','deal')->get();
            $payments  = Payment::with('tender','package')->whereBetween('updated_at', [$request->start_date, $request->end_date])->where('user_id',$request->provider_id)->get();
        }else{
            $interests = TenderInterested::where('provider_id',$provider->id)->where('status','interested')->get();
            $connectes = TenderInterested::where('provider_id',$provider->id)->where('status','connected')->get();
            $deals     = TenderInterested::with('user','tender')->where('provider_id',$provider->id)->where('status','deal')->get();
            $payments  = Payment::with('tender','package')->where('user_id',$request->provider_id)->get();
        }
        return response()->json([
            'interests' => $interests,
            'connectes' => $connectes,
            'deals'     => $deals,
            'provider'  => $provider,
            'payments'  => $payments
        ]); 
    }
}