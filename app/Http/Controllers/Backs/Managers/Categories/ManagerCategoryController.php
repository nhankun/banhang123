<?php

namespace App\Http\Controllers\Backs\Managers\Categories;

use App\Http\Controllers\Controller;
use App\Repositories\Back\Managers\ManagerCategoryRepository;
use App\Services\Indexable;
use Illuminate\Http\Request;

class ManagerCategoryController extends Controller
{
    use Indexable;

    private $repository;
    private $table = 'categories';

    public function __construct(ManagerCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $parameters = $this->getParameters($request);
        $records = $this->repository->getAll(config('app.nbrPages.back.categories'),$parameters);

        $links = $records->appends($parameters)->links('pagination');

        if ($request->ajax()){
            return response()->json([
                'table' => view('backs.managers.categories.tables',['categories'=>$records])->render(),
                'pagination' => $links->toHtml(),
            ]);
        }
        return view('backs.managers.categories.index',['categories' => $records, 'links' =>$links]);
    }

    public function search(Request $request)
    {
        $parameters = $this->getParameters($request);
        $records = $this->repository->search(config('app.nbrPages.back.categories'),$parameters);

        $links = $records->appends($parameters)->links('pagination');
        if ($request->ajax()){
            return response()->json([
                'table' => view('backs.managers.categories.tables',['categories'=>$records])->render(),
                'pagination' => $links->toHtml(),
            ]);
        }
        return view('backs.managers.categories.index',['categories' => $records, 'links' =>$links]);
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


}
