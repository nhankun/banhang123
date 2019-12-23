$(window).bind("load", function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function deleteCategory(e, id) {
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
            if (id != null) {
                $.ajax({
                    url: url_delete,
                    method: "POST",
                    data: {'id': id},
                    success: function (rs) {
                        if (rs.result == true) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        } else {
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
