<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $fillable = [
    'tender_id',
    'user_id',
    'provider_id',
    'user_archive',
    'provider_archive',
    'user_read',
    'provider_read',
    'close_con',
    'tender_interest'
  ];

    public function chats()
    {
        return $this->hasMany('App\Models\Chat','conversation_id','id');
    }
    public function interest()
    {
        return $this->belongsTo('App\Models\TenderInterested','tender_id','tender_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function provider()
    {
        return $this->belongsTo('App\Models\User', 'provider_id', 'id');
    }
}
