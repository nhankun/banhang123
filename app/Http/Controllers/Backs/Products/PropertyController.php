<?php

namespace App\Http\Controllers\Backs\Products;

use App\Http\Controllers\Controller;
use App\Repositories\Back\Products\PropertyRepository;
use App\Services\GetSession;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    private $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_id = GetSession::getSessionProduct();
        $property = $this->repository->getPropertyByProductId($product_id);
        if ($property){
            return $this->editByProduct($product_id);
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
        $product_id = GetSession::getSessionProduct();
        $propertyDefaults = $this->repository->getPropertyDefaultByCategory(1);
        return view('backs.products.properties.create',compact('propertyDefaults'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_id = GetSession::getSessionProduct();
        $properties = $this->repository->createOrUpdateProperties($request->Property,$product_id);
        return redirect()->route('managerProduct.index');
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

    }

    public function editByProduct($product_id)
    {
        $properties = $this->repository->getAllPropertyByProductId($product_id);
        if ($properties != false){
            return view('backs.products.properties.edit',compact('properties'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    public function updateByProduct(Request $request,$product_id)
    {
        $properties = $this->repository->createOrUpdateProperties($request->Property,$product_id);
        return redirect()->route('managerProduct.index');
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

    public function delete(Request $request)
    {
        return $this->repository->deleteProperty($request->id);
    }
}
