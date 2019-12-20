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
                <div>Categories List
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
            @include('backs.managers.categories.table')
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

        function deleteCategory(e,id){
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
                            url: "{!! route('managerCategories.delete') !!}",
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
