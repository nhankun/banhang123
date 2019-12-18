<?php

namespace App\Http\Controllers\Backs\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Back\Products\ManagerProductRepository;
use Illuminate\Http\Request;

class ManagerProductController extends Controller
{
    private $repository;

    public function __construct(ManagerProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $products = Product::paginate(10);
        return view('backs.products.index',compact('products'));
    }

    public function approved(Request $request)
    {
        $product_id = $request->id;
        $result = $this->repository->approved($product_id);
        if ($request->ajax())
        {
            return response()->json(['result'=>$result],200);
        }
        return redirect()->route('managerProduct.index');
    }

    public function cancel(Request $request)
    {
        $product_id = $request->id;
        $result = $this->repository->cancel($product_id);
        if ($request->ajax())
        {
            return response()->json(['result'=>$result],200);
        }
        return redirect()->route('managerProduct.index');
    }
}
