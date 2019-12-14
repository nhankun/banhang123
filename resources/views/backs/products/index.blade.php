@extends('backs.layouts.master')
@section('main_content')

    <style>
        .pagination-context{
            display: flex;
            justify-content: flex-end;
            padding-right: 5%;
        }
        .create-btn{

        }
    </style>
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>Providers List
                    <div class="page-title-subheading">Danh sách các nhà cung cấp sản phẩm.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                {{--                <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom"--}}
                {{--                        class="btn-shadow mr-3 btn btn-dark">--}}
                {{--                    <i class="fa fa-star"></i>--}}
                {{--                </button>--}}
                {{--                <div class="d-inline-block dropdown">--}}
                {{--                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"--}}
                {{--                            class="btn-shadow dropdown-toggle btn btn-info">--}}
                {{--                                            <span class="btn-icon-wrapper pr-2 opacity-7">--}}
                {{--                                                <i class="fa fa-business-time fa-w-20"></i>--}}
                {{--                                            </span>--}}
                {{--                        Buttons--}}
                {{--                    </button>--}}
                {{--                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">--}}
                {{--                        <ul class="nav flex-column">--}}
                {{--                            <li class="nav-item">--}}
                {{--                                <a href="javascript:void(0);" class="nav-link">--}}
                {{--                                    <i class="nav-link-icon lnr-inbox"></i>--}}
                {{--                                    <span>--}}
                {{--                                                            Inbox--}}
                {{--                                                        </span>--}}
                {{--                                    <div class="ml-auto badge badge-pill badge-secondary">86</div>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                            <li class="nav-item">--}}
                {{--                                <a href="javascript:void(0);" class="nav-link">--}}
                {{--                                    <i class="nav-link-icon lnr-book"></i>--}}
                {{--                                    <span>--}}
                {{--                                                            Book--}}
                {{--                                                        </span>--}}
                {{--                                    <div class="ml-auto badge badge-pill badge-danger">5</div>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                            <li class="nav-item">--}}
                {{--                                <a href="javascript:void(0);" class="nav-link">--}}
                {{--                                    <i class="nav-link-icon lnr-picture"></i>--}}
                {{--                                    <span>--}}
                {{--                                                            Picture--}}
                {{--                                                        </span>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                            <li class="nav-item">--}}
                {{--                                <a disabled href="javascript:void(0);" class="nav-link disabled">--}}
                {{--                                    <i class="nav-link-icon lnr-file-empty"></i>--}}
                {{--                                    <span>--}}
                {{--                                                            File Disabled--}}
                {{--                                                        </span>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('backs.provider.table')
        </div>
    </div>

    <script !src="">
        $(window).bind("load",function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function deleteProvider(e,id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    if(id != null)
                    {
                        $.ajax({
                            url: "{!! route('providers.delete') !!}",
                            method: "POST",
                            data: {'id':id},
                            success: function(rs) {
                                if(rs.result == true) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                }else{
                                    console.log(rs.result);
                                }
                            },
                            error: function (err) {
                                console.log(err);
                            }
                        });
                        $(e).parent().parent().remove();
                    }
                }
            });
        }
    </script>
@endsection
