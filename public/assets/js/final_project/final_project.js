// CSRF 
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

let dataTable = $('#final-project-table').DataTable({
    "processing": true,
    "ajax": {
        url: "final_project"
    },
    "columns": [{
            data: 'title'
        },
        {
            data: 'final_student.name'
        },
        {
            data: 'created_at'
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-info btn-sm document-show fs-12 w-100' value='proposal' id='" + buttonId + "'>Proposal</button>" + 
                "<button class='btn btn-primary btn-sm document-show fs-12 w-100 mt-2' value='tugas_akhir' id='" + buttonId + "'>Tugas Akhir</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-info btn-sm news-report-proposal fs-12 w-100' id='" + buttonId + "'>Proposal</button>" + 
                "<button class='btn btn-primary btn-sm news-report-final-project fs-12 w-100 mt-2' id='" + buttonId + "'>Tugas Akhir</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id
                return "<button class='btn btn-warning btn-sm update' id='" + buttonId + "'>Update</button>";
            }
        },
        {
            sortable: false,
            "render": function (data, type, full, meta) {
                let buttonId = full.id;
                return "<button class='btn btn-danger btn-sm delete' id='" + buttonId + "'>Delete</button>";
            }
        }
    ]
});

// Click Button Add
$('#final-project-add').click(function () {
    $('#final-project-form')[0].reset();
    $('#final-project-title').text("Tambah Tugas Akhir");
    $('#final-project-action').text("Tambah");
});

//Fetch datas for update
$('#final-project-table tbody').on('click', '.update', function () {
    let bb = 1;
    let id = $(this).attr('id');

    $.ajax({
        url: "final_project/" + id,
        dataType: "json",
        success: function (result) {
            $('#final-project-modal').modal('show');
            $('#final-project-title').text("Update Tugas Akhir");
            $('#final-project-action').text("Update");
            $('#final-project-id').val(result.data.id);
            $('#final-student-id').val(result.data.final_student_id);

            $('#title').val(result.data.title);
            $('#description').val(result.data.description);


            result.data.supervisors.forEach(function (data) {
                $('#supervisors-' + bb).val(data.lecturer_id);
                $('#supervisors-role-' + bb).val(data.role);
                bb++
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
                            title: 'Berhasil!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        .then(function () {
                            $('#final-project-modal').modal('hide');
                            dataTable.ajax.reload();
                        });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        });
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
        url: "../supervisor?primary=false",
        type: "GET",
        dataType: "json",
        success: function (lecturer) {
            lecturer.data.forEach(function (result) {

                let data = '<option value="' + result.id + '">' + result.name + '</option>';
                $('#supervisors-2').append(data);
            });
        }
    });

    $.ajax({
        url: "students",
        type: "GET",
        dataType: "json",
        success: function (students) {
            students.data.forEach(function (result) {

                let data = '<option value="' + result.id + '">' + result.name + '</option>';
                $('#final-student-id').append(data);
            });
        }
    });
});


//Delete
$('#final-project-table tbody').on('click', '.delete', function () {
    let id = $(this).attr("id");

    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda tidak akan dapat mengembalikannya!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "final_project/" + id,
                type: 'DELETE',
                success: function () {
                    Swal.fire(
                            'Deleted!',
                            'Telah dihapus!',
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


// Proposal
function readFinalProjectDocument(finalProjectId, finalStatusName) {
    $.ajax({
        url: 'final-requirement/1',
        type: "GET",
        dataType: "json",
        data: {
            final_project_id: finalProjectId,
            final_status_name: finalStatusName
        },
        success: function (data) {
            $('#student-information-modal').modal('show')

            if (data.document_result !== null && data !== "Failed" && data.document_result !== undefined) {
                PDFObject.embed('../storage/' + data.document_result, "#student-information-content")
                $('#student-information-title').text('Berkas Proposal/Tugas Akhir')
                $('#student-information-content').css('height', '500')
            } else {
                $('#student-information-title').text('Data tidak ditemukan.')
                $('#student-information-content').html('<img class="w-100" src="../storage/design/undraw_empty_xct9.png">')
                $('#student-information-content').css('height', '100%')
            }

        }
    })
}

$(document).on('click', '.document-show', function(){
    const finalProjectId = $(this).attr('id')
    const finalStatusName = $(this).val()

    readFinalProjectDocument(finalProjectId, finalStatusName)
})

let j = 1;
function newsReportProposal(id, name) {
    $.ajax({
        url: "news-report-image/" + id + "?finalStatusName=" + name,
        type: "GET",
        dataType: "json",
        success: function (data) {
            $('#final-news-project-id').val(id);

            $('#news-report-modal').modal('show');
            $('#news-report-image').html('');
            $('#news-report-status').val(name);

            if(data.length !== 0){
                $('#news-report-id').val(data[0].news_report_id);
            }
            data.forEach(function (result) {
                let data = '<div class="gallery-image filtr-item col-sm-3">' +
                    '<button class="btn btn-danger delete-image" id="' + result.id + '"><i class="fa fa-times"></i></button>' +
                    '<img src="../storage/' + result.image + '" class="img-fluid mb-2 fullscreen"></div>';

                    j++;
                $('#news-report-image').append(data);
            });

        }
    });
}

$(document).on('click', '.fullscreen', function(){
    let image = $(this).attr('src');
    $('#news-report-detail-modal').modal('show');

    $('#detail-image').html('<img src="'+ image +'" class="w-100">')
})

$('#final-project-table tbody').on('click', '.news-report-proposal', function () {
    let id = $(this).attr('id');
    newsReportProposal(id, "proposal")
});

// Final-Project
$('#final-project-table tbody').on('click', '.news-report-final-project', function () {
    let id = $(this).attr('id');
    newsReportProposal(id, "tugas_akhir")
});

//Delete
$('#news-report-image').on('click', '.delete-image', function () {
    let id = $(this).attr("id");
    let finalId = $('#final-news-project-id').val();
    let status = $('#news-report-status').val();

    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda tidak akan dapat mengembalikannya!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "news-report-image/" + id,
                type: 'DELETE',
                success: function () {
                    Swal.fire(
                            'Deleted!',
                            'Telah dihapus!',
                            'success'
                        )
                        .then(function () {
                            newsReportProposal(finalId, status)
                        });
                }
            });
        }
    })
});


// Store News Report
$(document).on('submit', '#news-report-form', function (e) {
    e.preventDefault();

    //Variablesx
    let formData = new FormData(this);
    let id = $('#final-news-project-id').val();
    let status = $('#news-report-status').val();
    let url = 'news-report-image';

    if (url !== '') {
        Swal.fire({
            title: 'Loading',
            timer: 600000,
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
                $('#news-report-form')[0].reset();

                if (data !== "Failed") {
                    Swal.fire({
                            type: 'success',
                            title: 'Berhasil!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        .then(function () {
                            newsReportProposal(id, status)
                        });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        });
    }
});