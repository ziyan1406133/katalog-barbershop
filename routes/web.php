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

Auth::routes();

Route::get('/', 'HomeController@homepage')->name('dashboard');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

Route::resource('/user', 'UserController');
Route::resource('/barbershop', 'BarbershopController');
Route::resource('/hairstyle', 'HairstyleController');
Route::resource('/setting', 'SettingController');

Route::get('/peta', 'MapController@index')->name('peta.index');



Route::get('/barbershopguest', 'BarbershopController@guestindex')->name('barbershop.guest');
Route::get('/pending', 'BarbershopController@pending')->name('barbershop.pending');

//dynamic select form
Route::get('/json-regencies','BarbershopController@regencies');
Route::get('/json-districts', 'BarbershopController@districts');

//edit password
Route::get('/editpassword/{id}/user', 'UserController@editpassword')->name('edit');
Route::put('/editpassword/{id}', 'UserController@editpassword1')->name('password');


Route::put('/verifikasi/{id}/barbershop', 'BarbershopController@verify')->name('barbershop.verify');
Route::put('/tolak/{id}/barbershop', 'BarbershopController@tolak')->name('barbershop.tolak');


Route::put('/barbershop/search', 'BarbershopController@search')->name('barbershop.search');