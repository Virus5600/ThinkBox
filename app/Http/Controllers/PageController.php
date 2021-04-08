<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
	protected function index() {
		return view('index');
	}

	protected function researches() {
		return view('research');
	}

	protected function innovations() {
		return view('innovations');
	}

	protected function faculty() {
		
		$dept = 'all';
		if (\Request::has('dept')) {
			$dept = \Request::get('dept');
		}
		
		return view('faculty', [
			'dept' => $dept
		]);
	}
}