<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floar extends Model
{
    use HasFactory;
    protected $fillable = [
        'tender_id',
        'height',
        'width',
        'old_status',
        'new_status',
        'old_color',
        'new_color',
        'damage',
        'type',// 0:none   1:corridor , 2: stairs
        'out_type'// 0: none , 1:garag , 2:stadium 3:stairs , 4 :street
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
    public function type()
    {
        return $this->belongsTo('App\Models\floarType', 'type', 'id');
    }
}
