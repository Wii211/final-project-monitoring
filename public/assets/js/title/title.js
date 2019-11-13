// $('#title-table tbody').on('submit', '#field-title', function (e) {
//     e.preventDefault();
//     let role = 1;
//     let lecturer = $('#lecturerId').val();

//     let supervisors = {
//         'lecturer': lecturer,
//         'role': role
//     };
//     let formData = new FormData(this);

//     formData.append('supervisors', supervisors);

//     $.ajax({
//         type: "POST",
//         data: formData,
//         contentType: false,
//         processData: false
//     })

// })
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

    $.ajax({
        url: "recomendation-title/" + id,
        dataType: "json",
        success: function (result) {
            console.log(result);
            $('#recomendationTitleModal').modal('show');
            $('#recomendationTitleModalButton').text('Update');

            // Topic
            // result.data.topics.forEach(function (topic) {
            //     topicData.push(topic.id);
            // })
            // $('#topics').val(topicData);

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
            timer: 2000,
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
                if (data === "Success") {
                    Swal.fire({
                            type: 'success',
                            title: 'Data berhasil dieksekusi',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        .then(function () {
                            dataTable.ajax.reload();
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
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "recomendation-title/" + id,
                type: 'DELETE',
                success: function () {
                    Swal.fire(
                            'Deleted Id ' + id + '!',
                            'Rekomendasi judul telah dihapus!',
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
