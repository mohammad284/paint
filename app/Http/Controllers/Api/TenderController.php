<?php

namespace App\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
    use App\Events\Message;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    use PDF;
    use App\Models\WorkLicense;
    use App\Models\AllBusiness;
    use App\Models\Conversation;
    use App\Models\Chat;
    use App\Mail\SendInterested;
    use App\Mail\InterestMail;
    use App\Mail\CloseDeal;
    use App\Mail\TenderMail;
    use App\Mail\mailProvider;
    use App\Models\Corridor;
    use App\Models\Distance;
    use App\Models\Tender;
    use App\Models\BuildFloor;
    use App\Models\TypeWork;
    use App\Models\Room;
    use App\Models\Wall;
    use App\Models\Window;
    use App\Models\Glossy;
    use App\Models\Plaster;
    use App\Models\Service;
    use App\Models\floarType;
    use App\Models\Address;
    use App\Models\Door;
    use App\Models\Floar;
    use App\Models\Payment;
    use App\Models\Roof;
    use App\Models\TenderInterested;
    use App\Models\Notification;
    use App\Models\NotificationText;
    use App\Models\User;
    use App\Models\BuildingType;
    use App\Models\Edge;
    use App\Models\CategoryType;
    use App\Models\MaterialTender;
    use App\Models\TenderRead;
    use App\Models\TenderImage;
    use App\Models\OutsideWall;
    use App\Models\Stair;
    use App\Models\PlasterType;
    use App\Models\Review;
    use App\Models\TenderPrice;
    use App\Models\BusinessProvider;
    use App\Models\QuestionTender;
    use App\Models\AnswerTender;
    use Validator;
    use DB;
    use Image;
class TenderController extends Controller
{  
    public function send_firebase($token , $body ,$title)
    {
        $token = $token;
        $from = "AAAAL7BzUWM:APA91bG_nBPSECAHlYl5Zo3eEX9jPI2_Td-dS4YasibBb2UsV2Tpof0PfsA2h2NQhfAqoHrg26Vm1Br6LitLIU5YhkhVfh1saVvijb5Qr01FcScZShEoK-E_ZDqVcSXO_N7YizeApqqA";
        $msg = array
            (
                'body'  => "$body" ,
                'title' => "$title",
                'receiver' => 'erw',
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
            );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
    }

    public function tenderOffers(Request $request)
    {
      $offers = TenderInterested::with('provider:id,rate,first_name,last_name','provider.images:provider_id,image')
      ->where('tender_id',$request->tender_id)->get();
      return response()->json([
        'details' => $offers
      ]);
    }
    // 31 tenders
    public function storeOtherTender(Request $request)
    {
        $user_id   = JWTAuth::authenticate($request->token)->id;
        $work_license = WorkLicense::where('business_id',$request->main_business)->first();

        $tender = new Tender ;
        $tender->user_id       = $user_id;
        $tender->status        = 'available';
        $tender->title         = $request->title;
        $tender->postal_code   = $request->postal_code;
        $tender->note          = $request->note;
        $tender->expected_date = $request->expected_date;
        $tender->num_floor     = $request->num_floor;
        $tender->garage        = $request->garage;
        $tender->furnished     = $request->furnished;
        $tender->main_business = $request->main_business;
        $tender->sub_business  = $request->sub_business;
        $tender->work_license  = $work_license->id;
        $tender->materials     = $request->materials;
        $tender->title_loc     = $request->title_loc;
        $tender->Lowest_price  = $request->Lowest_price;
        $tender->min_budjet    = $request->min_budjet;
        $tender->max_budjet    = $request->max_budjet;
        $tender->save();
        foreach($request->questions as $question)
        {
            $data = [
                'tender_id'   => $tender->id,
                'question_id' => $question['question_id'],
            ];
            $question_tender = QuestionTender::create($data);
            foreach($question['answers'] as $answer){
                AnswerTender::insert( [
                    'question_id'=>  $question_tender->id,
                    'answer'=> $answer
                ]);
            }

        }
        return response()->json([
            'details' => $tender,
        ]);
    }
    public function editOtherTender(Request $request)
    {
        
      $tender = Tender::find($request->tender_id);
      $new_tender = new Tender;
      $new_tender->user_id = $tender->user_id;
      $new_tender->main_business = $tender->main_business;
      $new_tender->sub_business  = $tender->sub_business;
      $new_tender->work_license  = $tender->work_license;
      $new_tender->title_loc     = $tender->title_loc;
      $tender->Lowest_price      = $request->Lowest_price;
      $tender->min_budjet        = $request->min_budjet;
      $tender->max_budjet        = $request->max_budjet;
      $new_tender->save();

      $newId = $new_tender->id + 1 ; 
      $new_tender->id = $tender->id; 

      $tender->id = $newId; 
      $tender->save();
      $new_tender->save();

        $work_license = WorkLicense::where('business_id',$request->main_business)->first();

        $new_tender->title         = $request->title;
        $new_tender->postal_code   = $request->postal_code;
        $new_tender->note          = $request->note;
        $new_tender->expected_date = $request->expected_date;
        $new_tender->num_floor     = $request->num_floor;
        $new_tender->garage        = $request->garage;
        $new_tender->furnished     = $request->furnished;
        $new_tender->main_business = $request->main_business;
        $new_tender->sub_business  = $request->sub_business;
        $new_tender->work_license  = $work_license->id;
        $new_tender->materials     = $request->materials;
        $new_tender->status        = $tender->status;
        $new_tender->title_loc     = $request->title_loc;
        $new_tender->is_update     = 1;

        $new_tender->save();

        $last_questions = QuestionTender::where('tender_id',$request->tender_id)->update(['tender_id'=>$tender->id]);

        foreach($request->questions as $question)
        {
            $data = [
                'tender_id'   => $new_tender->id,
                'question_id' => $question['question_id'],
            ];
            $question_tender = QuestionTender::create($data);
            foreach($question['answers'] as $answer){
                AnswerTender::insert( [
                    'question_id'=>  $question_tender->id,
                    'answer'=> $answer
                ]);
            }
        }
        $tender->status = 'update'; 
        $tender->basic_tender = $new_tender->id;
        $tender->save();
        return response()->json([
            'details' => 'added successfully',
        ]);
    }

    public function archiveTender(Request $request)
    {
      $tenders = Tender::where('basic_tender',$request->basic_tender)->get();
      $final = [];
      foreach ($tenders as $tend) {
        $tender = Tender::with('user.images','flour_tender','plaster_tender','glossy','tenderImage','rooms.walls','rooms.windows','rooms.roofs','rooms.doors','rooms.edges','rooms.corridors','rooms.stairs','interested','out_wall','postal','building_floors','business_type','questions_tender.questions','questions_tender.answers_tender','tender_type')
        ->where('id',$tend->id)
        ->withCount('interested')
        ->first();
        array_push($final,$tender);
      }
      return response()->json([
        'details'=>$final
      ]);

    }

    public function startTender(Request $request){
        $user_id   = JWTAuth::authenticate($request->token)->id;
        $tender = new Tender ;
        $tender->user_id       = $user_id;
        $tender->status        = 'Draft';
        $tender->space         = $request->space;
        $tender->height        = $request->height;
        $tender->space_unit    = $request->space_unit;
        $tender->hight_unit    = $request->hight_unit;
        $tender->type_of_work  = $request->type_of_work;
        $tender->num_of_floors = $request->num_of_floors;
        $tender->num_of_rooms  = $request->num_of_rooms;
        $tender->main_business = $request->main_business;
        $tender->sub_business  = $request->sub_business;
        $tender->save();

        $drafts = Tender::whereBetween('created_at', ['2022-04-13', now()->subDays(2)])
        ->where('status','Draft')->delete();
        return response()->json([
            'status'  => '200',
            'details' => $tender,
        ]);
    }

