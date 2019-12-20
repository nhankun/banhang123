<?php

namespace App\Http\Controllers\Backs\Admins\Categories;

use App\Http\Controllers\Controller;
use App\Repositories\Back\Admins\Categories\AdminCategoryRepository;
use App\Services\Indexable;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    use Indexable;

    private $table;
    private $repository;

    public function __construct(AdminCategoryRepository $repository)
    {
        $this->repository = $repository;
        $this->table = 'categories';
    }

    public function index(Request $request)
    {
        $parameters = $this->getParameters($request);
        $records = $this->repository->getAll(config('app.nbrPages.back.categories'),$parameters);

        $links = $records->appends($parameters)->links('pagination');

        if ($request->ajax()){
            return response()->json([
                'table' => view('backs.admins.categories.tables',['categories'=>$records])->render(),
                'pagination' => $links->toHtml(),
            ]);
        }
        return view('backs.admins.categories.index',['categories' => $records, 'links' =>$links]);
    }

    public function destroy($id)
    {
        $result = $this->repository->delete($id);
        return response()->json(['result'=>$result],200);
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
