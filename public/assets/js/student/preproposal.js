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
                $('#supervisors-1').append(data);
            });
        }
    });

    $.ajax({
        url: "../supervisor",
        type: "GET",
        dataType: "json",
        success: function (lecturer) {
            lecturer.data.forEach(function (result) {

                let data = '<option value="' + result.id + '">' + result.name + '</option>';
                $('#supervisors-2').append(data);
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
let i = 1;
$('#preproposal-table tbody').on('click', '.update', function () {
    let id = $(this).attr('id');

    $.ajax({
        url: "pre_proposal/" + id,
        dataType: "json",
        success: function (result) {
            console.log(result)
            $('#preproposal-modal').modal('show');
            $('#preproposal-title').text("Update Judul Pra-proposal");
            $('#preproposal-action').text("Update");
            $('#preproposal-id').val(result.id);

            $('#title').val(result.title);
            $('#description').val(result.description);


            result.supervisors.forEach(function (data) {
                $('#supervisors-' + i).val(data.lecturer_id);
                $('#supervisors-role-' + i).val(data.role);
                i++
            })
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

                if (data === "Dosen Full") {
                    Swal.fire({
                        type: 'error',
                        title: 'Kouta dosen telah melampaui batas kuota!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else if (data === "Success") {
                    Swal.fire({
                            type: 'success',
                            title: 'Berhasil!',
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
                        title: 'Gagal menambahkan/memperbaharui judul!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        });
    }
});

//  Supervisor 2
$('#supervisor-check').click(function() {
    $("#add-supervisors-2").toggle(this.checked);
});
