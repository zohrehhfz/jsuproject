<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
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
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit()
	{
		$user = Auth::user();
		return view('panels.upadatepanel', ['user' => $user]);
	}
	public function update(Request $request)
	{
		$user = Auth::user();
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'phone' => ['required', 'string', 'min:11', 'max:13'],
			'birthdate' => ['required', 'string', 'max:5'],
			'photo' => ['mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
			'certificate' => ['mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
		]);

		$newphotofilename = "null";
		$photofilename = "null";
		if ($request->photo != null) {

			$photofile = $request->file('photo');
			$photofilename = $photofile->getClientOriginalName();
			$extension = $photofile->extension();
			$newphotofilename = sha1(time() . '_' . rand(1000000000, 1999999999) . '_' . rand(1000000000, 1999999999) . '_' . $photofilename);
			$newphotofilename = $newphotofilename . '.' . $extension;

			Storage::disk('local')->putFileAs(
				'public/files',
				$photofile,
				$newphotofilename
			);
			DB::table('users')->where('id', $user->id)->update(array(
				"photoname" => $newphotofilename,
				"orginalphotoname" => $photofilename,
			));
		}
		$newcertificatefilename = "null";
		$certificatefilename = "null";
		if ($request->certificate != null) {

			$certificatefile = $request->file('certificate');
			$certificatefilename = $certificatefile->getClientOriginalName();
			$extension = $certificatefile->extension();
			$newcertificatefilename = sha1(time() . '_' . rand(1000000000, 1999999999) . '_' . rand(1000000000, 1999999999) . '_' . $photofilename);
			$newcertificatefilename = $newcertificatefilename . '.' . $extension;

			Storage::disk('local')->putFileAs(
				'public/certificates',
				$certificatefile,
				$newcertificatefilename
			);

			DB::table('leaderattributes')->where('user_id', $user->id)->update(array(
				"certificatename" => $newcertificatefilename,
				"orginalcertificatename" => $certificatefilename,
			));
		}

		DB::table('users')->where('id', $user->id)->update(array(
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
			'birthdate' => $request->birthdate,
		));
		$user = User::find(Auth::user()->id);
		$url = Storage::url('public/files/' . $user->photoname);
		return view('dashboard', ['user' => $user, 'photo_url' => $url]);
	}
	public function certificate()
	{
		$user = User::find(Auth::user()->id);
		$name = $user->certificates()->first()->orginalcertificatename;
		return Storage::download('public/certificates/'. $user->certificates()->first()->certificatename,$name);
	}
	public function AdminSeeCertificate(User $user)
	{
		$name = $user->certificates()->first()->orginalcertificatename;
		return Storage::download('public/certificates/'. $user->certificates()->first()->certificatename,$name);
	}

	public function CancleTrvaelForUser(Travel $travel)
	{
		$user = Auth::user();
		$r = $user->travels()->where('travel_id', $travel->id)->get();
		if ($r != null)
			$user->travels()->detach($travel);
		$message = "3";
		$number = $travel->users()->count();
		$travel->comments;
		$r = $travel->users;
		$leader_name = "empty";
		for ($i = 0; $i < $r->count(); $i++) {
			if ($r[$i]->pivot->role == "leader") {
				$leader_name = $r[$i]->name;
			}
		}

		$url = Storage::url('public/travels/' . $travel->photoname);

		$admin = $user->roles->where('role', 'Admin')->count();

		$leader = $user->roles->where('role', 'leader')->count();
		if (($admin == 1) || ($leader == 1)) {
			$travel->users;
			return view('travels.show', ['travel' => $travel, 'message' => $message, 'number' => $number, 'leader_name' => $leader_name, 'role' => 1, 'photo_url' => $url]);
		} else {
			return view('travels.show', ['travel' => $travel, 'message' => $message, 'number' => $number, 'leader_name' => $leader_name, 'role' => 0, 'photo_url' => $url]);
		}
	}

	public function AddTravelForUser(Travel $travel)
	{
		$user = Auth::user();
		$user_with_travels = $user->travels;
		$count = $user_with_travels->where('id', $travel->id)->count();
		if ($count == 0) {
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
		$url = Storage::url('public/travels/' . $travel->photoname);

		if (Auth::user()) {
			$user = Auth::user();
			$admin = $user->roles->where('role', 'Admin')->count();

			$leader = $user->roles->where('role', 'leader')->count();
			if (($admin == 1) || ($leader == 1)) {
				$travel->users;
				return view('travels.show', ['travel' => $travel, 'message' => $message, 'number' => $number, 'leader_name' => $leader_name, 'role' => 1, 'photo_url' => $url]);
			} else {
				return view('travels.show', ['travel' => $travel, 'message' => $message, 'number' => $number, 'leader_name' => $leader_name, 'role' => 0, 'photo_url' => $url]);
			}
		} else {
			return view('travels.show', ['travel' => $travel, 'message' => $message, 'number' => $number, 'leader_name' => $leader_name, 'role' => 0, 'photo_url' => $url]);
		}
	}
}