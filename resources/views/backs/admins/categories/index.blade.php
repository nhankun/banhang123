@extends('backs.layouts.master')
@section('main_content')

    <style>
        .pagination-context {
            display: flex;
            justify-content: flex-end;
            padding-right: 5%;
        }

        .create-btn {

        }
    </style>
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>Categories manager
                    <div class="page-title-subheading">Danh sách các loại sản phẩm.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('backs.admins.categories.content')
        </div>
    </div>
    <script src="{!! asset('js/back.js') !!}"></script>
    <script src="{!! asset('backs/admin/js/admins/category.js') !!}"></script>

    <script !src="">
        var url_approved = "{!! route('AdminCategory.approved') !!}";
        var url_cancel = "{!! route('AdminCategory.cancel') !!}";

        var categories = (function () {

            var url = '{{ route('AdminCategory.index') }}';
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
