<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Announcements;

class AdminAnnouncementsController extends Controller
{
	protected function index() {
		return view("users.auth.admin.announcements.index", [
			'announcements' => Announcements::get()
		]);
	}

	protected function create() {
		return view("users.auth.admin.announcements.create");
	}

	protected function show($id) {
		return view("users.auth.admin.announcements.show",[
			'announcement' => Announcements::find($id)
		]);
	}

	protected function edit($id) {
		return view("users.auth.admin.announcements.edit", [
			'announcement' => Announcements::find($id)
		]);
	}
}