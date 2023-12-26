<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_id',
        'front_craft_card',
        'back_craft_card',
        'back_work_certificate',
        'front_work_certificate',
        'front_CR',
        'back_CR',
        'image'
    ];
    public function provider()
    {
        return $this->belongsTo('App\Models\User', 'provider_id', 'id');
    }
}