    public function storeTender(Request $request){
        $tender = Tender::find($request->tender_id);
        $user = JWTAuth::authenticate($request->token);
        // $user = User::where('id',$tender->user_id)->first();
        if($tender->sub_business == 1){
            $tender->note          = $request->note;
            $tender->text          = $request->text;
            $tender->title         = $request->title;
            $tender->postal_code   = $request->postal_code;
            $tender->status        = "available";
            $tender->space         = $request->space;
            $tender->height        = $request->height;
            $tender->space_unit    = $request->space_unit;
            $tender->hight_unit    = $request->hight_unit;
            $tender->expected_date = $request->expected_date;
            $tender->furnished     = $request->furnished;
            $tender->house_type    = $request->house_type;
            $tender->num_floor     = $request->num_floor;
            $tender->garage        = $request->garage;
            $tender->num_of_floors = $request->num_of_floors;
            $tender->num_of_rooms  = $request->num_of_rooms;
            $tender->work_license  = $request->work_license;
            $tender->materials     = $request->materials;
            $tender->title_loc     = $request->title_loc;
            $tender->Lowest_price  = $request->Lowest_price;
            $tender->min_budjet    = $request->min_budjet;
            $tender->max_budjet    = $request->max_budjet;
            $tender->save();


            foreach($request->rooms as $room){
                $data = [
                    'tender_id' => $request->tender_id,
                    'type'      => $room['type'],
                    'furnished' => $room['furnished'],
                ];
                $rom = Room::create($data);
                if($room['walls'] == null){
                }else{
                    foreach($room['walls'] as $wall){

                        $data =[
                            'room_id'            => $rom->id,
                            'old_status_paint'   => $wall['old_status_paint'],
                            'old_status_paper'   => $wall['old_status_paper'],
                            'old_status_paste'   => $wall['old_status_paste'],
                            'old_status_plaster' => $wall['old_status_plaster'],
                            'old_color'          => $wall['old_color'],
                            'damage'             => $wall['damage'],
                            'paper_type'         => $wall['paper_type'],
                            'new_color'          => $wall['new_color'],
                            'new_status_paint'   => $wall['new_status_paint'],
                            'new_status_paper'   => $wall['new_status_paper'],
                            'new_status_paste'   => $wall['new_status_paste'],
                            'new_status_plaster' => $wall['new_status_plaster'],
                            'number_holes'       => $wall['number_holes'],
                            'number_incisions'   => $wall['number_incisions'],
                            'corner_style'       => $wall['corner_style'],
                            'peeling_wallpaper'  => $wall['peeling_wallpaper'],
                            'num_paste'          => $wall['num_paste'],
                        ];
                        Wall::create($data);
                    }
                }
                if($room['corridors'] == null){
                }else{
                    foreach($room['corridors'] as $corridor){

                        $data =[
                            'room_id'            => $rom->id,
                            'old_status_paint'   => $corridor['old_status_paint'],
                            'old_status_paper'   => $corridor['old_status_paper'],
                            'old_status_paste'   => $corridor['old_status_paste'],
                            'old_status_plaster' => $corridor['old_status_plaster'],
                            'peeling_wallpaper'  => $corridor['peeling_wallpaper'],
                            'old_color'          => $corridor['old_color'],
                            'damage'             => $corridor['damage'],
                            'paper_type'         => $corridor['paper_type'],
                            'new_color'          => $corridor['new_color'],
                            'new_status_paint'   => $corridor['new_status_paint'],
                            'new_status_paper'   => $corridor['new_status_paper'],
                            'new_status_paste'   => $corridor['new_status_paste'],
                            'new_status_plaster' => $corridor['new_status_plaster'],
                            'number_holes'       => $corridor['number_holes'],
                            'number_incisions'   => $corridor['number_incisions'],
                            'corner_style'       => $corridor['corner_style'],
                        ];
                        Corridor::create($data);
                    }
                }
                if($room['stairs'] == null){
                }else{
                    foreach($room['stairs'] as $stair){

                        $data =[
                            'room_id'   => $rom->id,
                            'old_color' => $stair['old_color'],
                            'new_color' => $stair['new_color'],
                            'damage'    => $stair['damage'],
                            'height'    => $stair['height'],
                        ];
                        Stair::create($data);
                    }
                }
                if($room['windows'] == null){
                }else{
                    foreach($room['windows'] as $window){
                        $data =[
                            'room_id'            => $rom->id,
                            'old_status_paint'   => $window['old_status_paint'],
                            'old_status_paste'   => $window['old_status_paste'],
                            'new_status_paint'   => $window['new_status_paint'],
                            'new_status_paste'   => $window['new_status_paste'],
                            'peeling_wallpaper'  => $window['peeling_wallpaper'],
                            'old_color'          => $window['old_color'],
                            'new_color'          => $window['new_color'],
                            'damage'             => $window['damage'],
                            'glossy'             => $window['glossy'],
                        ];
                        Window::create($data);
                    }
                }

                if($room['roofs'] == null){
                }else{
                    foreach($room['roofs'] as $roof){
                        $data =[
                            'room_id'            => $rom->id,
                            'old_status_paint'   => $roof['old_status_paint'],
                            'old_status_paper'   => $roof['old_status_paper'],
                            'old_status_paste'   => $roof['old_status_paste'],
                            'old_status_plaster' => $roof['old_status_plaster'],
                            'old_color'          => $roof['old_color'],
                            'damage'             => $roof['damage'],
                            'paper_type'         => $roof['paper_type'],
                            'new_color'          => $roof['new_color'],
                            'new_status_paint'   => $roof['new_status_paint'],
                            'new_status_paper'   => $roof['new_status_paper'],
                            'new_status_paste'   => $roof['new_status_paste'],
                            'new_status_plaster' => $roof['new_status_plaster'],
                            'number_holes'       => $roof['number_holes'],
                            'number_incisions'   => $roof['number_incisions'],
                            'corner_style'       => $roof['corner_style'],
                            'peeling_wallpaper'  => $roof['peeling_wallpaper'],
                            'num_paste'          => $roof['num_paste'],
                        ];
                        Roof::create($data);
                    }
                }
                if($room['doors'] == null){}else{
                    foreach($room['doors'] as $door){
                        $data =[
                            'room_id'            => $rom->id,
                            'old_status_paint'   => $door['old_status_paint'],
                            'old_status_paste'   => $door['old_status_paste'],
                            'new_status_paint'   => $door['new_status_paint'],
                            'new_status_paste'   => $door['new_status_paste'],
                            'peeling_wallpaper'  => $door['peeling_wallpaper'],
                            'old_color'          => $door['old_color'],
                            'damage'             => $door['damage'],
                            'new_color'          => $door['new_color'],
                            'glossy'             => $door['glossy'],
                        ];
                        Door::create($data);
                    }
                }

                if($room['edges'] == null){

                }else{
                    foreach($room['edges'] as $edge){
                        $data =[
                            'room_id'       => $rom->id,
                            'old_status'    => $edge['old_status'],
                            'new_status'    => $edge['new_status'],
                            'area'          => $edge['area'],
                            'unit'          => $edge['unit'],
                            'damage'        => $edge['damage'],
                        ];
                        Edge::create($data);
                    }
                }
                $not = [
                    'en' => [
                        'notification' => "($user->email) has sent a new tender",
                    ],
                    'de' => [
                        'notification' => "($user->email) hat ein neues Angebot gesendet",
                    ],
                    'sender'  => $tender->user_id,
                    'reciver' => '1',
                    'status'  => 0,
                    'payload' => $tender->id,
                    'type' => 'storeTender'
                ];
                Notification::create($not);

            }

        }elseif($tender->sub_business == 3){
            $data = [
                'service_id'        => $request->service_id,
                'expected_date'     => $request->expected_date,
                'note'              => $request->note,
                'building_type'     => $request->building_type,
                'space'             => $request->space,
                'space_unit'        => $request->space_unit,
                'height'            => $request->height,
                'category'          => $request->category,
                'hight_unit'        => $request->hight_unit,
                'floar_type'        => $request->floar_type,
                'old_color'         => $request->old_color,
                'new_color'         => $request->new_color,
                'house_access'      => $request->house_access,
                'status_building'   => $request->status_building,
                'postal_code'       => $request->postal_code,
                'text'              => $request->text,
                'title'             => $request->title,
                'add_surface'       => $request->add_surface,
                'scaffolding'       => $request->scaffolding,
                'plaster'           => $request->plaster,
                'material_required' => $request->material_required,
                'status'            => "available",
                'house_type'        => $request->house_type,
                'num_floor'         => $request->num_floor,
                'garage'            => $request->garage,
                'facade_building'   => $request->facade_building,
                'work_license'      => $request->work_license,
                'materials'         => $request->materials,
                'title_loc'         => $request->title_loc,
                'Lowest_price'         => $request->Lowest_price,
                'min_budjet'         => $request->min_budjet,
                'max_budjet'         => $request->max_budjet,
            ];
            $tender->update($data);
            if($request->wall_damage){
                $wall_damages = explode(',', $request->wall_damage);
                foreach($wall_damages as $damage) {
                    OutsideWall::insert( [
                        'tender_id' => $request->tender_id,
                        'damage'    => $damage
                    ]);

                }
            }

        }
        $user = User::where('id',$tender->user_id)->first();
        $not = [
            'en' => [
                'notification' => "($user->email) has sent a new tender",
            ],
            'de' => [
                'notification' => "($user->email) hat ein neues Angebot gesendet",
            ],
            'sender'  => $tender->user_id,
            'reciver' => '1',
            'status'  => 0,
            'payload' => $tender->id,
            'type' => 'storeTender'
        ];
        Notification::create($not);

        return response()->json($tender);
    }

    public function storeBuildingTender(Request $request){
        $tender = Tender::find($request->tender_id);
        $tender->status        = "available";
        $tender->postal_code   = $request->postal_code;
        $tender->note          = $request->note;
        $tender->title         = $request->title;
        $tender->expected_date = $request->expected_date;
        $tender->text          = $request->text;
        $tender->space         = $request->space;
        $tender->height        = $request->height;
        $tender->space_unit    = $request->space_unit;
        $tender->hight_unit    = $request->hight_unit;
        $tender->type_of_work  = $request->type_of_work;
        $tender->num_of_floors = $request->num_of_floors;
        $tender->num_of_rooms  = $request->num_of_rooms;
        $tender->work_license  = $request->work_license;
        $tender->materials     = $request->materials;
        $tender->title_loc     = $request->title_loc;
        $tender->Lowest_price  = $request->Lowest_price;
        $tender->min_budjet    = $request->min_budjet;
        $tender->max_budjet    = $request->max_budjet;
        $tender->save();
        if($tender->sub_business == 2){
            foreach($request->floors as $floor){
                $data   = [
                    'num_of_rooms'      => $floor['num_of_rooms'],
                    'color'             => $floor['color'],
                    'num_of_walls'      => $floor['num_of_walls'],
                    'num_of_roofs'      => $floor['num_of_roofs'],
                    'num_of_baths'      => $floor['num_of_baths'],
                    'num_of_corridor'   => $floor['num_of_corridor'],
                    'num_of_stairs'     => $floor['num_of_stairs'],
                    'num_of_kitchen'    => $floor['num_of_kitchen'],
                    'num_of_doors'      => $floor['num_of_doors'],
                    'num_of_windows'    => $floor['num_of_windows'],
                    'new_status_paint'  => $floor['new_status_paint'],
                    'new_status_paste'  => $floor['new_status_paste'],
                    'new_status_base'   => $floor['new_status_base'],
                    'shave'             => $floor['shave'],
                    'area'              => $floor['area'],
                    'unit'              => $floor['unit'],
                    'tender_id'         => $tender->id,
                ];
                BuildFloor::create($data);
            }
        }
        $user = User::where('id',$tender->user_id)->first();
        $not = [
            'en' => [
                'notification' => "($user->email) has sent a new tender",
            ],
            'de' => [
                'notification' => "($user->email) hat ein neues Angebot gesendet",
            ],
            'sender'  => $tender->user_id,
            'reciver' => '1',
            'status'  => 0,
            'payload' => $tender->id,
            'type' => 'storeTender'
        ];
        Notification::create($not);
        return response()->json([
            'details' => 'added successfuly'
        ]);

    }

    public function storeGlossyFloreTender(Request $request){
        $tender = Tender::find($request->tender_id);
        $tender->status        = "available";
        $tender->postal_code   = $request->postal_code;
        $tender->note          = $request->note;
        $tender->title         = $request->title;
        $tender->expected_date = $request->expected_date;
        $tender->text          = $request->text;
        $tender->furnished     = $request->furnished;
        $tender->house_type    = $request->house_type;
        $tender->work_license  = $request->work_license;
        $tender->materials     = $request->materials;
        $tender->title_loc     = $request->title_loc;
        $tender->Lowest_price  = $request->Lowest_price;
        $tender->min_budjet    = $request->min_budjet;
        $tender->max_budjet    = $request->max_budjet;
        $tender->save();

        if($tender->sub_business == 4){
            foreach($request->details as $det){
                $data = [
                    'tender_id'          => $request->tender_id,
                    'type'               => $det['type'],
                    'old_status_paint'   => $det['old_status_paint'],
                    'old_status_paste'   => $det['old_status_paste'],
                    'new_status_paint'   => $det['new_status_paint'],
                    'new_status_paste'   => $det['new_status_paste'],
                    'peeling_wallpaper'  => $det['peeling_wallpaper'],
                    'old_color'          => $det['old_color'],
                    'new_color'          => $det['new_color'],
                    'damage'             => $det['damage'],
                    'paint_place'        => $det['paint_place'],
                    'count'              => $det['count'],
                ];
                Glossy::create($data);
            }
        }elseif($tender->sub_business == 5 | $tender->sub_business == 6 ){
            foreach($request->details as $det){
                $data = [
                    'tender_id'   => $request->tender_id,
                    'old_status'  => $det['old_status'],
                    'height'      => $det['height'],
                    'width'       => $det['width'],
                    'new_status'  => $det['new_status'],
                    'old_color'   => $det['old_color'],
                    'new_color'   => $det['new_color'],
                    'damage'      => $det['damage'],
                    'type'        => $det['type'],
                    'out_type'    => $det['out_type'],
                ];
                Floar::create($data);
            }
        }
        return response()->json([
            'details' => $tender
        ]) ;
    }

