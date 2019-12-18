<?php

namespace App\Repositories\Back\Products;

use App\Models\Product;
use App\Models\Property;

class PropertyRepository
{
    public function getPropertyByProductId($product_id)
    {
        return Property::where('product_id',$product_id)->first();
    }
    public function getAllPropertyByProductId($product_id)
    {
        $properties =  Property::where('product_id',$product_id)->get();
        if ($properties->count() > 0){
            return $properties;
        }else{
            return false;
        }
    }
//    lấy product theo id
    public function getProductById($id)
    {
        return Product::with('category')->find($id);
    }
    public function getPropertyById($id)
    {
        return Property::findOrFail($id);
    }
//  lấy thuộc tính mặc định theo loại của product hiện tại
    public function getPropertyDefaultByCategory($product_id)
    {
        $properties = $this->getProductById($product_id)->category->propertyDefaults;
        return $properties;
    }

    public function createOrUpdateProperties($credentials, $product_id)
    {
        $product = $this->getProductById($product_id);
        foreach ($credentials as $key => $value) {
            if (strpos($key, 'new') !== false) {
                Property::create([
                    'product_id' => $product->id,
                    'name' => $value['property_name'],
                    'value' => $value['property_value'],
                    'sort' => 1,
                ]);
            } else {
                $property = Property::find($key);
                $property->update([
                    'product_id' => $product->id,
                    'name' => $value['property_name'],
                    'value' => $value['property_value'],
                    'sort' => 1,
                ]);
            }
        }
    }

    public function deleteProperty($id)
    {
        $property = $this->getPropertyById($id);
        return $property->delete();
    }
}
