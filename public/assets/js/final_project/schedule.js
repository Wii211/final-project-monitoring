$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

$(document).ready(function () {
    $.ajax({
        url: "../finished-project",
        type: "GET",
        dataType: "json",
        success: function (finalProjects) {
            $('#final-project-schedule-id').html('')
            finalProjects.forEach(function (result) {
                let data = '<option value="' + result.id + '">' + result.title + '</option>'
                $('#final-project-schedule-id').append(data)
            })
        }
    })

    // Examiner
    $.ajax({
        url: "../examiner-available?primary=true",
        type: "GET",
        dataType: "json",
        success: function (lecturers) {
            $('#examiner-name-1').html('')
            lecturers.forEach(function (result) {
                let data = '<option value="' + result.id + '">' + result.name + '</option>'
                $('#examiner-name-1').append(data)
            })
        }
    })

    $.ajax({
        url: "../examiner-available",
        type: "GET",
        dataType: "json",
        success: function (lecturers) {
            $('#examiner-name-2').html('')
            $('#examiner-name-3').html('')
            lecturers.forEach(function (result) {
                let data = '<option value="' + result.id + '">' + result.name + '</option>'
                $('#examiner-name-2').append(data)
                $('#examiner-name-3').append(data)
            })
        }
    })
})

$('#final-schedule-add').click(function () {
    $('#final-schedule-form')[0].reset()
    $('#final-schedule-title').text("Tambah Jadwal Seminar Proposal/Sidang TA")
    $('#final-schedule-button').text("Tambah")
})

let dataTable = $('#final-schedule-table').DataTable({
    "processing": true,
    "ajax": {
        url: "../final-schedules"
    },
    "columns": [{
            sortable: false,
            "render": function (data, type, full, meta) {
                let status = full.final_log.final_status.name
                let title = full.final_log.final_project.title

                return title + ' <span class="badge badge-primary p-2">' + status + '</span>'
            }
        },
        {
            data: 'final_log.final_project.final_student.name'
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                return '<table class="table m-0">' +
                '<tr><th>Ruangan</th><td>' + full.place + '</td></tr>' +
                '<tr><th>Tanggal</th><td>' + full.scheduled + '</td></tr></table>'
            }
        },
        {
            data: 'final_log.final_project.examiners',
            "render": function(value, type, row){
                let val = ''
                val += '<table class="table m-0">'
                value.forEach(function(data){
                    val += '<tr><th>Pembahas ' + data.role + '</th><td>' + data.lecturer.name + '</td></tr>'
                })
                val += '</table>'
                return val
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let id = full.id;
                let finalId = full.final_log.final_project_id;
                return "<button class='btn btn-warning update w-100' id='" + id + "'>Update</button>" +
                    "<button class='btn btn-danger delete mt-3 w-100' id='" + id + "' value='" + finalId + "'>Delete</button>";
            }
        }
    ]
})

// Store
$(document).on('submit', '#final-schedule-form', function (e) {
    e.preventDefault()

    let id = $('#final-schedule-id').val();
    let action = $('#final-schedule-button').text();
    let url;

    let formData = new FormData(this);

    if (action == "Tambah") {
        url = "../final-schedules";
    } else if (action == "Update") {
        url = "../final-schedules/" + id;
        formData.append("_method", "PUT");
    }

    if (url !== '') {
        Swal.fire({
            title: 'Loading',
            timer: 60000,
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        })
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#final-schedule-form')[0].reset();

                if (data !== "Failed") {
                    Swal.fire({
                            type: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        .then(function () {
                            $('#final-schedule-modal').modal('hide');
                            dataTable.ajax.reload();
                        })
                } else {
                    Swal.fire({
                        type: 'error',
                        title: data.error,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        })
    }
})


//Fetch datas for update
$('#final-schedule-table tbody').on('click', '.update', function () {
    let i = 1;
    let id = $(this).attr('id');

    $.ajax({
        url: "../final-schedules/" + id,
        dataType: "json",
        success: function (result) {
            $('#final-schedule-modal').modal('show')
            $('#final-schedule-title').text("Update Jenis Jadwal Tugas Akhir")
            $('#final-schedule-button').text("Update")
            $('#final-project-schedule-id').val(result.final_log.final_project_id)

            let dateobj = new Date(result.scheduled)

            $('#final-schedule').val(dateobj.toISOString())
            $('#place').val(result.place)
            $('#final-schedule-id').val(result.id)

            result.final_log.final_project.examiners.forEach(function (data) {
                $('#examiner-role-' + i).val(data.role)
                $('#examiner-name-' + i).val(data.lecturer_id)
                $('#examiner-id-' + i).val(data.id)
                i++
            })
        }
    })
})

//Progress Agreement
$('#final-schedule-table tbody').on('click', '.delete', function () {
    let id = $(this).attr("id")
    let finalId = $(this).val()

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, agreed it!'
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
                url: "../final-schedules/" + id,
                type: 'DELETE',
                data: {
                    'final_student_id': finalId
                }, 
                success: function () {
                    Swal.fire(
                            'Deleted!',
                            'Telah dihapus!',
                            'success'
                        )
                        .then(function () {
                            dataTable.ajax.reload();
                        });
                }
            });
        }
    })
})