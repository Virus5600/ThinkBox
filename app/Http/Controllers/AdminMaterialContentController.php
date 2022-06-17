<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\ActivityLog;
use App\FacultyStaff;
use App\Material;
use App\Topic;

use Auth;
use DB;
use Exception;
use File;
use Log;
use Validator;

class AdminMaterialContentController extends Controller
{
	protected function index(Request $req, $staffid, $id) {
		$staff = FacultyStaff::find($staffid);
		$topic = Topic::find($id);
		$materials = Material::where('topic_id', '=', $id)
			->where('faculty_staff_id', '=', $staffid);

		// SEARCH
		if ($req->has('search')) {
			$search = $req->search;

			$materials = $materials->where(function($q) use ($search) {
				$q->where('material_name', 'LIKE', '%'.$search.'%')
					->orWhere('description', 'LIKE', '%'.$search.'%');
			});
		}

		if (!is_a($materials, 'Illuminate\Pagination\LengthAwarePaginator')) {
			$materials = $materials->distinct()->paginate(10);
		}

		return view('users.auth.admin.faculty-member.topic.index', [
			'staff' => $staff,
			'topic' => $topic,
			'materials' => $materials,
			'searchVal' => $req->search
		]);
	}

	protected function show($staffid, $topicid, $id) {
		// TBA
	}

	protected function create($staffid, $id) {
		// TBA
	}

	protected function store(Request $req, $staffid, $id) {
		// TBA
	}

	protected function edit($staffid, $topicid, $id) {
		// TBA
	}
}