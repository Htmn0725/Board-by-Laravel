
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

// login
Route::get('/', 'HomeController@index');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/index','MessageController@index');

Route::post('/index/create', 'MessageController@store');

// edit
Route::get('/{id}/edit', 'MessageController@edit');

Route::post('/{id}/edit', 'MessageController@update');

// delete
Route::delete('/index/destroy/{id}', 'MessageController@destroy');

// comment
Route::resource('posts', 'MessageController', ['only' => ['show']]);

Route::resource('comments','CommentsController', ['only' => ['store']] );


