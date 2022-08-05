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
use Verta;

class CommentController extends Controller
{
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
