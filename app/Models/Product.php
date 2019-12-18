<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'provider_id', 'name', 'quantity', 'price', 'description', 'status'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Image','product_id','id');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\Provider','provider_id','id');
    }

    public function property()
    {
        return $this->hasOne('App\Models\Property','product_id','id');
    }

    public function active()
    {
        $this->status = true;
        return $this->save();
    }
    public function cancel()
    {
        $this->status = false;
        return $this->save();
    }

    //scope
    public function scopeActived()
    {
        return $this->where('status',true);
    }

//    public function orderDetails()
//    {
//        return $this->hasMany('App\Model\OrderDetail','product_id','id');
//    }
}
