<?php
namespace App\Repositories\Back;

use App\Models\Provider;
use Image;
use File;


class ProviderRepository {

    public function getAll()
    {
        return Provider::paginate(4);
    }

    public function getFirst()
    {
        return Provider::first();
    }

    public function getProviderById($id)
    {
        return Provider::findOrFail($id);
    }

    public function create($request)
    {
        $data = $request->all();
        $data['status'] = false;
        $provider = Provider::create($data);
        if ($request->hasFile('fileImage')) {
            $file = $request->fileImage;
            if ($this->validationImage($file)) {
                $data['image'] = $this->upload($provider->id, $file);
            }else{
                $data['image'] = 'uploads/defaults/providers/images/dfp.png';
            }
        }else{
            $data['image'] = 'uploads/defaults/providers/images/dfp.png';
        }
        $provider->update(['image' => $data['image']]);
        return $provider;
    }

    public function update($request, $id)
    {
        $provider = Provider::find($id);
        $data = $request->all();
        if ($request->hasFile('fileImage')) {
            $file = $request->fileImage;
            if ($this->validationImage($file)){
                $data['image'] = $this->upload($provider->id,$file);
                @unlink($provider->image);
            }
        }
        $provider->update($data);
        return $provider;
    }

    public function delete($request)
    {
        $provider = Provider::findOrFail($request->id);
        return $provider->delete();
    }

    public function upload($provider_id,$image)
    {
        $dir = 'uploads/providers/' . $provider_id . '/avatar/';
        $extension = $image->getClientOriginalExtension();
        $file_name = 'image' . time() . '.' . $extension;
        $file_link = $dir . $file_name;
        if (!File::exists($dir)) {
            mkdir($dir, 666, true);
        }
        Image::make($image->getRealPath())->resize(110, 43)->save($dir . $file_name);
        return $file_link;

    }

    public function search($key_search)
    {
        $param = ["id"=>$key_search['search'],"name"=>$key_search['search'],"address" => $key_search['search']];
        return Provider::filter($param)->paginate(4);
    }

    public function approved($provider_id)
    {
        $provider = Provider::findOrFail($provider_id);
        $provider->status = true;
        return $provider->save();
    }

    public function cancel($provider_id)
    {
        $provider = Provider::findOrFail($provider_id);
        $provider->status = false;
        return $provider->save();
    }

    public function validationImage($file)
    {
        $validate = ['jpg','png','jpeg'];
        $extension = $file->getClientOriginalExtension();
        return in_array($extension,$validate);
    }
}
