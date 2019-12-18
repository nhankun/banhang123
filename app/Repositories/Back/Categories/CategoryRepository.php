<?php

namespace App\Repositories\Back\Categories;

use App\Models\Category;
use App\Models\PropertyDefault;
use App\Services\Uploads\handleUploadImage;
use Image;
use File;


class CategoryRepository
{
    use handleUploadImage;
    CONST WIDTH_IMG = 120;
    CONST HEIGHT_IMG = 90;
    CONST FIRST_NAME = 'icon';

    public function getAll()
    {
        return Category::paginate(10);
    }

    public function createCategory($data)
    {
        $category = Category::create([
            'name' => $data['name'],
            'status' => false
        ]);
        self::updateImage($data, $category);
        dd($data['Property']);
        isset($data['Property']) ? $this->createOrUpdateProperty($data['Property'], $category) : '';
        return $category;
    }

    public function updateCategory($data)
    {
        $category = self::getCategoryById($data['category_id']);
        $category->update([
            'name' => $data['name'],
            'status' => false
        ]);
        self::updateImage($data, $category);
        isset($data['Property']) ? $this->createOrUpdateProperty($data['Property'], $category) : '';
        return $category;
    }

    public function createOrUpdateProperty($property, $category)
    {
        foreach ($property as $key => $value) {
            if (strpos($key, 'new') !== false) {
                PropertyDefault::create([
                    'category_id' => $category->id,
                    'name' => $value['property_name'],
                    'value' => $value['property_value'],
                    'sort' => 1,
                ]);
            } else {
                $property = PropertyDefault::find($key);
                $property->update([
                    'category_id' => $category->id,
                    'name' => $value['property_name'],
                    'value' => $value['property_value'],
                    'sort' => 1,
                ]);
            }
        }
    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }

    public function updateImage($data, $category)
    {
        $dir = 'uploads/categories/' . $category->id . '/icon/';
        $icon = isset($data['fileImage']) ? $data['fileImage'] : null;
        $fileLink = $this->handleUploadImage($icon, self::FIRST_NAME, $dir, self::WIDTH_IMG, self::HEIGHT_IMG);
//        dd($file_link);
        if (!is_null($fileLink)) {
            @unlink($category->icon);
            $category->update(['icon' => $fileLink]);
        }

    }

    public function delete($category_id)
    {
        $category = Category::findOrFail($category_id);
        $propertyDefaults = PropertyDefault::where('category_id', $category->id)->get('id');
        self::deletePropertiesDefaults($propertyDefaults->toArray());
        return $category->delete();
    }

    public function deletePropertiesDefaults($arr_id)
    {
        return PropertyDefault::destroy($arr_id);
    }

    public function deletePropertyDefault($id)
    {
        $propertyDefault = PropertyDefault::findOrFail($id);
        return $propertyDefault->delete();
    }

    public function approved($category_id)
    {
        $category = Category::findOrFail($category_id);
        $category->status = true;
        return $category->save();
    }

    public function cancel($category_id)
    {
        $category = Category::findOrFail($category_id);
        $category->status = false;
        return $category->save();
    }

    public function search($keySearch)
    {
        if (!is_null($keySearch)) {
            $param = ["id" => $keySearch['search'], "name" => $keySearch['search']];
            return Category::filter($param)->paginate(4);
        }
        return Category::paginate(4);
    }


//    public function upload($category_id, $image)
//    {
//        if (!is_null($image)) {
//            $dir = 'uploads/categories/' . $category_id . '/icon/';
//            $extension = $image->getClientOriginalExtension();
//            $fileName = 'icon' . time() . '.' . $extension;
//            $fileLink = $dir . $fileName;
//            if (!File::exists($dir)) {
//                mkdir($dir, 666, true);
//            }
//            Image::make($image->getRealPath())->resize(90, 60)->save($dir . $fileName);
//            return $fileLink;
//        }
//    }
}
