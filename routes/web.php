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
    Route::get('/news/active/{id}', 'NewsController@active')->name('news.active');
    Route::get('/news/passive/{id}', 'NewsController@passive')->name('news.passive');
    Route::resource('/events', 'EventController');
    Route::get('/events/active/{id}', 'EventController@active')->name('events.active');
    Route::get('/events/passive/{id}', 'EventController@passive')->name('events.passive');
    Route::resource('/pages', 'PageController');
    Route::get('/pages/down/{id}', 'PageController@down')->name('pages.down');
    Route::get('/pages/up/{id}', 'PageController@up')->name('pages.up');
    Route::get('/pages/active/{id}', 'PageController@active')->name('pages.active');
    Route::get('/pages/passive/{id}', 'PageController@passive')->name('pages.passive');
    Route::resource('/albums', 'AlbumController');
    Route::get('/albums/active/{id}', 'AlbumController@active')->name('albums.active');
    Route::get('/albums/passive/{id}', 'AlbumController@passive')->name('albums.passive');
    Route::resource('/songs', 'SongController');
    Route::get('/songs/active/{id}', 'SongController@active')->name('songs.active');
    Route::get('/songs/passive/{id}', 'SongController@passive')->name('songs.passive');
    Route::get('/songs/document/{id}', 'SongController@document')->name('songs.document');
    Route::get('/songs/recording/{id}', 'SongController@recording')->name('songs.recording');
    Route::resource('/photo_gallery', 'PhotoGalleryController');
    Route::get('/photo_gallery/active/{id}', 'PhotoGalleryController@active')->name('photo_gallery.active');
    Route::get('/photo_gallery/passive/{id}', 'PhotoGalleryController@passive')->name('photo_gallery.passive');
    Route::resource('/photos', 'PhotoController');
    Route::get('/photos/active/{id}', 'PhotoController@active')->name('photos.active');
    Route::get('/photos/passive/{id}', 'PhotoController@passive')->name('photos.passive');
    Route::resource('/video_gallery', 'VideoGalleryController');
    Route::get('/video_gallery/active/{id}', 'VideoGalleryController@active')->name('video_gallery.active');
    Route::get('/video_gallery/passive/{id}', 'VideoGalleryController@passive')->name('video_gallery.passive');
    Route::resource('/videos', 'VideoController');
    Route::get('/videos/active/{id}', 'VideoController@active')->name('videos.active');
    Route::get('/videos/passive/{id}', 'VideoController@passive')->name('videos.passive');
    Route::resource('/images', 'ImageController');
    Route::get('/images/delete/{id}', ['as' => 'image.delete', 'uses' => 'ImageController@destroy']);
    Route::resource('/settings', 'SettingController');
    Route::resource('/sliders', 'SliderController');
    Route::get('/sliders/active/{id}', 'SliderController@active')->name('sliders.active');
    Route::get('/sliders/passive/{id}', 'SliderController@passive')->name('sliders.passive');
    Route::get('/sliders/down/{id}', 'SliderController@down')->name('sliders.down');
    Route::get('/sliders/up/{id}', 'SliderController@up')->name('sliders.up');
    Route::resource('/partners', 'PartnerController');
    Route::get('/partners/active/{id}', 'PartnerController@active')->name('partners.active');
    Route::get('/partners/passive/{id}', 'PartnerController@passive')->name('partners.passive');
    Route::get('/partners/down/{id}', 'PartnerController@down')->name('partners.down');
    Route::get('/partners/up/{id}', 'PartnerController@up')->name('partners.up');
    Route::resource('/users', 'UserController');
    Route::get('/users/active/{id}', 'UserController@active')->name('users.active');
    Route::get('/users/passive/{id}', 'UserController@passive')->name('users.passive');
    Route::get('/users/role/{id}', 'UserController@role')->name('users.role');
    Route::resource('/advertisements', 'AdvertisementController');
    Route::get('/advertisements/active/{id}', 'AdvertisementController@active')->name('advertisements.active');
    Route::get('/advertisements/passive/{id}', 'AdvertisementController@passive')->name('advertisements.passive');
    Route::resource('/messages', 'MessageController');
    Route::get('/messages/readed/{id}', 'MessageController@readed')->name('messages.readed');
    Route::get('/messages/unreaded/{id}', 'MessageController@unreaded')->name('messages.unreaded');
    Route::post('/messages/replay/{id}', 'MessageController@replay')->name('messages.replay');
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
Route::post('/send', 'ContactController@sendToMessage')->name('contact.sendToMessage');
Route::get('/news', 'HomeController@news')->name('site.news');
Route::get('/news/detail/{id}', 'HomeController@newsDetail')->name('site.newsDetail');
Route::get('/page/{id}/{slug}', 'HomeController@page')->name('site.page');
Route::get('profile', 'HomeController@profile')->name('site.profile')->middleware('verified');
Route::post('profile/{id}', 'HomeController@profileUpdate')->name('site.profileUpdate')->middleware('verified');
Route::get('/songs', 'HomeController@song')->name('site.songs')->middleware('verified');
Route::post('/upload', 'HomeController@upload')->name('site.upload')->middleware('verified');
