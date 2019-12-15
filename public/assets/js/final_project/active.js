$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})


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
    })

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
    })
})

let dataTable = $('#final-project-table').DataTable({
    "processing": true,
    "ajax": {
        url: "monitoring"
    },
    "columns": [{
            data: 'name'
        },
        {
            data: 'final_project.title'
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let status

                full.final_project.final_logs.forEach(function (data) {
                    console.log(data.final_status.name)
                    status = data.final_status.name
                })

                return '<span class="badge badge-primary p-2">' + status + '</span>'
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.final_project.id;
                return "<button class='btn btn-primary progress-proposal fs-12' id='" + buttonId + "'>Progress Proposal</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.final_project.id;
                return "<button class='btn btn-primary progress-final-project fs-12' id='" + buttonId + "'>Progress TA</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.final_project.id;
                return "<button class='btn btn-success verification' id='" + buttonId + "'>Verifikasi</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.final_project.id;
                return "<button class='btn btn-warning update' id='" + buttonId + "'>Update</button>";
            }
        }
    ]
})

//Fetch datas for update
$('#final-project-table tbody').on('click', '.update', function () {
    let i = 1;
    let id = $(this).attr('id');

    $.ajax({
        url: "../data/final_project/" + id,
        dataType: "json",
        success: function (result) {
            $('#final-project-active-modal').modal('show')
            $('#final-project-active-title').text("Update Tugas Akhir")
            $('#final-project-active-id').val(result.data.id)
            $('#final-student-active-id').val(result.data.final_student_id)
            $('#description-active').val(result.data.description)

            $('#title-active').val(result.data.title)

            result.data.supervisors.forEach(function (data) {
                $('#supervisors-' + i).val(data.lecturer_id)
                $('#supervisors-role-' + i).val(data.role)
                i++
            })
        }
    })
});

function verification(id){
    let n = 1
    $.ajax({
        url: "student-status/" + id,
        success: function (result) {
            $('#final-project-verification-modal').modal('show')
            $('#final-project-verification-id').val(id)
            $('#final-status-table-row').html('')
            result.data.forEach(function (result) {
                let status
                let button 
                if (result.is_verification === 1) {
                    status = '<span class="badge badge-success p-2">Telah diverifikasi</span>'
                    button = ''
                } else {
                    status = '<span class="badge badge-warning p-2">Belum diverifikasi</span>'
                    button = '<button type="button" class="btn btn-success final-status-check" id="' + result.id + '">' + 
                    '<i class="fas fa-check"></i></button>'
                }

                let data = '<tr>' +
                    '<td>' + n + '</td>' +
                    '<td>' + result.final_status.name + '</td>' +
                    '<td>' + status + '</td>' +
                    '<td>' + button + '</td>' +
                    '</tr>';
                n++
                $('#final-status-table-row').append(data);

            })
        }
    })
}

// Verificationx
$('#final-project-table tbody').on('click', '.verification', function () {
    let id = $(this).attr("id");

    verification(id)
})


$('#final-status-table tbody').on('click', '.final-status-check', function () {
    let id = $(this).attr("id")
    let finalId = $('#final-project-verification-id').val()

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, verified it!'
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: 'Loading',
                timer: 60000,
                onBeforeOpen: () => {
                    Swal.showLoading()
                }
            })
            $.ajax({
                url: "student-status/" + id + "/verify",
                type: 'POST',
                data: {
                    '_method': 'PUT', 
                    'is_verification': 1
                }, 
                success: function () {
                    Swal.fire(
                            'Verified!',
                            'Telah diverifikasi!',
                            'success'
                        )
                        .then(function () {
                            verification(finalId)
                        });
                }
            });
        }
    })
})


function progressIndex(id, status) {
    let no = 1
    $.ajax({
        url: "project-progress/" + id,
        data: {
            'final_status': status
        },
        success: function (result) {
            console.log(result)
            $('#final-progress-agreement-title').text('Progress Pengerjaan Proposal')
            $('#final-progress-agreement-modal').modal('show')
            $('#final-progress-agreement-table tbody').html('')
            if (result !== "failed") {
                result.data.forEach(function (result) {
                    let status

                    if (result.agreement === 1) {
                        status = '<span class="badge badge-success p-2">Telah disetujui</span>'
                    } else {
                        status = '<span class="badge badge-danger p-2">Belum disetujui</span>'
                    }

                    let data = '<tr>' +
                        '<td>' + no + '</td>' +
                        '<td>' + result.created_at + '</td>' +
                        '<td>' + result.description + '</td>' +
                        '<td>' + status + '</td>' +
                        '<td><button class="btn bg-gradient-success btn-sm w-100 progress-agreement-check" id="' + result.id + '">' +
                        '<span class="fas fa-check"></span></button></td>' +
                        '</tr>'

                    no++
                    $('#ffinal-progress-agreement-table tbody').append(data)
                })
            }
        }
    })
}

// Agreement
$('#final-project-table tbody').on('click', '.progress-proposal', function () {
    let id = $(this).attr("id")
    progressIndex(id, "proposal")
})


// Store
$(document).on('submit', '#final-project-active-form', function (e) {
    e.preventDefault();

    let id = $('#final-project-active-id').val();
    let url = "../data/final_project/" + id;

    let formData = new FormData(this);

    formData.append("_method", "PUT");

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
                $('#final-project-active-form')[0].reset();

                if (data !== "Failed") {
                    Swal.fire({
                            type: 'success',
                            title: 'Berhasil!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        .then(function () {
                            $('#final-project-active-modal').modal('hide');
                            dataTable.ajax.reload();
                        });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        });
    }
})