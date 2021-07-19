<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Announcements;

class AnnouncementsController extends Controller
{
	// TEMPORARY SUBSTITUTE... TO BE REMOVE ONCE BACKEND IS ATTACHED
	private function getAnnouncements() {
		return TmpController::getAnnouncements();
	}

	protected function index($sortBy='date') {
		$announcements = new announcements;

		// SORT
		if (\Request::has('sortBy')) {
			$sortBy = \Request::get('sortBy');
			if	($sortBy == 'date') {
				$announcements = $announcements->orderBy('announcements.created_at', 'DESC');
			}
			else if ($sortBy == 'title') {
				$announcements = $announcements->orderBy('announcements.title', 'ASC');
			}
		}

		// SEARCH
		if (\Request::has('search')) {
			$search = \Request::get('search');

			$announcements->whereRaw('announcements.title LIKE CONCAT("%", ?, "%")', [$search])
				->orWhereRaw('announcements.source LIKE CONCAT("%", ?, "%")', [$search])
				->orWhereRaw('announcements.content LIKE CONCAT("%", ?, "%")', [$search]);
		}
		
		if (!is_a($announcements, 'Illuminate\Support\Collection')) {
			$announcements = $announcements->get(['announcements.*']);
		}

		return view('users.announcements.index', [
			'searchVal' => \Request::get('search'),
			'sortBy' => $sortBy,
			'announcements' => $announcements
		]);
	}

	protected function show($id) {
		return view('users.announcements.show', [
			'announcements' => Announcements::find($id),
			'otherAnnouncements' => Announcements::where('id', '<>', $id)->get()->random(3)->shuffle()
		]);
	}
}