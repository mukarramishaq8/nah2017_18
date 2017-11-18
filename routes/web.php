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
    return view('welcome');
});

Route::get('/logintest', function () {
    return view('loginTest');
});

Route::get('/registertest', function () {
    return view('registerTest');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/personalInformation',function(){
    return view('personalInformation');
});

Route::get('/educationalInformation',function(){
    return view('educationalInformation');
});

Route::get('/professionalInformation',function(){
	return view('professionalInformation');
});
