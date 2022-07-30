<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Travel;
use App\Models\Comment;
use App\Models\User;

class TravelController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */


	public function index()
	{
		$travels = Travel::orderBy('registerationend', 'DESC')->get();
		return view('travels.index', ['travels' => $travels]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$message = 0;
		return view('travels.add', ['message' => $message]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */

	public function store(Request $request)
	{

		$request->validate([
			'destination' => 'required|string|max:255',
			'traveltime' => 'required',
			'registerationstart' => 'required',
			'registerationend' => 'required',
			'photo' => ['mimes:jpg,png,jpeg,gif,svg', 'max:2048']
		]);
		//barresi baze zamani
		$t = Travel::all()->where('destination', $request->destination)->where('traveltime', $request->traveltime)->count();
		if ($t > 0) {
			return redirect()->back()->withErrors(['error' => 'این سفر قبلا ثبت شده است']);
		}
		$rs = strtotime($request->registerationstart);
		$re = strtotime($request->registerationend);
		$tr = strtotime($request->traveltime);

		$daytraveltime = date('d', $tr);
		$monthtraveltime = date('m', $tr);
		$yeartraveltime = date('Y', $tr);

		$daystart = date('d', $rs);
		$monthstart = date('m', $rs);
		$yearstart = date('Y', $rs);

		$dayend = date('d', $re);
		$monthend = date('m', $re);
		$yearend = date('Y', $re);

		$currentyear = date("Y");
		$currentmonth = date("m");
		$currentday = date("d");

		if ($yearstart <= $yearend) {
			if ((($monthend == $monthstart) && ($daystart <= $dayend)) || ($monthstart < $monthend)) {
				if ($yearend <= $yeartraveltime) {
					if ((($monthend == $monthtraveltime) && ($dayend <= $daytraveltime)) || ($monthend < $monthtraveltime)) {
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
						}
						$travel = Travel::Create([
							"destination" => $request->destination, "traveltime" => $request->traveltime,
							'registerationstart' => $request->registerationstart,
							'registerationend' => $request->registerationend,
							"description" => $request->description, "cancel" => 0,
							'photoname' => $newphotofilename,
							'orginalphotoname' => $photofilename,
						]);

						$user = Auth::user();
						$travel->users()->attach($user, ["role" => "leader"]);
					} else {
						return redirect()->back()->withErrors(['error' => 'تاریخ ها معتبر نیستند']);
					}
				} else {
					return redirect()->back()->withErrors(['error' => 'تاریخ ها معتبر نیستند']);
				}
			} else {
				return redirect()->back()->withErrors(['error' => 'تاریخ ها معتبر نیستند']);
			}
		} else {
			return redirect()->back()->withErrors(['error' => 'تاریخ ها معتبر نیستند']);
		}
		$message = 1;
		return view('travels.add', ['message' => $message]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Travel  $travel
	 * @return \Illuminate\Http\Response
	 */
	public function show(Travel $travel)
	{
		$number = $travel->users()->count();
		$message = "0";
		$r = $travel->users;
		$leader_name = "empty";
		for ($i = 0; $i < $r->count(); $i++) {
			if ($r[$i]->pivot->role == "leader") {
				$leader_name = $r[$i]->name;
			}
		}

		$travel->comments;
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

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Travel  $travel
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Travel $travel)
	{
		$user = Auth::user();

		$admin = $user->roles->where('role', 'Admin')->count();

		$leader = $user->roles->where('role', 'leader')->count();
		$r	=	"empty";
		if ($leader == 1) {
			$t = $user->travels()->where('travel_id', $travel->id)->count();
			if ($t != 0) {
				$r = $user->travels()->where('travel_id', $travel->id)->firstOrFail()->pivot->role;
			}
		}

		if (($admin == 1) || ($r == "leader")) {
			return view('travels.edit', ['travel' => $travel]);
		} else
			return redirect()->back()->withErrors(['error' => 'شما اجازه تغییر اطلاعات این سفر را ندارید']);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Travel  $travel
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Travel $travel)
	{
		$request->validate([
			'destination' => 'required|string|max:255',
			'traveltime' => 'required',
			'registerationstart' => 'required',
			'photo' => ['mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
			'registerationend' => 'required',
		]);
		//barresi baze zamani

		$rs = strtotime($request->registerationstart);
		$re = strtotime($request->registerationend);
		$tr = strtotime($request->traveltime);

		$daytraveltime = date('d', $tr);
		$monthtraveltime = date('m', $tr);
		$yeartraveltime = date('Y', $tr);

		$daystart = date('d', $rs);
		$monthstart = date('m', $rs);
		$yearstart = date('Y', $rs);

		$dayend = date('d', $re);
		$monthend = date('m', $re);
		$yearend = date('Y', $re);

		$currentyear = date("Y");
		$currentmonth = date("m");
		$currentday = date("d");

		if ($yearstart <= $yearend) {
			if ((($monthend == $monthstart) && ($daystart <= $dayend)) || ($monthstart < $monthend)) {
				if ($yearend <= $yeartraveltime) {
					if ((($monthend == $monthtraveltime) && ($dayend <= $daytraveltime)) || ($monthend < $monthtraveltime)) {
						$newphotofilename = "null";
						$photofilename = "null";
						if ($request->photo != null) {

							$photofile = $request->file('photo');
							$photofilename = $photofile->getClientOriginalName();
							$extension = $photofile->extension();
							$newphotofilename = sha1(time() . '_' . rand(1000000000, 1999999999) . '_' . rand(1000000000, 1999999999) . '_' . $photofilename);
							$newphotofilename = $newphotofilename . '.' . $extension;

							Storage::disk('local')->putFileAs(
								'public/travels',
								$photofile,
								$newphotofilename
							);
						}

						DB::table('travels')->where('id', $travel->id)->update(array(

							"photoname" => $newphotofilename,
							"orginalphotoname" => $photofilename,
							"destination" => $request->destination,
							"traveltime" => $request->traveltime,
							'registerationstart' => $request->registerationstart, 'registerationend' => $request->registerationend,
							"description" => $request->description, "cancel" => 0
						));
						$message = "0";
						$number = $travel->users()->count();
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
								$travel->comments;
								return view('travels.show', [
									'travel' => $travel, 'message' => $message,
									'number' => $number, 'leader_name' => $leader_name, 'role' => 1, 'photo_url' => $url
								]);
							} else {
								return view('travels.show', [
									'travel' => $travel, 'message' => $message,
									'number' => $number, 'leader_name' => $leader_name, 'role' => 0, 'photo_url' => $url
								]);
							}
						} else {
							return view('travels.show', [
								'travel' => $travel, 'message' => $message,
								'number' => $number, 'leader_name' => $leader_name, 'role' => 0, 'photo_url' => $url
							]);
						}
					} else {
						return redirect()->back()->withErrors(['error' => 'تاریخ ها معتبر نیستند']);
					}
				} else {
					return redirect()->back()->withErrors(['error' => 'تاریخ ها معتبر نیستند']);
				}
			} else {
				return redirect()->back()->withErrors(['error' => 'تاریخ ها معتبر نیستند']);
			}
		} else {
			return redirect()->back()->withErrors(['error' => 'تاریخ ها معتبر نیستند']);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Travel  $travel
	 * @return \Illuminate\Http\Response
	 */


	public function CancleTravel(Travel $travel)
	{

		$user = Auth::user();

		$admin = $user->roles->where('role', 'Admin')->count();

		$leader = $user->roles->where('role', 'leader')->count();
		$r	=	"empty";
		if ($leader == 1) {
			$t = $user->travels()->where('travel_id', $travel->id)->count();
			if ($t != 0) {
				$r = $user->travels()->where('travel_id', $travel->id)->firstOrFail()->pivot->role;
			}
		}

		if (($admin == 1) || ($r == "leader")) {
			$travel->Update(["cancel" => 1]);
			return redirect()->back()->withErrors(['error' => 'سفر کنسل شد']);;
		}

		return redirect()->back()->withErrors(['error' => 'شما اجازه حذف این سفر را ندارید']);
	}

	public function ActiveTravel(Travel $travel)
	{
		$user = Auth::user();

		$admin = $user->roles->where('role', 'Admin')->count();

		$leader = $user->roles->where('role', 'leader')->count();
		$r	=	"empty";
		if ($leader == 1) {
			$t = $user->travels()->where('travel_id', $travel->id)->count();
			if ($t != 0) {
				$r = $user->travels()->where('travel_id', $travel->id)->firstOrFail()->pivot->role;
			}
		}

		if (($admin == 1) || ($r == "leader")) {
			$travel->Update(["cancel" => 0]);
			return redirect()->back()->withErrors(['error' => 'سفر فعال شد']);
		}

		return redirect()->back()->withErrors(['error' => 'شما اجازه فعال کردن این سفر را ندارید']);
	}
	public function SetComment(Request $request)
	{
		$request->validate([
			'travel' => 'required',
			'message' => 'required',
		]);
		$user = Auth::user();
		$travel_id = $request->travel;
		Comment::Create([
			"from" => $user->id,
			"travel_id" => $travel_id,
			"message" => $request->message,
		]);
		$travel = Travel::find($travel_id);
		$message = "0";
		$number = $travel->users()->count();
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
			$travel->comments;
			return view('travels.show', [
				'travel' => $travel, 'message' => $message,
				'number' => $number, 'leader_name' => $leader_name, 'role' => 1, 'photo_url' => $url
			]);
		} else {
			return view('travels.show', [
				'travel' => $travel, 'message' => $message,
				'number' => $number, 'leader_name' => $leader_name, 'role' => 0, 'photo_url' => $url
			]);
		}
	}
}
