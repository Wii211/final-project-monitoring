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
Route::view('/homie', 'welcome');

// :(((())))
Route::prefix('student')->group(function () {

    Route::view('/', 'homes.student')->name('home.student');
    Route::view('/final_project', 'final_projects.final_projects')->name('final.final_project');
    Route::view('/pra_proposal', 'final_projects.pra_proposal')->name('final.pra_proposal');
});

Route::prefix('coordinator')->group(function () {
    Route::view('/', 'homes.coordinator')->name('home.coordinator');
    Route::view('/final_project', 'final_projects.for_coordinator')->name('final.for_coordinator');
    Route::view('/final_project/students', 'final_projects.students')->name('final.student');
    Route::view('/final_project/schedules', 'final_projects.schedules')->name('final.schedule');
});

Route::prefix('lecturer')->group(function () {
    Route::view('/', 'homes.lecturer')->name('home.lecturer');
    Route::view('/supervised', 'students.supervised')->name('student.supervised');
    Route::view('/examined', 'students.examined')->name('student.examined');
});

Route::resource('topic', 'TopicController');

Route::resource('position', 'PositionController');

Route::prefix('data')->group(function () {
    // Route::view('/lecturers', 'datas.lecturer')->name('lecturer');
    Route::get('/lecturers', 'LecturerController@index')->name('lecturer');
    Route::view('/students', 'datas.student')->name('student');
    Route::view('/informations', 'datas.information')->name('information');
});

Route::prefix('user')->group(function () {

    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login.index');

    Route::post('/login', 'Auth\LoginController@login')->name('login.store');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'role:admin']], function () {
    Route::view('/test', 'welcome');
});

Route::view('/final_project', 'final_projects.datas')->name('final.datas');
Route::view('/profile/change_profile', 'profiles.change_profile')->name('change_profile');
Route::view('/profile/change_password', 'profiles.change_password')->name('change_password');
