<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\FacultyStaff;
use App\FacultyFocus;
use App\College;
use App\Departments;
use App\Focus;
use App\Research;
use App\Innovation;
use App\Material;
use App\Affiliation;
use App\OtherProfile;
use App\Topic;

use Auth;

class FacultyController extends Controller
{
	// TEMPORARY SUBSTITUTE... TO BE REMOVE ONCE BACKEND IS ATTACHED
	private function getStaff() {
		return TmpController::getStaff();
	}

	protected function index($dept='All',$sortBy='none',$rf='all') {
		$staff = new FacultyStaff;
		$college = College::get();

		// RESEARCH FOCUS
		if (\Request::has('researchFocus')) {
			$rf = \Request::get('researchFocus');
			$rfArr = array();
			$focus = array();

			// the focus is not equals to "all"...
			if ($rf != 'all') {
				// ...join tables faculty_staff and faculty_focus, then get all the distinct entries that will match with the selected focus. Lastly, get the columns from faculty_staff tables only,
				$focus = FacultyFocus::join('faculty_staffs', 'faculty_staffs.id', '=', 'faculty_focus.faculty_staff_id')
					->where('faculty_focus.focus_id', '=', Focus::where('name', '=', $rf)->first()->id)->distinct()->get(['faculty_staffs.*']);
			
				// After the last step, proceed to push the faculty_staff.id to the $focus array variable... 
				foreach ($focus as $f) {
					array_push($rfArr, $f->id);
				}

				// ...where finally, will be used as a filter for the $staff variable.
				$staff = $staff->whereIn('faculty_staffs.id', $rfArr);
			}
		}

		// FILTER
		if (\Request::has('dept')) {
			$dept = \Request::get('dept');
			if ($dept != 'All') {
				$deptArr = array();
				
				// If the first 7 letters of the deptartment filter is "College" (given that all colleges starts with "College of ...")
				if (substr($dept, 0, 7) == 'College') {
					// ...get all the departments under that college then add them to the $deptArr array.
					foreach (Departments::where('college', '=', College::where('name', '=', $dept)->first()->id)->get() as $d) {
						array_push($deptArr, $d->id);
					}
				}
				// Otherwise, just add the id of the selected department to the $deptArr array.
				else {
					array_push($deptArr, Departments::where('name', '=', $dept)->first()->id);
				}
				
				// After that, filter the results.
				$staff = $staff->whereIn('department', $deptArr);
			}
		}

		// SORT
		if (\Request::has('sortBy')) {
			$sortBy = \Request::get('sortBy');
			// If the sorting is by last name...
			if ($sortBy == 'lastName') {
				// ...join tables users and faculty_staff, then order them ascendingly by their last name. Lastly, get all the columns from faculty_staff tables only.
				$staff = $staff->join('users', 'users.id', '=', 'faculty_staffs.user_id')
					->orderBy('users.last_name', 'ASC');
					// ->get(['faculty_staffs.*']);
			}
			// If the sorting is by first name...
			else if	($sortBy == 'firstName') {
				// ...join tables users and faculty_staff, then order them ascendingly by their first name. Lastly, get all the columns from faculty_staff tables only.
				$staff = $staff->join('users', 'users.id', '=', 'faculty_staffs.user_id')
					->orderBy('users.first_name', 'ASC');
					// ->get(['faculty_staffs.*']);
			}
			// If the sorting is by position...
			else if ($sortBy == 'position') {
				// ...join tables users and faculty_staff, then order them ascendingly by their position, then first name. Lastly, get all the columns from faculty_staff tables only.
				$staff = $staff->join('users', 'users.id', '=', 'faculty_staffs.user_id')
					->orderBy('faculty_staffs.position', 'ASC')
					->orderBy('users.first_name', 'ASC');
					// ->get(['faculty_staffs.*']);
			}
		}

		// SEARCH
		if (\Request::has('search')) {
			$search = \Request::get('search');

			if (!\Request::has('sortBy') || $sortBy == 'none') {
				$staff = $staff->join('users', 'users.id', '=', 'faculty_staffs.user_id');
			}
			$staff->join('staff_types', 'staff_types.id', '=', 'faculty_staffs.position')
				// Joining the many-to-many tables faculty_focus, faculty_staff, and focus
				->join('faculty_focus', 'faculty_staffs.id', '=', 'faculty_focus.faculty_staff_id')
				->join('focus', 'faculty_focus.focus_id', '=', 'focus.id')
				// Proceed to do the filtering
				->whereRaw('staff_types.type LIKE CONCAT("%", ?, "%")', [preg_replace("/ /", "_", $search)])
				->orWhereRaw('faculty_staffs.location LIKE CONCAT("%", ?, "%")', [$search])
				->orWhereRaw('faculty_staffs.description LIKE CONCAT("%", ?, "%")', [$search])
				->orWhereRaw('users.first_name LIKE CONCAT("%", ?, "%")', [$search])
				->orWhereRaw('users.middle_name LIKE CONCAT("%", ?, "%")', [$search])
				->orWhereRaw('users.last_name LIKE CONCAT("%", ?, "%")', [$search])
				->orWhereRaw('users.email LIKE CONCAT("%", ?, "%")', [$search])
				->orWhereRaw('focus.name LIKE CONCAT("%", ?, "%")', [$search]);
		}
		
		if (!is_a($staff, 'Illuminate\Support\Collection')) {
			try {
				$staff = $staff->distinct()->get();
			} catch (\Exception $e) {
				dd($staff->toSql());
				dd($e);
			}
		}
		
		// RETURN
		return view('users.faculty.index', [
			'college' => $college,
			'dept' => $dept,
			'sortBy' => $sortBy,
			'researchFocus' => $rf,
			'searchVal' => \Request::get('search'),
			'research_focus' => Focus::get(),
			'staff' => $staff
		]);
	}

