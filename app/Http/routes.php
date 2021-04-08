<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PageController@index')->name('home');
Route::get('/researches', 'PageController@researches')->name('research');
Route::get('/innovations', 'PageController@innovations')->name('innovations');
Route::get('/faculty', 'PageController@faculty')->name('faculty');

// Announcements
// Route::get('/announcements', 'AnnouncementsController@index')->name('announcements');
Route::resource('announcements', 'AnnouncementsController');