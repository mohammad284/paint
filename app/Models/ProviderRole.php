<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderRole extends Model
{
    use HasFactory;
    protected $fillable = ['glossy','provider_id'];

    public function provider_role()
    {
        return $this->belongsTo('App\Models\User', 'provider_id', 'id');
    }
}
