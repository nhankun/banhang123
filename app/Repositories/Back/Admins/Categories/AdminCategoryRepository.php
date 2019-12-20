<?php

namespace App\Repositories\Back\Admins\Categories;

use App\Models\Category;

class AdminCategoryRepository
{
    public function getAll($nbrPages, $parameters)
    {
        return Category::when(($parameters['search'] != ''),function ($query) use ($parameters) {
            $query->where(function ($q) use ($parameters){
                $q->where('name','like','%'.$parameters['search'].'%')
                    ->orwhere('id','=',$parameters['search']);
            });
        })->paginate($nbrPages);
    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }

    public function delete($id)
    {
        $category = $this->getCategoryById($id);
        return $category->delete();
    }

    public function approved($category_id)
    {
        $category = Category::findOrFail($category_id);
        return $category->active();
    }

    public function cancel($category_id)
    {
        $category = Category::findOrFail($category_id);
        return $category->cancel();
    }
}
