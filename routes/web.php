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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/rules', function () {
    return view('rules');
})->name('rules');

Route::get('/events', 'EventController@event')->name('events');
Route::post('/events', 'EventController@participate');

// Route::get('/static', 'CharController@static')->name('static');




Auth::routes();
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::prefix('forum')->group(function(){
    Route::get('/', 'ForumController@index')->name('forum');
    Route::get('/{cat}', 'ForumController@showCat')->name('forum_cat');
    Route::get('/{cat}/topic', 'ForumController@newTopic')->name('forum_create_topic');
    Route::post('/{cat}/topic', 'ForumController@writeTopic')->name('forum_insert_topic');
    Route::get('/cat/{topic}', 'ForumController@showMessages')->name('forum_messages');
    Route::post('/cat/{topic}', 'ForumController@writeMessage')->name('write_message');
    Route::get('/cat/{topic}/{id}', 'ForumController@DeleteMessage')->name('delete_message');
    Route::get('/user/{id}', 'CharController@member')->name('member');
    Route::get('/{topic}/lock', 'ForumController@lockTopic')->name('lock_topic');
    Route::get('/{topic}/unlock', 'ForumController@unlockTopic')->name('unlock_topic');
    Route::get('/ban/{id}', 'ForumController@banUser')->middleware('adminModo')->name('ban_user');
    Route::get('/unban/{id}', 'ForumController@unban')->middleware('adminModo')->name('unban_user');
});

Route::prefix('admin')->middleware('adminModo')->group(function(){
    Route::get('/', 'AdminController@index')->name('admin');
    Route::post('/listParticipants', 'EventController@listParticipants')->name('list_participants');
    Route::get('/event', 'EventController@addEvent')->name('addEvent');
    Route::post('/event', 'EventController@storeEvent')->name('storeEvent');
    Route::get('/cleanevent', 'EventController@cleanEvent')->name('clean_event');
    Route::post('/changerole', 'AdminController@changeRole')->name('change_role');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
