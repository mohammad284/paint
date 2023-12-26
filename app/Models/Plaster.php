<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'tender_id',
        'plaster_type',// من الداشبورد
        'type', // 1: cornish , 2: decor 3: build wall , 4 : roof & wall
        'wall_width',    // عرض الجدار 
        'wall_hight',    // ارتفاع الجدار
        'cornish_type',  // 1:cork ,2:wood ,3 : plaster
        'cornish_width', // عرض الكورنيشة
        'cornish_hight', // ارتفاع الكورنيشة
        'text',          //اذا مو كورنيشة يدخل متل ما بدو

        'thickness', // سماكة الحيط في بناء الحيط
        'side', // 1: one side , 2: two side
        'insulator', // 1: yes , 0:no
        'with_door', //  1: yes , 0:no
        'with_windows', //  1: yes , 0:no
        'door_width',
        'door_hight',
        'window_width',
        'window_hight',
        'roof_or_wall', // 1:roof , 2: wall
        'distance_of_gypsum', // بعد الجبس عن السقف
        'with_decor',// 1:yes , 0:no
        'roof_hight',// ارتفاع السقف بالمتر
        'work_space'
    ];

    public function type_plaster()
    {
        return $this->belongsTo('App\Models\PlasterType', 'plaster_type', 'id');
    }
}
