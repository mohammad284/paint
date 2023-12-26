<?php

namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Mail;
    use PDF;
    use JWTAuth;
    use App\Models\TenderInterested;
    use App\Models\Tender;
    use App\Models\Conversation;
    use App\Models\User;
    use App\Models\Payment;

class PdfController extends Controller
{
    public function makeTenderPdf(Request $request)
    {
        $tender_interisted = TenderInterested::where('id',$request->interest_id)->first();
        $provider = User::find($tender_interisted->provider_id);
        $tender   = Tender::with('tender_type','business_type','postal','building')
            ->where('id',$tender_interisted->tender_id)
            ->first();
        $user     = User::with('postal')->where('id',$tender->user_id)->first();
        $conversation = Conversation::with('chats')
            ->whereHas('chats',function($query){
                return $query->whereNotNull('message');
            })
            ->where('tender_id',$tender->id)
            ->where('user_id',$tender->user_id)
            ->where('provider_id',$tender_interisted->provider_id)
            ->first();
        
        
        $data = [
            'user'      => $user,
            'provider'  => $provider,
            'now'       => now(),
            'tender'    => $tender,
            'interisted'=> $tender_interisted,
            'conversation' => $conversation,
            'link'   =>  "https://www.google.com/maps/@{$tender['postal']->Latitude},{$tender['postal']->Longitude},18.14z?entry=ttu",
        ];
        $path = 'images/pdf/';
        $filename = $tender->id;
        // return  $data ;
        $pdf = PDF::loadView('dashboard.pdf.inside-deal', $data)->save(''.$path.'/'.time().$filename.'.pdf');
        return response()->json([
            'details' => 'images/pdf/'.time().$filename.'.pdf'
        ]);
    }
    public function makeReportPdf(Request $request)
    {
        $provider = JWTAuth::authenticate($request->token);
        $tenders     = TenderInterested::whereBetween('updated_at', [$request->start_date, $request->end_date])
        ->where('provider_id',$provider->id)->get();
        // return $tenders;
        $data = [
            'start_date'=> $request->start_date,
            'end_date'  => $request->end_date,
            'user'  => $provider,
            'now'       => now(),
            'tenders'  => $tenders,
        ];
        return $tenders;
        $path = 'images/pdf/';
        $filename = $provider->id;
        $pdf = PDF::loadView('dashboard.pdf.report-pdf', $data)->save(''.$path.'/'.time().$filename.'.pdf');
        
        return response()->json([
            'details' => 'images/pdf/'.time().$filename.'.pdf'
        ]);
    }
}
