<?php

use Illuminate\Support\Facades\Route;
use App\Models\Travel;
use App\Http\Controllers\TravelController;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$travels = Travel::all();
    return view('welcome',['travels'=>$travels]);
});

Route::get('/travels/show/{travel}' ,[TravelController::class,'show'])->name('ShowTravel');
Route::get('/travels/index' ,[TravelController::class,'index'])->name('IndexTravel');

Route::get('/dashboard', function (Request $request) {
	$user = $request->user();
	$user->load('travels');
	$user->roles->first();
    return view('dashboard',['user'=>$user]);
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
