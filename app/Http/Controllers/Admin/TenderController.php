<?php

namespace App\Http\Controllers\Admin;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\Tender;
    use App\Models\TypeWork;
    use App\Models\User;
    use App\Models\Room;
    use App\Models\color;
    use App\Models\ColorShade;
    use App\Models\TenderInterested;
    use App\Models\TenderImage;
    use App\Models\Glossy;
    use App\Models\Floar;
    use App\Models\Plaster;
    use App\Models\TenderPrice;
    use App\Models\QuestionTender;

class TenderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function insideTender(){
        $tenders = Tender::with('rooms','user','type_work','postal','providerInterest')
        ->where('status','available')
        ->where('sub_business','1')
        ->whereHas('user',function($query){
            $query->where('deleted_at', null);
        })
        ->orderby('created_at','desc')
        ->get();
        return view('dashboard.tender.inside-tender',compact('tenders'));
    }
    public function outsideTender(){
        $tenders = Tender::with('user','type_work','postal','newcolor','floar','building','categories','providerInterest')
        ->where('status','available')
        ->whereHas('user',function($query){
            $query->where('deleted_at', null);
        })
        ->where('sub_business','3')->get();
        // return $tenders;
        return view('dashboard.tender.outside-tender',compact('tenders'));
    }
    public function outsideDetails($tender_id){
        $tender = Tender::with('user','type_work','postal','service','floar','building','newcolor','out_wall','categories')->find($tender_id);
        $images  = TenderImage::where('tender_id',$tender->id)->get();
        // return $tender;

        return view('dashboard.tender.outside-details',compact('tender','images'));
    }
    public function tenderRooms($tender_id){
        $rooms = Room::where('tender_id',$tender_id)->with('walls','windows','roofs','doors','edges','corridors','stairs')->get();
        $tender = Tender::find($tender_id);
        $images  = TenderImage::where('tender_id',$tender->id)->get();
        // return  $rooms;
        return view('dashboard.tender.details-tender',compact('rooms','tender','images'));
    }
    public function roomDetails($room_id){
        $room = Room::where('id',$room_id)->with('walls.newcolor','walls.oldcolor','windows.newcolor','windows.oldcolor','roofs.newcolor','roofs.oldcolor','doors.newcolor','doors.oldcolor','edges','corridors.newcolor','corridors.oldcolor','stairs.newcolor','stairs.oldcolor')->first();
        // return  $room;
        return view('dashboard.tender.details-room',compact('room'));
    }
    public function details($tender_id){
        $interest = TenderInterested::find($tender_id);
        $tender = Tender::find($interest->tender_id);
        if($tender->sub_business == 3){
            $tender = Tender::with('user','type_work','postal','service','floar','building','newcolor','out_wall','categories')->find($tender->id);
            $images  = TenderImage::where('tender_id',$tender->id)->get();
            return view('dashboard.tender.outside-details',compact('tender','images'));
        }elseif($tender->sub_business == 1){
            $rooms = Room::where('tender_id',$tender->id)->with('walls','windows','roofs','doors','edges','corridors','stairs')->get();
            $tender = Tender::find($tender->id);
            $images  = TenderImage::where('tender_id',$tender->id)->get();
            return view('dashboard.tender.details-tender',compact('rooms','tender','images'));
        }elseif($tender->sub_business == 2){
            $tender = Tender::with('postal','user','building_floors.colors')->where('id',$tender->id)->first();
            return view('dashboard.tender.floors-details',compact('tender'));
        }elseif($tender->sub_business == 4){
            $glossies = Glossy::with('newcolor','oldcolor')->where('tender_id',$tender->id)->get();
            return view('dashboard.tender.glossy-details',compact('glossies'));
        }elseif($tender->sub_business == 5){
            $flours = Floar::where('tender_id',$tender->id)->get();
            return view('dashboard.tender.flour-details',compact('flours'));
        }elseif($tender->sub_business == 6){
            $flours = Floar::where('tender_id',$tender->id)->get();
            return view('dashboard.tender.flour-details',compact('flours'));
        }elseif($tender->sub_business == 7){
            $plasters = Plaster::with('type_plaster')->where('tender_id',$tender->id)->get();
            return view('dashboard.tender.plaster-details',compact('plasters'));
        }
    }
    public function dealTenders(){
        $tenders = TenderInterested::with('user','tender','provider')
        ->whereHas('user',function($query){
            $query->where('deleted_at', null);
        })->where('status','deal')->get();
        return view('dashboard.tender.deal-tenders',compact('tenders'));
    }
    public function tenderInteristing(){
        $tenders = TenderInterested::with('user','tender','provider')->whereHas('user',function($query){
            $query->where('deleted_at', null);
        })->where('status','interested')->get();
        return view('dashboard.tender.interested-tender',compact('tenders'));
    }
    public function tenderConnected(){
        $tenders = TenderInterested::with('user','tender','provider')->whereHas('user',function($query){
            $query->where('deleted_at', null);
        })->where('status','connected')->get();
        return view('dashboard.tender.connected-tender',compact('tenders'));
    }
    public function dealDetails($tender_id){
        $all_details = Tender::with('user','type_work','conversation.chats','postal','service','floar','building','newcolor','out_wall','categories')->where('id',$tender_id)->first();
        $deal        = TenderInterested::with('provider.images')->where('tender_id',$tender_id)->first();
        $all_rooms   = Room::with('walls.newcolor','walls.oldcolor','walls.paper','windows.newcolor','windows.oldcolor','roofs.newcolor','roofs.paper','roofs.oldcolor','doors.newcolor','doors.oldcolor','edges','corridors.oldcolor','corridors.paper','corridors.newcolor','stairs.oldcolor','stairs.newcolor')
        ->where('tender_id',$tender_id)->get();
        // return $all_details['conversation'];
        return view('dashboard.tender.deal-details',compact('all_details','all_rooms','deal'));
    }
    public function deleteTender($tender_id){
        $tender = Tender::where('id',$tender_id)->delete();
        return redirect()->back()->withErrors('The tender has been successfully deleted');
    }
    public function buildingTender(){
        $tenders = Tender::with('postal','user')->whereHas('user',function($query){
            $query->where('deleted_at', null);
        })
        ->where('sub_business','2')
        ->where('status','available')->get();
        // return $tenders;
        return view('dashboard.tender.building-tender',compact('tenders'));
    }
    public function buildingsFloors($id){
        $tender = Tender::with('postal','user','building_floors.colors')->whereHas('user',function($query){
            $query->where('deleted_at', null);
        })->where('id',$id)->first();
        return view('dashboard.tender.floors-details',compact('tender'));
    }
    public function glossyTender(){
        $tenders = Tender::with('user','type_work','postal','glossy')
        ->whereHas('user',function($query){
            $query->where('deleted_at', null);
        })
        ->where('status','available')
        ->where('sub_business','4')->get();
        // dd($tenders);
        return view('dashboard.tender.glossy-tender',compact('tenders'));
    }
    public function glossyDetails($tend_id){
        $glossies = Glossy::with('newcolor','oldcolor')->where('tender_id',$tend_id)->get();
        // return $glossies;
        return view('dashboard.tender.glossy-details',compact('glossies'));
    }
    public function flourTender(){
        $flours = Tender::with('user','type_work','postal','flour_tender')->whereHas('user',function($query){
            $query->where('deleted_at', null);
        })
        ->where('status','available')
        ->whereIn('sub_business',['5','6'])->get();
        // return $flours;
        return view('dashboard.tender.flour-tender',compact('flours'));
    }
    public function flourDetails($tend_id){
        $flours = Floar::where('tender_id',$tend_id)->get();
        // return $flours;
        return view('dashboard.tender.flour-details',compact('flours'));
    }
    public function plasterTender(){
        $tenders = Tender::with('user','type_work','postal','plaster_tender')->whereHas('user',function($query){
            $query->where('deleted_at', null);
        })
        ->where('status','available')
        ->where('sub_business','7')->get();
        return view('dashboard.tender.plaster-tender',compact('tenders'));
    }
    public function plasterDetails($tend_id){
        $plasters = Plaster::with('type_plaster')->where('tender_id',$tend_id)->get();
        // dd($plasters);
        return view('dashboard.tender.plaster-details',compact('plasters'));
    }
    public function tenderPrice(){
        $prices = TenderPrice::all();
        return view('dashboard.tender-price.prices',compact('prices'));
    }
    public function updateTenderPrice(Request $request ,$pri_id){
        $price = TenderPrice::find($pri_id)->update(['price'=>$request->price]);
        return redirect()->back()->withErrors('updated successfully');
    }

    public function otherTender (){
        $tenders = Tender::with('business_type','user','questions_tender','postal','tender_type')->whereHas('user',function($query){
            $query->where('deleted_at', null);
        })
        ->whereNotIn('work_license',[1,2,3])->get();
        return view('dashboard.other-tenders.tenders',compact('tenders'));
    }
    public function otherTenderDetails($tender_id){
        $details = QuestionTender::with('questions','answers_tender')
        ->where('tender_id',$tender_id)
        ->get();
        return view('dashboard.other-tenders.details',compact('details'));
    }
}
