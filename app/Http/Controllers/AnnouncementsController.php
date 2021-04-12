<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AnnouncementsController extends Controller
{
	protected function index() {
		return view('users.announcements.index');
	}

	protected function show($id) {
		return view('users.announcements.show', [
			'id' => $id
		]);
	}
}