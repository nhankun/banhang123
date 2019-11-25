<div class="main-card mb-3 card">
    <div class="card-body container-fluid">
        {{--                    <h5 class="card-title">Table responsive</h5>--}}
        <div class="btn-context-head row">
            <div class="create-context col-6">
                <a href="{{ route('providers.create') }}" class="mb-2 mr-2 btn btn-primary create-btn"><span><i class="fa fa-plus-circle"></i>&nbsp;</span> Create provider</a>
            </div>
            <div class="search-context col-6">
                <form class="form-inline justify-content-end" action="{{ route('providers.search') }}" method="get">
                    <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                        <input name="search" id="search" placeholder="Search for name..." type="text" value="{!! old('name') !!}" class="form-control">
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
                    <th>address</th>
                    <th>email</th>
                    <th>tel</th>
{{--                    <th>website</th>--}}
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($providers as $provider)
                    <tr>
                        <th scope="row">{!! $provider->id !!}</th>
                        <td>{!! $provider->name !!}</td>
                        <td><img src="{!! asset($provider->image) !!}" alt="{!! $provider->name !!}"
                                 width="60"></td>
                        <td>{!! $provider->address !!}</td>
                        <td>{!! $provider->email !!}</td>
                        <td>{!! $provider->tel !!}</td>
{{--                        <td>{!! $provider->website !!}</td>--}}
                        <td>
                            @if($provider->status == true)
                                <span class="checkbox-active">
                                                <button class="mb-2 mr-2 btn btn-success" onclick="cancel(this,{{ $provider->id }})">
                                                    <i class="fas fa-check-circle"></i>
                                                </button>
                                            </span>
                            @else
                                <span class="checkbox-active">
                                                <button class="mb-2 mr-2 btn btn-danger" onclick="approved(this,{{ $provider->id }})">
                                                    <i class="fa fa-ban"></i>
                                                </button>
                                            </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('providers.edit',$provider->id) }}" class="mb-2 mr-2 btn btn-info"><i class="fas fa-edit"></i>
                            </a>
                            <a href="javascript:void(0);" class="mb-2 mr-2 btn btn-danger" onclick="deleteProvider(this,{{ $provider->id }});"><i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-context">
            {!! $providers->links() !!}
        </div>
    </div>
</div>

<script !src="">
    function approved(e,id) {
        let btnCancel = "<button class='mb-2 mr-2 btn btn-success' onclick='cancel(this," + id + ")'>\n" +
            "<i class='fas fa-check-circle'></i></button>";
        Swal.fire({
            title: 'Are you sure?',
            text: "You will accept this supplier !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                if(id != null)
                {
                    $.ajax({
                        url: "{!! route('providers.approved') !!}",
                        method: "POST",
                        data: {'id':id},
                        success: function(rs) {
                            if(rs.result == true) {
                                Swal.fire(
                                    'Successfully!',
                                    'You have already accepted this provider.',
                                    'success'
                                ).then((result) => {
                                    if (result.value){
                                        $(e).replaceWith(btnCancel);
                                    }
                                });
                            }else{
                                console.log(rs.result);
                            }
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    });
                }
            }
        });
    }

    function cancel(e,id) {
        let btnApproved = "<button class='mb-2 mr-2 btn btn-danger' onclick='approved(this," + id + ")'>\n" +
            "<i class=\"fa fa-ban\"></i></button>";
        Swal.fire({
            title: 'Are you sure?',
            text: "You will cancel this supplier !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                if(id != null)
                {
                    $.ajax({
                        url: "{!! route('providers.cancel') !!}",
                        method: "POST",
                        data: {'id':id},
                        success: function(rs) {
                            if(rs.result == true) {
                                Swal.fire(
                                    'Successfully!',
                                    'You have already cancel this provider.',
                                    'success'
                                ).then((result) => {
                                    if (result.value){
                                        $(e).replaceWith(btnApproved);
                                    }
                                });
                            }else{
                                console.log(rs.result);
                            }
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    });
                }
            }
        });
    }
</script>
