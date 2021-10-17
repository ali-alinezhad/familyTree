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

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/clear-cache', function() {
//    Artisan::call('cache:clear');
//    Artisan::call('config:cache');
//    return "Cache is cleared";
//});
Route::group(['middleware' => 'localization'], function () {
    Auth::routes();
    Route::get('/{lang}/home', 'LocalizationController@index')->name('locale');
   //Route::get('/home', 'HomeController@index')->name('home');
    Auth::routes();
    Route::get('/{lang}/home', 'HomeController@index')->name('home');
    Auth::routes();
//    Route::get('/{lang}', 'LocalizationController@index')->name('locale');
    Route::get('/{lang}/home', 'HomeController@index')->name('home');


    // Index HomePage
    Route::get('/', 'IndexController@index')->name('index.page');
    Route::get('/{lang}', 'LocalizationController@index')->name('locale');
    Route::get('/{lang}/index', 'IndexController@index')->name('index');
    Route::get('/{lang}/index/news', 'IndexController@showNews')->name('index.news.show');
    Route::get('/{lang}/index/news/{news}/details', 'IndexController@showNewsDetails')->name('index.news.details');
    Route::get('/{lang}/index/gallery', 'IndexController@ShowGallery')->name('index.gallery.show');
    Route::get('/{lang}/index/gallery/{gallery}/details', 'IndexController@ShowImageDetails')->name('index.gallery.details');
    Route::get('/{lang}/index/about_us', 'IndexController@showAboutUsWithDetails')->name('index.about_us');

    Route::get('/{lang?}/index/login', 'Auth\LoginController@showLoginForm')->name('index.login');

    //Clear cache
    Route::get('/{lang}/clear-cache', 'LocalizationController@clearCache')->name('clear.cache');

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
    Route::get('/{lang}/users/profile/{username}/delete/avatar/{profile?}', 'UsersController@profileDeleteAvatar')->name(
        'users.profile.delete.avatar'
    );


    //Message
    Route::get('/{lang}/message/display/inbox', 'MessageController@index')->name('message.inbox');
    Route::put('/{lang}/message/send/{user}', 'MessageController@sendMessage')->name('message.send');
    Route::post('/message/get-datatable-data', 'MessageController@dataTablesData')->name('message.datatables.data');
    Route::get('/{lang}/message/details/{message}', 'MessageController@showDetails')->name('message.details');
    Route::put('/{lang}/message/reply/{oldMessage}', 'MessageController@replyMessage')->name('message.reply');
    Route::get('/{lang}/message/destroy/{message}', 'MessageController@destroy')->name('message.destroy');


    // Admin HomePage
    Route::get('/{lang}/homepage/edit', 'HomePageController@edit')->name('homepage.edit');
    Route::put('/{lang}/homepage/update', 'HomePageController@update')->name('homepage.update');
    Route::get('/{lang}/homepage/delete/logo', 'HomePageController@deleteLogo')->name('homepage.delete.logo');
    Route::get('/{lang}/homepage/delete/music', 'HomePageController@deleteMusic')->name('homepage.delete.music');
});
