<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Travel;
use App\Models\Chat;
use App\Models\Comment;
use App\Models\User;
use Verta;

class ChatController extends Controller
{
	public function ShowChat(Travel $travel)
	{
		$user = Auth::user();
		if ($user) {
			$user_with_travels = $user->travels;
			$count_t = $user_with_travels->where('id', $travel->id)->count();
			$admin = $user->roles->where('role', 'Admin')->count();
			if (($count_t > 0) || ($admin > 0)) {
				$chats = $travel->chats;
				return view('travels.chat', ["chats" => $chats, "user" => $user ,"travel"=>$travel]);
			}
		}
	}
	public function SendMessage(Request $request)
	{
		$request->validate([
			'travel' => 'required',
			'message' => 'required',
		]);
		$user = Auth::user();
		$travel_id = $request->travel;
		Chat::Create([
			"from" => $user->id,
			"travel_id" => $travel_id,
			"parent_id" => NULL,
			"flag" => 0,
			"message" => $request->message,
		]);
		$user_with_travels = $user->travels;
		$count_t = $user_with_travels->where('id', $travel_id)->count();
		$travel = Travel::find($travel_id);
		$admin = $user->roles->where('role', 'Admin')->count();
		if (($count_t > 0) || ($admin > 0)) {
			$chats = $travel->chats;
			return redirect()->route('ShowChat', ["travel"=>$travel]);
			
		}
	}
}
