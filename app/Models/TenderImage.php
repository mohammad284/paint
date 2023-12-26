<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tender;
class TenderImage extends Model
{
    use HasFactory;
    protected $fillable = ['tender_id','image','file'];


    public function tenders()
    {
        return $this->belongsTo('App\Models\Tender', 'tender_id', 'id');
    }
}
