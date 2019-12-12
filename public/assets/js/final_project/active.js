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
                return "<button class='btn btn-primary progress-detail' id='" + buttonId + "'>Progress</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-info detail' id='" + buttonId + "'>Detail</button>";
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
});