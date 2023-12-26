<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    protected $fillable = ['size'];

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'size_id', 'id');
    }
}
