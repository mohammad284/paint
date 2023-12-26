<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Door extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'old_status_paint',
        'old_status_paste',
        'peeling_wallpaper',//  0: no,1:yes  تقشير الحالة القديمة
        'new_status_paint',
        'new_status_paste',
        'old_color',
        'new_color',
        'glossy',
        'damage'
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
}
