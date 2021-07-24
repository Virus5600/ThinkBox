<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Skills;

class SkillsController extends Controller
{
	protected function index() {
		return view('users.auth.admin.skills', [
			'skills' => Skills::paginate(10)
		]);
	}
}