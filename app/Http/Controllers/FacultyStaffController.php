<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\ActivityLog;
use App\Affiliation;
use App\College;
use App\Departments;
use App\FacultyStaff;
use App\Innovation;
use App\Material;
use App\OtherProfile;
use App\Research;
use App\Skills;
use App\StaffTypes;
use App\Topic;
use App\User;

use Auth;
use DB;
use Exception;
use File;
use Hash;
use Log;
use Mail;
use Validator;

class FacultyStaffController extends Controller
{
	protected function index() {
		$staff = new FacultyStaff();

		// SEARCH
		if (\Request::has('search')) {
			$search = \Request::get('search');

			if (!\Request::has('sortBy') || $sortBy == 'none') {
				$staff = $staff->join('users', 'users.id', '=', 'faculty_staffs.user_id');
			}
			$staff->join('staff_types', 'staff_types.id', '=', 'faculty_staffs.position')
				// joining the many-to-many tables faculty_focus, faculty_staff, and focus
				->join('faculty_focus', 'faculty_staffs.id', '=', 'faculty_focus.faculty_staff_id')
				->join('focus', 'faculty_focus.focus_id', '=', 'focus.id')
				// Proceed to do the filtering
				->where('users.role_id', '>=', 3)
				->where(function($q) use ($search) {
					$q->where('staff_types.type', 'LIKE', '%'.preg_replace("/ /", "_", $search).'%')
						->orWhere('faculty_staffs.location', 'LIKE', '%'.$search.'%')
						->orWhere('faculty_staffs.description', 'LIKE', '%'.$search.'%')
						->orWhere('users.first_name', 'LIKE', '%'.$search.'%')
						->orWhere('users.middle_name', 'LIKE', '%'.$search.'%')
						->orWhere('users.last_name', 'LIKE', '%'.$search.'%')
						->orWhere('users.email', 'LIKE', '%'.$search.'%')
						->orWhere('users.username', 'LIKE', '%'.$search.'%')
						->orWhere('focus.name', 'LIKE', '%'.$search.'%');
				});
		}
		else {
			// REMOVE ADMINS
			$staff = $staff->join('users', 'faculty_staffs.user_id', '=', 'users.id')
				->where('users.role_id', '>=', '3');
		}

		if (!is_a($staff, 'Illuminate\Pagination\LengthAwarePaginator')) {
			$staff = $staff->distinct()->paginate(10, ['faculty_staffs.*']);
		}

		return view('users.auth.admin.faculty-member.index', [
			'staff' => $staff,
			'searchVal' => \Request::get('search'),
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
		else
			$req->request->set('isAvatarLink', '1');

		$validator = Validator::make($req->all(), [
			// VALIDATION RULES
			'avatar' => 'max:5120',
			'first_name' => 'required_with:last_name|min:2|max:50',
			'middle_name' => 'max:50',
			'last_name' => 'required_with:first_name|min:2|max:50',
			'email' => 'required|email',
			'contact_no' => array('numeric','regex:/(\+63[0-9]{10})||(null)/'),	// \+63[0-9]{10}means "+" followed by any 12 numbers,
		], [
			// VALIDATION ERROR MESSAGES
			'avatar.max' => 'Avatar should be below 5MB.',
			'first_name.required_with' => 'First name is required.',
			'first_name.min' => 'First name is too short.',
			'first_name.max' => 'First name is too long. If it exceeds 50 character, please just use the initials of the succeeding names.',
			'middle_name.max' => 'Middle name is too long. If it exceeds 50 character, please just use the initials of the succeeding names.',
			'last_name.required_with' => 'Last name is required',
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

			switch ($req->staff_position) {
				case 1:
					$role = 2;
					break;

				case 2:
				case 3:
					$role = 3;
					break;

				case 4:
					$role = 4;
					break;

				case 5:
					$role = 5;
					break;
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
				'role_id' => $role
			]);

			FacultyStaff::create([
				'user_id' => $user->id,
				'department' => ($req->staff_position == StaffTypes::where('type', '=', 'dean')->first()->id ? $req->college : $req->department),
				'position' => $req->staff_position,
				'location' => 'National University',
				'description' => $req->description,
				'is_marked' => 1,
				'reason' => 'Newly created account. Unmark once information are complete or sufficient enough'
			]);

			// CREATE CODE TO SEND EMAIL TO THE ADMIN WHO GENERATED AND TO ALL THE RECIPIENTS
			Mail::send(
				'template.email.account_creation',
				['email' => $req->email, 'req' => $req],
				function ($m) use ($req) {
					$m->to($req->email, $req->email)
						->from('support.no-reply@thinkbox.org')
						->cc(Auth::user()->email)
						->subject('Account Creation');
				}
			);

			if (count($req->recipient) > 0)
				foreach ($req->recipient as $e) {
					Mail::send(
						'template.email.account_creation',
						['email' => $req->email, 'req' => $req],
						function ($m) use ($req) {
							$m->to($req->email, $req->email)
								->from('support.no-reply@thinkbox.org')
								->cc(Auth::user()->email)
								->subject('Account Creation');
						}
					);
				}

			ActivityLog::log('Created a user (<a href="' . route('admin.faculty-member.show', [$user->id]) . '">' . $user->getFullName() . '</a>)');

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
		try {
			DB::beginTransaction();

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
				'role_id' => 3
			]);

			FacultyStaff::create([
				'user_id' => $user->id,
				'department' => 1,
				'position' => 3,
				'location' => 'National University',
				'description' => null
			]);

			// CREATE CODE TO SEND EMAIL TO THE ADMIN WHO GENERATED AND TO ALL THE RECIPIENTS
			Mail::send(
				'template.email.account_creation',
				['email' => $req->email, 'req' => $req],
				function ($m) use ($req) {
					$m->to($req->email, $req->email)
						->from('support.no-reply@thinkbox.org')
						->cc(Auth::user()->email)
						->subject('Account Creation');
				}
			);

			if (count($req->recipient) > 0)
				foreach ($req->email as $e) {
					Mail::send(
						'template.email.account_creation',
						['email' => $e, 'req' => $req],
						function ($m) use ($e) {
							$m->to($e, $e)
								->from('support.no-reply@thinkbox.org')
								->cc(Auth::user()->email)
								->subject('Account Creation');
						}
					);
				}

			ActivityLog::log('Generated a user (<a href="' . route('admin.faculty-member.show', [$user->id]) . '">' . $user->getFullName() . '</a>)');

			DB::commit();
		} catch (Exception $e) {
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

		try {
			DB::beginTransaction();
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

			$words = explode(" ", $req->first_name . ' ' . $req->middle_name);
			$username = "";
			foreach ($words as $w) $username .= $w[0];
			$username .= $req->lastname;
			$old_username = $user->username;

			$user->first_name = $req->first_name;
			$user->middle_name = $req->middle_name;
			$user->last_name = $req->last_name;
			$user->title = $req->title;
			$user->suffix = $req->suffix;
			$user->isAvatarLink = $req->isAvatarLink ? 1 : 0;
			$user->email = $req->email;
			$user->username = strtolower($username);
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

			ActivityLog::log('Updated a user (<a href="' . route('admin.faculty-member.show', [$user->id]) . '">' . $user->getFullName() . '</a>)');

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			Log::error($e);

			return redirect()
				->back()
				->withInput()
				->with('flash_error', 'Something went wrong, please try again later.');
		}

		return redirect()
			->back()
			->with('flash_success', 'Successfully Updated Profile.')
			->with('message', $username != $old_username ? '<span>Updated username from ' . $old_username . ' to ' . $username . '</span>' : '')
			->with('has_icon', true);
	}

	protected function delete($id) {
		$fs = FacultyStaff::find($id);

		if ($fs == null)
			return redirect()
				->route('admin.faculty-member.index')
				->with('flash_info', 'User was already removed. Please refresh the page if it still appears in the table.');

		try {
			DB::beginTransaction();
			$user = User::find($fs->user_id);
			$user->delete();
			File::delete(public_path() . '/uploads/users/user' . $user->id . '/' . $user->avatar);
			ActivityLog::log('Deleted a user (<a href="' . route('admin.faculty-member.show', [$user->id]) . '">' . $user->getFullName() . '</a>)');
			DB::commit();
		} catch (Exception $e) {
			Log::error($e);
			DB::rollback();

			return redirect()
				->route('admin.faculty-member.index')
				->with('flash_error', 'Something went wrong, please try again later.');
		}

		return redirect()
			->route('admin.faculty-member.index')
			->with('flash_success', 'Successfully removed staff.');
	}

	protected function mark(Request $req, $id) {
		$validator = Validator::make($req->all(), [
			'reason' => 'required|min:2'
		], [
			'reason.required' => 'A reason is required on why this is being marked',
			'reason.min' => 'Please provide a proper reason why this is being marked'
		]);

		if ($validator->fails())
			return response()
				->json([
					'has_error' => false,
					'has_validation_error' => true,
					'message' => $validator->errors()->first()
				]);

		$staff = FacultyStaff::find($id);

		if ($staff == null) {
			return response()
				->json([
					'has_error' => false,
					'has_validation_error' => false,
					'is_info' => true,
					'message' => 'Item does not exist. Please refresh page if the item is still visible in your table.'
				]);
		}

		try {
			DB::beginTransaction();

			$staff->is_marked = 1;
			$staff->reason = $req->reason;
			$staff->save();

			ActivityLog::log('Marked user (<a href="' . route('admin.faculty-member.show', [$staff->id]) . '">' . $staff->getFullName() . '</a>)');

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			Log::error($e);

			return response()
				->json([
					'has_error' => true,
					'has_validation_error' => false,
					'message' => 'Something went wrong, please try again later.'
				]);
		}

		return response()
			->json([
				'has_error' => false,
				'has_validation_error' => false,
				'is_info' => false,
				'message' => 'Successfully marked "' . $staff->getFullName() . '".',
				'uri' => route('admin.faculty-member.unmark', [$id]),
				'id' => $id
			]);
	}

	protected function unmark(Request $req, $id) {
		$validator = Validator::make($req->all(), [
			'reason' => 'required|min:2'
		], [
			'reason.required' => 'A reason is required on why this is getting unmarked',
			'reason.min' => 'Please provide a proper reason why this is getting unmarked'
		]);

		if ($validator->fails())
			return response()
				->json([
					'has_error' => false,
					'has_validation_error' => true,
					'message' => $validator->errors()->first()
				]);

		$staff = FacultyStaff::find($id);

		if ($staff == null) {
			return response()
				->json([
					'has_error' => false,
					'has_validation_error' => false,
					'is_info' => true,
					'message' => 'Item does not exist. Please refresh page if the item is still visible in your table.'
				]);
		}

		try {
			DB::beginTransaction();

			$staff->is_marked = 0;
			$staff->reason = $req->reason;
			$staff->save();

			ActivityLog::log('Unmarked user (<a href="' . route('admin.faculty-member.show', [$staff->id]) . '">' . $staff->getFullName() . '</a>)');

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			Log::error($e);

			return response()
				->json([
					'has_error' => true,
					'has_validation_error' => false,
					'message' => 'Something went wrong, please try again later.'
				]);
		}

		return response()
			->json([
				'has_error' => false,
				'has_validation_error' => false,
				'is_info' => false,
				'message' => 'Successfully unmarked "' . $staff->getFullName() . '".',
				'uri' => route('admin.faculty-member.mark', [$id]),
				'id' => $id
			]);
	}

	// SKILLS
	protected function skills($id) {
		$staff = FacultyStaff::find($id);
		return view('users.auth.admin.faculty-member.skills', [
			'staff' => $staff,
			'skills' => Skills::get(),
		]);
	}

	// CONTENTS
	protected function contents($id) {
		$staff = FacultyStaff::find($id);
		$materials = $staff->materials;
		$distinct_topics = [];

		foreach ($materials as $m) array_push($distinct_topics, $m->topic_id);
		$distinct_topics = array_unique($distinct_topics);
		$topics = Topic::whereIn('id', $distinct_topics)->get();

		return view('users.auth.admin.faculty-member.content', [
			'staff' => $staff,
			'topics' => $topics
		]);
	}
}