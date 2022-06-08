<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureItIsLeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
		$u = auth()->user();
		$a = $u->roles->where('role','leader')->count();
		
		if($a != 1)
		{
			abort(403, 'Access denied');
		}	
        return $next($request);
    }
}
