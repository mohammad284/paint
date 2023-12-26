<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Product extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable = [
    'category_id',
    'company_name',
    'amount',//كمية الطلبية
    'color_id',
    'store_id',
    'Selling_price',//سعر المستهلك
    'buying_price',//سعر الشراء من المصنع
    'size_id',//قياس الغالونات
    'special', // للتثبيت الاكثر مبيعا
    'rate',
    'best_seller'
    ];
    public $translatedAttributes = ['name'];
    public function product_color(){
        return $this->belongsTo('App\Models\Color', 'color_id', 'id');
    }

    public function product_size(){
        return $this->belongsTo('App\Models\ProductSize', 'size_id', 'id');
    }

    public function product_category(){
        return $this->belongsTo('App\Models\ProductCategory', 'category_id', 'id');
    }

    public function best_seller()
    {
        return $this->hasOne('App\Models\BestSeller', 'product_id', 'id');
    }
    public function cart()
    {
        return $this->hasMany('App\Models\Cart', 'product_id', 'id')->where('status','done');
    }
    public function favorite()
    {
        return $this->hasMany('App\Models\Favorite', 'product_id', 'id');
    }
    public function product_image()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'id');
    }
    public function product_reviews()
    {
        return $this->hasMany('App\Models\ProductReview', 'product_id', 'id');
    }
}
