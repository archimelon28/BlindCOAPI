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


Route::get('appointmentStore','ControllerPasien@appointmentStore')->name('appointmentStore');
Route::get('appointment/{id}','ControllerPasien@appointment')->name('appointment');
Route::get('profil/{id}','ControllerPasien@profil')->name('profil');
Route::get('/','ControllerPasien@index');
Route::get('/logout', 'ControllerPasien@logout')->name('logout');
Route::get('/appointmentEdit/{id_appoint}','ControllerPasien@appointmentEdit')->name('appointmentEdit');

// Route::get('/show/{id_user}','ControllerLogin@UpdateUser');
Route::post('/registerPasien','ControllerPasien@registerPasien')->name('registerPasien');
Route::post('/loginPost', 'ControllerPasien@loginPost');
Route::post('/appointmentPost', 'ControllerPasien@appointmentPost')->name('appointmentPost');
Route::post('/appointmentUpdate/{id_appoint}', 'ControllerPasien@appointmentUpdate')->name('appointmentUpdate');
Route::post('profilUpdate/{id}','ControllerPasien@updateProfil')->name('profilUpdate');
