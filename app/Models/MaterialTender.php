<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialTender extends Model
{
    use HasFactory;
    protected $fillable = [
        'tender_id',
        'material_id'
    ];
}
