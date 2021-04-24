<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends Controller
{
	// TEMPORARY SUBSTITUTE... TO BE REMOVE ONCE BACKEND IS ATTACHED
	private function getUser() {
		return TmpController::getUser();
	}

	protected function index() {
		return view('users.auth.profile.index', [
			'user' => $this->getUser(),
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
			'id' => 1
		]);
	}

	protected function researchIndex() {
		return view('users.auth.profile.show.research.index', [
			'id' => 1
		]);
	}

	// INNOVATION RELATED VIEWS
	protected function innovationsProfileIndex() {
		return view('users.auth.profile.show.innovations.profile_index', [
			'id' => 1
		]);
	}

	protected function innovationsIndex() {
		return view('users.auth.profile.show.innovations.index', [
			'id' => 1
		]);
	}

	// COURSE MATERIAL RELATED VIEWS
	protected function materialsProfileIndex() {
		return view('users.auth.profile.show.materials.profile_index', [
			'id' => 1
		]);
	}

	protected function materialsIndex() {
		return view('users.auth.profile.show.materials.index', [
			'id' => 1
		]);
	}

	protected function materialsTopicIndex($id) {
		return view('users.auth.profile.show.materials.topic.index', [
			'id' => $id
		]);
	}
}