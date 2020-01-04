// Store
$(document).on('submit', '#import-form', function (e) {
    e.preventDefault();

    //Variables
    let formData = new FormData(this);

    Swal.fire({
        title: 'Loading',
        timer: 600000,
        onBeforeOpen: () => {
            Swal.showLoading()
        }
    });

    $.ajax({
        url: 'final-student-import',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            $('#import-form')[0].reset();

            if (data.error == undefined) {
                Swal.fire({
                        type: 'success',
                        title: data.success,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    .then(function () {
                        dataTable.ajax.reload();
                        $('#import-modal').modal('hide');
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
});