$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

// $('#supervisor-check').click(function() {
//     $("#add-supervisors-2").toggle(this.checked);
// });

$(document).ready(function () {
    $.ajax({
        url: "../supervisor?primary=true",
        type: "GET",
        dataType: "json",
        success: function (lecturer) {
            let dataBlank = '<option value=""></option>'
            $('#supervisors-1').append(dataBlank)
            $('#supervisor-1').append(dataBlank)
            lecturer.data.forEach(function (result) {
                let data = '<option value="' + result.id + '">' + result.name + '</option>';
                $('#supervisors-1').append(data)
                $('#supervisor-1').append(data)
            });
        }
    })

    $.ajax({
        url: "../supervisor",
        type: "GET",
        dataType: "json",
        success: function (lecturer) {
            let dataBlank = '<option value=""></option>'
            $('#supervisors-2').append(dataBlank)
            $('#supervisor-2').append(dataBlank)

            lecturer.data.forEach(function (result) {
                let data = '<option value="' + result.id + '">' + result.name + '</option>';
                $('#supervisors-2').append(data)
                $('#supervisor-2').append(data)
            });
        }
    })
})

// function getAlert(id, status) {
//     let alert = ''
//     $.ajax({
//         url: "finished-project/" + id + "?status=" + status,
//         data: {
//             verification: 0
//         },
//         type: "GET",
//         dataType: "json",
//         success: function (result) {
//             alert = result.data
//         }
//     })
//     return alert
// }

let dataTable = $('#final-project-table').DataTable({
    "processing": true,
    "ajax": {
        url: "monitoring"
    },
    "order": [
        [2, "desc"]
    ],
    "columns": [{
            data: 'name'
        },
        {
            "render": function (data, type, full, meta) {
                let title = '<span class="badge badge-danger p-2">Belum Ada Judul</span>'

                if (full.final_project !== null) {
                    title = full.final_project.title
                }

                return title
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let status = 'Pendaftaran'
                let colour = 'btn-register'

                if (full.final_project !== null) {
                    full.final_project.final_logs.forEach(function (data) {
                        status = data.final_status.name
                        if (status === "tugas_akhir") {
                            status = "Tugas Akhir"
                            colour = "btn-final-project"
                        } else if (status === "proposal") {
                            status = "Proposal"
                            colour = "btn-proposal"
                        } else if (status == "pra-proposal") {
                            status = "Pra-Proposal"
                            colour = "btn-pra-proposal"
                        } else if (status === "tugas_akhir_selesai") {
                            status = "Tugas Akhir Selesai"
                            colour = "btn-finish-final-project"
                        }
                    })
                }

                return '<span class="badge badge-primary p-2 w-100 ' + colour + ' ">' + status + '</span>'
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let progress = ''
                let buttonId = ''
                let status = ''
                let alert = '<i id="" class="fas fa-exclamation-triangle ml-1 final-schedule-alert" style="color:yellow;display:none"></i>'
                if (full.final_project !== null) {
                    full.final_project.final_logs.forEach(function (data) {
                        status = data.final_status.name
                    })

                    buttonId = full.final_project.id
                    
                    // if (getAlert(buttonId, status) === 1) {
                    //     alert = '<i id="" class="fas fa-exclamation-triangle ml-1 final-schedule-alert" style="color:yellow;"></i>'
                    // } else {
                    //     alert = '<i id="" class="fas fa-exclamation-triangle ml-1 final-schedule-alert" style="color:yellow;display:none"></i>'
                    // }

                    if (status === "proposal") {
                        progress = "<button class='btn btn-primary progress-proposal fs-12 w-100' id='" + buttonId + "' value='proposal'>Progress Proposal " + alert + "</button>"
                    } else if (status === "tugas_akhir") {
                        progress = "<button class='btn btn-info progress-proposal fs-12 w-100 mt-1' id='" + buttonId + "' value='tugas_akhir'>Progress TA " + alert + "</button>"
                    }
                }
                return progress
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = ''

                if (full.final_project !== null) {
                    buttonId = full.final_project.id
                }
                return "<button class='btn btn-sm btn-info update w-100' id='" + buttonId + "'>Detail</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let verification = ''
                let buttonId = ''

                if (full.final_project !== null) {
                    buttonId = full.final_project.id

                    full.final_project.final_logs.forEach(function (data) {
                        if (data.is_verification === 1) {
                            verification += "<button class='d-inline-block btn btn-sm btn-success p-2 mr-1' id='" + data.id + "' value='" + buttonId + "'><i class='fas fa-check'></i></button>"
                        } else {
                            verification += "<button class='d-inline-block btn btn-sm btn-danger p-2 mr-1 final-status-check' id='" + data.id + "' value='" + buttonId + "'><i class='fas fa-question'></i></button>"
                        }
                    })
                }
                return verification
            }
        },
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
            // console.log(result)
            $('#final-project-active-modal').modal('show')
            $('#final-project-active-title').text("Tugas Akhir ")
            $('#final-project-active-id').val(result.data.id)
            $('#final-student-active-id').val(result.data.final_student_id)
            $('#description-active').val(result.data.description)

            $('#title-active').val(result.data.title)

            $('#supervisors-1').val('')
            $('#supervisors-2').val('')
            $('#supervisors-role-1').val('')
            $('#supervisors-role-2').val('')
            $('#supervisors-file-1').text('Tidak Ada Berkas Persetujuan').addClass('btn-danger').removeClass('btn-info').removeAttr('href')
            $('#supervisors-file-2').text('Tidak Ada Berkas Persetujuan').addClass('btn-danger').removeClass('btn-info').removeAttr('href')

            if (result.data.supervisors !== undefined) {
                result.data.supervisors.forEach(function (data) {
                    if (data !== undefined) {
                        $('#supervisors-' + i).val(data.lecturer_id)
                        $('#supervisors-role-' + i).val(data.role)

                        if (data.verification_file !== null) {
                            $('#supervisors-file-' + i).attr('href', '../storage/images/' + data.verification_file)
                            $('#supervisors-file-' + i).text('Berkas Persetujuan Dosen Pembimbing-' + i).addClass('btn-info').removeClass('btn-danger')
                        } else {
                            $('#supervisors-file-' + i).text('Tidak Ada Berkas Persetujuan').addClass('btn-danger').removeClass('btn-info').removeAttr('href')
                        }

                    } else {
                        $('#supervisors-file-' + i).text('Tidak Ada Berkas Persetujuan').addClass('btn-danger').removeClass('btn-info').removeAttr('href')
                    }

                    i++
                })
            }
        }
    })
});

