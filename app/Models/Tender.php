<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TenderImage;
use App\Models\TypeWork;
class Tender extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'inside', 
        'space_unit',
        'hight_unit',
        'status',
        'height',
        'text',
        'space',
        'price',
        'type_of_work',
        'specifec',
        'postal_code',
        'title',
        'note',
        'expected_date',//
        'service_id',
        'building_type',
        'floar_type',
        'old_color',
        'new_color',
        'house_access',
        'status_building',
        'wall_damage',
        'add_surface',
        'scaffolding', 
        'plaster', 
        'material_required',
        'category', 
        'facade_building',
        'num_of_floors',
        'num_of_rooms',
        'furnished',
        'house_type',
        'num_floor',
        'garage',
        'main_business',
        'sub_business', 
        'work_license',
        'materials',
        'basic_tender',
        'is_update',
        'title_loc',
        'Lowest_price',//اقل سعر حصل عليه خارج التطبيق 
        'min_budjet',
        'max_budjet'
    ];

    public function tender_type()
    {
        return $this->belongsTo('App\Models\AllBusiness','main_business','id');
    }
    public function business_type()
    {
        return $this->belongsTo('App\Models\SubBusiness','sub_business','id');
    }
    public function questions_tender()
    {
        return $this->hasMany('App\Models\QuestionTender','tender_id','id');
    }


    public function flour_tender()
    {
        return $this->hasMany('App\Models\Floar','tender_id','id');
    }
    public function glossy()
    {
        return $this->hasMany('App\Models\Glossy','tender_id','id');
    }
    public function plaster_tender()
    {
        return $this->hasMany('App\Models\Plaster','tender_id','id');
    }
    public function postal()
    {
        return $this->belongsTo('App\Models\Address', 'postal_code', 'id');
    }
    public function providerInterest()
    {
        return $this->belongsTo('App\Models\User', 'specifec', 'id');
    }
    public function building_floors()
    {
        return $this->hasMany('App\Models\BuildFloor','tender_id','id');
    }
    public function newcolor()
    {
        return $this->belongsTo('App\Models\Color', 'new_color', 'id');
    }
    public function oldcolor()
    {
        return $this->belongsTo('App\Models\Color', 'old_color', 'id');
    }
    public function tenderImage(){

        return $this->hasMany('App\Models\TenderImage', 'tender_id', 'id');
    }
    public function payment(){

        return $this->hasOne('App\Models\Payment', 'tender_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function rooms()
    {
        return $this->hasMany('App\Models\Room','tender_id','id');
    }
    public function type_work()
    {
        return $this->belongsTo('App\Models\TypeWork', 'type_of_work', 'id');
    }
    public function building_type()
    {
        return $this->belongsTo('App\Models\BuildingType', 'building_type', 'id');
    }
    public function interested()
    {
        return $this->hasMany('App\Models\TenderInterested','tender_id','id');
    }
    public function connect()
    {
        return $this->hasMany('App\Models\TenderInterested','tender_id','id')->where('status','connected');
    }
    public function conversation()
    {
        return $this->hasOne('App\Models\Conversation', 'tender_id', 'id');
    }
    public function chat()
    {
        return $this->hasMany('App\Models\Chat', 'tender_id', 'id');
    }
    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'service_id', 'id');
    }
    public function floar()
    {
        return $this->belongsTo('App\Models\floarType', 'floar_type', 'id');
    }
    public function building()
    {
        return $this->belongsTo('App\Models\BuildingType', 'building_type', 'id');
    }
    public function out_wall()
    {
        return $this->hasMany('App\Models\OutsideWall','tender_id','id');
    }
    public function categories(){

        return $this->belongsTo('App\Models\CategoryType', 'category', 'id');
    }
    public function tender_read()
    {
        return $this->hasMany('App\Models\TenderRead', 'tender_id', 'id');
    }
    public function destance(){
        return $this->hasOne('App\Models\Distance', 'tender_id', 'id');
    }
}
