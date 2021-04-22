<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminAnnouncementsController extends Controller
{
	// TEMPORARY SUBSTITUTE... TO BE REMOVE ONCE BACKEND IS ATTACHED
	private function getAnnouncements() {
		return PageController::getAnnouncements();
	}

	protected function index() {
		return view("users.auth.admin.announcements.index", [
			'announcements' => $this->getAnnouncements()
		]);
	}

	protected function create() {
		return view("users.auth.admin.announcements.create");
	}
}