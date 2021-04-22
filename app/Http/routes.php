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
// Profile Research
Route::get('/profile/research', 'ProfileController@researchProfileIndex')->name('profile.research');
Route::get('/profile/research/list', 'ProfileController@researchIndex')->name('profile.research.index');

// Profile Innovations
Route::get('/profile/innovations', 'ProfileController@innovationsIndex')->name('profile.innovations');
Route::get('/profile/innovations/list', 'ProfileController@innovationsIndex')->name('profile.innovations.index');

// Profile Materials
Route::get('/profile/materials', 'ProfileController@materialsProfileIndex')->name('profile.materials');
Route::get('/profile/materials/topics', 'ProfileController@materialsIndex')->name('profile.materials.index');

// Profile Materials Topic
Route::get('/profile/materials/topics/{id}', 'ProfileController@materialsTopicIndex')->name('profile.materials.topics.index');

// My Profile
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

// ----- ADMIN SIDE
Route::group(['prefix' => 'admin'], function() {
	// Dashboard
	Route::get('/dashboard', 'PageController@dashboard')->name('dashboard');

	// Faculty Member
	Route::get('/faculty-member/{id}/skills', 'FacultyStaffController@skills')->name('admin.faculty-member.skills');
	Route::get('/faculty-member/{id}/manage-content', 'FacultyStaffController@manageContents')->name('admin.faculty-member.manage-contents');
	Route::get('/faculty-member/{id}/manage-content/{topicId}', 'FacultyStaffController@manageContentsShowTopic')->name('admin.faculty-member.manage-contents.topic');
	Route::resource('faculty-member', 'FacultyStaffController');

	// Announcements
	Route::resource('announcements', 'AdminAnnouncementsController');
});
// ----- ADMIN SIDE END
// NEEDS AUTH END -----