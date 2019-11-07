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
            data: 'status'
        },
        {
            data: 'is_verified'
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-info verification' id='" + buttonId + "'>Verifikasi</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-warning update' id='" + buttonId + "'>Update</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-danger delete' id='" + buttonId + "'>Delete</button>";
            }
        }
    ],
    "columnDefs": [{
        // targets: [3],
        // render: function (data, type, row) {
        //     if (data == 1) {
        //         return '<span class="badge badge-success p-2">Aktif</span>';
        //     } else {
        //         return '<span class="badge badge-danger p-2">Tidak Aktif</span>';
        //     }
        // }
    }]
});
