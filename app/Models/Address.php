<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'objectId',
        'Postal_Code',
        'CountryCode',
        'Place_Name',
        'ACL',
        'Latitude',
        'updatedAt',
        'Longitude',
        'Admin_Code2',
        'Admin_Code3',
        'Admin_Name2',
        'Admin_Name3',
        'Accuracy',
        'createdAt',
        'Admin_Name',
        'Admin_Code'
    ];
    public function user()
    {
        return $this->hasMany('App\Models\User','postal_code','id');
    }
    public function tender()
    {
        return $this->hasMany('App\Models\User','postal_code','id');
    }
}
