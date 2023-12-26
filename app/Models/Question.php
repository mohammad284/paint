<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Question extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable = [
        'question',
        'sub_business',
        'type',
        'input_type',
        'required' ,
        'enable'       
    ];
    public $translatedAttributes = ['question'];
    public function sub_businesses()
    {
        return $this->belongsto('App\Models\SubBusiness', 'sub_business', 'id');
    }
    public function other_answer()
    {
        return $this->hasone('App\Models\OtherQuestion', 'question_id', 'id');
    }
    public function answers()
    {
        return $this->hasMany('App\Models\Answer', 'question_id', 'id');
    }
    public function typeQues()
    {
        return $this->belongsto('App\Models\QuestionType', 'type', 'id');
    }
}
