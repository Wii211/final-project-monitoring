$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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

                full.final_project.final_logs.forEach(function (data){
                    console.log(data.final_status.name)
                    status = data.final_status.name
                })

                return '<span class="badge badge-primary p-2">' + status + '</span>'
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-success verification' id='" + buttonId + "'>Verifikasi</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-primary progress-agreement' id='" + buttonId + "'>Progress</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-warning update' id='" + buttonId + "'>Update</button>";
            }
        }
    ]
})

// Verification
$('#final-project-table tbody').on('click', '.verification', function () {
    $('#final-project-verification-modal').modal('show')
})

$('#final-status-table tbody').on('click', '.final-status-check', function () {
    let id = $(this).attr("id");
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
            $.ajax({
                // url: "news-report-image/" + id,
                // type: 'DELETE',
                success: function () {
                    Swal.fire(
                            'Verified!',
                            'Telah dihapus!',
                            'success'
                        )
                        .then(function () {
                            // newsReportProposal(finalId, status)
                        });
                }
            });
        }
    })
})

// Agreement
$('#final-project-table tbody').on('click', '.progress-agreement', function () {
    $('#final-progress-agreement-modal').modal('show')
})