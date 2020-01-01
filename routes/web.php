<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect()->route('login.index');
});

Route::group(
    ['prefix' => 'student', 'middleware' => ['auth', 'role:mahasiswa']],
    function () {



        Route::get('/', 'FinalRegistrationController@index')
            ->name('final_registration.index');

        Route::post('/final_registration', 'FinalRegistrationController@store')
            ->name('final_registration.store');

        Route::post('/project-progress', 'FinalProgressController@store')
            ->name('project-progress.store');
        Route::get('/project-progress/{finalProjectId}', 'FinalProgressController@show')
            ->name('project-progress.show');

        Route::delete('/project-progress/{finalProjectId}', 'FinalProgressController@destroy')
            ->name('project-progress.destroy');

        Route::resource('final-log', 'FinalLogController');

        Route::post('/final-requirement', 'FinalRequirementController@store')
            ->name('final-requirement.store');


        Route::group(
            ['middleware' => ['auth', 'verify']],
            function () {
                Route::resource('/pre_proposal', 'PreProposalController');
                Route::resource('/final_project', 'FinalProjectController');
                Route::resource('recomendation-title', 'RecomendationTitleController');
            }
        );

        //Pra Proposal



        //Tugas Akhir Mahasiswa
        // Route::view('/final_project', 'students.final_project')->name('final_project.index');


    }
);

Route::group(
    ['prefix' => 'coordinator', 'middleware' => ['auth', 'role:koordinator']],
    function () {
        Route::get('/', 'DeadlineScheduleController@index')
            ->name('coordinator_dashboard.index');

        //Tugas Akhir Yang Masih Aktif
        Route::view('/final_projects', 'final_projects.index')->name('final_actives.index');

        //Mahasiswa Yang Mengambil Tugas Akhir
        // Route::view('/final_projects/students', 'final_projects.students')->name('final_students_verify.index');
        Route::get('/final_projects/students', 'FinalStudentVerifyController@index')
            ->name('final_students_verify.index');

        Route::get('/final_projects/students/{student}', 'FinalStudentVerifyController@show')
            ->name('final_students_verify.show');

        Route::put('/final_projects/students/{student}', 'FinalStudentVerifyController@update')
            ->name('final_students_verify.update');

        Route::delete('/final_projects/students/{student}', 'FinalStudentVerifyController@destroy')
            ->name('final_students_verify.destroy');

        Route::resource('dead-line', 'DeadlineScheduleController');

        Route::resource('finished-project', 'FinishedFinalProjectController');

        Route::resource('examiner-available', 'ExaminerController');

        //Jadwal Seminar/Sidang
        Route::view('/final_projects/schedules', 'final_projects.schedules')->name('final_schedules.index');

        Route::get('/monitoring', 'FinalProjectMonitoringController@index')
            ->name('monitoring.index');

        Route::get('/student-status/{finalProjectId}', 'FinalLogStudentController@show')
            ->name('student-status.show');

        Route::put('/student-status/{id}/verify', 'FinalLogStudentController@update')
            ->name('student-status.update');

        Route::get('/project-progress/{finalProjectId}', 'FinalProgressController@show')
            ->name('project-progress-coordinator.show');

        Route::put('/project-progress/{finalProjectId}/update', 'FinalProgressController@update')
            ->name('project-progress-coordinator.update');

        Route::resource('final-schedules', 'FinalScheduleController');

        Route::put('accept-recomendation-title/{recomendationTitleId}', 'RecomendationTitleProcessController@update');

        Route::delete('decline-recomendation-title/{recomendationTitleId}', 'RecomendationTitleProcessController@destroy');

        Route::put('accept-thesis-defence/{id}', 'FinalScheduleStatusController@update');

        Route::delete('decline-thesis-defence/{id}', 'FinalScheduleStatusController@destroy');

        Route::get('/news-report-proposal/{finalProjectId}', 'NewsReportProposalController@show')
            ->name('news-report-proposal.show');

        Route::get('/news-report-final-project/{finalProjectId}', 'NewsReportFinalProjectController@show')
            ->name('news-report-finalproject.show');
    }
);

Route::resource('topic', 'TopicController');

Route::resource('position', 'PositionController');

Route::resource('supervisor', 'SupervisorController');

Route::group(
    ['prefix' => 'data', 'middleware' => ['auth', 'role:admin']],
    function () {

        //Data Dosen
        // Route::view('/lecturers', 'datas.lecturer')->name('lecturers.index');
        Route::resource('lecturers', 'LecturerController');

        //Data Mahasiswa
        Route::resource('students', 'FinalStudentController');

        //Data Arsip Tugas Akhir (Yang sudah selesai)
        Route::view('/final_projects', 'datas.final_project')->name('final_projects.index');
        Route::resource(
            '/final_project',
            'FinalProjectDataController',
            [
                'as' => 'data'
            ]
        );

        Route::get('/final-requirement/{id}', 'FinalRequirementController@show')
            ->name('final-requirement.show');

        Route::post('/final-student-import', 'FinalStudentImportController@store')
            ->name('final_import.store');
        Route::resource('news-report-image', 'NewsReportImageController');
    }
);

Route::prefix('user')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login.index');
    Route::post('/login', 'Auth\LoginController@login')->name('login.store');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
});

Route::resource(
    'recomendation-title',
    'RecomendationTitleController',
    [
        'as' => 'coordinator'
    ]
);

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'role:admin']], function () {
    Route::view('/test', 'welcome');
});


Route::group(['prefix' => '/profile'], function () {

    Route::resource('/change_profile', 'ProfileController');
    Route::resource('/change_password', 'PasswordController');
});
