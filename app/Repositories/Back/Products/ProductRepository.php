<?php

namespace App\Repositories\Back\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;

class ProductRepository
{
    public function getProductById($id)
    {
        return Product::findOrFail($id);
    }

    public function createProduct($data)
    {
        return Product::create($data);
    }

    public function updateProduct($id,$data)
    {
        $product = self::getProductById($id);
        return $product->update($data);
    }

    public function getAllCategory()
    {
        return Category::where('status',1)->get(['id','name']);
    }

    public function getAllProviders()
    {
        return Provider::where('status',1)->get(['id','name']);
    }
}
