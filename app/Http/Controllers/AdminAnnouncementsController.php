<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\ActivityLog;
use App\Announcements;

use Auth;
use DB;
use Exception;
use File;
use Log;
use Validator;

class AdminAnnouncementsController extends Controller
{
	protected function index() {
		return view("users.auth.admin.announcements.index", [
			'announcements' => Announcements::paginate(10)
		]);
	}

	protected function create() {
		return view("users.auth.admin.announcements.create");
	}

	protected function store(Request $req) {
		$validator = Validator::make($req->all(), [
			'title' => 'required|min:2',
			'source' => 'url',
			'content' => 'required|min:2',
			'image' => 'max:5120|mimes:jpeg,png,jpg'
		], [
			'title.required' => 'A title is required.',
			'title.min' => 'Announcement title is too short',
			'source.url' => 'The source should be a url pointing to its source',
			'content.required' => 'Content or description is too short.',
			'content.min' => 'Announcement content is too short',
			'image.max' => 'Image should be below 5MB.',
			'image.mimes' => 'Selected file doesn\'t match the allowed image formats.'
		]);

		if ($validator->fails())
			return redirect()
				->back()
				->withErrors($validator->messages()->merge($imgValidator->messages()))
				->withInput();

		try {
			DB::beginTransaction();

			$image = null;
			$destination = 'uploads/announcements';
			$fileType = $req->file('image')->getClientOriginalExtension();
			$image = "image-" . uniqid() . "." . $fileType;
			$req->file('image')->move($destination, $image);

			$announcement = Announcements::create([
				'image' => $image,
				'title'  => $req->title,
				'source' => $req->source,
				'content' => $req->content,
				'author_id' => Auth::user()->id,
			]);

			ActivityLog::log('Added announcement (<a href="' . route('admin.announcements.show', [$announcement->id]) . '">' . $announcement->title . '</a>)');

			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			Log::error($e);

			return redirect()
				->back()
				->withInput()
				->with('flash_error', 'Something went wrong, please try again later.');
		}

		return redirect()
			->route('admin.announcements.index')
			->with('flash_success', 'Successfully Posted Announcements');
	}

	protected function show($id) {
		return view("users.auth.admin.announcements.show",[
			'announcement' => Announcements::find($id)
		]);
	}

	protected function edit($id) {
		return view("users.auth.admin.announcements.edit", [
			'announcement' => Announcements::find($id)
		]);
	}

	protected function update(Request $req, $id) {
		$validator = Validator::make($req->all(), [
			'title' => 'required|min:2',
			'source' => 'url',
			'content' => 'required|min:2',
			'image' => 'max:5120|mimes:jpeg,png,jpg'
		], [
			'title.required' => 'A title is required.',
			'title.min' => 'Announcement title is too short',
			'source.url' => 'The source should be a url pointing to its source',
			'content.required' => 'Content or description is too short.',
			'content.min' => 'Announcement content is too short',
			'image.max' => 'Image should be below 5MB.',
			'image.mimes' => 'Selected file doesn\'t match the allowed image formats.'
		]);

		if ($validator->fails())
			return redirect()
				->back()
				->withErrors($validator->messages()->merge($imgValidator->messages()))
				->withInput();

		try {
			DB::beginTransaction();

			$announcement = Announcements::find($id);

			if ($announcement == null)
				return redirect()
					->back()
					->with('flash_info', 'Announcement has been deleted already. Please refresh the page if it still appears in the table.');
			
			if ($req->has('image')) {
				File::delete(public_path() . '/uploads/announcements/' . $announcement->image);

				$image = null;
				$destination = 'uploads/announcements';
				$fileType = $req->file('image')->getClientOriginalExtension();
				$image = "image-" . uniqid() . "." . $fileType;
				$req->file('image')->move($destination, $image);

				$announcement->image = $image;
			}

			$announcement->title = $req->title;
			$announcement->source = $req->source;
			$announcement->content = $req->content;
			$announcement->save();

			ActivityLog::log('Modified announcement (<a href="' . route('admin.announcements.show', [$announcement->id]) . '">' . $announcement->title . '</a>)');

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			Log::error($e);

			return redirect()
				->back()
				->withInput()
				->with('flash_error', 'Something went wrong, please try again later.');
		}

		return redirect()
			->route('admin.announcements.index')
			->with('flash_success', 'Successfully Posted Announcements');
	}

	protected function delete($id) {
		$announcement = Announcements::find($id);

		if ($announcement == null)
			return redirect()
				->route('admin.announcements.index')
				->with('flash_info', 'Announcement has been deleted already. Please refresh the page if it still appears in the table.');

		try {
			DB::beginTransaction();
			
			$announcement->delete();
			File::delete(public_path() . '/uploads/announcements/' . $announcement->image);
			ActivityLog::log('Deleted announcement (<a href="' . route('admin.announcements.show', [$announcement->id]) . '">' . $announcement->title . '</a>)');
			
			DB::commit();
		} catch (Exception $e) {
			Log::error($e);
			DB::rollback();

			return redirect()
				->route('admin.announcements.index')
				->with('flash_error', 'Something went wrong, please try again later.');
		}

		return redirect()->route('admin.announcements.index')->with('flash_success', 'Successfully Deleted Announcement');
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

			$announcement->is_marked = 1;
			$announcement->reason = $req->reason;
			$announcement->save();

			ActivityLog::log('Marked announcement (<a href="' . route('admin.announcements.show', [$announcement->id]) . '">' . $announcement->title . '</a>)');

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
				'message' => 'Successfully marked "' . $announcement->title . '".',
				'uri' => route('admin.announcements.unmark', [$id]),
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

			ActivityLog::log('Unmarked announcement (<a href="' . route('admin.announcements.show', [$announcement->id]) . '">' . $announcement->title . '</a>)');

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