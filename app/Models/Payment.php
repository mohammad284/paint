<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','payment','tender_id','package_id'];

    public function package()
    {
        return $this->belongsTo('App\Models\Package', 'package_id', 'id');
    }
    public function tender()
    {
        return $this->belongsTo('App\Models\Tender', 'tender_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
