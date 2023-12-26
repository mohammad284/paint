<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreOrder extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','serial_number','payment_method','total_price',
    'status',// 1:received ,,,, 2:prepared ,,,,3:delivered to the shipping company ,,,,4: Delivered ,5:rejected
    'reason_rejected'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Cart', 'order_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function payment()
    {
        return $this->belongsTo('App\Models\PaymentMethod', 'payment_method', 'id');
    }
}
