// CSRF 
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $.ajax({
        url: "../supervisor?primary=true",
        type: "GET",
        dataType: "json",
        success: function (lecturer) {
            lecturer.data.forEach(function (result) {

                let data = '<option value="' + result.id + '">' + result.name + '</option>';
                $('#lecturers-primary').append(data);
            });
        }
    });

    $.ajax({
        url: "../supervisor?primary=false",
        type: "GET",
        dataType: "json",
        success: function (lecturer) {
            lecturer.data.forEach(function (result) {

                let data = '<option value="' + result.id + '">' + result.name + '</option>';
                $('#lecturers').append(data);
            });
        }
    });
});

// Click Button Add
$('#preproposal-add').click(function () {
    $('#preproposal-form')[0].reset();
    $('#preproposal-title').text("Pengajuan Judul Pra-proposal");
    $('#preproposal-action').text("Ajukan");
});

//Fetch datas for update
$('#preproposal-table tbody').on('click', '.update', function () {
    let id = $(this).attr('id');

    $.ajax({
        // url: "preproposals/" + id + "/edit",
        dataType: "json",
        success: function (result) {
            $('#preproposal-modal').modal('show');
            $('#preproposal-title').text("Update Judul Pra-proposal");
            $('#preproposal-action').text("Update");

        }
    })
});

// Store
$(document).on('submit', '#preproposal-form', function (e) {
    e.preventDefault();

    //Variables
    let action = $('#preproposal-action').text();
    let id = $('#preproposal-id').val();
    let url;

    let formData = new FormData(this);

    if (action == "Ajukan") {
        url = "pre_proposal";
    } else if (action == "Update") {
        url = "pre_proposal/" + id;
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
                $('#preproposal-form')[0].reset();

                if (data.error == undefined) {
                    Swal.fire({
                            type: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        .then(function () {
                            $('#preproposal-modal').modal('hide');
                            window.location.reload();
                        });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: data.error,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        });
    }
});
