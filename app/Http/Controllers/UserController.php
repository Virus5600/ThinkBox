<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
	// TEMPORARY SUBSTITUTE... TO BE REMOVE ONCE BACKEND IS ATTACHED
	private function getUser() {
		return TmpController::getUser();
	}
	private function getFocus() {
		return TmpController::getFocus();
	}
	private function getResearch($id) {
		return TmpController::getResearch($id);
	}
	private function getResearchList() {
		return TmpController::getResearchList();
	}

	// AUTHENTICATION AND RELATED
	protected function login() {
		return view('users.login');
	}

	protected function register() {
		return view('user.register');
	}

	protected function authenticate() {
		
	}

	// RESOURCE GET
	protected function index() {
		return view('users.auth.profile.index', [
			'user' => $this->getUser(),
			'research' => $this->getResearchList()->where('posted_by', $this->getUser()->id),
			'innovations' => $this->getResearchList()->where('posted_by', $this->getUser()->id),
		]);
	}

	protected function edit($id) {
		// Affiliation related
		$positions = array('Co-Founder', 'Ambassador', 'Technical Consultant');
		$organizations = array('Aguora IT Solutions and Technology Inc.', 'Microsoft', 'House of Representative & TNC Cafe');

		// Other profile related
		$website = array('facebook', 'google_scholar', 'twitter', 'linkedin', 'github');
		$url = array('https://www.facebook.com/angelique.lacasandile.3', 'https://scholar.google.com/citations?hl=en&user=ZsEoUCgAAAAJ', 'https://www.linkedin.com/in/joseph-marvin-imperial-9382b9a7/', 'https://www.linkedin.com/in/dr-angelique-lacasandile-034a3780/', 'https://github.com/');

		return view('users.auth.profile.edit', [
			'user' => $this->getUser(),
			'positions' => $positions,
			'organizations' => $organizations,
			'website' => $website,
			'url' => $url
		]);
	}

	// RESEARCH RELATED VIEWS
	protected function researchProfileIndex() {
		return view('users.auth.profile.show.research.profile_index', [
			'id' => $this->getUser()->id,
			'user' => $this->getUser(),
			'research' => $this->getResearchList()->where('posted_by', $this->getUser()->id)
		]);
	}

	protected function researchIndex() {
		return view('users.auth.profile.show.research.index', [
			'id' => $this->getUser()->id,
			'researches' => $this->getResearchList()->where('posted_by', $this->getUser()->id)
		]);
	}

	protected function researchCreate() {
		return view('users.auth.profile.show.research.create', [
			'focus' => $this->getFocus()
		]);
	}

	protected function researchEdit($id) {
		return view('users.auth.profile.show.research.edit', [
			'research' => $this->getResearch($id),
			'focus' => $this->getFocus()
		]);
	}

	// INNOVATION RELATED VIEWS
	protected function innovationsProfileIndex() {
		return view('users.auth.profile.show.innovations.profile_index', [
			'id' => $this->getUser()->id,
			'user' => $this->getUser(),
			'innovations' => $this->getResearchList()->where('posted_by', $this->getUser()->id)
		]);
	}

	protected function innovationsIndex() {
		return view('users.auth.profile.show.innovations.index', [
			'id' => $this->getUser()->id,
			'innovations' => $this->getResearchList()->where('posted_by', $this->getUser()->id)
		]);
	}

	protected function innovationsCreate() {
		return view('users.auth.profile.show.innovations.create', [
			'focus' => $this->getFocus()
		]);
	}

	protected function innovationsEdit($id) {
		return view('users.auth.profile.show.innovations.edit', [
			'innovation' => $this->getResearch($id),
			'focus' => $this->getFocus()
		]);
	}

	// COURSE MATERIAL RELATED VIEWS
	protected function materialsProfileIndex() {
		return view('users.auth.profile.show.materials.profile_index', [
			'id' => $this->getUser()->id,
			'user' => $this->getUser()
		]);
	}

	protected function materialsIndex() {
		return view('users.auth.profile.show.materials.index', [
			'id' => $this->getUser()->id
		]);
	}

	protected function materialsTopicIndex($id) {
		return view('users.auth.profile.show.materials.topic.index', [
			'id' => $id
		]);
	}
}