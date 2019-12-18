<?php

namespace App\Http\Controllers\Backs\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backs\Products\ProductRequest;
use App\Repositories\Back\Products\ProductRepository;
use App\Services\GetSession;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $repository;
    public function __construct(ProductRepository $repository)
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
//        $user = Auth::user();
//        if($user->role == 'provider'){
            if(GetSession::getSessionProduct() != null)
            {
                return $this->edit(GetSession::getSessionProduct());
            }
//        }elseif($user->role == 'user') {
//            $food_places = $this->repository->getFoodPlace($user->id);
//            if(isset($food_places))
//            {
//                return redirect(route('food_places.edit',$food_places));
//            }
//        }
        return $this->create();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        GetSession::putSessionProduct(null);
        $categories = $this->repository->getAllCategory();
        $providers = $this->repository->getAllProviders();
        return  view('backs.products.basic_infos.create',compact(['categories','providers']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->only(['category_id','provider_id','name','quantity','price','description']);
        $result = $this->repository->createProduct($data);
        GetSession::putSessionProduct($result->id);
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
    public function edit($id)
    {
        $categories = $this->repository->getAllCategory();
        $providers = $this->repository->getAllProviders();
        $product = $this->repository->getProductById($id);
        GetSession::putSessionProduct($product->id);
        return  view('backs.products.basic_infos.edit',compact(['categories','providers','product']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->only(['category_id','provider_id','name','quantity','price','description']);
        $this->repository->updateProduct($id,$data);
        return redirect()->route('images.index');
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
}
