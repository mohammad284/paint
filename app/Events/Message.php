<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
class Message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender_id;
    public $reciver_id;
    public $message;
    public $conversation_id;
    public $time;
    public $status;
    public $message_id;
    public $id;
    public $is_read;
    public $reply_id;
    public $attachment;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($sender_id , $reciver_id, $message, $conversation_id,$status,$message_id,$id,$is_read,$reply_id,$attachment=[])
    {
        $this -> sender_id = $sender_id;
        $this -> reciver_id = $reciver_id;
        $this -> message = $message;
        $this -> conversation_id = $conversation_id;
        $this -> time = now();
        $this -> status = $status;
        $this -> message_id = $message_id;
        $this -> id = $id;
        $this -> is_read = $is_read;
        $this -> reply_id = $reply_id;
        $this -> attachment = $attachment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this -> conversation_id);
    }
    public function broadcastAs()
    {
        return 'message';
    }
}
