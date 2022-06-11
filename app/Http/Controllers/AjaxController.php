<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\College;
use App\Innovation;
use App\Material;
use App\Research;

use Log;

class AjaxController extends Controller
{
	protected function getCollegeDepartments(Request $req) {
		return College::find($req->collegeID)->departments;
	}

	protected function getActivities(Request $req) {
		$from = Carbon::parse($req->from);
		$to = Carbon::parse($req->to);

		$research = array();
		$innovations = array();
		$materials = array();
		$dates = array();

		foreach (CarbonPeriod::create($from->format('Y-m-d'), $to->format('Y-m-d')) as $date) {
			$r = Research::whereDate('created_at', '=', $date->format('Y-m-d'))->get();
			$in = Innovation::whereDate('created_at', '=', $date->format('Y-m-d'))->get();
			$ma = Material::whereDate('created_at', '=', $date->format('Y-m-d'))->get();
			$d = $date->format('M') . ' ' . $date->format('d');

			array_push($research, $r);
			array_push($innovations, $in);
			array_push($materials, $ma);
			array_push($dates, $d);
		}

		return response()->json([
			'research' => $research,
			'innovations' => $innovations,
			'materials' => $materials,
			'dates' => $dates,
			'from' => $from->format("M d, Y"),
			'to' => $to->format("M d, Y")
		]);
	}
}