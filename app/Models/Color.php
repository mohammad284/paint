<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'name_gr',
        'lab',
        'hex',
        'rgb',
        'cmyk'
    ];
    public function degree()
    {
        return $this->hasMany('App\Models\ColorShade','color_id','id');
    }
    public function tenderOld()
    {
        return $this->hasone('App\Models\Tender','old_color','id');
    }
    public function tenderNew()
    {
        return $this->hasMany('App\Models\Tender','new_color','id');
    }
    public function wallold()
    {
        return $this->hasone('App\Models\Wall','old_color','id');
    }
    public function wallnew()
    {
        return $this->hasMany('App\Models\Wall','new_color','id');
    }
    public function roofold()
    {
        return $this->hasone('App\Models\Wall','Roof','id');
    }
    public function roofnew()
    {
        return $this->hasMany('App\Models\Wall','Roof','id');
    }
    public function floarold()
    {
        return $this->hasone('App\Models\Floar','old_color','id');
    }
    public function floarnew()
    {
        return $this->hasMany('App\Models\Floar','new_color','id');
    }
    public function doorold()
    {
        return $this->hasone('App\Models\Door','old_color','id');
    }
    public function doornew()
    {
        return $this->hasMany('App\Models\Door','new_color','id');
    }
    public function floor()
    {
        return $this->hasone('App\Models\BuildFloor','color','id');
    }
    public function product_Color()
    {
        return $this->hasone('App\Models\Product','color_id','id');
    }
}
