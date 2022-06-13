<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function redirectTo()
    {
		
        if (Auth::user()->roles->first()->role == "Admin") 
		{
			$user = Auth::user();
			$user->load('travels');
			$nonactive_leaders = User::with('roles')->whereHas('roles',function(Builder $query){$query->where('role','=','leader');})->get();
            return view('/panels/admin',['user'=>$user , 'nonactive_leaders'=>$nonactive_leaders]);
        }
		else
		{
        return view('dashboard',['user'=>$user]);
		}
    }
}
