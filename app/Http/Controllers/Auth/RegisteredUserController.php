<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'phone' => ['required', 'string','min:11' ,'max:13'],
			'birthdate' => ['required', 'string', 'max:5'],
			'role' => 'required' ,
			'photo' => ['mimes:jpg,png,jpeg,gif,svg','max:2048'] ,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
		$newphotofilename = "null";
		$photofilename = "null";
		if($request->photo != null)
		{
		
			$photofile = $request->file('photo');
			$photofilename = $photofile->getClientOriginalName();
			$extension = $photofile->extension();
			$newphotofilename = sha1(time().'_'.rand(1000000000,1999999999).'_'.rand(1000000000,1999999999).'_'.$photofilename);
			$newphotofilename = $newphotofilename.'.'.$extension;

			Storage::disk('local')->putFileAs(
				'public/files',
				$photofile,
				$newphotofilename
			);
		}
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
			'phone' => $request->phone,
            'birthdate' => $request->birthdate,
			'photoname' => $newphotofilename ,
			'orginalphotoname' => $photofilename ,
            'password' => Hash::make($request->password),
        ]);
		$number = 1;
		if($request->role == "leader")
		{
			$number = 0;

			Role::create([
			'user_id' => $user->id,
			'role' => $request->role ,
			'active' => $number
		]);
		}
		
		Role::create([
			'user_id' => $user->id,
			'role' => "user" ,
		]);
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
