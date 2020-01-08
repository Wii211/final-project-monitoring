$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

let dataTable = $('#finalStudentTable').DataTable({
    "processing": true,
    "ajax": {
        // dataSrc: ""
    },
    "order": [[ 5, "desc" ]],
    "columns": [{
            data: 'student_id'
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                image = full.user.image_profile

                if(image !== null){
                    return "<img src='../../storage/" + image + "' class='img-circle'>";
                } else {
                    return "<img src='../../storage/image_profile/default.png' class='img-circle'>";
                }
            }
        },
        {
            data: 'name'
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-info btn-transcript student-information fs-12' value='transcript' id='" + buttonId + "'>Transkrip</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-info btn-latest-study student-information fs-12' value='latest_study' id='" + buttonId + "'>KRS Terakhir</button>";
            }
        },
        {
            "render": function (data, type, full, meta) {
                let status = full.is_verified;
                let buttonId = full.id;
                if (status == 0) {
                    return "<button class='btn btn-success verification fs-12 w-100' id='" + buttonId + "' value='" + status + "'>Verifikasi</button>";
                } else {
                    return "<button class='btn btn-danger verification fs-12 w-100' id='" + buttonId + "' value='" + status + "'>Batalkan Verifikasi</button>";
                }
            }
        }
    ]
});

$('#finalStudentTable tbody').on('click', '.student-information', function () {
    let id = $(this).attr("id")
    let status = $(this).val()

    $.ajax({
        url: "students/" + id,
        success: function (data) {
            $('#student-information-modal').modal('show')
                if (status === "transcript" && data.transcript !== null) {
                    PDFObject.embed('../../storage/' + data.transcript, "#student-information-content")
                    $('#student-information-title').text('Transkrip')
                    $('#student-information-content').css('height', '500')
                } else if(data.latest_study_plan !== null) {
                    PDFObject.embed('../../storage/' + data.latest_study_plan, "#student-information-content")
                    $('#student-information-title').text('SKS Terakhir')
                    $('#student-information-content').css('height', '500')
                } else {
                    $('#student-information-title').text('Data tidak ditemukan.')
                    $('#student-information-content').html('<img class="w-100" src="../../storage/design/undraw_empty_xct9.png">')
                    $('#student-information-content').css('height', '100%')
                }
        }
    })
})

//Update
$('#finalStudentTable tbody').on('click', '.verification', function () {
    let id = $(this).attr("id");
    let status = $(this).val();
    let method, type;

    if (status == 1) {
        type = "DELETE";
        method = "DELETE";
    } else if (status == 0) {
        type = "POST";
        method = "PUT";
    }

    Swal.fire({
        title: 'Apakah anda yakin?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "students/" + id,
                type: type,
                data: {
                    "_method": method
                },
                success: function () {
                    Swal.fire(
                            'Berhasil',
                            '',
                            'success'
                        )
                        .then(function () {
                            dataTable.ajax.reload();
                        });
                }
            })
        }
    });
});