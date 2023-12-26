<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'review_id',
        'answer',
        'user_id'
    ];

    public function reviews()
    {
        return $this->belongsTo('App\Models\Review','review_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function images()
    {
        return $this->hasmany('App\Models\ReviewImage','answer_id','id');
    }

}
