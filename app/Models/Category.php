<?php

namespace App\Models;

use App\Services\QueryServices\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes,Filterable;

    protected $fillable = [
        'name','icon' ,'property_defaults' ,'status'
    ];

    protected $filterable = [
        'id'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product','category_id','id');
    }

    //function
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
    //function
//

    public function filterName($query, $value)
    {
        return $query->orwhere('name', 'LIKE', '%' . $value . '%');
    }
}
