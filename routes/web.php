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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'middleware' => 'admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('logout', 'AdminController@logout')->name('admin.logout');
    Route::resource('/news', 'NewsController');
    Route::resource('/events', 'EventController');
    Route::resource('/pages', 'PageController');
    Route::get('/pages/down/{id}', 'PageController@down')->name('pages.down');
    Route::get('/pages/up/{id}', 'PageController@up')->name('pages.up');
    Route::resource('/albums', 'AlbumController');
    Route::resource('/songs', 'SongController');
    Route::get('/songs/document/{id}', 'SongController@document')->name('songs.document');
    Route::get('/songs/recording/{id}', 'SongController@recording')->name('songs.recording');
    Route::resource('/photo_gallery', 'PhotoGalleryController');
    Route::resource('/photos', 'PhotoController');
    Route::resource('/video_gallery', 'VideoGalleryController');
    Route::resource('/videos', 'VideoController');
    Route::resource('/images', 'ImageController');
    Route::get('/images/delete/{id}', ['as' => 'image.delete', 'uses' => 'ImageController@destroy']);
    Route::resource('/settings', 'SettingController');
    Route::resource('/sliders', 'SliderController');
    Route::get('/sliders/down/{id}', 'SliderController@down')->name('sliders.down');
    Route::get('/sliders/up/{id}', 'SliderController@up')->name('sliders.up');
    Route::resource('/partners', 'PartnerController');
    Route::get('/partners/down/{id}', 'PartnerController@down')->name('partners.down');
    Route::get('/partners/up/{id}', 'PartnerController@up')->name('partners.up');
    Route::resource('/users', 'UserController');
    Route::get('/users/status/{id}', 'UserController@status')->name('users.status');
    Route::get('/users/role/{id}', 'UserController@role')->name('users.role');
    Route::resource('/advertisements', 'AdvertisementController');
});

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('site.index')->middleware('checkstatus');
Route::get('logout', 'HomeController@logout')->name('site.logout');
Route::get('/events', 'HomeController@event')->name('site.events');
Route::get('/events/detail/{id}', 'HomeController@eventDetail')->name('site.eventDetail');
Route::get('/photoGallery', 'HomeController@photoGallery')->name('site.photoGallery');
Route::get('/photoGallery/detail/{id}', 'HomeController@photoGalleryDetail')->name('site.photoGalleryDetail');
Route::get('/videoGallery', 'HomeController@videoGallery')->name('site.videoGallery');
Route::get('/videoGallery/detail/{id}', 'HomeController@videoGalleryDetail')->name('site.videoGalleryDetail');
Route::get('/album', 'HomeController@album')->name('site.albums')->middleware('verified');
Route::get('/album/detail/{id}', 'HomeController@albumDetail')->name('site.albumDetail')->middleware('verified');
Route::get('/download/document/{id}', 'HomeController@document')->name('download.document')->middleware('verified');
Route::get('/download/recording/{id}', 'HomeController@recording')->name('download.recording')->middleware('verified');
Route::get('/contact', 'ContactController@index')->name('contact.index');
Route::post('/send', 'ContactController@sendToEMail')->name('contact.sendToEMail');
Route::get('/news', 'HomeController@news')->name('site.news');
Route::get('/news/detail/{id}', 'HomeController@newsDetail')->name('site.newsDetail');
Route::get('/page/{id}/{slug}', 'HomeController@page')->name('site.page');
Route::get('profile', 'HomeController@profile')->name('site.profile')->middleware('verified');
Route::post('profile/{id}', 'HomeController@profileUpdate')->name('site.profileUpdate')->middleware('verified');
