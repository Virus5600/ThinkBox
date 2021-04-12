<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends Controller
{
	protected function index() {
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

		return view('users.auth.profile.index', [
			'id' => '1',
			'skills' => $skills
		]);
	}

	protected function edit($id) {
		// Personal details
		$first_name = "Angelique";
		$last_name = "Lacasandile";
		$suffix = "";
		$title = "Dr.";
		$contact_no = "+639667125676";
		$email = "angelique.lacasandile@gmail.com";
		$profile_img = "user1.jpg";
		$description = "Dr. Angelique D. Lacasandile is the Department Chair of the Computer Science Department at National University, Manila. She graduated at Technological Institute of the Philippines – Manila with a degree of Doctor in Information Technology (DIT), her current research papers and system developed focused on the projects about the government. Much of her time has been dedicated to improving the understanding of the wider concept of “E-Government”, her work is centered on assessing the impact of technologies on the practice, administration of governments and the relationship of this between the public servant and the wider society.";
		
		// Affiliation related
		$positions = array('Co-Founder', 'Ambassador', 'Technical Consultant');
		$organizations = array('Aguora IT Solutions and Technology Inc.', 'Microsoft', 'House of Representative & TNC Cafe');

		// Other profile related
		$website = array('facebook', 'google_scholar', 'twitter', 'linkedin', 'github');
		$url = array('https://www.facebook.com/angelique.lacasandile.3', 'https://scholar.google.com/citations?hl=en&user=ZsEoUCgAAAAJ', 'https://www.linkedin.com/in/joseph-marvin-imperial-9382b9a7/', 'https://www.linkedin.com/in/dr-angelique-lacasandile-034a3780/', 'https://github.com/');

		// Skills related
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

		return view('users.auth.profile.edit', [
			'id' => '1',
			'skills' => $skills,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'suffix' => $suffix,
			'title' => $title,
			'contact_no' => $contact_no,
			'email' => $email,
			'profile_img' => $profile_img,
			'description' => $description,
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