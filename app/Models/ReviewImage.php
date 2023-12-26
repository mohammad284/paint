<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'review_id',
        'answer_id',
    ];
    
    public function review()
    {
        return $this->belongsTo('App\Models\Review','review_id','id');
    }
}
