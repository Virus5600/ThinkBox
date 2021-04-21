<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FacultyStaff;
use App\Skills;

class PageController extends Controller
{
	// TEMPORARY SUBSTITUTE... TO BE REMOVE ONCE BACKEND IS ATTACHED
	public static function getStaff() {
		$staff = FacultyStaff::hydrate([
			(object) [
				'id' => '1',
				'avatar' => 'user1.jpg',
				'first_name' => 'Angelique',
				'last_name' => 'Lacasandille',
				'title' => 'Dr.',
				'suffix' => '',
				'name' => 'Dr. Angelique Lacasandille',
				'department' => 'Computer Science',
				'position' => 'Department Chair, National University',
				'description' => 'Dr. Angelique D. Lacasandile is the Department Chair of the Computer Science Department at National University, Manila. She is also the Academe and Industry Linkage Coordinator, and a recipient of CHED Scholarship for Graduate Studies that enjoys full-privileges to earn doctorate degree. She graduated at Technological Institute of the Philippines – Manila with a degree of Doctor in Information Technology (DIT), her current research papers and system developed focused on the projects about the government.',
				'contact_no' => '966 712 5676',
				'email' => 'angelique.lacasandile@gmail.com',
				'skills' => Skills::hydrate([
					(object)['id' => 1, 'skill' => 'Consultancy'],
					(object)['id' => 2, 'skill' => 'Business Management'],
					(object)['id' => 3, 'skill' => 'Software Quality Assurance'],
					(object)['id' => 4, 'skill' => 'Higher Education'],
					(object)['id' => 5, 'skill' => 'Programming'],
					(object)['id' => 6, 'skill' => 'Hosting Events'],
					(object)['id' => 7, 'skill' => 'MySQL'],
					(object)['id' => 8, 'skill' => 'Project Management'],
					(object)['id' => 9, 'skill' => 'Curriculum Development'],
					(object)['id' => 10, 'skill' => 'Event Management'],
					(object)['id' => 11, 'skill' => 'IT Consulting'],
					(object)['id' => 12, 'skill' => 'Teaching']
				])
			],
			(object) [
				'id' => '2',
				'avatar' => 'user2.jpg',
				'first_name' => 'Joseph Marvin',
				'last_name' => 'Imperial',
				'title' => '',
				'suffix' => '',
				'name' => 'Joseph Marvin Imperial',
				'department' => 'Computer Science',
				'position' => 'Professor, National University',
				'description' => 'A graduate student at De La Salle University under the MS Computer Science program. I am also a full-time faculty member of the Computer Science Department at National University-Manila. My research works are focused on applying Natural Language Processing (NLP) on Philippine languages using Machine Learning and Deep Learning methods.',
				'contact_no' => '966 712 5676',
				'email' => 'angelique.lacasandile@gmail.com',
				'skills' => Skills::hydrate([
					(object)['id' => 1, 'skill' => 'Higher Education'],
					(object)['id' => 2, 'skill' => 'Programming'],
					(object)['id' => 3, 'skill' => 'Hosting Events'],
					(object)['id' => 4, 'skill' => 'MySQL'],
					(object)['id' => 5, 'skill' => 'Project Management'],
					(object)['id' => 6, 'skill' => 'Curriculum Development'],
					(object)['id' => 7, 'skill' => 'Event Management'],
					(object)['id' => 8, 'skill' => 'IT Consulting'],
					(object)['id' => 9, 'skill' => 'Teaching']
				])
			],
			(object) [
				'id' => '3',
				'avatar' => 'user3.jpg',
				'first_name' => 'Manolito',
				'last_name' => 'Octaviano',
				'title' => '',
				'suffix' => 'Jr.',
				'name' => 'Manolito Octaviano Jr.',
				'department' => 'Computer Science',
				'position' => 'Professor, National University',
				'description' => 'Manolito Octaviano is a Professor at the Computer Science Department at National University, Manila. His research works are more focused on Natural Language Processing and Computational Linguistics.',
				'contact_no' => '966 712 5676',
				'email' => 'angelique.lacasandile@gmail.com',
				'skills' => Skills::hydrate([
					(object)['id' => 1, 'skill' => 'Higher Education'],
					(object)['id' => 2, 'skill' => 'Programming'],
					(object)['id' => 3, 'skill' => 'Hosting Events'],
					(object)['id' => 4, 'skill' => 'MySQL'],
					(object)['id' => 5, 'skill' => 'Project Management'],
					(object)['id' => 6, 'skill' => 'Curriculum Development'],
					(object)['id' => 7, 'skill' => 'Event Management'],
					(object)['id' => 8, 'skill' => 'IT Consulting'],
					(object)['id' => 9, 'skill' => 'Teaching']
				])
			],
			(object) [
				'id' => '4',
				'avatar' => 'user4.jpg',
				'first_name' => 'Arlene O.',
				'last_name' => 'Trillanes',
				'title' => 'Dr.',
				'name' => 'Dr. Arlene O. Trillanes',
				'department' => 'Computer Science',
				'position' => 'Dean, National University',
				'description' => 'Dr. Arlese Trillanes is the Dean of the College of Computing and Information Technologies at National University, Manila.',
				'contact_no' => '966 712 5676',
				'email' => 'angelique.lacasandile@gmail.com',
				'skills' => Skills::hydrate([
					(object)['id' => 1, 'skill' => 'Business Management'],
					(object)['id' => 2, 'skill' => 'Consultancy'],
					(object)['id' => 3, 'skill' => 'Curriulum Development'],
					(object)['id' => 4, 'skill' => 'Event Management'],
					(object)['id' => 5, 'skill' => 'Higher Education'],
					(object)['id' => 6, 'skill' => 'Hosting Events'],
					(object)['id' => 7, 'skill' => 'IT Consulting'],
					(object)['id' => 8, 'skill' => 'MySQL'],
					(object)['id' => 9, 'skill' => 'Programming'],
					(object)['id' => 10, 'skill' => 'Project Management'],
					(object)['id' => 11, 'skill' => 'Software Quality Assurance'],
					(object)['id' => 12, 'skill' => 'Teaching']
				])
			]
		]);

		return $staff;
	}

	public static function getSkillList() {
		$skill = Skills::hydrate([
			(object)['id' => 1, 'skill' => 'Business Management'],
			(object)['id' => 2, 'skill' => 'Consultancy'],
			(object)['id' => 3, 'skill' => 'Curriulum Development'],
			(object)['id' => 4, 'skill' => 'Event Management'],
			(object)['id' => 5, 'skill' => 'Higher Education'],
			(object)['id' => 6, 'skill' => 'Hosting Events'],
			(object)['id' => 7, 'skill' => 'IT Consulting'],
			(object)['id' => 8, 'skill' => 'MySQL'],
			(object)['id' => 9, 'skill' => 'Programming'],
			(object)['id' => 10, 'skill' => 'Project Management'],
			(object)['id' => 11, 'skill' => 'Software Quality Assurance'],
			(object)['id' => 12, 'skill' => 'Teaching']
		]);

		return $skill;
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
}