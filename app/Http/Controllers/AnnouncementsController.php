<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AnnouncementsController extends Controller
{
	protected function index() {
		return view('announcements.index');
	}

	protected function show($id) {
		return view('announcements.show', [
			'id' => $id
		]);
	}
}