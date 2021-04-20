<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FacultyController extends Controller
{
	// TEMPORARY SUBSTITUTE... TO BE REMOVE ONCE BACKEND IS ATTACHED
	private function getStaff() {
		return PageController::getStaff();
	}


	protected function index() {
		
		$dept = 'all';
		if (\Request::has('dept')) {
			$dept = \Request::get('dept');
		}
		
		return view('users.auth.faculty.index', [
			'dept' => $dept,
			'staff' => $this->getStaff()
		]);
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

		return view('users.auth.faculty.show', [
			'id' => $id,
			'staff' => $this->getStaff()[$id-1],
			'skills' => $skills
		]);
	}

	protected function research($id) {
		return view('users.auth.faculty.show.research', [
			'id' => $id
		]);
	}

	protected function innovations($id) {
		return view('users.auth.faculty.show.innovations', [
			'id' => $id
		]);
	}

	protected function materials($id) {
		return view('users.auth.faculty.show.materials', [
			'id' => $id
		]);
	}
}