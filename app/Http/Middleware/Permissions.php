<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use Closure;
use Log;

class Permissions
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $permissions)
	{
		if (!Auth::check()) 
			return redirect()->intended();

		$user = Auth::user();

		if($user->hasPrivilege($permissions))
			return $next($request);
		else
			return redirect()->back();

	}
}