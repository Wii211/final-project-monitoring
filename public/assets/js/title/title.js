$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#addRecommendationTitle').click(function () {
    $('#recomendationTitleForm')[0].reset();
    $('#recomendationTitleModalTitle').text("Tambah Data Rekomendasi Judul");
    $('#recomendationTitleModalButton').text("Tambah");
});

function getTopics(id, value) {
    let data = '<option value="' + id + '">' + value + '</option>';
    $('#topics').append(data);
}

function getLecturers(id, value) {
    let data = '<option value="' + id + '">' + value + '</option>';
    $('#lecturers').append(data);
}

$('#recommendationTitleTable tbody').on('click', '#fetch-title-action', function () {

    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Pengambilan judul akan kembali divalidasi oleh Koordinator TA",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $("#fetch-title-form").submit();
        }
    })

})

$(document).ready(function () {
    $.ajax({
        url: "topic",
        type: "GET",
        dataType: "json",
        success: function (topic) {
            topic.forEach(function (result) {
                getTopics(result.id, result.name);
            });
        }
    });

    $.ajax({
        url: "data/lecturers",
        type: "GET",
        dataType: "json",
        success: function (lecturer) {
            lecturer.data.forEach(function (result) {
                getLecturers(result.id, result.name);
            });
        }
    })
});

//Fetch
$('#recommendationTitleTable tbody').on('click', '.update', function () {
    let id = $(this).attr("id");
    let topicData = [];

    $.ajax({
        url: "recomendation-title/" + id,
        dataType: "json",
        success: function (result) {
            console.log(result)
            $('#recomendationTitleModal').modal('show');
            $('#recomendationTitleModalTitle').text("Update Data Rekomendasi Judul");
            $('#recomendationTitleModalButton').text('Update');

            result.topics.forEach(function (topic) {
                topicData.push(topic.id);
            })
            $('#topics').val(topicData);
            $('#title').val(result.title);
            $('#description').val(result.description);
            $('#lecturers').val(result.lecturer_id);
            $('#recommendationTitleId').val(result.id);

        }
    })
});

//Add
$(document).on('submit', '#recomendationTitleForm', function (e) {
    e.preventDefault();
    let action = $('#recomendationTitleModalButton').text();
    let id = $('#recommendationTitleId').val();

    let url;
    let formData = new FormData(this);

    if (action == "Tambah") {
        url = "recomendation-title"
    } else if (action == "Update") {
        url = "recomendation-title/" + id
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
                $('#recomendationTitleForm')[0].reset();
                if (data === "success") {
                    Swal.fire({
                            type: 'success',
                            title: 'Data berhasil dieksekusi',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        .then(function () {
                            window.location.reload();
                            $('#recomendationTitleModal').modal('hide');
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
$('#recommendationTitleTable tbody').on('click', '.delete', function () {
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
            $.ajax({
                url: "recomendation-title/" + id,
                type: 'DELETE',
                success: function () {
                    Swal.fire(
                            'Berhasil!',
                            'Rekomendasi judul telah dihapus!',
                            'success'
                        )
                        .then(function () {
                            window.location.reload();
                        });
                }
            });
        }
    })
});

//accept
$('#recommendationTitleTable tbody').on('click', '.accept', function () {
    let id = $(this).attr("id");

    Swal.fire({
        title: 'Apakah anda yakin?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "coordinator/accept-recomendation-title/" + id,
                type: 'POST',
                data: {
                    '_method': 'PUT'
                },
                success: function () {
                    Swal.fire(
                            'Accepted!',
                            'Mahasiswa telah disetujui untuk mengambil judul tersebut.',
                            'success'
                        )
                        .then(function () {
                            window.location.reload();
                        });
                }
            });
        }
    })
});


//Delete
$('#recommendationTitleTable tbody').on('click', '.decline', function () {
    let id = $(this).attr("id");

    Swal.fire({
        title: 'Apakah anda yakin?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "coordinator/decline-recomendation-title/" + id,
                type: 'DELETE',
                success: function () {
                    Swal.fire(
                            'Sukses!',
                            'Mahasiswa telah ditolak untuk mengambil judul tersebut.',
                            'success'
                        )
                        .then(function () {
                            window.location.reload()
                        })
                }
            });
        }
    })
})
