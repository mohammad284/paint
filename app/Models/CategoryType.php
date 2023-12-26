<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class CategoryType extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable = [
        'img'
    ];
    public $translatedAttributes = ['name'];
    public function tender(){
        
        return $this->hasMany('App\Models\Tender', 'category', 'id');
    }
}
