$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

$(document).on('change', '#final-schedule-type', function () {
    let status = $(this).val()

    if (status === "tugas_akhir") {
        $('#final-project-examiner-3').css('display', 'block')
    } else {
        $('#final-project-examiner-3').css('display', 'none')
    }

    $.ajax({
        url: "../finished-project?status=" + status,
        data: {
            verification: 1
        },
        type: "GET",
        dataType: "json",
        success: function (finalProjects) {
            $('#final-project-schedule-id').html('')
            finalProjects.forEach(function (result) {
                let data = '<option id="' + result.final_logs[0].final_requirements[0].document_result +
                    '" value="' + result.id + '">' + result.title + '</option>'
                $('#final-project-schedule-id').append(data)
            })
        }
    })
})

$(document).on('click', '#final-project-checked', function () {
    let document = $('#final-project-schedule-id option').attr('id')

    $('#student-information-modal').modal('show')
    $('#final-schedule-modal').modal('hide')
    if (document !== null) {
        PDFObject.embed('../../storage/' + document, "#student-information-content")
        $('#student-information-title').text('Berkas Proposal/Tugas Akhir')
        $('#student-information-content').css('height', '500')
    } else {
        $('#student-information-title').text('Data tidak ditemukan.')
        $('#student-information-content').html('<img class="w-100" src="../../storage/design/undraw_empty_xct9.png">')
        $('#student-information-content').css('height', '100%')
    }
})

$(document).ready(function () {

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
    $('#final-schedule-requirement').css('display', 'block')
})

let dataTable = $('#final-schedule-table').DataTable({
    "processing": true,
    "ajax": {
        url: "../final-schedules"
    },
    "columns": [{
            "render": function (data, type, full, meta) {
                let status = full.final_status
                let title = full.title
                let finalScheduleStatus = full.status
                let info

                if (finalScheduleStatus === 0) {
                    info = '<span class="badge badge-warning p-2 d-block w-100">Sedang Seminar</span>'
                } else if (finalScheduleStatus === 2) {
                    info = '<span class="badge badge-danger p-2 d-block w-100">Gagal Seminar</span>'
                }


                if (status === "tugas_akhir") {
                    status = '<span class="badge badge-primary p-2 d-block w-100">Sidang Tugas Akhir</span> '
                } else {
                    status = '<span class="badge badge-info p-2 d-block w-100">Seminar Proposal</span> '
                }
                return info + status + title
            }
        },
        {
            data: 'student_name'
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                return '<table class="table m-0">' +
                    '<tr><th>Ruangan</th><td>' + full.place + '</td></tr>' +
                    '<tr><th>Tanggal</th><td>' + full.date + '</td></tr>' +
                    '<tr><th>Waktu</th><td>' + full.hour + '</td></tr></table>'
            }
        },
        {
            data: 'examiners',
            "render": function (value, type, row) {
                let val = ''

                val += '<table class="table m-0">'
                value.forEach(function (data) {
                    val += '<tr><th>Pembahas ' + data.role + '</th><td>' + data.lecturer.name + '</td></tr>'
                })
                val += '</table>'
                return val
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let id = full.final_log_id
                let status = full.final_status
                return "<button class='btn btn-success success-final-schedule w-100' id='" + id + "' value='" + status + "'>Berhasil</button>" +
                    "<button class='btn btn-danger failed-final-schedule w-100 mt-1' id='" + id + "' value='" + status + "'>Gagal</button>"
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let id = full.id;
                return "<button class='btn btn-warning update w-100' id='" + id + "'>Update</button>"
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let finalProjectId = full.final_project_id
                let finalStatusName = full.final_status

                if(finalStatusName === "proposal"){
                    return '<form action="../news-report-proposal/' + finalProjectId + '" method="GET">' + 
                    '<button type="submit" class="btn btn-default w-100">Print</button>' +
                    '</form>'
                } else {
                    return '<form action="../news-report-final-project/' + finalProjectId + '" method="GET">' + 
                    '<button type="submit" class="btn btn-default w-100">Print</button>' +
                    '</form>'
                }
            }
        }
    ]
})

// $('#final-schedule-table tbody').on('click', '.print', function () {
//     const finalProjectId = $(this).attr('id')
//     const finalStatusName = $(this).val()

//     if(finalStatusName === "tugas_akhir") {
//         window.location.href = '../news-report-proposal/' + finalProjectId
//     } else {
//         window.location.href = '../news-report-final-project/' + finalProjectId
//     }
// })


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

                if (data === "Success") {
                    Swal.fire({
                            type: 'success',
                            title: 'Data berhasil dieksekusi!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        .then(function () {
                            $('#final-schedule-modal').modal('hide');
                            $('#final-schedule-form')[0].reset();
                            dataTable.ajax.reload();
                        })
                } else {
                    Swal.fire({
                        type: 'error',
                        title: data,
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
            $('#final-schedule-requirement').css('display', 'none')

            $('#final-schedule-date').val(result.date)
            $('#final-schedule-time').val(result.hour)
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

//Delete
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
                    'final_project_id': finalId
                },
                success: function (data) {
                    if (data !== "Failed") {
                        Swal.fire(
                                'Deleted!',
                                'Telah dihapus!',
                                'success'
                            )
                            .then(function () {
                                dataTable.ajax.reload();
                            });

                    } else {

                        Swal.fire(
                                'Failed!',
                                'Gagal menghapus!',
                                'error'
                            )
                            .then(function () {
                                dataTable.ajax.reload();
                            });
                    }
                }
            });
        }
    })
})

//Accept Final Schedule
$('#final-schedule-table tbody').on('click', '.success-final-schedule', function () {
    const finalLogId = $(this).attr('id')
    const finalStatus = $(this).val()

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, accept it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "../accept-thesis-defence/1",
                type: 'POST',
                data: {
                    final_log_id: finalLogId,
                    final_status_name: finalStatus,
                    _method: 'PUT'
                },
                success: function () {
                    if (data !== "Failed") {
                        Swal.fire(
                                'Sukses!',
                                'Mahasiswa telah selesai melakukan seminar.',
                                'success'
                            )
                            .then(function () {
                                dataTable.ajax.reload()
                            })
                    } else {
                        Swal.fire(
                                'Gagal!',
                                'Gagal mengeksekusi data.',
                                'error'
                            )
                            .then(function () {
                                dataTable.ajax.reload()
                            })

                    }
                }
            })
        }
    })
})

//Decline Final Schedule
$('#final-schedule-table tbody').on('click', '.failed-final-schedule', function () {
    const finalLogId = $(this).attr('id')
    const finalStatus = $(this).val()

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, sure.'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "../decline-thesis-defence/1",
                type: 'DELETE',
                data: {
                    final_log_id: finalLogId,
                    final_status_name: finalStatus
                },
                success: function () {
                    if (data !== "Failed") {
                        Swal.fire(
                                'Sukses!',
                                'Mahasiswa gagal melakukan seminar.',
                                'success'
                            )
                            .then(function () {
                                dataTable.ajax.reload()
                            })
                    } else {
                        Swal.fire(
                                'Gagal!',
                                'Gagal mengeksekusi data.',
                                'error'
                            )
                            .then(function () {
                                dataTable.ajax.reload()
                            })
                    }
                }
            })
        }
    })
})