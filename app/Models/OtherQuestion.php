<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherQuestion extends Model
{
    use HasFactory;
    public $fillable = [
        'icon',
        'input_type',
        'question_id'
    ];
    public function icon()
    {
        return $this->belongsTo('App\Models\Icon', 'icon', 'id');
    }
}