	protected function show($id) {
		return view('users.faculty.show', [
			'staff' => FacultyStaff::find($id),
			'research' => Auth::check() ? Research::where('posted_by', $id)->take(3)->get() : Research::where('posted_by', $id)->where('is_featured', 1)->take(3)->get(),
			'innovations' => Auth::check() ? Innovation::where('posted_by', $id)->take(3)->get() : Innovation::where('posted_by', $id)->where('is_featured', 1)->take(3)->get(),
			'materials' => Material::where('faculty_staff_id', $id)->take(5)->get(),
			'matCount' => count(Material::where('faculty_staff_id', $id)->get()),
			'affiliations' => Affiliation::where('user_id', FacultyStaff::find($id)->user_id)->get(),
			'other_profiles' => OtherProfile::where('user_id', FacultyStaff::find($id)->user_id)->get()
		]);
	}

	protected function research($id) {
		$sortBy = 'none';
		$research = Research::where('posted_by', $id);

		// SORT
		if (\Request::has('sortBy')) {
			$sortBy = \Request::get('sortBy');
			if ($sortBy == 'titleAsc') {
				$research = $research->orderBy('title', 'ASC');
			}
			else if	($sortBy == 'titleDesc') {
				$research = $research->orderBy('title', 'DESC');
			}
			else if ($sortBy == 'datePublished') {
				$research = $research->orderBy('date_published', 'DESC');
			}
		}

		// SEARCH
		if (\Request::has('search')) {
			$search = \Request::get('search');

			$research->whereRaw('title LIKE CONCAT("%", ?, "%")', [preg_replace("/ /", "_", $search)])
				->orWhereRaw('authors LIKE CONCAT("%", ?, "%")', [$search])
				->orWhereRaw('description LIKE CONCAT("%", ?, "%")', [$search])
				->orWhereRaw('url LIKE CONCAT("%", ?, "%")', [$search]);
		}
		
		if (!is_a($research, 'Illuminate\Support\Collection')) {
			$research = $research->get();
		}

		return view('users.faculty.show.research', [
			'staff' => FacultyStaff::find($id),
			'research' => $research,
			'sortBy' => $sortBy,
			'searchVal' => \Request::get('search'),
			'id' => $id
		]);
	}

	protected function innovations($id) {
		$sortBy = 'none';
		$innovations = Innovation::where('posted_by', $id);

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

			$innovations->whereRaw('title LIKE CONCAT("%", ?, "%")', [preg_replace("/ /", "_", $search)])
				->orWhereRaw('authors LIKE CONCAT("%", ?, "%")', [$search])
				->orWhereRaw('description LIKE CONCAT("%", ?, "%")', [$search])
				->orWhereRaw('url LIKE CONCAT("%", ?, "%")', [$search]);
		}
		
		if (!is_a($innovations, 'Illuminate\Support\Collection')) {
			$innovations = $innovations->get();
		}

		return view('users.faculty.show.innovations', [
			'id' => $id,
			'staff' => FacultyStaff::find($id),
			'sortBy' => $sortBy,
			'searchVal' => \Request::get('search'),
			'innovations' => $innovations,
		]);
	}

	protected function materials($id, $sortBy='date') {
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
			$materials = $materials->whereRaw('materials.material_name LIKE CONCAT("%", ?, "%")', [$search])
				->orWhereRaw('materials.description LIKE CONCAT("%", ?, "%")', [$search])
				->orWhereRaw('materials.url LIKE CONCAT("%", ?, "%")', [$search])
				->orWhereRaw('topics.topic_name LIKE CONCAT("%", ?, "%")', [$search]);
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

		return view('users.faculty.show.materials', [
			'staff' => FacultyStaff::find($id),
			'sortBy' => $sortBy,
			'searchVal' => \Request::get('search'),
			'topic_names' => $topic_names,
			'topics' => Topic::get()
		]);
	}
}