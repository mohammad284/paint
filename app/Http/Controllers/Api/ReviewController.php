<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\Review;
    use App\Models\User;
    use App\Models\ReviewDetail;
    use App\Models\ReviewAnswer;
    use App\Models\ReviewImage;
    use App\Models\Notification;
    use App\Models\NotificationText;
    use Image;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;
class ReviewController extends Controller
{
    public function addReview(Request $request){
        // ابعت التوكن بلا user_id
        $token   = JWTAuth::authenticate($request->token);
        $old_review = Review::where('provider_id',$request->provider_id)
        ->where('user_id',$token->id)
        ->where('tender_id',$request->tender_id)->first();
        $details = json_decode($request->details);
        if($old_review == null){
            $user = JWTAuth::authenticate($request->token);
            $provider = User::find($request->provider_id);
            $data = [
                'user_id'     => $user->id,
                'provider_id' => $request->provider_id,
                'comment'     => $request->comment,
                'tender_id'   => $request->tender_id,
            ];
            $review = Review::create($data);
            foreach($details as $detail){
                $data_details = [
                    'title'=> $detail->title,
                    'review_id'=> $review->id,
                    'rate'=> $detail->rate,
                ];
                ReviewDetail::create($data_details);
            }
            $rates = ReviewDetail::where('review_id',$review->id)->avg('rate');
            $review->rate = $rates;
            $review->save();
            if($request->file('image')){
                $path = 'images/review/';
                $files=$request->file('image');
    
                foreach($files as $file) {
                    $input['image'] = $file->getClientOriginalName();
                    $destinationPath = 'images/review/';
                    $img = Image::make($file->getRealPath());
                    $img->resize(800, 750, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path.$input['image']);
                    $name = $path.$input['image'];
                    ReviewImage::insert( [
                        'image'=>  $name,
                        'review_id'=> $review->id,
                    ]);
                }
            }
            $avg = Review::where('provider_id',$request->provider_id)->avg('rate');
            $provider = User::find($request->provider_id);
            $provider->rate = $avg;
            $provider->save();
            $not_text = NotificationText::where('type','addReview')->first();
            $not = [
                'en' => [
                    'notification' => "($user->first_name) : $not_text->not_en",
                ],
                'de' => [
                    'notification' => "($user->first_name) : $not_text->not_gr",
                ],
                'sender'  => $user->id,
                'reciver' => $provider->id,
                'status'  => 0,
                'type'    => 'review',
                'payload' => $review->id
            ];
            Notification::create($not);
            $token = $provider->fb_token;
            $from = "AAAAL7BzUWM:APA91bG_nBPSECAHlYl5Zo3eEX9jPI2_Td-dS4YasibBb2UsV2Tpof0PfsA2h2NQhfAqoHrg26Vm1Br6LitLIU5YhkhVfh1saVvijb5Qr01FcScZShEoK-E_ZDqVcSXO_N7YizeApqqA";
            $msg = array
                (
                    'body'  => "Eine neue Bewertung wurde hinzugefügt" ,
                    'title' => "A new rating has been added",
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
            return response()->json([
                'status' => '200',
                'details'=> $review
            ]);
        }else{
            return response()->json([
                'status' => '200',
                'details'=> $old_review
            ]);
        }

    }
    public function userReview(){
        $user_id   = JWTAuth::authenticate($request->token)->id;
        $review_details = Review::where('provider_id',$user_id)->get();

        return response()->json([
            'status' => '200',
            'details'=> $review_details
        ]);
    }
    public function deleteReview($review_id){
        $review = Review::where('id',$review_id)->first();
        $provider = User::find($review->provider_id);
        $review->delete();
        $avg = Review::where('provider_id',$request->provider_id)->avg('rate');
        $provider->rate = $avg;
        $provider->save();
        return response()->json([
            'status' => '200',
            'details' => 'deleted successfully'
        ]);
    }
    public function reply_review(Request $request)
    {
        $user_id   = JWTAuth::authenticate($request->token)->id;
        $data = [
            'review_id' => $request->review_id,
            'answer' => $request->answer,
            'user_id' => $user_id,
        ];
        $ans = ReviewAnswer::create($data);
        if($request->file('image')){
            $path = 'images/answer/';
            $files=$request->file('image');

            foreach($files as $file) {
                $input['image'] = $file->getClientOriginalName();
                $destinationPath = 'images/answer/';
                $img = Image::make($file->getRealPath());
                $img->resize(800, 750, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path.$input['image']);
                $name = $path.$input['image'];
                ReviewImage::create( [
                    'image'=>  $name,
                    'answer_id'=> $ans->id,
                ]);
            }
        }
        $answer = ReviewAnswer::with('user.images','images')->where('id',$ans->id)->first();
        $review = Review::find($request->review_id);
        // اول شي بشوف اذا هاللي عم يعمل ريبلي اذا هوي صاحب التعليق ببعت للطرف التاني واذا لأ ببعت للاول
        if($user_id == $review->user_id){
            $not = [
                'en' => [
                    'notification' => "add reply",
                ],
                'de' => [
                    'notification' => "Antwort hinzufügen",
                ],
                'sender'  => $review->user_id,
                'reciver' => $review->provider_id,
                'status'  => 0,
                'type' => 'review',
                'payload' => $review->id
            ];
            Notification::create($not);
            $reciver = User::find($review->provider_id);
            $token = $reciver->fb_token;
            $from = "AAAAL7BzUWM:APA91bG_nBPSECAHlYl5Zo3eEX9jPI2_Td-dS4YasibBb2UsV2Tpof0PfsA2h2NQhfAqoHrg26Vm1Br6LitLIU5YhkhVfh1saVvijb5Qr01FcScZShEoK-E_ZDqVcSXO_N7YizeApqqA";
            $msg = array
                (
                    'body'  => "Antwort hinzufügen" ,
                    'title' => "add reply",
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

        }else{
            $not = [
                'en' => [
                    'notification' => "add reply",
                ],
                'de' => [
                    'notification' => "Antwort hinzufügen",
                ],
                'sender'  => $review->provider_id,
                'reciver' => $review->user_id,
                'status'  => 0,
                'type' => 'review',
                'payload' => $review->id
            ];
            Notification::create($not);

            $reciver = User::find($review->user_id);
            $token = $reciver->fb_token;
            $from = "AAAAL7BzUWM:APA91bG_nBPSECAHlYl5Zo3eEX9jPI2_Td-dS4YasibBb2UsV2Tpof0PfsA2h2NQhfAqoHrg26Vm1Br6LitLIU5YhkhVfh1saVvijb5Qr01FcScZShEoK-E_ZDqVcSXO_N7YizeApqqA";
            $msg = array
                (
                    'body'  => "Antwort hinzufügen" ,
                    'title' => "add reply",
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
        
        return response()->json([
            'details' => $answer
        ]);
    }

    public function replies(Request $request)
    {
        $user_id   = $request->user_id;
        $reviews = Review::with('user.images','review_details','images','review_answer.user','review_answer.images','tender:id,title,postal_code')
        ->where('provider_id',$user_id)->get();
        return response()->json([
            'details' => $reviews
        ]);
    }

    public function review_details(Request $request)
    {
        $details = Review::with('user.images','review_details','images','review_answer.user.images','review_answer.images','tender:id,title,postal_code')
        ->where('id',$request->review_id)->first();
        return response()->json([
            'details' => $details
        ]);
    }
}