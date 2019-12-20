@extends('backs.layouts.master')

@section('css')
    <link rel="stylesheet" href="{!! asset('css/category.css') !!}">
@endsection

@section('main_content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>Categories Edit
                    <div class="page-title-subheading">Chỉnh sửa loại sản phẩm.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
{{--                xem file category/create sẽ rõ--}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    {{-- <h5 class="card-title">Controls Types</h5> --}}
                    <form action="{!! route('categories.update',$category->id) !!}" enctype="multipart/form-data" method="POST" id="category-form">
                        @csrf
                        @method('PUT')
                        @include('backs.category.template')
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script src="{!! asset('js/category.js') !!}"></script>
@endsection
