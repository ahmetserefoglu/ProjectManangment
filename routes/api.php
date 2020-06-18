<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});





Route::group(['prefix'=>'v1',['middleware'=>'auth:api']],function(){

    Route::resource('/users', 'UserController');
    Route::resource('/roles', 'RoleController');
    Route::resource('/ogretmen', 'OgretmenController');
    Route::resource('/veliler', 'VeliController');
    Route::resource('/ogrenci', 'OgrenciController');
    Route::resource('/okul', 'OkulController');
    Route::resource('/ders', 'DerslerController');
    Route::resource('/sinif', 'SinifController');
    Route::resource('/iletisim', 'IletisimBilgisiController');
    Route::resource('/okulogretmen', 'OkulOgretmenController');
    Route::resource('/okulplanlama', 'OkulPlanlamaController');
    Route::resource('/okulsinifplanlama', 'OkulSinifPlanlamaController');
    Route::resource('/okulveli', 'OkulVeliController');
    Route::get('/data', 'GanttController@get');
    Route::resource('task', 'GorevController');
    Route::resource('link', 'LinkController');
    
    Route::resource('/duyuru', 'DuyuruController');
});