<?php

namespace App\Http\Controllers\Backs\Admins\Providers;

use App\Http\Controllers\Controller;
use App\Repositories\Back\Admins\Providers\AdminProviderRepository;
use App\Services\Indexable;
use Illuminate\Http\Request;

class AdminProviderController extends Controller
{
    use Indexable;

    private $table;
    private $repository;

    public function __construct(AdminProviderRepository $repository)
    {
        $this->repository = $repository;
        $this->table = "providers";
    }

    public function index(Request $request)
    {
        $parameters = $this->getParameters($request);
        $records = $this->repository->getAll(config('app.nbrPages.back.providers'),$parameters);

        $links = $records->appends($parameters)->links('pagination');

        if ($request->ajax()){
            return response()->json([
                'table' => view('backs.admins.providers.tables',['providers'=>$records])->render(),
                'pagination' => $links->toHtml(),
            ]);
        }
        return view('backs.admins.providers.index',['providers' => $records, 'links' =>$links]);
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
        return redirect()->route('AdminCategory.index');
    }

    public function cancel(Request $request)
    {
        $category_id = $request->id;
        $result = $this->repository->cancel($category_id);
        if ($request->ajax())
        {
            return response()->json(['result'=>$result],200);
        }
        return redirect()->route('AdminCategory.index');
    }
}
