<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class ProviderService extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable = ['img'];
    public $translatedAttributes = ['service'];

    // public function provider()
    // {
    //     return $this->belongsTo('App\Models\User', 'provider_id', 'id');
    // }
}
