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

// Tambah Data
$('#lecturerStore').click(function () {
    $('#lecturerDataForm')[0].reset();
    $('#lecturerModalTitle').text("Tambah Data Dosen Teknologi Informasi");
    $('#lecturerModalButton').text("Tambah");
});



// Posisi
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

// Topik
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

//Ambil Data
$('#fieldTable tbody').on('click', '.update', function () {
    let data = dataTable.row($(this).parents('tr')).data();
    $.ajax({
        url: "https://quequic.space/api/superadmin/field/" + data.id,
        dataType: "json",
        success: function (data) {
            $('#fieldForm')[0].reset();
            $('#fieldModal').modal('show');
            $('#fieldTitle').text("Update Data");
            $('#fieldAction').val("Update");

            //Fetch Data
            $('#fieldName').val(data.field_name)
            $('#fieldId').val(data.id)
        }
    })
});

// $(document).on('click', '#fieldAction', function (event) {
//     event.preventDefault();
//     let buttonAction = $('#fieldAction').val();
//     let type, url;
//     let name = $('#fieldName').val();
//     let id = $('#fieldId').val();
//     let accessId = $('#fieldLastAccessId').val();

//     if (buttonAction == "Add") {
//         type = "POST";
//         url = "https://quequic.space/api/superadmin/field";
//     } else if (buttonAction == "Update") {
//         type = "PUT";
//         url = "https://quequic.space/api/superadmin/field/" + id + "/edit";
//     }


//     if (name !== '') {
//         $.ajax({
//             url: url,
//             type: type,
//             data: {
//                 field_name: name,
//                 last_user_access_id: accessId
//             },
//             success: function (data) {
//                 $('#fieldForm')[0].reset();
//                 $('#fieldModal').modal('hide');
//                 if (data.error == undefined) {
//                     swal(
//                             'Berhasil!',
//                             data.message,
//                             'success'
//                         )
//                         .then(function () {
//                             dataTable.ajax.reload();
//                         });
//                 } else {

//                     swal(
//                         data.message,
//                         '',
//                         'error'
//                     )
//                 }
//             }
//         });
//     } else {
//         swal(
//             '',
//             'Masukkan data secara lengkap!',
//             'error'
//         );
//     }
// });
