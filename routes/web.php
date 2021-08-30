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

Route::group(['middleware'=>'localization'],function () {
    Auth::routes();
    Route::get('/{lang}/home', 'LocalizationController@index')->name('locale');
    Route::get('/home', 'HomeController@index')->name('home');
    Auth::routes();
    Route::get('/{lang}/home', 'HomeController@index')->name('home');
    Auth::routes();
    Route::get('/{lang}', 'LocalizationController@index')->name('locale');
    Route::get('/{lang}/home', 'HomeController@index')->name('home');

    // Gallery
    Route::get('/{lang}/gallery', 'GalleryController@index')->name('gallery');
    Route::put('/{lang}/gallery/upload', 'GalleryController@upload')->name('gallery.upload');
    Route::get('/{lang}/gallery/{gallery}/edit', 'GalleryController@edit')->name('gallery.edit');
    Route::put('/{lang}/gallery/{gallery}/update', 'GalleryController@update')->name('gallery.update');
    Route::get('/{lang}/gallery/{gallery}/delete', 'GalleryController@delete')->name('gallery.delete');
    Route::get('/{lang}/gallery/{gallery}/details', 'GalleryController@details')->name('gallery.details');

    // News
    Route::get('/{lang}/news', 'NewsController@index')->name('news');
    Route::put('/{lang}/news/create', 'NewsController@create')->name('news.create');
    Route::get('/{lang}/news/{news}/edit', 'NewsController@edit')->name('news.edit');
    Route::put('/{lang}/news/{news}/update', 'NewsController@update')->name('news.update');
    Route::get('/{lang}/news/{news}/delete', 'NewsController@delete')->name('news.delete');
    Route::get('/{lang}/news/{news}/details', 'NewsController@details')->name('news.details');
    Route::get('/{lang}/news/{news}/delete/image', 'NewsController@deleteImage')->name('news.delete.image');

    // Users
    Route::get('/{lang}/users', 'UsersController@index')->name('users');
    Route::post('/users/get-datatable-data', 'UsersController@dataTablesData')->name('users.datatables.data');
    Route::get('/{lang}/users/destroy/{user}', 'UsersController@destroy')->name('users.destroy');
    Route::put('/{lang}/users/info/update/{user}', 'UsersController@userInfoUpdate')->name('users.info.update');
    Route::get('/{lang}/users/role/change/{user}', 'UsersController@changeUserRole')->name('users.role.change');
    Route::get('/{lang}/users/details/{user}', 'UsersController@showDetails')->name('users.details');

    // User Profile
    Route::get('/{lang}/users/profile/edit/{username?}', 'UsersController@profileEdit')->name('users.profile');
    Route::put('/{lang}/users/profile/{user}/update/{profile?}', 'UsersController@profileUpdate')->name('users.profile.update');
    Route::get('/{lang}/users/profile/{username}/delete/avatar/{profile?}', 'UsersController@profileDeleteAvatar')->name('users.profile.delete.avatar');

    //Message
    Route::get('/{lang}/message/display/inbox', 'MessageController@index')->name('message.inbox');
    Route::put('/{lang}/message/send/{user}', 'MessageController@sendMessage')->name('message.send');
    Route::post('/message/get-datatable-data', 'MessageController@dataTablesData')->name('message.datatables.data');
    Route::get('/{lang}/message/details/{message}', 'MessageController@showDetails')->name('message.details');
    Route::put('/{lang}/message/reply/{oldMessage}', 'MessageController@replyMessage')->name('message.reply');
    Route::get('/{lang}/message/destroy/{message}', 'MessageController@destroy')->name('message.destroy');

    // HomePage
    Route::get('/{lang}/homepage', 'HomePageController@index')->name('homepage');
});
