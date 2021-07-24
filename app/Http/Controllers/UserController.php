<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\FacultyStaff;
use App\User;
use App\Research;
use App\ResearchAuthors;
use App\ResearchFocus;
use App\ResearchFile;
use App\Innovation;
use App\InnovationAuthors;
use App\InnovationFocus;
use App\InnovationFile;
use App\Focus;
use App\Affiliation;
use App\OtherProfile;
use App\Material;
use App\MaterialFiles;
use App\MaterialLinks;
use App\Topic;

use Validator;
use Log;

class UserController extends Controller
{
	// AUTHENTICATION AND RELATED
	protected function login() {
		if (!Auth::check())
			return view('users.login');
		else
			return redirect()->back();
	}

	protected function register() {
		return view('user.register');
	}

	protected function authenticate() {
		$credentialsE = [
			'email' => Input::get('email'),
			'password' => Input::get('password')
		];
		$credentialsU = [
			'username' => Input::get('email'),
			'password' => Input::get('password')
		];

		if (Auth::attempt($credentialsE, (Input::get('remember_me') != null ? true : false)) || Auth::attempt($credentialsU, (Input::get('remember_me') != null ? true : false))) {
			return redirect()->intended('/')->with('flash_success', 'Logged in!');
		}
		else {
			auth()->logout();
			return redirect()->back()->with('flash_error', 'Wrong email/password!')->withInput(Input::all());
		}
	}

	protected function logout() {
		if (Auth::check()) {
			auth()->logout();
			return redirect('/')->with('flash_success', 'Logged out!');
		}
		return redirect()->back()->with('flash_error', 'Something went wrong, please try again.');
	}

	// RESOURCE GET
	protected function index() {
		return view('users.auth.profile.index', [
			'user' => FacultyStaff::find(Auth::user()->id),
			'research' => Research::where('posted_by', Auth::user()->staff->id)->orderBy('created_at', 'DESC')->get(),
			'innovations' => Innovation::where('posted_by', Auth::user()->staff->id)->orderBy('created_at', 'DESC')->get(),
			'materials' => Material::where('faculty_staff_id', Auth::user()->staff->id)->take(5)->get(),
			'matCount' => count(Material::where('faculty_staff_id', Auth::user()->staff->id)->get()),
			'affiliations' => Affiliation::where('user_id', Auth::user()->staff->id)->get(),
			'other_profiles' => OtherProfile::where('user_id', Auth::user()->staff->id)->get()
		]);
	}

	protected function edit($id) {
		$user = FacultyStaff::where('user_id', Auth::user()->id)->first();

		// Other profile related
		$website = array('facebook', 'google_scholar', 'twitter', 'linkedin', 'github');
		$url = array('https://www.facebook.com/angelique.lacasandile.3', 'https://scholar.google.com/citations?hl=en&user=ZsEoUCgAAAAJ', 'https://www.linkedin.com/in/joseph-marvin-imperial-9382b9a7/', 'https://www.linkedin.com/in/dr-angelique-lacasandile-034a3780/', 'https://github.com/');
		return view('users.auth.profile.edit', [
			'user' => $user,
		]);
	}

	protected function removeAvatar(Request $req) {
		$user = User::find($req->id);
		if ($user->avatar != null)
			File::delete(public_path() . '/uploads/users/user' . $user->id . '/' . $user->avatar);
		$user->avatar = null;
		$user->isAvatarLink = 0;
		$user->save();

		return response()->json(['success' => 'Removed avatar.']);
	}

