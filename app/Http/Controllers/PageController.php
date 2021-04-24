<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
	// TEMPORARY SUBSTITUTE... TO BE REMOVE ONCE BACKEND IS ATTACHED
	private function getStaff() {
		return TmpController::getStaff();
	}
	private function getAnnouncements() {
		return TmpController::getAnnouncements();
	}
	private function getUser() {
		return TmpController::getUser();
	}

	// USER SIDE (AUTH AND UNAUTH)
	protected function index() {
		return view('users.index', [
			'user' => $this->getUser(),
			'staff' => $this->getStaff(),
			'announcements' => $this->getAnnouncements()
		]);
	}

	protected function researches() {
		return view('users.auth.research');
	}

	protected function innovations() {
		return view('users.auth.innovations');
	}

	// ADMIN SIDE
	protected function dashboard() {
		return view('users.auth.admin.dashboard');
	}
}