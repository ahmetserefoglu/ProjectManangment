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

Route::get('/lang/{locale}', 'HomeController@lang');

Route::get('/translations', 'HomeController@translations');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/react', 'HomeController@react')->name('home');
Route::get('/users', 'HomeController@react')->name('home');
Route::get('/deneme', 'HomeController@react')->name('home');
Route::get('/home', 'HomeController@react')->name('home');
Route::get('/github', 'HomeController@react')->name('home');
Route::get('/add', 'HomeController@react')->name('home');
Route::get('/articles', 'HomeController@react')->name('home');
Route::get('/add-item', 'HomeController@react')->name('home');
Route::get('/display-item', 'HomeController@react')->name('home');

Route::resource('yontemler', 'DepartmentController');
Route::group(['prefix' => 'admin', ['middleware' => 'auth:api']], function () {
	Route::get('/ayarlar', 'HomeController@ayarlar')->name('home');
	Route::get('/dersler', 'HomeController@dersler')->name('home');
	Route::get('/profile', 'HomeController@profile')->name('home');
	Route::get('/okulyonetimi/siniflar', 'HomeController@siniflar')->name('home');
	Route::get('/okulyonetimi/siniflar/list/{sinif?}', 'HomeController@siniflarlist')->name('home');
	Route::get('/mesajlar', 'HomeController@mesajlar')->name('home');
	Route::get('/sendmesaj', 'HomeController@sendMessage')->name('home');
	Route::resource('/mesaj', 'MesajlarController');
	Route::get('/kullanicilar', 'HomeController@kullanici')->name('home');
	Route::get('/kullanicirolleri', 'HomeController@kullaniciRolleri')->name('home');
	Route::get('/kullaniciekle', 'HomeController@kullaniciEkle')->name('home');
	Route::get('/bildirimler', 'HomeController@bildirim')->name('home');

});

Route::get('sendsms', 'SmsController@index');
Route::post('send-sms', 'SmsController@store')->name('sms.send');
Route::post('verify-user', 'SmsController@verifyContact')->name('sms.verify');

Route::get('/file', 'HomeController@files');
Route::get('/palet', 'HomeController@palet');
Route::get('list/file/', 'FilesController@listFiles');
Route::get('list/file/{id}', 'FilesController@listFileId');
Route::post("upload/file", "FilesController@upload");
Route::post("delete/file", 'FilesController@delete');
Route::get('/data', 'HomeController@datatables')->name('home');

Route::get('/testet', 'HomeController@test')->name('home');

Route::get('/vuetask', 'HomeController@vuetask')->name('home');

Route::get('/shopping', 'HomeController@shop')->name('home');

Route::get('/profile/{id}', 'ProfilController@profile')->name('home');
Route::post('profile/{id}/update', 'ProfilController@update');

Route::get('image-gallery', 'ImageGalleryController@index');

Route::post('image-gallery', 'ImageGalleryController@upload');

Route::post('ogretmen/upload/file', 'OgretmenController@upload');

Route::delete('image-gallery/{id}', 'ImageGalleryController@destroy');

Route::get('upload-image', 'FileController@index');

Route::post('upload-image', ['as' => 'image.upload', 'uses' => 'FileController@uploadImages']);

Route::resource('firmalar', 'FirmalarController');

Route::resource('gorusmeler', 'GorusmeController');

Route::resource('projeler', 'ProjeController');

Route::resource('gorevler', 'GorevController');

Route::resource('/faturalar', 'FaturaController');
Route::post('/faturalar/send', 'FaturaController@send')->name('faturalar.send');

Route::get('gallery/list', 'GalleryController@viewGalleryList');
Route::post('gallery/save', 'GalleryController@saveGallery');
Route::get('gallery/delete/{id}', 'GalleryController@deleteGallery');
Route::get('gallery/view/{id}', 'GalleryController@viewGalleryPics');
Route::post('image/do-upload', 'GalleryController@doImageUpload');

Route::get('admin/dosyalar/{projeid}', 'ProjeController@dosyalar');

Route::get('projeler/detay/{id}', 'ProjeController@detay');
Route::get('projeler/kisiler/{id}', 'ProjeController@kisiler');
Route::get('projeler/dosya/{id}', 'ProjeController@dosya');
Route::post('projeler/projedurumekle/{id}', 'ProjeController@projedurumekle')->name('projeler.projedurumekle');
Route::post('projeler/projedurumguncelle/{id}', 'ProjeController@projedurumguncelle')->name('projeler.projedurumguncelle');
Route::post('projeler/projekisidetayguncelle/{id}', 'ProjeController@projekisidetayguncelle')->name('projeler.projekisidetayguncelle');
Route::post('projeler/upload', 'ProjeController@upload')->name('projeler.upload');
Route::post('projeler/projekisidurumekle/{id}', 'ProjeController@projekisidurumekle')->name('projeler.projekisidurumekle');
Route::get('projeler/kisiler/{id}/create', 'ProjeController@projedurumkisi')->name('projeler.projedurumkisi');
Route::get('projeler/detay/{id}/create', 'ProjeController@projedurum');
Route::get('projeler/detay/{id}/update', 'ProjeController@projedetayguncelle');
Route::get('projeler/kisiler/{id}/update', 'ProjeController@projekisiguncelle');

Route::get('firmalar/{id}', 'FirmalarController@sehirler');

Route::get('fileupload', 'HomeController@fileupload');
//Route::get('projedurum/create', 'FileUploadController@fileekle');
Route::get('fileupload/view/{id}', 'FileUploadController@show');
//Route::get('projedurum', 'FileUploadController@filelist');
Route::post('proje/upload', 'FileUploadController@store')->name('proje.upload');
Route::post('upload', 'FileUploadController@upload')->name('upload');
Route::get('etkinlik2', 'EventController@taskEvent');

Route::get('etkinlik', 'EventController@index')->name('events.index');
Route::post('etkinlik', 'EventController@addEvent')->name('events.add');

Route::get('/gantt', 'GanttController@gantt');
Route::group(['prefix' => 'api', 'middleware' => 'auth:api'], function () {

	Route::resource('/note', 'NoteController');

});

Route::resource('/tasks', 'TaskController');
Route::post('tasks_ajax_update', 'TaskController@ajaxUpdate')->name('appointments.ajax_update');
Route::resource('/items', 'ItemController');
Route::resource('/reactuser', 'ReactController');
Route::resource('/test', 'TestController');

# Call Route
Route::get('payment', ['as' => 'payment', 'uses' => 'PaymentController@payment']);

# Status Route
Route::get('payment/status', ['as' => 'payment.status', 'uses' => 'PaymentController@status']);