<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Models\Travel;

use App\Http\Controllers\TravelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
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
Route::get('/travels/create',[TravelController::class, 'create'])->name('CreateTravel');
Route::post('/travels/store',[TravelController::class, 'store'])->name('StoreTravel');
Route::get('/travels/edit/{travel}',[TravelController::class, 'edit'])->name('EditTravel');
Route::post('/travels/update/{travel}',[TravelController::class, 'update'])->name('UpdateTravel');
Route::get('/travels/show/{travel}' ,[TravelController::class,'show'])->name('ShowTravel');
Route::get('/travels/index' ,[TravelController::class,'index'])->name('IndexTravel');
Route::get('/travels/travelforyou/{travel}',[TravelController::class, 'AddTravelForUser'])->name('AddTravelForUser');
Route::get('/travels/cancel/{travel}',[TravelController::class, 'CancleTravel'])->name('CancleTravel');


Route::get('/dashboard', [UserController::class,'redirectTo'])->middleware(['auth'])->name('dashboard');
Route::get('/travels/cancletravel/{travel}', [UserController::class,'CancleTrvaelForUser'])->middleware(['auth'])->name('CancleTrvForUser');

Route::get('/leaders/active/{role}',[RoleController::class,'active'])->name('activeleader');
Route::get('/leaders/unactive/{role}',[RoleController::class,'unactive'])->name('unactiveleader');

Route::get('/travels/travelforyou/{travel}',[TravelController::class, 'AddTravelForUser'])->name('AddTravelForUser');


/*Route::get('/dashboard', function (Request $request) {
	$user = $request->user();
	$user->load('travels');
	$user->roles->first();
	
    return view('dashboard',['user'=>$user]);
})->middleware(['auth'])->name('dashboard');
*/


require __DIR__.'/auth.php';
