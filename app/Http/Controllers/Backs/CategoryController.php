<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backs\Categories\CategoryRequest;
use App\Models\Category;
use App\Repositories\Back\CategoryRepository;
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
        return view('backs.category.index',compact('categories'));
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
//        dd($request);
        $data[] = [];
        $data['name'] = $request->name;
        $data['icon'] = $request->fileImage;
        $data['property'] = $request->Property;
        $this->repository->createOrUpdate($data);

        return redirect()->route('categories.index');
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
        $category = Category::with('propertyDefault')->find($id);
        return view('backs.category.edit',compact('category'));
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
        $data['name'] = $request->name;
        $data['icon'] = $request->fileImage;
        $data['property'] = $request->Property;
        $data['category_id'] = $id;
        $category = $this->repository->createOrUpdate($data);
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

    public function search(Request $request)
    {
        $key_search = $request->only('search');
        $categories = $this->repository->search($key_search);
        return view('backs.category.index',compact('categories'));
    }

    public function delete(Request $request)
    {
        $result = $this->repository->delete($request->id);
        if ($request->ajax())
        {
            return response()->json(['result'=>$result],200);
        }
        return redirect()->route('categories.index');
    }

    public function approved(Request $request)
    {
        $category_id = $request->id;
        $result = $this->repository->approved($category_id);
        if ($request->ajax())
        {
            return response()->json(['result'=>$result],200);
        }
        return redirect()->route('categories.index');
    }

    public function cancel(Request $request)
    {
        $category_id = $request->id;
        $result = $this->repository->cancel($category_id);
        if ($request->ajax())
        {
            return response()->json(['result'=>$result],200);
        }
        return redirect()->route('categories.index');
    }
}
