@extends('backs.layouts.master')
@section('main_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>Product Edit
                    <div class="page-title-subheading">Sửa thông tin cơ bản sản phẩm.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="progress">
                    <div class="progress-bar progress-bar-animated bg-success progress-bar-striped" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">basic-info</h5>
                    <form action="{{ route('products.update',$product->id)  }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('backs.products.basic_infos.template')
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
