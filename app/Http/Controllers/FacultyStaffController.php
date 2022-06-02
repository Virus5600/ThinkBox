<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Affiliation;
use App\OtherProfile;
use App\FacultyStaff;
use App\Research;
use App\Innovation;
use App\Material;
use App\Skills;
use App\User;
use App\College;
use App\Departments;
use App\StaffTypes;

use DB;
use Hash;
use Validator;
use Log;

class FacultyStaffController extends Controller
{
	protected function index() {
		return view('users.auth.admin.faculty-member.index', [
			'staff' => FacultyStaff::get()
		]);
	}

	protected function create() {
		return view('users.auth.admin.faculty-member.create', [
			'dean' => StaffTypes::where('type', '=', 'dean')->first(),
			'positions' => StaffTypes::orderBy('type')->get(),
			'colleges' => College::orderBy('name')->get(),
			'departments' => College::orderBy('name')->first()->departments
		]);
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
		try {
			DB::beginTransaction();

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
				'department' => ($req->staff_position == StaffTypes::where('type', '=', 'dean')->first()->id ? $req->college : $req->department),
				'position' => $req->staff_position,
				'location' => 'National University',
				'description' => $req->description
			]);

			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			Log::error($e);

			return redirect()
				->back()
				->withInput()
				->with('flash_error', 'Something went wrong, please try again later.');
		}

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
		return view('users.auth.admin.faculty-member.generate', [
			'dean' => StaffTypes::where('type', '=', 'dean')->first(),
			'positions' => StaffTypes::orderBy('type')->get(),
			'colleges' => College::orderBy('name')->get(),
			'departments' => College::orderBy('name')->first()->departments
		]);
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
		$staff = FacultyStaff::find($id);
		if ($staff == null) {
			return redirect()
				->back()
				->with('flash_error', 'Failed to delete faculty member.')
				->with('error', 'Faculty member does not exists anymore.');
		}

		return view('users.auth.admin.faculty-member.show', [
			'staff' => $staff,
			'research' => Research::where('posted_by', $id)->take(3)->get(),
			'innovations' => Innovation::where('posted_by', $id)->take(3)->get(),
			'materials' => Material::where('faculty_staff_id', $id)->take(5)->get(),
			'matCount' => count(Material::where('faculty_staff_id', $id)->get()),
			'affiliations' => Affiliation::where('user_id', FacultyStaff::find($id)->user_id)->get(),
			'other_profiles' => OtherProfile::where('user_id', FacultyStaff::find($id)->user_id)->get()
		]);
	}

	protected function edit($id) {
		$staff = FacultyStaff::find($id);
		if ($staff == null) {
			return redirect()
				->back()
				->with('flash_error', 'Failed to delete faculty member.')
				->with('error', 'Faculty member does not exists anymore.');
		}
		
		return view('users.auth.admin.faculty-member.edit', [
			'staff' => $staff,
			'research' => Research::where('posted_by', $id)->take(3)->get(),
			'innovations' => Innovation::where('posted_by', $id)->take(3)->get(),
			'materials' => Material::where('faculty_staff_id', $id)->take(5)->get(),
			'matCount' => count(Material::where('faculty_staff_id', $id)->get()),
			'affiliations' => Affiliation::where('user_id', FacultyStaff::find($id)->user_id)->get(),
			'other_profiles' => OtherProfile::where('user_id', FacultyStaff::find($id)->user_id)->get()
		]);
	}

	protected function update(Request $req, $id) {
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
			'email' => 'email',
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
			// 'email.required' => 'E-mail address is required.',
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

		// Fetch the row of this user from the users table and faculty_staffs table
		$staff = FacultyStaff::find($id);
		$user = $staff->user;

		// If there's a new avatar
		if ($req->hasFile('avatar') && !$req->isAvatarLink) {
			// If an old avatar was present previously, delete the file.
			if ($user->avatar != null)
				File::delete(public_path() . '/uploads/users/user' . $id . '/' . $user->avatar);

			// Set the avatar variable, the move the file to the user's folder.
			$avatar = 'user'.$id.'.'.$req->file('avatar')->getClientOriginalExtension();
			$req->file('avatar')->move('uploads/users/user'.$id.'/', $avatar);

			// Set the new avatar in the database.
			$user->avatar = $avatar;
		}
		else if ($req->isAvatarLink) {
			if ($user->avatar != null)
				File::delete(public_path() . '/uploads/users/user' . $id . '/' . $user->avatar);
			$user->avatar = $req->avatar;
		}

		$user->first_name = $req->first_name;
		$user->isAvatarLink = $req->isAvatarLink ? 1 : 0;
		$user->middle_name = $req->middle_name;
		$user->last_name = $req->last_name;
		$user->title = $req->title;
		$user->suffix = $req->suffix;
		$user->email = $req->email;
		$user->contact_no = $con;
		$user->save();

		$staff->description = $req->description;
		$staff->save();

		// AFFILIATIONS
		Affiliation::where('user_id', '=', $user->id)->delete();
		if ($req->position != null) {
			for ($i = 0; $i < count($req->position); $i++) {
				if (strlen(trim($req->position[$i])) == 0 && strlen(trim($req->organization[$i])) == 0)
					continue;
				Affiliation::insert([
					'user_id' => $user->id,
					'position' => $req->position[$i],
					'organization' => $req->organization[$i]
				]);
			}
		}

		// OTHER PROFILES
		OtherProfile::where('user_id', '=', $user->id)->delete();
		if ($req->website != null) {
			for ($i = 0; $i < count($req->website); $i++) {
				if (strlen(trim($req->url[$i])) == 0)
					continue;
				OtherProfile::insert([
					'user_id' => $user->id,
					'website' => $req->website[$i],
					'url' => $req->url[$i]
				]);
			}
		}

		return redirect()
			->back()
			->with('flash_success', 'Successfully Updated Profile')
			->with('has_icon', true);
	}

	protected function skills($id) {
		$staff = FacultyStaff::find($id);
		return view('users.auth.admin.faculty-member.skills', [
			'staff' => $staff,
			'skills' => Skills::get(),
		]);
	}

	protected function manageContents($id) {
		return view('users.auth.admin.faculty-member.manage-content', [
			'staff' => User::find($id)
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