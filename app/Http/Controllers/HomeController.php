<?php

namespace App\Http\Controllers;
use App\Events\Chatt;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd(Auth::user() );

        // select all users except logged in user
        // $users = User::where('id', '!=', Auth::id())->get();

        // count how many message are unread from the selected user
        $users = DB::select("select users.id, users.first_name,  users.email
        from users LEFT  JOIN  chats ON users.id = chats.sender_id  and chats.reciver_id = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name,  users.email");

        return view('home', ['users' => $users]);
    }

    public function getMessage($user_id)
    {
        $my_id = 11;

        // Make read all unread message
        // $rr = Chat::where(['sender_id' => $user_id, 'reciver_id' => $my_id]);

        // Get all message from selected user
        $messages = Chat::where(function ($query) use ($user_id, $my_id) {
            $query->where('sender_id', $user_id)->where('reciver_id', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('sender_id', $my_id)->where('reciver_id', $user_id);
        })->get();

        return view('messages.index', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $from = 10;
        $reciver_id = $request->receiver_id;
        $message = $request->message;

        $data = new Chat();
        $data->sender_id = $from;
        $data->reciver_id = $reciver_id;
        $data->message = $message;
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );
        $data = [
            'sender_id' => $from,
            'reciver_id' => $reciver_id,
            'message' => $message,
        ];
        event(new Chatt($data));
        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     $options
        // );

        // $data = ['sender_id' => $from, 'reciver_id' => $reciver_id]; // sending from and to user id when pressed enter
        // $pusher->trigger('my-channel', 'my-event', $data);
    }
}
