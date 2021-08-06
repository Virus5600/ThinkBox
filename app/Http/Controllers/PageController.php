<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use \Carbon\Carbon;

use App\FacultyStaff;
use App\ResearchFocus;
use App\InnovationFocus;
use App\Announcements;
use App\Research;
use App\Innovation;
use App\Material;
use App\College;
use App\Departments;
use App\Focus;

use Log;

class PageController extends Controller
{
	// USER SIDE (AUTH AND UNAUTH)
	protected function index() {
		$staff = FacultyStaff::leftJoin('users', 'users.id', '=', 'faculty_staffs.user_id')->orderBy('users.last_name')->get(['faculty_staffs.*'])->take(8);
		$announcements = Announcements::latest()->get()->take(3);
		$research = Auth::check() ? Research::orderBy('date_published', 'DESC')->get()->take(3) : Research::where('is_featured', 1)->orderBy('date_published', 'DESC')->get()->take(3);
		$innovations = Auth::check() ? Innovation::orderBy('date_published', 'DESC')->get()->take(3) : Innovation::where('is_featured', 1)->orderBy('date_published', 'DESC')->get()->take(3);

		return view('users.index', [
			'staff' => $staff->sortByDesc('department'),
			'announcements' => $announcements,
			'research' => $research,
			'innovations' => $innovations
		]);
	}

	protected function redirectLogin() {
		if (Auth::check())
			return redirect()->route(Input::get('routeName'), Input::get('param'))->with('flash_success', 'Logged in!');
		return redirect()->guest('login');
	}

	protected function researches($dept='All',$sortBy='date',$rf='all') {
		$college = College::get();
		$research = new Research;

		// FILTER
		if (\Request::has('dept')) {
			$dept = \Request::get('dept');
			if ($dept != 'All') {
				$deptArr = array();
				$staffArr = array();
				
				if (substr($dept, 0, 7) == 'College' || substr($dept, 0, 6) == 'Others') {
					foreach (Departments::where('college', '=', College::where('name', '=', $dept)->first()->id)->get() as $d) {
						array_push($deptArr, $d->id);
					}
				}
				else {
					array_push($deptArr, Departments::where('name', '=', $dept)->first()->id);
				}
				
				foreach (FacultyStaff::whereIn('department', $deptArr)->get() as $s) {
					array_push($staffArr, $s->id);
				}
				
				$research = $research->whereIn('research.posted_by', $staffArr);
			}
		}

		// RESEARCH FOCUS
		if (\Request::has('researchFocus')) {
			$rf = \Request::get('researchFocus');
			$rfArr = array();
			$focus = array();

			if ($rf != 'all') {
				if (Auth::check()) {
					$focus = ResearchFocus::leftJoin('research', 'research.id', '=', 'research_focus.research_id')
						->where('research_focus.focus_id', '=', Focus::where('name', '=', $rf)->first()->id)
						->distinct()
						->get(['research.*']);
				}
				else {
					$focus = ResearchFocus::leftJoin('research', 'research.id', '=', 'research_focus.research_id')
						->where('research_focus.focus_id', '=', Focus::where('name', '=', $rf)->first()->id)
						->where('is_featured', 1)
						->distinct()
						->get(['research.*']);
				}

				foreach ($focus as $f) {
					array_push($rfArr, $f->id);
				}

				$research = $research->whereIn('research.id', $rfArr);
			}
		}

		// SORT
		if (\Request::has('sortBy')) {
			$sortBy = \Request::get('sortBy');
			if ($sortBy == 'authorFirstName') {
				$research = $research->leftJoin('users', 'users.id', '=', 'research.posted_by')
					->orderBy('users.first_name', 'ASC');
			}
			else if	($sortBy == 'authorLastName') {
				$research = $research->leftJoin('users', 'users.id', '=', 'research.posted_by')
					->orderBy('users.last_name', 'ASC');
			}
			else if ($sortBy == 'date') {
				$research = $research->orderBy('research.date_published', 'DESC');
			}
			else if ($sortBy == 'title') {
				$research = $research->orderBy('research.title', 'ASC');
			}
		}

		// SEARCH
		if (\Request::has('search')) {
			$search = \Request::get('search');
			
			if ($sortBy == 'date' || $sortBy == 'title') {
				$research = $research->leftJoin('users', 'users.id', '=', 'research.posted_by');
			}
			
			// leftJoining the many-to-many tables research, research_focus, and focus
			$research = $research->leftJoin('research_focus', 'research.id', '=', 'research_focus.research_id')
				->leftJoin('focus', 'research_focus.focus_id', '=', 'focus.id');

			// Proceed to do the filtering
			$research = $research->where('research.title', 'LIKE', '%'.$search.'%')
				->orWhere('research.authors', 'LIKE', '%'.$search.'%')
				->orWhere('research.description', 'LIKE', '%'.$search.'%')
				->orWhere('research.url', 'LIKE', '%'.$search.'%')
				->orWhere('users.first_name', 'LIKE', '%'.$search.'%')
				->orWhere('users.middle_name', 'LIKE', '%'.$search.'%')
				->orWhere('users.last_name', 'LIKE', '%'.$search.'%')
				->orWhere('users.email', 'LIKE', '%'.$search.'%')
				->orWhere('focus.name', 'LIKE', '%'.$search.'%');
		}
		
		if (!is_a($research, 'Illuminate\Support\Collection')) {
			$research = Auth::check() ? $research->distinct()->get(['research.*']) : $research->where('research.is_featured', 1)->distinct()->get(['research.*']);
		}


		return view('users.research.index', [
			'college' => $college,
			'dept' => $dept,
			'sortBy' => $sortBy,
			'searchVal' => \Request::get('search'),
			'researchFocus' => $rf,
			'focus' => Focus::get(),
			'research' => $research
		]);
	}

