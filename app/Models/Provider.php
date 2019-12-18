<?php

namespace App\Models;

use App\Services\QueryServices\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use SoftDeletes,Filterable;

    protected $fillable =
        [
            'name', 'image', 'address', 'email', 'tel', 'website', 'status'
        ];

    protected $filterable = [
        'id',
        'address'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product','provider_id','id');
    }
//  scope
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
//
//    public function filterAddress($query, $value)
//    {
//        return $query->orwhere('address', $value);
//    }
//    public function filterEmail($query, $value)
//    {
//        return $query->where('email', 'LIKE', '%' . $value . '%');
//    }
//
//    public function filterTel($query, $value)
//    {
//        return $query->where('name', 'LIKE', '%' . $value . '%');
//    }
//
//    public function filterWebsite($query, $value)
//    {
//        return $query->where('name', 'LIKE', '%' . $value . '%');
//    }

    public function scopeActive($query)
    {
        return $query->orwhere('status', true);
    }
}
