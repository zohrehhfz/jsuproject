<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Travel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 public function __construct()
    {
        $this->middleware('auth')->except(['show','index']);
		$this->redirectTo = url()->previous();
        $this->middleware('admin')->except(['show','index','AddTravelForUser']);
		$this->middleware('leader')->except(['show','index','AddTravelForUser']);
    }
	
    public function index()
    {
        $travels = Travel::orderBy('registerationend','DESC')->get();
    return view('travels.index',['travels'=>$travels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function show(Travel $travel)
    {
		$message = "0";
        return view('travels.show',['travel'=>$travel , 'message'=>$message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function edit(Travel $travel)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travel $travel)
    {
        //
    }
	public function AddTravelForUser(Travel $travel)
    {
        $user = Auth::user();
		$user_with_travels = $user->travels;
		$count = $user_with_travels->where('id',$travel->id)->count();
		if($count == 0)
			$user->travels()->attach($travel , ['role'=>"user"]);
		$message = "1";
		return view('travels.show',['travel'=>$travel , 'message'=>$message]);
    }
	public function CancleTravel(Travel $travel)
    {
		$travel->Update(["cancel"=>1]);
        return redirect()->back();
    }
	
}
