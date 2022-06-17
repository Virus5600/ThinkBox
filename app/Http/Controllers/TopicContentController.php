<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\ActivityLog;
use App\FacultyStaff;
use App\Material;

use Auth;
use DB;
use Exception;
use File;
use Log;
use Validator;

class TopicContentController extends Controller
{
	protected function index(Request $req, $staffid, $id) {
		$staff = FacultyStaff::find($staffid);
		$topic = Topic::find($id);
		$materials = new Material();

		// SEARCH
		if ($req->has('search')) {
			$search = $req->get('search');

			if (!$req->has('sortBy') || $sortBy == 'none') {
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

		return view('users.auth.admin.faculty-member.manage-content-topic', [
			'staff' => $staff,
			'topic' => $topic,
			'materials' => $materials,
		]);
	}
}
