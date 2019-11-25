<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyDefault extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'name','value', 'sort'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }
}
