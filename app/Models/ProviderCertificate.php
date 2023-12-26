<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderCertificate extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_id',
        'name'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Models\User','provider_id','id');
    }
}
