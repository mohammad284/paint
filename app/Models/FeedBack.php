<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment',
        'rate',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
