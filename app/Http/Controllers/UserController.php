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
		$r = $user->travels()->where('travel_id', $travel->id)->get();
		if ($r != null)
			$user->travels()->detach($travel);
		$message = "3";
		$number = $travel->users()->count();

		$r = $travel->users;
		$leader_name = "empty";
		for ($i = 0; $i < $r->count(); $i++) {
			if ($r[$i]->pivot->role == "leader") {
				$leader_name = $r[$i]->name;
			}
		}


		$admin = $user->roles->where('role', 'Admin')->count();

		$leader = $user->roles->where('role', 'leader')->count();
		if (($admin == 1) || ($leader == 1)) {
			$travel->users;
			return view('travels.show', ['travel' => $travel, 'message' => $message, 'number' => $number, 'leader_name' => $leader_name, 'role' => 1]);
		} else {
			return view('travels.show', ['travel' => $travel, 'message' => $message, 'number' => $number, 'leader_name' => $leader_name, 'role' => 0]);
		}
	}

	public function AddTravelForUser(Travel $travel)
	{
		$user = Auth::user();
		$user_with_travels = $user->travels;
		$count = $user_with_travels->where('id', $travel->id)->count();
		if ($count == 0) 
		{
			$user->travels()->attach($travel, ['role' => "user"]);
			$message = "1";
		} else {
			$message = "5";
		}

		$number = $travel->users()->count();
		$r = $travel->users;
		$leader_name = "empty";
		for ($i = 0; $i < $r->count(); $i++) {
			if ($r[$i]->pivot->role == "leader") {
				$leader_name = $r[$i]->name;
			}
		}
		$r = $travel->users;
		$leader_name = "empty";
		for ($i = 0; $i < $r->count(); $i++) {
			if ($r[$i]->pivot->role == "leader") {
				$leader_name = $r[$i]->name;
			}
		}
		if (Auth::user()) {
			$user = Auth::user();
			$admin = $user->roles->where('role', 'Admin')->count();

			$leader = $user->roles->where('role', 'leader')->count();
			if (($admin == 1) || ($leader == 1)) {
				$travel->users;
				return view('travels.show', ['travel' => $travel, 'message' => $message, 'number' => $number, 'leader_name' => $leader_name, 'role' => 1]);
			} else {
				return view('travels.show', ['travel' => $travel, 'message' => $message, 'number' => $number, 'leader_name' => $leader_name, 'role' => 0]);
			}
		} else {
			return view('travels.show', ['travel' => $travel, 'message' => $message, 'number' => $number, 'leader_name' => $leader_name, 'role' => 0]);
		}
	}
}
