<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SkillsController extends Controller
{
	// TEMPORARY SUBSTITUTE... TO BE REMOVE ONCE BACKEND IS ATTACHED
	private function getSkillList() {
		return TmpController::getSkillList();
	}

	protected function index() {
		return view('users.auth.admin.skills', [
			'skills' => $this->getSkillList()	// Paginate with 10 items per page
		]);
	}
}