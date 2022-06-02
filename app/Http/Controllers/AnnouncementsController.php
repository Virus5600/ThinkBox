<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Announcements;

class AnnouncementsController extends Controller
{
	protected function index($sortBy='date') {
		$announcements = new announcements;

		// SORT
		if (\Request::has('sortBy')) {
			$sortBy = \Request::get('sortBy');
			if	($sortBy == 'date') {
				$announcements = $announcements->orderBy('created_at', 'DESC');
			}
			else if ($sortBy == 'title') {
				$announcements = $announcements->orderBy('title', 'ASC');
			}
		}

		// SEARCH
		if (\Request::has('search')) {
			$search = \Request::get('search');

			$announcements->where('title', 'LIKE', "%".$search."%")
				->orWhere('source', 'LIKE', "%".$search."%")
				->orWhere('content', 'LIKE', "%".$search."%");
		}
		
		if (!is_a($announcements, 'Illuminate\Pagination\LengthAwarePaginator')) {
			$announcements = $announcements->paginate(9, ['announcements.*']);
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