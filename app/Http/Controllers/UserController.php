<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function redirectTo()
    {
        if (Auth::user()->roles->first()->role == "Admin") {
			$user = Auth::user();
			$user->load('travels');
			
            return view('dashboard',['user'=>$user]);
        }
        return '/home';
    }
}