// function verification(id){
//     let n = 1
//     $.ajax({
//         url: "student-status/" + id,
//         success: function (result) {
//             $('#final-project-verification-modal').modal('show')
//             $('#final-project-verification-id').val(id)
//             $('#final-status-table-row').html('')
//             result.data.forEach(function (result) {
//                 let status
//                 let button 
//                 if (result.is_verification === 1) {
//                     status = '<span class="badge badge-success p-2">Telah diverifikasi</span>'
//                     button = ''
//                 } else {
//                     status = '<span class="badge badge-warning p-2">Belum diverifikasi</span>'
//                     button = '<button type="button" class="btn btn-success final-status-check" id="' + result.id + '">' + 
//                     '<i class="fas fa-check"></i></button>'
//                 }

//                 let data = '<tr>' +
//                     '<td>' + n + '</td>' +
//                     '<td>' + result.final_status.name + '</td>' +
//                     '<td>' + status + '</td>' +
//                     '<td>' + button + '</td>' +
//                     '</tr>';
//                 n++
//                 $('#final-status-table-row').append(data);

//             })
//         }
//     })
// }

// // Verificationx
// $('#final-project-table tbody').on('click', '.verification', function () {
//     let id = $(this).attr("id")
//     verification(id)
// })


$('#final-project-table tbody').on('click', '.final-status-check', function () {
    let id = $(this).attr("id")
    let finalId = $(this).val()

    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda tidak akan dapat mengembalikannya!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        cancelButtonText: 'Tidak'
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
                            dataTable.ajax.reload();
                        });
                }
            });
        }
    })
})

$('#final-progress-agreement-modal').on('hidden.bs.modal', function (e) {
    $("#final-schedule-add").hide()
    $("#final-project-examiner-5").hide()
})


function progressIndex(id, status) {
    let no = 1
    let finalStatus = ''
    $.ajax({
        url: "project-progress/" + id,
        data: {
            'final_status': status
        },
        success: function (result) {
            if (status === "tugas_akhir") {
                finalStatus = "Tugas Akhir"
            } else {
                finalStatus = "Proposal"
            }
            $('#final-progress-agreement-title').text('Progress Pengerjaan ' + finalStatus)
            $('#final-progress-agreement-modal').modal('show')
            $('#final-progress-agreement-table tbody').html('')
            $('#final-schedule-add').val(status)
            $('#final-schedule-add').attr('data-target', id)

            if (result !== "failed") {
                result.data.forEach(function (result) {
                    let status, button

                    if (result.agreement === 1) {
                        status = '<span class="badge badge-success p-2">Telah disetujui</span>'
                        button = ''
                    } else {
                        status = '<span class="badge badge-danger p-2">Belum disetujui</span>'
                        button = '<button class="btn bg-gradient-success btn-sm w-100 progress-agreement-check" id="' + result.id + '" >' +
                            '<span class="fas fa-check"></span></button>'
                    }

                    let data = '<tr>' +
                        '<td>' + no + '</td>' +
                        '<td>' + result.created_at + '</td>' +
                        '<td>' + result.description + '</td>' +
                        '<td>' + status + '</td>' +
                        '<td>' + button + '</td>' +
                        '</tr>'

                    no++
                    $('#final-progress-agreement-table tbody').append(data)
                })
            }
        }
    })

    $.ajax({
        url: "finished-project/" + id + "?status=" + status,
        data: {
            verification: 0
        },
        type: "GET",
        dataType: "json",
        success: function (result) {
            // console.log(result)
            if (result.data === 1) {
                $("#final-schedule-add").toggle();
            } else {
                $("#final-schedule-add").hide();
            }
        }
    })
}

