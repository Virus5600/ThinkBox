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
	private function getFocus() {
		return TmpController::getFocus();
	}
	private function getResearchList() {
		return TmpController::getResearchList();
	}
	private function getResearch($id) {
		return TmpController::getResearch($id);
	}

	// USER SIDE (AUTH AND UNAUTH)
	protected function index() {
		return view('users.index', [
			'user' => $this->getUser(),
			'staff' => $this->getStaff()->take(4),
			'announcements' => $this->getAnnouncements()->take(3),
			'research' => $this->getResearchList()->take(3),
			'innovations' => $this->getResearchList()->take(3)
		]);
	}

	protected function researches() {
		return view('users.auth.research.index', [
			'focus' => $this->getFocus(),
			'research' => $this->getResearchList()
		]);
	}

	protected function researchShow($id) {
		return view('users.auth.research.show', [
			'research' => $this->getResearch($id)
		]);
	}

	protected function innovations() {
		return view('users.auth.innovations.index', [
			'focus' => $this->getFocus(),
			'innovations' => $this->getResearchList()
		]);
	}

	protected function innovationShow($id) {
		return view('users.auth.innovations.show', [
			'innovation' => $this->getResearch($id)
		]);
	}

	// ADMIN SIDE
	protected function dashboard() {
		return view('users.auth.admin.dashboard');
	}
}