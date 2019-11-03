$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

let dataTable = $('#lecturerTable').DataTable({
    "processing": true,
    "ajax": {
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
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-info detail'" + buttonId + "'>Detail</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-warning update'" + buttonId + "'>Update</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-danger delete'" + buttonId + "'>Delete</button>";
            }
        }
    ],
    "columnDefs": [{
        targets: [3],
        render: function (data, type, row) {
            if (data == 1) {
                return '<span class="badge badge-success p-2">Aktif</span>';
            } else {
                return '<span class="badge badge-danger p-2">Tidak Aktif</span>';
            }
        }
    }]
});

$('#lecturerStore').click(function () {
    $('#lecturerDataForm')[0].reset();
    $('#lecturerModalTitle').text("Tambah Data Dosen Teknologi Informasi");
    $('#lecturerModalButton').text("Tambah");
});



// Position
function getPositions(id, value) {
    let data = '<option value="' + id + '">' + value + '</option>';
    $('#positions').append(data);
}

$(document).ready(function () {
    $.ajax({
        url: "../position",
        type: "GET",
        dataType: "json",
        success: function (position) {
            console.log(position)
            position.data.forEach(function (result) {
                getPositions(result.id, result.name);
            });
        }
    });
});

// Topic
function getTopics(id, value) {
    let data = '<option value="' + id + '">' + value + '</option>';
    $('#topics').append(data);
}

$(document).ready(function () {
    $.ajax({
        url: "../topic",
        type: "GET",
        dataType: "json",
        success: function (topic) {
            console.log(topic)
            topic.data.forEach(function (result) {
                getTopics(result.id, result.name);
            });
        }
    });
});

//Fetch
$('#lecturerTable tbody').on('click', '.update', function () {
    let id = $(this).attr("id");
    $.ajax({
        url: "" + id,
        dataType: "json",
        success: function (data) {}
    })
});

//Add
$('#lecturerTable tbody').on('click', '#lecturerStore', function (e) {
    e.preventDefault();
    let action = $('#lecturerModalButton').text();
    let id = "",
        type, url;

    if (action == "Tambah") {
        type = "POST";
        url = "";
    } else if (action == "Update") {
        type = "PUT";
        url = "";
    }


    if (id !== '') {
        $.ajax({
            url: url,
            type: type,
            success: function (data) {
                $('#lecturerDataForm')[0].reset();
                $('#lecturerModal').modal('hide');
                if (data.error == undefined) {
                    swal(
                            'Berhasil!',
                            data.message,
                            'success'
                        )
                        .then(function () {
                            dataTable.ajax.reload();
                        });
                } else {

                    swal(
                        data.message,
                        '',
                        'error'
                    )
                }
            }
        });
    }
});
