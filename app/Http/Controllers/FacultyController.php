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
				// ...leftJoin tables faculty_staff and faculty_focus, then get all the distinct entries that will match with the selected focus. Lastly, get the columns from faculty_staff tables only,
				$focus = FacultyFocus::leftJoin('faculty_staffs', 'faculty_staffs.id', '=', 'faculty_focus.faculty_staff_id')
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
				if (substr($dept, 0, 7) == 'College' || substr($dept, 0, 6) == 'Others') {
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
				// ...leftJoin tables users and faculty_staff, then order them ascendingly by their last name. Lastly, get all the columns from faculty_staff tables only.
				$staff = $staff->leftJoin('users', 'users.id', '=', 'faculty_staffs.user_id')
					->orderBy('users.last_name', 'ASC');
					// ->get(['faculty_staffs.*']);
			}
			// If the sorting is by first name...
			else if	($sortBy == 'firstName') {
				// ...leftJoin tables users and faculty_staff, then order them ascendingly by their first name. Lastly, get all the columns from faculty_staff tables only.
				$staff = $staff->leftJoin('users', 'users.id', '=', 'faculty_staffs.user_id')
					->orderBy('users.first_name', 'ASC');
					// ->get(['faculty_staffs.*']);
			}
			// If the sorting is by position...
			else if ($sortBy == 'position') {
				// ...leftJoin tables users and faculty_staff, then order them ascendingly by their position, then first name. Lastly, get all the columns from faculty_staff tables only.
				$staff = $staff->leftJoin('users', 'users.id', '=', 'faculty_staffs.user_id')
					->orderBy('faculty_staffs.position', 'ASC')
					->orderBy('users.first_name', 'ASC');
					// ->get(['faculty_staffs.*']);
			}
		}

		// SEARCH
		if (\Request::has('search')) {
			$search = \Request::get('search');

			if (!\Request::has('sortBy') || $sortBy == 'none') {
				$staff = $staff->leftJoin('users', 'users.id', '=', 'faculty_staffs.user_id');
			}
			$staff->leftJoin('staff_types', 'staff_types.id', '=', 'faculty_staffs.position')
				// leftJoining the many-to-many tables faculty_focus, faculty_staff, and focus
				->leftJoin('faculty_focus', 'faculty_staffs.id', '=', 'faculty_focus.faculty_staff_id')
				->leftJoin('focus', 'faculty_focus.focus_id', '=', 'focus.id')
				// Proceed to do the filtering
				->where('staff_types.type', 'LIKE', '%'.preg_replace("/ /", "_", $search).'%')
				->orWhere('faculty_staffs.location', 'LIKE', '%'.$search.'%')
				->orWhere('faculty_staffs.description', 'LIKE', '%'.$search.'%')
				->orWhere('users.first_name', 'LIKE', '%'.$search.'%')
				->orWhere('users.middle_name', 'LIKE', '%'.$search.'%')
				->orWhere('users.last_name', 'LIKE', '%'.$search.'%')
				->orWhere('users.email', 'LIKE', '%'.$search.'%')
				->orWhere('focus.name', 'LIKE', '%'.$search.'%');
		}
		
		if (!is_a($staff, 'Illuminate\Support\Collection')) {
			$staff = $staff->distinct()->get(['faculty_staffs.*']);
		}

		if (!\Request::has('sortBy') || \Request::get('sortBy') == 'none') {
			$staff = $staff->sortByDesc('department');
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

	protected function research($id, $sortBy='date') {
		$research = Research::where('posted_by', $id);

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
			
			// leftJoining the many-to-many tables research, research_focus, and focus
			$research = $research->leftJoin('research_focus', 'research.id', '=', 'research_focus.research_id')
				->leftJoin('focus', 'research_focus.focus_id', '=', 'focus.id');

			// Proceed to do the filtering
			$research = $research->where('research.title', 'LIKE', "%".$search."%")
				->orWhere('research.description', 'LIKE', "%".$search."%")
				->orWhere('research.url', 'LIKE', "%".$search."%")
				->orWhere('focus.name', 'LIKE', "%".$search."%");
		}

		if (!is_a($research, 'Illuminate\Support\Collection')) {
			$research = $research->get(['research.*']);
		}

		return view('users.faculty.show.research', [
			'id' => $id,
			'staff' => FacultyStaff::find($id),
			'sortBy' => $sortBy,
			'searchVal' => \Request::get('search'),
			'research' => $research->sortByDesc('is_featured'),
		]);
	}

	protected function innovations($id, $sortBy='date') {
		$innovations = Innovation::where('posted_by', '=', $id);

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
			
			// leftJoining the many-to-many tables innovations, innovation_focus, and focus
			$innovations = $innovations->leftJoin('innovation_focus', 'innovations.id', '=', 'innovation_focus.innovation_id')
				->leftJoin('focus', 'innovation_focus.focus_id', '=', 'focus.id');

			// Proceed to do the filtering
			$innovations = $innovations->where('innovations.title', 'LIKE', "%".$search."%")
				->orWhere('innovations.description', 'LIKE', "%".$search."%")
				->orWhere('innovations.url', 'LIKE', "%".$search."%")
				->orWhere('focus.name', 'LIKE', "%".$search."%");
		}

		if (!is_a($innovations, 'Illuminate\Support\Collection')) {
			$innovations = $innovations->get(['innovations.*']);
		}

		return view('users.faculty.show.innovations', [
			'id' => $id,
			'staff' => FacultyStaff::find($id),
			'sortBy' => $sortBy,
			'searchVal' => \Request::get('search'),
			'innovations' => $innovations->sortByDesc('is_featured'),
		]);
	}

	protected function materials($id, $sortBy='date') {
		// TEMPLATE START
		$materials = Material::where('faculty_staff_id', '=', $id);

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
			
			// leftJoining the one-to-many tables topics to materials
			$materials = $materials->leftJoin('topics', 'materials.topic_id', '=', 'topics.id');

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

		return view('users.faculty.show.materials', [
			'staff' => FacultyStaff::find($id),
			'sortBy' => $sortBy,
			'searchVal' => \Request::get('search'),
			'topic_names' => $topic_names,
			'topics' => Topic::get()
		]);
	}
}