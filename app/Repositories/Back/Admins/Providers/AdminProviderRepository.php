<?php

namespace App\Repositories\Back\Admins\Providers;

use App\Models\Provider;

class AdminProviderRepository
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

    public function getProviderById($id)
    {
        return Provider::findOrFail($id);
    }

    public function delete($id)
    {
        $provider = $this->getProviderById($id);
        return $provider->delete();
    }

    public function approved($provider_id)
    {
        $provider = Provider::findOrFail($provider_id);
        return $provider->active();
    }

    public function cancel($provider_id)
    {
        $provider = Provider::findOrFail($provider_id);
        return $provider->cancel();
    }
}
