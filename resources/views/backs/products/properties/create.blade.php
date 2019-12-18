@extends('backs.layouts.master')
@section('main_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>Property Create
                    <div class="page-title-subheading">Thêm thuộc tính sản phẩm.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="progress">
                    <div class="progress-bar progress-bar-animated bg-success progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Properties</h5>
                    <form action="{{ route('properties.store')  }}" id="form-property" enctype="multipart/form-data" method="POST">
                        @csrf
                        @include('backs.products.properties.template')
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
