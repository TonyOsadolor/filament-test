<?php

namespace App\Http\Middleware;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Team;
use Closure;

class ResolveTenantSqid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) {
		if ($tenant = $request->route()->parameter("tenant")) {
			$tenant = Team::getSqids()->decode($tenant)[0] ?? null;

			if (is_null($tenant)) {
				throw new ModelNotFoundException();
			}

			$request->route()->setParameter("tenant", $tenant);
		}

		return $next($request);
	}
}
