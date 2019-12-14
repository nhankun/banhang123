<?php

namespace App\Http\Controllers\Backs\Providers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backs\Providers\ProviderRequest;
use App\Repositories\Back\Providers\ProviderRepository;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    private $repository;

    public function __construct(ProviderRepository $providerRepository)
    {
        $this->repository = $providerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provider = $this->repository->getFirst();
        if (!isset($provider) == false)
        {
            $providers = $this->repository->getAll();
            return view('backs.provider.index',compact('providers'));
        }else{
            return $this->create();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backs.provider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderRequest $request)
    {
        $this->repository->create($request);
        return redirect()->route('providers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provider = $this->repository->getProviderById($id);
        return view('backs.provider.edit',compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderRequest $request, $id)
    {
        $provider = $this->repository->update($request,$id);
        return redirect()->route('providers.index');
    }

    public function delete(Request $request)
    {
        $result = $this->repository->delete($request);
        if($request->ajax()){
            return response()->json(['result'=>$result]);
        }
        return redirect()->back()->with('success', 'Delete successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $key_search = $request->only('search');
        return view('backs.provider.index',compact('providers'));
    }

    public function approved(Request $request)
    {
        $provider_id = $request->id;
        $result = $this->repository->approved($provider_id);
        if ($request->ajax())
        {
            return Response()->json(['result'=>$result],200);
        }
        return redirect()->route('providers.index');
    }

    public function cancel(Request $request)
    {
        $provider_id = $request->id;
        $result = $this->repository->cancel($provider_id);
        if ($request->ajax())
        {
            return Response()->json(['result'=>$result],200);
        }
        return redirect()->route('providers.index');
    }

}
