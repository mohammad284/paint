<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class SubBusiness extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable = [
        // 'name',
        'business_id',
        'icon',
        'is_furnished'
    ];
    public $translatedAttributes = ['name'];
    public function icons()
    {
        return $this->belongsto('App\Models\Icon','icon','id');
    }
    public function business()
    {
        return $this->belongsto('App\Models\AllBusiness','business_id','id');
    }
    public function queations()
    {
        return $this->hasmany('App\Models\Question', 'sub_business', 'id');
    }
}
