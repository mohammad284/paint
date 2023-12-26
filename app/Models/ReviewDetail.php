<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'review_id',
        'rate'
    ];

    public function review()
    {
        return $this->belongsTo('App\Models\Review','review_id','id');
    }
}
