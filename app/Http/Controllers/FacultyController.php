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
	private function getFocus() {
		return TmpController::getFocus();
	}
	private function getResearchList() {
		return TmpController::getResearchList();
	}

	protected function index($dept='All',$sortBy='firstName',$rf='all') {
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

		// RESEARCH FOCUS
		if (\Request::has('researchFocus')) {
			$rf = \Request::get('researchFocus');
			switch ($dept) {
				default:
				break;
			}
		}
		
		// RETURN
		return view('users.auth.faculty.index', [
			'dept' => $dept,
			'sortBy' => $sortBy,
			'researchFocus' => $rf,
			'research_focus' => $this->getFocus(),
			'staff' => $staff
		]);
	}

	protected function show($id) {
		return view('users.auth.faculty.show', [
			'staff' => $this->getStaff()->get($id-1),
			'research' => $this->getResearchList()->where('posted_by', (int)$id),
			'innovations' => $this->getResearchList()->where('posted_by', (int)$id)
		]);
	}

	protected function research($id) {
		return view('users.auth.faculty.show.research', [
			'staff' => $this->getStaff()->get($id-1),
			'research' => $this->getResearchList()->where('posted_by', (int)$id),
			'id' => $id
		]);
	}

	protected function innovations($id) {
		return view('users.auth.faculty.show.innovations', [
			'staff' => $this->getStaff()->get($id-1),
			'innovations' => $this->getResearchList()->where('posted_by', (int)$id),
			'id' => $id
		]);
	}

	protected function materials($id) {
		return view('users.auth.faculty.show.materials', [
			'staff' => $this->getStaff()->get($id-1),
			'id' => $id
		]);
	}
}