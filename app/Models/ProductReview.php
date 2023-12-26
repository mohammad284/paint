<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','user_id','rate','comment'];


    public function product_review()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
