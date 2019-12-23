<?php

namespace App\Http\Controllers\Backs\Managers\Providers;

use App\Http\Controllers\Controller;
use App\Repositories\Back\Managers\Providers\ManagerProviderRepository;
use App\Services\Indexable;
use Illuminate\Http\Request;

class ManagerProviderController extends Controller
{
    use Indexable;

    private $repository;
    private $table = 'providers';

    public function __construct(ManagerProviderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $parameters = $this->getParameters($request);
        $records = $this->repository->getAll(config('app.nbrPages.back.providers'),$parameters);

        $links = $records->appends($parameters)->links('pagination');

        if ($request->ajax()){
            return response()->json([
                'table' => view('backs.managers.providers.tables',['providers'=>$records])->render(),
                'pagination' => $links->toHtml(),
            ]);
        }
        return view('backs.managers.providers.index',['providers' => $records, 'links' =>$links]);
    }

    public function search(Request $request)
    {
        $parameters = $this->getParameters($request);
        $records = $this->repository->search(config('app.nbrPages.back.providers'),$parameters);

        $links = $records->appends($parameters)->links('pagination');
        if ($request->ajax()){
            return response()->json([
                'table' => view('backs.managers.providers.tables',['providers'=>$records])->render(),
                'pagination' => $links->toHtml(),
            ]);
        }
        return view('backs.managers.providers.index',['providers' => $records, 'links' =>$links]);
    }

    public function delete(Request $request)
    {
        $result = $this->repository->delete($request->id);
        if ($request->ajax())
        {
            return response()->json(['result'=>$result],200);
        }
        return redirect()->route('providers.index');
    }
}
