<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcements;
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

	public static function getAnnouncements() {
		$announcements = Announcements::hydrate([
			(object)[
				'id' => 1,
				'image' => 'announcement1.jpg',
				'title' => 'Payment Options',
				'content' => '
					<p>Good news, Nationalians!</p>
					<p>Now you can pay your tuition, miscellaneous, and other school fees via our nominated payment channels and centers nationwide.</p>
					<p>You may process your payment via credit card, online banking, 7-Eleven, Cebuana, SM Bills payment and many more.</p>',
				'source' => 'https://www.national-u.edu.ph/payment-options/'
			],
			(object)[
				'id' => 2,
				'image' => 'announcement2.jpg',
				'title' => 'BDO EasyPay Cash Tuition Program',
				'content' => '<p>EASYPAY-CASH-TUITION-PROMO-MECHANICS-v121620</p>',
				'source' => 'https://www.national-u.edu.ph/payment-options'
			],
			(object)[
				'id' => 3,
				'image' => 'announcement3.jpg',
				'title' => 'NU Manila’s COE hosts REFOREST 2020: For Vivid Solutions',
				'content' => '
					<p>The National University Manila’s College of Engineering along with PICE and PSSE student chapters of NU successfully hosted the virtual REFOREST 2020: For Vivid Solutions, last January 29 with 1500 global crowd in attendance.</p>
					<p>Research Forum and Exhibition on Environmental Sustainability and Technologies (REFOREST) aims to produce solutions that will address relevant environmental crises both for present and in the future.</p>
					<p>Reputable plenary speakers, forum discussants and presenters were present to share their knowledge and experience in the significance of wise environmental decision-making in a well-functioning ecosystem.</p>
					<p>To top off the event, National-U’s Electronics and Communications Engineering alumnus, Jayvee Boy H. Agustin, was awarded the Best Paper Presenter for the topic: “Development of Subsystems for a Web-based Survey Tool Using Automatic Speech and Optical Character Recognition with Geotagging Features.”</p>
					<p>With the mission to combat emerging natural and environmental conflicts, REFOREST 2020 will indeed help us attain a sustainable environment.</p>',
				'source' => 'https://www.national-u.edu.ph/payment-options/'
			]
		]);

		return $announcements;
	}

	// USER SIDE (AUTH AND UNAUTH)
	protected function index() {
		return view('users.index', [
			'staff' => $this->getStaff(),
			'announcements' => $this->getAnnouncements()
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