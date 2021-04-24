<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AnnouncementsController extends Controller
{
	// TEMPORARY SUBSTITUTE... TO BE REMOVE ONCE BACKEND IS ATTACHED
	private function getAnnouncements() {
		return TmpController::getAnnouncements();
	}

	protected function index() {
		return view('users.announcements.index', [
			'announcements' => $this->getAnnouncements()
		]);
	}

	protected function show($id) {
		return view('users.announcements.show', [
			'announcements' => $this->getAnnouncements()->get($id-1),
			'otherAnnouncements' => $this->getAnnouncements()->random(3)->shuffle()
		]);
	}
}