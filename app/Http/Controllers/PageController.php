<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
	protected function index() {
		return view('users.index');
	}

	protected function researches() {
		return view('users.auth.research');
	}

	protected function innovations() {
		return view('users.auth.innovations');
	}
}