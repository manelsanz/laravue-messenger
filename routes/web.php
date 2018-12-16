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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/chat', 'ChatController@index')->name('chat');
Route::get('/chat/{conversationId}', 'ChatController@index');

Route::get('/profile', 'ProfileController@edit')->name('profile.edit');
Route::patch('/profile', 'ProfileController@update')->name('profile.update');


Route::get('/api/conversations', 'ConversationController@index')->name('conversations.index');
Route::get('/api/messages', 'MessageController@index')->name('messages.index');
Route::post('/api/messages', 'MessageController@store')->name('messages.store');

