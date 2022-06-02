<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\College;

class AjaxController extends Controller
{
	protected function getCollegeDepartments(Request $req) {
		return College::find($req->collegeID)->departments;
	}
}