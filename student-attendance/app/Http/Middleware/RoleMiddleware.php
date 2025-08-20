<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * Usage: ->middleware('role:admin') or ->middleware('role:admin,teacher')
	 */
	public function handle(Request $request, Closure $next, string ...$roles): Response
	{
		$user = $request->user();
		if (!$user) {
			abort(403);
		}

		if (!empty($roles) && !in_array($user->role, $roles, true)) {
			abort(403, 'Unauthorized');
		}

		return $next($request);
	}
}
