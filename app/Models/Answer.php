<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Answer extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable = [
        'question_id',
        'image',
        'trans'
    ];
    public $translatedAttributes = ['answer'];
    public function questions()
    {
        return $this->belongsTo('App\Models\Question', 'question_id', 'id');
    }
    public function question_tender()
    {
        return $this->belongsToMany('App\Models\QuestionTender', 'answer_tenders', 'question_tender_id','question_id');
    }

    public function icon()
    {
        return $this->belongsTo('App\Models\Icon', 'image', 'id');
    }
}
