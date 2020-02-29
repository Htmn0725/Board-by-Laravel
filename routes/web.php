
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
// index
Route::resource('/', 'MessageController');

Route::resource('Post', 'MessageController',['only' => ['store']]);

// edit
Route::get('/{id}/edit', 'MessageController@edit');

Route::post('/{id}/edit', 'MessageController@update');

Route::delete('/{id}', 'MessageController@destroy');
