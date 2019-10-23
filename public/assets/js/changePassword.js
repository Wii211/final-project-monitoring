//Confirm Password
$('#password').keyup(function () {
    let min = 8;
    let max = 16;
    $("#password").attr('minlength', min);
    $("#password").attr('maxlength', max);
    let pass = $('#password').val();

    if (pass.length < min) {
        $('#password').addClass('is-invalid');
        $('#passwordStatus').addClass('invalid-feedback').html("Password terlalu pendek!");
    } else if (pass.length > max) {
        $('#password').addClass('is-invalid');
        $('#passwordStatus').addClass('invalid-feedback').html("Passwrod terlalu panjang!");
    } else {
        $('#password').removeClass('is-invalid');
        $('#passwordStatus').removeClass('invalid-feedback').html("");
    }
});

$('#confirmPassword').keyup(function () {
    let pass = $('#password').val();
    let confirm = $('#confirmPassword').val();

    if (pass == confirm) {
        $('#confirmPassword').addClass('is-valid').removeClass('is-invalid');
        $('#confirmStatus').addClass('valid-feedback').removeClass('invalid-feedback').html("Password cocok!");
    } else {
        $('#confirmPassword').addClass('is-invalid').removeClass('is-valid');
        $('#confirmStatus').addClass('invalid-feedback').removeClass('valid-feedback').html("Password tidak cocok!")
    }
});

//Change Password
// $(document).on('submit', '#changePassword', function (e) {
//     e.preventDefault();
//     let formData = new FormData(this);
//     formData.append('_method', 'PUT');

//     $.ajax({
//         url: "https://quequic.space/api/patient/change-password",
//         type: "POST",
//         data: formData,
//         contentType: false,
//         processData: false,
//         success: function (data) {
//             if (data.error == undefined) {
//                 swal(
//                         'Berhasil!',
//                         data.message,
//                         'success'
//                     )
//                     .then(function () {
//                         window.location.reload();
//                     });
//             } else {

//                 swal(
//                     data.message,
//                     '',
//                     'error'
//                 )
//             }
//         }
//     })
// });
