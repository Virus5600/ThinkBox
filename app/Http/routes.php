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

// GENERAL -----
// Home
Route::get('/', 'PageController@index')->name('home');
// Announcements
Route::resource('announcements', 'AnnouncementsController');
// GENERAL END -----

// NEEDS AUTH -----
// My Profile
Route::get('/profile/research', 'ProfileController@researchIndex')->name('profile.research');
Route::get('/profile/research/edit', 'ProfileController@researchEdit')->name('profile.research.edit');
Route::get('/profile/innovations', 'ProfileController@innovationsIndex')->name('profile.innovations');
Route::get('/profile/materials', 'ProfileController@materialsIndex')->name('profile.materials');
Route::resource('profile', 'ProfileController');
// Research
Route::get('/researches', 'PageController@researches')->name('research');
// Innovations
Route::get('/innovations', 'PageController@innovations')->name('innovations');
// Faculty
Route::get('/faculty/{id}/research', 'FacultyController@research')->name('faculty.research');
Route::get('/faculty/{id}/innovations', 'FacultyController@innovations')->name('faculty.innovations');
Route::get('/faculty/{id}/materials', 'FacultyController@materials')->name('faculty.materials');
Route::resource('faculty', 'FacultyController');
// NEEDS AUTH END -----