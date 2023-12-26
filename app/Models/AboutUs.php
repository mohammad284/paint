<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class AboutUs extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable = ['logo','email_support','mobile','phone','faceBook','whatsapp','twitter','Instagram','telegram'];
    public $translatedAttributes = ['bio'];
}
