<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id', 'name', 'value', 'sort'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
