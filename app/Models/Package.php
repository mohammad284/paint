<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'price',
        'name'
    ];

    public function user()
    {
        return $this->hasMany('App\Models\user','package_id','id');
    }
}
