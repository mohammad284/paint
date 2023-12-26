<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderRead extends Model
{
    use HasFactory;
    protected $fillable = ['provider_id','tender_id'];

    public function provider_read()
    {
        return $this->belongsTo('App\Models\User', 'provider_id', 'id');
    }
    public function tender_read()
    {
        return $this->belongsTo('App\Models\Tender', 'tender_id', 'id');
    }
}