	// Used when updating owns profile.
	protected function updateProfile(Request $req) {
		return $this->update($req, Auth::user()->id);
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
		$user = User::find($id);
		$staff = FacultyStaff::where('user_id', '=', $id)->first();

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

	// RESEARCH RELATED VIEWS
	protected function researchProfileIndex($sortBy='date') {
		$research = Research::where('posted_by', '=', Auth::user()->id);

		// SORT
		if (\Request::has('sortBy')) {
			$sortBy = \Request::get('sortBy');
			if ($sortBy == 'date') {
				$research = $research->orderBy('research.date_published', 'DESC');
			}
			else if ($sortBy == 'titleAsc') {
				$research = $research->orderBy('research.title', 'ASC');
			}
			else if ($sortBy == 'titleDesc') {
				$research = $research->orderBy('research.title', 'DESC');
			}
		}

		// SEARCH
		if (\Request::has('search')) {
			$search = \Request::get('search');
			
			// Joining the many-to-many tables research, research_focus, and focus
			$research = $research->join('research_focus', 'research.id', '=', 'research_focus.research_id')
				->join('focus', 'research_focus.focus_id', '=', 'focus.id');

			// Proceed to do the filtering
			$research = $research->where('research.title', 'LIKE', "%".$search."%")
				->orWhere('research.description', 'LIKE', "%".$search."%")
				->orWhere('research.url', 'LIKE', "%".$search."%")
				->orWhere('focus.name', 'LIKE', "%".$search."%");
		}

		if (!is_a($research, 'Illuminate\Support\Collection')) {
			$research = $research->get(['research.*']);
		}

		return view('users.auth.profile.show.research.profile_index', [
			'id' => Auth::user()->id,
			'user' => FacultyStaff::find(Auth::user()->id),
			'sortBy' => $sortBy,
			'searchVal' => \Request::get('search'),
			'research' => $research->sortByDesc('is_featured')
		]);
	}

	protected function researchIndex() {
		$research = Research::where('posted_by', '=', Auth::user()->id);

		// SEARCH
		if (\Request::has('search')) {
			$search = \Request::get('search');
			
			// Joining the many-to-many tables research, research_focus, and focus
			$research = $research->join('research_focus', 'research.id', '=', 'research_focus.research_id')
				->join('focus', 'research_focus.focus_id', '=', 'focus.id');

			// Proceed to do the filtering
			$research = $research->where('research.title', 'LIKE', "%".$search."%")
				->orWhere('research.description', 'LIKE', "%".$search."%")
				->orWhere('research.url', 'LIKE', "%".$search."%")
				->orWhere('focus.name', 'LIKE', "%".$search."%");
		}

		if (!is_a($research, 'Illuminate\Support\Collection')) {
			$research = $research->get(['research.*']);
		}

		return view('users.auth.profile.show.research.index', [
			'id' => Auth::user()->id,
			'searchVal' => \Request::get('search'),
			'researches' => $research
		]);
	}

	protected function researchCreate() {
		return view('users.auth.profile.show.research.create', [
			'focus' => Focus::get(),
			'staff' => FacultyStaff::join('users', 'users.id', '=', 'faculty_staffs.user_id')->orderBy('users.first_name', 'ASC')->get(['faculty_staffs.*']),
		]);
	}

	protected function researchStore(Request $req) {

		if (!$req->has('is_file_requestable'))
			$req->request->set('is_file_requestable', '0');
		else
			$req->request->set('is_file_requestable', '1');

		if (!$req->has('is_featured'))
			$req->request->set('is_featured', '0');
		else
			$req->request->set('is_featured', '1');

		$isValidated = true;

		$validator = Validator::make($req->all(), [
			'title' => 'required|min:2',
			'file' => 'array',
			'url' => 'required_without_all:file|min:3',
			'registeredAuthors' => 'required',
			'description' => 'required|min:2|max:16777215',
			'date_published' => 'required|date',
			'registeredAuthors' => 'required',
		], [
			'title.required' => 'The title for your research is required.',
			'title.min' => 'Research title too short. If this is an error, please contact an admin.',
			'url.required_without_all' => 'The link for the research is required if there are no files provided.',
			'registeredAuthors.required' => 'Authors for this research is required.',
			'description.required' => 'A description or abstract for this research is required.',
			'description.min' => 'Please provide a proper description or abstract.',
			'description.max' => 'The description/abstract provided exceeds the 16 million character limit. Please omit some words or sentences.',
			'date_published.required' => 'The date this research was published is required.'
		]);

		if ($validator->fails())
			$isValidated = false;

		// Validates the files
		for ($i = 0; $i < count($req->file); $i++) {
			if ($req->file('file.'.$i) != null) {
				$fileValidator = Validator::make($req->all(), [
					'file.'.$i => 'mimes:pdf'
				], [
					'file.mimes.'.$i => 'File type should be PDF. If it is in word, please follow <a href="https://www.wikihow.com/Save-Word-As-a-PDF">this link</a> to convert your word document into a PDF.'
				]);

				if ($fileValidator->fails()) {
					$isValidated = false;
					$validator
						->messages()
						->merge($fileValidator->messages());
				}
			}
		}
		
		if (!$isValidated) {
			return redirect()
				->back()
				->withErrors($validator)
				->with('flash_message', 'Please re-select all the files you picked earlier.')
				->with('message', 'For security reasons, browsers does not allow us to retain the files selected. Thank you!')
				->withInput();
		}

		// Creates the research entry
		$research = Research::create([
			'title' => $req->title,
			'authors' => $req->authors,
			'description' => $req->description,
			'posted_by' => Auth::user()->id,
			'url' => $req->url,
			'is_file_requestable' => $req->is_file_requestable,
			'is_featured' => $req->is_featured,
			'date_published' => $req->date_published,
		]);

		// Handles the file
		for ($i = 0; $i < count($req->file); $i++) {
			if ($req->file('file.'.$i) == null)
				continue;
			
			// Generate file name
			$file = $req->file('file.'.$i);
			$fileName = 'research-'.uniqid().'.'.$file->getClientOriginalExtension();
			// Move file
			$filepath = 'uploads/research/'.Auth::user()->id.'/';
			$file->move($filepath, $fileName);

			ResearchFile::insert([
				'research_id' => $research->id,
				'original_name' => $file->getClientOriginalName(),
				'file' => $fileName
			]);
		}

		// Iterates through the already registered authors...
		foreach ($req->registeredAuthors as $ra) {
			//  ...and then store them respectively
			ResearchAuthors::insert([
				'research_id' => $research->id,
				'staff_id' => $ra
			]);
		}

		// Iterates through the selected research focuses...
		if ($req->focus != null)
			foreach ($req->focus as $f) {
				// ...and then store them respectively
				ResearchFocus::insert([
					'research_id' => $research->id,
					'focus_id' => $f
				]);
			}

		return redirect()
			->route('profile.research.index')
			->with('flash_success', 'Successfully added research ' . $req->title . '.');
	}

	protected function researchEdit($id) {
		if (Research::find($id) == null)
			abort(404);

		return view('users.auth.profile.show.research.edit', [
			'research' => Research::find($id),
			'focus' => Focus::get(),
			'staff' => FacultyStaff::join('users', 'users.id', '=', 'faculty_staffs.user_id')->orderBy('users.first_name', 'ASC')->get(['faculty_staffs.*']),
		]);
	}

	protected function researchUpdate(Request $req, $id) {

		if (!$req->has('is_file_requestable'))
			$req->request->set('is_file_requestable', '0');
		else
			$req->request->set('is_file_requestable', '1');

		if (!$req->has('is_featured'))
			$req->request->set('is_featured', '0');
		else
			$req->request->set('is_featured', '1');

		$isValidated = true;

		$validator = Validator::make($req->all(), [
			'title' => 'required|min:2',
			'file' => 'array',
			'url' => 'required_without_all:file|min:3',
			'registeredAuthors' => 'required',
			'description' => 'required|min:2|max:16777215',
			'date_published' => 'required|date',
			'registeredAuthors' => 'required',
		], [
			'title.required' => 'The title for your research is required.',
			'title.min' => 'Research title too short. If this is an error, please contact an admin.',
			'url.required_without_all' => 'The link for the research is required if there are no files provided.',
			'registeredAuthors.required' => 'Authors for this research is required.',
			'description.required' => 'A description or abstract for this research is required.',
			'description.min' => 'Please provide a proper description or abstract.',
			'description.max' => 'The description/abstract provided exceeds the 16 million character limit. Please omit some words or sentences.',
			'date_published.required' => 'The date this research was published is required.'
		]);

		if ($validator->fails())
			$isValidated = false;

		// Validates the files
		for ($i = 0; $i < count($req->file); $i++) {
			if ($req->file('file.'.$i) != null) {
				$fileValidator = Validator::make($req->all(), [
					'file.'.$i => 'mimes:pdf'
				], [
					'file.mimes.'.$i => 'File type should be PDF. If it is in word, please follow <a href="https://www.wikihow.com/Save-Word-As-a-PDF">this link</a> to convert your word document into a PDF.'
				]);

				if ($fileValidator->fails()) {
					$isValidated = false;
					$validator
						->messages()
						->merge($fileValidator->messages());
				}
			}
		}
		
		if (!$isValidated) {
			return redirect()
				->back()
				->withErrors($validator)
				->with('flash_message', 'Please re-select all the files you picked earlier.')
				->with('message', 'For security reasons, browsers does not allow us to retain the files selected. Thank you!')
				->withInput();
		}

		// Updates the research entry
		$research = Research::find($id);
		$research->title = $req->title;
		$research->authors = $req->authors;
		$research->description = $req->description;
		$research->posted_by = Auth::user()->id;
		$research->url = $req->url;
		$research->is_file_requestable = $req->is_file_requestable;
		$research->is_featured = $req->is_featured;
		$research->date_published = $req->date_published;
		// Save the changes
		$research->save();

		// Handles the file
		$fileCount = count($research->files);
		$files = array();
		// Gets the id of all files
		foreach ($research->files as $f)
			array_push($files, $f->id);
		// Modify the files that were edited
		if ($req->modifiedFiles != null) {
			foreach ($research->files as $f) {
				if (in_array($f->id, $req->modifiedFiles)) {
					$targetField = array_search($f->id, $req->keptFiles);
					// Get file name
					$file = $req->file('file.'.$targetField);
					$fileName = $f->file;
					$f->original_name = $file->getClientOriginalName();
					$f->save();
					// Delete old file
					File::delete(public_path() . '/uploads/research/' . Auth::user()->id . '/' . $f->file);
					// Move file
					$filepath = 'uploads/research/'.Auth::user()->id.'/';
					$file->move($filepath, $fileName);
				}
			}
		}

		// Removes all the files that were removed
		foreach ($research->files as $f) {
			if (!in_array($f->id, $req->keptFiles)) {
				ResearchFile::find($f->id)->delete();
				File::delete(public_path() . '/uploads/research/' . Auth::user()->id . '/' . $f->file);
				$fileCount--;
			}
		}
		// Gets the starting index of new files
		$startIndex = $req->keptFiles != null ? count($req->keptFiles) : 0;
		for ($i = $startIndex; $i < count($req->file); $i++) {
			if ($req->file('file.'.$i) == null)
				continue;
			// Generate file name
			$file = $req->file('file.'.$i);
			$fileName = 'research-'.uniqid().'.'.$file->getClientOriginalExtension();
			// Move file
			$filepath = 'uploads/research/'.Auth::user()->id.'/';
			$file->move($filepath, $fileName);

			ResearchFile::create([
				'research_id' => $research->id,
				'original_name' => $file->getClientOriginalName(),
				'file' => $fileName
			]);
		}

		// Remove the entries of registered authors if there's a change.
		$deleteRA = false;
		$ra = ResearchAuthors::where('research_id', $research->id);
		foreach ($req->registeredAuthors as $a) {
			if (!$ra->get()->contains($a)) {
				$deleteRA = true;
				break;
			}
		}
		if ($deleteRA)
			$ra->delete();
		// Iterates through the already registered authors...
		foreach ($req->registeredAuthors as $ra) {
			//  ...and then store them respectively
			ResearchAuthors::create([
				'research_id' => $research->id,
				'staff_id' => $ra
			]);
		}

		// Remove the entries of research focus if there's a change.
		$deleteRF = false;
		$rf = ResearchFocus::where('research_id', $research->id);
		if ($req->focus != null) {
			foreach ($req->focus as $f) {
				if (!$rf->get()->contains($f)) {
					$deleteRF = true;
					break;
				}
			}
		}
		if ($deleteRF)
			$rf->delete();
		// Iterates through the selected research focuses...
		if ($req->focus != null) {
			foreach ($req->focus as $f) {
				// ...and then store them respectively
				ResearchFocus::create([
					'research_id' => $research->id,
					'focus_id' => $f
				]);
			}
		}

		return redirect()
			->route('profile.research.index')
			->with('flash_success', 'Successfully updated research ' . $req->title . '.');
	}

	protected function researchDelete($id) {
		try {
			$research = Research::find($id);

			if ($research == null)
				return redirect()->back()->with('flash_error', 'Failed to delete the research entry.')->with('error', 'Research entry does not exists anymore.');
			else {
				// If the research is a file, delete the PDF as well.
				if ($research->is_file)
					File::delete(public_path() . '/uploads/research/' . Auth::user()->id . '/' . $research->url);
				$research->delete();
			}
		} catch (\Exception $e) {
			Log::error($e);
			return redirect()->back()->with('flash_error', 'Failed to delete the research entry.')->with('error', $e);
		}

		return redirect()->back()->with('flash_success', 'Successfully deleted research entry.');
	}

	protected function researchToggleIsFeature($id, $fromProfile=false) {
		$r = Research::find($id);

		if ($r == null) {
			return redirect()
				->back()
				->with('flash_error', 'Research not found.')
				->with('message', 'Research may have been deleted earlier and your table isn\'t updated.');
		}

		$r->is_featured = $r->is_featured == 1 ? 0 : 1;
		$r->save();

		$msg = 'Successfuly updated research entry.';
		if ($fromProfile)
			if ($r->is_featured)
				$msg = 'Research "' . $r->title . '" is pinned!';
			else
				$msg = 'Research "' . $r->title . '" is unpinned!';

		return redirect()
			->back()
			->with('flash_success', $msg);
	}

	// INNOVATION RELATED VIEWS
	protected function innovationsProfileIndex($sortBy='date') {
		$innovations = Innovation::where('posted_by', '=', Auth::user()->id);

		// SORT
		if (\Request::has('sortBy')) {
			$sortBy = \Request::get('sortBy');
			if ($sortBy == 'date') {
				$innovations = $innovations->orderBy('innovations.date_published', 'DESC');
			}
			else if ($sortBy == 'titleAsc') {
				$innovations = $innovations->orderBy('innovations.title', 'ASC');
			}
			else if ($sortBy == 'titleDesc') {
				$innovations = $innovations->orderBy('innovations.title', 'DESC');
			}
		}

		// SEARCH
		if (\Request::has('search')) {
			$search = \Request::get('search');
			
			// Joining the many-to-many tables innovations, innovation_focus, and focus
			$innovations = $innovations->join('innovation_focus', 'innovations.id', '=', 'innovation_focus.innovation_id')
				->join('focus', 'innovation_focus.focus_id', '=', 'focus.id');

			// Proceed to do the filtering
			$innovations = $innovations->where('innovations.title', 'LIKE', "%".$search."%")
				->orWhere('innovations.description', 'LIKE', "%".$search."%")
				->orWhere('innovations.url', 'LIKE', "%".$search."%")
				->orWhere('focus.name', 'LIKE', "%".$search."%");
		}

		if (!is_a($innovations, 'Illuminate\Support\Collection')) {
			$innovations = $innovations->get(['innovations.*']);
		}

		return view('users.auth.profile.show.innovations.profile_index', [
			'id' => Auth::user()->id,
			'user' => FacultyStaff::find(Auth::user()->id),
			'sortBy' => $sortBy,
			'searchVal' => \Request::get('search'),
			'innovations' => $innovations->sortByDesc('is_featured')
		]);
	}

	protected function innovationsIndex() {
		$sortBy = 'none';
		$innovations = Innovation::where('posted_by', '=', Auth::user()->id);

		// SORT
		if (\Request::has('sortBy')) {
			$sortBy = \Request::get('sortBy');
			if ($sortBy == 'titleAsc') {
				$innovations = $innovations->orderBy('title', 'ASC');
			}
			else if	($sortBy == 'titleDesc') {
				$innovations = $innovations->orderBy('title', 'DESC');
			}
			else if ($sortBy == 'datePublished') {
				$innovations = $innovations->orderBy('date_published', 'DESC');
			}
		}

		// SEARCH
		if (\Request::has('search')) {
			$search = \Request::get('search');
			
			// Joining the many-to-many tables innovation, innovation_focus, and focus
			$innovations = $innovations->join('innovation_focus', 'innovations.id', '=', 'innovation_focus.innovation_id')
				->join('focus', 'innovation_focus.focus_id', '=', 'focus.id');

			// Proceed to do the filtering
			$innovations = $innovations->where('innovations.title', 'LIKE', "%".$search."%")
				->orWhere('innovations.description', 'LIKE', "%".$search."%")
				->orWhere('innovations.url', 'LIKE', "%".$search."%")
				->orWhere('focus.name', 'LIKE', "%".$search."%");
		}

		if (!is_a($innovations, 'Illuminate\Support\Collection')) {
			$innovations = $innovations->get(['innovations.*']);
		}

		return view('users.auth.profile.show.innovations.index', [
			'id' => Auth::user()->id,
			'searchVal' => \Request::get('search'),
			'innovations' => $innovations
		]);
	}

	protected function innovationsCreate() {
		return view('users.auth.profile.show.innovations.create', [
			'focus' => Focus::get(),
			'staff' => FacultyStaff::join('users', 'users.id', '=', 'faculty_staffs.user_id')->orderBy('users.first_name', 'ASC')->get(['faculty_staffs.*']),
		]);
	}

	protected function innovationsStore(Request $req) {

		if (!$req->has('is_file_requestable'))
			$req->request->set('is_file_requestable', '0');
		else
			$req->request->set('is_file_requestable', '1');

		if (!$req->has('is_featured'))
			$req->request->set('is_featured', '0');
		else
			$req->request->set('is_featured', '1');

		$isValidated = true;

		$validator = Validator::make($req->all(), [
			'title' => 'required|min:2',
			'file' => 'array',
			'url' => 'required_without_all:file|min:3',
			'registeredAuthors' => 'required',
			'description' => 'required|min:2|max:16777215',
			'date_published' => 'required|date',
			'registeredAuthors' => 'required',
		], [
			'title.required' => 'The title for your innovation is required.',
			'title.min' => 'Innovation title too short. If this is an error, please contact an admin.',
			'url.required_without_all' => 'The link for the innovation is required if there are no files provided.',
			'registeredAuthors.required' => 'Authors for this innovation is required.',
			'description.required' => 'A description or abstract for this innovation is required.',
			'description.min' => 'Please provide a proper description or abstract.',
			'description.max' => 'The description/abstract provided exceeds the 16 million character limit. Please omit some words or sentences.',
			'date_published.required' => 'The date this innovation was published is required.'
		]);

		if ($validator->fails())
			$isValidated = false;

		// Validates the files
		for ($i = 0; $i < count($req->file); $i++) {
			if ($req->file('file.'.$i) != null) {
				$fileValidator = Validator::make($req->all(), [
					'file.'.$i => 'mimes:pdf'
				], [
					'file.mimes.'.$i => 'File type should be PDF. If it is in word, please follow <a href="https://www.wikihow.com/Save-Word-As-a-PDF">this link</a> to convert your word document into a PDF.'
				]);

				if ($fileValidator->fails()) {
					$isValidated = false;
					$validator
						->messages()
						->merge($fileValidator->messages());
				}
			}
		}
		
		if (!$isValidated) {
			dd($validator);
			return redirect()
				->back()
				->withErrors($validator)
				->with('flash_message', 'Please re-select all the files you picked earlier.')
				->with('message', 'For security reasons, browsers does not allow us to retain the files selected. Thank you!')
				->withInput();
		}

		// Creates the innovation entry
		$innovation = Innovation::create([
			'title' => $req->title,
			'authors' => $req->authors,
			'description' => $req->description,
			'posted_by' => Auth::user()->id,
			'url' => $req->url,
			'is_file_requestable' => $req->is_file_requestable,
			'is_featured' => $req->is_featured,
			'date_published' => $req->date_published,
		]);

		// Handles the file
		for ($i = 0; $i < count($req->file); $i++) {
			if ($req->file('file.'.$i) == null)
				continue;
			
			// Generate file name
			$file = $req->file('file.'.$i);
			$fileName = 'innovation-'.uniqid().'.'.$file->getClientOriginalExtension();
			// Move file
			$filepath = 'uploads/innovations/'.Auth::user()->id.'/';
			$file->move($filepath, $fileName);

			InnovationFile::insert([
				'innovation_id' => $innovation->id,
				'original_name' => $file->getClientOriginalName(),
				'file' => $fileName
			]);
		}

		// Iterates through the already registered authors...
		foreach ($req->registeredAuthors as $ra) {
			//  ...and then store them respectively
			InnovationAuthors::insert([
				'innovation_id' => $innovation->id,
				'staff_id' => $ra
			]);
		}

		// Iterates through the selected innovation focuses...
		if ($req->focus != null)
			foreach ($req->focus as $f) {
				// ...and then store them respectively
				InnovationFocus::insert([
					'innovation_id' => $innovation->id,
					'focus_id' => $f
				]);
			}

		return redirect()
			->route('profile.innovations.index')
			->with('flash_success', 'Successfully added innovation ' . $req->title . '.');
	}

	protected function innovationsEdit($id) {
		if (Innovation::find($id) == null)
			abort(404);

		return view('users.auth.profile.show.innovations.edit', [
			'innovation' => Innovation::find($id),
			'focus' => Focus::get(),
			'staff' => FacultyStaff::join('users', 'users.id', '=', 'faculty_staffs.user_id')->orderBy('users.first_name', 'ASC')->get(['faculty_staffs.*']),
		]);
	}

	protected function innovationsUpdate(Request $req, $id) {

		if (!$req->has('is_file_requestable'))
			$req->request->set('is_file_requestable', '0');
		else
			$req->request->set('is_file_requestable', '1');

		if (!$req->has('is_featured'))
			$req->request->set('is_featured', '0');
		else
			$req->request->set('is_featured', '1');

		$isValidated = true;

		$validator = Validator::make($req->all(), [
			'title' => 'required|min:2',
			'file' => 'array',
			'url' => 'required_without_all:file|min:3',
			'registeredAuthors' => 'required',
			'description' => 'required|min:2|max:16777215',
			'date_published' => 'required|date',
			'registeredAuthors' => 'required',
		], [
			'title.required' => 'The title for your innovation is required.',
			'title.min' => 'Innovation title too short. If this is an error, please contact an admin.',
			'url.required_without_all' => 'The link for the innovation is required if there are no files provided.',
			'registeredAuthors.required' => 'Authors for this innovation is required.',
			'description.required' => 'A description or abstract for this innovation is required.',
			'description.min' => 'Please provide a proper description or abstract.',
			'description.max' => 'The description/abstract provided exceeds the 16 million character limit. Please omit some words or sentences.',
			'date_published.required' => 'The date this innovation was published is required.'
		]);

		if ($validator->fails())
			$isValidated = false;

		// Validates the files
		for ($i = 0; $i < count($req->file); $i++) {
			if ($req->file('file.'.$i) != null) {
				$fileValidator = Validator::make($req->all(), [
					'file.'.$i => 'mimes:pdf'
				], [
					'file.mimes.'.$i => 'File type should be PDF. If it is in word, please follow <a href="https://www.wikihow.com/Save-Word-As-a-PDF">this link</a> to convert your word document into a PDF.'
				]);

				if ($fileValidator->fails()) {
					$isValidated = false;
					$validator
						->messages()
						->merge($fileValidator->messages());
				}
			}
		}
		
		if (!$isValidated) {
			return redirect()
				->back()
				->withErrors($validator)
				->with('flash_message', 'Please re-select all the files you picked earlier.')
				->with('message', 'For security reasons, browsers does not allow us to retain the files selected. Thank you!')
				->withInput();
		}

		// Updates the innovation entry
		$innovation = Innovation::find($id);
		$innovation->title = $req->title;
		$innovation->authors = $req->authors;
		$innovation->description = $req->description;
		$innovation->posted_by = Auth::user()->id;
		$innovation->url = $req->url;
		$innovation->is_file_requestable = $req->is_file_requestable;
		$innovation->is_featured = $req->is_featured;
		$innovation->date_published = $req->date_published;
		// Save the changes
		$innovation->save();

		// Handles the file
		$fileCount = count($innovation->files);
		$files = array();
		// Gets the id of all files
		foreach ($innovation->files as $f)
			array_push($files, $f->id);
		// Modify the files that were edited
		if ($req->modifiedFiles != null) {
			foreach ($innovation->files as $f) {
				if (in_array($f->id, $req->modifiedFiles)) {
					$targetField = array_search($f->id, $req->keptFiles);
					// Get file name
					$file = $req->file('file.'.$targetField);
					$fileName = $f->file;
					$f->original_name = $file->getClientOriginalName();
					$f->save();
					// Delete old file
					File::delete(public_path() . '/uploads/innovations/' . Auth::user()->id . '/' . $f->file);
					// Move file
					$filepath = 'uploads/innovations/'.Auth::user()->id.'/';
					$file->move($filepath, $fileName);
				}
			}
		}

		// Removes all the files that were removed
		foreach ($innovation->files as $f) {
			if (!in_array($f->id, $req->keptFiles)) {
				InnovationFile::find($f->id)->delete();
				File::delete(public_path() . '/uploads/innovations/' . Auth::user()->id . '/' . $f->file);
				$fileCount--;
			}
		}
		// Gets the starting index of new files
		$startIndex = $req->keptFiles != null ? count($req->keptFiles) : 0;
		for ($i = $startIndex; $i < count($req->file); $i++) {
			if ($req->file('file.'.$i) == null)
				continue;
			// Generate file name
			$file = $req->file('file.'.$i);
			$fileName = 'innovation-'.uniqid().'.'.$file->getClientOriginalExtension();
			// Move file
			$filepath = 'uploads/innovations/'.Auth::user()->id.'/';
			$file->move($filepath, $fileName);

			InnovationFile::create([
				'innovation_id' => $innovation->id,
				'original_name' => $file->getClientOriginalName(),
				'file' => $fileName
			]);
		}

		// Remove the entries of registered authors if there's a change.
		$deleteRA = false;
		$ra = InnovationAuthors::where('innovation_id', $innovation->id);
		foreach ($req->registeredAuthors as $a) {
			if (!$ra->get()->contains($a)) {
				$deleteRA = true;
				break;
			}
		}
		if ($deleteRA)
			$ra->delete();
		// Iterates through the already registered authors...
		foreach ($req->registeredAuthors as $ra) {
			//  ...and then store them respectively
			InnovationAuthors::create([
				'innovation_id' => $innovation->id,
				'staff_id' => $ra
			]);
		}

		// Remove the entries of innovation focus if there's a change.
		$deleteIF = false;
		$rf = InnovationFocus::where('innovation_id', $innovation->id);
		if ($req->focus != null) {
			foreach ($req->focus as $f) {
				if (!$rf->get()->contains($f)) {
					$deleteIF = true;
					break;
				}
			}
		}
		if ($deleteIF)
			$rf->delete();
		// Iterates through the selected innovation focuses...
		if ($req->focus != null) {
			foreach ($req->focus as $f) {
				// ...and then store them respectively
				innovationFocus::create([
					'innovation_id' => $innovation->id,
					'focus_id' => $f
				]);
			}
		}

		return redirect()
			->route('profile.innovations.index')
			->with('flash_success', 'Successfully updated innovation ' . $req->title . '.');
	}

	protected function innovationsDelete($id) {
		try {
			$innovation = Innovation::find($id);

			if ($innovation == null)
				return redirect()->back()->with('flash_error', 'Failed to delete the innovatioin entry.')->with('error', 'Innovation entry does not exists anymore.');
			else {
				// If the innovation is a file, delete the PDF as well.
				if ($innovation->is_file)
					File::delete(public_path() . '/uploads/innovations/' . Auth::user()->id . '/' . $innovation->url);
				$innovation->delete();
			}
		} catch (\Exception $e) {
			Log::error($e);
			return redirect()->back()->with('flash_error', 'Failed to delete the innovation entry.')->with('error', $e);
		}

		return redirect()->back()->with('flash_success', 'Successfully deleted innovation entry.');
	}

	protected function innovationsToggleIsFeature($id, $fromProfile=false) {
		$r = Innovation::find($id);

		if ($r == null) {
			return redirect()
				->back()
				->with('flash_error', 'Innovation not found.')
				->with('message', 'Innovation may have been deleted earlier and your table isn\'t updated.');
		}

		$r->is_featured = $r->is_featured == 1 ? 0 : 1;
		$r->save();

		$msg = 'Successfuly updated innovation entry.';
		if ($fromProfile)
			if ($r->is_featured)
				$msg = 'Innovation "' . $r->title . '" is pinned!';
			else
				$msg = 'Innovation "' . $r->title . '" is unpinned!';

		return redirect()
			->back()
			->with('flash_success', $msg);
	}

	// COURSE MATERIAL RELATED VIEWS
	protected function materialsProfileIndex($sortBy='date') {
		// TEMPLATE START
		$materials = Material::where('faculty_staff_id', '=', Auth::user()->staff->id);

		// SORT
		if (\Request::has('sortBy')) {
			$sortBy = \Request::get('sortBy');
			if ($sortBy == 'date') {
				$materials = $materials->orderBy('materials.date_published', 'DESC');
			}
			else if ($sortBy == 'titleAsc') {
				$materials = $materials->orderBy('materials.title', 'ASC');
			}
			else if ($sortBy == 'titleDesc') {
				$materials = $materials->orderBy('materials.title', 'DESC');
			}
		}

		// SEARCH
		if (\Request::has('search')) {
			$search = \Request::get('search');
			
			// Joining the one-to-many tables topics to materials
			$materials = $materials->join('topics', 'materials.topic_id', '=', 'topics.id');

			// Proceed to do the filtering
			$materials = $materials->where('materials.material_name', 'LIKE', "%".$search."%")
				->orWhere('materials.description', 'LIKE', "%".$search."%")
				->orWhere('topics.topic_name', 'LIKE', "%".$search."%");
		}

		if (!is_a($materials, 'Illuminate\Support\Collection')) {
			$materials = $materials->get(['materials.*']);
		}
		// END OF TEMPLATE

		// $material = Material::where('faculty_staff_id', '=', FacultyStaff::where('user_id', Auth::user()->id)->first()->id)->get();
		$topic_names = array();

		foreach ($materials as $m)
			if (!in_array($m->topic->topic_name, $topic_names))
				array_push($topic_names, $m->topic->topic_name);

		return view('users.auth.profile.show.topics.materials.profile_index', [
			'user' => FacultyStaff::where('user_id', Auth::user()->id)->first(),
			'sortBy' => $sortBy,
			'searchVal' => \Request::get('search'),
			'topic_names' => $topic_names,
			'topics' => Topic::get()
		]);
	}

	protected function materialsIndex($id) {
		return view('users.auth.profile.show.topics.materials.index', [
			'topic' => Topic::find($id),
			'topics' => Topic::get(),
			'materials' => Material::where('topic_id', $id)->where('faculty_staff_id', Auth::user()->staff->id)->get()
		]);
	}

	protected function materialsCreate($id) {
		return view('users.auth.profile.show.topics.materials.create', [
			'selected_topic' => Topic::find($id),
			'topics' => Topic::get()
		]);
	}

	protected function materialsEdit($id) {
		$material = Material::find($id);

		return view('users.auth.profile.show.topics.materials.edit', [
			'material' => $material,
			'selected_topic' => Topic::find($id),
			'topics' => Topic::get()
		]);
	}

	protected function materialsUpdate(Request $req, $id) {
		return redirect()
			->route('profile.topics.materials.index')
			->with('flash_success'. 'Successfully updated material "' . $req->material_name . '".');
	}

	protected function materialsMove(Request $req, $topicId, $id) {

		$validator = Validator::make([
			'topic' => 'required|min:2|max:256',
		], [
			'topic.required' => 'Topic name is required.',
			'topic.min' => 'Topic name is too short.',
			'topic.max' => 'Topic name is too long. If it exceeds 256 character, please covert it as an abbreviation instead.',
		]);

		if ($validator->fails()) {
			return redirect()
				->back()
				->withErrors($validator)
				->with('toggle_modal', $id)
				->withInput();
		}

		$target_topic = Topic::where('topic_name', $req->topic)->first();
		if ($target_topic == null)
			$target_topic = Topic::create([
				'topic_name' => ucwords($req->topic_name)
			]);
		
		$mats = Material::find($id);

		$mats->topic_id = $target_topic->id;
		$mats->save();

		return redirect()
			->route('profile.topics.index')
			->with('flash_success'. 'Successfully moved materials from ' . Topic::find($topicId)->topic_name . ' to ' . $target_topic->topic_name . '.');
	}

	// TOPICS RELATED VIEWS
	protected function topicIndex() {
		$material = Material::where('faculty_staff_id', '=', FacultyStaff::where('user_id', Auth::user()->id)->first()->id)->get();
		$topic_names = array();

		foreach ($material as $m)
			if (!in_array($m->topic->topic_name, $topic_names))
				array_push($topic_names, $m->topic->topic_name);

		return view('users.auth.profile.show.topics.index', [
			'topic_names' => $topic_names,
			'topics' => Topic::get()
		]);
	}

	protected function topicCreate() {
		return view('users.auth.profile.show.topics.create', [
			'topics' => Topic::get()
		]);
	}

	protected function topicStore(Request $req) {
		$fromMats = $req->has('fromMats') ? $req->fromMats : false;
		$isValidated = true;

		$validator = Validator::make($req->all(), [
			// VALIDATION RULES
			'topic_name' => 'required|min:2|max:256',
			'material_name' => 'required|min:2|max:256',
			'url' => 'array',
			'file' => 'array',
			'description' => 'required|min:2|max:16777215',
		], [
			// VALIDATION ERROR MESSAGES
			'topic_name.required' => 'Topic name is required.',
			'topic_name.min' => 'Topic name is too short.',
			'topic_name.max' => 'Topic name is too long. If it exceeds 256 character, please covert it as an abbreviation instead.',
			'material_name.required' => 'Material name/Title is required.',
			'material_name.min' => 'Material name/Title is too short.',
			'material_name.max' => 'Material name/Title is too long. If it exceeds 256 character, please covert it as an abbreviation instead.',
			'description.required' => 'A description or abstract for this research is required.',
			'description.min' => 'Please provide a proper description or abstract.',
			'description.max' => 'The description/abstract provided exceeds the 16 million character limit. Please omit some words or sentences.',
		]);

		if ($validator->fails())
			$isValidated = false;

		for ($i = 0; $i < count($req->url); $i++) {
			if ($req->url[$i] != null || strlen($req->url[$i]) > 0) {
				$urlValidator = Validator::make($req->all(), [
					'url.'.$i => 'url'
				], [
					'url.'.$i.'.url' => 'Value provided is not a valid URL.',
				]);

				if ($urlValidator->fails()) {
					$isValidated = false;
					$validator
						->messages()
						->merge($urlValidator->messages());
				}
			}
		}

		//////////////////////////////////////////////////////////////////////////////////////////////////////
		// {{-- FIX PPTX NOT BEING UPLOADED AS PPTX -> WAS IDENTIFIED AS OCTET-STREAM RATHER THAN PPTX --}} //
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		for ($i = 0; $i < count($req->file); $i++) {
			if ($req->file('file.'.$i) != null) {
				$fileValidator = Validator::make($req->all(), [
					'file.'.$i => 'mimes:pdf,pptx,docx|max:10248'
				], [
					'file.'.$i.'.mimes' => 'File type should either be a PDF, PPTX or DOCX.',
					'url.'.$i.'.max' => 'File exceeded the 10MB limit.'
				]);

				if ($urlValidator->fails()) {
					$isValidated = false;
					$validator
						->messages()
						->merge($fileValidator->messages());
				}
			}
		}

		if (!$isValidated) {
			return redirect()
				->back()
				->withErrors($validator)
				->with('flash_message', 'Please re-select all the files you picked earlier.')
				->with('message', 'For security reasons, browsers does not allow us to retain the files selected. Thank you!')
				->withInput();
		}

		$topic = Topic::where('topic_name', $req->topic_name)->first();
		if (count(Topic::where('topic_name', $req->topic_name)->get()) == 0)
			$topic = Topic::create([
				'topic_name' => ucwords($req->topic_name)
			]);

		$material = Material::create([
			'topic_id' => $topic->id,
			'material_name' => $req->material_name,
			'faculty_staff_id' => User::find(Auth::user()->id)->staff->id,
			'description' => $req->description,
		]);

		for ($i = 0; $i < count($req->file); $i++) {
			if ($req->file('file.'.$i) == null)
				continue;

			// Generate file name
			$file = $req->file('file.'.$i);
			$fileName = 'materials-'.uniqid().'.'.$file->getClientOriginalExtension();
			// Move file
			$filepath = 'uploads/materials/'.Auth::user()->id.'/';
			$file->move($filepath, $fileName);

			MaterialFiles::insert([
				'material_id' => $material->id,
				'file_name' => $fileName
			]);
		}

		for ($i = 0; $i < count($req->url); $i++) {
			if ($req->url[$i] == null)
				continue;

			MaterialLinks::insert([
				'material_id' => $material->id,
				'url' => $req->url[$i]
			]);
		}

		return redirect()
			->route(($fromMats ? 'profile.topics.materials.index' : 'profile.topics.index'), [$topic->id])
			->with('flash_success', 'Successfully added Material ' . ucwords($req->material_name) . '.');
	}

	protected function topicEdit($id) {
		return view('users.auth.profile.show.topics.edit', [
			'selected_topic' => Topic::find($id),
			'topics' => Topic::get()
		]);
	}

	protected function topicUpdate(Request $req, $id) {
		$validator = Validator::make([
			'topic_name' => 'required|min:2|max:256',
		], [
			'topic_name.required' => 'Topic name is required.',
			'topic_name.min' => 'Topic name is too short.',
			'topic_name.max' => 'Topic name is too long. If it exceeds 256 character, please covert it as an abbreviation instead.',
		]);

		if ($validator->fails()) {
			return redirect()
				->back()
				->withErrors($validator)
				->withInput();
		}

		$target_topic = Topic::where('topic_name', $req->topic_name)->first();
		if (count(Topic::where('topic_name', $req->topic_name)->get()) == 0)
			$target_topic = Topic::create([
				'topic_name' => ucwords($req->topic_name)
			]);

		$topic = Topic::find($id);
		$mats = Material::where('topic_id', $id)->where('faculty_staff_id', Auth::user()->staff->id)->get();

		foreach ($mats as $m) {
			$m->topic_id = $target_topic->id;
			$m->save();
		}

		return redirect()
			->route('profile.topics.index')
			->with('flash_success'. 'Successfully moved materials from ' . $topic->topic_name . ' to ' . $target_topic->topic_name . '.');
	}

	protected function topicDelete($id) {
		$topic = Topic::find($id);
		$mat = Material::where('topic_id', $id)->where('faculty_staff_id', Auth::user()->staff->id);

		foreach ($mat->get() as $m)
			if ($m->is_file)
				File::delete(public_path() . '/uploads/materials/' . Auth::user()->id . '/' . $m->url);

		$materials = $mat->delete();

		return redirect()
			->route('profile.topics.index')
			->with('flash_success', 'Successfully removed ' . $topic->topic_name . ' along with all materials.');
	}
}