<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edge extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'area',
        'old_status',
        'new_status',
        'damage',
        'unit'
    ];
    public function room()
    {
        return $this->belongsTo('App\Models\Room', 'room_id', 'id');
    }
    
}
