let pathname = window.location.pathname;


if (pathname == '/proyek_pk/public/coordinator') {
    $('#coorHome').addClass('active');
    $('#studentHome').removeClass('active');
} else if (pathname == '/proyek_pk/public/student/pra_proposal') {
    $('#studentProposal').addClass('active');
    $('#studentHome').removeClass('active');
} else if (pathname == '/proyek_pk/public/student/final_project') {
    $('#studentFinalProject').addClass('active');
    $('#studentHome').removeClass('active');
} else if (pathname == '/proyek_pk/public/coordinator/final_project/students') {
    $('#coorFinalProjectStudent').addClass('active');
    $('#studentHome').removeClass('active');
} else if (pathname == '/proyek_pk/public/final_project') {
    $('#finalProject').addClass('active');
    $('#studentHome').removeClass('active');
} else if (pathname == '/proyek_pk/public/coordinator/final_project') {
    $('#coorFinalProject').addClass('active');
    $('#studentHome').removeClass('active');
} else if (pathname == '/proyek_pk/public/coordinator/final_project/schedules') {
    $('#coorFinalProjectSchedule').addClass('active');
    $('#studentHome').removeClass('active');
} else if (pathname == '/proyek_pk/public/lecturer') {
    $('#lecturerHome').addClass('active');
    $('#studentHome').removeClass('active');
} else if (pathname == '/proyek_pk/public/data/lecturers') {
    $('#lecturer').addClass('active');
    $('#studentHome').removeClass('active');
} else if (pathname == '/proyek_pk/public/data/students') {
    $('#student').addClass('active');
    $('#studentHome').removeClass('active');
} else if (pathname == '/proyek_pk/public/data/informations') {
    $('#information').addClass('active');
    $('#studentHome').removeClass('active');
} else if (pathname == '/proyek_pk/public/lecturer/supervised') {
    $('#lecturerSupervised').addClass('active');
    $('#studentHome').removeClass('active');
} else if (pathname == '/proyek_pk/public/lecturer/examined') {
    $('#lecturerExamined').addClass('active');
    $('#studentHome').removeClass('active');
} else if (pathname == '/proyek_pk/public/profile/change_profile') {
    $('#changeProfile').addClass('active');
    $('#studentHome').removeClass('active');
} else if (pathname == '/proyek_pk/public/profile/change_password') {
    $('#changePassword').addClass('active');
    $('#studentHome').removeClass('active');
} else {
    $('#studentHome').addClass('active');
}
