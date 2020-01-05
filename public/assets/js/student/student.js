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
            data: 'student_id'
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                image = full.user.image_profile

                if(image !== null){
                    return "<img src='../storage/" + image + "' class='img-circle'>";
                } else {
                    return "<img src='../storage/image_profile/default.png' class='img-circle'>";
                }
            }
        },
        {
            data: 'name'
        },
        {
            data: 'gpa'
        },
        {
            data: 'user.phone_number'
        },
        {
            data: 'status'
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return '<button id="' + buttonId + '" class="btn btn-warning update">Update</button>';
            }
        }
    ],
    "columnDefs": [{
        targets: [5],
        render: function (data, type, row) {
            if (data == "Aktif" || data == 1) {
                return '<span class="badge badge-success p-2">Aktif</span>';
            } else {
                return '<span class="badge badge-danger p-2">Tidak Aktif</span>';
            }
        }
    }],
    "order": [[ 4, "desc" ]],
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
        url: "students/" + id,
        dataType: "json",
        success: function (result) {
            $('#student-modal').modal('show');
            $('#student-title').text("Update student");
            $('#student-action').text("Update");

            $('#final-student-id').val(result.student_id);
            $('#name').val(result.name);
            $('#email').val(result.user.email);
            $('#phone-number').val(result.user.phone_number);
            $('#status').val(result.status);
            $('#gender').val(result.user.gender);
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

                if (data !== "Failed") {
                    Swal.fire({
                            type: 'success',
                            title: 'Data berhasil dieksekusi',
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
                        title: 'Data gagal dieksekusi',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        });
    }
});