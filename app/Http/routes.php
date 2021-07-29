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
// Route::get('announcements', 'AnnouncementsController@index')->name('announcements.index');
Route::resource('announcements', 'AnnouncementsController');

// Research
Route::get('/researches/view/{id}', 'PageController@researchShow')->name('research.show');
Route::get('/researches', 'PageController@researches')->name('research');
Route::post('/researches/view/{id}/request-copy', 'ResearchController@requestCopy')->name('research.request_copy');

// Innovations
Route::get('/innovations/view/{id}', 'PageController@innovationShow')->name('innovations.show');
Route::get('/innovations', 'PageController@innovations')->name('innovations');
Route::post('/innovations/view/{id}/request-copy', 'InnovationController@requestCopy')->name('innovations.request_copy');

// Faculty
Route::get('/faculty/{id}/research', 'FacultyController@research')->name('faculty.research');
Route::get('/faculty/{id}/innovations', 'FacultyController@innovations')->name('faculty.innovations');
Route::get('/faculty/{id}/materials', 'FacultyController@materials')->name('faculty.materials');
Route::resource('faculty', 'FacultyController');

// LOGIN RELATED
Route::get('/redirect-login', 'PageController@redirectLogin')->name('redirect-login');
Route::get('/login', 'UserController@login')->name('login');
Route::get('/register', 'UserController@register')->name('register');
Route::post('/login', 'UserController@authenticate')->name('authenticate');
Route::get('/logout', 'UserController@logout')->name('logout');
// GENERAL END -----

// NEEDS AUTH -----
Route::group(['middleware' => ['auth']], function() {
	// Profile Research
	Route::get('/profile/research', 'UserController@researchProfileIndex')->name('profile.research');
	Route::get('/profile/research/list', 'UserController@researchIndex')->name('profile.research.index');
	Route::get('/profile/research/create', 'UserController@researchCreate')->name('profile.research.create');
	Route::get('/profile/research/edit/{id}', 'UserController@researchEdit')->name('profile.research.edit');
	Route::post('/profile/research/create/store', 'UserController@researchStore')->name('profile.research.store');
	Route::post('/profile/research/edit/{id}/update', 'UserController@researchUpdate')->name('profile.research.update');
	Route::get('/prodile/research/delete/{id}', 'UserController@researchDelete')->name('profile.research.delete');
	Route::get('/profile/research/toggle/{id}/is_featured/{fromProfile?}', 'UserController@researchToggleIsFeature')->name('profile.research.toggle.is_featured');

	// Profile Innovations
	Route::get('/profile/innovations', 'UserController@innovationsProfileIndex')->name('profile.innovations');
	Route::get('/profile/innovations/list', 'UserController@innovationsIndex')->name('profile.innovations.index');
	Route::get('/profile/innovations/create', 'UserController@innovationsCreate')->name('profile.innovations.create');
	Route::get('/profile/innovations/edit/{id}', 'UserController@innovationsEdit')->name('profile.innovations.edit');
	Route::post('/profile/innovations/create/store', 'UserController@innovationsStore')->name('profile.innovations.store');
	Route::post('/profile/innovations/create/update/{id}', 'UserController@innovationsUpdate')->name('profile.innovations.update');
	Route::get('/prodile/innovations/delete/{id}', 'UserController@innovationsDelete')->name('profile.innovations.delete');
	Route::get('/profile/innovations/toggle/{id}/is_featured/{fromProfile?}', 'UserController@innovationsToggleIsFeature')->name('profile.innovations.toggle.is_featured');

	// Profile Materials
	Route::get('/profile/materials', 'UserController@materialsProfileIndex')->name('profile.materials');
	Route::get('/profile/topics/{id}/materials', 'UserController@materialsIndex')->name('profile.topics.materials.index');
	Route::get('/profile/topics/{id}/materials/create', 'UserController@materialsCreate')->name('profile.topics.materials.create');
	Route::post('/profile/topics/{topic_id}/materials/move/{id}', 'UserController@materialsMove')->name('profile.topics.materials.move');
	Route::get('/profile/topics/{topic_id}/materials/edit/{id}', 'UserController@materialsEdit')->name('profile.topics.materials.edit');

	// Profile Materials Topic
	Route::get('/profile/topics', 'UserController@topicIndex')->name('profile.topics.index');
	Route::get('/profile/topics/create', 'UserController@topicCreate')->name('profile.topics.create');
	Route::post('/profile/topics/store', 'UserController@topicStore')->name('profile.topics.store');
	Route::get('/profile/topics/edit/{id}', 'UserController@topicEdit')->name('profile.topics.edit');
	Route::post('/profile/topics/{id}/update', 'UserController@topicUpdate')->name('profile.topics.update');
	Route::get('/profile/topics/delete/{id}', 'UserController@topicDelete')->name('profile.topics.delete');

	// My Profile
	Route::post('/profile/update', 'UserController@updateProfile')->name('profile.updateP');
	Route::post('/profile/avatar/remove', 'UserController@removeAvatar')->name('profile.removeAvatar');
	Route::resource('profile', 'UserController');

	// ----- ADMIN SIDE
	Route::group(['prefix' => 'admin'], function() {
		// Dashboard
		Route::get('/', 'PageController@redirectToDashboard')->name('admin');
		Route::get('/dashboard', 'PageController@dashboard')->name('dashboard');

		// Faculty Member
		Route::get('/faculty-member/{id}/skills', 'FacultyStaffController@skills')->name('admin.faculty-member.skills');
		Route::get('/faculty-member/{id}/manage-content', 'FacultyStaffController@manageContents')->name('admin.faculty-member.manage-contents');
		Route::get('/faculty-member/{id}/manage-content/{topicId}', 'FacultyStaffController@manageContentsShowTopic')->name('admin.faculty-member.manage-contents.topic');
		Route::get('/faculty-member/generate/', 'FacultyStaffController@generate')->name('admin.faculty-member.generate');
		Route::post('/faculty-member/generate/store', 'FacultyStaffController@storeGenerated')->name('admin.faculty-member.generate.store');
		Route::get('/faculty-member/{id}/delete', 'FacultyStaffController@delete')->name('admin.faculty-member.delete');
		Route::resource('faculty-member', 'FacultyStaffController');
		Route::post('faculty-member/{id}/update', 'FacultyStaffController@update')->name('admin.faculty-member.update');

		// Announcements
		Route::resource('announcements', 'AdminAnnouncementsController');

		// Skills
		Route::resource('skills', 'SkillsController');
	});
	// ----- ADMIN SIDE END
	// NEEDS AUTH END -----
});