    public function storePlasterTender(Request $request){
        $tender = Tender::find($request->tender_id);
        $tender->status        = "available";
        $tender->postal_code   = $request->postal_code;
        $tender->note          = $request->note;
        $tender->title         = $request->title;
        $tender->expected_date = $request->expected_date;
        $tender->text          = $request->text;
        $tender->furnished     = $request->furnished;
        $tender->house_type    = $request->house_type;
        $tender->work_license  = $request->work_license;
        $tender->materials     = $request->materials;
        $tender->title_loc     = $request->title_loc;
        $tender->Lowest_price  = $request->Lowest_price;
        $tender->min_budjet    = $request->min_budjet;
        $tender->max_budjet    = $request->max_budjet;
        $tender->save();

        foreach($request->details as $det){
            if($det['type'] == 1){
                $data = [
                    'tender_id'     => $request->tender_id,
                    'plaster_type'  => $request->plaster_type,
                    'type'          => $det['type'],
                    'wall_width'    => $det['wall_width'],
                    'wall_hight'    => $det['wall_hight'],
                    'cornish_type'  => $det['cornish_type'],
                    'cornish_width' => $det['cornish_width'],
                    'cornish_hight' => $det['cornish_hight'],
                ];
            }elseif($det['type'] == 2){
                $data = [
                    'tender_id' => $request->tender_id,
                    'plaster_type'  => $request->plaster_type,
                    'type'      => $det['type'],
                    'text'      => $det['text'],
                    'work_space'=> $det['work_space'],
                ];
            }elseif($det['type'] == 3){
                $data = [
                    'tender_id'    => $request->tender_id,
                    'plaster_type' => $request->plaster_type,
                    'type'         => $det['type'],
                    'wall_width'   => $det['wall_width'],
                    'wall_hight'   => $det['wall_hight'],
                    'thickness'    => $det['thickness'],
                    'side'         => $det['side'],
                    'insulator'    => $det['insulator'],
                    'with_door'    => $det['with_door'],
                    'with_windows' => $det['with_windows'],
                    'door_width'   => $det['door_width'],
                    'door_hight'   => $det['door_hight'],
                    'window_width' => $det['window_width'],
                    'window_hight' => $det['window_hight'],
                ];
            }elseif($det['type'] == 4){
                $data = [
                    'tender_id'         => $request->tender_id,
                    'plaster_type'      => $request->plaster_type,
                    'type'              => $det['type'],
                    'roof_hight'        => $det['roof_hight'],
                    'distance_of_gypsum'=> $det['distance_of_gypsum'],
                    'insulator'         => $det['insulator'],
                    'with_decor'        => $det['with_decor'],
                    'roof_or_wall'      => $det['roof_or_wall'],
                    'work_space'        => $det['work_space'],
                ];
            }
            Plaster::create($data);
        }
        return response()->json([
            'details' => 'added successfully'
        ]);
    }
    public function updateTender(Request $request){
        $user_id = JWTAuth::authenticate($request->token)->id;
        $tender = Tender::where('user_id',$user_id)->where('id',$request->tender_id)->first();
        $new_tender = new Tender;
        $new_tender->user_id = $tender->user_id;
        $new_tender->main_business = $tender->main_business;
        $new_tender->sub_business  = $tender->sub_business;
        $new_tender->work_license  = $tender->work_license;
        $new_tender->save();
        $newId = $new_tender->id + 1 ;
        $new_tender->id = $tender->id;

        $tender->id = $newId; 
        $tender->save();
        $new_tender->save();

        if($tender->sub_business == 1){
            $rooms = Room::where('tender_id',$request->tender_id)->update(['tender_id'=>$tender->id]);
            $new_tender->space         = $request->space;
            $new_tender->height        = $request->height;
            $new_tender->space_unit    = $request->space_unit;
            $new_tender->hight_unit    = $request->hight_unit;
            $new_tender->note          = $request->note;
            $new_tender->text          = $request->text;
            $new_tender->title         = $request->title;
            $new_tender->postal_code   = $request->postal_code;
            $new_tender->expected_date = $request->expected_date;
            $new_tender->furnished     = $request->furnished;
            $new_tender->house_type    = $request->house_type;
            $new_tender->materials     = $request->materials;
            $new_tender->status        = $tender->status;
            $new_tender->num_floor     = $request->num_floor;
            $new_tender->garage        = $request->garage;
            $new_tender->title_loc     = $request->title_loc;
            $new_tender->Lowest_price  = $request->Lowest_price;
            $new_tender->min_budjet    = $request->min_budjet;
            $new_tender->max_budjet    = $request->max_budjet;
            $new_tender->is_update     = 1;
            $new_tender->save();

            foreach($request->rooms as $room){
                $data = [
                    'tender_id' => $new_tender->id,
                    'type'      => $room['type'],
                    'furnished' => $room['furnished'],
                ];
                $rom = Room::create($data);
                if($room['walls'] == null){
                }else{
                    foreach($room['walls'] as $wall){

                        $data =[
                            'room_id'       => $rom->id,
                            'old_status_paint'   => $wall['old_status_paint'],
                            'old_status_paper'   => $wall['old_status_paper'],
                            'old_status_paste'   => $wall['old_status_paste'],
                            'old_status_plaster' => $wall['old_status_plaster'],
                            'old_color'          => $wall['old_color'],
                            'damage'             => $wall['damage'],
                            'paper_type'         => $wall['paper_type'],
                            'new_color'          => $wall['new_color'],
                            'new_status_paint'   => $wall['new_status_paint'],
                            'new_status_paper'   => $wall['new_status_paper'],
                            'new_status_paste'   => $wall['new_status_paste'],
                            'new_status_plaster' => $wall['new_status_plaster'],
                            'number_holes'       => $wall['number_holes'],
                            'number_incisions'   => $wall['number_incisions'],
                            'corner_style'       => $wall['corner_style'],
                            'peeling_wallpaper'  => $wall['peeling_wallpaper'],
                            'num_paste'          => $wall['num_paste'],
                        ];
                        Wall::create($data);
                    }
                }
                if($room['corridors'] == null){
                }else{
                    foreach($room['corridors'] as $corridor){

                        $data =[
                            'room_id'            => $rom->id,
                            'old_status_paint'   => $corridor['old_status_paint'],
                            'old_status_paper'   => $corridor['old_status_paper'],
                            'old_status_paste'   => $corridor['old_status_paste'],
                            'old_status_plaster' => $corridor['old_status_plaster'],
                            'peeling_wallpaper'  => $corridor['peeling_wallpaper'],
                            'old_color'          => $corridor['old_color'],
                            'damage'             => $corridor['damage'],
                            'paper_type'         => $corridor['paper_type'],
                            'new_color'          => $corridor['new_color'],
                            'new_status_paint'   => $corridor['new_status_paint'],
                            'new_status_paper'   => $corridor['new_status_paper'],
                            'new_status_paste'   => $corridor['new_status_paste'],
                            'new_status_plaster' => $corridor['new_status_plaster'],
                            'number_holes'       => $corridor['number_holes'],
                            'number_incisions'   => $corridor['number_incisions'],
                            'corner_style'       => $corridor['corner_style'],
                        ];
                        Corridor::create($data);
                    }
                }
                if($room['stairs'] == null){
                }else{
                    foreach($room['stairs'] as $stair){

                        $data =[
                            'room_id'   => $rom->id,
                            'old_color' => $stair['old_color'],
                            'new_color' => $stair['new_color'],
                            'damage'    => $stair['damage'],
                            'height'    => $stair['height'],
                        ];
                        Stair::create($data);
                    }
                }
                if($room['windows'] == null){
                }else{
                    foreach($room['windows'] as $window){
                        $data =[
                            'room_id'            => $rom->id,
                            'old_status_paint'   => $window['old_status_paint'],
                            'old_status_paste'   => $window['old_status_paste'],
                            'new_status_paint'   => $window['new_status_paint'],
                            'new_status_paste'   => $window['new_status_paste'],
                            'peeling_wallpaper'  => $window['peeling_wallpaper'],
                            'old_color'          => $window['old_color'],
                            'new_color'          => $window['new_color'],
                            'damage'             => $window['damage'],
                            'glossy'             => $window['glossy'],
                        ];
                        Window::create($data);
                    }
                }

                if($room['roofs'] == null){
                }else{
                    foreach($room['roofs'] as $roof){
                        $data =[
                            'room_id'            => $rom->id,
                            'old_status_paint'   => $roof['old_status_paint'],
                            'old_status_paper'   => $roof['old_status_paper'],
                            'old_status_paste'   => $roof['old_status_paste'],
                            'old_status_plaster' => $roof['old_status_plaster'],
                            'old_color'          => $roof['old_color'],
                            'damage'             => $roof['damage'],
                            'paper_type'         => $roof['paper_type'],
                            'new_color'          => $roof['new_color'],
                            'new_status_paint'   => $roof['new_status_paint'],
                            'new_status_paper'   => $roof['new_status_paper'],
                            'new_status_paste'   => $roof['new_status_paste'],
                            'new_status_plaster' => $roof['new_status_plaster'],
                            'number_holes'       => $roof['number_holes'],
                            'number_incisions'   => $roof['number_incisions'],
                            'corner_style'       => $roof['corner_style'],
                            'peeling_wallpaper'  => $roof['peeling_wallpaper'],
                            'num_paste'          => $roof['num_paste'],
                        ];
                        Roof::create($data);
                    }
                }
                if($room['doors'] == null){}else{
                    foreach($room['doors'] as $door){
                        $data =[
                            'room_id'            => $rom->id,
                            'old_status_paint'   => $door['old_status_paint'],
                            'old_status_paste'   => $door['old_status_paste'],
                            'new_status_paint'   => $door['new_status_paint'],
                            'new_status_paste'   => $door['new_status_paste'],
                            'peeling_wallpaper'  => $door['peeling_wallpaper'],
                            'old_color'          => $door['old_color'],
                            'new_color'          => $door['new_color'],
                            'damage'             => $door['damage'],
                            'glossy'             => $door['glossy'],
                        ];
                        Door::create($data);
                    }
                }

                if($room['edges'] == null){

                }else{
                    foreach($room['edges'] as $edge){
                        $data =[
                            'room_id'       => $rom->id,
                            'old_status'    => $edge['old_status'],
                            'new_status'    => $edge['new_status'],
                            'area'          => $edge['area'],
                            'unit'          => $edge['unit'],
                            'damage'        => $edge['damage'],
                        ];
                        Edge::create($data);
                    }
                }

            }
        }elseif($tender->sub_business == 3){
            $out = OutsideWall::where('tender_id',$request->tender_id)->update(['tender_id'=>$tender->id]);
            $data = [
                'service_id'      => $request->service_id,
                'expected_date'   => $request->expected_date,
                'note'            => $request->note,
                'building_type'   => $request->building_type,
                'space'           => $request->space,
                'space_unit'      => $request->space_unit,
                'height'          => $request->height,
                'category'        => $request->category,
                'hight_unit'      => $request->hight_unit,
                'floar_type'      => $request->floar_type,
                'old_color'       => $request->old_color,
                'new_color'       => $request->new_color,
                'house_access'    => $request->house_access,
                'status_building' => $request->status_building,
                'postal_code'     => $request->postal_code,
                'text'            => $request->text,
                'title'           => $request->title,
                'add_surface'     => $request->add_surface,
                'scaffolding'     => $request->scaffolding,
                'plaster'         => $request->plaster,
                'material_required' => $request->material_required,
                'house_type'        => $request->house_type,
                'num_floor'         => $request->num_floor,
                'garage'            => $request->garage,
                'status'            => $tender->status,
                'materials'         => $request->materials,
                'title_loc'         => $request->title_loc,
                'Lowest_price'      => $request->Lowest_price,
                'min_budjet'        => $request->min_budjet,
                'max_budjet'        => $request->max_budjet,
                'is_update'         => 1,
            ];
            $new_tender->update($data);

            if($request->wall_damage){

                $wall_damages = explode(',', $request->wall_damage);
                foreach($wall_damages as $damage) {
                    OutsideWall::insert( [
                        'tender_id' => $new_tender->id,
                        'damage'    => $damage
                    ]);

                }
            }
        }elseif($tender->sub_business == 2){
            $new_tender->postal_code   = $request->postal_code;
            $new_tender->note          = $request->note;
            $new_tender->title         = $request->title;
            $new_tender->expected_date = $request->expected_date;
            $new_tender->text          = $request->text;
            $new_tender->space         = $request->space;
            $new_tender->height        = $request->height;
            $new_tender->space_unit    = $request->space_unit;
            $new_tender->hight_unit    = $request->hight_unit;
            $new_tender->type_of_work  = $request->type_of_work;
            $new_tender->num_of_floors = $request->num_of_floors;
            $new_tender->num_of_rooms  = $request->num_of_rooms;
            $new_tender->materials     = $request->materials;
            $new_tender->title_loc     = $request->title_loc;
            $new_tender->status        = $tender->status;
            $new_tender->Lowest_price        = $request->Lowest_price;
            $new_tender->min_budjet        = $request->min_budjet;
            $new_tender->max_budjet        = $request->max_budjet;     
            
            $new_tender->is_update     = 1;
            $new_tender->save();
            $old = BuildFloor::where('tender_id',$request->tender_id)->update(['tender_id'=>$tender->id]);
            foreach($request->floors as $floor){
                $data   = [
                    'num_of_rooms'    => $floor['num_of_rooms'],
                    'color'           => $floor['color'],
                    'num_of_walls'    => $floor['num_of_walls'],
                    'num_of_roofs'    => $floor['num_of_roofs'],
                    'num_of_baths'    => $floor['num_of_baths'],
                    'num_of_corridor' => $floor['num_of_corridor'],
                    'num_of_stairs'   => $floor['num_of_stairs'],
                    'num_of_kitchen'  => $floor['num_of_kitchen'],
                    'num_of_doors'    => $floor['num_of_doors'],
                    'num_of_windows'  => $floor['num_of_windows'],
                    'new_status_paint'=> $floor['new_status_paint'],
                    'new_status_paste'=> $floor['new_status_paste'],
                    'new_status_base' => $floor['new_status_base'],
                    'shave'           => $floor['shave'],
                    'area'            => $floor['area'],
                    'unit'            => $floor['unit'],
                    'tender_id'       => $new_tender->id,
                ];
                BuildFloor::create($data);
            }
        }elseif($tender->sub_business == 4){
            $new_tender->postal_code = $request->postal_code;
            $new_tender->note = $request->note;
            $new_tender->title = $request->title;
            $new_tender->expected_date = $request->expected_date;
            $new_tender->text = $request->text;
            $new_tender->furnished     = $request->furnished;
            $new_tender->house_type    = $request->house_type;
            $new_tender->materials     = $request->materials;
            $new_tender->status        = $tender->status;
            $new_tender->Lowest_price        = $request->Lowest_price;
            $new_tender->min_budjet        = $request->min_budjet;
            $new_tender->max_budjet        = $request->max_budjet;
            $new_tender->is_update     = 1;
            $new_tender->save();
            $glossies = Glossy::where('tender_id',$tender->id)->update(['tender_id'=>$tender->id]);
            foreach($request->details as $det){
                $data = [
                    'tender_id'          => $new_tender->id,
                    'type'               => $det['type'],
                    'old_status_paint'   => $det['old_status_paint'],
                    'old_status_paste'   => $det['old_status_paste'],
                    'new_status_paint'   => $det['new_status_paint'],
                    'new_status_paste'   => $det['new_status_paste'],
                    'peeling_wallpaper'  => $det['peeling_wallpaper'],
                    'old_color'          => $det['old_color'],
                    'new_color'          => $det['new_color'],
                    'damage'             => $det['damage'],
                    'paint_place'        => $det['paint_place'],
                    'count'              => $det['count'],
                ];
                Glossy::create($data);
            }
        }elseif($tender->sub_business == 5 | $tender->sub_business == 6){
            $new_tender->postal_code   = $request->postal_code;
            $new_tender->note          = $request->note;
            $new_tender->title         = $request->title;
            $new_tender->expected_date = $request->expected_date;
            $new_tender->text          = $request->text;
            $new_tender->house_type    = $request->house_type;
            $new_tender->materials     = $request->materials;
            $new_tender->status        = $tender->status;
            $new_tender->Lowest_price        = $request->Lowest_price;
            $new_tender->min_budjet        = $request->min_budjet;
            $new_tender->max_budjet        = $request->max_budjet;  
            $new_tender->is_update     = 1;
            $new_tender->save();
            $flours = Floar::where('tender_id',$tender->id)->update(['tender_id'=>$tender->id]);
            foreach($request->details as $det){
                $data = [
                    'tender_id'   => $new_tender->id,
                    'old_status'  => $det['old_status'],
                    'height'      => $det['height'],
                    'width'       => $det['width'],
                    'new_status'  => $det['new_status'],
                    'old_color'   => $det['old_color'],
                    'new_color'   => $det['new_color'],
                    'damage'      => $det['damage'],
                    'type'        => $det['type'],
                    'out_type'    => $det['out_type'],
                ];
                Floar::create($data);
            }
        }elseif($tender->sub_business == 7){
            $new_tender->postal_code = $request->postal_code;
            $new_tender->note = $request->note;
            $new_tender->title = $request->title;
            $new_tender->expected_date = $request->expected_date;
            $new_tender->text = $request->text;
            $new_tender->furnished     = $request->furnished;
            $new_tender->house_type    = $request->house_type;
            $new_tender->materials     = $request->materials;
            $new_tender->status        = $tender->status;
            $new_tender->Lowest_price        = $request->Lowest_price;
            $new_tender->min_budjet        = $request->min_budjet;
            $new_tender->max_budjet        = $request->max_budjet;  
            $new_tender->is_update     = 1;
            $new_tender->save();
            $glossies = Plaster::where('tender_id',$tender->id)->update(['tender_id'=>$tender->id]);
            foreach($request->details as $det){
                if($det['type'] == 1){
                    $data = [
                        'tender_id'     => $new_tender->id,
                        'plaster_type'  => $request->plaster_type,
                        'type'          => $det['type'],
                        'wall_width'    => $det['wall_width'],
                        'wall_hight'    => $det['wall_hight'],
                        'cornish_type'  => $det['cornish_type'],
                        'cornish_width' => $det['cornish_width'],
                        'cornish_hight' => $det['cornish_hight'],
                    ];
                }elseif($det['type'] == 2){
                    $data = [
                        'tender_id' => $new_tender->id,
                        'plaster_type'  => $request->plaster_type,
                        'type'      => $det['type'],
                        'text'      => $det['text'],
                        'work_space'=> $det['work_space'],
                    ];
                }elseif($det['type'] == 3){
                    $data = [
                        'tender_id'    => $new_tender->id,
                        'plaster_type' => $request->plaster_type,
                        'type'         => $det['type'],
                        'wall_width'   => $det['wall_width'],
                        'wall_hight'   => $det['wall_hight'],
                        'thickness'    => $det['thickness'],
                        'side'         => $det['side'],
                        'insulator'    => $det['insulator'],
                        'with_door'    => $det['with_door'],
                        'with_windows' => $det['with_windows'],
                        'door_width'   => $det['door_width'],
                        'door_hight'   => $det['door_hight'],
                        'window_width' => $det['window_width'],
                        'window_hight' => $det['window_hight'],
                    ];
                }elseif($det['type'] == 4){
                    $data = [
                        'tender_id'         => $new_tender->id,
                        'plaster_type'      => $request->plaster_type,
                        'type'              => $det['type'],
                        'roof_hight'        => $det['roof_hight'],
                        'distance_of_gypsum'=> $det['distance_of_gypsum'],
                        'insulator'         => $det['insulator'],
                        'with_decor'        => $det['with_decor'],
                        'roof_or_wall'      => $det['roof_or_wall'],
                        'work_space'        => $det['work_space'],
                    ];
                }
                Plaster::create($data);
            }
        }
        $tender->status = 'update'; 
        $tender->basic_tender = $new_tender->id;
        $tender->save();

        $user = User::where('id',$tender->user_id)->first();
        $not_text = NotificationText::where('type','updateTender_not')->first();
        $not_text_mail = NotificationText::where('type','updateTender_mail')->first();
        $not_text_firebase = NotificationText::where('type','updateTender_firebase')->first();
        $not = [
            'en' => [
                'notification' => "($user->email) : ($not_text->not_en)",
            ],
            'de' => [
                'notification' => "($user->email) : ($not_text->not_gr)",
            ],
            'sender'  => $tender->user_id,
            'reciver' => '1',
            'status'  => 0,
            'payload' => $tender->id,
            'type'    => 'updateTender'
        ];
        Notification::create($not);
        $interesters = TenderInterested::where('tender_id',$new_tender->id)->get();

        foreach($interesters as $interester){
            $provider = User::find($interester->provider_id);
            $data = [
                'first_name'=>$provider->first_name,
                'last_name'=>$provider->last_name,
                'mobile'=>$provider->mobile,
                'title' => 'edit Tender',
                'data_en' => $not_text_mail->not_en,
                'data_gr' =>  $not_text_mail->not_gr,
                'tender' => $tender->title
            ];

            Mail::to($provider->email)->send(new TenderMail($data));
            $fire_not = $this->send_firebase($provider->fb_token , $not_text_firebase->not_gr ,$not_text_firebase->not_en);
        }
        return response()->json([
            'details' => 'updated successfully'
        ]);
    }

