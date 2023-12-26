<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessProvider extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id', // دهان والبقية
        'work_license_id', // خارجي مع لكر داخلي خارجي بدون لكر والبقية
        'provider_id',
        'status', // from admin
        'active',  // from provider
    ];

    public function business()
    {
        return $this->belongsTo('App\Models\WorkLicense', 'work_license_id', 'id');
    }
    public function main_work()
    {
        return $this->belongsTo('App\Models\AllBusiness', 'business_id', 'id');
    }

    public function works()
    {
        return $this->belongsTo('App\Models\WorkLicense', 'work_license_id', 'id');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\User', 'provider_id', 'id');
    }
    
}
