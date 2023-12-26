<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RoomImage;
class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',//1:salon , 2:room , 3:bath,4:kitchen , 5:corridor , 6:stairs
        'furnished', // 0: no , 1:yes
        'tender_id',
    ];


    public function tender()
    {
        return $this->belongsTo('App\Models\Tender', 'tender_id', 'id');
    }
    public function walls()
    {
        return $this->hasMany('App\Models\Wall','room_id','id');
    }
    public function windows()
    {
        return $this->hasMany('App\Models\Window','room_id','id');
    }
    public function roofs()
    {
        return $this->hasMany('App\Models\Roof','room_id','id');
    }
    public function doors()
    {
        return $this->hasMany('App\Models\Door','room_id','id');
    }
    public function edges()
    {
        return $this->hasMany('App\Models\Edge','room_id','id');
    }
    public function corridors()
    {
        return $this->hasMany('App\Models\Corridor','room_id','id');
    }
    public function stairs()
    {
        return $this->hasMany('App\Models\Stair','room_id','id');
    }
}