    public function deleteTender(Request $request){
        $user_id = JWTAuth::authenticate($request->token)->id;
        $tender = Tender::where('user_id',$user_id)
        ->where('id',$request->tender_id)
        ->first();
        $tender->status = 'deleted';
        $tender->save();
        $tender_interest = TenderInterested::where('tender_id',$request->tender_id)->update(['status'=>'deleted']);
        $user = User::where('id',$tender->user_id)->first();
        $users_interests = TenderInterested::where('tender_id',$request->tender_id)->get();
        $not_text_not = NotificationText::where('type','deleteTender_not')->first();
        $not_text_mail = NotificationText::where('type','deleteTender_mail')->first();
        foreach($users_interests as $users_interest){
            $user_inter = User::find($users_interest->provider_id);
            $not = [
                'en' => [
                    'notification' => "($user->first_name) : $not_text_not->not_en",
                ],
                'de' => [
                    'notification' => "($user->first_name) : $not_text_not->not_gr",
                ],
                'sender'  => $tender->user_id,
                'reciver' => $user_inter->id,
                'status'  => 0,
                'type' => 0
            ];
            Notification::create($not);
            $data = [
                'first_name'=> $user_inter->first_name,
                'last_name' => $user_inter->last_name,
                'data_en'   => "($user->first_name) : $not_text_mail->not_en",
                'data_gr'   => "($user->first_name) : $not_text_mail->not_gr",
                'title'     => 'tender deleted',
                'mobile'    => '',
                'tender'    => ''
            ];

            Mail::to($user_inter->email)->send(new TenderMail($data));
        }

        $not = [
            'en' => [
                'notification' => "($user->first_name) : $not_text_not->not_en",
            ],
            'de' => [
                'notification' => "($user->first_name) : $not_text_not->not_gr",
            ],
            'sender'  => $tender->user_id,
            'reciver' => '1',
            'status'  => 0,
            'type' => 0,
        ];
        Notification::create($not);
        return response()->json([
            'details' => 'deleted successfully'
        ]);
    }
    public function tenderImage(Request $request){
        if($request->file('image')){
            $path = 'images/tender/';
            $files=$request->file('image');

            foreach($files as $file) {
                $input['image'] = $file->getClientOriginalName();
                $destinationPath = 'images/tender/';

                $img = Image::make($file->getRealPath());
                $img->resize(800, 750, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path.$input['image']);
                $name = $path.$input['image'];
                TenderImage::insert( [
                    'image'=>  $name,
                    'tender_id'=> $request->tender_id,
                ]);
            }
        }
        return response()->json([
            'status'  => 200,
            'details' => 'added successfully'
        ]);
    }
    public function tenderFile(Request $request){

        if($request->hasFile('file')){
            $file=$request->file('file');
            $input['file'] = $file->getClientOriginalName();
            $path = 'images/tender';
            $destinationPath = 'images/tender';
            $path=$file->storeAs($destinationPath.'/'.time(),$input['file']);
            $name = $path;
           $data['file'] =  $name;
        }
        TenderImage::insert( [
            'file'=> $data['file'],
            'tender_id'=> $request->tender_id,
        ]);
        return response()->json([
            'status'  => 200,
            'details' => 'added successfully'
        ]);
    }
    public function deleteImage(Request $request){
        $image = TenderImage::find($request->img_id)->delete();
        return response()->json([
            'status'  => 200,
            'details' => 'deleted successfully'
        ]);
    }
    public function deleteFile(Request $request){
        $file = TenderImage::find($request->file_id)->delete();
        return response()->json([
            'status'  => 200,
            'details' => 'deleted successfully'
        ]);
    }
    public function sendInterested(Request $request){
        // ابعت التوكن ولا تبعت يوزر ايدي بس بدي بروفايدر ايدي بالحاله الاولى
        $token   = JWTAuth::authenticate($request->token);
        $tender_id   = $request->tender_id;
        $tender = Tender::find($tender_id);
        if($token->type == 'user'){

            $provider_id = $request->provider_id;
            $data = [
                'provider_id' => $provider_id,
                'tender_id'   => $tender_id,
                'user_id'     => $tender->user_id,
                'status'      => 'interested',
                'offer'       => null,
                'specifec'    => $provider_id,
                'discount_type'    => $request->discount_type,
            ];
            TenderInterested::create($data);
            $tender->specifec = $provider_id;
            $tender->save();
            $sender   = User::find($token->id);
            $reciver  = User::find($provider_id);
            $not_text_not = NotificationText::where('type','sendInterested_user_not')->first();
            $not_text_mail = NotificationText::where('type','sendInterested_user_mail')->first();
            
            $not = [
                'en' => [
                    'notification' => "The prospective client ($sender->first_name) has expressed interest in your services.

                    Please click on this notification to read the details of the tender and make a decision about whether or not to undertake this order.",
                ],
                'de' => [
                    'notification' => "Der Auftraggeber ($sender->first_name) hat sich für Ihre Leistungen interessiert.

                    Bitte klicken Sie auf diese Benachrichtigung, um die Details der Ausschreibung zu lesen und eine Entscheidung über die Erbringung dieses Auftrags zu treffen.",
                ],
                'sender'  => $token->id,
                'reciver' => $provider_id,
                'status'  => 0,
                'payload' => $tender_id,
                'type' => 'sendInterestedRequest'
            ];

            Notification::create($not);


        }else{
            $provider_id = $token->id;
            $last_offer = TenderInterested::where('provider_id',$provider_id)->where('tender_id',$tender_id)->first();
            if($last_offer != null && $last_offer->offer == null){
                $last_offer->offer = $request->offer;
                $last_offer->discount = $request->discount;
                $last_offer->discount_type = $request->discount_type;
                $last_offer->save();
                return response()->json([
                    'details' => 'added successfully'
                ]);
            }
            if($last_offer != null ){
                return response()->json([
                    'details' => 'You have already submitted your offer'
                ]);
            }
            $data = [
                'provider_id' => $provider_id,
                'tender_id'   => $tender_id,
                'user_id'     => $tender->user_id,
                'status'      => 'interested',
                'offer'       => $request->offer,
                'discount'    => $request->discount,
                'discount_type'    => $request->discount_type,
            ];
            TenderInterested::create($data);
            $sender  = User::find($provider_id);
            $reciver = User::where('id',$tender->user_id)->first();
            $not_text_not = NotificationText::where('type','sendInterested_not')->first();
            $not_text_mail = NotificationText::where('type','sendInterested_mail')->first();
            $not_text_firebase = NotificationText::where('type','sendInterested_firebase')->first();
            $not = [
                'en' => [
                    'notification' => "($sender->first_name) : $not_text_not->not_en",
                ],
                'de' => [
                    'notification' => "($sender->first_name) : $not_text_not->not_gr",
                ],
                'sender'  => $sender->id,
                'reciver' => $reciver->id,
                'status'  => 0,
                'payload' => $tender->id,
                'type' => 'sendInterested'
            ];
            Notification::create($not);
            $fire_not = $this->send_firebase($reciver->fb_token , "($sender->first_name  $sender->last_name ) : $not_text_firebase->not_gr" ,"($sender->first_name  $sender->last_name ) : $not_text_firebase->not_en");
            

        }
        return response()->json([
            'status' => '200',
            'details'=> 'added successfully'
        ]);
    }
    public function offerRejected(Request $request){
        $interested = TenderInterested::find($request->interested_id);
        $interested->rejected = '1';
        $interested->reason = $request->reason;
        $interested->save();

        $sender  = User::find($interested->user_id);
        $reciver = User::find($interested->provider_id);
        $tender  = Tender::find($interested->tender_id);
        $not_text_not = NotificationText::where('type','offerRejected_not')->first();
        $not_text_mail = NotificationText::where('type','offerRejected_mail')->first();
        $not_text_firebase = NotificationText::where('type','offerRejected_firebase')->first();
        $not = [
            'en' => [
                'notification' => "$not_text_not->not_en  $request->reason",
            ],
            'de' => [
                'notification' => "$not_text_not->not_gr  $request->reason",
            ],
            'sender'  => $sender->id,
            'reciver' => $reciver->id,
            'status'  => 0,
            'payload' => $interested->tender_id,
            'type' => 'offerRejected'
        ];
        Notification::create($not);
        $fire_not = $this->send_firebase($reciver->fb_token , "$not_text_firebase->not_gr" ,"$not_text_firebase->not_en");

            
            return response()->json([
                'details' => 'Rejected successfully'
            ]);
    }
    public function updateInterested(Request $request){

        $interested = TenderInterested::find($request->interested_id);
        if($interested->status == 'deal'){
            return response()->json([
                'details' => 'you cannot edit your offer',
            ]);
        }else{
            $interested->offer = $request->offer;
            $interested->save();
            $tender = Tender::where('id',$interested->tender_id)->first();
            $provider = User::where('id',$interested->provider_id)->first();

            $user = User::where('id',$tender->user_id)->first();
            $not_text_not = NotificationText::where('type','updateInterested_not')->first();
            $not_text_mail = NotificationText::where('type','updateInterested_mail')->first();
            $not_text_firebase = NotificationText::where('type','updateInterested_firebase')->first();
            $not = [
                'en' => [
                    'notification' => "($provider->first_name) : $not_text_not->not_en",
                ],
                'de' => [
                    'notification' => "($provider->first_name) : $not_text_not->not_gr",
                ],
                'sender'  => $provider_id,
                'reciver' => $user->id,
                'status'  => 0,
                'payload' => $tender->id,
                'type' => 'updateInterested'
            ];
            Notification::create($not);
            $data = [
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'mobile'=>$user->mobile,
                'title' => 'edit offer',
                'data_en' => "($provider->first_name) : $not_text_mail->not_en",
                'data_gr' =>  "($provider->first_name) : $not_text_mail->not_gr",
                'tender' => ''
            ];

            Mail::to($user->email)->send(new TenderMail($data));
            $fire_not = $this->send_firebase($user->fb_token , "($provider->first_name) : $not_text_firebase->not_gr" ,"($provider->first_name) : $not_text_firebase->not_en");
            
            return response()->json([
                'details' => $interested,
            ]);
        }

    }
    public function allInterested(Request $request){
        $user_id   = JWTAuth::authenticate($request->token)->id; 
        $tender_id  = $request->tender_id;
        $interested = TenderInterested::with('provider','user','tender')
        ->where('user_id',$user_id)->where('tender_id',$tender_id)->get();
        return response()->json([
            'status' => '200',
            'details'=> $interested
        ]);
    }
    public function tenderDetails(Request $request){
        // ابعت التوكن واذا كان هالتوكن مو نفسو صاحب المناقصه برجع فاضي 
        $token   = JWTAuth::authenticate($request->token);        
        $tender = Tender::with('flour_tender')->where('id',$request->tender_id)->first();
        
        $cost = $this->cost($tender);

        if($token->id != $tender->user_id){
            $provider_id = $token->id;
            $tender = Tender::with('user.images','flour_tender','plaster_tender','glossy','tenderImage','rooms.walls','rooms.windows','rooms.roofs','rooms.doors','rooms.edges','rooms.corridors','rooms.stairs','interested','out_wall','postal','building_floors','business_type','questions_tender.questions','questions_tender.answers_tender','tender_type')
            ->where('id',$request->tender_id)
            ->withCount('interested')
            ->first();
            $reviews = Review::with('user.images')->where('provider_id',$provider_id)->take(2)->get();
            $offer = TenderInterested::where('provider_id',$provider_id)->where('tender_id',$tender->id)->first();
            $user_information = User::find($tender->user_id);
            $num_of_tenders = Tender::where('user_id',$user_information->id)
            ->where('status','!=','Draft')->count();
            $num_of_deals = TenderInterested::where('user_id',$user_information->id)->where('status','deal')->orwhere('provider_id',$user_information->id)
            ->where('status','deal')->count();
            $last_tender = Tender::where('user_id',$user_information->id)->latest()->first();
            $final = array('tender'=>$tender,'cost'=>$cost,'num_of_deals'=>$num_of_deals,'offer'=>$offer);
            $data_read = [
                'tender_id' =>$tender->id,
                'provider_id' => $provider_id
            ];
            $is_exist = TenderRead::where('tender_id',$tender->id)->where('provider_id',$provider_id)->first();
            if($is_exist == null){
                TenderRead::create($data_read);
            }else{
            }

            return response()->json([
                'status'  => '200',
                'details' => $final,
                'reviews' => $reviews,
                'num_of_tenders' => $num_of_tenders,
                'last_tender' => $last_tender,
                'num_of_deals' => $num_of_deals,
                'spicial' => $token->spicial
            ]);
        }else{
            $tender = Tender::with('user.images','flour_tender','plaster_tender','glossy','tenderImage','rooms.walls','rooms.windows','rooms.roofs','rooms.doors','rooms.edges','rooms.corridors','rooms.stairs','interested','out_wall','postal','building_floors','business_type','questions_tender.questions','questions_tender.answers_tender','tender_type')
            ->where('id',$request->tender_id)->withCount('interested')->first();
            $reviews = Review::with('user.images')->where('provider_id',$tender->user_id)->take(2)->get();
            $user_information = User::find($tender->user_id);
            $num_of_tenders = Tender::where('user_id',$user_information->id)
            ->where('status','!=','Draft')->count();
            $num_of_deals = TenderInterested::where('user_id',$user_information->id)->where('status','deal')->orwhere('provider_id',$user_information->id)
            ->where('status','deal')->count();
            $last_tender = Tender::where('user_id',$user_information->id)->latest()->first();
            $final = array('tender'=>$tender,'cost'=>$cost,'num_of_deals'=>$num_of_deals);
            return response()->json([
                'status' => '200',
                'details' => $final,
                'reviews' => $reviews,
                'num_of_tenders' =>$num_of_tenders,
                'last_tender' => $last_tender,
                'num_of_deals' => $num_of_deals,
                'spicial' => $token->spicial
            ]);
        }

    }
    // public function tenderOffer
    public function cost($tender){
        $all_payment = 1;
        return $all_payment;
    }
    public function myTenders(Request $request){
        // ابعت بس التوكن
        $user_id   = JWTAuth::authenticate($request->token)->id;
        $tenders = Tender::where('user_id',$user_id)
        ->whereIn('status',['connected','available'])
        ->get();
        $tender_details = [];
        foreach($tenders as $tend){

            $tender = Tender::with('tender_type.icons','business_type')->select('id','title','title_loc','work_license','main_business','sub_business','Lowest_price','min_budjet','max_budjet','created_at')->where('id',$tend->id)->get();
            $interested = TenderInterested::select('id','offer','discount','final_discount','provider_id','user_id','reason','rejected','discount_type','created_at')
            ->where('tender_id',$tend->id)
            ->where('status','interested')
            ->where('offer','!=',null)
            ->get();

            $inter_details = [];
            foreach($interested as $interest){
                $interesters = User::with('images','postal')->withCount('user_review')->where('id',$interest->provider_id)->get();
                $fin_interest = array('interested'=>$interest,'providers'=>$interesters);
                array_push( $inter_details ,$fin_interest);
            }

            $connecteds  = TenderInterested::where('tender_id',$tend->id)
            ->where('status','connected')->get();
            $con_details = [];
            foreach($connecteds as $connected){
                $connecter = User::with('images','postal')->withCount('user_review')->where('id',$connected->provider_id)->get();
                $fin_con = array('connect'=>$connected,'providers'=>$connecter);
                array_push( $con_details ,$fin_con);
            }

            $promissioms = BusinessProvider::where('business_id',$tend->work_license)
            ->where('status','1')
            ->where('active','1')
            ->pluck('provider_id');
            $ins_providers = User::with('images','postal')
            ->withCount('user_review')
            ->whereIn('id',$promissioms)
            ->where('status',1)
            ->where('type','provider')
            ->get();
            $my_request = [];
            $myRequests = TenderInterested::select('id','offer','discount','final_discount','provider_id','user_id','discount_type','created_at')
            ->where('tender_id',$tend->id)
            ->where('offer',null)->get();
            foreach($myRequests as $myRequest){
                $provider = User::with('images','postal')->withCount('user_review')->where('id',$myRequest->provider_id)->first();
                array_push($my_request ,$provider);
            }
            $final = array('tender'=>$tender,'interested'=>$inter_details,'connected'=>$con_details,'requested'=>$ins_providers,'myRequest'=>$my_request);

            array_push($tender_details,$final);
        }
        return response()->json([
            'status' => '200',
            'details' => $tender_details,
        ]);
    }
    public function archive(Request $request){
        // ابعت التوكن بس بلا user_id
        $user_id   = JWTAuth::authenticate($request->token)->id;
        $date   = now();
        $last  = now()->subMonth(5);
        $start =  date('Y-m-d', strtotime($last));
        $to =  date('Y-m-d', strtotime($date));
        $old_tenders = Tender::with('tenderImage','postal:id,Postal_Code,Place_Name')
            ->where('status','!=','deleted')->where('status','!=','Draft')
            ->where('user_id',$user_id)->whereBetween('created_at', ['2022-04-13', $start])
        ->get();
        $deal_tenders = Tender::with('tenderImage','postal:id,Postal_Code,Place_Name','interested.provider')
            ->with(['interested'=>function($q){
                $q->with('provider:id,first_name,last_name,email,mobile,company_name')->where('status','deal')->get();
            }])->withCount(['interested'=>function($quary){
                $quary->whereIn('status',['interested','connected']);
            }])
            ->where('user_id',$user_id)->where('status','deal')
        ->get();
        $deleted_tenders = Tender::with('tenderImage','postal:id,Postal_Code,Place_Name')
            ->where('user_id',$user_id)->where('status','deleted')
        ->get();
        // return $deleted_tenders;
        $tender_details = [];
        foreach($deal_tenders as $tend){
            $tender = Tender::with('tender_type.icons','business_type')->select('id','title','title_loc','main_business','sub_business','expected_date','Lowest_price','min_budjet','max_budjet','created_at')->where('id',$tend->id)->get();
            $interested = TenderInterested::select('id','offer','discount','final_discount','provider_id','user_id','discount_type','created_at')->where('tender_id',$tend->id)->whereIn('status',['connected','interested','deal'])->get();
            $inter_details = [];
            foreach($interested as $interest){
                $interesters = User::select('id', 'first_name', 'last_name','rate','postal_code')->with('images','postal:id,Postal_Code,Place_Name')->withCount('user_review')->where('id',$interest->provider_id)->get();
                $fin_interest = array('interested'=>$interest,'providers'=>$interesters);
                array_push( $inter_details ,$fin_interest);
            }
            $connecteds  = TenderInterested::where('tender_id',$tend->id)->whereIn('status',['connected','deal'])->orWhere('status','deleted')->where('tender_id',$tend->id)->get();
            $con_details = [];
            foreach($connecteds as $connected){
                $connecter = User::select('id', 'first_name', 'last_name','rate','postal_code')
                ->with('images','postal:id,Postal_Code,Place_Name')->withCount('user_review')->where('id',$connected->provider_id)->get();
                $fin_con = array('connect'=>$connected,'providers'=>$connecter);
                array_push( $con_details ,$fin_con);
            }
            $deal = TenderInterested::with('provider:id,first_name,last_name,email,mobile,company_name','provider.images','review_tender')
            ->where('tender_id',$tend->id)
            ->where('status','deal')
            ->where('tender_id',$tend->id)->first();

            $all_providers = [];
            $promissioms = BusinessProvider::where('work_license_id',$tend->work_license)
            ->where('status','1')
            ->where('active','1')
            ->pluck('provider_id');
            $ins_providers = User::with('images','postal')
            ->withCount('user_review')
            ->whereIn('id',$promissioms)
            ->where('status',1)
            ->where('type','provider')
            ->get();


            $final = array('tender'=>$tender,'interested'=>$inter_details,'connected'=>$con_details,'requested'=>$ins_providers,'deal'=>$deal);

            array_push($tender_details,$final);
        }
        $delete_details = [];
        foreach($deleted_tenders as $tend){
            $tender = Tender::select('id','title','title_loc','Lowest_price','min_budjet','max_budjet','created_at')->where('id',$tend->id)->get();
            $interested = TenderInterested::select('id','offer','discount','final_discount','provider_id','user_id','discount_type','created_at')
            ->where('tender_id',$tend->id)->where('status','interested')->get();
            $inter_details = [];
            foreach($interested as $interest){
                $interesters = User::select('id', 'first_name', 'last_name','rate','postal_code')->with('images','postal:id,Postal_Code,Place_Name')->withCount('user_review')->where('id',$interest->provider_id)->get();
                $fin_interest = array('interested'=>$interest,'providers'=>$interesters);
                array_push( $inter_details ,$fin_interest);
            }
            $connecteds  = TenderInterested::where('tender_id',$tend->id)->where('status','connected')->orWhere('status','deleted')->where('tender_id',$tend->id)->get();
            $con_details = [];
            foreach($connecteds as $connected){
                $connecter = User::select('id', 'first_name', 'last_name','rate','postal_code')->with('images','postal:id,Postal_Code,Place_Name')->withCount('user_review')->where('id',$connected->provider_id)->get();
                $fin_con = array('connect'=>$connected,'providers'=>$connecter);
                array_push( $con_details ,$fin_con);
            }
            $deal = TenderInterested::with('provider:id,first_name,last_name,email,mobile,company_name')->where('tender_id',$tend->id)->where('status','deal')->where('tender_id',$tend->id)->first();

            $all_providers = [];
            $promissioms = BusinessProvider::where('work_license_id',$tend->work_license)
            ->where('status','1')
            ->where('active','1')
            ->pluck('provider_id');
            $ins_providers = User::with('images','postal')
            ->withCount('user_review')
            ->whereIn('id',$promissioms)
            ->where('status',1)
            ->where('type','provider')
            ->get();
            $final = array('tender'=>$tender,'interested'=>$inter_details,'connected'=>$con_details,'requested'=>$ins_providers,'deal'=>$deal);

            array_push($delete_details,$final);
        }
        $old_details = [];
        foreach($old_tenders as $tend){
            $tender = Tender::select('id','title','title_loc','Lowest_price','min_budjet','max_budjet','created_at')->where('id',$tend->id)->get();
            $interested = TenderInterested::select('id','offer','discount','final_discount','provider_id','user_id','discount_type','created_at')->where('tender_id',$tend->id)->where('status','interested')->get();
            $inter_details = [];
            foreach($interested as $interest){
                $interesters = User::select('id', 'first_name', 'last_name','rate','postal_code')->with('images','postal:id,Postal_Code,Place_Name')->withCount('user_review')->where('id',$interest->provider_id)->get();
                $fin_interest = array('interested'=>$interest,'providers'=>$interesters);
                array_push( $inter_details ,$fin_interest);
            }
            $connecteds  = TenderInterested::where('tender_id',$tend->id)->where('status','connected')->orWhere('status','deleted')->where('tender_id',$tend->id)->get();
            $con_details = [];
            foreach($connecteds as $connected){
                $connecter = User::select('id', 'first_name', 'last_name','rate','postal_code')->with('images','postal:id,Postal_Code,Place_Name')->withCount('user_review')->where('id',$connected->provider_id)->get();
                $fin_con = array('connect'=>$connected,'providers'=>$connecter);
                array_push( $con_details ,$fin_con);
            }
            $deal = TenderInterested::with('provider:id,first_name,last_name,email,mobile,company_name')->where('tender_id',$tend->id)->where('status','deal')->where('tender_id',$tend->id)->first();

            $all_providers = [];
            $promissioms = BusinessProvider::where('work_license_id',$tend->work_license)
            ->where('status','1')
            ->where('active','1')
            ->pluck('provider_id');
            $ins_providers = User::with('images','postal')
            ->withCount('user_review')
            ->whereIn('id',$promissioms)
            ->where('status',1)
            ->where('type','provider')
            ->get();
            $final = array('tender'=>$tender,'interested'=>$inter_details,'connected'=>$con_details,'requested'=>$ins_providers,'deal'=>$deal);

            array_push($old_details,$final);
        }
        return response()->json([
            'old_tenders' => $old_details,
            'deal_tenders' => $tender_details,
            'deleted_tenders'=>$delete_details
        ]);
    }
    public function connected(Request $request){
        $interested_id     = $request->interested_id;
        $Tender_interested = TenderInterested::find($interested_id);
        $Tender_interested->status = 'connected';
        $Tender_interested->save();
        $sender = User::where('id',$Tender_interested->user_id)->first();
        $reciver = User::where('id',$Tender_interested->provider_id)->first();
        $last_conversation = Conversation::where('tender_id',$Tender_interested->tender_id)
        ->where('provider_id',$reciver->id)->where('user_id',$sender->id)
        ->first();
        if($last_conversation == null){
            $conversation = [
                'tender_id' => $Tender_interested->tender_id,
                'provider_id' =>  $reciver->id,
                'user_id'=> $sender->id,
                'user_read' => '0',
                'provider_read' => '0',
                'user_archive' => 0,
                'provider_archive' => 0,
                'tender_interest' => $interested_id ,
            ];
            $conversation = Conversation::create($conversation); 
            $price = number_format($Tender_interested->discount, 2);
            $data = [
                'sender_id' => $reciver->id,
                'reciver_id'=> $sender->id,
                'message' => " $Tender_interested->offer  \n \n $price € ",
                'conversation_id'=>$conversation->id,
                'is_read' => '0',
                'status' => '',
                'type'=> 'offer',

            ];
            $chat = Chat::create($data);
            $not_text_not = NotificationText::where('type','connected_not')->first();
            $not_text_mail = NotificationText::where('type','connected_mail')->first();
            $not_text_firebase = NotificationText::where('type','connected_firebase')->first();
            
            $not = [
                'en' => [
                    'notification' => "The [name of the client] has accepted your offer for the [$Tender_interested->tender_id]. The deal is now complete.",
                ],
                'de' => [
                    'notification' => "Der Auftraggeber [XXX] hat Ihr Angebot für den Auftrag [$Tender_interested->tender_id] angenommen. Der Deal ist damit vollständig abgeschlossen.",
                ],
                'sender'  => $sender->id,
                'reciver' => $reciver->id,
                'status'  => 0,
                'payload' => $Tender_interested->tender_id,
                'type' => 'connected'
            ];
            Notification::create($not);
            $fire_not = $this->send_firebase($reciver->fb_token , "$not_text_firebase->not_gr" ,"$not_text_firebase->not_en");
        }


        return response()->json([
            'status' => '200',
            'details'=> 'connected successfully'
        ]);
    }
    public function closeDeal(Request $request){
        $tender_id = $request->interest_id;
        $token   = JWTAuth::authenticate($request->token);
        $tender_interisted = TenderInterested::where('id',$tender_id)->first();
        if($tender_interisted->status == 'deal'){
            return response()->json([
                'status' => '200',
                'details'=> 'accepted successfully'
            ]);
        }
        $not_text_firebase = NotificationText::where('type','closeDeal_firebase')->first();
        if($token->id == $tender_interisted->user_id){
            if($tender_interisted->accept_user == 1 ){
                $tender_interisted->date = $request->date;
                $tender_interisted->hour = $request->hour;
                $tender_interisted->home_num = $request->home_num;
                $tender_interisted->street_num = $request->street_num;
                $tender_interisted->final_discount = $request->final_discount;
                $tender_interisted->delivery_date = $request->delivery_date;
                $tender_interisted->save();
                $conversation = Conversation::where('tender_id',$tender_interisted->tender_id)
                ->where('user_id',$tender_interisted->user_id)
                ->where('provider_id',$tender_interisted->provider_id)->first();
                $data = [
                    'sender_id' => $conversation->user_id,
                    'reciver_id'=> $conversation->provider_id,
                    'message' => 'i update deal',
                    'conversation_id'=>$conversation->id,
                    'is_read' => '0',
                    'status' => '',
                    'type'=> 'updateDeal',

                ];
                // return 'update';
                $chat = Chat::create($data);
                $reply_id = null;
                event(new Message($chat->sender_id,
                    $chat->reciver_id,
                    "Wir freuen uns, Ihnen die Bestätigung der Vereinbarung bezüglich dieses Angebots mitteilen zu können. Wir möchten Sie darüber informieren, dass Sie in Kürze die Kontaktdaten der anderen Partei erhalten, um direkt miteinander kommunizieren zu können. Wir möchten Ihnen unseren Dank dafür aussprechen, dass Sie unsere App gewählt haben und uns Ihr Vertrauen schenken.",
                    "$chat->conversation_id",
                    "",
                    "asdqweasdasedegg",
                    $chat->id,
                    0,
                    $reply_id
                ));

            }else{
                $user_id           = $request->user_id;
                $provider_id       = $tender_interisted->provider_id;
                $provider          = User::find($provider_id);
                $tender_interisted->accept_user = 1;
                $tender_interisted->date = $request->date;
                $tender_interisted->hour = $request->hour;
                $tender_interisted->home_num = $request->home_num;
                $tender_interisted->street_num = $request->street_num;
                $tender_interisted->final_discount = $request->final_discount;
                $tender_interisted->save();
                $fire_not = $this->send_firebase($provider->fb_token , "$not_text_firebase->not_gr" ,"$not_text_firebase->not_en");             
                
            }

            
            if($tender_interisted->accept_user == 1 && $tender_interisted->accept_provider == 1){

                $conversation = Conversation::where('tender_id',$tender_interisted->tender_id)
                ->where('user_id',$tender_interisted->user_id)
                ->where('provider_id',$tender_interisted->provider_id)->first();
                $data = [
                    'sender_id' => $conversation->user_id,
                    'reciver_id'=> $conversation->provider_id,
                    'message' => 'Wir freuen uns, Ihnen die Bestätigung der Vereinbarung bezüglich dieses Angebots mitteilen zu können. Wir möchten Sie darüber informieren, dass Sie in Kürze die Kontaktdaten der anderen Partei erhalten, um direkt miteinander kommunizieren zu können. Wir möchten Ihnen unseren Dank dafür aussprechen, dass Sie unsere App gewählt haben und uns Ihr Vertrauen schenken.',
                    'conversation_id'=>$conversation->id,
                    'is_read' => '0',
                    'status' => '',
                    'type'=> 'close',

                ];
                $chat = Chat::create($data);
                $reply_id = null;
                event(new Message($chat->sender_id,
                    $chat->reciver_id,
                    "Wir freuen uns, Ihnen die Bestätigung der Vereinbarung bezüglich dieses Angebots mitteilen zu können. Wir möchten Sie darüber informieren, dass Sie in Kürze die Kontaktdaten der anderen Partei erhalten, um direkt miteinander kommunizieren zu können. Wir möchten Ihnen unseren Dank dafür aussprechen, dass Sie unsere App gewählt haben und uns Ihr Vertrauen schenken.",
                    "$chat->conversation_id",
                    "",
                    "asdqweasdasedegg",
                    $chat->id,
                    0,
                    $reply_id
                ));
                $tender_interisted->status = 'deal';
                $tender_interisted->save();
                $tender = Tender::with('flour_tender','plaster_tender','glossy','rooms.walls','rooms.windows','rooms.roofs','rooms.doors','rooms.edges','rooms.corridors','rooms.stairs','service','interested','out_wall','postal','building','building_floors','newcolor')
                ->where('id',$tender_interisted->tender_id)->first();
                $user     = User::with('postal')->where('id',$tender->user_id)->first();


                $tender->status = 'deal';
                // reject all interest and connect and close conversations
                $tendersToClose = TenderInterested::where('tender_id',$tender_interisted->tender_id)
                ->where('id','!=',$tender_interisted->id)->get();
                

                $not_text_not = NotificationText::where('type','offerRejected_not')->first();
                $not_text_mail = NotificationText::where('type','offerRejected_mail')->first();
                $not_text_firebase = NotificationText::where('type','offerRejected_firebase')->first();
                foreach ($tendersToClose as $inte_close) {
                $inte_close->rejected = '1';
                $inte_close->reason = $not_text_not->not_gr;
                $inte_close->save();
                $convver = Conversation::where('tender_interest',$inte_close->id)->first();
                $not = [
                    'en' => [
                        'notification' => "$not_text_not->not_en  $request->reason",
                    ],
                    'de' => [
                        'notification' => "$not_text_not->not_gr  $request->reason",
                    ],
                    'sender'  => $tender_interisted->user_id,
                    'reciver' => $inte_close->provider_id,
                    'status'  => 0,
                    'payload' => $tender_interisted->tender_id,
                    'type' => 'offerRejected'
                    ];
                    Notification::create($not);
                    $data = [
                        'sender_id' => $convver->user_id,
                        'reciver_id'=> $convver->provider_id,
                        'message' => 'Ich entschuldige mich dafür, Ihnen mitteilen zu müssen, dass Ihr Angebot abgelehnt wurde, da der Kunde sich für einen anderen Anbieter entschieden hat. Leider können Sie keine weiteren Nachrichten an den Kunden senden. Wir danken Ihnen für Ihr Interesse und hoffen auf zukünftige Gelegenheiten, Sie zu bedienen.',
                        'conversation_id'=>$convver->id,
                        'is_read' => '0',
                        'status' => '',
                        'type'=> 'reject',

                    ];
                    $chat = Chat::create($data);
                    $reply_id = null;
                    event(new Message($chat->sender_id,
                        $chat->reciver_id,
                        "Ich entschuldige mich dafür, Ihnen mitteilen zu müssen, dass Ihr Angebot abgelehnt wurde, da der Kunde sich für einen anderen Anbieter entschieden hat. Leider können Sie keine weiteren Nachrichten an den Kunden senden. Wir danken Ihnen für Ihr Interesse und hoffen auf zukünftige Gelegenheiten, Sie zu bedienen.",
                        "$chat->conversation_id",
                        "",
                        "asdqweasdasedegg",
                        $chat->id,
                        0,
                        $reply_id
                    ));
                };
                //
                $convresationsToClose = Conversation::where('tender_id',$tender->id)
                ->where('id','!=',$conversation->id)->get();
                foreach($convresationsToClose as $con_close){
                $con_close->close_con = 1;
                $con_close->save();
                };

                $tender->save();
                $date = now();
                $conversation = Conversation::with('chats.sender')->where('tender_id',$tender->id)
                ->where('user_id',$tender->user_id)
                ->where('provider_id',$tender_interisted->provider_id)->first();


                // notification to close deal

                    $invit_user_to_rate = [
                        'en' => [
                            'notification' => "Please post a comment",
                        ],
                        'de' => [
                            'notification' => "Bitte hinterlassen Sie einen Kommentar",
                        ],
                        'sender'  => $provider->id,
                        'reciver' => $user->id,
                        'status'  => 0,
                        'type'    => 'deal',
                        'payload' => $tender->id
                    ];
                    Notification::create($invit_user_to_rate);
                    $invit_provider_to_rate = [
                        'en' => [
                            'notification' => "Please post a comment",
                        ],
                        'de' => [
                            'notification' => "Bitte hinterlassen Sie einen Kommentar",
                        ],
                        'sender'  => $user->id,
                        'reciver' => $provider->id,
                        'status'  => 0,
                        'type'    => 'deal',
                        'payload' => $tender->id
                    ];
                    Notification::create($invit_provider_to_rate);


                    // firebase notification
                    $fire_not = $this->send_firebase($provider->fb_token , "Bitte hinterlassen Sie einen Kommentar" ,"Please post a comment");
                    $fire_not = $this->send_firebase($user->fb_token , "Bitte hinterlassen Sie einen Kommentar" ,"Please post a comment");
                        

                    $data = [
                        'user'      => $user,
                        'provider'  => $provider,
                        'first_name'=> $provider->first_name,
                        'last_name' => $provider->last_name,
                        'now'       => now(),
                        'hour'      => $request->hour,
                        'tender'    => $tender,
                        'interisted'=> $tender_interisted,
                        'conversation' => $conversation,
                        'link'   =>  "https://www.google.com/maps/@{$tender['postal']->Latitude},{$tender['postal']->Longitude},18.14z?entry=ttu",
                        'data_en' => "The tender for both parties has been completed successfully
                        You can visit the other party at the time and date below",
                        'data_gr' =>  "Die Ausschreibung für beide Parteien wurde erfolgreich abgeschlossen
                        Sie können die andere Partei zum unten angegebenen Zeitpunkt und Datum besuchen",
                    ];
                    $pdf = PDF::loadView('dashboard.pdf.inside-deal', $data);

                    Mail::send('emails.close_deal', $data, function($message)use($data,$pdf) {
                        $message->to($data['provider']->email, 'malar')
                        ->subject('pdf')
                        ->attachData($pdf->output(), "maler.pdf");
                    });
                    Mail::send('emails.close_deal', $data, function($message)use($data,$pdf) {
                        $message->to($data['user']->email, 'malar')
                        ->subject('pdf')
                        ->attachData($pdf->output(), "maler.pdf");
                    });

                
            }
        }else{
            $provider_id   = $tender_interisted->provider_id;
            $provider      = User::find($provider_id);
            $tender_interisted = TenderInterested::where('id',$tender_id)->first();
            $tender_interisted->accept_provider = 1;
            $tender_interisted->save();
            $fire_not = $this->send_firebase($provider->fb_token , "$not_text_firebase->not_gr" ,"$not_text_firebase->not_en");

            if($tender_interisted->accept_user == 1 && $tender_interisted->accept_provider == 1){

                $conversation = Conversation::where('tender_id',$tender_interisted->tender_id)
                ->where('user_id',$tender_interisted->user_id)
                ->where('provider_id',$tender_interisted->provider_id)->first();
                $data = [
                    'sender_id' => $conversation->user_id,
                    'reciver_id'=> $conversation->provider_id,
                    'message' => 'Wir freuen uns, Ihnen die Bestätigung der Vereinbarung bezüglich dieses Angebots mitteilen zu können. Wir möchten Sie darüber informieren, dass Sie in Kürze die Kontaktdaten der anderen Partei erhalten, um direkt miteinander kommunizieren zu können. Wir möchten Ihnen unseren Dank dafür aussprechen, dass Sie unsere App gewählt haben und uns Ihr Vertrauen schenken.',
                    'conversation_id'=>$conversation->id,
                    'is_read' => '0',
                    'status' => '',
                    'type'=> 'close',

                ];
                $chat = Chat::create($data);
                $reply_id = null;
                event(new Message($chat->sender_id,
                    $chat->reciver_id,
                    "Wir freuen uns, Ihnen die Bestätigung der Vereinbarung bezüglich dieses Angebots mitteilen zu können. Wir möchten Sie darüber informieren, dass Sie in Kürze die Kontaktdaten der anderen Partei erhalten, um direkt miteinander kommunizieren zu können. Wir möchten Ihnen unseren Dank dafür aussprechen, dass Sie unsere App gewählt haben und uns Ihr Vertrauen schenken.",
                    "$chat->conversation_id",
                    "",
                    "asdqweasdasedegg",
                    $chat->id,
                    0,
                    $reply_id
                ));
                $provider = User::with('postal')->find($provider_id);
                $tender_interisted->status = 'deal';
                $tender_interisted->save();
                $tender = Tender::with('flour_tender','plaster_tender','glossy','rooms.walls','rooms.windows','rooms.roofs','rooms.doors','rooms.edges','rooms.corridors','rooms.stairs','service','interested','out_wall','postal','building','building_floors','newcolor')
                ->where('id',$tender_interisted->tender_id)->first();

                $user     = User::with('postal')->where('id',$tender->user_id)->first();

                // reject all interest and connect and close conversations
                $tendersToClose = TenderInterested::where('tender_id',$tender_interisted->tender_id)
                ->where('id','!=',$tender_interisted->id)
                ->where('status','connected')->get();
                $not_text_not = NotificationText::where('type','offerRejected_not')->first();
                $not_text_mail = NotificationText::where('type','offerRejected_mail')->first();
                $not_text_firebase = NotificationText::where('type','offerRejected_firebase')->first();
                foreach ($tendersToClose as $inte_close) {
                    $inte_close->rejected = '1';
                    $inte_close->reason = $not_text_not->not_gr;
                    $inte_close->save();
                    $convver = Conversation::where('tender_interest',$inte_close->id)->first();
                    $not = [
                        'en' => [
                            'notification' => "$not_text_not->not_en  $request->reason",
                        ],
                        'de' => [
                            'notification' => "$not_text_not->not_gr  $request->reason",
                        ],
                        'sender'  => $tender_interisted->user_id,
                        'reciver' => $inte_close->provider_id,
                        'status'  => 0,
                        'payload' => $tender_interisted->tender_id,
                        'type' => 'offerRejected'
                    ];
                    Notification::create($not);
                    $data = [
                        'sender_id' => $convver->user_id,
                        'reciver_id'=> $convver->provider_id,
                        'message' => 'Ich entschuldige mich dafür, Ihnen mitteilen zu müssen, dass Ihr Angebot abgelehnt wurde, da der Kunde sich für einen anderen Anbieter entschieden hat. Leider können Sie keine weiteren Nachrichten an den Kunden senden. Wir danken Ihnen für Ihr Interesse und hoffen auf zukünftige Gelegenheiten, Sie zu bedienen.',
                        'conversation_id'=>$convver->id,
                        'is_read' => '0',
                        'status' => '',
                        'type'=> 'reject',
                    ];
                    $chat = Chat::create($data);
                    $reply_id = null;
                    event(new Message($chat->sender_id,
                        $chat->reciver_id,
                        "Ich entschuldige mich dafür, Ihnen mitteilen zu müssen, dass Ihr Angebot abgelehnt wurde, da der Kunde sich für einen anderen Anbieter entschieden hat. Leider können Sie keine weiteren Nachrichten an den Kunden senden. Wir danken Ihnen für Ihr Interesse und hoffen auf zukünftige Gelegenheiten, Sie zu bedienen.",
                        "$chat->conversation_id",
                        "",
                        "asdqweasdasedegg",
                        $chat->id,
                        0,
                        $reply_id
                    ));                  
                };
                //
                $convresationsToClose = Conversation::where('tender_id',$tender->id)
                ->where('id','!=',$conversation->id)->get();
                foreach($convresationsToClose as $con_close){
                    $con_close->close_con = 1;
                    $con_close->save();
                };
                $tender->status = 'deal';

                $tender->save();
                $date = now();
                $conversation = Conversation::with('chats.sender')->where('tender_id',$tender->id)
                ->where('user_id',$tender->user_id)
                ->where('provider_id',$tender_interisted->provider_id)->first();

                // notification to close deal

                    $invit_user_to_rate = [
                        'en' => [
                            'notification' => "Please post a comment",
                        ],
                        'de' => [
                            'notification' => "Bitte hinterlassen Sie einen Kommentar",
                        ],
                        'sender'  => $provider->id,
                        'reciver' => $user->id,
                        'status'  => 0,
                        'type'    => 'deal',
                        'payload' => $tender->id
                    ];
                    Notification::create($invit_user_to_rate);

                    $invit_provider_to_rate = [
                        'en' => [
                            'notification' => "Please post a comment",
                        ],
                        'de' => [
                            'notification' => "Bitte hinterlassen Sie einen Kommentar",
                        ],
                        'sender'  => $user->id,
                        'reciver' => $provider->id,
                        'status'  => 0,
                        'type'    => 'deal',
                        'payload' => $tender->id
                    ];
                    Notification::create($invit_provider_to_rate);


                // firebase notification
                $fire_not = $this->send_firebase($provider->fb_token , "Bitte hinterlassen Sie einen Kommentar" ,"Please post a comment");
                $fire_not = $this->send_firebase($user->fb_token , "Bitte hinterlassen Sie einen Kommentar" ,"Please post a comment");

                    
                $data = [
                    'user'      => $user,
                    'provider'  => $provider,
                    'first_name'=> $provider->first_name,
                    'last_name' => $provider->last_name,
                    'now'       => now(),
                    'hour'      => $request->hour,
                    'tender'    => $tender,
                    'interisted'=> $tender_interisted,
                    'conversation' => $conversation,
                    'link'   =>  "https://www.google.com/maps/@{$tender['postal']->Latitude},{$tender['postal']->Longitude},18.14z?entry=ttu",
                    'data_en' => "The tender for both parties has been completed successfully
                    You can visit the other party at the time and date below",
                    'data_gr' =>  "Die Ausschreibung für beide Parteien wurde erfolgreich abgeschlossen
                    Sie können die andere Partei zum unten angegebenen Zeitpunkt und Datum besuchen",
                ];
                $pdf = PDF::loadView('dashboard.pdf.inside-deal', $data);

                Mail::send('emails.close_deal', $data, function($message)use($data,$pdf) {
                    $message->to($data['provider']->email, 'malar')
                    ->subject('pdf')
                    ->attachData($pdf->output(), "maler.pdf");
                });
                Mail::send('emails.close_deal', $data, function($message)use($data,$pdf) {
                    $message->to($data['user']->email, 'malar')
                    ->subject('pdf')
                    ->attachData($pdf->output(), "maler.pdf");
                });
                
            }
        }
        return response()->json([
            'status' => '200',
            'details'=> 'accepted successfully'
        ]);
    }
    // reject deal by provider 
    public function reject_deal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'interest_id' => ['required'],
            'reason' => ['required'],
        ]);        
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $tender_interisted = TenderInterested::where('id',$request->interest_id)->first();
        $conversation = Conversation::where('tender_id',$tender_interisted->tender_id)
        ->where('user_id',$tender_interisted->user_id)
        ->where('provider_id',$tender_interisted->provider_id)->first();
        $data = [
            'sender_id' => $conversation->user_id,
            'reciver_id'=> $conversation->provider_id,
            'message' => $request->reason,
            'conversation_id'=>$conversation->id,
            'is_read' => '0',
            'status' => '',
            'type'=> 'rejectDeal',
        ];
        $chat = Chat::create($data);
        $reply_id = null;
        event(new Message($chat->sender_id,
            $chat->reciver_id,
            "$request->reason",
            "$chat->conversation_id",
            "",
            "asdqweasdasedegg",
            $chat->id,
            0,
            $reply_id
        ));
        return response()->json([
            'status' => '200',
            'details'=> 'rejected successfully'
        ],200);
    }
    public function removeInterested(Request $request){
        $provider_id = $request->provider_id;
        $tender_id   = $request->tender_id;
        $tender_interested = TenderInterested::where('provider_id',$provider_id)->where('tender_id',$tender_id)->first();
        $tender_interested->delete();
        return response()->json([
            'status' => 200,
            'details' =>'deleted successfully'
        ]);

    }
    public function categories(){
        $categories = CategoryType::all();
        return response()->json([
            'status'=> 200,
            'details'=>$categories
        ]);
    }
    public function services(){
        $services = Service::all();
        return response()->json([
            'status'=> 200,
            'details'=>$services
        ]);
    }

    public function buildingType(){
        $types = BuildingType::all();
        return response()->json([
            'status'=> 200,
            'details'=>$types
        ]);
    }
    public function floarType(){
        $types = floarType::all();
        return response()->json([
            'status'=> 200,
            'details'=>$types
        ]);
    }

    public function all_tenders(Request $request){
        $provider   = JWTAuth::authenticate($request->token);
        // $provider = User::with('provider_role')->find($request->provider_id);
        $latitudeFrom = $request->lat;
        $longitudeFrom = $request->lan;
        $tend_dis = Tender::whereDoesntHave('destance',function($query)use($provider){
            return $query->where('provider_id',$provider->id);
        })
        ->where('status','available')->get();
        foreach($tend_dis as $tender){
            $postal = Address::find($tender->postal_code);
            $latitudeTo = $postal->Latitude;
            $longitudeTo = $postal->Longitude;
            $earthRadius = 6371;
            // convert from degrees to radians
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);

            $lonDelta = $lonTo - $lonFrom;
            $a = pow(cos($latTo) * sin($lonDelta), 2) +
                pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
            $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

            $angle = atan2(sqrt($a), $b);
            $final =  $angle * $earthRadius;
            $dest = Distance::where('tender_id',$tender->id)
            ->where('provider_id',$provider->id)
            ->first();
            if($dest == null){
                $data = [
                    'provider_id'=> $provider->id,
                    'distance'=>$final,
                    'tender_id'=>$tender->id,
                ];
                Distance::create($data);
            }
        }
        // provider prommissions to filter tenders
        $promissioms = BusinessProvider::where('provider_id',$provider->id)
            ->where('status','1')
            ->where('active','1')
            ->pluck('work_license_id');
        $tender_details = Tender::with('user','type_work','building_type','service','destance','tender_type.icons','business_type')
            ->withCount(['interested'=>function($inter){ 
                return $inter->where('status','interested');
            }])
            ->whereHas('user',function($query){
                $query->where('deleted_at', null);
            })
            ->whereDoesntHave('interested', function ($query) use($provider){ 
                $query->where('provider_id', $provider->id);
            })
            ->withCount(array('tender_read' => function($query) use ($provider) { 
                $query->where('provider_id', $provider->id);
            }))
            ->withCount('connect')
            ->where('status','available')
            ->whereIn('main_business',$promissioms)
            ->when($request->postal != 0,function($query) use($request){
                return $query->where('postal_code',$request->postal);
            })
            ->when($request->postal != 0 && $request->distance == 1,function($query) use($request){
                return $query->where('postal_code',$request->postal)
                ->OrWherehas('destance',function($dis) use($request){
                    return $dis->where('distance','<',$request->target);
                });
            })
            ->when($request->search != null,function($query) use($request){
                return $query->where('title', 'Like', '%' .$request->search. '%')
                ->orwhere('id', 'Like', '%' .$request->search. '%');
            })
            ->when($request->read == 1,function($query) use($request){
                return $query->whereDoesntHave('tender_read');
            })
            ->when($request->time == 1,function($query) use($request){
                return $query->whereBetween('created_at', [date('Y-m-d', strtotime(now()->subDays(2))), date('Y-m-d', strtotime(now()))]);
            })
            ->when($request->distance == 1,function($query) use($request,$provider){

                return $query->wherehas('destance',function($dis) use($request){
                    return $dis->where('distance','<',$request->target);
                });
            })
        ->get();
        return response()->json([
            'status' => 200,
            'details' => $tender_details
        ]);
    }

    public function myChats(Request $request){
        $user = JWTAuth::authenticate($request->token);
        $tender_conn = TenderInterested::with('tender:id,title,title_loc,Lowest_price,min_budjet,max_budjet,status','conversation.interest','conversation.user:id,first_name,last_name','conversation.user.images:id,image,provider_id','conversation.provider:id,first_name,last_name','conversation.provider.images:id,image,provider_id')
        ->with(['conversation'=>function($q) use ($request,$user) {
            
            return $q->where('provider_id',$user->id)->orwhere('user_id',$user->id);
        }])
        ->with(['conversation.reviews'=>function($q) use ($request,$user) {
            
            return $q->where('provider_id',$user->id)->orwhere('user_id',$user->id);
        }])
        ->where('user_id',$user->id)
        ->when($request->is_deal == 1,function($query){
            return $query->where('status','deal');
        })
        ->wherehas('conversation',function($query) use($request) {
            if($request->isArchive === true){
                return $query->where('user_archive',1);
            }
            elseif($request->isArchive === false ){
                return $query->where('user_archive','!=',1);
            }elseif($request->isArchive === null ){
                return $query;
            }
        })
        ->whereIn('status',['connected','deal','deleted'])

        ->orwhere('provider_id',$user->id)
        ->when($request->is_deal == 1,function($query){
            return $query->where('status','deal');
        })
        ->whereIn('status',['connected','deal','deleted'])
        ->wherehas('conversation',function($query) use($request) {

            if($request->isArchive === true){
                return $query->where('provider_archive',1);
            }
            elseif($request->isArchive === false ){
                return $query->where('provider_archive','!=',1);
            }elseif($request->isArchive === null ){
                return $query;
            }

        })
        ->get()->sortByDesc('conversation.updated_at');
        return response()->json([
            'status' => '200',
            'details'=> $tender_conn
        ]);
    }

    public function locations(){
        $locations = Location::all();
        return response()->json([
            'status' => 200,
            'details'=> $locations
        ]);
    }
    public function searchProvider(Request $request){
        $who = $request->who;
        $where = $request->where;
        $what = $request->what;
        $providers = User::with('images')->where('type','provider')
        ->where('status','1')
        ->when($who != null ,function ($query)  use($who){
            return $query->Where( 'first_name', 'LIKE', '%'.$who.'%' );
        })
        ->when($where != null ,function ($query)  use($where){
            return $query->Where( 'postal_code', 'LIKE', '%'.$where.'%' );
        })
        ->when($request->what ,function ($query) use($what){
            $promissioms = BusinessProvider::where('status','1')
            ->where('business_id',$what)
            ->where('active','1')
            ->pluck('provider_id');
            return $query->WhereIn('id',$promissioms );
        })
        ->get();
        return response()->json([
            'details' => $providers
        ]);
    }
    public function tasks(Request $request){
        $provider_id = JWTAuth::authenticate($request->token)->id;
        $tenders = TenderInterested::with('tender')
        ->where('provider_id',$provider_id)->where('status','deal')
        ->Orwhere('user_id',$request->user_id)->where('status','deal')
        ->get();
        return response()->json([
            'details' => $tenders
        ]);
    }

    public function plasterTypes(){
        $types = PlasterType::all();
        return response()->json([
            'details' => $types
        ]);
    }
}
