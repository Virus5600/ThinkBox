<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FacultyStaff;

class PageController extends Controller
{
	// TEMPORARY SUBSTITUTE... TO BE REMOVE ONCE BACKEND IS ATTACHED
	public static function getStaff() {
		$staff = FacultyStaff::hydrate([
			(object) [
				'id' => '1',
				'avatar' => 'user1.jpg',
				'name' => 'Dr. Angelique Lacasandille',
				'department' => 'Computer Science',
				'position' => 'Department Chair, National University',
				'description' => 'Dr. Angelique D. Lacasandile is the Department Chair of the Computer Science Department at National University, Manila. She is also the Academe and Industry Linkage Coordinator, and a recipient of CHED Scholarship for Graduate Studies that enjoys full-privileges to earn doctorate degree. She graduated at Technological Institute of the Philippines – Manila with a degree of Doctor in Information Technology (DIT), her current research papers and system developed focused on the projects about the government.'
			],
			(object) [
				'id' => '2',
				'avatar' => 'user2.jpg',
				'name' => 'Joseph Marvin Imperial',
				'department' => 'Computer Science',
				'position' => 'Professor, National University',
				'description' => 'A graduate student at De La Salle University under the MS Computer Science program. I am also a full-time faculty member of the Computer Science Department at National University-Manila. My research works are focused on applying Natural Language Processing (NLP) on Philippine languages using Machine Learning and Deep Learning methods.'
			],
			(object) [
				'id' => '3',
				'avatar' => 'user3.jpg',
				'name' => 'Manolito Octaviano Jr.',
				'department' => 'Computer Science',
				'position' => 'Professor, National University',
				'description' => 'Manolito Octaviano is a Professor at the Computer Science Department at National University, Manila. His research works are more focused on Natural Language Processing and Computational Linguistics.'
			],
			(object) [
				'id' => '4',
				'avatar' => 'user4.jpg',
				'name' => 'Dr. Arlene O. Trillanes',
				'department' => 'Computer Science',
				'position' => 'Dean, National University',
				'description' => 'Dr. Arlese Trillanes is the Dean of the College of Computing and Information Technologies at National University, Manila.'
			]
		]);

		return $staff;
	}

	// USER SIDE (AUTH AND UNAUTH)
	protected function index() {
		return view('users.index', [
			'staff' => $this->getStaff()
		]);
	}

	protected function researches() {
		return view('users.auth.research');
	}

	protected function innovations() {
		return view('users.auth.innovations');
	}

	// ADMIN SIDE
	protected function dashboard() {
		return view('users.auth.admin.dashboard');
	}

	protected function facultyMember() {
		return view('users.auth.admin.faculty-member', [
			'staff' => $this->getStaff()
		]);
	}
}