// CSRF 
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
}); 

let dataTable = $('#final-project-table').DataTable({
    "processing": true,
    "ajax": {
        url: "final_project"
    },
    "columns": [{
            data: 'title'
        },
        {
            data: 'final_student.name'
        },
        {
            data: 'created_at'
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-primary btn-sm news-report' id='" + buttonId + "'>Berita Acara</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-info btn-sm detail' id='" + buttonId + "'>Detail</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-warning btn-sm update' id='" + buttonId + "'>Update</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-danger btn-sm delete' id='" + buttonId + "'>Delete</button>";
            }
        }
    ]
});

// Click Button Add
$('#final-project-add').click(function () {
    $('#final-project-form')[0].reset();
    $('#final-project-title').text("Tambah Tugas Akhir");
    $('#final-project-action').text("Tambah");
});

//Fetch datas for update
let i = 1;
$('#final-project-table tbody').on('click', '.update', function () {
    let id = $(this).attr('id');

    $.ajax({
        url: "final_project/" + id,
        dataType: "json",
        success: function (result) {
            $('#final-project-modal').modal('show');
            $('#final-project-title').text("Update Tugas Akhir");
            $('#final-project-action').text("Update");
            $('#final-project-id').val(result.data.id);

            $('#title').val(result.data.title);
            $('#description').val(result.data.description);


            result.data.supervisors.forEach(function (data) {
                $('#supervisors-' + i).val(data.lecturer_id);
                $('#supervisors-role-' + i).val(data.role);
                i++
            })
        }
    })
});

// Store
$(document).on('submit', '#final-project-form', function (e) {
    e.preventDefault();

    //Variables
    let action = $('#final-project-action').text();
    let id = $('#final-project-id').val();
    let url;

    let formData = new FormData(this);

    if (action == "Tambah") {
        url = "final_project";
    } else if (action == "Update") {
        url = "final_project/" + id;
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
                $('#final-project-form')[0].reset();

                if (data !== "Failed") {
                    Swal.fire({
                            type: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        .then(function () {
                            $('#final-project-modal').modal('hide');
                            dataTable.ajax.reload();
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

$(document).ready(function () {
    $.ajax({
        url: "../supervisor?primary=true",
        type: "GET",
        dataType: "json",
        success: function (lecturer) {
            lecturer.data.forEach(function (result) {

                let data = '<option value="' + result.id + '">' + result.name + '</option>';
                $('#supervisors-1').append(data);
            });
        }
    });

    $.ajax({
        url: "../supervisor?primary=false",
        type: "GET",
        dataType: "json",
        success: function (lecturer) {
            lecturer.data.forEach(function (result) {

                let data = '<option value="' + result.id + '">' + result.name + '</option>';
                $('#supervisors-2').append(data);
            });
        }
    });

    $.ajax({
        url: "students",
        type: "GET",
        dataType: "json",
        success: function (students) {
            students.data.forEach(function (result) {

                let data = '<option value="' + result.id + '">' + result.name + '</option>';
                $('#final-student-id').append(data);
            });
        }
    });
});