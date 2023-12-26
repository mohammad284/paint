<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tender;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Models\BranshWork;
class TypeWork extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable = [
        'ar_id',
    ];
    public $translatedAttributes = ['type_of_work'];

    public function tender()
    {
        return $this->hasMany('App\Models\Tender','type_of_work','id');
    }
    public function bransh_work()
    {
        return $this->hasMany('App\Models\BranshWork','work_id','id');
    }
    public function Bransh()
    {
        return $this->belongsToMany('App\Models\BranshWork', 'bransh_types', 'type_id','bransh_id');
    }
    // public function Bransh()
    // {
    //     return $this->belongsToMany(BranshWork::class, 'BranshType');
    // }
}
