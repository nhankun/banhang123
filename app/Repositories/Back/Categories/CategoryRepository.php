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
            'property_defaults' => isset($data['Property']) ? json_encode($data['Property']) : null,
            'status' => false
        ]);
        self::updateImage($data, $category);
        return $category;
    }

    public function updateCategory($data)
    {
        $category = self::getCategoryById($data['category_id']);
        $category->update([
            'name' => $data['name'],
            'property_defaults' => isset($data['Property']) ? json_encode($data['Property']) : null,
            'status' => false
        ]);
        self::updateImage($data, $category);
        return $category;
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

//    public function search($keySearch)
//    {
//        if (!is_null($keySearch)) {
//            $param = ["id" => $keySearch['search'], "name" => $keySearch['search']];
//            return Category::filter($param)->paginate(4);
//        }
//        return Category::paginate(4);
//    }


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
