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

Route::get('/', 'JournalController@get_todays_visit');
Route::get('/calendar/{year}-{month}-{date}', 'JournalController@get_date_lectures');
Route::get('/calendar/{year}-{month}', 'JournalController@get_months_lectures');
Route::get('/calendar/{year}', 'JournalController@get_year_lectures');
Route::get('/lectures', 'JournalController@get_all_lectures');
Route::get('/students', 'JournalController@get_all_students');
Route::get('/students/{id}', 'JournalController@get_specific_student');
Route::post('/add_student', 'JournalController@add_student');
Route::post('/add_lecture', 'JournalController@add_lecture');