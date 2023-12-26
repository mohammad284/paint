<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StatusLiked implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($username)
    {
        $this->message  = "new notification";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */

    public function broadcastOn()
    {
        return ['ample-farm-155'];
    }

    public function broadcastAs()
    {
        return 'status-liked';
    }
}