// Agreement
$('#final-project-table tbody').on('click', '.progress-proposal', function () {
    let id = $(this).attr("id")
    let status = $(this).val()

    $('#final-project-agreement-id').val(id)
    $('#final-project-agreement-status').val(status)

    progressIndex(id, status)

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

//Progress Agreement
$('#final-progress-agreement-table tbody').on('click', '.progress-agreement-check', function () {
    let id = $(this).attr("id")
    let finalId = $('#final-project-agreement-id').val()
    let status = $('#final-project-agreement-status').val()

    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda tidak akan dapat mengembalikannya!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        cancelButtonText: 'Tidak'
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
                url: "project-progress/" + id + "/update",
                type: 'POST',
                data: {
                    '_method': 'PUT',
                    'agreement': 1
                },
                success: function () {
                    Swal.fire(
                            'Verified!',
                            'Telah disetujui!',
                            'success'
                        )
                        .then(function () {
                            progressIndex(finalId, status)
                        });
                }
            });
        }
    })
})

//Schedule
$(document).on('click', '#final-schedule-add', function () {
    let z = 1
    let status = $(this).val()
    let id = $(this).attr('data-target')

    $.ajax({
        url: "../data/final_project/" + id,
        dataType: "json",
        success: function (result) {
            $('#final-project-student').val(result.data.final_student.name)
            $('#final-project-title').val(result.data.title)
            $('#final-project-schedule-hidden-id').val(result.data.id)
            $('#final-project-status').val(status)

            if (status === "tugas_akhir") {
                $("#final-project-examiner-5").toggle()
            }

            $('#final-schedule-modal').modal('show')
            $('#final-schedule-title').text("Tambah Jadwal Seminar Proposal/Sidang TA")
            $('#final-schedule-button').text("Tentukan Jadwal")

            if (result.data.supervisors !== undefined) {
                result.data.supervisors.forEach(function (data) {
                    if (data !== undefined) {
                        $('#supervisor-' + z).val(data.lecturer_id)
                    }
                    z++
                })
            }
        }
    })

})

// $(document).on('click', '#final-project-checked', function () {
//     let document = $('#final-project-schedule-id option').attr('id')

//     $('#student-information-modal').modal('show')
//     $('#final-schedule-modal').modal('hide')
//     if (document !== null) {
//         PDFObject.embed('../../storage/' + document, "#student-information-content")
//         $('#student-information-title').text('Berkas Proposal/Tugas Akhir')
//         $('#student-information-content').css('height', '500')
//     } else {
//         $('#student-information-title').text('Data tidak ditemukan.')
//         $('#student-information-content').html('<img class="w-100" src="../../storage/design/undraw_empty_xct9.png">')
//         $('#student-information-content').css('height', '100%')
//     }
// })

$(document).ready(function () {

    // Examiner
    $.ajax({
        url: "examiner-available",
        type: "GET",
        dataType: "json",
        success: function (lecturers) {
            $('#examiner-name-1').html('')
            $('#examiner-name-2').html('')
            $('#examiner-name-3').html('')
            $('#examiner-name-4').html('')
            $('#examiner-name-5').html('')
            lecturers.forEach(function (result) {
                let data = '<option value="' + result.id + '">' + result.name + '</option>'
                $('#examiner-name-1').append(data)
                $('#examiner-name-2').append(data)
                $('#examiner-name-3').append(data)
                $('#examiner-name-4').append(data)
                $('#examiner-name-5').append(data)
            })
        }
    })
})

// Store Schedule
$(document).on('submit', '#final-schedule-form', function (e) {
    e.preventDefault()

    Swal.fire({
        title: 'Loading',
        timer: 60000,
        onBeforeOpen: () => {
            Swal.showLoading()
        }
    })
    $.ajax({
        url: "final-schedules",
        type: "POST",
        data: new FormData(this),
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
                        window.location.href = 'final_projects/schedules'
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
})
