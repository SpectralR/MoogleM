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

Auth::routes(['verify' => true]);

Route::get('/events', 'EventController@event')->middleware('loggedIn', 'verified')->name('events');
Route::post('/events', 'EventController@participate')->middleware('loggedIn', 'verified');

// Route::get('/static', 'CharController@static')->name('static');


Route::get('/dashboard', 'DashboardController@index')->middleware('loggedIn', 'verified')->name('dashboard');

Route::prefix('forum')->group(function(){
    Route::get('/', 'ForumController@index')->name('forum');
    Route::get('/{cat}', 'ForumController@showCat')->middleware('loggedIn', 'verified')->name('forum_cat');
    Route::get('/{cat}/topic', 'ForumController@newTopic')->middleware('loggedIn', 'verified', 'banned')->name('forum_create_topic');
    Route::post('/{cat}/topic', 'ForumController@writeTopic')->middleware('loggedIn', 'verified')->name('forum_insert_topic');
    Route::get('/cat/{topic}', 'ForumController@showMessages')->middleware('loggedIn', 'verified')->name('forum_messages');
    Route::post('/cat/{topic}', 'ForumController@writeMessage')->middleware('loggedIn', 'verified')->name('write_message');
    Route::get('/cat/{topic}/{id}/delete', 'ForumController@DeleteMessage')->middleware('loggedIn', 'verified')->name('delete_message');
    Route::get('/user/{id}', 'CharController@member')->middleware('loggedIn', 'verified')->name('member');
    Route::get('/{topic}/lock', 'ForumController@lockTopic')->middleware('loggedIn', 'verified')->name('lock_topic');
    Route::get('/{topic}/unlock', 'ForumController@unlockTopic')->middleware('loggedIn', 'verified')->name('unlock_topic');
    Route::get('/cat/{topic}/{message}', 'ForumController@updateMessage')->middleware('loggedIn', 'verified')->name('update');
    Route::post('/cat/{topic}/{message}/update', 'ForumController@saveUpdateMessage')->middleware('loggedIn', 'verified')->name('insert_update');
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
