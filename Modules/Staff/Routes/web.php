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


Route::prefix('staff')->group(function() {
    Route::get('/', 'StaffController@index')->name('staff.a');
});
    Route::post('/add','StaffController@store')->name('staffadd');
    Route::get('/addstaff','StaffController@create')->name('addstaff');
    Route::post('/addstaff','StaffController@validationform')->name('addstaff');
    Route::get('/edit/{id}', 'StaffController@edit')->name('editstaff');
    Route::PATCH('/update/{id}', 'StaffController@update')->name('updatestaff');
    Route::delete('/delete/{id}/{pid}', 'StaffController@destroy')->name('destroystaff');
    Route::post('/search','StaffController@show')->name('showstaff');
    Route::get('/ajaxdata','StaffController@getdata')->name('staff.b');
