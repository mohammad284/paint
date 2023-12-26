<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildFloor extends Model
{
    use HasFactory;
    protected $fillable = [
        'num_of_rooms',
        'color',
        'num_of_walls',
        'area',
        'unit',
        'tender_id',
        'out_area',
        'num_of_roofs',
        'num_of_baths',
        'num_of_corridor',
        'num_of_stairs',
        'num_of_kitchen',
        'num_of_doors',
        'num_of_windows',
        'new_status_paint',
        'new_status_paste',
        'new_status_base',
        'shave',
    ];

    public function tender()
    {
        return $this->belongsTo('App\Models\Tender', 'tender_id', 'id');
    }
    public function colors()
    {
        return $this->belongsTo('App\Models\Color', 'color', 'id');
    }
}
