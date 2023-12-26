<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use DB;
use Carbon;
class FinancialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function financialReport(){
        $payments = Payment::select(
            DB::raw('sum(payment) as sums'), 
            DB::raw("DATE_FORMAT(created_at,'%M-%Y') as months")
            )
        ->groupBy('months')
        ->orderBy('created_at','asc')
        ->get();
        return view('dashboard.financial.financial',compact('payments'));
    }
    public function paymentFilter(Request $request){
        $payments = Payment::with('user')->whereBetween('created_at', [$request->from, $request->to])->get();
        return view('dashboard.financial.filter-financial',compact('payments'));
    }
    public function paymentDetails(Request $request){
        $date = $request['date'];
        $year = \Carbon\Carbon::parse($request->date)->format('Y');
        $month = \Carbon\Carbon::parse($request->date)->format('m');
        $payments = Payment::whereMonth('created_at',$month)->whereYear('created_at',$year)->get();
        return view('dashboard.financial.filter-financial',compact('payments'));
    }
}
