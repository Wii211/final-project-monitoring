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
            data: 'name'
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


//Update
$('#finalStudentTable tbody').on('click', '.verification', function () {
    let id = $(this).attr("id");
    let status = $(this).val();
    let method;

    if (status == 1) {
        method = "DELETE";
    } else if (status == 0) {
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
                type: "POST",
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
