<?php

namespace App\Http\Controllers\Api;
    use App\Events\Message;
    use App\Models\User;
    use Illuminate\Routing\Controller;
    use Illuminate\Http\Request;
    use App\Models\BlackList;
    use App\Models\Conversation;
    use App\Models\Chat;
    use App\Models\Tender;
    use App\Models\TenderInterested;
    use App\Models\ChatAttachment;
    use Illuminate\Support\Str;
    use Image;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;
class chatController extends Controller
{

    public function getMessage(Request $request){
        $user_id = JWTAuth::authenticate($request->token)->id;

        $conversation = Conversation::find($request->conversation_id);
        $messages = Chat::where('conversation_id',$conversation->id)
        ->where('reciver_id',$user_id)->update(['is_read'=>'1']);
        if($user_id == $conversation->user_id){
            $conversation->user_read = 1;
            $conversation->save();
        }else{
            $conversation->provider_read = 1;
            $conversation->save();
        }
        $messages = Chat::with('reply')
        ->where('conversation_id',$conversation->id)->get()->map(function($messages) {
            return [
                'id' => $messages->id,
                'sender_id' => $messages->sender_id,
                'reciver_id'=> $messages->reciver_id,
                'message' => $messages->message,
                'conversation_id'=>$messages->conversation_id,
                'is_read' => $messages->is_read,
                'status' => $messages->status,
                'message_id'=>$messages->message_id,
                'reply_id'=>$messages->reply_id,
                'type'=>$messages->type,
                'attachment' =>  json_decode($messages->attachment),
                'created_at' => $messages->created_at,
                'reply' => $messages->reply ? [
                    'id' => $messages->reply['id'],
                    'sender_id' => $messages->reply['sender_id'],
                    'reciver_id' => $messages->reply['reciver_id'],
                    'message' => $messages->reply['message'],
                    'conversation_id' => $messages->reply['conversation_id'],
                    'is_read' => $messages->reply['is_read'],
                    'status' => $messages->reply['status'],
                    'message_id' => $messages->reply['message_id'],
                    'reply_id' => $messages->reply['reply_id'],
                    'attachment' =>  json_decode($messages->reply['attachment']),
                    'created_at' => $messages->reply['created_at'],
                ]:$messages->reply,
            ];
        });
        return response()->json([
            'details' => $messages
        ]);
    }
    public function conversations(Request $request){
        $user = JWTAuth::authenticate($request->token);
        $tender = Tender::find($request->tender_id);
        // $interest = TenderInterested::where('id',$c)->where()->first();
        $conversations = Conversation::with('user.images','provider','interest','reviews')
        ->with(['reviews'=>function($q) use ($tender,$user) {
            return $q->where('provider_id',$user->id)->where('tender_id',$tender->id)
            ->orwhere('user_id',$user->id)->where('tender_id',$tender->id);
        }])
        ->where('tender_id',$request->tender_id)->where('user_id',$user->id)
        ->orwhere('tender_id',$request->tender_id)->where('provider_id',$user->id)
        ->get();
        return response()->json([
            'details' => $conversations
        ]);
    }

    public function sendMessage(Request $request)
    {
        $conversation = Conversation::find($request->conversation_id);
        $sender_id = JWTAuth::authenticate($request->token)->id;
        if($request->id !=null){
            $message = Chat::find($request->id)->update(['is_read'=>'1']);
            $data = [
                'id' => $request->id,
                'sender_id' => $sender_id,
                'reciver_id'=> $request->reciver_id,
                'message' => $message,
                'conversation_id'=>$request->conversation_id,
                'is_read' => $request->is_read,
                'status' => $request->status,
                'message_id'=>$request->message_id,
                'reply_id'=>$request->reply_id,
                'attachment' => $request->attachment
            ];
            event(new Message($request->input('sender_id'),$request->input('reciver_id'),$message,$request->input('conversation_id'),$request->input('status'),$request->input('message_id'),$request->input('id'),$request->input('is_read'),$request->input('attachment')));
            // if($request->user_id == $conversation->user_id){
            //     $conversation->user_read = 1;
            //     $conversation->save();
            // }else{
            //     $conversation->provider_read = 1;
            //     $conversation->save();
            // }
            return ["done" => true];
        }

        $data = [
            'id' => $request->id,
            'sender_id' => $sender_id,
            'reciver_id'=> $request->reciver_id,
            'message' => $request->message,
            'conversation_id'=>$request->conversation_id,
            'is_read' => '0',
            'status' => $request->status,
            'message_id'=>$request->message_id,
            'reply_id'=>$request->reply_id,
            'attachment' =>  json_encode($request->attachment)
        ];

        $messages = Chat::where('conversation_id',$request->conversation_id)
        ->where('reciver_id',$sender_id)->update(['is_read'=>'1']);
        
        if($request->message != null || $request->attachment != null){
            $chat = Chat::create($data);
            event(new Message($request->input('sender_id'),$request->input('reciver_id'),$request->message,$request->input('conversation_id'),$request->input('status'),$request->input('message_id'),$chat->id,$request->input('is_read'),$request->input('reply_id'),$request->input('attachment')));
            
            if($sender_id == $conversation->user_id){
                $conversation->provider_read = 0;
                $conversation->save();
            }else{
                $conversation->user_read = 0;
                $conversation->save();
            }
        }
        event(new Message($request->input('sender_id'),$request->input('reciver_id'),$request->message,$request->input('conversation_id'),$request->input('status'),$request->input('message_id'),1,$request->input('is_read'),$request->input('reply_id'),$request->input('attachment')));

        if($request->message == null){
            if($sender_id == $conversation->user_id){
                $conversation->user_read = 0;
                $conversation->save();
            }else{
                $conversation->provider_read = 0;
                $conversation->save();
            }
        }else{
            $sender = User::find($sender_id);
            $recived = User::find($request->reciver_id);

            $token = $recived->fb_token;
            $from = "AAAAL7BzUWM:APA91bG_nBPSECAHlYl5Zo3eEX9jPI2_Td-dS4YasibBb2UsV2Tpof0PfsA2h2NQhfAqoHrg26Vm1Br6LitLIU5YhkhVfh1saVvijb5Qr01FcScZShEoK-E_ZDqVcSXO_N7YizeApqqA";
            $msg = array
                (
                    'body'  => $request->message ,
                    'title' => "from $sender->first_name",
                    'receiver' => 'erw',
                    'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                    'sound' => 'mySound',/*Default sound*/
                    // 'click_action' => 'http://phplaravel-724434-2461249.cloudwaysapps.com/'
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

        return ["successfully" => true];
    }

    public function sendChatAttach(Request $request)
    {

        if($request->file('file')){
            $path = 'images/attachments/';
            $files=$request->file('file');
            $attachments = [];
            foreach($files as $file) {
                $input['file'] = $file->getClientOriginalName();
                $destinationPath = 'images/attachments/';
                $file->move(public_path($destinationPath), time().$input['file']);
                $name = $path.time().$input['file'];
                array_push($attachments,$name);
            }
            return response()->json([
                'details' => $attachments
            ]);
        }
    }

    public function changeConversationStatus(Request $request)
    {
        $conver = Conversation::find($request->con_id);

        if($request->user_id == $conver->user_id){
            $conver->user_archive == 1 ? $conver->user_archive = 0 : $conver->user_archive = 1 ;
        }else{
            $conver->provider_archive == 1 ? $conver->provider_archive = 0 : $conver->provider_archive = 1 ;
        }
        $conver->save();
        return response()->json([
            'details' => 'true'
        ]);
    }

   
}
