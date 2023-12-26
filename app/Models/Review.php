<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'provider_id',
        'comment',
        'rate',
        'tender_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function tender()
    {
        return $this->belongsTo('App\Models\Tender','tender_id','id');
    }
    public function provider()
    {
        return $this->belongsTo('App\Models\User','provider_id','id');
    }
    public function review_details()
    {
        return $this->hasmany('App\Models\ReviewDetail','review_id','id');
    }
    public function images()
    {
        return $this->hasmany('App\Models\ReviewImage','review_id','id');
    }
    public function review_answer()
    {
        return $this->hasMany('App\Models\ReviewAnswer','review_id','id');
    }
}
