$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function progressIndex(id, status) {
    let no = 1

    $.ajax({
        url: "project-progress/" + id,
        data: {
            'final_status': status
        },
        success: function (result) {
            $('#final-project-status').val(status)
            $('#final-project-progress-id').val(id)
            $('#final-project-progress-modal').modal('show')
            $('#final-project-progress-table tbody').html('')
            if (result !== "failed") {
                result.data.forEach(function (result) {
                    let status

                    if (result.agreement === 1) {
                        status = '<span class="badge badge-success p-2">Disetujui</span>'
                    } else {
                        status = '<span class="badge badge-danger p-2">Belum disetujui</span>'
                    }

                    let data = '<tr>' +
                        '<td>' + no + '</td>' +
                        '<td>' + result.created_at + '</td>' +
                        '<td>' + result.description + '</td>' +
                        '<td>' + status + '</td>' +
                        '<td><button class="btn bg-gradient-danger btn-sm w-100 progress-delete" id="' + result.id + '">' +
                        '<span class="fas fa-times"></span></button></td>' +
                        '</tr>'

                    no++
                    $('#final-project-progress-table tbody').append(data)
                })
            }
        }
    })
}

// Agreement
$('#final-project-table tbody').on('click', '.progress-input', function () {
    let id = $(this).attr("id")
    let status = $(this).val()
    progressIndex(id, status)
})

// Store
$(document).on('submit', '#final-project-progress-form', function (e) {
    e.preventDefault();
    let finalProjectId = $('#final-project-progress-id').val()
    let status = $('#final-project-status').val()
    let url = 'project-progress'
    let formData = new FormData(this);

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
            $('#final-project-progress-form')[0].reset();
            if (data !== "Failed") {
                Swal.fire({
                        type: 'success',
                        title: "Progres berhasil ditambahkan",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    .then(function () {
                        progressIndex(finalProjectId, status)
                    });
            } else {
                Swal.fire({
                    type: 'error',
                    title: "Progres gagal ditambahkan",
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    })
})


//Delete
$('#final-project-progress-table tbody').on('click', '.progress-delete', function () {
    let id = $(this).attr("id");
    let finalProjectId = $('#final-project-progress-id').val()
    let status = $('#final-project-status').val()

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
            })

            $.ajax({
                url: "project-progress/" + id,
                type: 'DELETE',
                success: function () {
                    Swal.fire(
                            'Deleted!',
                            'Telah dihapus!',
                            'success'
                        )
                        .then(function () {
                            progressIndex(finalProjectId, status)
                        });
                }
            });
        }
    })
});


$(document).on('click', '.submit-final-project', function(){
    let id = $(this).attr("id")

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, submit it!'
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
                url: "final-log",
                type: 'POST',
                data: {
                    'final_project_id': id,
                    'status': 'tugas_akhir'
                },
                success: function () {
                    Swal.fire(
                            'Berhasil!',
                            'Telah diajukan!',
                            'success'
                        )
                        .then(function () {
                            window.location.reload()
                        });
                }
            });
        }
    })
})

$(document).on('click', '.submit-schedule', function(){
    let finalId = $(this).attr('id')
    let status = $(this).val()
    
    $('#final-schedule-modal').modal('show')
    $('#final-log-id').val(finalId)
    $('#final-status-name').val(status)
    $('#final-schedule-title').val('Pengajuan Seminar Proposal')
    $('#upload-document-name').text('Upload Berkas Proposal (.pdf)')
})

//Submit Berkas
$(document).on('submit', '#final-schedule-form', function (e) {
    e.preventDefault()
    let formData = new FormData(this);

    Swal.fire({
        title: 'Loading',
        timer: 60000,
        onBeforeOpen: () => {
            Swal.showLoading()
        }
    });

    $.ajax({
        url: 'final-requirement',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            $('#final-schedule-modal').modal('hide')
            if (data !== "Failed") {
                Swal.fire({
                        type: 'success',
                        title: "Berkas persyaratan berhasil ditambahkan",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    .then(function () {
                        window.location.reload()
                    });
            } else {
                Swal.fire({
                    type: 'error',
                    title: "Berkas gagal ditambahkan",
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    })
})


