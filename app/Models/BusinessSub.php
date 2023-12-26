<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSub extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'sub_id',
    ];

    public function sub()
    {
        return $this->belongsTo('App\Models\SubBusiness','sub_id','id');
    }
    
    public function business()
    {
        return $this->belongsTo('App\Models\AllBusiness','business_id','id');
    }
}
