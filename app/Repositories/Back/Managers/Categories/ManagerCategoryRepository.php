<?php

namespace App\Repositories\Back\Managers;

use App\Models\Category;

class ManagerCategoryRepository
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

    public function search($nbrPages,$parameters)
    {
        if (!is_null($parameters)) {
            $param = ["id" => $parameters['search'], "name" => $parameters['search']];
            return Category::filter($param)->paginate($nbrPages);
        }
        return Category::paginate($nbrPages);
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
}
