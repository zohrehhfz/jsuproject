<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class EnsureItIsLeaderOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
	  /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $travel
     * @return mixed
     */
    public function handle(Request $request, Closure $next ,$travel)
    {
		echo $travel;
		$u = auth()->user();
		$leader = $u->roles->where('role','leader')->count();
		$flag  = 1;
		if(($travel != "empty") && ($leader == 1))
		{
			$r = $u->travels()->where('travel_id', $travel->id)->firstOrFail()->pivot->role;
			if($r != "leader")
			{
				$flag = 0;
			}
		}
		$admin = $u->roles->where('role','Admin')->count();
		echo $admin." ".$leader." ".$flag;
		if(($admin != 1) && ($flag != 1))
		{
			abort(403, 'Access denied');
		}		
        return $next($request);
    }
}
