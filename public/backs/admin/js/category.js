function approved(e, id) {
    let btnCancel = "<button class='mb-2 mr-2 btn btn-success' onclick='cancel(this," + id + ")'>\n" +
        "<i class='fas fa-check-circle'></i></button>";
    Swal.fire({
        title: 'Are you sure?',
        text: "You will accept this category !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            if (id != null) {
                $.ajax({
                    url: url_approved,
                    method: "POST",
                    data: {'id': id},
                    success: function (rs) {
                        if (rs.result == true) {
                            Swal.fire(
                                'Successfully!',
                                'You have already accepted this category.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    $(e).replaceWith(btnCancel);
                                }
                            });
                        } else {
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

function cancel(e, id) {

    let btnApproved = "<button class='mb-2 mr-2 btn btn-danger' onclick='approved(this," + id + ")'>\n" +
        "<i class=\"fa fa-ban\"></i></button>";
    Swal.fire({
        title: 'Are you sure?',
        text: "You will cancel this category !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            if (id != null) {
                $.ajax({
                    url: url_cancel,
                    method: "POST",
                    data: {'id': id},
                    success: function (rs) {
                        if (rs.result == true) {
                            Swal.fire(
                                'Successfully!',
                                'You have already cancel this category.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    $(e).replaceWith(btnApproved);
                                }
                            });
                        } else {
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
