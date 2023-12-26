<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderInterested extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_id',
        'tender_id',
        'user_id',
        'status',
        'offer',
        'discount',
        'final_discount',
        'accept_user',
        'accept_provider',
        'specifec',
        'reason',
        'date',
        'hour',
        'rejected',
        'home_num',
        'street_num',
        'delivery_date',
        'discount_type' // 0 : fix, 1 : notfix,2 : suggest,
    ];

    public function provider()
    {
        return $this->belongsTo('App\Models\User', 'provider_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function tender()
    {
        return $this->belongsTo('App\Models\Tender', 'tender_id', 'id');
    }

    public function conversation()
    {
        return $this->hasMany('App\Models\Conversation', 'tender_interest', 'id')->orderBy('updated_at','asc');
    }
    public function review_tender()
    {
        return $this->hasMany('App\Models\Review','tender_id','tender_id');
    }
    
}
