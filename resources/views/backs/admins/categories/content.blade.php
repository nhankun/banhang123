<div class="main-card mb-3 card">
    <div class="card-body container-fluid">
        {{--                    <h5 class="card-title">Table responsive</h5>--}}
        <div class="btn-context-head row">
            <div class="create-context col-6">
                <a href="{{ route('categories.create') }}" target="_blank" class="mb-2 mr-2 btn btn-primary create-btn"><span><i
                            class="fa fa-plus-circle"></i>&nbsp;</span> Create category</a>
            </div>
            <div class="search-context col-6">
                <form class="form-inline justify-content-end" action="javascript:void(0);" method="get">
                    <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                        <input name="search" id="search" placeholder="Search for name..." type="text"
                               value="{!! old('search') !!}" class="form-control">
                    </div>
                    <button class="btn btn-primary" id="btnsearch" type="submit">Search</button>
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
                <tbody id="pannel">
                    @include('backs.admins.categories.tables')
                </tbody>
            </table>
        </div>
        <div class="row justify-content-center">
            <div id="spinner"></div>
        </div>
        <div class="pagination-context" id="pagination">
            {!! isset($links) ? $links : ''!!}
        </div>
    </div>
</div>
