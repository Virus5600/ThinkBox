<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Research;

use Log;
use Mail;

class ResearchController extends Controller
{
	protected function requestCopy(Request $req, $id) {
		$research = Research::find($id);
		$email = $req->email;
		$recipients = array();
		$recipientNames = array();

		foreach ($research->researchAuthors as $ra) {
			if ($ra->user->email != null) {
				array_push($recipients, $ra->user->email);
				array_push($recipientNames, $ra->user->getFullName());
			}
		}
		
		Mail::send(
			'template.email.request_copy',
			[
				'email' => $email,
				'document' => $research
			],
			function ($m) use ($email, $research, $recipients, $recipientNames) {
				$m->to($recipients, $recipientNames)
					->from($email)
					->cc($research->postedBy->user->email)
					->subject('Request for a copy of the document "' . $research->title . '"');
			}
		);

		return response()->json(['success' => 'Author(s) successfully informed.']);
	}
}