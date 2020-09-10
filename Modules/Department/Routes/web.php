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

Route::prefix('department')->group(function() {
    Route::get('/', 'DepartmentController@index')->name('department.a');
});
Route::POST('/showdepart', 'DepartmentController@store')->name('showdepart');
Route::get('/adddepart','DepartmentController@create')->name('adddepart');
Route::get('/next','DepartmentController@next')->name('department.next');
Route::get('/search/{id}','DepartmentController@show')->name('departshow');
Route::get('addremove/{id}','DepartmentController@edit')->name('addremove');
Route::POST('update/{id}','DepartmentController@update')->name('departmentupdate');
Route::Get('delete/{id}', 'DepartmentController@destroy')->name('departmentdelete');

