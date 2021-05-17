<?php

use Illuminate\Support\Facades\Route;

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
//Route::get('/{lang}', function ($lang) {
//    \Illuminate\Support\Facades\App::setlocale($lang);
//    return view('home');
//});


//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//
//    Route::get('/gallery', 'GalleryController@index')->name('gallery');
//    Route::get('/tree', 'TreeController@index')->name('tree');
//    Route::get('/news', 'NewsController@index')->name('news');

Route::group(['middleware'=>'localization'],function () {
    Auth::routes();

    Route::get('/{lang}/home', 'LocalizationController@index')->name('locale');
    Route::get('/home', 'HomeController@index')->name('home');

    Auth::routes();

    Route::get('/{lang}/home', 'HomeController@index')->name('home');
    Auth::routes();
    Route::get('/{lang}', 'LocalizationController@index')->name('locale');
    Route::get('/{lang}/home', 'HomeController@index')->name('home');

    Route::get('/{lang}/gallery', 'GalleryController@index')->name('gallery');
    Route::get('/{lang}/tree', 'TreeController@index')->name('tree');
    Route::get('/{lang}/news', 'NewsController@index')->name('news');
});

//Route::middleware(['localization'])->group(function () {
//    Auth::routes();
//
//    Route::get('/{lang}/home', 'HomeController@index')->name('home');
//
//    Auth::routes();
//
//    Route::get('/{lang}/home', 'HomeController@index')->name('home');
//    Auth::routes();
//
//    Route::get('/{lang}/home', 'HomeController@index')->name('home');
//
//    Route::get('/{lang}/gallery', 'GalleryController@index')->name('gallery');
//    Route::get('/{lang}/tree', 'TreeController@index')->name('tree');
//    Route::get('/{lang}/news', 'NewsController@index')->name('news');
//});
