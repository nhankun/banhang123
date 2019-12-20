<div class="main-card mb-3 card">
    <div class="card-body container-fluid">
        {{--                    <h5 class="card-title">Table responsive</h5>--}}
        <div class="btn-context-head row">
            <div class="create-context col-6">
                <a href="{{ route('categories.create') }}" target="_blank" class="mb-2 mr-2 btn btn-primary create-btn"><span><i
                            class="fa fa-plus-circle"></i>&nbsp;</span> Create category</a>
            </div>
            <div class="search-context col-6">
                <form class="form-inline justify-content-end" action="{{ route('managerCategories.search') }}" method="get">
                    <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                        <input name="search" id="search" placeholder="Search for name..." type="text"
                               value="{!! old('search') !!}" class="form-control">
                    </div>
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped" id="DataTableProvider">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>icon</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th scope="row">{!! $category->id !!}</th>
                        <td>{!! $category->name !!}</td>
                        <td><img src="{!! isset($category->icon) ? asset($category->icon) : asset("images/category_default.png") !!}" alt="{!! $category->name !!}" width="50"></td>
                        {{--                        <td>{!! $provider->website !!}</td>--}}
                        <td>

                            <span class="checkbox-active">
                            @if($category->status == true)
                                    <button class="mb-2 mr-2 btn btn-success" disabled>
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                @else
                                    <button class="mb-2 mr-2 btn btn-danger" disabled>
                                        <i class="fa fa-ban"></i>
                                    </button>
                                @endif
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('categories.edit',$category->id) }}" target="_blank" class="mb-2 mr-2 btn btn-info"><i
                                    class="fas fa-edit"></i>
                            </a>
                            <a href="javascript:void(0);" class="mb-2 mr-2 btn btn-danger"
                               onclick="deleteCategory(this,{{ $category->id }});"><i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-context">
            {!! isset($links) ? $links : '' !!}
        </div>
    </div>
</div>

<script !src="">

</script>
