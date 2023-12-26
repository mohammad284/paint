<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distance extends Model
{
    use HasFactory;
    protected $fillable = ['tender_id','provider_id','distance'];

    public function destance(){
        return $this->belongsto('App\Models\Tender', 'tender_id', 'id');
    }
}
