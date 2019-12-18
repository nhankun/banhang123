<?php

namespace App\Models;

use App\Services\QueryServices\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes,Filterable;

    protected $fillable = [
        'name','icon' ,'status'
    ];

    protected $filterable = [
        'id'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product','category_id','id');
    }

    public function propertyDefaults()
    {
        return $this->hasMany('App\Models\PropertyDefault','category_id','id');
    }

    //scope
    public function scopeActived()
    {
        return $this->where('status',true);
    }
    //function
//

    public function filterName($query, $value)
    {
        return $query->orwhere('name', 'LIKE', '%' . $value . '%');
    }
}
