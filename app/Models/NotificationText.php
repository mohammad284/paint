<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationText extends Model
{
    use HasFactory;
    protected $fillable = ['not_en','not_gr','type'];
}
