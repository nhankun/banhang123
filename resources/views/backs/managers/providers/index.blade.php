@extends('backs.layouts.master')

@section('css')
    <link rel="stylesheet" href="{!! asset('backs/manager/css/provider.css') !!}">
@endsection

@section('main_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>Product List
                    <div class="page-title-subheading">Danh sách các nhà cung cấp.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body container-fluid">
                    {{--                    <h5 class="card-title">Table responsive</h5>--}}
                    <div class="btn-context-head row">
                        <div class="create-context col-6">
                            <a href="{{ route('providers.create') }}" target="_blank"
                               class="mb-2 mr-2 btn btn-primary create-btn"><span><i
                                        class="fa fa-plus-circle"></i>&nbsp;</span> Create provider</a>
                        </div>
                        <div class="search-context col-6">
                            <form class="form-inline justify-content-end"
                                  action="{{ route('managerProviders.search') }}" method="get">
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
                                <th>Image</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @include('backs.managers.providers.table')
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

        </div>
    </div>
@endsection

@section('script')
    <script !src="">
        var url_delete = "{!! route('managerProviders.delete') !!}";
    </script>
    <script src="{!! asset('backs/manager/js/provider.js') !!}"></script>
@endsection