	protected function researchShow($id) {

		if (Research::find($id) == null)
			abort(404);

		if (!Auth::check() && !Research::find($id)->is_featured)
			return redirect()->guest('login');

		return view('users.research.show', [
			'research' => Research::find($id)
		]);
	}

	protected function innovations($dept='All',$sortBy='date',$rf='all') {
		$college = College::get();
		$innovations = new Innovation;

		// FILTER
		if (\Request::has('dept')) {
			$dept = \Request::get('dept');
			if ($dept != 'All') {
				$deptArr = array();
				$staffArr = array();
				
				if (substr($dept, 0, 7) == 'College' || substr($dept, 0, 6) == 'Others') {
					foreach (Departments::where('college', '=', College::where('name', '=', $dept)->first()->id)->get() as $d) {
						array_push($deptArr, $d->id);
					}
				}
				else {
					array_push($deptArr, Departments::where('name', '=', $dept)->first()->id);
				}
				
				foreach (FacultyStaff::whereIn('department', $deptArr)->get() as $s) {
					array_push($staffArr, $s->id);
				}
				
				$innovations = $innovations->whereIn('innovations.posted_by', $staffArr);
			}
		}

		// RESEARCH FOCUS
		if (\Request::has('researchFocus')) {
			$rf = \Request::get('researchFocus');
			$rfArr = array();
			$focus = array();

			if ($rf != 'all') {
				if (Auth::check()) {
					$focus = InnovationFocus::leftJoin('innovations', 'innovations.id', '=', 'innovation_focus.innovation_id')
						->where('innovation_focus.focus_id', '=', Focus::where('name', '=', $rf)->first()->id)
						->distinct()
						->get(['innovations.*']);
				}
				else {
					$focus = InnovationFocus::leftJoin('innovations', 'innovations.id', '=', 'innovation_focus.innovation_id')
						->where('innovation_focus.focus_id', '=', Focus::where('name', '=', $rf)->first()->id)
						->where('is_featured', 1)
						->distinct()
						->get(['innovations.*']);
				}

				foreach ($focus as $f) {
					array_push($rfArr, $f->id);
				}

				$innovations = $innovations->whereIn('innovations.id', $rfArr);
			}
		}

		// SORT
		if (\Request::has('sortBy')) {
			$sortBy = \Request::get('sortBy');
			if ($sortBy == 'authorFirstName') {
				$innovations = $innovations->leftJoin('users', 'users.id', '=', 'innovations.posted_by')
					->orderBy('users.first_name', 'ASC');
			}
			else if	($sortBy == 'authorLastName') {
				$innovations = $innovations->leftJoin('users', 'users.id', '=', 'innovations.posted_by')
					->orderBy('users.last_name', 'ASC');
			}
			else if ($sortBy == 'date') {
				$innovations = $innovations->orderBy('innovations.date_published', 'DESC');
			}
			else if ($sortBy == 'title') {
				$innovations = $innovations->orderBy('innovations.title', 'ASC');
			}
		}

		// SEARCH
		if (\Request::has('search')) {
			$search = \Request::get('search');
			
			if ($sortBy == 'date' || $sortBy == 'title') {
				$innovations = $innovations->leftJoin('users', 'users.id', '=', 'innovations.posted_by');
			}
			
			// leftJoining the many-to-many tables innovations, innovation_focus, and focus
			$innovations = $innovations->leftJoin('innovation_focus', 'innovations.id', '=', 'innovation_focus.innovation_id')
				->leftJoin('focus', 'innovation_focus.focus_id', '=', 'focus.id');

			// Proceed to do the filtering
			$innovations = $innovations->where('innovations.title', 'LIKE', '%'.$search.'%')
				->orWhere('innovations.authors', 'LIKE', '%'.$search.'%')
				->orWhere('innovations.description', 'LIKE', '%'.$search.'%')
				->orWhere('innovations.url', 'LIKE', '%'.$search.'%')
				->orWhere('users.first_name', 'LIKE', '%'.$search.'%')
				->orWhere('users.middle_name', 'LIKE', '%'.$search.'%')
				->orWhere('users.last_name', 'LIKE', '%'.$search.'%')
				->orWhere('users.email', 'LIKE', '%'.$search.'%')
				->orWhere('focus.name', 'LIKE', '%'.$search.'%');
		}
		
		if (!is_a($innovations, 'Illuminate\Support\Collection')) {
			$innovations = Auth::check() ? $innovations->distinct()->get(['innovations.*']) : $innovations->where('innovations.is_featured', 1)->distinct()->get(['innovations.*']);
		}

		return view('users.innovations.index', [
			'college' => $college,
			'dept' => $dept,
			'sortBy' => $sortBy,
			'searchVal' => \Request::get('search'),
			'researchFocus' => $rf,
			'focus' => Focus::get(),
			'innovations' => $innovations
		]);
	}

