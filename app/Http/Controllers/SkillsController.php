<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Skills;

class SkillsController extends Controller
{
	protected function index() {
		return view('users.auth.admin.skills.index', [
			'skills' => Skills::paginate(10)
		]);
	}

	protected function store(Request $req) {
		$validator = Validator::make($req->all(), [
			'skill' => 'required|min:2'
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

		$announcement = Announcements::find($id);

		if ($announcement == null) {
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

			$announcement->is_marked = 0;
			$announcement->reason = $req->reason;
			$announcement->save();

			ActivityLog::log('Unmarked announcement (' . route('admin.announcements.show', [$announcement->id]) . ')');

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
				'message' => 'Successfully unmarked "' . $announcement->title . '".',
				'uri' => route('admin.announcements.mark', [$id]),
				'id' => $id
			]);
	}
}