<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FacultyStaffController extends Controller
{
	// TEMPORARY SUBSTITUTE... TO BE REMOVE ONCE BACKEND IS ATTACHED
	private function getStaff() {
		return PageController::getStaff();
	}
	private function getSkillList() {
		return PageController::getSkillList();
	}

	protected function index() {
		return view('users.auth.admin.faculty-member.index', [
			'staff' => $this->getStaff()
		]);
	}

	protected function create() {
		return view('users.auth.admin.faculty-member.create');
	}

	protected function show($id) {
		$skills = array(
			'Consultancy',
			'Business Management',
			'Software Quality Assurance',
			'Higher Education',
			'Programming',
			'Hosting Events',
			'MySQL',
			'Project Management',
			'Curriculum Development',
			'Event Management',
			'IT Consulting',
			'Teaching'
		);

		return view('users.auth.admin.faculty-member.show', [
			'skills' => $skills,
			'staff' => $this->getStaff()[$id-1]
		]);
	}

	protected function edit($id) {
		$skills = array(
			'Consultancy',
			'Business Management',
			'Software Quality Assurance',
			'Higher Education',
			'Programming',
			'Hosting Events',
			'MySQL',
			'Project Management',
			'Curriculum Development',
			'Event Management',
			'IT Consulting',
			'Teaching'
		);

		// Affiliation related
		$positions = array('Co-Founder', 'Ambassador', 'Technical Consultant');
		$organizations = array('Aguora IT Solutions and Technology Inc.', 'Microsoft', 'House of Representative & TNC Cafe');

		// Other profile related
		$website = array('facebook', 'google_scholar', 'twitter', 'linkedin', 'github');
		$url = array('https://www.facebook.com/angelique.lacasandile.3', 'https://scholar.google.com/citations?hl=en&user=ZsEoUCgAAAAJ', 'https://www.linkedin.com/in/joseph-marvin-imperial-9382b9a7/', 'https://www.linkedin.com/in/dr-angelique-lacasandile-034a3780/', 'https://github.com/');
		
		return view('users.auth.admin.faculty-member.edit', [
			'skills' => $skills,
			'staff' => $this->getStaff()[$id-1],
			'positions' => $positions,
			'organizations' => $organizations,
			'website' => $website,
			'url' => $url
		]);
	}

	protected function skills($id) {
		return view('users.auth.admin.faculty-member.skills', [
			'skills' => $this->getSkillList(),
			'staff' => $this->getStaff()[$id-1]
		]);
	}

	protected function manageContents($id) {
		return view('users.auth.admin.faculty-member.manage-content', [
			'staff' => $this->getStaff()[$id-1]
		]);
	}
}