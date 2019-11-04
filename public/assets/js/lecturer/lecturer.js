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
                return "<button class='btn btn-info detail' id='" + buttonId + "'>Detail</button>";
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
            topic.data.forEach(function (result) {
                getTopics(result.id, result.name);
            });
        }
    });
});

function topicLecturer(name) {
    let data = '<li>' + name + '</li>';
    $('#detailTopic').append(data);
}

function detailLecturer(personnel, id, name, phone, email, status, lastEducation, position, positionPrimary) {
    $('#detailPersonalId').text(personnel);
    $('#detailLecturerId').text(id);
    $('#detailName').text(name);
    $('#detailPhoneNumber').text(phone);
    $('#detailEmail').text(email);
    $('#detailEducation').text(lastEducation);
    if (status === 1) {
        $('#detailStatus').text("Dosen Aktif");
    } else {
        $('#detailStatus').text("Tidak Aktif");
    }
    $('#detailPosition').text(position);
    if (positionPrimary === 1) {
        $('#supervisor').html('<i class="fa fa-check" aria-hidden="true"></i>')
    } else {
        $('#supervisor').html('<i class="fa fa-times" aria-hidden="true"></i>')
    }
    $('#detailTopic').html("");
}

function fetchLecturer(personnel, id, name, phone, email, status, position, topics, lastEducation) {
    $('#lecturerPersonalId').val(personnel);
    $('#lecturerLecturerId').val(id);
    $('#lecturerName').val(name);
    $('#lecturerNumber').val(phone);
    $('#lecturerEmail').val(email);
    $('#lecturerLastEduction').val(lastEducation);
    $('#lecturerPosition').val(position);
    $('#lecturerStatus').val(status);
    $('#lecturerTopic').val(topics);
}

//Detail
$('#lecturerTable tbody').on('click', '.detail', function () {
    let id = $(this).attr("id");
    $.ajax({
        url: "lecturers/" + id,
        dataType: "json",
        success: function (result) {
            console.log(result)
            $('#lecturerDetail').modal('show');

            // Detail
            detailLecturer(result.data.personnel_id, result.data.lecturer_id,
                result.data.name, result.data.phone_number, result.data.email,
                result.data.status, result.data.last_education, result.data.position.name, result.data.position.is_primary)

            // Topic
            result.data.topics.forEach(function (topic) {
                topicLecturer(topic.name)
            })
        }
    })
});

//Fetch
$('#lecturerTable tbody').on('click', '.update', function () {
    let id = $(this).attr("id");
    $.ajax({
        url: "lecturers/" + id,
        dataType: "json",
        success: function (result) {
            $('#lecturerModal').modal('show')

            fetchLecturer(result.data.personnel_id, result.data.lecturer_id,
                result.data.name, result.data.phone_number, result.data.email,
                result.data.status, result.data.position.id, result.data.topics.id)


        }
    })
});

//Add
$(document).on('submit', '#lecturerDataForm', function (e) {
    e.preventDefault();
    let action = $('#lecturerModalButton').text();
    let id = '',
        type, url;

    if (action == "Tambah") {
        type = "POST";
        url = "lecturers"
    } else if (action == "Update") {
        type = "PUT";
    }


    if (type !== '') {
        Swal.fire({
            title: 'Loading',
            timer: 2000,
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        });

        $.ajax({
            url: url,
            type: type,
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#lecturerDataForm')[0].reset();
                if (data.error == undefined) {
                    Swal.fire({
                            type: 'success',
                            title: 'Data telah ditambahkan',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        .then(function () {
                            dataTable.ajax.reload();
                            $('#lecturerModal').modal('hide');
                        });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Gagal menambahkan data',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        });
    }
});


//Delete
$('#lecturerTable tbody').on('click', '.delete', function () {
    let id = $(this).attr("id");

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
            Swal.fire(
                    'Deleted! Id' + id,
                    'Your file has been deleted.',
                    'success'
                )
                .then(function () {
                    dataTable.ajax.reload();
                });
        }
    })
});
