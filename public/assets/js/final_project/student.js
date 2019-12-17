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
    "columns": [{
            data: 'student_id'
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                image = full.user.image_profile
                return "<img src='../../storage/" + image + "' class='img-circle'>";
            }
        },
        {
            data: 'name'
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-info student-information fs-12' value='transcript' id='" + buttonId + "'>Transkrip</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-info student-information fs-12' value='latest_study' id='" + buttonId + "'>SKS Terakhir</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let status = full.is_verified;
                let buttonId = full.id;
                if (status == 0) {
                    return "<button class='btn btn-success verification' id='" + buttonId + "' value='" + status + "'>Verification</button>";
                } else {
                    return "<button class='btn btn-danger verification' id='" + buttonId + "' value='" + status + "'>Unverification</button>";
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
            if (status === "transcript") {
                PDFObject.embed('../../storage/' + data.transcript, "#student-information-content")
                $('#student-information-title').text('Transkrip')
            } else {
                PDFObject.embed('../../storage/' + data.latest_study_plan, "#student-information-content")
                $('#student-information-title').text('SKS Terakhir')
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
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, do it!'
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