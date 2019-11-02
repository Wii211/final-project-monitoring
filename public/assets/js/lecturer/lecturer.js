$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

let dataTable = $('#lecturerTable').DataTable({
    "processing": true,
    "ajax": {
        url: "http://localhost/program_pk/public/data/lecturers",
        // dataSrc: ""
    },
    "columns": [{
            data: 'personnel_id'
        },
        {
            data: 'lecturer_id'
        },
        {
            data: 'name'
        },
        {
            data: 'status'
        },
        {
            "defaultContent": "<button class='btn btn-warning update'>Update</button>"
        },
        {
            "defaultContent": "<button class='btn btn-warning update'>Update</button>"
        },
        {
            "defaultContent": "<button class='btn btn-warning update'>Update</button>"
        }
    ]
});
