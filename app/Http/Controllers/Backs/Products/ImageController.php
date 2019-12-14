<?php

namespace App\Http\Controllers\Backs\Products;

use App\Http\Controllers\Controller;
use App\Repositories\Back\Products\ImageRepository;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    private $repository;

    public function __construct(ImageRepository $repository)
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
        $product_id = 1;
        $images = $this->repository->getImageByProductId($product_id);
        if ($images){
            return $this->edit($product_id);
        }else{
            $this->create();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backs.products.images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->fileImages);
        $product_id = 1;
        $product = $this->repository->getProductById($product_id);
        $image = $this->repository->createImages($request->fileImages,$product);
        return redirect()->route('images.index');
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
    public function edit($product_id)
    {
        $images = $this->repository->getImageByProductId($product_id);
        return view('backs.products.images.edit',compact('images'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function delete(Request $request,$id)
    {
        if ($request->ajax()){
            $image = $this->repository->delete($request->id);
            return 'ok';
        }
    }
}
