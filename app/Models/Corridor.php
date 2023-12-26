<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corridor extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'old_status_paint',
        'old_status_paper',
        'old_status_paste',
        'old_status_plaster',
        'peeling_wallpaper',
        'new_status_paint',
        'new_status_paper',
        'new_status_paste',
        'new_status_plaster',
        'old_color',
        'new_color',
        'paper_type',
        'damage',
        'number_holes',
        'number_incisions',
        'corner_style' // 0:nothing , 1:acrylic 2:silicone ,
    ];
    public function room()
    {
        return $this->belongsTo('App\Models\Room', 'room_id', 'id');
    }
    public function newcolor()
    {
        return $this->belongsTo('App\Models\Color', 'new_color', 'id');
    }
    public function oldcolor()
    {
        return $this->belongsTo('App\Models\Color', 'old_color', 'id');
    }
    public function paper(){
        
        return $this->belongsTo('App\Models\PaperType', 'paper_type', 'id');
    }
}
