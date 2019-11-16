$(document).ready(function () {
    $.ajax({
        url: "../lecturers?primary=true",
        type: "GET",
        dataType: "json",
        success: function (data) {
            console.log(data);
            // position.data.forEach(function (result) {
            //     let data = '<option value="' + id + '">' + value + '</option>';
            //     $('#positions').append(data);
            // });
        }
    });
});
