<?php

namespace App\Http\Controllers\Backs\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backs\Categories\CategoryRequest;
use App\Models\Category;
use App\Repositories\Back\Categories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $repository;

    public function __construct(CategoryRepository $repository)
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
        $categories = $this->repository->getAll();
        if ($categories->count() <=0 ){
            return $this->create();
        }
        return redirect()->route('managerCategories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backs.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data[] = [];
        $data = $request->all();
        $category = $this->repository->createCategory($data);
        return redirect()->route('categories.edit',$category->id);
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
        $category = Category::find($id);
        $propertyDefaults = json_decode($category->property_defaults);
        return view('backs.category.edit',compact(['category','propertyDefaults']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $data[] = [];
        $data = array_merge($request->all(),['category_id' => $id]);
        $category = $this->repository->updateCategory($data);
        return redirect()->back()->with('category',$category);
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

//    public function search(Request $request)
//    {
//        $keySearch = $request->only('search');
//        $categories = $this->repository->search($keySearch);
//        return view('backs.category.index',compact('categories'));
//    }

}
