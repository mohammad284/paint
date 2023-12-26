<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Glossy extends Model
{
    use HasFactory;
    protected $fillable = [
        'tender_id',
        'type', // 1: windows , 2:door , 3:machinery , 4:heavy_equipment , 5:other
        'old_status_paint',
        'old_status_paste',
        'peeling_wallpaper',//  0: no,1:yes  تقشير الحالة القديمة
        'new_status_paint',
        'new_status_paste',
        'old_color',
        'new_color',
        'damage',
        'count',
        'paint_place',//1:out , 2: in ,3:both or null
    ];
    public function tender()
    {
        return $this->belongsTo('App\Models\Tender', 'tender_id', 'id');
    }
    public function newcolor()
    {
        return $this->belongsTo('App\Models\Color', 'new_color', 'id');
    }
    public function oldcolor()
    {
        return $this->belongsTo('App\Models\Color', 'old_color', 'id');
    }
}
