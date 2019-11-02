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

Route::prefix('student')->group(function () {

    Route::view('/', 'students.home')->name('student.home');

    //Pra Proposal
    Route::view('/pre_proposal', 'students.pre_proposal')->name('pre_proposal.index');

    //Tugas Akhir Mahasiswa
    Route::view('/final_project', 'students.final_project')->name('final_project.index');
});

Route::prefix('coordinator')->group(function () {
    Route::view('/', 'coordinators.home')->name('coordinator.home');

    //Tugas Akhir Yang Masih Aktif
    Route::view('/final_projects', 'final_projects.index')->name('final_actives.index');

    //Mahasiswa Yang Mengambil Tugas Akhir
    Route::view('/final_projects/students', 'final_projects.students')->name('final_students.index');

    //Jadwal Seminar/Sidang
    Route::view('/final_projects/schedules', 'final_projects.schedules')->name('final_schedules.index');
});

Route::resource('topic', 'TopicController');

Route::resource('position', 'PositionController');

Route::prefix('data')->group(function () {

    //Data Dosen
    Route::view('/lecturers', 'datas.lecturer')->name('lecturers.index');

    //Data Mahasiswa
    Route::view('/students', 'datas.student')->name('students.index');

    //Data Arsip Tugas Akhir (Yang sudah selesai)
    Route::view('/final_projects', 'datas.final_project')->name('final_inactives.index');
});

Route::prefix('user')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login.index');
    Route::post('/login', 'Auth\LoginController@login')->name('login.store');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'role:admin']], function () {
    Route::view('/test', 'welcome');
});

Route::view('/profile/change_profile', 'profiles.change_profile')->name('change_profile');
Route::view('/profile/change_password', 'profiles.change_password')->name('change_password');
