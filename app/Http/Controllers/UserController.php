<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Travel;
use App\Models\Role;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		// $this->middleware('admin')->except(['show','index','AddTravelForUser']);
		// $this->middleware('leader')->except(['show','index','AddTravelForUser']);
	}

	public function redirectTo()
	{
		$user = Auth::user();
		$user->load('travels');
		$url = Storage::url('public/files/' . $user->photoname);
		if (Auth::user()->roles->where('role', 'Admin')->count() == 1) {
			$nonactive_leaders = Role::all()->where('role', '=', 'leader');
			$nonactive_leaders->load('user');
			return view('/panels/admin', ['user' => $user, 'nonactive_leaders' => $nonactive_leaders, 'photo_url' => $url]);
		} else {
			return view('dashboard', ['user' => $user, 'photo_url' => $url]);
		}
	}
	public function CancleTrvaelForUser(Travel $travel)
	{
		$user = Auth::user();
		$r = $user->travels()->where('travel_id', $travel->id)->firstOrFail()->pivot->role;
		if (($r == "user") || ($r == "leader"))
			$user->travels()->detach($travel);
		$message = "3";
		$number = $travel->users()->count();
		return view('travels.show', ['travel' => $travel, 'message' => $message, 'number' => $number]);
	}
}
