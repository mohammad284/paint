<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTender extends Model
{
    use HasFactory;
    protected $fillable = [
        'tender_id',
        'question_id',
    ];
    public function tender()
    {
        return $this->belongsto('App\Models\Tender','tender_id','id');
    }
    public function questions()
    {
        return $this->belongsto('App\Models\Question','question_id','id');
    }
    public function answers_tender()
    {
        return $this->hasMany('App\Models\AnswerTender','question_id','id');    
    }
}
