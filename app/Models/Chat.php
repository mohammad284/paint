<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id',
        'reciver_id',
        'message',
        'conversation_id',
        'is_read',
        'message_id',
        'reply_id',
        'type',
        'attachment'
    ];

    public function reply()
    {
        return $this->belongsTo('App\Models\Chat', 'reply_id', 'id');
    }

    public function tender()
    {
        return $this->belongsTo('App\Models\Tender', 'tender_id', 'id');
    }
    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'sender_id', 'id');
    }
    public function conversation()
    {
        return $this->belongsTo('App\Models\Conversation', 'conversation_id', 'id');
    }
}