	protected function innovationShow($id) {
		if (Innovation::find($id) == null)
			abort(404);

		if (!Auth::check() && !Innovation::find($id)->is_featured)
			return redirect()->guest('login');

		return view('users.innovations.show', [
			'innovation' => Innovation::find($id)
		]);
	}

	// ADMIN SIDE
	protected function redirectToDashboard() {
		return redirect()->route('dashboard');
	}

	protected function dashboard() {
		$research = array();
		$innovations = array();
		$materials = array();
		$dates = array();

		for ($i = 1; $i <= \Carbon\Carbon::now()->format('d'); $i++) {
			$date = Carbon::parse(Carbon::now()->format('Y') . '-' . Carbon::now()->format('m') . '-' . ($i))->format('Y-m-d');
			$r = Research::whereDate('created_at', '=', $date)->get();
			$in = Innovation::whereDate('created_at', '=', $date)->get();
			$m = Material::whereDate('created_at', '=', $date)->get();
			$d = Carbon::now()->format('M') . ' ' . ($i);

			array_push($research, $r);
			array_push($innovations, $in);
			array_push($materials, $m);
			array_push($dates, $d);
		}
		return view('users.auth.admin.dashboard', [
			'research' => $research,
			'innovations' => $innovations,
			'materials' => $materials,
			'dates' => $dates
		]);
	}
}