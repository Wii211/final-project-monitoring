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
