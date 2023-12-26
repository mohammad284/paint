<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stair extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'old_color',
        'new_color',
        'damage',
        'height'
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
