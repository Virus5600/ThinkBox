<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\FacultyStaff;
use App\Skills;
use App\User;

use Hash;
use Validator;
use Log;

class FacultyStaffController extends Controller
{
	// TEMPORARY SUBSTITUTE... TO BE REMOVE ONCE BACKEND IS ATTACHED
	private function getStaff() {
		return TmpController::getStaff();
	}
	private function getSkillList() {
		return TmpController::getSkillList();
	}

	protected function index() {
		return view('users.auth.admin.faculty-member.index', [
			'staff' => FacultyStaff::get()
		]);
	}

	protected function create() {
		return view('users.auth.admin.faculty-member.create');
	}

	protected function store(Request $req) {
		// If the contact number isn't starting with "+63", prepend it on the contact number.
		$con = null;
		if ($req->contact_no != null && !preg_match('/^[\+63]/', $req->contact_no)) {
			$con = $req->contact_no;
			$req->request->set('contact_no', '+63'.$req->contact_no);
		}

		// If the isAvatarLink is not checked, set it to 0 since php returns nothing if a boolean is god damn false...
		if (!$req->has('isAvatarLink'))
			$req->request->set('isAvatarLink', '0');

		$validator = Validator::make($req->all(), [
			// VALIDATION RULES
			'avatar' => 'max:5120',
			'first_name' => 'required|min:2|max:50',
			'middle_name' => 'max:50',
			'last_name' => 'required|min:2|max:50',
			'email' => 'required|email',
			'contact_no' => array('numeric','regex:/(\+63[0-9]{10})||(null)/'),	// \+63[0-9]{10}means "+" followed by any 12 numbers,
		], [
			// VALIDATION ERROR MESSAGES
			'avatar.max' => 'Avatar should be below 5MB.',
			'first_name.required' => 'First name is required.',
			'first_name.min' => 'First name is too short.',
			'first_name.max' => 'First name is too long. If it exceeds 50 character, please just use the initials of the succeeding names.',
			'middle_name.max' => 'Middle name is too long. If it exceeds 50 character, please just use the initials of the succeeding names.',
			'last_name.required' => 'Last name is required',
			'last_name.min' => 'Last Name is too short.',
			'last_name.max' => 'Last name is too long. If it exceeds 50 character, please just use the initials of the succeeding names.',
			'email.required' => 'E-mail address is required.',
			'email.email' => 'Invalid e-mail address format.',
			'contact_no.numeric' => 'Invalid contact number',
			'contact_no.regex' => 'Contact number must either start with +63 or 09, and must be 12 digits. Provided: '.$req->contact_no,
		]);

		$hasValidationProblem = $validator->fails();
		if ($req->position != null) {
			for ($i = 0 ; $i < count($req->position); $i++) {
				$affiliationValidator = Validator::make($req->all(), [
					'position.'.$i => 'required_with:organization.'.$i,
					'organization.'.$i => 'required_with:position.'.$i,
				], [
					'position.'.$i.'.required_with' => 'Position is required.',
					'organization.'.$i.'.required_with' => 'Organization is required.',
				]);

				if ($affiliationValidator->fails()) {
					$hasValidationProblem = true;
					$validator->messages()->merge($affiliationValidator->messages());
				}
			}
		}

		if ($req->website != null) {
			for ($i = 0; $i < count($req->website); $i++) {
				$otherProfileValidator = Validator::make($req->all(), [
					'url.'.$i => 'required_with:website.'.$i,
				], [
					'url.'.$i.'.required_with' => 'URL is required.',
				]);

				if ($otherProfileValidator->fails()) {
					$hasValidationProblem = true;
					$validator->messages()->merge($otherProfileValidator->messages());
				}
			}
		}
		// If the toggle "isAvatarLink" wasn't enabled (meaning, it is a file), detect if it matches the allowed formats.
		if (!$req->isAvatarLink) {
			$imgValidator = Validator::make($req->all(), [
				'avatar' => 'mimes:jpeg,png,jpg'
			], [
				'avatar.mimes' => 'Selected file doesn\'t match the allowed image formats.',
			]);

			// Now, if it does not match any of the formats, return with the merged error messages from $validator and $imgValidator.
			if ($imgValidator->fails() || $hasValidationProblem) {
				$req->request->set('contact_no', $con);
				return redirect()
					->back()
					->withErrors($validator->messages()->merge($imgValidator->messages()))
					->withInput();
			}
		}

		// If there's a validation error, immediately return to the edit page with the error messages
		if ($hasValidationProblem) {
			$req->request->set('contact_no', $con);
			return redirect()
				->back()
				->withErrors($validator)
				->withInput();
		}

		$user = User::create([
			'title' => $req->title,
			'first_name' => $req->first_name,
			'middle_name' => $req->middle_name,
			'last_name' => $req->last_name,
			'suffix' => $req->suffix,
			'avatar' => $req->avatar,
			'isAvatarLink' => $req->isAvatarLink,
			'email' => $req->email,
			'username' => $req->username,
			'contact_no' => $con,
			'password' => Hash::make($req->password),
			'role' => null
		]);

		FacultyStaff::create([
			'user_id' => $user->id,
			'department' => 1,
			'position' => 3,
			'location' => 'National University',
			'description' => $req->description
		]);

		return redirect()
			->route('admin.faculty-member.index')
			->with('flash_success', 'Faculty Staff Added!')
			->with('message', 'Sending email to recipients.')
			->with('position', 'center')
			->with('is_toast', 'false')
			->with('has_timer', 'true')
			->with('duration', '7500');
	}

	protected function generate() {
		return view('users.auth.admin.faculty-member.generate');
	}

	protected function storeGenerated(Request $req) {
		$user = User::create([
			'title' => null,
			'first_name' => 'First Name',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'suffix' => null,
			'avatar' => null,
			'isAvatarLink' => 0,
			'email' => null,
			'username' => $req->username,
			'contact_no' => null,
			'password' => Hash::make($req->password),
			'remember_token' => $req->password,
			'role' => 3
		]);

		FacultyStaff::create([
			'user_id' => $user->id,
			'department' => 1,
			'position' => 3,
			'location' => 'National University',
			'description' => null
		]);

		// CREATE CODE TO SEND EMAIL TO THE ADMIN WHO GENERATED AND TO ALL THE RECIPIENTS

		return redirect()
			->route('admin.faculty-member.index')
			->with('flash_success', 'Faculty Staff Added!')
			->with('message', 'Sending email to recipients.')
			->with('position', 'center')
			->with('is_toast', 'false')
			->with('has_timer', 'true')
			->with('duration', '7500');
	}

	protected function show($id) {

		return view('users.auth.admin.faculty-member.show', [
			'skills' => Skills::get(),
			'staff' => FacultyStaff::get()
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

	protected function manageContentsShowTopic($id, $topicId) {
		return view('users.auth.admin.faculty-member.manage-content-topic', [
			'id' => $id
		]);
	}

	protected function delete($id) {
		$fs = FacultyStaff::find($id);
		User::find($fs->user_id)->delete();
		return redirect()->back()->with('flash_success', 'Successfully removed staff.');
	}
}