<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FacultyController extends Controller
{
	// TEMPORARY SUBSTITUTE... TO BE REMOVE ONCE BACKEND IS ATTACHED
	private function getStaff() {
		return TmpController::getStaff();
	}
	private function getSkillList() {
		return TmpController::getSkillList();
	}

	protected function index($dept='All',$sortBy='firstName') {
		$staff = $this->getStaff();

		// SORT
		if (\Request::has('sortBy')) {
			$sortBy = \Request::get('sortBy');
			switch ($sortBy) {
				case 'lastName':
					$staff->sortBy('last_name');
					break;
				
				case 'firstName':
				default:
					$staff->sortBy('first_name');
					break;
			}
		}

		// FILTER
		if (\Request::has('dept')) {
			$dept = \Request::get('dept');
			switch ($dept) {
				case 'CompSci':
					$staff->where('department', '=', 'Computer Science');
					break;
				
				case 'All':
				default:
					break;
			}
		}
		
		// RETURN
		return view('users.auth.faculty.index', [
			'dept' => $dept,
			'sortBy' => $sortBy,
			'staff' => $staff
		]);
	}

	protected function show($id) {
		return view('users.auth.faculty.show', [
			'staff' => $this->getStaff()->get($id-1),
		]);
	}

	protected function research($id) {
		return view('users.auth.faculty.show.research', [
			'id' => $id
		]);
	}

	protected function innovations($id) {
		return view('users.auth.faculty.show.innovations', [
			'id' => $id
		]);
	}

	protected function materials($id) {
		return view('users.auth.faculty.show.materials', [
			'id' => $id
		]);
	}
}