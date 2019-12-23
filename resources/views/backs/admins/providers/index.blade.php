@extends('backs.layouts.master')

@section('css')
    <link rel="stylesheet" href="{!! asset('backs/admin/css/provider.css') !!}">
@endsection

@section('main_content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>Provider manager
                    <div class="page-title-subheading">Quản lý các nhà cung cấp.
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
                                <th>Image</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="pannel">
                            @include('backs.admins.providers.tables')
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

        </div>
    </div>

@endsection

@section('script')
    <script src="{!! asset('js/back.js') !!}"></script>
    <script src="{!! asset('backs/admin/js/provider.js') !!}"></script>

    <script !src="">
        var url_approved = "{!! route('AdminProvider.approved') !!}";
        var url_cancel = "{!! route('AdminProvider.cancel') !!}";

        var categories = (function () {

            var url = '{{ route('AdminProvider.index') }}';
            var title = "Are you sure?";
            var text = "You won't be able to revert this!";
            var cancelButtonText = "Cancel";
            var confirmButtonText = "Yes, delete it!";
            var errorAjax = "server_issue";
            var errorDelete = "error_delete";

            var onReady = function () {
                $('#pagination').on('click', 'ul.pagination a', function (event) {
                    back.pagination(event, $(this), errorAjax)
                });
                $('#pannel').on('change', function () {
                }).on('click', '.simpleConfirm', function (event) {
                    back.destroy(event, $(this), url, title, text, confirmButtonText, cancelButtonText, errorDelete)
                });
                $('th span').click(function () {
                    back.ordering(url, $(this), errorAjax)
                });
                $('#btnsearch').click(function () {
                    back.filters(url, errorAjax)
                });
                $('#search').keypress(function (event) {
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    // console.log(keycode);
                    if (keycode == '13') {
                        event.preventDefault();
                        $('#btnsearch').focus().click();
                    }
                });
            };

            return {
                onReady: onReady
            }

        })();

        $(document).ready(categories.onReady)
    </script>
@endsection
