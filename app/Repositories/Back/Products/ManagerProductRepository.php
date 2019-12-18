<?php

namespace App\Repositories\Back\Products;

use App\Models\Product;

class ManagerProductRepository
{

    public function approved($product_id)
    {
        $result = Product::findOrFail($product_id);
        return $result->active();
    }

    public function cancel($product_id)
    {
        $result = Product::findOrFail($product_id);
        return $result->cancel();
    }

    public function search($keySearch)
    {
        if (!is_null($keySearch)) {
            $param = ["id" => $keySearch['search'], "name" => $keySearch['search']];
            return Category::filter($param)->paginate(4);
        }
        return Category::paginate(4);
    }

}
