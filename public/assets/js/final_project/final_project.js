// CSRF 
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Click Button Add
$('#final-project-add').click(function () {
    $('#final-project-form')[0].reset();
    $('#final-project-title').text("Tambah Tugas Akhir");
    $('#final-project-action').text("Tambah");
});

//Fetch datas for update
let i = 1;
$('#final-project-table tbody').on('click', '.update', function () {
    let id = $(this).attr('id');

    $.ajax({
        url: "final_project/" + id,
        dataType: "json",
        success: function (result) {
            console.log(result)
            $('#final-project-modal').modal('show');
            $('#final-project-title').text("Update Tugas Akhir");
            $('#final-project-action').text("Update");
            $('#final-project-id').val(result.id);

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
$(document).on('submit', '#final-project-form', function (e) {
    e.preventDefault();

    //Variables
    let action = $('#final-project-action').text();
    let id = $('#final-project-id').val();
    let url;

    let formData = new FormData(this);

    if (action == "Tambah") {
        url = "final_project";
    } else if (action == "Update") {
        url = "final_project/" + id;
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
                $('#final-project-form')[0].reset();

                if (data !== "Failed") {
                    Swal.fire({
                            type: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        .then(function () {
                            $('#final-project-modal').modal('hide');
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
