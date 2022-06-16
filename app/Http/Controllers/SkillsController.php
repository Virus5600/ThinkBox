<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\ActivityLog;
use App\Skills;

use DB;
use Exception;
use Log;
use Validator;

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
			'skill.required' => 'Please provide a skill name',
			'skill.min' => 'Skill name provided is too short'
		]);

		if ($validator->fails())
			return response()
				->json([
					'has_error' => false,
					'has_validation_error' => true,
					'message' => $validator->errors()->first()
				]);

		try {
			DB::beginTransaction();

			$skill = Skills::create([
				'skill' => $req->skill
			]);

			ActivityLog::log('Added skill (<a href="' . route('admin.skills.show', [$skill->id]) . '">' . $skill->skill . '</a>)');

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
				'message' => 'Successfully added "' . $skill->skill . '".',
			]);
	}

	protected function show($id) {
		$skill = Skills::find($id);

		if ($skill == null)
			return abort(404);

		return view('users.auth.admin.skills.show', [
			'skill' => $skill
		]);
	}

	protected function update(Request $req, $id) {
		$validator = Validator::make($req->all(), [
			'skill' => 'required|min:2'
		], [
			'skill.required' => 'Please provide a skill name',
			'skill.min' => 'Skill name provided is too short'
		]);

		if ($validator->fails())
			return response()
				->json([
					'has_error' => false,
					'has_validation_error' => true,
					'message' => $validator->errors()->first()
				]);

		try {
			DB::beginTransaction();

			$skill = Skills::find($id);

			if ($skill == null)
				return redirect()
					->back()
					->with('flash_info', 'Skill has been deleted already. Please refresh the page if it still appears in the table.');

			$skill->skill = $req->skill;
			$skill->save();

			ActivityLog::log('Modified skill (<a href="' . route('admin.skills.show', [$skill->id]) . '">' . $skill->skill . '</a>)');

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
				'message' => 'Successfully updated "' . $skill->skill . '".',
			]);
	}

	protected function delete($id) {
		$skill = Skills::find($id);

		if ($skill == null)
			return redirect()
				->route('admin.skills.index')
				->with('flash_info', 'Skill has been deleted already. Please refresh the page if it still appears in the table.');

		try {
			DB::beginTransaction();
			$skill->delete();
			ActivityLog::log('Deleted skill (<a href="' . route('admin.skills.show', [$skill->id]) . '">' . $skill->skill . '</a>)');
			DB::commit();
		} catch (Exception $e) {
			Log::error($e);
			DB::rollback();

			return redirect()
				->route('admin.skills.index')
				->with('flash_error', 'Something went wrong, please try again later.');
		}

		return redirect()->route('admin.skills.index')->with('flash_success', 'Successfully Deleted Skill');
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

		$skill = Skills::find($id);

		if ($skill == null) {
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

			$skill->is_marked = 1;
			$skill->reason = $req->reason;
			$skill->save();

			ActivityLog::log('Marked skill (<a href="' . route('admin.skills.show', [$skill->id]) . '">' . $skill->skill . '</a>)');

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
				'message' => 'Successfully marked "' . $skill->skill . '".',
				'uri' => route('admin.skills.unmark', [$id]),
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

		$skill = Skills::find($id);

		if ($skill == null) {
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

			$skill->is_marked = 0;
			$skill->reason = $req->reason;
			$skill->save();

			ActivityLog::log('Unmarked skill (<a href="' . route('admin.skills.show', [$skill->id]) . '">' . $skill->title . '</a>)');

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
				'message' => 'Successfully unmarked "' . $skill->skill . '".',
				'uri' => route('admin.skills.mark', [$id]),
				'id' => $id
			]);
	}
}