<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Innovation;

use Mail;
use Log;

class InnovationController extends Controller
{
	protected function requestCopy(Request $req, $id) {
		$innovation = Innovation::find($id);
		$email = $req->email;
		$recipients = array();
		$recipientNames = array();

		foreach ($innovation->innovationAuthors as $ia) {
			if ($ia->user->email != null) {
				array_push($recipients, $ia->user->email);
				array_push($recipientNames, $ia->user->getFullName());
			}
		}

		Mail::send(
			'template.email.request_copy',
			[
				'email' => $email,
				'document' => $innovation
			],
			function ($m) use ($email, $innovation, $recipients, $recipientNames) {
				$m->to($recipients, $recipientNames)
					->from($email)
					->cc($innovation->postedBy->user->email)
					->subject('Request for a copy of the document "' . $innovation->title . '"');
			}
		);

		return response()->json(['success' => 'Author(s) successfully informed.']);
	}
}