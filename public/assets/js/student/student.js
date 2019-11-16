// CSRF 
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// DataTable
let dataTable = $('#student-table').DataTable({
    "processing": true,
    "ajax": {
        url: "students"
    },
    "columns": [{
            data: 'fullname'
        },
        {
            data: 'gender'
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return '<button id="' + buttonId + '" class="d-block btn btn-sm btn-gradient-primary show-images">Images</button>';
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return '<button id="' + buttonId + '" class="btn btn-sm btn-gradient-warning update">Update</button>';
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return '<button id="' + buttonId + '" class="btn btn-sm btn-gradient-danger delete">Delete</button>';
            }
        }
    ]
});

function indexImages(id) {
    $.ajax({
        url: "students-images/" + id,
        success: function (data) {
            $('#student-images-modal').modal('show');
            $('#student-images').html('');

            data.forEach(function (result) {
                let image = '<div class="col-md-6">' +
                    '<div class="image-position">' +
                    '<img src="../storage/' + result.image + '" class="w-100 mb-5 rounded image-detail" alt="' + result.name + '">' +
                    '<button id="' + result.id + '" class="btn btn-danger btn-sm delete-images" value="' + id + '"><span class="mdi mdi-delete"></span></button>' +
                    '</div>' +
                    '</div>';

                $('#student-images').append(image);
            })
        }
    })
}

// Show Images
$('#student-table tbody').on('click', '.show-images', function () {
    let id = $(this).attr('id');
    indexImages(id)
});

// Click Button Add
$('#student-add').click(function () {
    $('#student-form')[0].reset();
    $('#student-title').text("Add student");
    $('#student-action').text("Add");
});

//Fetch datas for update
$('#student-table tbody').on('click', '.update', function () {
    let id = $(this).attr('id');

    $.ajax({
        url: "students/" + id + "/edit",
        dataType: "json",
        success: function (result) {
            $('#student-modal').modal('show');
            $('#student-title').text("Update student");
            $('#student-action').text("Update");

            $('#fullname').val(result.fullname);
            $('#nickname').val(result.nickname);
            $('#sex').val(result.gender);
            $('#description').val(result.description);
            $('#student-id').val(result.id);
        }
    })
});

// Store
$(document).on('submit', '#student-form', function (e) {
    e.preventDefault();

    //Variables
    let action = $('#student-action').text();
    let id = $('#student-id').val();
    let url;

    let formData = new FormData(this);

    if (action == "Add") {
        url = "students";
    } else if (action == "Update") {
        url = "students/" + id;
        formData.append("_method", "PUT");
    }

    if (url !== '') {
        Swal.fire({
            title: 'Loading',
            timer: 60000,
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        });

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#student-form')[0].reset();

                if (data.error == undefined) {
                    Swal.fire({
                            type: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        .then(function () {
                            dataTable.ajax.reload();
                            $('#student-modal').modal('hide');
                        });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: data.error,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        });
    }
});

//Delete image
$(document).on('click', '.delete-images', function () {
    let id = $(this).attr("id");
    let charaId = $(this).val()

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
            Swal.fire({
                title: 'Loading',
                timer: 60000,
                onBeforeOpen: () => {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: "students-images/" + id,
                type: 'DELETE',
                success: function () {

                    Swal.fire(
                            'Deleted!',
                            'Images successfully deleted.',
                            'success'
                        )
                        .then(function () {
                            indexImages(charaId)
                        });
                }
            });
        }
    })
});

// Delete student
$('#student-table tbody').on('click', '.delete', function () {
    let id = $(this).attr("id");

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
            Swal.fire({
                title: 'Loading',
                timer: 60000,
                onBeforeOpen: () => {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: "students/" + id,
                type: 'DELETE',
                success: function () {
                    Swal.fire(
                            'Deleted.',
                            'student successfully deleted!',
                            'success'
                        )
                        .then(function () {
                            dataTable.ajax.reload();
                        });
                }
            });
        }
    })
});
