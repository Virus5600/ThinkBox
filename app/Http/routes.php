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

// AJAX -----
Route::post('/get-college-departments', 'AjaxController@getCollegeDepartments')->name('get-college-departments');
Route::post('/get-activities', 'AjaxController@getActivities')->name('get-activities');
// AJAX END -----

// COOKIES -----
Route::post('/cookie/set', 'CookieController@setCookie')->name('set-cookie');
Route::post('/cookie/get', 'CookieController@getCookie')->name('get-cookie');
Route::post('/cookie/delete', 'CookieController@deleteCookie')->name('del-cookie');
// COOKIES END -----

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
		Route::group(['middleware' => 'permission:faculty_members'], function() {
			Route::get('/faculty-member', 'FacultyStaffController@index')->name('admin.faculty-member.index');

			Route::group(['middleware' => 'permission:faculty_members_view'], function() {
				Route::get('/faculty-member/{$id}', 'FacultyStaffController@show')->name('admin.faculty-member.show');
			});

			Route::group(['middleware' => 'permission:faculty_members_create'], function() {
				Route::get('/faculty-member/create', 'FacultyStaffController@create')->name('admin.faculty-member.create');
				Route::get('/faculty-member/generate/', 'FacultyStaffController@generate')->name('admin.faculty-member.generate');

				Route::post('/faculty-member/store', 'FacultyStaffController@store')->name('admin.faculty-member.store');
				Route::post('/faculty-member/generate/store', 'FacultyStaffController@storeGenerated')->name('admin.faculty-member.generate.store');
			});

			Route::group(['middleware' => 'permission:faculty_members_edit'], function() {
				Route::get('/faculty-member/{$id}/edit', 'FacultyStaffController@edit')->name('admin.faculty-member.edit');
				Route::post('faculty-member/{id}/update', 'FacultyStaffController@update')->name('admin.faculty-member.update');
			});

			Route::group(['middleware' => 'permission:faculty_members_delete'], function() {
				Route::get('/faculty-member/{id}/delete', 'FacultyStaffController@delete')->name('admin.faculty-member.delete');
			});

			Route::group(['middleware' => 'permission:faculty_members_mark'], function() {
				Route::post('/faculty-member/{$id}/mark', 'FacultyStaffController@mark')->name('admin.faculty-member.mark');
				Route::post('/faculty-member/{$id}/unmark', 'FacultyStaffController@unmark')->name('admin.faculty-member.unmark');
			});

			// FM Contents
			Route::group(['middleware' => 'permission:faculty_members_contents'], function() {
				Route::get('/faculty-member/{id}/manage-content', 'FacultyStaffController@manageContents')->name('admin.faculty-member.manage-contents');
				Route::get('/faculty-member/{id}/manage-content/{topicId}', 'FacultyStaffController@manageContentsShowTopic')->name('admin.faculty-member.manage-contents.topic');

				Route::group(['middleware' => 'permission:faculty_members_contents_view'], function() {
					// TBA
				});

				Route::group(['middleware' => 'permission:faculty_members_contents_create'], function() {
					// TBA
				});

				Route::group(['middleware' => 'permission:faculty_members_contents_edit'], function() {
					// TBA
				});

				Route::group(['middleware' => 'permission:faculty_members_contents_delete'], function() {
					// TBA
				});

				Route::group(['middleware' => 'permission:faculty_members_contents_mark'], function() {
					// TBA
				});
			});

			// FM Skills
			Route::group(['middleware' => 'permission:faculty_members_skills'], function() {
				Route::get('/faculty-member/{id}/skills', 'FacultyStaffController@skills')->name('admin.faculty-member.skills');

				Route::group(['middleware' => 'permission:faculty_members_skills_view'], function() {
					// TBA
				});

				Route::group(['middleware' => 'permission:faculty_members_skills_create'], function() {
					// TBA
				});

				Route::group(['middleware' => 'permission:faculty_members_skills_edit'], function() {
					// TBA
				});

				Route::group(['middleware' => 'permission:faculty_members_skills_delete'], function() {
					// TBA
				});

				Route::group(['middleware' => 'permission:faculty_members_skills_mark'], function() {
					// TBA
				});
			});
		});

		// Announcements
		Route::group(['middleware' => 'permission:announcements'], function() {
			Route::get('/announcements', 'AdminAnnouncementsController@index')->name('admin.announcements.index');

			Route::group(['middleware' => 'permission:announcements_view'], function() {
				Route::get('/announcements/{id}', 'AdminAnnouncementsController@show')->name('admin.announcements.show');
			});

			Route::group(['middleware' => 'permission:announcements_create'], function() {
				Route::get('/announcements/create', 'AdminAnnouncementsController@create')->name('admin.announcements.create');
				Route::post('/announcements/store', 'AdminAnnouncementsController@store')->name('admin.announcements.store');
			});

			Route::group(['middleware' => 'permission:announcements_edit'], function() {
				Route::get('/announcements/{id}/edit', 'AdminAnnouncementsController@edit')->name('admin.announcements.edit');
				Route::post('/announcements/{id}/update', 'AdminAnnouncementsController@update')->name('admin.announcements.update');
			});

			Route::group(['middleware' => 'permission:announcements_delete'], function() {
				Route::get('/announcements/{id}/delete', 'AdminAnnouncementsController@delete')->name('admin.announcements.delete');
			});

			Route::group(['middleware' => 'permission:announcements_mark'], function() {
				Route::post('/announcements/{id}/mark', 'AdminAnnouncementsController@mark')->name('admin.announcements.mark');
				Route::post('/announcements/{id}/unmark', 'AdminAnnouncementsController@unmark')->name('admin.announcements.unmark');
			});
		});


		// Skills
		Route::group(['middleware' => 'permission:skills'], function() {
			Route::get('/skills', 'SkillsController@index')->name('admin.skills.index');

			Route::group(['middleware' => 'permission:skills_view'], function() {
				Route::get('/skills/{id}', 'SkillsController@show')->name('admin.skills.show');
			});

			Route::group(['middleware' => 'permission:skills_create'], function() {
				Route::get('/skills/create', 'SkillsController@create')->name('admin.skills.create');
				Route::post('/skills/store', 'SkillsController@store')->name('admin.skills.store');
			});

			Route::group(['middleware' => 'permission:skills_edit'], function() {
				Route::get('/skills/{id}/edit', 'SkillsController@edit')->name('admin.skills.edit');
				Route::get('/skills/{id}/update', 'SkillsController@update')->name('admin.skills.update');
			});

			Route::group(['middleware' => 'permission:skills_delete'], function() {
				Route::get('/skills/{id}/delete', 'SkillsController@delete')->name('admin.skills.delete');
			});

			Route::group(['middleware' => 'permission:skills_mark'], function() {
				Route::post('/skills/{id}/mark', 'SkillsController@mark')->name('admin.skills.mark');
				Route::post('/skills/{id}/unmark', 'SkillsController@unmark')->name('admin.skills.unmark');
			});
		});

		// Activity Log
		Route::group(['middleware' => 'permission:activity_log'], function() {
			Route::get('/activity-log', 'ActivityLogController@index')->name('admin.activity-log.index');

			Route::group(['middleware' => 'permission:activity_log_view'], function() {
				Route::get('/activity-log/{id}', 'ActivityLogController@show')->name('admin.activity-log.show');
			});

			Route::group(['middleware' => 'permission:activity_log_reset'], function() {
				Route::post('/activity-log/reset', 'ActivityLogController@reset')->name('admin.activity-log.reset');
			});

			Route::group(['middleware' => 'permission:activity_log_mark'], function() {
				Route::post('/activity-log/{id}/mark', 'ActivityLogController@mark')->name('admin.activity-log.mark');
				Route::post('/activity-log/{id}/unmark', 'ActivityLogController@unmark')->name('admin.activity-log.unmark');
			});
		});
	});
	// ----- ADMIN SIDE END
	// NEEDS AUTH END -----
});