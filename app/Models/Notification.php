<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Notification extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable = ['sender','reciver','status','from','admin_read','payload','type'];
    public $translatedAttributes = ['notification'];

    public function send()
    {
        return $this->belongsTo('App\Models\User','sender','id');
    }
    public function recive()
    {
        return $this->belongsTo('App\Models\User','reciver','id');
    }
    public function tender()
    {
        return $this->belongsTo('App\Models\Tender','payload','id');
    }
}
