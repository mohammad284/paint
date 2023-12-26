<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_id',
        'service_id'
    ];
    public function provider()
    {
        return $this->belongsTo('App\Models\User', 'provider_id', 'id');
    }
    public function service()
    {
        return $this->belongsTo('App\Models\ProviderService', 'service_id', 'id');
    }
}
