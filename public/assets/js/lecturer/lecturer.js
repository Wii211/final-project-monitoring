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
    "order": [[ 6, "asc" ]],
    "columns": [{
            data: 'personnel_id'
        },
        {
            data: 'lecturer_id'
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                image = full.image_profile

                if(image !== null){
                    return "<img src='../storage/images/" + image + "' class='img-circle'>";
                } else {
                    return "<img src='../storage/image_profile/default.png' class='img-circle'>";
                }
            }
        },
        {
            data: 'name'
        },
        {
            data: 'primary_supervisors_count'
        },
        {
            data: 'secondary_supervisors_count'
        },
        {
            data: 'status'
        },
        // {
        //     sortable: false,
        //     "render": function (data, type, full, meta) {
        //         let buttonId = full.id;
        //         return "<button class='btn btn-info detail' id='" + buttonId + "'>Detail</button>";
        //     }
        // },
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
        targets: [6],
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
            topic.forEach(function (result) {
                getTopics(result.id, result.name);
            });
        }
    });
});

function topicLecturer(name) {
    let data = '<li>' + name + '</li>';
    $('#detailTopic').append(data);
}

function detailLecturer(personnel, id, name, phone, email, status, lastEducation, position,
    positionPrimary, image) {
    $('#lecturerModalTitle').text("Update Data Dosen Teknologi Informasi");
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
    $('#detailPhoto').attr('src', '../storage/images/' + image);
    $('#detailTopic').html("");
}

//Detail
$('#lecturerTable tbody').on('click', '.detail', function () {
    let id = $(this).attr("id");
    $.ajax({
        url: "lecturers/" + id,
        dataType: "json",
        success: function (result) {
            $('#lecturerDetail').modal('show');

            // Detail
            detailLecturer(result.data.personnel_id, result.data.lecturer_id,
                result.data.name, result.data.phone_number, result.data.email,
                result.data.status, result.data.last_education, result.data.position.name,
                result.data.position.is_primary, result.data.image_profile)

            // Topic
            result.data.topics.forEach(function (topic) {
                topicLecturer(topic.name)
            })
        }
    })
});

function fetchLecturer(id, personnel, lecturerId, name, phone, email, status, position, lastEducation) {
    $('#lecturerPersonalId').val(personnel);
    $('#lecturerLecturerId').val(lecturerId);
    $('#lecturerName').val(name);
    $('#lecturerNumber').val(phone);
    $('#lecturerEmail').val(email);
    $('#lecturerLastEduction').val(lastEducation);
    $('#positions').val(position);
    $('#lecturerModalButton').text("Update");
    $('#lecturerStatus').val(status);
    $('#lecturerId').val(id)
    // $('#lecturerTopic').val(topics);
}

//Fetch
$('#lecturerTable tbody').on('click', '.update', function () {
    let id = $(this).attr("id");
    let topicData = []
    $.ajax({
        url: "lecturers/" + id,
        dataType: "json",
        success: function (result) {
            $('#lecturerModal').modal('show')
            fetchLecturer(result.data.id, result.data.personnel_id, result.data.lecturer_id,
                result.data.name, result.data.phone_number, result.data.email,
                result.data.status, result.data.position.id,
                result.data.last_education)

            // Topic
            result.data.topics.forEach(function (topic) {
                topicData.push(topic.id);
            })
            $('#topics').val(topicData);

        }
    })
});

//Add
$(document).on('submit', '#lecturerDataForm', function (e) {
    e.preventDefault();
    let action = $('#lecturerModalButton').text();
    let id = $('#lecturerId').val();
    let url;
    let formData = new FormData(this);

    if (action == "Tambah") {
        url = "lecturers"
    } else if (action == "Update") {
        url = "lecturers/" + id
        formData.append("_method", "PUT");
    }



    if (url !== '') {
        Swal.fire({
            title: 'Loading',
            timer: 60000,
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        });

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#lecturerDataForm')[0].reset();
                if (data === "Success") {
                    Swal.fire({
                            type: 'success',
                            title: 'Data berhasil dieksekusi',
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
                        title: 'Gagal data dieksekusi',
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
        title: 'Apakah anda yakin?',
        text: "Anda tidak akan dapat mengembalikannya!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: 'Loading',
                timer: 60000,
                onBeforeOpen: () => {
                    Swal.showLoading()
                }
            })
            $.ajax({
                url: "lecturers/" + id,
                type: 'DELETE',
                success: function () {
                    Swal.fire(
                            'Deleted Id ' + id + '!',
                            'Status dosen telah diubah menjadi tidak aktif',
                            'success'
                        )
                        .then(function () {
                            dataTable.ajax.reload();
                        });
                }
            });
        }
    })
});
