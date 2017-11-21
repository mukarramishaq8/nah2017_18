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


Auth::routes();
Route::post('/auth/login',['as'=>'authLogin','uses'=>'Auth\LoginController@authenticateLogin']);



Route::group(['middleware'=>['App\Http\Middleware\IsEmailVerified']],function(){
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

    Route::get('/personalInformation/save', ['as'=>'personalSave', 'uses'=>'PersonalController@save']);
    Route::post('/personalInformation/saveImage', ['as'=>'personalSaveImage', 'uses'=>'PersonalController@saveImage']);
    
});
