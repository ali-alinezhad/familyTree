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

    // Tree
    Route::get('/{lang}/tree', 'TreeController@index')->name('tree');

    // News
    Route::get('/{lang}/news', 'NewsController@index')->name('news');

    // Users
    Route::get('/{lang}/users', 'UsersController@index')->name('users');
    Route::post('/users/get-datatable-data', 'UsersController@dataTablesData')->name('users.datatables.data');
    Route::get('/{lang}/users/profile/edit/{username?}', 'UsersController@profileEdit')->name('users.profile');
    Route::put('/{lang}/users/profile/{user}/update/{profile?}', 'UsersController@profileUpdate')->name('users.profile.update');
    Route::get('/{lang}/users/destroy/{user}', 'UsersController@destroy')->name('users.destroy');
    Route::put('/{lang}/users/info/update/{user}', 'UsersController@userInfoUpdate')->name('users.info.update');
    Route::get('/{lang}/users/role/change/{user}', 'UsersController@changeUserRole')->name('users.role.change');
    Route::get('/{lang}/users/details/{user}', 'UsersController@showDetails')->name('users.details');

    //Message
    Route::get('/{lang}/message/display/inbox', 'MessageController@index')->name('message.inbox');
    Route::put('/{lang}/message/send/{user}', 'MessageController@sendMessage')->name('message.send');
    Route::post('/message/get-datatable-data', 'MessageController@dataTablesData')->name('message.datatables.data');
    Route::get('/{lang}/message/details/{message}', 'MessageController@showDetails')->name('message.details');
    Route::put('/{lang}/message/reply/{oldMessage}', 'MessageController@replyMessage')->name('message.reply');
    Route::get('/{lang}/message/destroy/{message}', 'MessageController@destroy')->name('message.destroy');


});
