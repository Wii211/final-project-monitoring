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
Route::view('/home', 'welcome');

Route::group(
    ['prefix' => 'student', 'middleware' => ['auth', 'role:mahasiswa']],
    function () {

        Route::get('/', 'FinalRegistrationController@index')
            ->name('final_registration.index');

        Route::post('/final_registration', 'FinalRegistrationController@store')
            ->name('final_registration.store');



        //Pra Proposal

        Route::resource('/pre_proposal', 'PreProposalController');

        //Tugas Akhir Mahasiswa
        // Route::view('/final_project', 'students.final_project')->name('final_project.index');

        Route::resource('/final_project', 'FinalProjectController');
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

        Route::put('/final_projects/students/{student}', 'FinalStudentVerifyController@update')
            ->name('final_students_verify.update');

        Route::delete('/final_projects/students/{student}', 'FinalStudentVerifyController@destroy')
            ->name('final_students_verify.destroy');

        Route::resource('dead-line', 'DeadlineScheduleController');


        //Jadwal Seminar/Sidang
        Route::view('/final_projects/schedules', 'final_projects.schedules')->name('final_schedules.index');
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
        Route::resource('/final_project', 'FinalProjectDataController');

        Route::post('/final-student-import', 'FinalStudentImportController@store')
            ->name('final_import.store');
    }
);

Route::prefix('user')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login.index');
    Route::post('/login', 'Auth\LoginController@login')->name('login.store');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
});

Route::resource('recomendation-title', 'RecomendationTitleController');

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'role:admin']], function () {
    Route::view('/test', 'welcome');
});


Route::group(['prefix' => '/profile'], function () {

    Route::resource('/change_profile', 'ProfileController');
    Route::resource('/change_password', 'PasswordController');
});
