<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Models\TypeWork;
class BranshWork extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable = ['work_id'];
    public $translatedAttributes = ['name'];
    

    // public function work()
    // {
    //     return $this->belongsTo('App\Models\TypeWork', 'work_id', 'id');
    // }
    // public function type()
    // {
    //     return $this->belongsToMany('App\Models\TypeWork', 'work_id', 'id');
    // }
    public function type()
    {
        return $this->belongsToMany('App\Models\TypeWork', 'bransh_types', 'bransh_id','type_id');
    }

}
