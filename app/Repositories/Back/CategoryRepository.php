<?php

namespace App\Repositories\Back;

use App\Models\Category;
use App\Models\PropertyDefault;
use Image;
use File;


class CategoryRepository
{

    public function getAll()
    {
        return Category::paginate(5);
    }

    public function createOrUpdate($data)
    {
        if (isset($data['category_id'])) {
            $category = Category::find($data['category_id']);
            $category->update([
                'name' => $data['name'],
                'status' => false
            ]);
            if (is_null($data['icon']) != true) {
                @unlink($category->icon);
                $file_link = $this->upload($category->id, $data['icon']);
                $category->update(['icon' => $file_link]);
            }
            $this->createproperty($data['property'],$category);
        } else {
            $category = Category::create([
                'name' => $data['name'],
                'status' => false
            ]);
            $file_link = $this->upload($category->id, $data['icon']);
            $category->update(['icon' => $file_link]);
            $this->createproperty($data['property'],$category);
        }
        return $category;
    }

    public function createproperty($property,$category)
    {
        if (is_null($property) != true) {
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
    }

    public function upload($category_id, $image)
    {
        if (is_null($image) != true) {
            $dir = 'uploads/categories/' . $category_id . '/icon/';
            $extension = $image->getClientOriginalExtension();
            $file_name = 'icon' . time() . '.' . $extension;
            $file_link = $dir . $file_name;
            if (!File::exists($dir)) {
                mkdir($dir, 666, true);
            }
            Image::make($image->getRealPath())->resize(90, 60)->save($dir . $file_name);
            return $file_link;
        }
    }

    public function delete($category_id)
    {
        $category = Category::findOrFail($category_id);
        $property_defaults = PropertyDefault::where('category_id',$category->id)->get('id');
        PropertyDefault::destroy($property_defaults->toArray());
        return $category->delete();
    }

    public function deletePropertyDefault($id)
    {
        $property_default = PropertyDefault::findOrFail($id);
        return $property_default->delete();
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

    public function search($key_search)
    {
        if (is_null($key_search) != true) {
            $param = ["id" => $key_search['search'], "name" => $key_search['search']];
            return Category::filter($param)->paginate(4);
        }
        return Category::paginate(4);
    }
}
