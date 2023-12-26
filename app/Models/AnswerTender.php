<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerTender extends Model
{
    use HasFactory;
    protected $fillable =[
        'answer',
        'question_id'
    ];

    public function answers_tender()
    {
        return $this->hasMany('App\Models\AnswerTender','question_id','id');    
    }

}
