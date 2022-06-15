<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\ActivityLog;
use App\Announcements;

use Auth;
use DB;
use File;
use Log;
use Validator;

class AdminAnnouncementsController extends Controller
{
	protected function index() {
		return view("users.auth.admin.announcements.index", [
			'announcements' => Announcements::get()
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

			ActivityLog::log('Added announcement (' . route('admin.announcements.show', [$announcement->id]) . ')');

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

			ActivityLog::log('Modified announcement (' . route('admin.announcements.show', [$announcement->id]) . ')');

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
			ActivityLog::log('Deleted an Announcement (' . $announcement->title. ')');
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
}