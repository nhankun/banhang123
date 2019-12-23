<?php

namespace App\Repositories\Back\Managers\Providers;

use App\Models\Provider;

class ManagerProviderRepository
{
    public function getAll($nbrPages, $parameters)
    {
        return Provider::when(($parameters['search'] != ''),function ($query) use ($parameters) {
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
            return Provider::filter($param)->paginate($nbrPages);
        }
        return Provider::paginate($nbrPages);
    }

    public function getCategoryById($id)
    {
        return Provider::findOrFail($id);
    }

    public function delete($id)
    {
        $provider = $this->getCategoryById($id);
        return $provider->delete();
    }
}
