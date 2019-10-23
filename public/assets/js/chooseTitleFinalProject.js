$('#studentTitle').change(function () {
    if ($(this).is(':checked')) {
        $('.lecturer-final-project-title').css('display', 'none');
        $('.student-final-project-title').css('display', 'block');

    }
});
$('#lecturerTitle').change(function () {
    if ($(this).is(':checked')) {
        $('.lecturer-final-project-title').css('display', 'block');
        $('.student-final-project-title').css('display', 'none');
    }
});
