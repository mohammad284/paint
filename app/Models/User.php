<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject , MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'password',
        'status',
        'type',
        'address',
        'rate',
        'gender',
        'postal_code',
        'company_name',
        'Legal_form',
        'work_type',
        'email_permission',
        'fb_token',
        'last_seen',
        'street_num',
        'home_num',
        'bank_name',
        'card_name',
        'card_num',
        'email_verified_at',
        'card_time',
        'card_type',
        'com_description',
        'work_range', 
        'id_device',
        'Guarantee',
        'spicial'
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function licences()
    {
        return $this->hasMany('App\Models\BusinessProvider','provider_id','id');
    }
    public function certificates()
    {
        return $this->hasMany('App\Models\ProviderCertificate','provider_id','id');
    }


    #######
    public function images()
    {
        return $this->hasOne('App\Models\ProviderImage','provider_id','id');
    }
    public function conversation()
    {
        return $this->hasOne('App\Models\Conversation','user_id','id');
    }
    public function tenderInterest()
    {
        return $this->hasMany('App\Models\Tender','specifec','id');
    }
    public function gallary()
    {
        return $this->hasMany('App\Models\ProviderGallary','provider_id','id');
    }
    public function service()
    {
        return $this->hasMany('App\Models\ServiceProvider','provider_id','id');
    }
    public function tender()
    {
        return $this->hasMany('App\Models\Tender','user_id','id');
    }
    public function interested()
    {
        return $this->hasMany('App\Models\TenderInterested','user_id','id');
    }
    public function provider_interested()
    {
        return $this->hasMany('App\Models\TenderInterested','provider_id','id');
    }
    public function user_deal()
    {
        return $this->hasMany('App\Models\TenderInterested','user_id','id')->where('status','deal');
    }
    public function last_deal()
    {
        return $this->hasOne('App\Models\TenderInterested','user_id','id')->where('status','deal')->latest("id");
    }
    public function package()
    {
        return $this->belongsTo('App\Models\Package', 'package_id', 'id');
    }
    public function postal()
    {
        return $this->belongsTo('App\Models\Address', 'postal_code', 'id');
    }
    public function user_review()
    {
        return $this->hasMany('App\Models\Review', 'provider_id', 'id');
    }
    public function send_notification()
    {
        return $this->hasone('App\Models\Notification', 'sender', 'id');
    }
    public function recive_notification()
    {
        return $this->belongsTo('App\Models\Notification', 'reciver', 'id');
    }
    public function payment(){
        
        return $this->hasMany('App\Models\Payment', 'user_id', 'id');
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function product_review()
    {
        return $this->hasMany('App\Models\ProductReview', 'user_id', 'id');
    }
    public function provider_role()
    {
        return $this->hasOne('App\Models\ProviderRole', 'provider_id', 'id');
    }
}
