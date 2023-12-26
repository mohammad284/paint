<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class AllBusiness extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable =[
        'icon'
    ];
    public $translatedAttributes = ['name'];
    
    public function icons()
    {
        return $this->belongsto('App\Models\Icon','icon','id');
    }

    public function sub_business()
    {
        return $this->hasMany('App\Models\SubBusiness','business_id','id');
    }
    public function subs()
    {
        return $this->hasMany('App\Models\BusinessSub','business_id','id');
    }
}
